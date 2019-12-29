<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý hoạt động nghiên cứu khoa học</h2>
            <span><a href="<?php echo e(route('home')); ?>">Home</a> > Quản lý hoạt động nghiên cứu khoa học </span>
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
                    <div class="card-header">Họat động khoa học công nghệ</div>
                    <div class="card-body">
                        <a href="<?php echo e(route('scienceemployee.create')); ?>" class="btn btn-primary btn-sm" title="Thêm mới ngành">
                            <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table" id="major">
                                <thead>
                                <tr>
                                    <th>Nhiệm vụ</th>
                                    <th>Hệ số quy đổi</th>
                                    <th>Số giờ chuẩn</th>
                                    <th>Link</th>
                                    <th>File</th>
                                    <th>Trạng thái</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item->item->mmc_mission); ?></td>
                                        <td><?php echo e($item->item->mmc_coefficient); ?></td>
                                        <td><?php echo e($item->item->mmc_sogiochuan); ?></td>
                                        <td><a href="<?php echo e($item->mmc_link); ?>"><?php echo e($item->mmc_link); ?></a></td>
                                        <td><?php echo e($item->mmc_file); ?></td>
                                        <td><?php if($item->mmc_status==0): ?>Chưa duyệt <?php else: ?> Đã duyệt <?php endif; ?></td>
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


<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/scienceemployee/index.blade.php ENDPATH**/ ?>