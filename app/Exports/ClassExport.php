<?php

namespace App\Exports;

use App\mmc_class;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class ClassExport implements FromView,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function title(): string
    {
        return 'Vouchers';
    }

    public function view(): View
    {
        return view('export.classes', [
            'classes' => mmc_class::all()
        ]);
    }
}
