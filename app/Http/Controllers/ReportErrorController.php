<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reporterror;
class ReportErrorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reportErrors = Reporterror::orderBy('id','DESC')->get();
        return view('admincp.report.reportError')->with(compact('reportErrors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'chonloi'=>'required',
            'noidung'=> 'max:255,'
        ]);
   
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        $chapter_id = $request->chapter_id;
        Reporterror::create($input, $chapter_id);
   
        return back();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Reporterror::find($id)->delete();
        return redirect()->back()->with('status','Đã xóa thông báo này thành công');
    }
}
