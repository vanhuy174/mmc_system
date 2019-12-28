<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Thông Tin Cá Nhân</h2>
            <span><a href="<?php echo e(route('home')); ?>">Home</a> > Thông Tin Cá Nhân</span>
        </div>
    </div>
    <div class="card-body ">
        <a href="<?php echo e(route('home')); ?>" class="btn btn-primary btn-sm " title="quay về">
            <i class="fa fa-arrow-left" aria-hidden="true"></i> Quay Về
        </a>

        <a href="<?php echo e(url('admin/canhan/'.Auth::user()->id.'/edit')); ?>" class="btn btn-primary btn-sm" title="Sửa Thông Tin Cá Nhân">
            <i class=" fa fa-user" aria-hidden="true"></i> Sửa Thông Tin Cá Nhân
        </a>
        <a href="<?php echo e(route('getDoiPass',Auth::user()->id)); ?>" class="btn btn-primary btn-sm " title="Đổi PassWord">
            <i class="fa fa-lock" aria-hidden="true"></i> Đổi Mật Khẩu
        </a>
        <a href="" class="btn btn-primary btn-sm " title="Xuất File">
            <i class="fa fa-arrow-right" aria-hidden="true"></i> Xuất file PDF
        </a>  
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        <div class="row ">
            <div class="col-lg-3 bg-white ">
                <!-- Left Column -->
                <div class="w3-third" style="margin-top: 110px;">
                    <div class="w3-white w3-text-grey w3-card-4">
                        <div class="w3-display-container ">
                            <img src="/IMG/<?php echo e(Auth::user()->mmc_avatar); ?>" alt="<?php echo e(Auth::user()->mmc_avatar); ?>" style="width:100%; height: 100% ">
                        </div>
                        <div class="w3-container my-3">
                            <p class="font-weight-bold "><i class=" glyphicon glyphicon-user"></i> <span class=" ml-5"><?php echo e(Auth::user()->mmc_name); ?></span> </p>
                            <p class="font-weight-bold "><i class="glyphicon glyphicon-qrcode fa-fw w3-margin-right w3-large w3-text-teal"></i><span class=" ml-5"><?php echo e(Auth::user()->mmc_employeeid); ?></span></p>
                            <p class="font-weight-bold "><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><span class=" ml-5"><?php echo e(Auth::user()->email); ?></span></p>
                            <p class="font-weight-bold "><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><span class=" ml-5"><?php echo e(Auth::user()->mmc_phone); ?></span></p>
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
                                <h4 class="w3-opacity"><b>- Họ Và Tên: </b><?php echo e(Auth::user()->mmc_name); ?></h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Mã giảng viên: </b><?php echo e(Auth::user()->mmc_employeeid); ?></h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Tên bộ môn: </b><?php echo e(Auth::user()->department->mmc_deptname); ?></h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Chức vụ hiện tại: </b> <?php echo e(Auth::user()->mmc_position); ?></h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Ngày tháng và năm sinh: </b><?php echo e(Auth::user()->mmc_dateofbirth); ?></h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity">
                                    <?php if((Auth::user()->mmc_gender)==0): ?>
                                        <b>- Giới tính: </b> Nam
                                    <?php else: ?>
                                        <b>- Giới tính: </b> Nữ
                                    <?php endif; ?>
                                </h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Số chứng minh nhân dân: </b><?php echo e(Auth::user()->mmc_personalid); ?></h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Ngày cấp: </b><?php echo e(Auth::user()->mmc_dateofpid); ?></h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Số bảo hiểm xã hội: </b><?php echo e(Auth::user()->mmc_socialinsuranceid); ?></h4>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Số điện thoại: </b><?php echo e(Auth::user()->mmc_phone); ?></h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- E-mail: </b><?php echo e(Auth::user()->email); ?></h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Dân tộc: </b><?php echo e(Auth::user()->mmc_religion); ?></h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Tôn giáo: </b> <?php echo e(Auth::user()->mmc_ethnic); ?></h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Nơi Sinh: </b><?php echo e(Auth::user()->mmc_placeofbirth); ?></h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Quê quán: </b> <?php echo e(Auth::user()->mmc_hometown); ?></h4>
                            </div>
                            <div class="w3-container my-4">
                                <h4 class="w3-opacity"><b>- Hộ khẩu thường trú: </b> <?php echo e(Auth::user()->mmc_address); ?></h4>
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
                                            <h4 class="w3-opacity"><b>- Ngày tuyển dụng: </b> <?php echo e(Auth::user()->mmc_dateofrecruit); ?></h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Công việc chính được giao: </b><?php echo e(Auth::user()->mmc_maintask); ?></h4>
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
                                                <h4 class="w3-opacity"><b>- Ngạch công chức: </b> <?php echo e(Auth::user()->mmc_nameofjob); ?></h4>
                                            </div>
                                            <div class="w3-container my-4">
                                                <h4 class="w3-opacity"><b>- Mã ngạch: </b><?php echo e(Auth::user()->mmc_codeofjob); ?></h4>
                                            </div>
                                            <div class="w3-container my-4">
                                                <h4 class="w3-opacity"><b>- Bậc lương: </b> <?php echo e(Auth::user()->mmc_salarylevel); ?></h4>
                                            </div>
                                            <div class="w3-container my-4">
                                                <h4 class="w3-opacity"><b>- Hệ số: </b><?php echo e(Auth::user()->mmc_salaryratio); ?></h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="w3-container my-4">
                                                <h4 class="w3-opacity"><b>- Phụ cấp chức vụ: </b> <?php echo e(Auth::user()->mmc_salaryposition); ?></h4>
                                            </div>
                                            <div class="w3-container my-4">
                                                <h4 class="w3-opacity"><b>- Phụ cấp khác: </b> <?php echo e(Auth::user()->mmc_salaryother); ?></h4>
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
                                            <h4 class="w3-opacity"><b>- Trình độ chuyên môn cao nhất: </b><?php echo e(Auth::user()->mmc_degree); ?></h4>
                                        </div>
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Ngoại ngữ: </b><?php echo e(Auth::user()->mmc_language); ?></h4>
                                        </div>
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Tin học: </b><?php echo e(Auth::user()->mmc_itlevel); ?></h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Lý luận chính trị: </b><?php echo e(Auth::user()->mmc_politiclevel); ?></h4>
                                        </div>
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Quản lý nhà nước: </b><?php echo e(Auth::user()->mmc_managementlevel); ?></h4>
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
                                            <h4 class="w3-opacity"><b>- Ngày vào Đảng Cộng sản Việt Nam: </b><?php echo e(Auth::user()->mmc_partydate); ?></h4>
                                        </div>
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Ngày chính thức: </b><?php echo e(Auth::user()->mmc_partydateprimary); ?></h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Khen thưởng:</b> <?php echo e(Auth::user()->mmc_reward); ?></h4>
                                        </div>
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Kỷ luật: </b><?php echo e(Auth::user()->mmc_discipline); ?></h4>
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
                                            <h4 class="w3-opacity"><b>- Chiều cao: </b><?php echo e(Auth::user()->mmc_tall); ?></h4>
                                        </div>
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Cân nặng: </b><?php echo e(Auth::user()->mmc_weight); ?></h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Tình trạng sức khoẻ: </b><?php echo e(Auth::user()->mmc_heathlevel); ?></h4>
                                        </div>
                                        <div class="w3-container my-4">
                                            <h4 class="w3-opacity"><b>- Nhóm máu: </b><?php echo e(Auth::user()->mmc_bloodgroup); ?></h4>
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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/canhan/thongtin.blade.php ENDPATH**/ ?>