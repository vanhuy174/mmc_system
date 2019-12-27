<?php $__env->startSection('linkstyle'); ?>
	<link href="../../css/mmc_homestudent.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Quản lý lịch giảng dạy</h2>
		<span><a href="<?php echo e(route('home')); ?>">Trang chủ</a> > <a href="<?php echo e(route('homeCalendar')); ?>">Quản lý lịch giảng dạy</a></span>
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
				<div class="card-header">Lịch giảng dạy</div>
				<div class="card-body">
					<div class="padding-5">
						<a class="btn btn-primary float-left margin-left-10" href="" data-toggle="modal" data-target="#themfile">Thêm bằng file</a>
						
						<!-- Modal -->
						<div class="modal fade" id="themfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h3 class="modal-title" id="exampleModalLabel">Thêm lịch giảng dạy bằng file.</h3>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="<?php echo e(route('importCalendar')); ?>" method="POST" enctype="multipart/form-data">
										<?php echo csrf_field(); ?>
										<div class="modal-body">
											<input type="file" class="form-control" required="required" name="file">
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary">Thêm</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Tên giảng viên</th>
                                    <th>Bộ môn</th>
                                    <th>Lớp học phần</th>
                                    <th>Số tín chỉ</th>
                                    <th>Số tiết</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                	 <tr>
                                        <td><?php echo e($item->mmc_name); ?></td>
                                        <td><?php echo e($item->department->mmc_deptname); ?></td>
                                        <td>
		                                	<?php $__currentLoopData = $item->subjectclass; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sjc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                                        <?php echo e($sjc->mmc_subjectclassname); ?></br>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</td>
                                        <td>
                                        	<?php $__currentLoopData = $item->subjectclass; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sjc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                                        <?php echo e($sjc->subject->mmc_theory + $sjc->subject->mmc_practice); ?></br>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                        <td>
                                        	<?php $__currentLoopData = $item->subjectclass; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sjc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                                        <?php echo e(tinhsotiet($sjc->subject->mmc_theory, $sjc->subject->mmc_practice)); ?></br>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
									</tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/calendar/index.blade.php ENDPATH**/ ?>