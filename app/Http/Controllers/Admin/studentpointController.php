<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\mmc_studentpoint;
use App\mmc_pointdetails;
use App\mmc_subjectclass;
use App\mmc_subject;
use App\mmc_student;
use App\mmc_class;
use App\mmc_major;
use DB;
use libphonenumber\CountryCodeToRegionCodeMap;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\studentpointExport;

class studentpointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data_major= mmc_major::get();
        $data_class=mmc_class::get();
        $perPage= 10;
        $keyword= $request->search;
        $classid= $request->malop;
        $majorid= $request->manghanh;

        $numberstudent= 0; $yeu=0; $tb=0; $kha=0; $gioi=0; $xs=0;
        $hocky= $request->hocky;
        $status= $request->status;
        $numberstudent= 0; $yeu=0; $tb=0; $kha=0; $gioi=0; $xs=0;
        if (!is_null($keyword)){
            $pointstudent= mmc_student::where('mmc_studentid', 'LIKE', "%$keyword%")->orWhere('mmc_fullname', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
            $hocluc=array(0, 0, 0, 0, 0);
            return view('admin.point.index',compact(['pointstudent' , 'hocluc', "data_class", "data_major", "classid", "majorid", "hocky", "status"]));
        }
        elseif(!empty($majorid) && empty($classid) && empty($hocky) && empty($status)) {
            $pointstudent= null;
            $class = mmc_class::Where('mmc_major', '=', $majorid)->get();
            if (!is_null($class)) {
                $data = null; $allpoint= null;
                foreach ($class as $key) {
                    $student = mmc_student::where('mmc_classid', '=', $key->mmc_classid)->latest();
                    $point = mmc_student::where('mmc_classid', '=', $key->mmc_classid)->get();
                    if (is_null($data)) {
                        if (!is_null($student)) {
                            $data = $student;
                            $allpoint= $point;
                        }
                    } else {
                        if (!is_null($student)) {
                            $data = $data->unionAll($student)->latest();
                            $allpoint = $allpoint->merge($point);
                        }
                    }
                }
                foreach ($allpoint as $key) {
                    $point = $key->pointdetail->mmc_4grade;
                    if ($point == null) {
                        continue;
                    }
                    $tinh= tinhhocluc($point);
                    if ($tinh == 'yeu') {$yeu++;
                    } elseif ($tinh == 'tb') { $tb++;
                    } elseif ($tinh == 'kha') { $kha++;
                    } elseif ($tinh == 'gioi') { $gioi++;
                    } else { $xs++; }
                    $numberstudent++;
                }
                if($yeu == 0 ){ $yeu = 0; }else{ $yeu= (int)(($yeu*100)/$numberstudent);}
                if($tb == 0 ){ $tb = 0; }else{ $tb= (int)(($tb*100)/$numberstudent);}
                if($kha == 0 ){ $kha = 0; }else{ $kha= (int)(($kha*100)/$numberstudent);}
                if($gioi == 0 ){ $gioi = 0; }else{ $gioi= (int)(($gioi*100)/$numberstudent);}
                if($xs == 0 ){ $xs = 0; }else{ $xs= (int)(($xs*100)/$numberstudent);}
                $hocluc = array($yeu, $tb, $kha, $gioi, $xs);
                $pointstudent= $data->paginate($perPage);
            }
            return view('admin.point.index',compact(['pointstudent' , 'hocluc', "data_class", "data_major", "classid", "majorid", "hocky", "status"]));
        }
        elseif(!empty($majorid) && !empty($classid) && empty($hocky) && empty($status)){
            $pointstudent= mmc_student::where('mmc_classid', '=', $classid)->latest()->paginate($perPage);
            $pointk= mmc_Student::where('mmc_classid', '=', $classid)->get();
            foreach ($pointk as $key) {
                $point = $key->pointdetail->mmc_4grade;
                if ($point == null) {
                    continue;
                }
                if(tinhhocluc($point) == 'yeu'){
                    $yeu++;
                }elseif (tinhhocluc($point) == 'tb'){
                    $tb++;
                }elseif (tinhhocluc($point) == 'kha'){
                    $kha++;
                }elseif (tinhhocluc($point) == 'gioi'){
                    $gioi++;
                }else{
                    $xs++;
                }
                $numberstudent++;
            }
            if($yeu == 0 ){ $yeu = 0; }else{ $yeu= (int)(($yeu*100)/$numberstudent);}
            if($tb == 0 ){ $tb = 0; }else{ $tb= (int)(($tb*100)/$numberstudent);}
            if($kha == 0 ){ $kha = 0; }else{ $kha= (int)(($kha*100)/$numberstudent);}
            if($gioi == 0 ){ $gioi = 0; }else{ $gioi= (int)(($gioi*100)/$numberstudent);}
            if($xs == 0 ){ $xs = 0; }else{ $xs= (int)(($xs*100)/$numberstudent);}
            $hocluc=array($yeu, $tb, $kha, $gioi, $xs);
            return view('admin.point.index',compact(['pointstudent' , 'hocluc', "data_class", "data_major", "classid", "majorid", "hocky", "status"]));
        }
        elseif(!empty($majorid) && empty($classid) && !empty($hocky) && empty($status)){
            $pointstudent= null;
            $class = mmc_class::Where('mmc_major', '=', $majorid)->get();
            if (!is_null($class)) {
                $data = null; $allpoint= null;
                foreach ($class as $key) {
                    $student = mmc_student::where('mmc_classid', '=', $key->mmc_classid)->latest();
                    $point = mmc_student::where('mmc_classid', '=', $key->mmc_classid)->get();
                    if (is_null($data)) {
                        if (!is_null($student)) {
                            $data = $student;
                            $allpoint= $point;
                        }
                    } else {
                        if (!is_null($student)) {
                            $data = $data->unionAll($student)->latest();
                            $allpoint = $allpoint->merge($point);
                        }
                    }
                }
                foreach ($allpoint as $key) {
                    $point = $key->pointdetail->mmc_4grade;
                    if ($point == null) {
                        continue;
                    }
                    $tinh= tinhhocluc($point);
                    if ($tinh == 'yeu') {
                        $yeu++;
                    } elseif ($tinh == 'tb') {
                        $tb++;
                    } elseif ($tinh == 'kha') {
                        $kha++;
                    } elseif ($tinh == 'gioi') {
                        $gioi++;
                    } else {
                        $xs++;
                    }
                    $numberstudent++;
                }

                $hocluc = array($yeu, $tb, $kha, $gioi, $xs);
                $pointstudent= $data->paginate($perPage);
            }
            if($yeu == 0 ){ $yeu = 0; }else{ $yeu= (int)(($yeu*100)/$numberstudent);}
            if($tb == 0 ){ $tb = 0; }else{ $tb= (int)(($tb*100)/$numberstudent);}
            if($kha == 0 ){ $kha = 0; }else{ $kha= (int)(($kha*100)/$numberstudent);}
            if($gioi == 0 ){ $gioi = 0; }else{ $gioi= (int)(($gioi*100)/$numberstudent);}
            if($xs == 0 ){ $xs = 0; }else{ $xs= (int)(($xs*100)/$numberstudent);}
            $hocluc=array($yeu, $tb, $kha, $gioi, $xs);
            return view('admin.point.index',compact(['pointstudent' , 'hocluc', "data_class", "data_major", "classid", "majorid", "hocky", "status"]));
        }
        elseif(!empty($majorid) && empty($classid) && empty($hocky) && !empty($status)){
            $pointstudent = null;
            $class = mmc_class::Where('mmc_major', '=', $majorid)->get();
            if (!is_null($class)) {
                foreach ($class as $key) {
                    $student = mmc_student::where('mmc_classid', '=', $key->mmc_classid)->get();
                    if (!is_null($student)) {
                        foreach ($student as $key) {
                            $point = $key->pointdetail->mmc_4grade;
                            if (tinhhocluc($point) === $status) {
                                if (is_null($pointstudent)) {
                                    $pointstudent = mmc_student::where('id', '=', $key->id)->latest();
                                } else {
                                    $pointstudent = $pointstudent->unionAll(mmc_student::where('id', '=', $key->id)->latest())->latest();
                                }
                            }
                        }
                    }
                }
            }
            if (!is_null($pointstudent)){
                $pointstudent= $pointstudent->paginate($perPage);
            }
            $hocluc=array(0, 0, 0, 0, 0);
            return view('admin.point.index',compact(['pointstudent' , 'hocluc', "data_class", "data_major", "classid", "majorid", "hocky", "status"]));
        }
        elseif(!empty($majorid) && !empty($classid) && !empty($hocky) && empty($status)){
            $pointstudent= mmc_student::where('mmc_classid', '=', $classid)->latest()->paginate($perPage);
            $pointk= mmc_Student::where('mmc_classid', '=', $classid)->get();
            foreach ($pointk as $key) {
                $point = $key->pointdetail->mmc_4grade;
                if ($point == null) {
                    continue;
                }
                if(tinhhocluc($point) == 'yeu'){
                    $yeu++;
                }elseif (tinhhocluc($point) == 'tb'){
                    $tb++;
                }elseif (tinhhocluc($point) == 'kha'){
                    $kha++;
                }elseif (tinhhocluc($point) == 'gioi'){
                    $gioi++;
                }else{
                    $xs++;
                }
                $numberstudent++;
            }
            if($yeu == 0 ){ $yeu = 0; }else{ $yeu= (int)(($yeu*100)/$numberstudent);}
            if($tb == 0 ){ $tb = 0; }else{ $tb= (int)(($tb*100)/$numberstudent);}
            if($kha == 0 ){ $kha = 0; }else{ $kha= (int)(($kha*100)/$numberstudent);}
            if($gioi == 0 ){ $gioi = 0; }else{ $gioi= (int)(($gioi*100)/$numberstudent);}
            if($xs == 0 ){ $xs = 0; }else{ $xs= (int)(($xs*100)/$numberstudent);}
            $hocluc=array($yeu, $tb, $kha, $gioi, $xs);
            return view('admin.point.index',compact(['pointstudent' , 'hocluc', "data_class", "data_major", "classid", "majorid", "hocky", "status"]));
        }
        elseif(!empty($majorid) && !empty($classid) && empty($hocky) && !empty($status)){
            $pointstudent = null;
            $student= mmc_student::where('mmc_classid', '=', $classid)->get();
            if (!is_null($student)) {
                $i = 0;
                foreach ($student as $key) {
                    $point = $key->pointdetail->mmc_4grade;
                    if (tinhhocluc($point) === $status) {
                        if (is_null($pointstudent)) {
                            $pointstudent = mmc_student::where('id', '=', $key->id)->latest();
                        } else {
                            $pointstudent = $pointstudent->unionAll(mmc_student::where('id', '=', $key->id)->latest())->latest();
                        }
                    }
                }
            }
            if (!is_null($pointstudent)){
                $pointstudent= $pointstudent->paginate($perPage);
            }
            $hocluc=array(0, 0, 0, 0, 0);
            return view('admin.point.index',compact(['pointstudent' , 'hocluc', "data_class", "data_major", "classid", "majorid", "hocky", "status"]));
        }
        elseif(!empty($majorid) && !empty($classid) && !empty($hocky) && !empty($status)){
            $pointstudent = null;
            $student= mmc_student::where('mmc_classid', '=', $classid)->get();
            if (!is_null($student)) {
                $i = 0;
                foreach ($student as $key) {
                    $point = $key->pointdetail->mmc_4grade;
                    if (tinhhocluc($point) === $status) {
                        if (is_null($pointstudent)) {
                            $pointstudent = mmc_student::where('id', '=', $key->id)->latest();
                        } else {
                            $pointstudent = $pointstudent->unionAll(mmc_student::where('id', '=', $key->id)->latest())->latest();
                        }
                    }
                }
            }
            if (!is_null($pointstudent)){
                $pointstudent= $pointstudent->paginate($perPage);
            }
            $hocluc=array(0, 0, 0, 0, 0);
            return view('admin.point.index',compact(['pointstudent' , 'hocluc', "data_class", "data_major", "classid", "majorid", "hocky", "status"]));
        }
        else{
            $pointstudent = mmc_student::latest()->paginate($perPage);
            $pointdetail = mmc_pointdetails::get();
            $numberstudent = count($pointdetail);
            $yeu = 0; $tb = 0; $kha = 0; $gioi = 0; $xs = 0;
            if (count($pointstudent) > 0 && count($pointdetail) > 0) {
                foreach ($pointdetail as $item) {
                    $point = $item->mmc_4grade;
                    if ($point == null) {
                        continue;
                    }
                    if (tinhhocluc($point) == 'yeu') {
                        $yeu++;
                    } elseif (tinhhocluc($point) == 'tb') {
                        $tb++;
                    } elseif (tinhhocluc($point) == 'kha') {
                        $kha++;
                    } elseif (tinhhocluc($point) == 'gioi') {
                        $gioi++;
                    } else {
                        $xs++;
                    }
                }
                if($yeu == 0 ){ $yeu = 0; }else{ $yeu= (int)(($yeu*100)/$numberstudent);}
                if($tb == 0 ){ $tb = 0; }else{ $tb= (int)(($tb*100)/$numberstudent);}
                if($kha == 0 ){ $kha = 0; }else{ $kha= (int)(($kha*100)/$numberstudent);}
                if($gioi == 0 ){ $gioi = 0; }else{ $gioi= (int)(($gioi*100)/$numberstudent);}
                if($xs == 0 ){ $xs = 0; }else{ $xs= (int)(($xs*100)/$numberstudent);}
            }
            $hocluc = array($yeu, $tb, $kha, $gioi, $xs);
            return view('admin.point.index', compact(['pointstudent', 'hocluc', "data_class", "data_major", "classid", "majorid", "hocky", "status"]));
            }
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
                    $subjectid = mmc_subject::where('mmc_subjectname', '=', $temp[1])->value('mmc_subjectid');
                    if($subjectid == null){
                        return back()->with('status', 'Học phần không tồn tại!');
                    }
                }
                if(is_int($sheet[$i][0])){
                    $studentid= $sheet[$i][1];
                    //Kiểm tra xem sinh viên có tôn tại trong hệ thống hay không.
                    if(count(mmc_student::where('mmc_studentid','=', $studentid)->get('id'))==0){
                        print_r(mmc_student::where('mmc_studentid','=', $studentid)->get('id'));
                        $errors[$k]='Dòng '.$sheet[$i][0].' lỗi: Sinh viên không tồn tại!';
                        $k++;
                        continue;
                    }
                    //Kiểm tra sinh viên đã tồn tại trong lớp học phần này chưa.
                    if(mmc_studentpoint::where('mmc_studentid','=', $studentid)->where('mmc_subjectclassid','=', $subjectclassid)->value('id') !=null){
                        $errors[$k]='Dòng '.$sheet[$i][0].' lỗi: Sinh viên đã tồn tại trong lớp học phần này!';
                        $k++;
                        continue;
                    }
                    //Kiểm tra xem sinh viên đã từng học phần này hay chưa nếu đã học thì đổi lại mã lớp học phần.
                    $idpoint= mmc_studentpoint::where('mmc_studentid','=', $studentid)->where('mmc_subjectid','=', $subjectid)->value('id');
                    if($idpoint != null){
                        $data= mmc_studentpoint::find($idpoint);
                        $data->mmc_subjectclassid= $subjectclassid;
                        $data->diligentpoint= '-'.$data->diligentpoint;
                        $data->point1= '-'.$data->point1;
                        $data->point2= '-'.$data->point2;
                        $data->point3= '-'.$data->point3;
                        $data->point4= '-'.$data->point4;
                        $data->testscore= '-'.$data->testscore;
                        $data->mmc_note= '-'.$data->mmc_note;
                        $data->mmc_key= $data->mmc_key+1;
                        $data->update();
//                        $this->setpointdetail($studentid, $subjectid);
                        continue;
                    }
                    $obj[$j] = [
                        'mmc_studentid' => $studentid,
                        'mmc_subjectclassid' => $subjectclassid,
                        'mmc_subjectid' => $subjectid,
                        'mmc_key'=> 1,
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
            $point->point_ratio = 3;
            $point->mmc_key = $obj[$i]['mmc_key'];
            $point->save();
//            $this->newpointdetail($obj[$i]['mmc_studentid'], $obj[$i]['mmc_subjectid']);
        }
        if($k==0){
            return back()->with('status', 'Thêm danh sách sinh viên thành công!');
        }else{
            return back()->withErrors($errors);
        }
    }

