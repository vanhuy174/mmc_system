<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\item;
use App\listitem;
use App\scienceemployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScienceEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items=scienceemployee::where('mmc_employeeid','=',Auth::user()->mmc_employeeid)->get();
        return view('admin.scienceemployee.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list=listitem::select('id','mmc_mission')->pluck('mmc_mission','id');
        $item=item::where('listitems_id','=',1)->pluck('mmc_mission','id');
        return view('admin.scienceemployee.create',compact('list','item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'mmc_file'=>'mimes:pdf',
        ],[
            'mmc_file.mimes'=>'Không phải file pdf',
        ]);
        $file=$request->mmc_file;
        $file->move('PDF/',$file->getClientOriginalName());
        $scienceemployee=new scienceemployee();
        $scienceemployee->mmc_file=$file->getClientOriginalName();
        $scienceemployee->mmc_employeeid=Auth::user()->mmc_employeeid;
        $scienceemployee->mmc_missionid=$request->mmc_mission;
        $scienceemployee->mmc_link=$request->mmc_link;
        $scienceemployee->mmc_status=0;
        $scienceemployee->save();
        return redirect('admin/scienceemployee')->with('flash_message', 'Thêm mới thành công!');;
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
        //
    }
}
