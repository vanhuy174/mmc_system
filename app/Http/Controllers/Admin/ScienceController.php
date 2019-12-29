<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\item;
use App\listitem;
use App\scienceemployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items=scienceemployee::all();
        $listitem=listitem::all();
        return view('admin.science.index',compact('listitem','items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list=listitem::select('id','mmc_mission')->pluck('mmc_mission','id');
        return view('admin.science.create',compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isset($request->mmc_mission))
        {
            $listitem=new listitem();
            $listitem->mmc_mission=$request->mmc_mission;
            $listitem->save();
        }else
        {
            $item=new item();
            $item->listitems_id=$request->mmc_missionid;
            $item->mmc_mission=$request->mmc_missions;
            $item->mmc_coefficient=$request->mmc_coefficient;
            $item->mmc_sogiochuan=$request->mmc_sogiochuan;
            $item->save();
        }
        return redirect('admin/science')->with('flash_message', 'Thêm mới thành công!');
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
