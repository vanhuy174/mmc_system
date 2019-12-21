<?php $__env->startSection('content'); ?>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Thêm Giảng Viên</h2>
		<span><a href="<?php echo e(route('home')); ?>">Home</a> > <a href="<?php echo e(route('danh-sach-giang-vien')); ?>">Quản Lý Giảng Viên</a> > <a href="<?php echo e(route('get-them-giang-vien')); ?>">Thêm Giảng Viên</a></span>
	</div>
</div>


<div class="wrapper wrapper-content  animated fadeInRight blog">
    					
    <div class="row my-3">
        <div class="col-lg-12">
            <?php if(count($errors)>0): ?>
                <div class="alert alert-danger">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <strong>Lỗi! </strong><?php echo e($err); ?><br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div> 
            <?php endif; ?>

            <?php if(session('thongbao')): ?>
                <div class="alert alert-success ">
                    <strong>Thành Công! </strong> <?php echo e(session('thongbao')); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="container">
                    <form action="<?php echo e(route('post-them-giang-vien')); ?>" method="post" enctype="multipart/form-data" role="form">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-lg-2 mt-5">
                                <div class="text-cent">
                                    <div class="form-group" >
                                        <input hidden id="img" type="file" name="mmc_avatar" class="form-control hidden" onchange="changeImg(this)" value="<?php echo e(old('mmc_avatar')); ?>">
                                        <img id="avatar" class="thumbnail" width="170px" src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png">
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
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Họ Và Tên: <b style="color:red;" >*</b></span>
                                                    </div>
                                                    <input type="text" name="mmc_name" id="mmc_name" minlength="3" maxlength="50" class="form-control" required autocomplete="off" value="<?php echo e(old('mmc_name')); ?>">
                                                    
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Mã giảng viên: <b style="color:red;" >*</b></span>
                                                    </div>
                                                    <input type="text" name="mmc_employeeid" id="mmc_employeeid" value="<?php echo e($ids); ?>" minlength="3" maxlength="50" class="form-control" required readonly autocomplete="off" value="<?php echo e(old('mmc_employeeid')); ?>">
                                                    
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Tên bộ môn: <b style="color:red;" >*</b></span>
                                                    </div>
                                                    <select class="form-control" id="mmc_deptid" name="mmc_deptid" required>
                                                        
                                                        <?php $__currentLoopData = $bomon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($bm->mmc_deptid); ?>"><?php echo e($bm->mmc_deptname); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Ngày tháng và năm sinh: </span>
                                                    </div>
                                                    <input type="date" name="mmc_dateofbirth" id="mmc_dateofbirth" class="form-control" data-format="dd/mm/yyyy" autocomplete="off" value="<?php echo e(old('mmc_dateofbirth')); ?>">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Giới tính: </span>
                                                    </div>
                                                    <div class="form-check-inline" style="margin-left: 10px;">
                                                        <label class="form-check-label" for="radio1">
                                                            <input type="radio" class="form-check-input" id="radio1" name="mmc_gender" value="0" checked>Nam
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label" for="radio2">
                                                            <input type="radio" class="form-check-input" id="radio2" name="mmc_gender" value="1">Nữ
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Số chứng minh nhân dân:</span>
                                                    </div>
                                                    <input type="number" name="mmc_personalid" id="mmc_personalid" class="form-control" min="0"  autocomplete="off" value="<?php echo e(old('mmc_personalid')); ?>">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Ngày cấp:</span>
                                                    </div>
                                                    <input type="date" name="mmc_dateofpid" id="mmc_dateofpid" class="form-control" data-format="dd/mm/yyyy"  autocomplete="off" value="<?php echo e(old('mmc_dateofpid')); ?>">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Số bảo hiểm xã hội: </span>
                                                    </div>
                                                    <input type="number" name="mmc_socialinsuranceid" id="mmc_socialinsuranceid" class="form-control" min="0"   autocomplete="off" value="<?php echo e(old('mmc_socialinsuranceid')); ?>"> 
                                                </div>
                                                
                                            </div>
        
                                            <div class="col-md-6">
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Số điện thoại: <b style="color:red;" >*</b> </span>
                                                    </div>
                                                    <input type="number" name="mmc_phone" id="mmc_phone" min="0" class="form-control" required autocomplete="off" value="<?php echo e(old('mmc_phone')); ?>">
                                                    
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Email: <b style="color:red;" >*</b> </span>
                                                    </div>
                                                    <input type="email" name="email" id="email" minlength="3" maxlength="225" class="form-control" required autocomplete="off" value="<?php echo e(old('email')); ?>">
                                                    
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Dân tộc:</span>
                                                    </div>
                                                    <input type="text" name="mmc_religion" id="mmc_religion" class="form-control" minlength="3" autocomplete="off" value="<?php echo e(old('mmc_religion')); ?>">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Tôn giáo:</span>
                                                    </div>
                                                    <input type="text" name="mmc_ethnic" id="mmc_ethnic" class="form-control" minlength="3" autocomplete="off" value="<?php echo e(old('mmc_ethnic')); ?>">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Nơi Sinh:</span>
                                                    </div>
                                                    <textarea class="form-control md-textarea" rows="2" name="mmc_placeofbirth" id="mmc_placeofbirth" minlength="3" placeholder="Số nhà, đường phố, thành phố, xóm, thôn, xã, huyện, tỉnh.." autocomplete="off" value="<?php echo e(old('mmc_placeofbirth')); ?>"><?php echo e(old('mmc_placeofbirth')); ?></textarea>
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Quê quán:</span>
                                                    </div>
                                                    <textarea class="form-control md-textarea" rows="2" name="mmc_hometown" id="mmc_hometown" minlength="3" placeholder="Số nhà, đường phố, thành phố, xóm, thôn, xã, huyện, tỉnh.." autocomplete="off" value="<?php echo e(old('mmc_hometown')); ?>"><?php echo e(old('mmc_placeofbirth')); ?></textarea>
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Hộ khẩu thường trú:</span>
                                                    </div>
                                                    <textarea class="form-control md-textarea" rows="2" name="mmc_address" id="mmc_address" minlength="3" placeholder="Số nhà, đường phố, thành phố, xóm, thôn, xã, huyện, tỉnh.." autocomplete="off" value="<?php echo e(old('mmc_address')); ?>"><?php echo e(old('mmc_placeofbirth')); ?></textarea>
                                                </div>
        
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane container fade" id="menu1">
                                         
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Ngày tuyển dụng : </span>
                                                    </div>
                                                    <input type="date" name="mmc_dateofrecruit" id="mmc_dateofrecruit" class="form-control" data-format="dd/mm/yyyy" autocomplete="off" value="<?php echo e(old('mmc_dateofrecruit')); ?>">
                                                </div>
                                                
                                            </div>
        
                                            <div class="col-md-6">
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Chức vụ hiện tại: </span>
                                                    </div>
                                                    
                                                    <textarea class="form-control md-textarea" rows="2" name="mmc_position" id="mmc_position" minlength="3" autocomplete="off" value="<?php echo e(old('mmc_position')); ?>"><?php echo e(old('mmc_position')); ?></textarea>
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Công việc chính được giao: </span>
                                                    </div>
                                                    
                                                    <textarea class="form-control md-textarea" rows="2" name="mmc_maintask" id="mmc_maintask" minlength="3" autocomplete="off" value="<?php echo e(old('mmc_maintask')); ?>"><?php echo e(old('mmc_maintask')); ?></textarea>
                                                </div>
        
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane container fade" id="menu2">
                                         
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Ngạch công chức : </span>
                                                    </div>
                                                    <input type="text" name="mmc_nameofjob" id="mmc_nameofjob" class="form-control" minlength="1" autocomplete="off" value="<?php echo e(old('mmc_nameofjob')); ?>">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Mã Ngạch: </span>
                                                    </div>
                                                    <input type="text" name="mmc_codeofjob" id="mmc_codeofjob" class="form-control" minlength="1" autocomplete="off" value="<?php echo e(old('mmc_codeofjob')); ?>">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Bậc lương:</span>
                                                    </div>
                                                    <input type="number" step="any" min="0" name="mmc_salarylevel" id="mmc_salarylevel" class="form-control" minlength="1"  autocomplete="off" value="<?php echo e(old('mmc_salarylevel')); ?>">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Hệ số: </span>
                                                    </div>
                                                    <input type="number" step="any" min="0" name="mmc_salaryratio" id="mmc_salaryratio" class="form-control" minlength="1" autocomplete="off" value="<?php echo e(old('mmc_salaryratio')); ?>">
                                                </div>
                                                
                                            </div>
        
                                            <div class="col-md-6">
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Phụ cấp chức vụ:  </span>
                                                    </div>
                                                    <input type="number" step="any" min="0" name="mmc_salaryposition" id="mmc_salaryposition" class="form-control" minlength="1" autocomplete="off" value="<?php echo e(old('mmc_salaryposition')); ?>">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Phụ cấp khác: </span>
                                                    </div>
                                                    <input type="number" step="any" min="0" name="mmc_salaryother" id="mmc_salaryother" class="form-control" minlength="1" autocomplete="off" value="<?php echo e(old('mmc_salaryother')); ?>">
                                                </div>
        
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane container fade" id="menu3">
                                               
                                        <div class="row">
                                            <div class="col-md-6">
                                                    <div class="input-group mb-3 input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Trình độ chuyên môn cao nhất: </span>
                                                        </div>
                                                        <textarea class="form-control md-textarea" rows="2" name="mmc_degree" id="mmc_degree" minlength="1" placeholder="TSKH, TS, ThS, cử nhân, kỹ sư, cao đẳng, trung cấp, sơ cấp, chuyên ngành..." autocomplete="off" value="<?php echo e(old('mmc_degree')); ?>"><?php echo e(old('mmc_degree')); ?></textarea>
                                                    </div>
                                                    <div class="input-group mb-3 input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Ngoại ngữ:  </span>
                                                        </div>
                                                        <textarea class="form-control md-textarea" rows="2" name="mmc_language" id="mmc_language" minlength="1" placeholder="Tên ngoại ngữ + Trình độ A, B, C, D......" autocomplete="off" value="<?php echo e(old('mmc_language')); ?>"><?php echo e(old('mmc_language')); ?></textarea>
                                                    </div>
                                                    <div class="input-group mb-3 input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Tin học: </span>
                                                        </div>
                                                        <textarea class="form-control md-textarea" rows="2" name="mmc_itlevel" id="mmc_itlevel" minlength="1" placeholder="Trình độ A, B, C,......" autocomplete="off" value="<?php echo e(old('mmc_itlevel')); ?>"><?php echo e(old('mmc_itlevel')); ?></textarea>
                                                    </div>
                                                
                                            </div>

                                            <div class="col-md-6">
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Lý luận chính trị: </span>
                                                    </div>
                                                    <textarea class="form-control md-textarea" rows="2" name="mmc_politiclevel" id="mmc_politiclevel" minlength="1" autocomplete="off" value="<?php echo e(old('mmc_politiclevel')); ?>"><?php echo e(old('mmc_politiclevel')); ?></textarea>
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Quản lý nhà nước: </span>
                                                    </div>
                                                    <textarea class="form-control md-textarea" rows="2" name="mmc_managementlevel" id="mmc_managementlevel" minlength="1" autocomplete="off" value="<?php echo e(old('mmc_managementlevel')); ?>"><?php echo e(old('mmc_managementlevel')); ?></textarea>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane container fade" id="menu4">
                                               
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Ngày vào Đảng Cộng sản Việt Nam: </span>
                                                    </div>
                                                    <input type="date" name="mmc_partydate" id="mmc_partydate" class="form-control" data-format="dd/mm/yyyy" autocomplete="off" value="<?php echo e(old('mmc_partydate')); ?>">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Ngày chính thức: </span>
                                                    </div>
                                                    <input type="date" name="mmc_partydateprimary" id="mmc_partydateprimary" class="form-control" data-format="dd/mm/yyyy" autocomplete="off" value="<?php echo e(old('mmc_partydateprimary')); ?>">
                                                </div>
                                                
                                            </div>

                                            <div class="col-md-6">
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Khen thưởng:  </span>
                                                    </div>
                                                    <textarea class="form-control md-textarea" rows="2" name="mmc_reward" id="mmc_reward" minlength="1" placeholder="Hình thức cao nhất, năm nào" autocomplete="off" value="<?php echo e(old('mmc_reward')); ?>"><?php echo e(old('mmc_reward')); ?></textarea>
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Kỷ luật: </span>
                                                    </div>
                                                    <textarea class="form-control md-textarea" rows="2" name="mmc_discipline" id="mmc_discipline" minlength="1" placeholder="về đảng, chính quyền, đoàn thể hình thức cao nhất, năm nào" autocomplete="off" value="<?php echo e(old('mmc_discipline')); ?>"><?php echo e(old('mmc_discipline')); ?></textarea>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane container fade" id="menu5">
                                         
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Tình trạng sức khoẻ: </span>
                                                    </div>
                                                    <textarea class="form-control md-textarea" rows="2" name="mmc_heathlevel" id="mmc_heathlevel" minlength="1" autocomplete="off" value="<?php echo e(old('mmc_heathlevel')); ?>"><?php echo e(old('mmc_heathlevel')); ?></textarea>
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Nhóm máu: </span>
                                                    </div>
                                                    <input type="text" name="mmc_bloodgroup" id="mmc_bloodgroup" class="form-control" minlength="1" placeholder="O, A, B" autocomplete="off" value="<?php echo e(old('mmc_bloodgroup')); ?>">
                                                </div>
                                                
                                            </div>

                                            <div class="col-md-6">
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Chiều cao: </span>
                                                    </div>
                                                    <input type="number" step="any" min="0" name="mmc_tall" id="mmc_tall" class="form-control" minlength="1" placeholder="m" autocomplete="off" value="<?php echo e(old('mmc_tall')); ?>">
                                                </div>
                                                <div class="input-group mb-3 input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Cân nặng: </span>
                                                    </div>
                                                    <input type="number" step="any" min="0" name="mmc_weight" id="mmc_weight" class="form-control" minlength="1" placeholder="kg" autocomplete="off" value="<?php echo e(old('mmc_address')); ?>">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        

                        
                        <button type="button" class="btn btn-info btn-lg float-right" id="inputGV" data-toggle="modal" data-target="#myModal">Thêm Giảng Viên</button>

                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg" style="max-width:80%">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h4 class="modal-title ">Kiểm Tra Thông Tin</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row ">
                                            <div class="col-lg-3 bg-white ">
                                                <!-- Left Column -->
                                                <div class="w3-third" style="margin-top: 110px; ">
                                                    <div class="w3-white w3-text-grey w3-card-4">
                                                        <div class="w3-display-container ">
                                                            <img id="mmc_avatar1" src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png"  style="width:100%; height=100%" >
                                                        </div>
                                                        <div class="w3-container my-3">
                                                            <p class="font-weight-bold ">
                                                                <i class=" glyphicon glyphicon-user"></i> 
                                                                <span class=" ml-5" id="mmc_name11"></span>
                                                             </p>
                                                            <p class="font-weight-bold ">
                                                                <i class="glyphicon glyphicon-qrcode fa-fw w3-margin-right w3-large w3-text-teal"></i>
                                                                <span class=" ml-5" id="mmc_employeeid11"></span>
                                                            </p>
                                                            <p class="font-weight-bold ">
                                                                <i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i>
                                                                <span class=" ml-5" id="mmc_phone11"></span>
                                                            </p>
                                                            <p class="font-weight-bold ">
                                                                <i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i>
                                                                <span class=" ml-5" id="email11"></span>
                                                            </p>
                                                            
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
                                                                <h4 class="w3-opacity" >
                                                                    <b>- Họ Và Tên:</b> <span id="mmc_name1"></span>
                                                                </h4>
                                                                
                                                            </div>
                                                            <div class="w3-container my-4">
                                                                <h4 class="w3-opacity">
                                                                    <b>- Mã giảng viên: </b><span id="mmc_employeeid1"></span>
                                                                </h4>
                                                            </div>
                                                            <div class="w3-container my-4">
                                                                <h4 class="w3-opacity">
                                                                    <b>- Mã bộ môn: </b><span id="mmc_deptid1"></span>
                                                                </h4>
                                                            </div>
                                                            <div class="w3-container my-4">
                                                                <h4 class="w3-opacity">
                                                                    <b>- Ngày tháng và năm sinh: </b><span id="mmc_dateofbirth1"></span>
                                                                </h4>
                                                            </div>
                                                            <div class="w3-container my-4">
                                                                <h4 class="w3-opacity">
                                                                    <b>- Giới Tính: </b><span id="mmc_gender1"></span>
                                                                </h4>
                                                            </div>
                                                            <div class="w3-container my-4">
                                                                <h4 class="w3-opacity">
                                                                    <b>- Số chứng minh nhân dân: </b><span id="mmc_personalid1"></span>
                                                                </h4>
                                                            </div>
                                                            <div class="w3-container my-4">
                                                                <h4 class="w3-opacity">
                                                                    <b>- Ngày cấp: </b><span id="mmc_dateofpid1"></span>
                                                                </h4>
                                                            </div>
                                                            <div class="w3-container my-4">
                                                                <h4 class="w3-opacity">
                                                                    <b>- Số bảo hiểm xã hội: </b><span id="mmc_socialinsuranceid1"></span>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <div class="w3-container my-4">
                                                                <h4 class="w3-opacity">
                                                                    <b>- Số điện thoại: </b><span id="mmc_phone1"></span>
                                                                </h4>
                                                            </div>
                                                            <div class="w3-container my-4">
                                                                <h4 class="w3-opacity" >
                                                                    <b>- email: </b><span id="email1"></span>
                                                                </h4>
                                                            </div>
                                                            <div class="w3-container my-4">
                                                                <h4 class="w3-opacity">
                                                                    <b>- Dân tộc: </b><span id="mmc_religion1"></span>
                                                                </h4>
                                                            </div>
                                                            <div class="w3-container my-4">
                                                                <h4 class="w3-opacity">
                                                                    <b>- Tôn giáo: </b><span id="mmc_ethnic1"></span>
                                                                </h4>
                                                            </div>
                                                            <div class="w3-container my-4">
                                                                <h4 class="w3-opacity">
                                                                    <b>- Nơi Sinh: </b><span id="mmc_placeofbirth1"></span>
                                                                </h4>
                                                            </div>
                                                            <div class="w3-container my-4">
                                                                <h4 class="w3-opacity">
                                                                    <b>- Quê quán: </b><span id="mmc_hometown1"></span>
                                                                </h4>
                                                            </div>
                                                            <div class="w3-container my-4">
                                                                <h4 class="w3-opacity">
                                                                    <b>- Hộ khẩu thường trú: </b><span id="mmc_address1"></span>
                                                                </h4>
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
                                                            <a class="nav-link active" data-toggle="tab" href="#menu10">NGHỀ NGHIỆP</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#menu11">LƯƠNG THƯỞNG</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#menu12">TRÌNH ĐỘ HỌC VẤN</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#menu13">ĐẢNG</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#menu14">SỨC KHỎE</a>
                                                        </li>
                                                    </ul>
                                                    
                                                    
                                                    <div class="tab-content">
                                                        <div id="menu10" class="container tab-pane active">
                                                            <!-- NGHỀ NGHIỆP-->
                                                            <div class="w3-twothird">
                                                                <div class="row">
                                                                    <div class="col-lg-5">
                                                                        <div class="w3-container my-4">
                                                                            <h4 class="w3-opacity">
                                                                                <b>- Ngày tuyển dụng: </b><span id="mmc_dateofrecruit1"></span>
                                                                            </h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-7">
                                                                        <div class="w3-container my-4">
                                                                            <h4 class="w3-opacity">
                                                                                <b>- Chức vụ hiện tại: </b><span id="mmc_position1"></span>
                                                                            </h4>
                                                                        </div>
                                                                        <div class="w3-container my-4">
                                                                            <h4 class="w3-opacity">
                                                                                <b>- Công việc chính được giao: </b><span id="mmc_maintask1"></span>
                                                                            </h4>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <div id="menu11" class="container tab-pane fade">
                                                            <!-- LƯƠNG THƯỞNG-->
                                                            <div class="w3-twothird">
                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <div class="w3-container my-4">
                                                                                <h4 class="w3-opacity">
                                                                                    <b>- Ngạch công chức: </b><span id="mmc_nameofjob1"></span>
                                                                                </h4>
                                                                            </div>
                                                                            <div class="w3-container my-4">
                                                                                <h4 class="w3-opacity">
                                                                                    <b>- Mã ngạch: </b><span id="mmc_codeofjob1"></span>
                                                                                </h4>
                                                                            </div>
                                                                            <div class="w3-container my-4">
                                                                                <h4 class="w3-opacity">
                                                                                    <b>- Bậc lương: </b><span id="mmc_salarylevel1"></span>
                                                                                </h4>
                                                                            </div>
                                                                            <div class="w3-container my-4">
                                                                                <h4 class="w3-opacity">
                                                                                    <b>- Hệ số: </b><span id="mmc_salaryratio1"></span>
                                                                                </h4>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-7">
                                                                            <div class="w3-container my-4">
                                                                                <h4 class="w3-opacity">
                                                                                    <b>- Phụ cấp chức vụ: </b><span id="mmc_salaryposition1"></span>
                                                                                </h4>
                                                                            </div>
                                                                            <div class="w3-container my-4">
                                                                                <h4 class="w3-opacity">
                                                                                    <b>- Phụ cấp khác: </b><span id="mmc_salaryother1"></span>
                                                                                </h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                        </div>
                                                        <div id="menu12" class="container tab-pane fade">
                                                            <!-- TRÌNH ĐỘ HỌC VẤN -->
                                                            <div class="w3-twothird">
                                                                <div class="row">
                                                                    <div class="col-lg-5">
                                                                        <div class="w3-container my-4">
                                                                            <h4 class="w3-opacity">
                                                                                <b>- Trình độ chuyên môn cao nhất: </b><span id="mmc_degree1"></span>
                                                                            </h4>
                                                                        </div>
                                                                        <div class="w3-container my-4">
                                                                            <h4 class="w3-opacity">
                                                                                <b>- Ngoại ngữ: </b><span id="mmc_language1"></span>
                                                                            </h4>
                                                                        </div>
                                                                        <div class="w3-container my-4">
                                                                            <h4 class="w3-opacity">
                                                                                <b>- Tin học: </b><span id="mmc_itlevel1"></span>
                                                                            </h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-7">
                                                                        <div class="w3-container my-4">
                                                                            <h4 class="w3-opacity">
                                                                                <b>- Lý luận chính trị: </b><span id="mmc_politiclevel1"></span>
                                                                            </h4>
                                                                        </div>
                                                                        <div class="w3-container my-4">
                                                                            <h4 class="w3-opacity">
                                                                                <b>- Quản lý nhà nước: </b><span id="mmc_managementlevel1"></span>
                                                                            </h4>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <div id="menu13" class="container tab-pane fade">
                                                            <!-- ĐẢNG -->
                                                            <div class="w3-twothird">
                                                                <div class="row">
                                                                    <div class="col-lg-5">
                                                                        <div class="w3-container my-4">
                                                                            <h4 class="w3-opacity">
                                                                                <b>- Ngày vào Đảng Cộng sản Việt Nam: </b><span id="mmc_partydate1"></span>
                                                                            </h4>
                                                                        </div>
                                                                        <div class="w3-container my-4">
                                                                            <h4 class="w3-opacity">
                                                                                <b>- Ngày chính thức: </b><span id="mmc_partydateprimary1"></span>
                                                                            </h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-7">
                                                                        <div class="w3-container my-4">
                                                                            <h4 class="w3-opacity">
                                                                                <b>- Khen thưởng:</b><span id="mmc_reward1"></span>
                                                                            </h4>
                                                                        </div>
                                                                        <div class="w3-container my-4">
                                                                            <h4 class="w3-opacity">
                                                                                <b>- Kỷ luật: </b><span id="mmc_discipline1"></span>
                                                                            </h4>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <div id="menu14" class="container tab-pane fade">
                                                            <!-- SỨC KHỎE -->
                                                            <div class="w3-twothird">
                                                                <div class="row">
                                                                    <div class="col-lg-5">
                                                                        <div class="w3-container my-4">
                                                                            <h4 class="w3-opacity">
                                                                                <b>- Tình trạng sức khoẻ: </b><span id="mmc_heathlevel1"></span>
                                                                            </h4>
                                                                        </div>
                                                                        <div class="w3-container my-4">
                                                                            <h4 class="w3-opacity">
                                                                                <b>- Nhóm máu: </b><span id="mmc_bloodgroup1"></span>
                                                                            </h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-7">
                                                                        <div class="w3-container my-4">
                                                                            <h4 class="w3-opacity">
                                                                                <b>- Chiều cao: </b><span id="mmc_tall1"></span>
                                                                            </h4>
                                                                        </div>
                                                                        <div class="w3-container my-4">
                                                                            <h4 class="w3-opacity">
                                                                                <b>- Cân nặng: </b><span id="mmc_weight1"></span>
                                                                            </h4>
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

                                    <div class="mx-5 my-3">
                                        <button type="submit" class="btn btn-success float-right" >Gửi</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/GiangVien/ThemGV.blade.php ENDPATH**/ ?>