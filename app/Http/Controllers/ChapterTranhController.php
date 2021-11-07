<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chaptertranh;
use App\Models\Truyen;
use Carbon\Carbon;

class ChapterTranhController extends Controller
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
        $chaptertranh = Chaptertranh::with('truyen')->orderBy('id','DESC')->get();
        return view('admincp.chaptertranh.index')->with(compact('chaptertranh'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $truyen = Truyen::find($id);
        return view('admincp.chaptertranh.create')->with(compact('truyen'));
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
            'tieude' => 'required|unique:chaptertranh|max:255', 
            'slug_chaptertranh' => 'required|unique:chaptertranh|max:255', 
            'image' => 'required',
            'tomtat' => 'max:255',
            'kichhoat' => 'required', 
            'truyen_id' => 'required',
            ],
            [   
                'tieude.unique' => 'Tên tiêu đề này đã tồn tại',
                'slug_chaptertranh.unique' => 'Slug tiêu đề này đã tồn tại',
                'slug_chaptertranh.required' => 'Phải có slug chapter',
                'tieude.required' => 'Phải nhập tên chapter', 
                'tomtat.required' => 'Phải nhập tóm tắt', 
                'image.required' => 'Phải có ảnh truyện', 
               
            ]
        );
        $chaptertranh = new Chaptertranh();

        $slug = $data['slug_chaptertranh'];
        $existingCount = Chaptertranh::where('slug_chaptertranh', 'like', $slug . '-%')->count();
        $keys = rand(0, 999);
        if($existingCount)
        {
            $chaptertranh->slug_chaptertranh = $slug . '-' . ($keys);
        }
        else{
            $chaptertranh->slug_chaptertranh = $slug;
        }

        $chaptertranh->tieude = $data['tieude'];
        $chaptertranh->tomtat = $data['tomtat'];
        $chaptertranh->kichhoat = $data['kichhoat'];
        $chaptertranh->truyen_id = $data['truyen_id'];
        $chaptertranh->created_at = Carbon::now('Asia/Ho_Chi_Minh');

        
        if($files = $request->file('image')){
            foreach ($files as $file) {
                $image_name = md5(rand(1000, 10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $upload_path = 'public/multiple_image/';
                $image_url = $upload_path.$image_full_name;
                $file->move($upload_path, $image_full_name);
                $image[] = $image_url;
            }
            $chaptertranh->image =  json_encode($image);
        }
    
        
        $chaptertranh->save();
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
        $chaptertranh = Chaptertranh::find($id);
        $truyen = Truyen::orderBy('id','DESC')->get();
        return view('admincp.chaptertranh.edit')->with(compact('truyen', 'chaptertranh'));
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
            'tieude' => 'required|unique:chaptertranh|max:255', 
            'slug_chaptertranh' => 'required|unique:chaptertranh|max:255', 
            'image' => 'required',
            'tomtat' => 'max:255',
            'kichhoat' => 'required', 
            'truyen_id' => 'required',
            ],
            [   
                'tieude.unique' => 'Tên tiêu đề này đã tồn tại',
                'slug_chaptertranh.unique' => 'Slug tiêu đề này đã tồn tại',
                'slug_chaptertranh.required' => 'Phải có slug chapter',
                'tieude.required' => 'Phải nhập tên chapter', 
                'tomtat.required' => 'Phải nhập tóm tắt', 
                'image.required' => 'Phải có ảnh truyện', 
               
            ]
        );
        $chaptertranh = Chaptertranh::find($id);
        $slug = $data['slug_chaptertranh'];
        $existingCount = Chaptertranh::where('slug_chaptertranh', 'like', $slug . '-%')->count();
        $keys = rand(0, 999);
        if($existingCount)
        {
            $chaptertranh->slug_chaptertranh = $slug . '-' . ($keys);
        }
        else{
            $chaptertranh->slug_chaptertranh = $slug;
        }

        $chaptertranh->tieude = $data['tieude'];
        $chaptertranh->tomtat = $data['tomtat'];
        $chaptertranh->kichhoat = $data['kichhoat'];
        $chaptertranh->truyen_id = $data['truyen_id'];
        $chaptertranh->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        $image = array();
        if($files = $request->file('image')){
            $upload_path = 'public/multiple_image/'.$chaptertranh->image;
            foreach ($files as $file) {
                $image_name = md5(rand(1000, 10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $upload_path = 'public/multiple_image/';
                $image_url = $upload_path.$image_full_name;
                $file->move($upload_path, $image_full_name);
                $image[] = $image_url;
            }
            
        }
        $chaptertranh->image = json_encode($image);
        $chaptertranh->save();
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
        $chaptertranh = Chaptertranh::find($id);

        //Nếu hình ảnh tồn tại thì sẽ xóa được hình ảnh
        $path = 'public/multiple_image/'.$chaptertranh->image;
        if(file_exists($path)){
            unlink($path);
        }

        Chaptertranh::find($id)->delete();
        return redirect()->back()->with('status','Xóa chapter thành công');
    }
}
