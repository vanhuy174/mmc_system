<?php

namespace App\Imports;


use App\mmc_subject;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

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
            'mmc_subjectid'=>$row['ma_hoc_phan'],
            'mmc_subjectname'=> $row['ten_hoc_phan'],
            'mmc_theory' => $row['so_tin_ly_thuyet'],
            'mmc_practice' => $row['so_tin_thuc_hanh'],
        ]);
    }
    public function headingRow(): int
    {
        return 1;
    }
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
    public function failures()
    {
        return $this->failures;
    }

}
