<?php

namespace App\Http\Controllers\Admin;
use App\mmc_congviec;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NhanViecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->mmc_employeeid;
        $danhsach = mmc_congviec::where('mmc_nguoinhan', $id)->get();
        
        return view('admin.nhanviec.danhsach',compact('danhsach'));
    }

    public static function count(){
        $id = Auth::user()->mmc_employeeid;
        return mmc_congviec::where('mmc_nguoinhan', '=', "$id")->where('mmc_trangthai', '=', "1")->count();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $xem = mmc_congviec::find($id);
        $xem->mmc_trangthai = 2;
        $xem->save();
        return view('admin.nhanviec.xem',compact('xem'));
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
