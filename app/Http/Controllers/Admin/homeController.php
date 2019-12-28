<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\mmc_class;
use App\mmc_employee;
use App\mmc_pointdetails;
use App\mmc_student;
use Illuminate\Http\Request;

class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $numberstudent= mmc_student::count();
        $numberclass= mmc_class::count();
        $numberemploy= mmc_employee::count();
        $student= mmc_student::get();
        $pointdetail= mmc_pointdetails::get();
        $yeu=0; $tb=0; $kha=0; $gioi=0; $xs=0;
        if(count($student) > 0 && count($pointdetail) > 0){
            foreach ($student as $item){
                if(isset($$item->pointdetail)){
                    $point= $item->pointdetail->mmc_4grade;
                    if($point < 2.0){
                        $yeu++;
                    }elseif ($point >= 2.0 && $point < 2.5 ){
                        $tb++;
                    }elseif ($point >= 2.5 && $point < 3.2 ){
                        $kha++;
                    }elseif ($point >= 3.2 && $point < 3.6 ){
                        $gioi++;
                    }else{
                        $xs++;
                    }
                }
            }
            $yeu= (int)(($yeu*100)/$numberstudent);
            $tb= (int)(($tb*100)/$numberstudent);
            $kha= (int)(($kha*100)/$numberstudent);
            $gioi= (int)(($gioi*100)/$numberstudent);
            $xs= (int)(($xs*100)/$numberstudent);
        }
        $hocluc=array($yeu, $tb, $kha, $gioi, $xs);
        return view('admin.index', compact('numberstudent', 'numberclass', 'numberemploy', 'hocluc'));
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

    public static function countstudent($year, $mmc_majorid){
        $khoa='K'.$year;
        return mmc_class::where('mmc_ctdt', '=', $khoa)->where('mmc_major', '=', $mmc_majorid)->sum('mmc_numstudent');
    }
}
