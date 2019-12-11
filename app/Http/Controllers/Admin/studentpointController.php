<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\mmc_studentpoint;
use App\mmc_subjectclass;
use App\mmc_subject;
use App\mmc_student;
use App\mmc_class;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

class studentpointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= mmc_studentpoint::with('student.class')->get();
        return view('admin.point.index',['pointstudent'=>$data]);
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

    public function getclass(Request $request)
    {
        $subjectclass= mmc_subjectclass::find($request->id);
        $studentpoint= mmc_studentpoint::where('mmc_subjectclassid', '=', $subjectclass->mmc_subjectclassid)->get();
        // dd($studentpoint->student->mmc_fullname);
        return view('admin.studentpoint.index',['data'=>$studentpoint, 'nameclass'=>$subjectclass]);
    }

    /**
        hàm để thêm thông tin sinh viên trong lớp học phần bằng file excel

     */
    public function infoStudent(Request $request)
    {
        $reader = new Xls();
        $reader->setReadDataOnly(true);
        $objPHPExcel = $reader->load(request()->file('file'));
        $obj = []; //khởi tạo mảng obj để chứa các dữ liệu lịch sau khi xử lý xong.
        $errors = []; //khởi tạo mảng error để chứa các lỗi gặp phải trong quá trình thêm.
        $j=0; $k=0;  //$j chỉ số của mảng obj, $k là chỉ số của mảng eror.
        $sheet_number=0;   //đếm số sheet trong file.
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){ //vòng lặp để lấy giá trị trong từng sheet của file excel 
            $sheet_number++;
            $sheet = $worksheet->toArray();
            for ($i = 0; $i < count($sheet); $i++) {//vòng lặp để kiểm tra giá trị từng dòng.
                $temp= substr($sheet[$i][1],  0, 18);
                if($temp == 'Lớp học phần'){//để lấy mã lớp học phần.
                    $temp=explode("(",$sheet[$i][1]);
                    $temp=explode(")",$temp[1]);
                    $subjectclassid= $temp[0].'-'.Auth::user()->mmc_employeeid;
                    if(mmc_subjectclass::where('mmc_subjectclassid','=', $subjectclassid)->value('mmc_subjectclassname')== null){
                        return back()->with('status', 'Lớp học phần không tồn tại!');
                    }
                }

                $temp= substr($sheet[$i][1],  0, 12);
                if($temp == 'Học phần'){//để lấy tên học phần.
                    $temp=explode(": ",$sheet[$i][1]);
                    if($subjectid= mmc_subject::where('mmc_subjectname', '=', $temp[1])->value('mmc_subjectid') != null){
                        return back()->with('status', 'Học phần không tồn tại!');
                    }
                }
                
                if(is_int($sheet[$i][0])){
                    $studentid= $sheet[$i][1];
                    //Kiểm tra xem sinh viên có tôn tại trong hệ thống hay không.
                    if(! mmc_student::where('mmc_studentid','=', $studentid)->get('mmc_fullname')){
                        $errors[$k]='Dòng '.$sheet[$i][0].' lỗi: Sinh viên không tồn tại!';
                        $k++;
                        continue;
                    }
                    //Kiểm tra sinh viên đã tồn tại trong lớp học phần này chưa.
                    if(mmc_studentpoint::where('mmc_studentid','=', $studentid)->where('mmc_subjectclassid','=', $subjectclassid)->value('id')!=null){
                        $errors[$k]='Dòng '.$sheet[$i][0].' lỗi: Sinh viên đã tồn tại trong lớp học phần này!';
                        $k++;
                        continue;
                    }
                    //Kiểm tra xem sinh viên đã từng học phần này hay chưa nếu đã học thì đổi lại mã lớp học phần.
                    if($idpoint= mmc_studentpoint::where('mmc_studentid','=', $studentid)->where('mmc_subjectid','=', $subjectid)->value('id')){
                        $data= mmc_studentpoint::find($idpoint);
                        $data->mmc_subjectclassid= $subjectclassid;
                        if($data->diligentpoint != null){
                            $data->diligentpoint= $sheet[$i][4].'-'.$data->diligentpoint;
                        }else{
                            $data->diligentpoint= $sheet[$i][4];
                        }
                        if($data->point1 != null){
                            $data->point1= $sheet[$i][5].'-'.$data->point1;
                        }else{
                            $data->point1= $sheet[$i][5];
                        }
                        if($data->point2 != null){
                            $data->point2= $sheet[$i][6].'-'.$data->point2;
                        }else{
                            $data->point2= $sheet[$i][6];
                        }
                        if($data->point3 != null){
                            $data->point3= $sheet[$i][7].'-'.$data->point3;
                        }else{
                            $data->point3= $sheet[$i][7];
                        }
                        if($data->point4 != null){
                            $data->point4= $sheet[$i][8].'-'.$data->point4;
                        }else{
                            $data->point4= $sheet[$i][8];
                        }
                        if($data->mmc_note != null){
                            $data->mmc_note= $sheet[$i][10].'-'.$data->mmc_note;
                        }else{
                            $data->mmc_note= $sheet[$i][10];
                        }
                        $data->mmc_key= 1;
                        $data->update();
                        continue;
                    }
                    $obj[$j] = [
                        'mmc_studentid' => $studentid,
                        'mmc_subjectclassid' => $subjectclassid,
                        'mmc_subjectid' => $subjectid,
                        'diligentpoint' => $sheet[$i][4],
                        'point1'=> $sheet[$i][5],
                        'point2'=> $sheet[$i][6],
                        'point3'=> $sheet[$i][7],
                        'point4'=> $sheet[$i][8],
                        'mmc_note'=> $sheet[$i][10],
                        'mmc_key'=> 0,
                    ];
                    $j++;
                }
            }
        }
        // Vòng lặp để lưu dữ liệu trong mảng obj vào trong csdl
        for ($i=0; $i < count($obj); $i++) {
            $point= new mmc_studentpoint;
            $point->mmc_studentid = $obj[$i]['mmc_studentid'];
            $point->mmc_subjectclassid = $obj[$i]['mmc_subjectclassid'];
            $point->mmc_subjectid = $obj[$i]['mmc_subjectid'];
            $point->diligentpoint = $obj[$i]['diligentpoint'];
            $point->point1 = $obj[$i]['point1'];
            $point->point2 = $obj[$i]['point2'];
            $point->point3 = $obj[$i]['point3'];
            $point->point4 = $obj[$i]['point4'];
            $point->mmc_note = $obj[$i]['mmc_note'];
            $point->mmc_key = $obj[$i]['mmc_key'];

            $point->save();
        }
        if($j==0){
            return back()->with('status', 'Thêm danh sách sinh viên thành công!');
        }else{
            return back()->withErrors($errors);
        }   
    }

    /**
        hàm để thêm thông tin sinh viên trong lớp học phần bằng file excel

     */
    public function pointstudent(Request $request)
    {
        $reader = new Xls();
        $reader->setReadDataOnly(true);
        $objPHPExcel = $reader->load(request()->file('file'));
        $obj = []; //khởi tạo mảng obj để chứa các dữ liệu lịch sau khi xử lý xong.
        $j=0;   //$j chỉ số của mảng obj
        $sheet_number=0;   //đếm số sheet trong file.
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){ //vòng lặp để lấy giá trị trong từng sheet của file excel 
            $sheet_number++;
            $sheet = $worksheet->toArray();
            for ($i = 0; $i < count($sheet); $i++) {//vòng lặp để kiểm tra giá trị từng dòng.
                $temp= substr($sheet[$i][1],  0, 18);
                if($temp == 'Lớp học phần'){//để lấy mã lớp học phần.
                    $temp=explode("(",$sheet[$i][1]);
                    $temp=explode(")",$temp[1]);
                    $subjectclassid= $temp[0].'-'.Auth::user()->mmc_employeeid;
                    if(! mmc_subjectclass::where('mmc_subjectclassid','=', $subjectclassid)->value('mmc_subjectclassname')){
                        return back()->with('status', 'Lớp học phần không tồn tại!');
                    }
                }

                $temp= substr($sheet[$i][1],  0, 12);
                if($temp == 'Học phần'){//để lấy tên học phần.
                    $temp=explode(": ",$sheet[$i][1]);
                    if(! $subjectid= mmc_subject::where('mmc_subjectname', '=', $temp[1])->value('mmc_subjectid')){
                        dd($subjectid);
                        return back()->with('status', 'Học phần không tồn tại!');
                    }
                }
                
                if(is_int($sheet[$i][0])){
                    $studentid= $sheet[$i][1];
                    //Kiểm tra xem sinh viên có tôn tại trong hệ thống hay không.
                    if(! mmc_student::where('mmc_studentid','=', $studentid)->get('mmc_fullname')){
                        return back()->with('status', 'Sinh viên không tồn tại!');
                        continue;
                    }
                    //Kiểm tra sinh viên đã tồn tại trong lớp học phần này chưa.
                    if(! $id= mmc_studentpoint::where('mmc_studentid','=', $studentid)->where('mmc_subjectclassid','=', $subjectclassid)->value('id')){
                        return back()->with('status', 'Sinh viên không tồn tại trong lớp học phần này!');
                        continue;
                    }
                    
                    $obj[$j] = [
                        'id' => $id,
                        'diligentpoint' => $sheet[$i][4],
                        'point1'=> $sheet[$i][5],
                        'point2'=> $sheet[$i][6],
                        'point3'=> $sheet[$i][7],
                        'point4'=> $sheet[$i][8],
                        'mmc_note'=> $sheet[$i][10],    
                    ];
                    $j++;
                }
            }
        }
        // Vòng lặp để lưu dữ liệu trong mảng obj vào trong csdl
        for ($i=0; $i < count($obj); $i++) {
            $point= mmc_studentpoint::find($obj[$i]['id']);
            $point->diligentpoint = $obj[$i]['diligentpoint'];
            $point->point1 = $obj[$i]['point1'];
            $point->point2 = $obj[$i]['point2'];
            $point->point3 = $obj[$i]['point3'];
            $point->point4 = $obj[$i]['point4'];
            $point->mmc_note = $obj[$i]['mmc_note'];
            $point->update();
        }
        return back()->with('status', 'Thêm điểm thành công!');
    }
}
