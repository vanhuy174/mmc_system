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
            'mmc_subjectid'=>'mmc-'.Str::slug($row['ten_mon_hoc']),
            'mmc_subjectname'=> $row['ten_mon_hoc'],
            'mmc_tinchi' => $row['so_tin_chi'],
        ]);
    }
    public function headingRow(): int
    {
        return 2;
    }
    public function rules(): array
    {
        return [
            'ten_mon_hoc' => ['required','unique:mmc_subjects,mmc_subjectname'],
            'so_tin_chi' => ['required','numeric','max:5','min:1'],
        ];
    }
    public function customValidationMessages()
    {
        return [
            'ten_mon_hoc.required' => 'tên môn học không được bỏ trông',
            'ten_mon_hoc.unique'=>'tên môn học không được trùng',
            'so_tin_chi.required'=>'số tín chỉ không được bỏ trống',
            'so_tin_chi.max'=>'Số tín chỉ phải nhỏ hơn 5',
            'so_tin_chi.min'=>'Số tín chỉ phải lớn hơn 1',
        ];
    }
    public function failures()
    {
        return $this->failures;
    }

}
