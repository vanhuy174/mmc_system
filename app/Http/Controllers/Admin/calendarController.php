<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\mmc_employee;
use App\mmc_calendar;
use App\mmc_subjectclass;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;
use DateTime;


class calendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.calendar.index' );
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
        $reader = new Xls();
        $reader->setReadDataOnly(true);
        $objPHPExcel = $reader->load(request()->file('file'));
        set_time_limit(300);
        $nameteacher = null;
        $date = Carbon::now();
        $obj = [];
        $j=0;
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){
            $sheet = $worksheet->toArray();
            for ($i = 0; $i < count($sheet); $i++) {
                if($sheet[$i][1] == 'Họ và tên giảng viên :'){
                    $name= $sheet[$i][2];
                    if(! $teacherid= mmc_employee::where('mmc_name','=', $name)->value('mmc_employeeid')){
                        $teacherid= 'noid';
                    }
                }
                if(substr($sheet[$i][1],  0, 7) == 'TUẦN:'){
                    $m1=explode("(",$sheet[$i][1]);
                    $m2=explode(" ",$m1[1]);
                    $m3=explode("/",$m2[0]);
                    $d=$m3[0];
                    $m=$m3[1];
                    $y=$m3[2];
                    $date=Carbon::create($y,$m,$d);
                }
                if(is_int($sheet[$i][0])){
                    $m1=explode("(",$sheet[$i][1]);
                    $m2=explode(")",$m1[1]);
                    $thuhoc= $sheet[$i][3]-2;
                    $ngayhoc=$date->addDays($thuhoc);
                    $date=Carbon::create($y,$m,$d);//set lai gia tri cho ngay sau khi da tang gia tri
                    
                    $obj[$j] = [
                        'magiangvien' => $teacherid,
                        'malophocphan' => $m2[0].'-'.$teacherid,
                        'tenlophocphan' => $sheet[$i][1],
                        'mahocphan' => "HP1",
                        'ngayhoc' => $ngayhoc,
                        'phonghoc' => $sheet[$i][5],
                        'tiethoc' => $sheet[$i][4],
                    ];
                    $j++;
                }
            }
        }
        for ($i=0; $i < count($obj); $i++) {
            $get= mmc_subjectclass::where('mmc_subjectclassname', '=', $obj[$i]['tenlophocphan'])->get();
            if(count($get)==0){
                $subjectclass= new mmc_subjectclass;
                $subjectclass->mmc_subjectclassid= $obj[$i]['malophocphan'];
                $subjectclass->mmc_subjectclassname= $obj[$i]['tenlophocphan'];
                $subjectclass->mmc_employeeid= $obj[$i]['magiangvien'];
                $subjectclass->mmc_subjectid= $obj[$i]['mahocphan'];
                $subjectclass->save();
            }
            $calendars= new mmc_calendar;
            $calendars->mmc_subjectclassid = $obj[$i]['malophocphan'];
            $calendars->mmc_schedule = $obj[$i]['ngayhoc'];
            $calendars->mmc_class = $obj[$i]['tiethoc'];
            $calendars->mmc_classroom = $obj[$i]['phonghoc'];

            $calendars->save();
        }
        return back()->with('status', 'Thêm lịch thành công!');
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
