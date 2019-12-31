@extends('layouts.backend')


@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Sửa Thông Tin Giảng Viên</h2>
		<span><a href="{{route('home')}}">Home</a> > <a href="{{route('giangvien.index')}}">Quản Lý Giảng Viên</a> > Sửa Thông Tin Giảng Viên</span>
	</div>
</div>
{{-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Sửa Thông Tin Giảng Viên</h2>
    </div>
</div> --}}
<div class="card-body">
    <a href="{{route('giangvien.index')}}" class="btn btn-primary btn-sm" title="quay về">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> Quay Về
    </a>
</div>
<div class="wrapper wrapper-content  animated fadeInRight blog">
    					
    <div class="row ">
        <div class="col-lg-12">
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $err)
                        {{$err}}
                    @endforeach
                </div> 
            @endif

            @if (session('thongbao'))
                <div class="alert alert-success ">
                    {{session('thongbao')}}
                </div>
            @endif
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
                <div class="card-header">Sửa Thông Tin Giảng Viên</div>
				<div class="container">

                    <form action="{{route('giangvien.update',$sua->id)}}" method="POST" enctype="multipart/form-data" role="form">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-2 mt-5">
                                <div class="text-cent">
                                    <div class="form-group" >
                                        @if (is_null($sua->mmc_avatar))
                                            <input hidden id="img" type="file" name="mmc_avatar" class="form-control hidden" onchange="changeImg(this)">
                                            <img id="avatar" class="thumbnail" width="170px" src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                                        @else
                                            <input hidden id="img" type="file" name="mmc_avatar" class="form-control hidden" onchange="changeImg(this)" >
                                            <img id="avatar" class="thumbnail" width="170px" src="/IMG/{{$sua->mmc_avatar}}" >
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#home">THÔNG TIN CƠ BẢN</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#menu1">NGHỀ NGHIỆP</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#menu2">LƯƠNG THƯỞNG</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#menu3">TRÌNH ĐỘ HỌC VẤN</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#menu4">ĐẢNG</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#menu5">SỨC KHỎE</a>
                                    </li>
                                </ul>
                                
                                <!-- Tab panes -->
                                <div class="tab-content mt-3">
                                    <div class="tab-pane container active" id="home">
                                        {{-- THÔNG TIN CƠ BẢN --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Họ Và Tên: <b style="color:red;" >*</b></span>
                                                    </div>
                                                    <input type="text" name="mmc_name" minlength="3" maxlength="50" class="form-control" required autocomplete="off" value="{{$sua->mmc_name}}">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm" hidden>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Mã giảng viên: <b style="color:red;" >*</b></span>
                                                    </div>
                                                    <input type="text" name="mmc_employeeid" minlength="3" maxlength="50" class="form-control" required autocomplete="off" value="{{$sua->mmc_employeeid}}" readonly>
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Tên bộ môn: <b style="color:red;" >*</b></span> 
                                                    </div>
                                                    <select class="browser-default custom-select" id="sel1" name="mmc_deptid">
                                                        @foreach ($bomon as $bm)
                                                            <option value="{{$bm->mmc_deptid}}" {{$bm->mmc_deptid == $sua->mmc_deptid ? 'selected' : ''}}>{{$bm->mmc_deptname}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Chức vụ hiện tại: <b style="color:red;" >*</b></span>
                                                    </div>
                                                    <select class="browser-default custom-select" name="mmc_position" id="mmc_position" required>
                                                        @foreach (config('test.cv') as $cv)
                                                            <option value="{{$cv}}" {{$cv==$sua->mmc_position ? 'selected' : ''}}>{{$cv}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if (Auth::user()->mmc_level==1)
                                                    <div class="input-group mb-3 input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Phân Quyền: <b style="color:red;" >*</b></span>
                                                        </div>
                                                        {{-- {{dd($sua->mmc_level)}} --}}
                                                        <select class="browser-default custom-select" id="mmc_level" name="mmc_level" required>
                                                            @foreach (config('test.qp') as $key => $qp)
                                                                <option value="{{$key}}" {{$key==$sua->mmc_level ? 'selected' : ''}}>{{$qp}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Ngày tháng và năm sinh: </span>
                                                    </div>
                                                    <input type="date" name="mmc_dateofbirth" class="form-control" data-format="dd/mm/yyyy" autocomplete="off" value="{{$sua->mmc_dateofbirth}}">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Giới tính: </span>
                                                    </div>
                                                    <div class="form-check-inline" style="margin-left: 10px;">
                                                        <label class="form-check-label" for="radio1">
                                                            <input type="radio" class="form-check-input" id="radio1" name="mmc_gender" value="0" {{0 == $sua->mmc_gender ? 'checked' : ''}}  >Nam
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label" for="radio2">
                                                            <input type="radio" class="form-check-input" id="radio2" name="mmc_gender" value="1" {{1 == $sua->mmc_gender ? 'checked' : ''}}>Nữ
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Số chứng minh nhân dân:</span>
                                                    </div>
                                                    <input type="number" name="mmc_personalid" class="form-control" min="0" minlength="3" maxlength="15"  autocomplete="off" value="{{$sua->mmc_personalid}}">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Ngày cấp:</span>
                                                    </div>
                                                    <input type="date" name="mmc_dateofpid" class="form-control" data-format="dd/mm/yyyy"  autocomplete="off" value="{{$sua->mmc_dateofpid}}">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Số bảo hiểm xã hội: </span>
                                                    </div>
                                                    <input type="number" name="mmc_socialinsuranceid" class="form-control" min="0" minlength="3" maxlength="15"  autocomplete="off" value="{{$sua->mmc_socialinsuranceid}}">
                                                </div>
                                                
                                            </div>
        
                                            <div class="col-md-6">
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Số điện thoại: <b style="color:red;" >*</b> </span>
                                                    </div>
                                                    <input type="number" name="mmc_phone" min="0" minlength="3" maxlength="12" class="form-control" required autocomplete="off" value="{{$sua->mmc_phone}}">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Email: <b style="color:red;" >*</b> </span>
                                                    </div>
                                                    <input type="email" name="email" minlength="3" maxlength="225" class="form-control" required autocomplete="off" value="{{$sua->email}}">
                                                </div>
                                                {{-- <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Password: <b style="color:red;" >*</b></span>
                                                    </div>
                                                    <input type="text" name="password" minlength="3" class="form-control" required autocomplete="off" value="{{$sua->password}}">
                                                </div> --}}
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Dân tộc:</span>
                                                    </div>
                                                    <input type="text" name="mmc_religion" class="form-control" minlength="3" autocomplete="off" value="{{$sua->mmc_religion}}">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Tôn giáo:</span>
                                                    </div>
                                                    <input type="text" name="mmc_ethnic" class="form-control" minlength="3" autocomplete="off" value="{{$sua->mmc_ethnic}}">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Nơi Sinh:</span>
                                                    </div>
                                                    <textarea class="form-control md-textarea" rows="2" name="mmc_placeofbirth" minlength="3" placeholder="Số nhà, đường phố, thành phố, xóm, thôn, xã, huyện, tỉnh.." autocomplete="off" value="{{$sua->mmc_placeofbirth}}">{{$sua->mmc_placeofbirth}}</textarea>
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Quê quán:</span>
                                                    </div>
                                                    <textarea class="form-control md-textarea" rows="2" name="mmc_hometown" minlength="3" placeholder="Số nhà, đường phố, thành phố, xóm, thôn, xã, huyện, tỉnh.." autocomplete="off" value="{{$sua->mmc_hometown}}">{{$sua->mmc_hometown}}</textarea>
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Hộ khẩu thường trú:</span>
                                                    </div>
                                                    <textarea class="form-control md-textarea" rows="2" name="mmc_address" minlength="3" placeholder="Số nhà, đường phố, thành phố, xóm, thôn, xã, huyện, tỉnh.." autocomplete="off" value="{{$sua->mmc_address}}">{{$sua->mmc_address}}</textarea>
                                                </div>
        
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane container fade" id="menu1">
                                        {{-- NGHỀ NGHIỆP --}} 
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Ngày tuyển dụng : </span>
                                                    </div>
                                                    <input type="date" name="mmc_dateofrecruit" class="form-control" data-format="dd/mm/yyyy" autocomplete="off" value="{{$sua->mmc_dateofrecruit}}">
                                                </div>
                                                
                                            </div>
        
                                            <div class="col-md-6">
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Công việc chính được giao: </span>
                                                    </div>
                                                    
                                                    <textarea class="form-control md-textarea" rows="2" name="mmc_maintask" minlength="3" autocomplete="off" value="{{$sua->mmc_maintask}}">{{$sua->mmc_maintask}}</textarea>
                                                </div>
        
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane container fade" id="menu2">
                                        {{-- LƯƠNG THƯỞNG --}} 
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Ngạch công chức : </span>
                                                    </div>
                                                    <input type="text" name="mmc_nameofjob" class="form-control" minlength="1" autocomplete="off" value="{{$sua->mmc_nameofjob}}">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Mã Ngạch: </span>
                                                    </div>
                                                    <input type="text" name="mmc_codeofjob" class="form-control" minlength="1" autocomplete="off" value="{{$sua->mmc_codeofjob}}">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Bậc lương:</span>
                                                    </div>
                                                    <input type="number" step="any" min="0" name="mmc_salarylevel" class="form-control" minlength="1"  autocomplete="off" value="{{$sua->mmc_salarylevel}}">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Hệ số: </span>
                                                    </div>
                                                    <input type="number" step="any" min="0" name="mmc_salaryratio" class="form-control" minlength="1" autocomplete="off" value="{{$sua->mmc_salaryratio}}">
                                                </div>
                                                
                                            </div>
        
                                            <div class="col-md-6">
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Phụ cấp chức vụ:  </span>
                                                    </div>
                                                    <input type="number" step="any" min="0" name="mmc_salaryposition" class="form-control" minlength="1" autocomplete="off" value="{{$sua->mmc_salaryposition}}">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Phụ cấp khác: </span>
                                                    </div>
                                                    <input type="number" step="any" min="0" name="mmc_salaryother" class="form-control" minlength="1" autocomplete="off" value="{{$sua->mmc_salaryother}}">
                                                </div>
        
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane container fade" id="menu3">
                                        {{-- TRÌNH ĐỘ HỌC VẤN --}}       
                                        <div class="row">
                                            <div class="col-md-6">
                                                    <div class="input-group mb-3 input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Trình độ chuyên môn cao nhất: </span>
                                                        </div>
                                                        <textarea class="form-control md-textarea" rows="2" name="mmc_degree" minlength="1" placeholder="TSKH, TS, ThS, cử nhân, kỹ sư, cao đẳng, trung cấp, sơ cấp, chuyên ngành..." autocomplete="off" value="{{$sua->mmc_degree}}">{{$sua->mmc_degree}}</textarea>
                                                    </div>
                                                    <div class="input-group mb-3 input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Ngoại ngữ:  </span>
                                                        </div>
                                                        <textarea class="form-control md-textarea" rows="2" name="mmc_language" minlength="1" placeholder="Tên ngoại ngữ + Trình độ A, B, C, D......" autocomplete="off" value="{{$sua->mmc_language}}">{{$sua->mmc_language}}</textarea>
                                                    </div>
                                                    <div class="input-group mb-3 input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Tin học: </span>
                                                        </div>
                                                        <textarea class="form-control md-textarea" rows="2" name="mmc_itlevel" minlength="1" placeholder="Trình độ A, B, C,......" autocomplete="off" value="{{$sua->mmc_itlevel}}">{{$sua->mmc_itlevel}}</textarea>
                                                    </div>
                                                
                                            </div>

                                            <div class="col-md-6">
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Lý luận chính trị: </span>
                                                    </div>
                                                    <textarea class="form-control md-textarea" rows="2" name="mmc_politiclevel" minlength="1" autocomplete="off" value="{{$sua->mmc_politiclevel}}">{{$sua->mmc_politiclevel}}</textarea>
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Quản lý nhà nước: </span>
                                                    </div>
                                                    <textarea class="form-control md-textarea" rows="2" name="mmc_managementlevel" minlength="1" autocomplete="off" value="{{$sua->mmc_managementlevel}}">{{$sua->mmc_managementlevel}}</textarea>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane container fade" id="menu4">
                                        {{-- ĐẢNG --}}       
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Ngày vào Đảng Cộng sản Việt Nam: </span>
                                                    </div>
                                                    <input type="date" name="mmc_partydate" class="form-control" data-format="dd/mm/yyyy" autocomplete="off" value="{{$sua->mmc_partydate}}">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Ngày chính thức: </span>
                                                    </div>
                                                    <input type="date" name="mmc_partydateprimary" class="form-control" data-format="dd/mm/yyyy" autocomplete="off" value="{{$sua->mmc_partydateprimary}}">
                                                </div>
                                                
                                            </div>

                                            <div class="col-md-6">
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Khen thưởng:  </span>
                                                    </div>
                                                    <textarea class="form-control md-textarea" rows="2" name="mmc_reward" minlength="1" placeholder="Hình thức cao nhất, năm nào" autocomplete="off" value="{{$sua->mmc_reward}}">{{$sua->mmc_reward}}</textarea>
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Kỷ luật: </span>
                                                    </div>
                                                    <textarea class="form-control md-textarea" rows="2" name="mmc_discipline" minlength="1" placeholder="về đảng, chính quyền, đoàn thể hình thức cao nhất, năm nào" autocomplete="off" value="{{$sua->mmc_discipline}}">{{$sua->mmc_discipline}}</textarea>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane container fade" id="menu5">
                                        {{-- SỨC KHỎE --}} 
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Tình trạng sức khoẻ: </span>
                                                    </div>
                                                    <textarea class="form-control md-textarea" rows="2" name="mmc_heathlevel" minlength="1" autocomplete="off" value="{{$sua->mmc_heathlevel}}">{{$sua->mmc_heathlevel}}</textarea>
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Nhóm máu: </span>
                                                    </div>
                                                    <input type="text" name="mmc_bloodgroup" class="form-control" minlength="1" placeholder="O, A, B" autocomplete="off" value="{{$sua->mmc_bloodgroup}}">
                                                </div>
                                                
                                            </div>

                                            <div class="col-md-6">
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Chiều cao: </span>
                                                    </div>
                                                    <input type="number" step="any" min="0" name="mmc_tall" class="form-control" minlength="1" placeholder="m" autocomplete="off" value="{{$sua->mmc_tall}}">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Cân nặng: </span>
                                                    </div>
                                                    <input type="number" step="any" min="0" name="mmc_weight" class="form-control" minlength="1" placeholder="kg" autocomplete="off" value="{{$sua->mmc_weight}}">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-primary float-right">Thêm Thông Tin Giảng Viên</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection