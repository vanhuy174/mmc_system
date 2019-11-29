<?php

namespace App\Http\Controllers;
use App\mmc_department;
use App\mmc_employee;
use Image;
use DB;
use Validator;
use Illuminate\Http\Request;
use Propaganistas\LaravelPhone\PhoneNumber;
use Illuminate\Support\Facades\Hash;

class GiangVienController extends Controller
{
    // danh sách giảng viên
    public function getDanhSachGV(){
        $danhsach = mmc_employee::select('id','mmc_name','mmc_employeeid','email','mmc_phone')->get();
        $danhsach = mmc_employee::paginate(5);
        return view('admin.GiangVien.DanhSachGV',['danhsach'=>$danhsach,'danhsach'=>$danhsach]);
    }
    // thêm giảng viên
    public function getThemGV(){
        $bomon = mmc_department::select('mmc_deptid','mmc_deptname')->get();

        // lấy mã giảng viên tự động tăng
        $id  = DB::table('mmc_employees')->max('id');
        $id = $id + 1;
        if($id<10){
            $ids = "MMC_GV_0".$id;
        }else{
            $ids = "MMC_GV_".$id;
        }

        return view('admin.GiangVien.ThemGV',['bomon'=>$bomon,'ids'=>$ids]);
        // $bomon = mmc_department::select('mmc_deptid','mmc_deptname')->get();
        // $id  = DB::table('mmc_employees')->max('id');
        // $id = $id + 1;
        // if($id<10){
        //     $deptid = "MMC_GV_0".$id;
        //     $phone = "086812218".$id;
        //     $email = "GiangVien".$id."@gmail.com";
        // }else{
        //     $deptid = "MMC_GV_".$id;
        //     $phone = "08681221".$id;
        //     $email = "GiangVien".$id."@gmail.com";
        // }
        // return view('admin.GiangVien.ThemGV',['bomon'=>$bomon,'deptid'=>$deptid,'phone'=>$phone,'email'=>$email]);
    }
    public function postThemGV(Request $request){

        $validator = Validator::make($request->all(),
        [
            'mmc_avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'mmc_employeeid'=>'unique:mmc_employees,mmc_employeeid',
            'email'=>'unique:mmc_employees,email|ends_with:gmail.com,ictu.edu.vn',
            'mmc_phone'=>'unique:mmc_employees,mmc_phone|phone:VN',
        ],
        [
            'mmc_avatar.image'=>'vui lòng chọn đúng ảnh',
            'mmc_avatar.mimes'=>'file ảnh phải có định dạng jpeg,png,jpg,gif,svg',
            'mmc_avatar.max'=>'kích thước ảnh phải nhỏ hơm 2 Mb',   
            'mmc_employeeid.unique'=>'Mã giảng viên đã tồn tại',
            'email.unique'=>'Email đã tồn tại',
            'email.ends_with'=>'email phải có định dạnh gmail.com hoặc ictu.edu.vn',
            'mmc_phone.unique'=>'Số điện thoại đã tồn tại',
            'mmc_phone.phone'=>'Vui lòng nhập đúng định dạng số điện thoại Việt Nam',
        ]);

        if ($validator->fails()) {
            return redirect()->route('get-them-giang-vien')
                ->withErrors($validator)
                ->withInput();
        }else{
            $them = new mmc_employee;
            $them->mmc_name = $request->mmc_name; //Họ và tên
            $them->mmc_employeeid = $request->mmc_employeeid; //Mã giảng viên
            $them->mmc_deptid = $request->mmc_deptid; //Mã bộ môn

            if($request->hasFile('mmc_avatar')){
                // luu anh vao csdl
                $file = $request->mmc_avatar;
                $name = $file->getClientOriginalName();

                $image_resize = Image::make($file->getRealPath());
                $image_resize->fit($width = 250, $height = 290, function ($constraint) {
                    $constraint->upsize();
                });
                $image_resize->save('IMG/'.$name);
                $them->mmc_avatar = $name; //Ảnh đại điện
            }
            $them->mmc_dateofbirth = $request->mmc_dateofbirth; //Ngày tháng và năm sinh
            $them->mmc_gender = $request->mmc_gender; //Giới tính
            $them->mmc_personalid = $request->mmc_personalid; //Số chứng minh nhân dân
            $them->mmc_dateofpid = $request->mmc_dateofpid; //Ngày cấp
            $them->mmc_socialinsuranceid = $request->mmc_socialinsuranceid; //Số bảo hiểm xã hội
            // định dạng lại số điện thoại
            $phone = PhoneNumber::make($request->mmc_phone, 'VN')->formatForMobileDialingInCountry('VN');
            $them->mmc_phone = $phone; //Số điện thoại

            $them->email = $request->email; //Email
            $them->password = Hash::make("mmc123456"); //Password 
            $them->mmc_religion = $request->mmc_religion; //Dân tộc
            $them->mmc_ethnic = $request->mmc_ethnic; //Tôn giáo
            $them->mmc_placeofbirth = $request->mmc_placeofbirth; //Nơi Sinh
            $them->mmc_hometown = $request->mmc_hometown; //Quê quán
            $them->mmc_address = $request->mmc_address; //Hộ khẩu thường trú

            $them->mmc_dateofrecruit= $request->mmc_dateofrecruit; //Ngày tuyển dụng
            $them->mmc_position= $request->mmc_position; //Chức vụ hiện tại
            $them->mmc_maintask= $request->mmc_maintask; //Công việc chính được giao

            $them->mmc_nameofjob= $request->mmc_nameofjob; //Ngạch công chức
            $them->mmc_codeofjob= $request->mmc_codeofjob; //Mã ngạch
            $them->mmc_salarylevel= $request->mmc_salarylevel; //Bậc lương
            $them->mmc_salaryratio= $request->mmc_salaryratio;  //Hệ số
            $them->mmc_salaryposition= $request->mmc_salaryposition; //Phụ cấp chức vụ
            $them->mmc_salaryother= $request->mmc_salaryother;//Phụ cấp khác

            $them->mmc_degree= $request->mmc_degree; //Trình độ chuyên môn cao nhất
            $them->mmc_language= $request->mmc_language; //Ngoại ngữ 
            $them->mmc_itlevel= $request->mmc_itlevel; //Tin học
            $them->mmc_politiclevel= $request->mmc_politiclevel; //Lý luận chính trị
            $them->mmc_managementlevel= $request->mmc_managementlevel; //Quản lý nhà nước
            $them->mmc_partydate= $request->mmc_partydate; //Ngày vào Đảng Cộng sản Việt Nam
            $them->mmc_partydateprimary= $request->mmc_partydateprimary; //Ngày chính thức
            $them->mmc_reward= $request->mmc_reward; //Khen thưởng
            $them->mmc_discipline= $request->mmc_discipline; //Kỷ luật

            $them->mmc_heathlevel= $request->mmc_heathlevel; //Tình trạng sức khoẻ
            $them->mmc_bloodgroup= $request->mmc_bloodgroup; //Nhóm máu
            $them->mmc_tall= $request->mmc_tall; //Chiều cao
            $them->mmc_weight= $request->mmc_weight; //Cân nặng

            $them->save();

            return redirect()->route('danh-sach-giang-vien')->with('thongbao','thêm giảng viên thành công');
        }

    }
    // sửa thông tin giảng viên
    public function getSuaGV($id){
        $sua = mmc_employee::find($id);
        return view('admin.GiangVien.SuaGV',['sua'=>$sua]);
    }
    public function postSuaGV(Request $request,$id){
        $this->validate($request,
        [
            'mmc_employeeid'=>'unique:mmc_employees,mmc_employeeid,'.$id,
            'email'=>'ends_with:gmail.com,ictu.edu.vn|unique:mmc_employees,email,'.$id,
            'mmc_phone'=>'phone:VN|unique:mmc_employees,mmc_phone,'.$id,
        ],
        [
            'mmc_employeeid.unique'=>'Mã giảng viên đã tồn tại',
            'email.unique'=>'Email đã tồn tại',
            'email.ends_with'=>'email phải có định dạnh gmail.com hoặc ictu.edu.vn',
            'mmc_phone.unique'=>'Số điện thoại đã tồn tại',
            'mmc_phone.phone'=>'Vui lòng nhập đúng định dạng số điện thoại Việt Nam',
        ]);

        $sua = mmc_employee::find($id);
        $sua->mmc_name = $request->mmc_name; //Họ và tên
        $sua->mmc_employeeid = $request->mmc_employeeid; //Mã giảng viên
        $sua->mmc_deptid = $request->mmc_deptid; //Mã bộ môn

        if($request->hasFile('mmc_avatar')){

            $file = $request->mmc_avatar;
            $name = $file->getClientOriginalName();
            $image_resize = Image::make($file->getRealPath());

            $image_resize->fit($width = 250, $height = 290, function ($constraint) {
                $constraint->upsize();
            });
            $image_resize->save('IMG/'.$name);

            $sua->mmc_avatar = $name; //Ảnh đại điện
        }

        $sua->mmc_dateofbirth = $request->mmc_dateofbirth; //Ngày tháng và năm sinh
        $sua->mmc_gender = $request->mmc_gender; //Giới tính
        $sua->mmc_personalid = $request->mmc_personalid; //Số chứng minh nhân dân
        $sua->mmc_dateofpid = $request->mmc_dateofpid; //Ngày cấp
        $sua->mmc_socialinsuranceid = $request->mmc_socialinsuranceid; //Số bảo hiểm xã hội
        $sua->mmc_phone = $request->mmc_phone; //Số điện thoại
        $sua->email = $request->email; //Email
        //$sua->password = $request->password; //Password
        $sua->mmc_religion = $request->mmc_religion; //Dân tộc
        $sua->mmc_ethnic = $request->mmc_ethnic; //Tôn giáo
        $sua->mmc_placeofbirth = $request->mmc_placeofbirth; //Nơi Sinh
        $sua->mmc_hometown = $request->mmc_hometown; //Quê quán
        $sua->mmc_address = $request->mmc_address; //Hộ khẩu thường trú

        $sua->mmc_dateofrecruit= $request->mmc_dateofrecruit; //Ngày tuyển dụng
        $sua->mmc_position= $request->mmc_position; //Chức vụ hiện tại
        $sua->mmc_maintask= $request->mmc_maintask; //Công việc chính được giao

        $sua->mmc_nameofjob= $request->mmc_nameofjob; //Ngạch công chức
        $sua->mmc_codeofjob= $request->mmc_codeofjob; //Mã ngạch
        $sua->mmc_salarylevel= $request->mmc_salarylevel; //Bậc lương
        $sua->mmc_salaryratio= $request->mmc_salaryratio;  //Hệ số
        $sua->mmc_salaryposition= $request->mmc_salaryposition; //Phụ cấp chức vụ
        $sua->mmc_salaryother= $request->mmc_salaryother;//Phụ cấp khác

        $sua->mmc_degree= $request->mmc_degree; //Trình độ chuyên môn cao nhất
        $sua->mmc_language= $request->mmc_language; //Ngoại ngữ
        $sua->mmc_itlevel= $request->mmc_itlevel; //Tin học
        $sua->mmc_politiclevel= $request->mmc_politiclevel; //Lý luận chính trị
        $sua->mmc_managementlevel= $request->mmc_managementlevel; //Quản lý nhà nước
        $sua->mmc_partydate= $request->mmc_partydate; //Ngày vào Đảng Cộng sản Việt Nam
        $sua->mmc_partydateprimary= $request->mmc_partydateprimary; //Ngày chính thức
        $sua->mmc_reward= $request->mmc_reward; //Khen thưởng
        $sua->mmc_discipline= $request->mmc_discipline; //Kỷ luật

        $sua->mmc_heathlevel= $request->mmc_heathlevel; //Tình trạng sức khoẻ
        $sua->mmc_bloodgroup= $request->mmc_bloodgroup; //Nhóm máu
        $sua->mmc_tall= $request->mmc_tall; //Chiều cao
        $sua->mmc_weight= $request->mmc_weight; //Cân nặng

        $sua->save();

        return redirect()->route('get-sua-thong-tin-giang-vien',$id)->with('thongbao','Sửa thông tin giảng viên thành công');
    }
    // thông tin giảng viên
    public function getThongTinGV($id){
        $hien = mmc_employee::find($id);
        return view('admin.GiangVien.ThongTinGV',['hien'=>$hien]);
    }
    // tìm kiếm thông tin giảng viên
    public function postTimKiemGV(Request $request){
        $tukhoa = $request->tukhoa;
        $thongtin = mmc_employee::where('mmc_name','like',"%%$tukhoa%%")->orwhere('email','like',"%%$tukhoa%%")->orwhere('mmc_phone','like',"%%$tukhoa%%")->take(10)->paginate(5);
        return view('admin.GiangVien.TimKiemGV',['thongtin'=>$thongtin,'tukhoa'=>$tukhoa]);
    }
    // xóa giảng viên
    public function getXoaGV($id){
        $xoa = mmc_employee::find($id);
        $xoa -> delete();

        return redirect()->route('danh-sach-giang-vien')->with('thongbao','xóa giảng viên thành công');
    }

