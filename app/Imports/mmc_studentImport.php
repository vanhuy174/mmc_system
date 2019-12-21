<?php

namespace App\Imports;

use App\mmc_student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Validators\Failure;
use App\Http\Controllers\Admin\mmc_ControllerStudent;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Validation\Rule;



class mmc_studentImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{

    use Importable, SkipsFailures;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new mmc_student([
            'mmc_studentid'     => $row['ma_sinh_vien'],
            'mmc_classid'    => mmc_ControllerStudent::getclassId($row['ten_lop']),
            'mmc_fullname'    => $row['ho_va_ten'],
            'mmc_dateofbirth'    => mmc_ControllerStudent::setdate($row['ngay_sinh']),
            'mmc_gender'    => mmc_ControllerStudent::setgender($row['gioi_tinh']),
            'mmc_email'    => $row['email'],
            'mmc_phone'    => $row['so_dien_thoai'],
            'mmc_address'    => $row['ho_khau_thuong_tru'],
            'mmc_ethnic'    => $row['dan_toc'],
            'mmc_religion'    => $row['ton_giao'],
            'mmc_reward'    => $row['khen_thuong'],
            'mmc_descipline'    => $row['ky_luat'],
            'mmc_personalid'    => $row['so_cmnd'],
            'mmc_course'    => $row['khoa'],
            'mmc_status'    => 'danghoc',
            'mmc_father'    => $row['ho_ten_bo'],
            'mmc_fathernationality'    => $row['quoc_tich_bo'],
            'mmc_fatherethnic'    => $row['dan_toc_bo'],
            'mmc_fatherreligion'    => $row['ton_giao_bo'],
            'mmc_fatheraddress'    => $row['ho_khau_thuong_tru_bo'],
            'mmc_fatherphone'    => $row['so_dien_thoai_bo'],
            'mmc_fatheremail'    => $row['email_bo'],
            'mmc_fatherjob'    => $row['nghe_ngiep_bo'],
            'mmc_mother'    => $row['ho_ten_me'],
            'mmc_mothernationality'    => $row['quoc_tich_me'],
            'mmc_motherethnic'    => $row['dan_toc_me'],
            'mmc_motherreligion'    => $row['ton_giao_me'],
            'mmc_motheraddress'    => $row['ho_khau_thuong_tru_me'],
            'mmc_motherphone'    => $row['so_dien_thoai_me'],
            'mmc_motheremail'    => $row['email_me'],
            'mmc_motherjob'    => $row['nghe_ngiep_me'],
        ]);
    }

    public function headingRow(): int
    {
        return 3;
    }

    public function rules(): array
    {
        return [
            'ma_sinh_vien' => ['required','unique:mmc_students,mmc_studentid'],
            'ten_lop' => ['required',Rule::in(mmc_ControllerStudent::getclassname())],
            'ho_va_ten' => 'required',
            'ngay_sinh' => 'required',
            'gioi_tinh' => 'required',
            'email' => ['required','email','unique:mmc_students,mmc_email'],
            'so_dien_thoai' => ['required','numeric','unique:mmc_students,mmc_phone'],
            'ho_khau_thuong_tru' => 'required',
            'dan_toc' => 'required',
            'ton_giao' => 'required',
            'so_cmnd' => ['required','numeric','unique:mmc_students,mmc_personalid'],
        ];

    }

    public function customValidationMessages()
    {
        return [
            'ma_sinh_vien.required' => 'Mã sinh viên không được để trống',
            'ten_lop.required' => 'Lớp không được để trống',
            'ho_va_ten.required' => 'Họ tên không được để trống',
            'ngay_sinh.required' => 'Ngày sinh không được để trống',
            'gioi_tinh.required' => 'Giới tính không được để trống',
            'email.required' => 'Email không được để trống',
            'so_dien_thoai.required' => 'Số điện thoại không được để trống',
            'ho_khau_thuong_tru.required' => 'Đại chỉ không được để trống',
            'dan_toc.required' => 'Dân tộc không được để trống',
            'ton_giao.required' => 'Tôn giáo không được để trống',
            'so_cmnd.required' => 'Số CMND không được để trống',

            'ma_sinh_vien.unique' => 'Mã sinh viên đã tồn tại',
            'email.unique' => 'Email đã tồn tại',
            'so_dien_thoai.unique' => 'Số điện thoại đã tồn tại',
            'so_cmnd.unique' => 'Số CMND đã tồn tại',

            'email.email' => 'Bạn phải nhập đúng định dạng email',

            'so_dien_thoai.numeric' => 'Số điện thoại không hợp lệ',
            'so_cmnd.numeric' => 'Số CMND không hợp lệ',
            'ten_lop.in'=>'Lớp không tồn tại',
        ];
    }
    public function failure()
    {
        return $this->failures;

    }

}
