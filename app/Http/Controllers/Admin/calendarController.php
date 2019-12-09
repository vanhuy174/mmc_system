<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\mmc_employee;
use App\mmc_calendar;
use App\mmc_subjectclass;
use App\mmc_subject;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;
use DateTime;


class calendarController extends Controller
{
    /**
     chuển đến giao viện thêm lịch
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
        hàm để thêm lịch giảng dạy cho giảng viên bằng file excel

     */
    public function store(Request $request)
    {
        $reader = new Xls();
        $reader->setReadDataOnly(true);
        $objPHPExcel = $reader->load(request()->file('file'));
        $nameteacher = null;
        $date = Carbon::now();
        $obj = []; //khởi tạo mảng obj để chứa các dữ liệu lịch sau khi xử lý xong.
        $j=0;   //$j chỉ số của mảng obj
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){ //vòng lặp để lấy giá trị trong từng sheet của file excel 
            $sheet = $worksheet->toArray();
            for ($i = 0; $i < count($sheet); $i++) {
                
                if($sheet[$i][1] == 'Họ và tên giảng viên :'){
                    $name= $sheet[$i][2];
                    if(! $teacherid= mmc_employee::where('mmc_name','=', $name)->value('mmc_employeeid')){
                        $teacherid= 'no_id';
                    }
                }
                if(substr($sheet[$i][1],  0, 7) == 'TUẦN:'){
                    $m1=explode("(",$sheet[$i][1]); //dùng để cắt chuối thành nhiều phần tại vị trí có dấu '('
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
                    $m3=explode(".TH",$m2[0]);
                    $thuhoc= $sheet[$i][3]-2; //đặt giá trị ngày tháng cho từng thứ học
                    $ngayhoc=$date->addDays($thuhoc);
                    $date=Carbon::create($y,$m,$d);//set lai gia tri cho ngay tháng năm sau khi da dat gia tri ngay tahng cho từng thứ học.
                    $tenhocphan= explode("-",$m1[0]);

                    $mahocphan= mmc_subject::where('mmc_subjectname', '=', $tenhocphan[0])->value('mmc_subjectid');
                    dd($mahocphan);
                    $obj[$j] = [
                        'magiangvien' => $teacherid,
                        'malophocphan' => $m3[0].'-'.$teacherid,
                        'tenlophocphan' => $m1[0],
                        'mahocphan' => $mahocphan,
                        'ngayhoc' => $ngayhoc,
                        'phonghoc' => $sheet[$i][5],
                        'tiethoc' => $sheet[$i][4],
                    ];
                    $j++;
                }
                if( $i % 500 == 0 ){ 
                    set_time_limit(200);
                }
            }
        }
        // Vòng lặp để lưu dữ liệu trong mảng obj vào trong csdl
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
