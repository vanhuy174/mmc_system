<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý Giảng Viên</h2>
            <span><a href="<?php echo e(route('home')); ?>">Home</a> > Quản Lý Giảng Viên</span>
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        <?php if(session('thongbao')): ?>
            <div class="alert alert-success ">
                <?php echo e(session('thongbao')); ?>

            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Giảng Viên</div>
                    <div class="card-body">
                        <a href="<?php echo e(route('giangvien.create')); ?>" class="btn btn-primary btn-sm" title="Thêm bộ môn">
                            <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới
                        </a>
                        <a href="<?php echo e(route('getXoa')); ?>" class="btn btn-primary btn-sm" title="Thêm bộ môn">
                            <i class="fa fa-trash-o" aria-hidden="true"></i> Danh Sách Giảng Viên Đã Xóa
                        </a>

                        <?php echo Form::open(['method' => 'GET', 'url' => '/admin/giangvien', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search']); ?>

                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Tìm kiếm...">
                            <span class="input-group-btn">

                                <button class="btn btn-primary" type="submit" style=" margin-bottom: 0px;">
                                    <i class="fa fa-search" ></i>
                                </button>
                            </span>
                        </div>
                        <?php echo Form::close(); ?>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Tên giảng viên</th>
                                    <th>Mã giảng viên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $giangvien; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><a href="<?php echo e(route('giangvien.show',$gv->id)); ?>"><?php echo e($gv->mmc_name); ?></a></td>
                                        <td><?php echo e($gv->mmc_employeeid); ?></td>
                                        <td><?php echo e($gv->email); ?></td>
                                        <td><?php echo e($gv->mmc_phone); ?></td>
                                        <td>
                                            <a href="<?php echo e(url('/admin/giangvien/'.$gv->id.'/edit')); ?>" title="Sửa thông tin giảng viên"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                            <?php echo Form::open([
                                                'method' => 'DELETE',
                                                'url' => ['/admin/giangvien',$gv->id],
                                                'style' => 'display:inline'
                                            ]); ?>

                                            <?php echo Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Xóa bộ môn',
                                                    'onclick'=>'return confirm("Xác nhận xóa?")'
                                            )); ?>

                                            <?php echo Form::close(); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <div class="pagination justify-content-center"> <?php echo $giangvien->appends(['search' => Request::get('search')])->render(); ?> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/giangvien/danhsach.blade.php ENDPATH**/ ?>