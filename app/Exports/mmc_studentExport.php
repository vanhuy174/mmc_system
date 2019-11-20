<?php

namespace App\Exports;

use App\mmc_student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class mmc_studentExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function view(): View
    {
        return view('Student.mmc_formExport', [
            'datas' => mmc_student::all()
        ]);
    }
}
