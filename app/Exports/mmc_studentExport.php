<?php

namespace App\Exports;

use App\mmc_student;
use App\mmc_class;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class mmc_studentExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function view(): View
    {
        $datastudent= mmc_student::all();
    	$dataclass= mmc_class::all();
        return view('admin.Student.mmc_formExport', [
            'datastudent' => $datastudent, 
            'dataclass' => $dataclass 
        ]);
    }
}
