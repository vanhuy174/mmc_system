<?php

namespace App\Http\Controllers\Admin;
use App\mmc_department;
use App\mmc_employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class CaNhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.canhan.thongtin');
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
        return view('admin.canhan.sua',compact('sua','bomon'));
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

        return redirect()->route('canhan.edit',$id)->with('thongbao','Sửa thông tin giảng viên thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDoiPass($id){
        return view('admin.canhan.matkhau');
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
                return redirect()->route('getDoiPass',$id)->with('thongbao','thay đổi PassWord thành công');
            }else{
                return redirect()->route('getDoiPass',$id)->with('errors','PassWord cũ vừa nhập không đúng');
            }

        }else{
            return redirect()->route('getDoiPass',$id)->with('errors','PassWord mới nhập lại không đúng');
        }
    }
}
