<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ClassImport;
use App\mmc_class;
use App\mmc_department;
use App\mmc_education;
use App\mmc_employee;
use App\mmc_major;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClassExport;



class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 5;
        if (!empty($keyword)){
            $major= mmc_major::where('mmc_majorname', 'LIKE', "%$keyword%")->pluck('mmc_majorid');
            $employ=mmc_employee::where('mmc_name', 'LIKE', "%$keyword%")->pluck('mmc_employeeid');
            $class = mmc_class::where('mmc_classname', 'LIKE', "%$keyword%")->orwhereIn('mmc_major',$major)->orwhereIn('mmc_headteacher',$employ)->latest()->paginate($perPage);
        } else {
            $class = mmc_class::latest()->paginate($perPage);
        }
        return view('admin.class.index', compact('class'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $majorf = mmc_major::first();
        $education= mmc_education::where('mmc_majorid','=',$majorf->mmc_majorid)->get();
        $employee=mmc_employee::select('mmc_employeeid','mmc_name','mmc_deptid')->get();
        $department = mmc_department::select('mmc_deptid','mmc_deptname')->get();
        $major = mmc_major::select('mmc_majorid','mmc_majorname')->pluck('mmc_majorname','mmc_majorid');
        return view('admin.class.create',compact('major','employee','department','education'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'mmc_classname'=>'required|unique:mmc_classes,mmc_classname',
        ],[
            'mmc_classname.required'=>'Tên lớp hông được bỏ trống',
            'mmc_classname.unique'=>'Tên lớp đã tồn tại'
        ]);
        $class=new mmc_class();
        $class->mmc_classid="mmc-".Str::slug($request->mmc_classname);
        $class->mmc_ctdt=$request->mmc_ctdt;
        $class->mmc_classname=$request->mmc_classname;
        $class->mmc_major=$request->mmc_major;
        $class->mmc_headteacher=$request->mmc_headteacher;
        $class->mmc_monitor=$request->mmc_monitor;
        $class->mmc_vicemonitor=$request->mmc_vicemonitor;
        $class->mmc_secretary=$request->mmc_secretary;
        $class->mmc_vicesecretary1=$request->mmc_vicesecretary1;
        $class->mmc_vicesecretary2=$request->mmc_vicesecretary2;
        $class->mmc_description=$request->mmc_description;
        $class->mmc_numstudent=$request->mmc_numstudent;
        $class->save();
        return redirect('admin/class')->with('flash_message', 'Thêm mới thành công!');
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

        $employee=mmc_employee::select('mmc_employeeid','mmc_name','mmc_deptid')->get();
        $department = mmc_department::select('mmc_deptid','mmc_deptname')->get();
        $major = mmc_major::select('mmc_majorid','mmc_majorname')->pluck('mmc_majorname','mmc_majorid');
        $class= mmc_class::findOrFail($id);
        $education= mmc_education::where('mmc_majorid','=',$class->mmc_major)->get();
        return view('admin.class.edit', compact('class','major','employee','department','education'));
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
        $this->validate($request,[
            'mmc_classname'=>'required|unique:mmc_classes,mmc_classname,'.$id,
        ],[
            'mmc_classname.required'=>'Tên lớp hông được bỏ trống',
            'mmc_classname.unique'=>'Tên lớp đã tồn tại'
        ]);
        $requestData = $request->all();
        $class = mmc_class::findOrFail($id);
        $class['mmc_classid']="mmc-".Str::slug($request->mmc_classname);
        $class->update($requestData);
        return redirect('admin/class')->with('flash_message', 'Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        mmc_class::destroy($id);
        return redirect('admin/class')->with('flash_message', 'Xóa thành công!');
    }
    public static function getmajor($id)
    {
        return $major = mmc_major::where('mmc_majorid', '=', "$id")->value('mmc_majorname');
    }
    public static function getemployee($id)
    {
        return  mmc_employee::where('mmc_employeeid', '=', "$id")->value('mmc_name');
    }
    public static function getmajorid($id)
    {
        return mmc_major::where('mmc_majorname', '=', "$id")->value('mmc_majorid');
    }
    public static function getmajorname()
    {
        return mmc_major::get()->pluck('mmc_majorname');
    }
    public static function count()
    {
        return mmc_class::count();
    }
    public function export()
    {
        return Excel::download(new ClassExport, 'classes.xlsx');
    }
    public function import(Request $request)
    {

        $import = new ClassImport();
        $import->import($request->file('file'));
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
        return back()->with('flash_message', 'Import thành công!');
    }
    public static function getidemployee($id)
    {
        return mmc_employee::where('mmc_employeeid','=',$id)->value('id');
    }
}
