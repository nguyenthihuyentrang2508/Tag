<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Truyen;
use Carbon\Carbon;
class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('role:admin',['only' => ['index','show']]);
         $this->middleware('permission:add chapter', ['only' => ['create','store']]);
         $this->middleware('permission:edit chapter', ['only' => ['edit','update']]);
         $this->middleware('permission:delete chapter', ['only' => ['destroy']]);
    }
   
    public function index()
    {
        $chapter = Chapter::with('truyen')->orderBy('id','DESC')->get();
        return view('admincp.chapter.index')->with(compact('chapter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $truyen = Truyen::find($id);
        return view('admincp.chapter.create')->with(compact('truyen'));
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
            'tieude' => 'required|max:255', 
            'slug_chapter' => 'required|max:255', 
            // 'hinhanh' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'noidung' => 'required',
            'tomtat' => 'max:255',
            'kichhoat' => 'required', 
            'truyen_id' => 'required',
            ],
            [   
                'tieude.unique' => 'Tên tiêu đề này đã tồn tại',
                'slug_chapter.unique' => 'Slug tiêu đề này đã tồn tại',
                'slug_chapter.required' => 'Phải có slug chapter',
                'tieude.required' => 'Phải nhập tên chapter', 
                'noidung.required' => 'Phải nhập tóm nội dung', 
                // 'hinhanh.required' => 'Phải có ảnh truyện', 
            ]
        );
        $chapter = new Chapter();

        $slug = $data['slug_chapter'];
        $count = 0;
        while(Chapter::where('slug_chapter', '=', $slug)->count()>0){
            $count++;
            $slug = $request->slug_chapter.'-'.$count;
        }

        $chapter->tieude = $data['tieude'];
        $chapter->tomtat = $data['tomtat'];
        $chapter->kichhoat = $data['kichhoat'];
        $chapter->noidung = $data['noidung'];
        $chapter->slug_chapter = $slug;
        $chapter->truyen_id = $data['truyen_id'];
        $chapter->created_at = Carbon::now('Asia/Ho_Chi_Minh');

        // $get_image = $request->hinhanh;
        // $path = 'public/uploads/truyen/';
        // $get_name_image = $get_image->getClientOriginalName();
        // $name_image = current(explode('.', $get_name_image));
        // $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        // $get_image->move($path,$new_image);
        
        // $chapter->hinhanh = $new_image;

    

        $chapter->save();
        return redirect()->back()->with('status','Thêm chapter thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chapter = Chapter::find($id);
        $truyen = Truyen::orderBy('id','DESC')->get();
        return view('admincp.chapter.edit')->with(compact('truyen', 'chapter'));
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
            'tieude' => 'required|max:255', 
            'slug_chapter' => 'required|max:255', 
            // 'hinhanh' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'noidung' => 'required',
            'tomtat' => 'max:255',
            'kichhoat' => 'required', 
            'truyen_id' => 'required',
            ],
            [
                'tieude.unique' => 'Tên tiêu đề này đã tồn tại',
                'slug_chapter.unique' => 'Slug tiêu đề này đã tồn tại',
                'slug_chapter.required' => 'Phải có slug chapter',
                'tieude.required' => 'Phải nhập tên chapter', 
                'noidung.required' => 'Phải nhập nội dung truyện', 
                // 'hinhanh.required' => 'Phải có ảnh truyện', 
            ]
        );

        $chapter = Chapter::find($id);


        $slug = $data['slug_chapter'];
        $count = 0;
        while(Chapter::where('slug_chapter', '=', $slug)->count()>0){
            $count++;
            $slug = $request->slug_chapter.'-'.$count;
        }
        
       
        $chapter->tieude = $data['tieude'];
        $chapter->slug_chapter = $data['slug_chapter'];
        $chapter->tomtat = $data['tomtat'];
        $chapter->kichhoat = $data['kichhoat'];
        $chapter->noidung = $data['noidung'];
        $chapter->slug_chapter = $slug;
        $chapter->truyen_id = $data['truyen_id'];
        $chapter->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        $chapter->save();
        return redirect()->back()->with('status','Cập nhật chapter thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Chapter::find($id)->delete();
        return redirect()->back()->with('status','Đã xóa chapter thành công');
    }

    //Test

    
}


