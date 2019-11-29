<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\mmc_calendar;
use App\mmc_subjectclass;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $key = Auth::user()->mmc_employeeid;
        $subjectclass= mmc_subjectclass::where('mmc_employeeid', '=', $key)->get();
        $calendar =[];
        $k=0;
        for ($i=0; $i < count($subjectclass); $i++) { 
            $data= mmc_calendar::where('mmc_subjectclassid', '=', $subjectclass[$i]->mmc_subjectclassid)->get();
            for ($j=0; $j < count($data); $j++) {
                $calendar[$k]=[
                    'tenlophocphan' => $subjectclass[$i]['mmc_subjectclassname'],
                    'ngayhoc' => $data[$j]->mmc_schedule,
                    'phonghoc' => $data[$j]->mmc_classroom,
                    'tiethoc' => $data[$j]->mmc_class,
                ];
                $k++;
            }
        }
        // dd($calendar);   
        return view('admin.schedule.index',compact('calendar'));
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
}
