@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Thông Tin Giảng Viên</h2>
            <span><a href="{{route('home')}}">Home</a> > <a href="{{route('giangvien.index')}}">Quản Lý Giảng Viên</a> > Thông Tin Giảng Viên</span>
        </div>
    </div>
    <div class="card-body">
        <a href="{{route('giangvien.index')}}" class="btn btn-primary btn-sm" title="quay về">
            <i class="fa fa-arrow-left" aria-hidden="true"></i> Quay Về
        </a>
        <a href="" class="btn btn-primary btn-sm float-right" title="Xuất File">
            <i class="fa fa-arrow-right" aria-hidden="true"></i> Xuất file PDF
        </a>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        <div class="row ">
            <div class="col-lg-3 bg-white ">
                <!-- Left Column -->
                <div class="w3-third" style="margin-top: 110px; ">
                    <div class="w3-white w3-text-grey w3-card-4">
                        <div class="w3-display-container ">
                            <img src="/IMG/{{$hien[0]->mmc_avatar}}" alt="{{$hien[0]->mmc_avatar}}" style="width:100%; height=100%" >
                        </div>
                        <div class="w3-container my-3">
                            <p class="font-weight-bold "><i class=" glyphicon glyphicon-user"></i> <span class=" ml-5">{{$hien[0]->mmc_name}}</span> </p>
                            <p class="font-weight-bold "><i class="glyphicon glyphicon-qrcode fa-fw w3-margin-right w3-large w3-text-teal"></i><span class=" ml-5">{{$hien[0]->mmc_employeeid}}</span></p>
                            <p class="font-weight-bold "><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><span class=" ml-5">{{$hien[0]->email}}</span></p>
                            <p class="font-weight-bold "><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><span class=" ml-5">{{$hien[0]->mmc_phone}}</span></p>
                            {{-- <p class="font-weight-bold "><i class="fa fa-calendar fa-fw w3-margin-right"></i><span class=" ml-5">{{$hien[0]->mmc_dateofbirth}}</span></p> --}}
                        </div>
                    </div>
                    <br>
                <!-- End Left Column -->
                </div>
            </div>
            <div class="col-lg-9 bg-white">
                <!-- THÔNG TIN CƠ BẢN -->
                <div class="w3-twothird">
                    <h2 class="w3-text-grey w3-padding-16 text-center">HỒ SƠ GIẢNG VIÊN</h2>
                    <hr>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Họ Và Tên: </b>{{$hien[0]->mmc_name}}</h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Mã giảng viên: </b>{{$hien[0]->mmc_employeeid}}</h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Tên bộ môn: </b>{{$ten}}</h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Chức vụ hiện tại: </b> {{$hien[0]->mmc_position}}</h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Ngày tháng và năm sinh: </b>{{$hien[0]->mmc_dateofbirth}}</h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity">
                                    @if (($hien[0]->mmc_gender)==0)
                                        <b>- Giới tính: </b> Nam
                                    @else
                                        <b>- Giới tính: </b> Nữ
                                    @endif
                                </h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Số chứng minh nhân dân: </b>{{$hien[0]->mmc_personalid}}</h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Ngày cấp: </b>{{$hien[0]->mmc_dateofpid}}</h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Số bảo hiểm xã hội: </b>{{$hien[0]->mmc_socialinsuranceid}}</h4>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Số điện thoại: </b>{{$hien[0]->mmc_phone}}</h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- E-mail: </b>{{$hien[0]->email}}</h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Dân tộc: </b>{{$hien[0]->mmc_religion}}</h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Tôn giáo: </b> {{$hien[0]->mmc_ethnic}}</h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Nơi Sinh: </b>{{$hien[0]->mmc_placeofbirth}}</h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Quê quán: </b> {{$hien[0]->mmc_hometown}}</h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Hộ khẩu thường trú: </b> {{$hien[0]->mmc_address}}</h4>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <br>
                <br>
                <br>
                <br>
                <div class="container">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#menu">NGHỀ NGHIỆP</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu1">LƯƠNG THƯỞNG</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu2">TRÌNH ĐỘ HỌC VẤN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu3">ĐẢNG</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu4">SỨC KHỎE</a>
                        </li>
                    </ul>
                    
                    
                    <div class="tab-content">
                        
                        <div id="menu" class="container tab-pane active">
                            <div class="w3-twothird">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Ngày tuyển dụng: </b> {{$hien[0]->mmc_dateofrecruit}}</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Công việc chính được giao: </b>{{$hien[0]->mmc_maintask}}</h4>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div id="menu1" class="container tab-pane fade">
                            <!-- LƯƠNG THƯỞNG-->
                            <div class="w3-twothird">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="w3-container my-4">
                                                <h4 class="w3-opacity"><b>- Ngạch công chức: </b> {{$hien[0]->mmc_nameofjob}}</h4>
                                            </div>
                                            <div class="w3-container my-4">
                                                <h4 class="w3-opacity"><b>- Mã ngạch: </b>{{$hien[0]->mmc_codeofjob}}</h4>
                                            </div>
                                            <div class="w3-container my-4">
                                                <h4 class="w3-opacity"><b>- Bậc lương: </b> {{$hien[0]->mmc_salarylevel}}</h4>
                                            </div>
                                            <div class="w3-container my-4">
                                                <h4 class="w3-opacity"><b>- Hệ số: </b>{{$hien[0]->mmc_salaryratio}}</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="w3-container my-4">
                                                <h4 class="w3-opacity"><b>- Phụ cấp chức vụ: </b> {{$hien[0]->mmc_salaryposition}}</h4>
                                            </div>
                                            <div class="w3-container my-4">
                                                <h4 class="w3-opacity"><b>- Phụ cấp khác: </b> {{$hien[0]->mmc_salaryother}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                        </div>
                        <div id="menu2" class="container tab-pane fade">
                            <!-- TRÌNH ĐỘ HỌC VẤN -->
                            <div class="w3-twothird">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Trình độ chuyên môn cao nhất: </b>{{$hien[0]->mmc_degree}}</h4>
                                        </div>
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Ngoại ngữ: </b>{{$hien[0]->mmc_language}}</h4>
                                        </div>
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Tin học: </b>{{$hien[0]->mmc_itlevel}}</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Lý luận chính trị: </b>{{$hien[0]->mmc_politiclevel}}</h4>
                                        </div>
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Quản lý nhà nước: </b>{{$hien[0]->mmc_managementlevel}}</h4>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div id="menu3" class="container tab-pane fade">
                            <!-- ĐẢNG -->
                            <div class="w3-twothird">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Ngày vào Đảng Cộng sản Việt Nam: </b>{{$hien[0]->mmc_partydate}}</h4>
                                        </div>
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Ngày chính thức: </b>{{$hien[0]->mmc_partydateprimary}}</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Khen thưởng:</b> {{$hien[0]->mmc_reward}}</h4>
                                        </div>
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Kỷ luật: </b>{{$hien[0]->mmc_discipline}}</h4>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div id="menu4" class="container tab-pane fade">
                            <!-- SỨC KHỎE -->
                            <div class="w3-twothird">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Chiều cao: </b>{{$hien[0]->mmc_tall}}</h4>
                                        </div>
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Cân nặng: </b>{{$hien[0]->mmc_weight}}</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Tình trạng sức khoẻ: </b>{{$hien[0]->mmc_heathlevel}}</h4>
                                        </div>
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Nhóm máu: </b>{{$hien[0]->mmc_bloodgroup}}</h4>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

