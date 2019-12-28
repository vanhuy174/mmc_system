<?php $__env->startSection('linkstyle'); ?>
	<link href="css/mmc_homestudent.css" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function() {
            $('#amajor').on('change', function () {
                var selectVal = $(this).val();
                console.log(selectVal);
                $.ajax({
                    method: "POST",
                    url: "<?php echo e(route('aajaxmajor')); ?>",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        "id": selectVal},
                    success : function ( data ) {
                        $('#aclass').html(data);
                    }
                })
            });
            $('#modalmajor').on('change', function () {
                var selectVal = $(this).val();
                console.log(selectVal);
                $.ajax({
                    method: "POST",
                    url: "<?php echo e(route('aajaxmajor')); ?>",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        "id": selectVal},
                    success : function ( data ) {
                        $('#modalclass').html(data);
                    }
                })
            });
            $("#checkall").click(function() {
                $(":checkbox").attr('checked',
                    $('#checkall').is(':checked'));
                $(this).closest('tr').toggleClass('highlight');
            });
        });
    </script>
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
				<div class="card-header">
                    <form class="form-inline" action="<?php echo e(route('homeStudent')); ?>">
                            <div class="form-group mb-2">
                                <label for="amajor">Ngành:&emsp;</label>
                                <select class="form-control" id="amajor" name="manghanh">
                                    <?php if(isset($majorid)): ?>
                                        <option value="">...</option>
                                        <?php $__currentLoopData = $data_major; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($majorid == $key->mmc_majorid): ?>
                                                <option value="<?php echo e($key->mmc_majorid); ?>" selected><?php echo e($key->mmc_majorname); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <option value="">...</option>
                                    <?php endif; ?>
                                    <?php $__currentLoopData = $data_major; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key->mmc_majorid); ?>"><?php echo e($key->mmc_majorname); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="aclass">&emsp;Lớp:&emsp;</label>
                                <select class="form-control width-200" id="aclass" name="malop">
                                    <?php if(isset($classid)): ?>
                                        <?php $__currentLoopData = $data_class; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($classid == $key->mmc_classid): ?>
                                                <option value="<?php echo e($key->mmc_classid); ?>" selected><?php echo e($key->mmc_classname); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <option value="">...</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="aclass">&emsp;Trạng thái:&emsp;</label>
                                <select class="form-control width-200" name="status">
                                    <option value="">...</option>
                                    <option <?php if(isset($status) && $status == 'danghoc') echo 'selected';?> value="danghoc">Đang học</option>
                                    <option <?php if(isset($status) && $status == 'baoluu') echo 'selected';?> value="baoluu">Bảo lưu</option>
                                    <option <?php if(isset($status) && $status == 'dinhchi') echo 'selected';?> value="dinhchi">Đình chỉ</option>
                                    <option <?php if(isset($status) && $status == 'thoihoc') echo 'selected';?> value="thoihoc">Thôi học</option>
                                    <option <?php if(isset($status) && $status == 'totngiep') echo 'selected';?> value="totngiep">Tốt nghiệp</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <button class="btn btn-primary" type="submit">Xem</button>
                            </div>
                    </form>
                </div>
				<div class="card-body">
					<div class="padding-5">
						<a class="btn btn-primary float-left" href="<?php echo e(route('formcreateStudent')); ?>">Thêm mới</a>
						<a class="btn btn-primary float-left margin-left-10" href="" data-toggle="modal" data-target="#themfile">Nhập file</a>
						<a class="btn btn-primary float-left margin-left-10" href="" data-toggle="modal" data-target="#xuatfile">Xuất file</a>
						<!-- Modal them bang file excel-->
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
                        <!-- Modal xuất ra file excel-->
                        <div class="modal fade" id="xuatfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="exampleModalLabel">Xuất file Excel danh sách sinh viên.</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?php echo e(route('exportStudent')); ?>">
                                        <div class="modal-body">
                                            <div class="form-group mb-2">
                                                <label for="amajor">Ngành:&emsp;</label>
                                                <select class="form-control" id="modalmajor" name="manghanh">
                                                    <?php if(isset($majorid)): ?>
                                                        <option value="">...</option>
                                                        <?php $__currentLoopData = $data_major; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($majorid == $key->mmc_majorid): ?>
                                                                <option value="<?php echo e($key->mmc_majorid); ?>" selected><?php echo e($key->mmc_majorname); ?></option>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <option value="">...</option>
                                                    <?php endif; ?>
                                                    <?php $__currentLoopData = $data_major; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($key->mmc_majorid); ?>"><?php echo e($key->mmc_majorname); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="aclass">&emsp;Lớp:&emsp;</label>
                                                <select class="form-control" id="modalclass" name="malop">
                                                    <?php if(isset($classid)): ?>
                                                        <?php $__currentLoopData = $data_class; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($classid == $key->mmc_classid): ?>
                                                                <option value="<?php echo e($key->mmc_classid); ?>" selected><?php echo e($key->mmc_classname); ?></option>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <option value="">...</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="aclass">&emsp;Trạng thái:&emsp;</label>
                                                <select class="form-control" name="status">
                                                    <option value="">...</option>
                                                    <option <?php if(isset($status) && $status == 'danghoc') echo 'selected';?> value="danghoc">Đang học</option>
                                                    <option <?php if(isset($status) && $status == 'baoluu') echo 'selected';?> value="baoluu">Bảo lưu</option>
                                                    <option <?php if(isset($status) && $status == 'dinhchi') echo 'selected';?> value="dinhchi">Đình chỉ</option>
                                                    <option <?php if(isset($status) && $status == 'thoihoc') echo 'selected';?> value="thoihoc">Thôi học</option>
                                                    <option <?php if(isset($status) && $status == 'totngiep') echo 'selected';?> value="totngiep">Tốt nghiệp</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Xuất file</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
						<form action="<?php echo e(route('homeStudent')); ?>" method="get" role="form">
							
							<div class="input-group mb-3 center-block width-40 float-right">
								<input type="text" class="form-control" placeholder="Nhập họ tên, mã sinh viên hoặc email" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" name="search">
								<div class="input-group-append">
									<button class="btn btn-primary margin-bottom">Tìm kiếm</button>
								</div>
							</div>
						</form>
					</div>
                    <form action="<?php echo e(route('setstatus')); ?>" method="post">
                        <?php echo csrf_field(); ?>
					<table class="table table-hover">
						<tr>
                            <th><input type="checkbox" onclick="checkall();" id="checkall"></th>
                            <th>Mã sinh viên</th>
                            <th>Họ tên</th>
							<th>Lớp</th>
							<th>Email</th>
							<th>Số điện thoại</th>
							<th>Trạng thái</th>
							<th>Thao tác</th>
						</tr>
						<?php if(isset($data)): ?>
						<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
                            <td><input class="checkone" type="checkbox" value="<?php echo e($row->id); ?>" name="check[]"></td>
                            <td><?php echo e($row->mmc_studentid); ?></td>
							<td><a href="<?php echo e(route('showStudent',['id'=>$row['id']])); ?>"><?php echo e($row->mmc_fullname); ?></a></td>
							<td>
								<?php $__currentLoopData = $data_class; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($classid['mmc_classid'] == $row['mmc_classid']): ?>
										<?php echo e($classid['mmc_classname']); ?>

									<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</td>
							<td><?php echo e($row->mmc_email); ?></td>
							<td><?php echo e($row->mmc_phone); ?></td>
							<td><?php if($row->mmc_status == 'danghoc'): ?>
                                    Đang học
                                <?php elseif($row->mmc_status == 'baoluu'): ?>
                                    Bảo lưu
                                <?php elseif($row->mmc_status == 'dinhchi'): ?>
                                    Đình chỉ
                                <?php elseif($row->mmc_status == 'thoihoc'): ?>
                                    Thôi học
                                <?php else: ?>
                                    Tốt nghiệp
                                <?php endif; ?>
                            </td>
							<td>
								<a href="<?php echo e(route('editStudent',['id'=>$row['id']])); ?>" class="btn btn-primary btn-sm" title="Sửa"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
								<a href="<?php echo e(route('destroyStudent',['id'=>$row['id']])); ?>" onclick="return confirm('Bạn có muốn xoá không!')" class="btn btn-danger btn-sm" title="Xóa"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
							</td>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
					</table>
					<div class="pagination justify-content-center"> <?php echo $data->appends(['search' => Request::get('search'), 'manghanh' => Request::get('manghanh'), 'malop' => Request::get('malop'), 'status' => Request::get('status')])->render(); ?> </div>
				    <div class="form-inline">
                        <div class="form-group mb-2">
                            <label>Trạng thái:&emsp;</label>
                            <select class="form-control width-200" id="" name="status">
                                <option value="danghoc">Đang học</option>
                                <option value="baoluu">Bảo lưu</option>
                                <option value="dinhchi">Đình chỉ</option>
                                <option value="thoihoc">Thôi học</option>
                                <option value="totngiep">Tốt nghiệp</option>
                            </select>
                        </div>
                        <input class="btn btn-primary" type="submit" value="Thay đổi">
                    </div>
                    </form>
                </div>
            </div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function() {
            $('#amajor').on('change', function () {
                var selectVal = $(this).val();
                console.log(selectVal);
                $.ajax({
                    method: "POST",
                    url: "<?php echo e(route('aajaxmajor')); ?>",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        "id": selectVal},
                    success : function ( data ) {
                        $('#aclass').html(data);
                    }
                })
            });
        });
        $(document).ready(function() {
            $("#checkall").click(function() {
                $(":checkbox").attr('checked',
                    $('#checkall').is(':checked'));
                $(this).closest('tr').toggleClass('highlight');
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/Student/mmc_homeStudent.blade.php ENDPATH**/ ?>