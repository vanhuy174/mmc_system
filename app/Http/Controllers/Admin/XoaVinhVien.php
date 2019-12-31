<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\mmc_employee_delete;
class XoaVinhVien extends Controller
{
    public function xoa($id){
        mmc_employee_delete::destroy($id);
        return redirect()->route('getXoa')->with('thongbao','đã xóa vĩnh viễn giảng viên thành công');
    }
}
