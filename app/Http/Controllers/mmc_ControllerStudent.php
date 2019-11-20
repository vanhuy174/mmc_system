<?php

namespace App\Http\Controllers;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage= 10;
        $keyword= $request->search;
        if(!empty($keyword)){
             $data= mmc_Student::where('mmc_studentid', 'LIKE', "%$keyword%")->orWhere('mmc_fullname', 'LIKE', "%$keyword%")->orWhere('mmc_classid', 'LIKE', "%$keyword%")->orWhere('mmc_email', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
            return view('Student.mmc_homeStudent',compact("data"));
        }else{
            $data=mmc_Student::latest()->paginate($perPage);
            return view('Student.mmc_homeStudent',['data'=>$data]);
        }
    }

    public function getclass(){
    	$data=mmc_class::get();
        return view('Student.mmc_createStudent',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
        $data= mmc_Student::find($id);
        return view('Student.mmc_detailStudent', ['data'=>$data]);
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
        $data= mmc_Student::find($id);
        return view('Student.mmc_editStudent', ['data'=>$data]);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        mmc_Student::destroy($id);
        $request->session()->flash('status', 'Xoá sinh viên thành công!');
        return redirect('homeStudent');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {
       return view('import');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new mmc_StudentExport, 'Danh-sach-sinh-vien.xlsx');
        return back();
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        $import = new mmc_StudentImport();
        $import->import(request()->file('file'));
        $failures = $import->failures();
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
        return back()->with('flash_message', 'Import thành công!');;
    }

    public function downloadfileExcel(){
        $filename= "mau-them-sinh-vien.xlsx";
        return response()->download(storage_path('file/' . $filename));
    }
}