    // thông tin cá nhân
    public function getThongTinCN($id){
        return view('admin.GiangVien.CaNhan.ThongTinCN');
    }
    // sửa thông tin cá nhân
    public function getSuaCN($id){
        return view('admin.GiangVien.CaNhan.SuaCN');
    }
    public function postSuaCN(Request $request,$id){
        $this->validate($request,
        [
            'mmc_employeeid'=>'unique:mmc_employees,mmc_employeeid,'.$id,
            'email'=>'ends_with:gmail.com,ictu.edu.vn|unique:mmc_employees,email,'.$id,
            'mmc_phone'=>'phone:VN|unique:mmc_employees,mmc_phone,'.$id,
        ],
        [
            'mmc_employeeid.unique'=>'Mã giảng viên đã tồn tại',
            'email.unique'=>'Email đã tồn tại',
            'email.ends_with'=>'email phải có định dạnh gmail.com hoặc ictu.edu.vn',
            'mmc_phone.unique'=>'Số điện thoại đã tồn tại',
            'mmc_phone.phone'=>'Vui lòng nhập đúng định dạng số điện thoại Việt Nam',
        ]);

        $sua = mmc_employee::find($id);
        $sua->mmc_name = $request->mmc_name; //Họ và tên
        $sua->mmc_employeeid = $request->mmc_employeeid; //Mã giảng viên
        $sua->mmc_deptid = $request->mmc_deptid; //Mã bộ môn

        if($request->hasFile('mmc_avatar')){
            // luu anh vao csdl

            $file = $request->mmc_avatar;
            $name = $file->getClientOriginalName();
            $image_resize = Image::make($file);
            $image_resize->fit($width = 250, $height = 290, function ($constraint) {
                $constraint->upsize();
            });
            $image_resize->save('IMG/'.$name);

            $sua->mmc_avatar = $name; //Ảnh đại điện
        }

        $sua->mmc_dateofbirth = $request->mmc_dateofbirth; //Ngày tháng và năm sinh
        $sua->mmc_gender = $request->mmc_gender; //Giới tính
        $sua->mmc_personalid = $request->mmc_personalid; //Số chứng minh nhân dân
        $sua->mmc_dateofpid = $request->mmc_dateofpid; //Ngày cấp
        $sua->mmc_socialinsuranceid = $request->mmc_socialinsuranceid; //Số bảo hiểm xã hội
        $sua->mmc_phone = $request->mmc_phone; //Số điện thoại
        $sua->email = $request->email; //Email
        //$sua->password = $request->password; //Password
        $sua->mmc_religion = $request->mmc_religion; //Dân tộc
        $sua->mmc_ethnic = $request->mmc_ethnic; //Tôn giáo
        $sua->mmc_placeofbirth = $request->mmc_placeofbirth; //Nơi Sinh
        $sua->mmc_hometown = $request->mmc_hometown; //Quê quán
        $sua->mmc_address = $request->mmc_address; //Hộ khẩu thường trú

        $sua->mmc_dateofrecruit= $request->mmc_dateofrecruit; //Ngày tuyển dụng
        $sua->mmc_position= $request->mmc_position; //Chức vụ hiện tại
        $sua->mmc_maintask= $request->mmc_maintask; //Công việc chính được giao

        $sua->mmc_nameofjob= $request->mmc_nameofjob; //Ngạch công chức
        $sua->mmc_codeofjob= $request->mmc_codeofjob; //Mã ngạch
        $sua->mmc_salarylevel= $request->mmc_salarylevel; //Bậc lương
        $sua->mmc_salaryratio= $request->mmc_salaryratio;  //Hệ số
        $sua->mmc_salaryposition= $request->mmc_salaryposition; //Phụ cấp chức vụ
        $sua->mmc_salaryother= $request->mmc_salaryother;//Phụ cấp khác

        $sua->mmc_degree= $request->mmc_degree; //Trình độ chuyên môn cao nhất
        $sua->mmc_language= $request->mmc_language; //Ngoại ngữ
        $sua->mmc_itlevel= $request->mmc_itlevel; //Tin học
        $sua->mmc_politiclevel= $request->mmc_politiclevel; //Lý luận chính trị
        $sua->mmc_managementlevel= $request->mmc_managementlevel; //Quản lý nhà nước
        $sua->mmc_partydate= $request->mmc_partydate; //Ngày vào Đảng Cộng sản Việt Nam
        $sua->mmc_partydateprimary= $request->mmc_partydateprimary; //Ngày chính thức
        $sua->mmc_reward= $request->mmc_reward; //Khen thưởng
        $sua->mmc_discipline= $request->mmc_discipline; //Kỷ luật

        $sua->mmc_heathlevel= $request->mmc_heathlevel; //Tình trạng sức khoẻ
        $sua->mmc_bloodgroup= $request->mmc_bloodgroup; //Nhóm máu
        $sua->mmc_tall= $request->mmc_tall; //Chiều cao
        $sua->mmc_weight= $request->mmc_weight; //Cân nặng

        $sua->save();

        return redirect()->route('get-sua-thong-tin-ca-nhan',$id)->with('thongbao','Sửa thông tin cá nhânh thành công');
    }
    // đổi password
    public function getDoiPass($id){
        return view('admin.GiangVien.CaNhan.DoiPass');
    }
    public function postDoiPass(Request $request,$id){
        $passMoi1 = $request->password_Moi1;
        $passMoi2 = $request->password_Moi2;

        if($passMoi1==$passMoi2){
            $doiPass = mmc_employee::find($id);
            $passDau = $doiPass->password;
            $passCu = $request->password_Cu;
            $passMoi = $passMoi2;

            $pass = Hash::check($passCu, $passDau);
            if($pass == true){
                $doiPass->password = Hash::make($passMoi);
                $doiPass ->save();
                return redirect()->route('get-doi-pass',$id)->with('thongbao','thay đổi PassWord thành công');
            }else{
                return redirect()->route('get-doi-pass',$id)->with('errors','PassWord cũ vừa nhập không đúng');
            }

        }else{
            return redirect()->route('get-doi-pass',$id)->with('errors','PassWord mới nhập lại không đúng');
        }




    }
    public static function count()
    {
        return mmc_employee::count();
    }


}
