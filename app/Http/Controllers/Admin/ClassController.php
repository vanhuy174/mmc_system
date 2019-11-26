<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ClassImport;
use App\mmc_class;
use App\mmc_major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClassExport;
use Illuminate\Support\Arr;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


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

        if (!empty($keyword)) {
            $class = mmc_class::where('mmc_classname', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
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
        $major = mmc_major::select('mmc_majorid','mmc_majorname')->pluck('mmc_majorname','mmc_majorid');
        return view('admin.class.create',compact('major'));
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
        $major = mmc_major::select('mmc_majorid','mmc_majorname')->pluck('mmc_majorname','mmc_majorid');
        $class= mmc_class::findOrFail($id);
        return view('admin.class.edit', compact('class','major'));
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
    public static function getmajorid($id)
    {
        return mmc_major::where('mmc_majorname', '=', "$id")->value('mmc_majorid');
    }
    public static function getmajorname()
    {
        return mmc_major::get()->pluck('mmc_majorname');
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
}
