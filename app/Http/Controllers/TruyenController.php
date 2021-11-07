<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\ChapterTranh;
use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\Truyen;
use App\Models\Theloai;
use App\Models\ThuocLoai;
use App\Models\User;
use App\Models\Comment;
use App\Models\Rating;
use Carbon\Carbon;

class TruyenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:edit story|delete story|add story',['only' => ['index','show']]);
        // $this->middleware('role: admin',['only' => ['index','show']]);
         $this->middleware('permission:add story', ['only' => ['create','store']]);
         $this->middleware('permission:edit story', ['only' => ['edit','update']]);
         $this->middleware('permission:delete story', ['only' => ['destroy']]);
    }
     // function view_current_users_houses() {
       
    //     $user = User::find(auth()->user()->id);
      
    //     return view('view', compact('user'));
    //   }
    
    public function index()
    {  
        $user = User::find(auth()->user()->id);   
        $list_truyen = Truyen::with('danhmuctruyen','thuocnhieutheloaitruyen','thuocnhieuuser')->orderBy('id','DESC')->paginate(8);
        return view('admincp.truyen.index')->with(compact('list_truyen', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $theloai= Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
         $user = User::find(auth()->user()->id);   
        return view('admincp.truyen.create')->with(compact('danhmuc','theloai','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
            'tentruyen' => 'required|unique:truyen|max:50', 
            'slug_truyen' => 'required|unique:truyen|max:50', 
            'tukhoa' => 'max:50',
            'hinhanh' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'tomtat' => 'required',
            'kichhoat' => 'required', 
            'danhmuc' => 'required',
            'tacgia' => 'required',
            'tinhtrang' => 'required',
            'theloai' => 'required',
            'truyennoibat' => 'required',
            'thongbao' => 'max: 255',
            ],
            [
                'tentruyen.unique' => 'Tên truyện đã có, hãy điền tên khác',
                'tukhoa.max' => 'Từ khóa chỉ giới hạn đc 50 ký tự',
                'slug_truyen.unique' => 'Slug truyện đã có, hãy điền slug khác',
                'slug_truyen.required' => 'Phải có slug truyện',
                'tentruyen.required' => 'Phải nhập tên truyện', 
                'tomtat.required' => 'Phải nhập tóm tắt', 
                'hinhanh.required' => 'Phải có ảnh truyện', 
                'tacgia.required' => 'Phải có tên tác giả',
                'tentruyen.max' => 'Tên truyện không được dài quá 50 ký tự',
                'slug_truyen.max' => 'Tên truyện không được dài quá 50 ký tự', 
            ]
        );

        $truyen = new Truyen();
        $truyen->tentruyen = $data['tentruyen'];
        $truyen->slug_truyen = $data['slug_truyen'];
        $truyen->tomtat = $data['tomtat'];
        $truyen->tukhoa =  $data['tukhoa'];
        $truyen->kichhoat = $data['kichhoat'];
        $truyen->danhmuc_id = $data['danhmuc'];
        $truyen->user_id = auth()->user()->id;
        $truyen->tacgia = $data['tacgia'];
        $truyen->thongbao = $data['thongbao'];
        $truyen->tinhtrang = $data['tinhtrang'];
        $truyen->truyen_noibat = $data['truyennoibat'];
      
        $truyen->created_at = Carbon::now('Asia/Ho_Chi_Minh');

        foreach($data['theloai'] as $key => $the){
            $truyen->theloai_id = $the[0];
        }

        $get_image = $request->hinhanh;
        $path = 'public/uploads/truyen/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        
        $truyen->hinhanh = $new_image;

        $truyen->save();

        $truyen->thuocnhieutheloaitruyen()->attach($data['theloai']);

        return redirect()->back()->with('status','Thêm truyện thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $truyen = Truyen::find($id);
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $chaptertranh = ChapterTranh::with('truyen')->orderBy('id','DESC')->where('truyen_id',$truyen->id)->get();
        $chapter = Chapter::with('truyen')->orderBy('id','DESC')->where('truyen_id',$truyen->id)->get();
        return view('admincp.truyen.show', compact('truyen', 'chapter', 'chaptertranh','danhmuc'));
    }
    public function showByUserId($id)
    {
        $user = User::find(auth()->user()->id);      
        $list_truyen = Truyen::with('thuocnhieuuser')->orderBy('id','DESC')->where('user_id',$user->id)->get();
        return view('admincp.truyen.showByUserId', compact('user','list_truyen'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $truyen = Truyen::find($id);
        $thuoctheloai = $truyen->thuocnhieutheloaitruyen;
        $theloai= Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        return view('admincp.truyen.edit')->with(compact('truyen', 'danhmuc','theloai','thuoctheloai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
            'tentruyen' => 'required|max:50', 
            'slug_truyen' => 'required|max:50', 
            'tomtat' => 'required',
            'kichhoat' => 'required', 
            'danhmuc' => 'required',
            'tacgia' => 'required',
            'tinhtrang' => 'required',
            'theloai' => 'required',
            'truyennoibat' => 'required',
            'thongbao' => 'max: 255',
            ],
            [    
                'slug_truyen.required' => 'Phải có slug truyện',
                'tentruyen.required' => 'Phải nhập tên truyện', 
                'slug_truyen.unique' => 'Slug truyện này có đã có rồi',
                'tentruyen.unique' => 'Tên truyện này đã có rồi', 
                'tomtat.required' => 'Phải nhập tóm tắt', 
                'tacgia.required' => 'Phải nhập tên tác giả', 
                'tentruyen.max' => 'Tên truyện không được dài quá 50 ký tự',
                'slug_truyen.max' => 'Tên truyện không được dài quá 50 ký tự', 
            ]
        );
        $truyen = Truyen::find($id);

        $truyen->thuocnhieutheloaitruyen()->sync($data['theloai']);

        $truyen->tentruyen = $data['tentruyen'];
        $truyen->slug_truyen = $data['slug_truyen'];
        $truyen->tomtat = $data['tomtat'];
        $truyen->kichhoat = $data['kichhoat'];
        $truyen->danhmuc_id = $data['danhmuc'];
        $truyen->tacgia = $data['tacgia'];
        $truyen->thongbao = $data['thongbao'];
        $truyen->tinhtrang = $data['tinhtrang'];     
        $truyen->truyen_noibat = $data['truyennoibat'];
        
        $truyen->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        foreach($data['theloai'] as $key => $the){
            $truyen->theloai_id = $the[0];
        }

        $get_image = $request->hinhanh;
        if($get_image){
            $path = 'public/uploads/truyen/'.$truyen->hinhanh;
            if(file_exists($path)){
                unlink($path);
            }
    
            $path = 'public/uploads/truyen/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            
            $truyen->hinhanh = $new_image;
        }    
        $truyen->save();
       
        return redirect()->back()->with('status','Cập nhật truyện thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $truyen = Truyen::find($id);

        //Nếu hình ảnh tồn tại thì sẽ xóa được hình ảnh
        $path = 'public/uploads/truyen/'.$truyen->hinhanh;
        if(file_exists($path)){
            unlink($path);
        }
        $truyen->thuocnhieutheloaitruyen()->detach($truyen->theloai_id);
        Truyen::find($id)->delete();
        return redirect()->back()->with('status','Xóa truyện thành công');
    }

    public function truyennoibat(Request $request){
        $data = $request->all();
        $truyen = Truyen::find($data['truyen_id']);
        $truyen->truyen_noibat = $data['truyennoibat'];
        $truyen->save();

    }
    // public function load_comment(Request $request){
    //     $data = $request->all();
    //     $truyen_id = Truyen::find($data['truyen_id']);
    //     $comment = Comment::where('comment_truyen_id',$truyen_id)->get();
    //     $output = '';
    //     foreach ($comment as $key => $comm){
    //         $output .= '
           
            
    //         ';
    //     }
    //     echo $output;
    // }

    public function insert_rating(Request $request){
        $data = $request->all();
        $rating = new Rating();
        $rating->truyen_id = $data['truyen_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo 'done';
    }

    public function timkiem(Request $request){
        $data = $request->all();
        $tukhoa = $data['tukhoa'];
        $user = User::find(auth()->user()->id);   

        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','ASC')->get();

        $dexuat_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',0)->take(3)->get();
        $dexuat_theloai = Theloai::orderBy('id','DESC')->take(4)->get();

        $list_truyen = Truyen::with('danhmuctruyen','theloai')->where('tentruyen','LIKE','%'.$tukhoa.'%')->get();
        return view('admincp.truyen.search')->with(compact('user','danhmuc','theloai','list_truyen','tukhoa','dexuat_truyen','dexuat_theloai'));
    }

    public function timkiem_ajax(Request $request){
        $data = $request->all();

        if($data['keywords']){
            $truyen = Truyen::where('kichhoat',0)->where('tentruyen','LIKE', '%'.$data['keywords'].'%')->get();

            $output = '
                <div class="dropdown-menu" style="display: block";>
            ';

            foreach($truyen as $key => $tr){
                $output .= '
                 <a herf="#" class="li_timkiem_ajax dropdown-item">'.$tr->tentruyen.'</a>         
                ';
            }
            $output .= '</div>';
            echo $output;
        }
    }
}
