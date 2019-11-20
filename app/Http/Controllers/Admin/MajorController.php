<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\mmc_department;
use App\mmc_major;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MajorController extends Controller
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
            $major = mmc_major::where('mmc_majorname', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        } else {
            $major = mmc_major::latest()->paginate($perPage);
        }
        return view('admin.major.index', compact('major'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department = mmc_department::select('mmc_deptid','mmc_deptname')->get();
        return view('admin.major.create',compact('department'));
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
            'mmc_majorname'=>'required|unique:mmc_majors',
        ],[
            'mmc_majorname.required'=>'Tên ngành hông được bỏ trống',
            'mmc_majorname.unique'=>'Tên ngành đã tồn tại'
        ]);
        $major=new mmc_major();
        $major->mmc_majorid="mmc-".Str::slug($request->mmc_majorname);
        $major->mmc_deptid=$request->mmc_deptid;
        $major->mmc_majorname=$request->mmc_majorname;
        $major->mmc_description=$request->mmc_description;
        $major->save();
        return redirect('admin/major');
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
        $department = mmc_department::select('mmc_deptid','mmc_deptname')->get();
        $major= mmc_major::findOrFail($id);
        return view('admin.major.edit', compact('department','major'));
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
            'mmc_majorname'=>'required|unique:mmc_majors,mmc_majorname,'.$id,
        ],[
            'mmc_majorname.required'=>'Tên ngành hông được bỏ trống',
            'mmc_majorname.unique'=>'Tên ngành đã tồn tại'
        ]);
        $requestData = $request->all();
        $major = mmc_major::findOrFail($id);
        $major['mmc_deptid']="mmc-".Str::slug($request->mmc_deptname);
        $major->update($requestData);
        return redirect('admin/major')->with('flash_message', 'Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        mmc_major::destroy($id);
        return redirect('admin/major')->with('flash_message', 'Xóa thành công!');
    }
    public static function getDepartment($id)
    {
        try{
            return $department = mmc_department::where('mmc_deptid', '=', "$id")->value('mmc_deptname');
        }catch (\Exception $e)
        {
            return "";
        }
    }
}
