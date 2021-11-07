<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theloai;
use App\Models\Truyen;
class TheloaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $theloai = Theloai::orderBy('id','DESC')->get();
        return view('admincp.theloai.index')->with(compact('theloai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.theloai.create');
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
            'tentheloai' => 'required|unique:theloai|max:255', 
            'slug_theloai' => 'required|unique:theloai|max:255', 
            'mota' => 'required|max:255',
            'kichhoat' => 'required', 
            ],
            [
                'tentheloai.unique' => 'Tên thể loại đã có, hãy điền tên khác',
                'slug_theloai.unique' => 'Slug thể loại đã có, hãy điền slug khác',
                'tentheloai.required' => 'Phải nhập tên danh mục', 
                'mota.required' => 'Phải nhập mô tả', 
            ]
        );
        $theloai = new Theloai();
        $theloai->tentheloai = $data['tentheloai'];
        $theloai->slug_theloai = $data['slug_theloai'];
        $theloai->mota = $data['mota'];
        $theloai->kichhoat = $data['kichhoat'];
        $theloai->save();
        return redirect()->back()->with('status','Thêm thể loại thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:edit genre|delete genre|add genre',['only' => ['index','show']]);
         $this->middleware('permission:add genre', ['only' => ['create','store']]);
         $this->middleware('permission:edit genre', ['only' => ['edit','update']]);
         $this->middleware('permission:delete genre', ['only' => ['destroy']]);
    }
    public function show($id)
    {
        $theloai = Theloai::find($id);
     
    
        $list_truyen = Truyen::with('thuocnhieutheloaitruyen')->orderBy('id','DESC')->where('theloai_id',$theloai->id)->get();
        return view('admincp.theloai.show', compact('list_truyen', 'theloai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $theloai = Theloai::find($id);
        return view('admincp.theloai.edit')->with(compact('theloai'));
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
        $data = $request->all();
        $theloai = Theloai::find($id);
        $theloai->tentheloai = $data['tentheloai'];
        $theloai->slug_theloai = $data['slug_theloai'];
        $theloai->mota = $data['mota'];
        $theloai->kichhoat = $data['kichhoat'];
        $theloai->save();
        return redirect()->back()->with('status','Cập nhật thể loại thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Theloai::find($id)->delete();
        return redirect()->back()->with('status','Xóa thành công');
    }
}
