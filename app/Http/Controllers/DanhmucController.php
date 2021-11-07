<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\Truyen;

class DanhmucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:edit category|delete category|add category',['only' => ['index','show']]);
         $this->middleware('permission:add category', ['only' => ['create','store']]);
         $this->middleware('permission:edit category', ['only' => ['edit','update']]);
         $this->middleware('permission:delete category', ['only' => ['destroy']]);
    }
    public function index()
    {
        $danhmuctruyen = DanhmucTruyen::orderBy('id','DESC')->get();
        return view('admincp.danhmuctruyen.index')->with(compact('danhmuctruyen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.danhmuctruyen.create');
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
            'tendanhmuc' => 'required|unique:danhmuc|max:255', 
            'slug_danhmuc' => 'required|unique:danhmuc|max:255', 
            'mota' => 'required|max:255',
            'kichhoat' => 'required', 
            ],
            [
                'tendanhmuc.unique' => 'Tên danh mục đã có, hãy điền tên khác',
                'slug_danhmuc.unique' => 'Slug danh mục đã có, hãy điền slug khác',
                'tendanhmuc.required' => 'Phải nhập tên danh mục', 
                'mota.required' => 'Phải nhập mô tả', 
            ]
        );
        $danhmuctruyen = new DanhmucTruyen();
        $danhmuctruyen->tendanhmuc = $data['tendanhmuc'];
        $danhmuctruyen->slug_danhmuc = $data['slug_danhmuc'];
        $danhmuctruyen->mota = $data['mota'];
        $danhmuctruyen->kichhoat = $data['kichhoat'];
        $danhmuctruyen->save();
        return redirect()->back()->with('status','Thêm danh mục thành công');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $danhmuc = DanhmucTruyen::find($id);
        $list_truyen = Truyen::with('danhmuctruyen')->orderBy('id','DESC')->where('danhmuc_id',$danhmuc->id)->get();
        return view('admincp.danhmuctruyen.show', compact('list_truyen', 'danhmuc'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $danhmuc = DanhmucTruyen::find($id);
        return view('admincp.danhmuctruyen.edit')->with(compact('danhmuc'));
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
        $data = $request->all(
        );
        $danhmuctruyen = DanhmucTruyen::find($id);
        $danhmuctruyen->tendanhmuc = $data['tendanhmuc'];
        $danhmuctruyen->slug_danhmuc = $data['slug_danhmuc'];
        $danhmuctruyen->mota = $data['mota'];
        $danhmuctruyen->kichhoat = $data['kichhoat'];
        $danhmuctruyen->save();
        return redirect()->back()->with('status','Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DanhmucTruyen::find($id)->delete();
        return redirect()->back()->with('status','Xóa thành công');
    }
}
