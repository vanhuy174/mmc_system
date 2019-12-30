<?php

namespace App\Exports;

use App\mmc_class;
use App\mmc_student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class studentpointExport implements FromView
{
    public $requestall;
    public function __construct(Request $request)
    {
        $this->requestall= $request;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $dataclass= mmc_class::get();
        $classid= $this->requestall->malop;
        $majorid= $this->requestall->manghanh;
        $hocky= $this->requestall->hocky;
        $status= $this->requestall->status;
        $data= null;
        if(!empty($majorid) && empty($classid) && empty($hocky) && empty($status)) {
            $class = mmc_class::Where('mmc_major', '=', $majorid)->get();
            if (!is_null($class)) {
                $data = null;
                foreach ($class as $key) {
                    $student = mmc_student::where('mmc_classid', '=', $key->mmc_classid)->get();
                    if (is_null($data)) {
                        if (!is_null($student)) {
                            $data = $student;
                        }
                    } else {
                        if (!is_null($student)) {
                            $data = $data->merge($data);
                        }
                    }
                }

            }
        }
        elseif(!empty($majorid) && !empty($classid) && empty($hocky) && empty($status)){
            $data = mmc_Student::where('mmc_classid', '=', $classid)->get();
        }
        elseif(!empty($majorid) && empty($classid) && !empty($hocky) && empty($status)){
            $class = mmc_class::Where('mmc_major', '=', $majorid)->get();
            if (!is_null($class)) {
                foreach ($class as $key) {
                    $student = mmc_student::where('mmc_classid', '=', $key->mmc_classid)->get();
                    if (is_null($data)) {
                        if (!is_null($student)) {
                            $data = $student;
                        }
                    } else {
                        if (!is_null($student)) {
                            $data = $data->merge($student);
                        }
                    }
                }
            }
        }
        elseif(!empty($majorid) && empty($classid) && empty($hocky) && !empty($status)){
            $class = mmc_class::Where('mmc_major', '=', $majorid)->get();
            if (!is_null($class)) {
                foreach ($class as $key) {
                    $student = mmc_student::where('mmc_classid', '=', $key->mmc_classid)->get();
                    if (!is_null($student)) {
                        foreach ($student as $key) {
                            $point = $key->pointdetail->mmc_4grade;
                            if (tinhhocluc($point) === $status) {
                                if (is_null($data)) {
                                    $data = mmc_student::where('id', '=', $key->id)->get();
                                } else {
                                    $data = $data->merge(mmc_student::where('id', '=', $key->id)->get());
                                }
                            }
                        }
                    }
                }
            }
        }
        elseif(!empty($majorid) && !empty($classid) && !empty($hocky) && empty($status)){
            $data= mmc_student::where('mmc_classid', '=', $classid)->get();
        }
        elseif(!empty($majorid) && !empty($classid) && empty($hocky) && !empty($status)){
            $student= mmc_student::where('mmc_classid', '=', $classid)->get();
            if (!is_null($student)) {
                foreach ($student as $key) {
                    $point = $key->pointdetail->mmc_4grade;
                    if (tinhhocluc($point) === $status) {
                        if (is_null($data)) {
                            $data = mmc_student::where('id', '=', $key->id)->get();
                        } else {
                            $data = $data->merge(mmc_student::where('id', '=', $key->id)->get());
                        }
                    }
                }
            }
        }
        elseif(!empty($majorid) && !empty($classid) && !empty($hocky) && !empty($status)){
            $student= mmc_student::where('mmc_classid', '=', $classid)->get();
            if (!is_null($student)) {
                $i = 0;
                foreach ($student as $key) {
                    $point = $key->pointdetail->mmc_4grade;
                    if (tinhhocluc($point) === $status) {
                        if (is_null($data)) {
                            $data = mmc_student::where('id', '=', $key->id)->latest();
                        } else {
                            $data = $data->merge(mmc_student::where('id', '=', $key->id)->get());
                        }
                    }
                }
            }
        }
        else{
            $data = mmc_student::get();
        }
        return view('admin.point.formExport', [
            'data' => $data,
            'dataclass' => $dataclass,
        ]);
    }
}
