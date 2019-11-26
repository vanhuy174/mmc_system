<?php

namespace App\Imports;

use App\Http\Controllers\Admin\ClassController;
use App\mmc_subject;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class SubjectImport implements ToModel,WithHeadingRow,WithValidation,SkipsOnFailure
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable, SkipsFailures;
    public function model(array $row)
    {
        return new mmc_subject([
            'mmc_subjectid'=>'mmc-'.Str::slug($row['ten_mon_hoc']),
            'mmc_subjectname'=> $row['ten_mon_hoc'],
            'mmc_tinchi' => $row['so_tin_chi'],
        ]);
    }
    public function headingRow(): int
    {
        return 2;
    }
    /**
     * @param Failure[] $failures
     */
    public function failures()
    {
        return $this->failures;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [

        ];
    }
    public function customValidationMessages()
    {
        return [

        ];
    }
}
