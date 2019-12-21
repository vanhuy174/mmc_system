<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\mmc_class;
use App\mmc_student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OneClassController extends Controller
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
        $idgv=Auth::user()->mmc_employeeid;
        $idlop=mmc_class::where('mmc_headteacher', '=', "$idgv")->value('mmc_classid');

        if($idlop!=null)
        {

            $lop=mmc_class::where('mmc_headteacher', '=', "$idgv")->first();

            if (!empty($keyword)) {
                $student = mmc_student::where('mmc_classid', '=', "$idlop")->where(function ($query) use ($keyword) {
                    $query->where('mmc_studentid', 'LIKE', "%$keyword%")
                        ->orwhere('mmc_fullname', 'LIKE',"%$keyword%");
                })->get();
            } else {
                $student = mmc_student::where('mmc_classid', '=', "$idlop")->get();
                $member= count($student);
            }
            return view('admin.oneclass.index',compact('student','lop', 'member'));
        }
        else
        {
            $flash_message='Giáo viên không chủ nhiệm lớp nào!';
            return view('admin.oneclass.index',compact('flash_message'));
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
}
