<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý môn học</h2>
            <span><a href="<?php echo e(route('home')); ?>">Home</a> > Quản lý học phần </span>
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        <?php if(Session::has('flash_message')): ?>
            <div class="error">
                <div class="alert alert-success">
                    <?php echo e(Session::get('flash_message')); ?>

                </div>
            </div>
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
                    <div class="card-header">Học phần</div>
                    <div class="card-body">
                        <a href="<?php echo e(route('subject.create')); ?>" class="btn btn-primary btn-sm" title="Thêm mới môn học">
                            <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới
                        </a>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-file-excel-o"></i> Import Excel</button>
                        <?php echo Form::open(['method' => 'GET', 'url' => '/admin/subject', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search']); ?>

                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Tìm kiếm...">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="submit" style="margin-bottom: 0px;">
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
                                    <th>Mã học phần</th>
                                    <th>Tên học phần</th>
                                    <th>Số tín lý thuyết</th>
                                    <th>Số tín thực hành</th>
                                    <th>Mô Tả</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $subject; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item->mmc_subjectid); ?></td>
                                        <td><?php echo e($item->mmc_subjectname); ?></td>
                                        <td><?php echo e($item->mmc_theory); ?></td>
                                        <td><?php echo e($item->mmc_practice); ?></td>
                                        <td><?php echo e($item->mmc_description); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <div class="pagination justify-content-center"> <?php echo $subject->appends(['search' => Request::get('search')])->render(); ?> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Import Excel</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="<?php echo e(url('/admin/subject/import')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="modal-body">
                                <input type="file" name="file" class="form-control">
                                <br>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary"> <i class="fa fa-file-excel-o"></i> Import Excel</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/subject/index.blade.php ENDPATH**/ ?>