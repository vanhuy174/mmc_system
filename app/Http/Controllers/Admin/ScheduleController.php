<?php

namespace App\Http\Controllers\Admin;

use App\mmc_class;
use Auth;
use App\mmc_time;
use App\mmc_calendar;
use App\mmc_subjectclass;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;



class ScheduleController extends Controller
{
    /**
         lấy dữ liệu ban đầu cho chức năng xem lịch học và thời gian biểu
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
                    'id' => $data[$j]->id,
                    'tenlophocphan' => $subjectclass[$i]['mmc_subjectclassname'],
                    'ngayhoc' => $data[$j]->mmc_schedule,
                    'phonghoc' => $data[$j]->mmc_classroom,
                    'tiethoc' => $data[$j]->mmc_class,
                ];
                $k++;
            }
        }
        $time= mmc_time::get();

        /** kiểm tra ngay hiện tại đang dùng lịch mùa đông hay mùa hè
        Lich mùa hè bắt đầu từ: 15/04, Lịch mùa đông bắt đầu từ: 15/10 */
        $year = date("Y");
        $key_date1 = $year."-04-15";
        $key_date2 = $year."-10-15";
        $today = date("Y-m-d");
        if ( strtotime($today) >= strtotime($key_date2) || strtotime($today) < strtotime($key_date1) ) {
            $key_season=1;
        }
        else {
            $key_season=2;
        }

        return view('admin.schedule.index',compact('calendar' , 'time', 'key_season'));
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
        lưu lại thời gian ra vào lớp sau khi đã sửa
     */
    public function store(Request $request)
    {
        for ($i=0; $i < count(collect($request)->get('id')); $i++) {
            $time = mmc_time::Find($request->get('id')[$i]);
            $time->id = $request->get('id')[$i];
            $time->time_in = $request->get('time_in')[$i];
            $time->time_out = $request->get('time_out')[$i];
            $time->save();
        }
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
        //
    }
    public static function getstar($id)
    {

         return mmc_time::where('class_time', '=', "5")->value('time_in');
    }
    public static function getend($id)
    {
        return mmc_time::where('class_time', '=', "$id")->value('time_out');
    }
    public function updatecalendar(Request $request)
    {
        if(!is_null($request->id) && !is_null($request->date) && !is_null($request->sotiet) && !is_null($request->phonghoc)){
            $class= null;
            $i= 0;
            while($i< $request->sotiet){
                if (is_null($class)){
                    $class= $request->tiet;
                }else{
                    $class= $class.",".++$request->tiet;
                }
                $i++;
            }
            $data= mmc_calendar::find($request->id);
            $data->mmc_schedule= $request->date;
            $data->mmc_class= $class;
            $data->mmc_classroom= $request->phonghoc;
            $data->update();
            return back();
        }else{
            return back();
        }
    }

}
