<?php $__env->startSection('linkstyle'); ?>
	<link href="../../css/mmc_homestudent.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Quản lý sinh viên</h2>
		<span><a href="<?php echo e(route('home')); ?>">Trang chủ</a> > <a href="<?php echo e(route('homeStudent')); ?>">Quản lý sinh viên</a></span>
	</div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight blog">
	<?php if(session('status')): ?>
	<br> <div id="error" class="alert alert-info"><?php echo e(session('status')); ?></div>
	<?php endif; ?>
	<?php if($errors->any()): ?>
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
        <ul style="overflow-y: scroll; max-height: 250px;">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">Danh sách sinh viên</div>
				<div class="card-body">
					<div class="padding-5">
						<a class="btn btn-primary float-left" href="<?php echo e(route('formcreateStudent')); ?>">Thêm mới</a>
						<a class="btn btn-primary float-left margin-left-10" href="" data-toggle="modal" data-target="#themfile">Thêm bằng file</a>
						<a class="btn btn-primary float-left margin-left-10" href="<?php echo e(route('exportStudent')); ?>">Xuất ra file</a>
						<!-- Modal -->
						<div class="modal fade" id="themfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h3 class="modal-title" id="exampleModalLabel">Thêm sinh viên bằng file.</h3>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="<?php echo e(route('importStudent')); ?>" method="POST" enctype="multipart/form-data">
										<?php echo csrf_field(); ?>
										<div class="modal-body">
											<input type="file" class="form-control" required="required" name="file">
										</div>
										<div class="modal-footer">
											<span>Bạn chưa có mẫu file: <a href="<?php echo e(route('downloadfileExcel')); ?>"> Nhấn vào đây </a> để tải về </span>
											<button type="submit" class="btn btn-primary">Thêm</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<form action="<?php echo e(route('homeStudent')); ?>" method="get" role="form">
							
							<div class="input-group mb-3 center-block width-40 float-right">
								<input type="text" class="form-control" placeholder="Nhập họ tên, mã sinh viên, ngành hoặc email" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" name="search">
								<div class="input-group-append">
									<button class="btn btn-primary margin-bottom">Tìm kiếm</button>
								</div>
							</div>
						</form>
					</div>

					<table class="table table-hover">
						<tr>
							<th>Họ tên</th>
							<th>Mã sinh viên</th>
							<th>Lớp</th>
							<th>Ngày sinh</th>
							<th>Giới tính</th>
							<th>Email</th>
							<th>Số điện thoại</th>
							<th>Thao tác</th>
						</tr>
						<?php if(isset($data)): ?>
						<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>

							<td><?php echo e($row->mmc_fullname); ?></td>
							<td><?php echo e($row->mmc_studentid); ?></td>
							<td>
								<?php $__currentLoopData = $data_class; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($classid['mmc_classid'] == $row['mmc_classid']): ?>
										<?php echo e($classid['mmc_classname']); ?>

									<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</td>
							<td><?php echo e(date('d-m-Y', strtotime($row['mmc_dateofbirth']))); ?></td>
							<td>
								<?php if($row->mmc_gender == 0): ?> Nam 
								<?php else: ?> Nữ
								<?php endif; ?>
							</td>
							<td><?php echo e($row->mmc_email); ?></td>
							<td><?php echo e($row->mmc_phone); ?></td>
							<td>
								<a href="<?php echo e(route('showStudent',['id'=>$row['id']])); ?>" title="View User"><button class="btn btn-info btn-sm">Xem</button></a>
								<a href="<?php echo e(route('editStudent',['id'=>$row['id']])); ?>" title="Edit User"><button class="btn btn-primary btn-sm">Sửa</button></a>
								<a href="<?php echo e(route('destroyStudent',['id'=>$row['id']])); ?>" onclick="return confirm('Bạn có muốn xoá không!')"><button class="btn btn-danger btn-sm">Xoá</button></a>
							</td>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
					</table>
					<div class="pagination justify-content-center"> <?php echo $data->appends(['search' => Request::get('search')])->render(); ?> </div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/Student/mmc_homeStudent.blade.php ENDPATH**/ ?>