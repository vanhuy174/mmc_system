<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use App\mmc_Student;
use App\mmc_class;
use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;
use App\Exports\mmc_StudentExport;
use App\Imports\mmc_StudentImport;
use Maatwebsite\Excel\Facades\Excel;


class mmc_ControllerStudent extends Controller
{
    /**
        Hàm Index để lấy dữ liệu trong bảng mmc_student ra cho view mmc_homeStudent.
        $data_class để chữa thông tin của các lớp.
        $perPage để xác định số lượng SV được hiển thị trong mỗi trang.
        $data để chữa dữ liệu sinh viên đã truy vấn.
        $keyword chữa nội dung người dùng tìm kiếm.
        Nếu $keyword có giá trị thì thực hiện chức năng tìm kiếm, nếu không thì thực hiện truy vấn bình thường.
     */
    public function index(Request $request)
    {
        $data_class=mmc_class::get();

        $perPage= 10;
        $keyword= $request->search;
        if(!empty($keyword)){
             $data= mmc_Student::where('mmc_studentid', 'LIKE', "%$keyword%")->orWhere('mmc_fullname', 'LIKE', "%$keyword%")->orWhere('mmc_classid', 'LIKE', "%$keyword%")->orWhere('mmc_email', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
            return view('admin.Student.mmc_homeStudent',compact(['data' , "data_class"]));
        }else{
            $data=mmc_Student::latest()->paginate($perPage);
            return view('admin.Student.mmc_homeStudent',['data'=>$data , "data_class"=>$data_class]);
        }
    }

    /**
        Hàm getclass dùng để lấy thông tin của các lớp trong csdl.
        Hàm này phục vụ cho chức năng thêm sinh viên.
    */
    public function getclass(){
    	$data=mmc_class::get();
        return view('admin.Student.mmc_createStudent',['data'=>$data]);
    }

    /**
        Hàm Create dùng để thêm thông tin của 1 sinh viên vào trong csdl.
     */
    public function create(Request $request)
    {
        $request->validate(
            [
                'mmc_studentid' => 'required|unique:mmc_students',
                'mmc_classid' => 'required',
                'mmc_fullname' => 'required',
                'mmc_dateofbirth' => 'required',
                'mmc_gender' => 'required',
                'mmc_email' => 'required|email|unique:mmc_students',
                'mmc_phone' => 'required|unique:mmc_students|numeric',
                'mmc_address' => 'required',
                'mmc_ethnic' => 'required',
                'mmc_religion' => 'required',
                'mmc_personalid' => 'required|unique:mmc_students|numeric',
            ],
            [
                'mmc_studentid.required' => 'Mã sinh viên không được để trống',
                'mmc_classid.required' => 'Lớp không được để trống',
                'mmc_fullname.required' => 'Họ tên không được để trống',
                'mmc_dateofbirth.required' => 'Ngày sinh không được để trống',
                'mmc_gender.required' => 'Giới tính không được để trống',
                'mmc_email.required' => 'Email không được để trống',
                'mmc_phone.required' => 'Số điện thoại không được để trống',
                'mmc_address.required' => 'Đại chỉ không được để trống',
                'mmc_ethnic.required' => 'Dân tộc không được để trống',
                'mmc_religion.required' => 'Tôn giáo không được để trống',
                'mmc_personalid.required' => 'Số CMND không được để trống',

                'mmc_studentid.unique' => 'Mã sinh viên đã tồn tại',
                'mmc_email.unique' => 'Email đã tồn tại',
                'mmc_phone.unique' => 'Số điện thoại đã tồn tại',
                'mmc_personalid.unique' => 'Số CMND đã tồn tại',

                'mmc_email.email' => 'Bạn phải nhập đúng định dạng email',

                'mmc_phone.numeric' => 'Số điện thoại không hợp lệ',
                'mmc_personalid.numeric' => 'Số CMND không hợp lệ',
            ]
        );
        $data=$request->all();
        if( mmc_Student::create($data)){
            unset($data['_token']);
            unset($data['_method']);
            return redirect('homeStudent')->with('status', 'Thêm sinh viên thành công!');
        }
        return back()->withInput();
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
        Hàm show dùng để lấy thông tin của 1 SV có id=$id để phục vụ cho chức năng xem thông tin chi tiết của sinh viên.
        $data_class để chữa thông tin của các lớp.
        $data để chữa dữ liệu sinh viên đã truy vấn.
     */
    public function show($id)
    {
        $data_class=mmc_class::get();
        $data= mmc_Student::find($id);
        return view('admin.Student.mmc_detailStudent', ['data'=>$data , "data_class"=>$data_class]);
    }

    /**
        Hàm edit dùng để lấy thông tin của 1 SV có id=$id để phục vụ cho chức năng sửa thông tin sinh viên.
        $data_class để chữa thông tin của các lớp.
        $data để chữa dữ liệu sinh viên đã truy vấn.
     */
    public function edit($id)
    {
        //
        $data_class=mmc_class::get();
        $data= mmc_Student::find($id);
        return view('admin.Student.mmc_editStudent', ['data'=>$data , "data_class"=>$data_class]);
    }

    /**
        Hàm update dùng để lưu thông tin của sinh viên sau khi đã sửa vào trong csdl.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'mmc_studentid' => 'required|unique:mmc_students,mmc_studentid,'.$id,
                'mmc_classid' => 'required',
                'mmc_fullname' => 'required',
                'mmc_dateofbirth' => 'required',
                'mmc_gender' => 'required',
                'mmc_email' => 'required|email|unique:mmc_students,mmc_email,'.$id,
                'mmc_phone' => 'required|numeric|unique:mmc_students,mmc_phone,'.$id,
                'mmc_address' => 'required',
                'mmc_ethnic' => 'required',
                'mmc_religion' => 'required',
                'mmc_personalid' => 'required|numeric|unique:mmc_students,mmc_personalid,'.$id,
            ],
            [
                'mmc_studentid.required' => 'Mã sinh viên không được để trống',
                'mmc_classid.required' => 'Lớp không được để trống',
                'mmc_fullname.required' => 'Họ tên không được để trống',
                'mmc_dateofbirth.required' => 'Ngày sinh không được để trống',
                'mmc_gender.required' => 'Giới tính không được để trống',
                'mmc_email.required' => 'Email không được để trống',
                'mmc_phone.required' => 'Số điện thoại không được để trống',
                'mmc_address.required' => 'Đại chỉ không được để trống',
                'mmc_ethnic.required' => 'Dân tộc không được để trống',
                'mmc_religion.required' => 'Tôn giáo không được để trống',
                'mmc_personalid.required' => 'Số CMND không được để trống',

                'mmc_studentid.unique' => 'Mã sinh viên đã tồn tại',
                'mmc_email.unique' => 'Email đã tồn tại',
                'mmc_phone.unique' => 'Số điện thoại đã tồn tại',
                'mmc_personalid.unique' => 'Số CMND đã tồn tại',

                'mmc_email.email' => 'Bạn phải nhập đúng định dạng email',

                'mmc_phone.numeric' => 'Số điện thoại không hợp lệ',
                'mmc_personalid.numeric' => 'Số CMND không hợp lệ',
            ]
        );
            $Student= mmc_Student::find($id);
            $data=$request->all();
            if($Student->update($data)){
                unset($data['_token']);
                unset($data['_method']);
                return redirect('homeStudent')->with('status', 'Sửa sinh viên thành công!');
            }

    }

    /**
        Hàm destroy dùng để xoá một sinh viên có id = $id khỏi csdl.
     */
    public function destroy($id)
    {
        mmc_Student::destroy($id);
        return back()->with('status', 'Xoá sinh viên thành công!');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {
       return view('import');
    }

    /**
        Hàm export dùng để xuất ra danh sách tất cả các sinh viên có trong CSDL ra file excel có tên: Danh-sach-sinh-vien.xlsx .
    */
    public function export()
    {
        return Excel::download(new mmc_StudentExport, 'Danh-sach-sinh-vien.xlsx');
        return back();
    }

    /**
        Hàm import dùng để thêm thông tin của những sinh viên có trong 1 file excel vào trong csdl sinh viên. (Cần có chuẩn file excel để hệ thống không bị lỗi khi thêm)
    */
    public function import()
    {
        $import = new mmc_StudentImport();
        $import->import(request()->file('file'));
        $failures = $import->failures();

        //Dùng để kiểm tra có dữ liệu nào không hợp lệ hay không.
        if (!empty($failures))
        {
            $errors=[];
                foreach ($failures as $key=>$error)//Lấy được cả key và value
                {
                    $arrerror="";
                    foreach ($error->errors() as $item)
                    {
                        $arrerror.="Dòng ".$error->row()." lỗi ".$item;
                    }
                    $errors[]=$arrerror;
                }
            return back()->withErrors($errors);
        }
        return back()->with('status', 'Import thành công!');;
    }


    public static function getclassId($id)
    {
        return mmc_class::where('mmc_classname', '=', "$id")->value('mmc_classid');
    }

    /**
        Hàm downloadfileExcel để giúp người dùng tải xuống file excel mẫu. để phục vụ cho việc thêm sinh viên từ file excel.
    */
    public function downloadfileExcel(){
        $filename= "mau-them-sinh-vien.xlsx";
        return response()->download(storage_path('file/' . $filename));
    }
}
