<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý Bộ môn</h2>
            <span><a href="<?php echo e(route('home')); ?>">Home</a> > Quản lý bộ môn</span>
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        <?php if(Session::has('flash_message')): ?>
            <div class="container col-md-12 error">
                <div class="alert alert-success">
                    <?php echo e(Session::get('flash_message')); ?>

                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Bộ môn</div>
                    <div class="card-body">
                        <a href="<?php echo e(route('department.create')); ?>" class="btn btn-primary btn-sm" title="Thêm bộ môn">
                            <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới
                        </a>

                        <?php echo Form::open(['method' => 'GET', 'url' => '/admin/department', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search']); ?>

                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Tìm kiếm...">
                            <span class="input-group-btn">

                                <button class="btn btn-secondary" type="submit" style=" margin-bottom: 0px;">
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
                                    <th>Tên bộ môn</th>
                                    <th>Mô tả</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item->mmc_deptname); ?></td>
                                        <td><?php echo e($item->mmc_description); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <div class="pagination justify-content-center"> <?php echo $department->appends(['search' => Request::get('search')])->render(); ?> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/department/index.blade.php ENDPATH**/ ?>