//    public function setpointdetail($mmc_studentid, $mmc_subjectid){
//        $pointdetail= mmc_pointdetails::where('mmc_studentid','=', $mmc_studentid)->where('mmc_subjectid','=', $mmc_subjectid)->get();
//        if(count($pointdetail) > 0){
//            $point= mmc_pointdetails::find($pointdetail[0]->id);
//            $point->mmc_10grade = "-".$point->mmc_10grade;
//            $point->mmc_4grade = "-".$point->mmc_4grade;
//            $point->key = $point->key + 1;
//            $point->update();
//        }
//    }

//    public function newpointdetail($mmc_studentid, $mmc_subjectid){
//            $newpoint= new mmc_pointdetails;
//            $newpoint->mmc_studentid = $mmc_studentid;
//            $newpoint->mmc_subjectid = $mmc_subjectid;
//            $newpoint->mmc_10grade = '';
//            $newpoint->mmc_4grade = '';
//            $newpoint->key = 1;
//            $newpoint->save();
//    }

    /**
        hàm để thêm thông tin sinh viên trong lớp học phần bằng file excel

     */
    public function pointstudent(Request $request)
    {
        $reader = new Xls();
        $reader->setReadDataOnly(true);
        $objPHPExcel = $reader->load(request()->file('file'));
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
                    if(! mmc_subjectclass::where('mmc_subjectclassid','=', $subjectclassid)->value('mmc_subjectclassname')){
                        return back()->with('status', 'Lớp học phần không tồn tại!');
                    }
                }

                $temp= substr($sheet[$i][1],  0, 12);
                if($temp == 'Học phần'){//để lấy tên học phần.
                    $temp=explode(": ",$sheet[$i][1]);
                    if(! $subjectid= mmc_subject::where('mmc_subjectname', '=', $temp[1])->value('mmc_subjectid')){
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
                    if(! $id= mmc_studentpoint::where('mmc_studentid','=', $studentid)->where('mmc_subjectclassid','=', $subjectclassid)->value('id')){
                        $errors[$k]='Dòng '.$sheet[$i][0].' lỗi: Sinh viên không tồn tại trong lớp học phần này!';
                        $k++;
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
            if($point->mmc_key < 2){
                $point->diligentpoint = $obj[$i]['diligentpoint'];
                $point->point1 = $obj[$i]['point1'];
                $point->point2 = $obj[$i]['point2'];
                $point->point3 = $obj[$i]['point3'];
                $point->point4 = $obj[$i]['point4'];
                $point->mmc_note = $obj[$i]['mmc_note'];
                $point->update();
            }else{
                    $temp=explode("-",$point->diligentpoint);
                    $temp[0]= $obj[$i]['diligentpoint'];
                    $diligentpointnew = implode( "-", $temp);
                $point->diligentpoint = $diligentpointnew;
                    $temp=explode("-",$point->point1);
                    $temp[0]= $obj[$i]['point1'];
                    $point1new = implode( "-", $temp);
                $point->point1 = $point1new;
                    $temp=explode("-",$point->point2);
                    $temp[0]= $obj[$i]['point2'];
                    $point2new = implode( "-", $temp);
                $point->point2 = $point2new;
                    $temp=explode("-",$point->point3);
                    $temp[0]= $obj[$i]['point3'];
                    $point3new = implode( "-", $temp);
                $point->point3 = $point3new;
                    $temp=explode("-",$point->point4);
                    $temp[0]= $obj[$i]['point4'];
                    $point4new = implode( "-", $temp);
                $point->point4 = $point4new;
                    $temp=explode("-",$point->mmc_note);
                    $temp[0]= $obj[$i]['mmc_note'];
                    $mmc_notenew = implode( "-", $temp);
                $point->mmc_note = $mmc_notenew;
                $point->update();
            }

        }
        if($k==0){
            return back()->with('status', 'Thêm điểm thành công!');
        }else{
            return back()->withErrors($errors);
        }
    }

    public function pointtest(Request $request)
    {
        $reader = new Xls();
        $reader->setReadDataOnly(true);
        $objPHPExcel = $reader->load(request()->file('file'));
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
                    if(! mmc_subjectclass::where('mmc_subjectclassid','=', $subjectclassid)->value('mmc_subjectclassname')){
                        return back()->with('status', 'Lớp học phần không tồn tại!');
                    }
                }

                $temp= substr($sheet[$i][1],  0, 12);
                if($temp == 'Học phần'){//để lấy tên học phần.
                    $temp=explode(": ",$sheet[$i][1]);
                    if(! $subjectid= mmc_subject::where('mmc_subjectname', '=', $temp[1])->value('mmc_subjectid')){
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
                    if(! $id= mmc_studentpoint::where('mmc_studentid','=', $studentid)->where('mmc_subjectclassid','=', $subjectclassid)->value('id')){
                        $errors[$k]='Dòng '.$sheet[$i][0].' lỗi: Sinh viên không tồn tại trong lớp học phần này!';
                        $k++;
                        continue;
                    }

                    $obj[$j] = [
                        'id' => $id,
                        'pointtest'=> $sheet[$i][5],
                        'mmc_note'=> $sheet[$i][8],
                    ];
//                    $this->updatepointdetail($id, $sheet[$i][5]); // tính điếm và lưu diểm tổng kết vào bảng mmc_pointdetails
                    $j++;
                }
            }
            break;
        }
        // Vòng lặp để lưu dữ liệu trong mảng obj vào trong csdl
        for ($i=0; $i < count($obj); $i++) {
            $point= mmc_studentpoint::find($obj[$i]['id']);
            $hs10= $this->hs10($point->id, $obj[$i]['pointtest']);
            if($point->mmc_key < 2){
                $point->testscore = $obj[$i]['pointtest'];
                $point->mmc_note = $obj[$i]['mmc_note'];
                $point->mmc_10grade = $hs10;
                $point->mmc_4grade = $this->hs4($hs10);
                $point->update();
                $this->updatepointdetail($point->mmc_studentid);
            }else{
                $point->mmc_10grade = $hs10.'-'.$point->mmc_10grade;
                $point->mmc_4grade = $this->hs4($hs10).'-'.$point->mmc_4grade;
                $point->testscore = $obj[$i]['pointtest'].'-'.$point->testscore;
                $point->update();
                $this->updatepointdetail($point->mmc_studentid);
            }

        }
        if($k==0){
            return back()->with('status', 'Thêm điểm thi thành công!');
        }else{
            return back()->withErrors($errors);
        }
    }

    public function hs10($id, $pointtest){
        $point = mmc_studentpoint::find($id);
        $subject = mmc_subject::where('mmc_subjectid',  '=', $point->mmc_subjectid)->get();
        $tongket = tinhdiemTB($subject[0]->mmc_theory, $subject[0]->mmc_practice, $point->point_ratio, $point->diligentpoint, $point->point1, $point->point2, $point->point3, $point->point4, $pointtest);
        return $tongket;
    }

    public function hs4($hs10){
        $hs4= null;
        if($hs10 < 4.0){
            $hs4= 0;
        }else
            if($hs10 >= 4.0 && $hs10 < 5.5){
                $hs4= 1;
            }else
                if($hs10 >= 5.5 && $hs10 < 7.0){
                    $hs4= 2;
                }else
                    if($hs10 >= 7.0 && $hs10 < 8.5){
                        $hs4= 3;
                    }else{
                        $hs4= 4;
                    }
        return $hs4;
    }

    public function updatepointdetail($studentid){
        $student= mmc_studentpoint::where('mmc_studentid', '=', $studentid)->get();
        $tongtinchi=0;
        $tongdiem=0;
        $tonghs4=0;
        if(count($student)>0){
            foreach ($student as $key){
                $subject= mmc_subject::where('mmc_subjectid', '=', $key->mmc_subjectid)->get();
                $tinchi= $subject[0]->mmc_theory + $subject[0]->mmc_practice;
                $array=$temp=explode("-",$key->mmc_10grade);
                $diem= 0;
                foreach ($array as $a){
                    $a= (float)$a;
                    if($diem<$a){
                        $diem= $a;
                    }
                }
                $tongdiem += ($diem*$tinchi);
                $tonghs4 += $this->hs4($diem)*$tinchi;
                $tongtinchi += $tinchi;
            }
            $diemtb= $tongdiem/$tongtinchi;
            $diemtb= number_format((float)$diemtb, 1, '.', '');
            $hs4=$tonghs4/$tongtinchi;
            $hs4= number_format((float)$hs4, 2, '.', '');
            $pointdetail= mmc_pointdetails::where('mmc_studentid', '=', $studentid)->get();
            if(count($pointdetail)==0){
                $point= new mmc_pointdetails();
                $point->mmc_studentid= $studentid;
                $point->mmc_10grade= $diemtb;
                $point->mmc_4grade= $hs4;
                $point->save();
            }else{
                $point= mmc_pointdetails::find($pointdetail[0]->id);
                $point->mmc_10grade= $studentid;
                $point->mmc_4grade= $hs4;
                $point->update();
            }
        }
    }

    public function editratio(Request $request){
        $data= mmc_studentpoint::where('mmc_subjectclassid', '=', $request->subjectclassid)->get();
        foreach ($data as $value) {
            $value->point_ratio= $request->point_ratio;
            $value->update();
        }
        return back()->with('status', 'Sửa tỉ lệ điểm thành công!');
    }

    /**
     * Hàm export dùng để xuất ra danh sách diem sinh viên có trong CSDL ra file excel có tên: Danh-sach-sinh-vien.xlsx .
     */
    public function export(Request $request)
    {
        return Excel::download(new studentpointExport($request), 'Danh-sach-diem-sinh-vien.xlsx');
        return back();
    }
}
