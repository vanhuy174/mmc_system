<?php $__env->startSection('linkstyle'); ?>
<link href="css/mmc_detailstudent.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Quản lý sinh viên</h2>
		<span><a href="<?php echo e(route('home')); ?>">Trang chủ</a> > <a href="<?php echo e(route('homeStudent')); ?>">Quản lý sinh viên</a> > Thông tin sinh viên</span>
	</div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight blog">
	<?php if(session('status')): ?>
	<br> <div class="alert alert-info"><?php echo e(session('status')); ?></div>
	<?php endif; ?>
    <div class="row">
        <div class="col-lg-12">
        <a href="" class=" btn btn-primary btn-sm float-right " title="Xuất File">
            <i class="fa fa-arrow-right" aria-hidden="true"></i> Xuất file PDF
        </a>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">Thông tin sinh viên</div>
				<div class="card-body">
					<div class="container">
						<div class="text-center">
							<h2>SƠ YẾU LÝ LỊCH SINH VIÊN</h2>
						</div>
						<div class="row margin-top-10 font-size">

							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<h3 class="margin-top-10">I. PHẦN BẢN THÂN SINH VIÊN</h3>
									</div>
									<div class="col-md-6">
										<div class="input-group mb-3 input-group-sm">
											<span>Họ và tên: &nbsp;&nbsp;<?php echo e($data['mmc_fullname']); ?></span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Ngày tháng và năm sinh: &nbsp;&nbsp;<?php echo e(date('d-m-Y', strtotime($data['mmc_dateofbirth']))); ?></span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Dân tộc: &nbsp;&nbsp;<?php echo e($data['mmc_ethnic']); ?></span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Tôn giáo: &nbsp;&nbsp;<?php echo e($data['mmc_religion']); ?></span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Số điện thoại: &nbsp;&nbsp;<?php echo e($data['mmc_phone']); ?></span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Email: &nbsp;&nbsp;<?php echo e($data['mmc_email']); ?></span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Khen thưởng: &nbsp;&nbsp;<?php echo e($data['mmc_reward']); ?></span>
										</div>
									</div>

									<div class="col-md-6">
										<div class="input-group mb-3 input-group-sm">
											<span>Lớp: &nbsp;&nbsp;
											<?php $__currentLoopData = $data_class; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<?php if($classid['mmc_classid'] == $data['mmc_classid']): ?>
													<?php echo e($classid['mmc_classname']); ?>

												<?php endif; ?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Mã sinh viên: &nbsp;&nbsp;<?php echo e($data['mmc_studentid']); ?></span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Giới tính: &nbsp;&nbsp;</span>
											<?php if($data['mmc_gender']==1): ?>
											<span>Nữ</span>
											<?php else: ?>
											<span>Nam</span>
											<?php endif; ?>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Hộ khẩu thường trú: &nbsp;&nbsp;<?php echo e($data['mmc_address']); ?></span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Số chứng minh nhân dân: &nbsp;&nbsp;<?php echo e($data['mmc_personalid']); ?></span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Kỷ luật: &nbsp;&nbsp;<?php echo e($data['mmc_descipline']); ?></span>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<h3 class="margin-top-10">II. THÀNH PHẦN GIA ĐÌNH</h3>
									</div>
									<div class="col-md-12">
										<h3>1. Cha:</h3>
									</div>

									<div class="col-md-6">
										<div class="input-group mb-3 input-group-sm">
											<span>Họ và tên: &nbsp;&nbsp;<?php echo e($data['mmc_father']); ?></span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Dân tộc: &nbsp;&nbsp;<?php echo e($data['mmc_fatherethnic']); ?></span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Số điện thoại: &nbsp;&nbsp;<?php echo e($data['mmc_fatherphone']); ?></span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Email: &nbsp;&nbsp;<?php echo e($data['mmc_fatheremail']); ?></span>
										</div>

									</div>
									<div class="col-md-6">
										<div class="input-group mb-3 input-group-sm">
											<span>Quốc tịnh: &nbsp;&nbsp;<?php echo e($data['mmc_fathernationality']); ?></span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Tôn giáo: &nbsp;&nbsp;<?php echo e($data['mmc_fatherreligion']); ?></span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Nghề nghiệp: &nbsp;&nbsp;<?php echo e($data['mmc_fatherjob']); ?></span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Hộ khẩu thường trú: &nbsp;&nbsp;<?php echo e($data['mmc_fatheraddress']); ?></span>
										</div>
									</div>
								</div>
								<h3>2. Mẹ:</h3>
								<div class="row">
									<div class="col-md-6">
										<div class="input-group mb-3 input-group-sm">
											<span>Họ và tên: &nbsp;&nbsp;<?php echo e($data['mmc_mother']); ?></span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Dân tộc: &nbsp;&nbsp;<?php echo e($data['mmc_motherethnic']); ?></span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Số điện thoại: &nbsp;&nbsp;<?php echo e($data['mmc_motherphone']); ?></span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Email: &nbsp;&nbsp;<?php echo e($data['mmc_motheremail']); ?></span>
										</div>

									</div>
									<div class="col-md-6">
										<div class="input-group mb-3 input-group-sm">
											<span>Quốc tịnh: &nbsp;&nbsp;<?php echo e($data['mmc_mothernationality']); ?></span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Tôn giáo: &nbsp;&nbsp;<?php echo e($data['mmc_motherreligion']); ?></span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Nghề nghiệp: &nbsp;&nbsp;<?php echo e($data['mmc_motherjob']); ?></span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Hộ khẩu thường trú: &nbsp;&nbsp;<?php echo e($data['mmc_motheraddress']); ?></span>
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
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/Student/mmc_detailStudent.blade.php ENDPATH**/ ?>