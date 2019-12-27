<?php

namespace App\Exports;

use App\mmc_student;
use App\mmc_class;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class mmc_studentExport implements FromView
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
        $dataclass= mmc_class::all();
        $classid= $this->requestall->malop;
        $majorid= $this->requestall->manghanh;
        $status= $this->requestall->status;
        if(!empty($majorid) && empty($classid) && empty($status)){
            $class= mmc_class::where('mmc_major', '=', $majorid)->get();
            if(!is_null($class)){
                $data= null;
                foreach ($class as $key){
                    $student= mmc_Student::where('mmc_classid', '=', $key->mmc_classid)->get();
                    if (is_null($data)){
                        if (!is_null($student)) {
                            $data = $student;
                        }
                    }else {
                        if (!is_null($student)) {
                            $data = $data->merge($student)->get();
                        }
                    }
                }
                return view('admin.Student.mmc_formExport', [
                    'datastudent' => $data,
                    'dataclass' => $dataclass
                ]);
            }else{
                $data= null;
                return view('admin.Student.mmc_formExport', [
                    'datastudent' => $data,
                    'dataclass' => $dataclass
                ]);
            }
        }else if(!empty($majorid) && empty($classid) && !empty($status)){
            $class= mmc_class::where('mmc_major', '=', $majorid)->get();
            if(!is_null($class)){
                $data= null;
                foreach ($class as $key){
                    $student= mmc_Student::where('mmc_classid', '=', $key->mmc_classid)->where('mmc_status', '=', $status)->latest();
                    if (is_null($data)){
                        if (!is_null($student)) {
                            $data = $student;
                        }
                    }else {
                        if (!is_null($student)) {
                            $data = $data->merge($student)->get();
                        }
                    }
                }
                return view('admin.Student.mmc_formExport', [
                    'datastudent' => $data,
                    'dataclass' => $dataclass
                ]);
            }else{
                $data= null;
                return view('admin.Student.mmc_formExport', [
                    'datastudent' => $data,
                    'dataclass' => $dataclass
                ]);
            }
        }else if(!empty($majorid) && !empty($classid) && empty($status)){
            $data= mmc_Student::where('mmc_classid', '=', $classid)->get();
            return view('admin.Student.mmc_formExport', [
                'datastudent' => $data,
                'dataclass' => $dataclass
            ]);
        }else if(!empty($majorid) && !empty($classid) && !empty($status)){
            $data= mmc_Student::where('mmc_classid', '=', $classid)->where('mmc_status', '=', $status)->get();
            return view('admin.Student.mmc_formExport', [
                'datastudent' => $data,
                'dataclass' => $dataclass
            ]);
        }else if(empty($majorid) && empty($classid) && !empty($status)){
            $data= mmc_Student::where('mmc_status', '=', $status)->get();
            return view('admin.Student.mmc_formExport', [
                'datastudent' => $data,
                'dataclass' => $dataclass
            ]);
        }else{
            $data = mmc_Student::all();
            return view('admin.Student.mmc_formExport', [
                'datastudent' => $data,
                'dataclass' => $dataclass
            ]);
        }
    }
}
