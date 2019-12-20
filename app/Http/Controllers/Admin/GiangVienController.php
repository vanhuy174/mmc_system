<?php

namespace App\Http\Controllers\Admin;

use App\mmc_department;
use App\mmc_employee;
use Image;
use DB;
use Validator;
use Propaganistas\LaravelPhone\PhoneNumber;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class GiangVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {       
        $keyword = $request->get('search');
        $perPage = 5;
        
        if (!empty($keyword)) {
            $giangvien = mmc_employee::where('mmc_name', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        } else {
            $giangvien = mmc_employee::latest()->paginate($perPage);
        }
        return view('admin.giangvien.danhsach',compact('giangvien'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bomon = mmc_department::select('mmc_deptid','mmc_deptname')->get();

        // lấy mã giảng viên tự động tăng
        $id  = DB::table('mmc_employees')->max('id');
        $id = $id + 1;
        if($id<10){
            $ids = "MMC_GV_0".$id;
        }else{
            $ids = "MMC_GV_".$id;
        }
        return view('admin.giangvien.them',compact('bomon','ids'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
            return redirect()->route('giangvien.create')
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
            $them->password = Hash::make("1"); //Password 
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

            return redirect()->route('giangvien.index')->with('thongbao','thêm giảng viên thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $hien = mmc_employee::find($id);
        
        return view('admin.giangvien.thongtin',compact('hien'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bomon = mmc_department::select('mmc_deptid','mmc_deptname')->get();
        $sua = mmc_employee::find($id);
        return view('admin.giangvien.sua',compact('sua','bomon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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

        $sua->update();

        return redirect()->route('giangvien.edit',$id)->with('thongbao','Sửa thông tin giảng viên thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $xoa = mmc_employee::findOrFail($id)->get();
        
        mmc_employee::destroy($id);
        return redirect()->route('giangvien.index')->with('thongbao','xóa giảng viên thành công');
    }

    public function xoagv(){
        $xoa = mmc_employee::onlyTrashed()->get();
        return view('admin.giangvien.xoa',compact('xoa'));
    }

    public function xemthongtin($id){
        $hien = DB::table('mmc_employees')->where('id',$id)->get();
        // dd($hien);
        // $hien=  collect([
        //     "id" => $data[0]->id,
        //     "mmc_name" => $data[0]->mmc_name,
        //     "mmc_employeeid" => $data[0]->mmc_employeeid,
        //     "mmc_deptid" => $data[0]->mmc_deptid,
        //     "mmc_avatar" => $data[0]->mmc_avatar,
        //     "mmc_dateofbirth" => $data[0]->mmc_dateofbirth,
        //     "mmc_gender" => $data[0]->mmc_gender,
        //     "mmc_personalid" => $data[0]->mmc_personalid,
        //     "mmc_dateofpid" => $data[0]->mmc_dateofpid,
        //     "mmc_socialinsuranceid" => $data[0]->mmc_socialinsuranceid,
        //     "mmc_phone" => $data[0]->mmc_phone,
        //     "email" => $data[0]->email,
        //     "password" => $data[0]->password,
        //     "mmc_religion" => $data[0]->mmc_religion,
        //     "mmc_ethnic" => $data[0]->mmc_ethnic,
        //     "mmc_placeofbirth" => $data[0]->mmc_placeofbirth,
        //     "mmc_hometown" => $data[0]->mmc_hometown,
        //     "mmc_address" => $data[0]->mmc_address,
        //     "mmc_dateofrecruit" => $data[0]->mmc_dateofrecruit,
        //     "mmc_position" => $data[0]->mmc_position,
        //     "mmc_maintask" => $data[0]->mmc_maintask,
        //     "mmc_nameofjob" => $data[0]->mmc_nameofjob,
        //     "mmc_codeofjob" => $data[0]->mmc_codeofjob,
        //     "mmc_salarylevel" => $data[0]->mmc_salarylevel,
        //     "mmc_salaryratio" => $data[0]->mmc_salaryratio,
        //     "mmc_salaryposition" => $data[0]->mmc_salaryposition,
        //     "mmc_salaryother" => $data[0]->mmc_salaryother,
        //     "mmc_degree" => $data[0]->mmc_degree,
        //     "mmc_language" => $data[0]->mmc_language,
        //     "mmc_itlevel" => $data[0]->mmc_itlevel,
        //     "mmc_politiclevel" => $data[0]->mmc_politiclevel,
        //     "mmc_managementlevel" => $data[0]->mmc_managementlevel,
        //     "mmc_partydate" => $data[0]->mmc_partydate,
        //     "mmc_partydateprimary" => $data[0]->mmc_partydateprimary,
        //     "mmc_reward" => $data[0]->mmc_reward,
        //     "mmc_discipline" => $data[0]->mmc_discipline,
        //     "mmc_heathlevel" => $data[0]->mmc_heathlevel,
        //     "mmc_bloodgroup" => $data[0]->mmc_bloodgroup,
        //     "mmc_tall" => $data[0]->mmc_tall,
        //     "mmc_weight" => $data[0]->mmc_weight,
        // ]);
        //dd($hien);
        return view('admin.giangvien.thongtinxoa',compact('hien'));
    }

    public function phuchoi($id){
        $xoa = DB::table('mmc_employees')->where('id',$id)->select('deleted_at')->update(['deleted_at' => NULL]);
        
        return redirect()->route('giangvien.index')->with('thongbao','giảng viên đã được phục hồi');
    }

}
