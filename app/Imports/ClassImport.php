<?php

namespace App\Imports;

use App\Http\Controllers\Admin\ClassController;
use App\mmc_class;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithValidation;



class ClassImport implements ToModel,WithHeadingRow,WithValidation,SkipsOnFailure
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable, SkipsFailures;
    public function model(array $row)
    {
        return new mmc_class([
            'mmc_classid'=>'mmc-'.Str::slug($row['ten_lop']),
            'mmc_classname'=> $row['ten_lop'],
            'mmc_major'    => ClassController::getmajorid($row['nganh']),
        ]);
    }
    public function headingRow(): int
    {
        return 2;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'ten_lop' => ['required','unique:mmc_classes,mmc_classname'],
            'nganh' => ['required',Rule::in(ClassController::getmajorname())],
        ];
    }
    public function customValidationMessages()
    {
        return [
            'ten_lop.required' => 'tên lớp không được bỏ trông',
            'ten_lop.unique'=>'tên lớp không được trùng',
            'nganh.required'=>'tgành không được bổ trống',
            'nganh.in'=>'ngành không tồn tại',
        ];
    }
    public function failures()
    {
        return $this->failures;
    }
}
