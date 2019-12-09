<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\mmc_department;
use App\mmc_education;
use App\mmc_educationprogram;
use App\mmc_major;
use App\mmc_subject;
use Illuminate\Http\Request;

class EducationProgramController extends Controller
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
            $education = mmc_education::whereIn('mmc_major',$major)->latest()->paginate($perPage);
        } else {
            $education = mmc_education::latest()->paginate($perPage);
        }
        return view('admin.educationprogram.index',compact('education'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $major = mmc_major::select('mmc_majorid','mmc_majorname')->pluck('mmc_majorname','mmc_majorid');
        $subject = mmc_subject::select('mmc_subjectid','mmc_subjectname')->pluck('mmc_subjectname','mmc_subjectid');
        return view('admin.educationprogram.create',compact('subject','major'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( mmc_education::where('mmc_majorid','=','$request->mmc_majorid')->where('mmc_course','=','$request->mmc_course')->get()==null)
        {
            $sum = 0;
            for ($i = 0; $i < count($request->gddc); $i++) {
                $educationprogram = new mmc_educationprogram();
                $educationprogram->mmc_majorid = $request->mmc_majorid;
                $educationprogram->mmc_course = $request->mmc_course;
                $educationprogram->mmc_subjectid = $request->gddc[$i];
                $educationprogram->mmc_semester = $request->gddcky[$i];
                $sum += SubjectController::gettinchi($request->gddc[$i]);
                $educationprogram->mmc_classify = "KKTGDDC";
                $educationprogram->save();
            }
            for ($i = 0; $i < count($request->csn); $i++) {
                $educationprogram = new mmc_educationprogram();
                $educationprogram->mmc_majorid = $request->mmc_majorid;
                $educationprogram->mmc_course = $request->mmc_course;
                $educationprogram->mmc_subjectid = $request->csn[$i];
                $educationprogram->mmc_semester = $request->csnky[$i];
                $educationprogram->mmc_classify = "KKTCSN";
                $sum += SubjectController::gettinchi($request->csn[$i]);
                $educationprogram->save();
            }
            for ($i = 0; $i < count($request->cn); $i++) {
                $educationprogram = new mmc_educationprogram();
                $educationprogram->mmc_majorid = $request->mmc_majorid;
                $educationprogram->mmc_course = $request->mmc_course;
                $educationprogram->mmc_subjectid = $request->cn[$i];
                $educationprogram->mmc_semester = $request->cnky[$i];
                $educationprogram->mmc_classify = "KKTCN";
                $sum += SubjectController::gettinchi($request->cn[$i]);
                $educationprogram->save();
            }
            for ($i = 0; $i < count($request->tn); $i++) {
                $educationprogram = new mmc_educationprogram();
                $educationprogram->mmc_majorid = $request->mmc_majorid;
                $educationprogram->mmc_course = $request->mmc_course;
                $educationprogram->mmc_subjectid = $request->tn[$i];
                $educationprogram->mmc_semester = $request->tnky[$i];
                $sum += SubjectController::gettinchi($request->tn[$i]);
                $educationprogram->mmc_classify = "TTKLTN";
                $educationprogram->save();
            }
            if (isset($request->gddctc))
                for ($i = 0; $i < count($request->gddctc); $i++) {
                    $educationprogram = new mmc_educationprogram();
                    $educationprogram->mmc_majorid = $request->mmc_majorid;
                    $educationprogram->mmc_course = $request->mmc_course;
                    $educationprogram->mmc_subjectid = $request->gddctc[$i];
                    $educationprogram->mmc_semester = $request->gddctcky[$i];
                    $sum += SubjectController::gettinchi($request->gddctc[$i]);
                    $educationprogram->mmc_elective = $request->gddcnhom[$i];
                    $educationprogram->mmc_classify = "KKTGDDC";
                    $educationprogram->save();
                }
            if (isset($request->csntc))
                for ($i = 0; $i < count($request->csntc); $i++) {
                    $educationprogram = new mmc_educationprogram();
                    $educationprogram->mmc_majorid = $request->mmc_majorid;
                    $educationprogram->mmc_course = $request->mmc_course;
                    $educationprogram->mmc_subjectid = $request->csntc[$i];
                    $educationprogram->mmc_semester = $request->csntcky[$i];
                    $educationprogram->mmc_classify = "KKTCSN";
                    $sum += SubjectController::gettinchi($request->csntc[$i]);
                    $educationprogram->mmc_elective = $request->csnnhom[$i];
                    $educationprogram->save();
                }
            if (isset($request->cntc))
                for ($i = 0; $i < count($request->cntc); $i++) {
                    $educationprogram = new mmc_educationprogram();
                    $educationprogram->mmc_majorid = $request->mmc_majorid;
                    $educationprogram->mmc_course = $request->mmc_course;
                    $educationprogram->mmc_subjectid = $request->cntc[$i];
                    $educationprogram->mmc_semester = $request->cntcky[$i];
                    $educationprogram->mmc_classify = "KKTCN";
                    $sum += SubjectController::gettinchi($request->cntc[$i]);
                    $educationprogram->mmc_elective = $request->cnnhom[$i];
                    $educationprogram->save();
                }
            if (isset($request->tntc))
                for ($i = 0; $i < count($request->tntc); $i++) {
                    $educationprogram = new mmc_educationprogram();
                    $educationprogram->mmc_majorid = $request->mmc_majorid;
                    $educationprogram->mmc_course = $request->mmc_course;
                    $educationprogram->mmc_subjectid = $request->tntc[$i];
                    $educationprogram->mmc_semester = $request->tntcky[$i];
                    $sum += SubjectController::gettinchi($request->tntc[$i]);
                    $educationprogram->mmc_classify = "TTKLTN";
                    $educationprogram->mmc_elective = $request->tnnhom[$i];
                    $educationprogram->save();
                }
            $education = new mmc_education();
            $education->mmc_majorid = $request->mmc_majorid;
            $education->mmc_course = $request->mmc_course;
            $education->mmc_total = $sum;
            $education->save();
            return redirect('admin/educationprogram')->with('flash_message', 'Thêm mới thành công!');
        }
        else{
            return back()->with('flash_message','Chương trình đào tạo này đã tồn tại')->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $majorid = mmc_education::where('id', '=', "$id")->value('mmc_majorid');
        $course = mmc_education::where('id', '=', "$id")->value('mmc_course');
        $educationprogram=mmc_educationprogram::where('mmc_majorid', '=', "$majorid")->where('mmc_course', '=', "$course")->get();
        $educationprogramtcdc=mmc_educationprogram::where('mmc_majorid', '=', "$majorid")->where('mmc_course', '=', "$course")->where('mmc_classify', '=', "KKTGDDC")->where('mmc_elective', '!=', null)->get();
        $educationprogramtccsn=mmc_educationprogram::where('mmc_majorid', '=', "$majorid")->where('mmc_course', '=', "$course")->where('mmc_classify', '=', "KKTCSN")->where('mmc_elective', '!=', null)->get();
        $educationprogramtccn=mmc_educationprogram::where('mmc_majorid', '=', "$majorid")->where('mmc_course', '=', "$course")->where('mmc_classify', '=', "KKTCN")->where('mmc_elective', '!=', null)->get();
        $educationprogramtctn=mmc_educationprogram::where('mmc_majorid', '=', "$majorid")->where('mmc_course', '=', "$course")->where('mmc_classify', '=', "TTKLTN")->where('mmc_elective', '!=', null)->get();
        return view('admin.educationprogram.show',compact('majorid','course','educationprogram','educationprogramtcdc','educationprogramtccsn','educationprogramtccn','educationprogramtctn'));
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
