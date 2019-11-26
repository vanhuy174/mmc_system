<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\mmc_department;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DepartmentController extends Controller
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
            $department = mmc_department::where('mmc_deptname', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        } else {
            $department = mmc_department::latest()->paginate($perPage);
        }
        return view('admin.department.index', compact('department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.department.create');
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
            'mmc_deptname'=>'required|unique:mmc_departments,mmc_deptname',
        ],[
<<<<<<< HEAD
            'mmc_deptname.required'=>'Tên bộ môn hông được bỏ trống',
            'mmc_deptname.unique'=>'Tên bộ môn đã tồn tại'
=======
            'mmc_deptname.required'=>'Tên bộ môn không được bỏ trống',
            'mmc_deptname.unique'=>'Tên bộ môn đã tồn tại'

>>>>>>> tvduong
        ]);
        $department=new mmc_department();
        $department->mmc_deptid="mmc-".Str::slug($request->mmc_deptname);
        $department->mmc_deptname=$request->mmc_deptname;
        $department->mmc_description=$request->mmc_description;
        $department->save();
        return redirect('admin/department');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = mmc_department::findOrFail($id);
        return view('admin.department.edit', compact('department'));
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
            'mmc_deptname'=>'required|unique:mmc_departments,mmc_deptname,'.$id,
        ],[
            'mmc_deptname.required'=>'Tên bộ môn hông được bỏ trống',
            'mmc_deptname.unique'=>'Tên bộ môn đã tồn tại'
        ]);
        $requestData = $request->all();
        $department = mmc_department::findOrFail($id);
        $department['mmc_deptid']="mmc-".Str::slug($request->mmc_deptname);
        $department->update($requestData);
        return redirect('admin/department')->with('flash_message', 'Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        mmc_department::destroy($id);
        return redirect('admin/department')->with('flash_message', 'Xóa thành công!');//
    }
}
