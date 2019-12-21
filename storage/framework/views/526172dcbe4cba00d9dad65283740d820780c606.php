<?php $__env->startSection('linkstyle'); ?>
<link href="../../css/mmc_createstudent.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Quản lý sinh viên</h2>
		<span><a href="<?php echo e(route('home')); ?>">Trang chủ</a> > <a href="<?php echo e(route('homeStudent')); ?>">Quản lý sinh viên</a> > Thêm sinh viên</span>
	</div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight blog">
	<?php if($errors->any()): ?>
	<div id="error" class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">Thêm mới sinh viên</div>
				<div class="card-body">
					<div class="container">
						<div class="text-center">
							<h2>SƠ YẾU LÝ LỊCH SINH VIÊN</h2>
						</div>
						<?php if(session('status')): ?>
						<br> <div class="alert alert-info"><?php echo e(session('status')); ?></div>
						<?php endif; ?>

						<form action="<?php echo e(route('createStudent')); ?>" method="post" role="form">
							<?php echo e(csrf_field()); ?>

							<div class="row">
								<div class="col-md-12">
									<h3 class="tieude">I. PHẦN BẢN THÂN SINH VIÊN</h3>
								</div>
								<div class="col-md-6">
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Họ và tên: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="text" name="mmc_fullname" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" value="<?php echo e(old('mmc_fullname')); ?>">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Ngày tháng và năm sinh: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="date" name="mmc_dateofbirth" class="form-control" data-format="dd/mm/yyyy" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" value="<?php echo e(old('mmc_dateofbirth')); ?>">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Dân tộc: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="text" name="mmc_ethnic" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" value="<?php echo e(old('mmc_ethnic')); ?>">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Tôn giáo: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="text" name="mmc_religion" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" value="<?php echo e(old('mmc_religion')); ?>">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Số chứng minh nhân dân: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="int" name="mmc_personalid" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" value="<?php echo e(old('mmc_religion')); ?>">
									</div>
									<div class="form-group">
										<label for="comment">Khen thưởng: </label>
										<textarea  name="mmc_reward" class="form-control" rows="4"><?php echo e(old('mmc_reward')); ?></textarea>
									</div>
									
								</div>

								<div class="col-md-6">
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Lớp: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<select class="form-control" id="sel1" name="mmc_classid">
											<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($classid['mmc_classid']); ?>"><?php echo e($classid['mmc_classname']); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Mã sinh viên: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="text" name="mmc_studentid" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" value="<?php echo e(old('mmc_studentid')); ?>">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Giới tính: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<div class="form-check-inline margin-left-10">
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
											<span class="input-group-text">Hộ khẩu thường trú: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="text" name="mmc_address" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" value="<?php echo e(old('mmc_address')); ?>">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Số điện thoại: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="int" name="mmc_phone" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" value="<?php echo e(old('mmc_phone')); ?>">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Email: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="email" name="mmc_email" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" value="<?php echo e(old('mmc_email')); ?>">
									</div>
									<div class="form-group">
										<label for="comment">Kỷ luật: </label>
										<textarea  name="mmc_descipline" class="form-control" rows="2"><?php echo e(old('mmc_descipline')); ?></textarea>
									</div>
								</div>

							</div>
							<br>

							<div class="row">
								<div class="col-md-12">
									<h3 class="tieude">II. THÀNH PHẦN GIA ĐÌNH</h3>
								</div>
								<div class="col-md-12">
									<h4>1. Cha:</h4>
								</div>

								<div class="col-md-6">
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Họ và tên: </span>
										</div>
										<input type="text" name="mmc_father" class="form-control" autocomplete="off" value="<?php echo e(old('mmc_father')); ?>">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Dân tộc: </span>
										</div>
										<input type="text" name="mmc_fatherethnic" class="form-control" autocomplete="off" value="<?php echo e(old('mmc_fatherethnic')); ?>">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Số điện thoại: </span>
										</div>
										<input type="text" name="mmc_fatherphone" class="form-control" autocomplete="off" value="<?php echo e(old('mmc_fatherphone')); ?>">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Email: </span>
										</div>
										<input type="email" name="mmc_fatheremail" class="form-control"  autocomplete="off" value="<?php echo e(old('mmc_fatheremail')); ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Quốc tịnh: </span>
										</div>
										<input type="text" name="mmc_fathernationality" class="form-control" autocomplete="off" value="<?php echo e(old('mmc_fathernationality')); ?>">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Tôn giáo: </span>
										</div>
										<input type="text" name="mmc_fatherreligion" class="form-control" autocomplete="off" value="<?php echo e(old('mmc_fatherreligion')); ?>">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Nghề nghiệp: </span>
										</div>
										<input type="text" name="mmc_fatherjob" class="form-control" autocomplete="off" value="<?php echo e(old('mmc_fatherjob')); ?>">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Hộ khẩu thường trú: </span>
										</div>
										<input type="text" name="mmc_fatheraddress" class="form-control" autocomplete="off" value="<?php echo e(old('mmc_fatheraddress')); ?>">
									</div>
								</div>
							</div>
							<h4>2. Mẹ:</h4>
							<div class="row">
								<div class="col-md-6">
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Họ và tên: </span>
										</div>
										<input type="text" name="mmc_mother" class="form-control" autocomplete="off" value="<?php echo e(old('mmc_mother')); ?>">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Dân tộc: </span>
										</div>
										<input type="text" name="mmc_motherethnic" class="form-control" autocomplete="off" value="<?php echo e(old('mmc_motherethnic')); ?>">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Số điện thoại: </span>
										</div>
										<input type="text" name="mmc_motherphone" class="form-control" autocomplete="off" value="<?php echo e(old('mmc_motherphone')); ?>">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Email: </span>
										</div>
										<input type="email" name="mmc_motheremail" class="form-control"  autocomplete="off" value="<?php echo e(old('mmc_motheremail')); ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Quốc tịnh: </span>
										</div>
										<input type="text" name="mmc_mothernationality" class="form-control" autocomplete="off" value="<?php echo e(old('mmc_mothernationality')); ?>">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Tôn giáo: </span>
										</div>
										<input type="text" name="mmc_motherreligion" class="form-control" autocomplete="off" value="<?php echo e(old('mmc_motherreligion')); ?>">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Nghề nghiệp: </span>
										</div>
										<input type="text" name="mmc_motherjob" class="form-control" autocomplete="off" value="<?php echo e(old('mmc_motherjob')); ?>">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Hộ khẩu thường trú: </span>
										</div>
										<input type="text" name="mmc_motheraddress" class="form-control" autocomplete="off" value="<?php echo e(old('mmc_motheraddress')); ?>">
									</div>
								</div>

							</div>
							<input class="btn btn-primary" type="submit" name="" value="Thêm thông tin">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/Student/mmc_createStudent.blade.php ENDPATH**/ ?>