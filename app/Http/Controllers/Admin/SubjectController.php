<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\SubjectImport;
use App\mmc_subject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubjectController extends Controller
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
            $subject = mmc_subject::where('mmc_subjectname', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        } else {
            $subject = mmc_subject::latest()->paginate($perPage);
        }
        return view('admin.subject.index', compact('subject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subject.create');
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
            'mmc_subjectname'=>'required|unique:mmc_subjects,mmc_subjectname',
            'mmc_tinchi'=>'required|numeric|max:5|min:1'
        ],[
            'mmc_subjectname.required'=>'Tên môn học không được bỏ trống',
            'mmc_subjectname.unique'=>'Tên môn học đã tồn tại',
            'mmc_tinchi.required'=>'Số tín chỉ không được bỏ trống',
            'mmc_tinchi.max'=>'Số tín chỉ phải nhỏ hơn 5',
            'mmc_tinchi.min'=>'Số tín chỉ phải lớn hơn 1',

        ]);
        $subject=new mmc_subject();
        $subject->mmc_subjectid="mmc-".Str::slug($request->mmc_subjectname);
        $subject->mmc_subjectname=$request->mmc_subjectname;
        $subject->mmc_description=$request->mmc_description;
        $subject->mmc_tinchi=$request->mmc_tinchi;
        $subject->save();
        return redirect('admin/subject')->with('flash_message', 'Thêm mới thành công!');
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
        $subject= mmc_subject::findOrFail($id);
        return view('admin.subject.edit', compact('subject'));
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
            'mmc_subjectname'=>'required|unique:mmc_subjects,mmc_subjectname,'.$id,
            'mmc_tinchi'=>'required|numeric|max:5|min:1'
        ],[
            'mmc_subjectname.required'=>'Tên môn học không được bỏ trống',
            'mmc_subjectname.unique'=>'Tên môn học đã tồn tại',
            'mmc_tinchi.required'=>'Số tín chỉ không được bỏ trống',
            'mmc_tinchi.max'=>'Số tín chỉ phải nhỏ hơn 5',
            'mmc_tinchi.min'=>'Số tín chỉ phải lớn hơn 1',

        ]);
        $requestData = $request->all();
        $subject = mmc_subject::findOrFail($id);
        $subject['mmc_subjectid']="mmc-".Str::slug($request->mmc_subjectname);
        $subject->update($requestData);
        return redirect('admin/subject')->with('flash_message', 'Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        mmc_subject::destroy($id);
        return redirect('admin/subject')->with('flash_message', 'Xóa thành công!');
    }
    public function import(Request $request)
    {
        $import = new SubjectImport();
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
