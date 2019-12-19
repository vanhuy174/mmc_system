<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý lớp giảng dạy</h2>
            <span><a href="<?php echo e(route('home')); ?>">Home</a> > Quản lý lớp giảng dạy </span>
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        <?php if(!empty($flash_message)): ?>
            <div class="container col-md-12 error">
                <div class="alert alert-success">
                    <?php echo e($flash_message); ?>

                </div>
            </div>
        <?php else: ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Lớp chủ nhiệm</div>
                    <div class="card-body">
                        <br/>
                        <br/>
                        <h1 style="text-align: center;"><b>Thông tin cơ bản</b></h1>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="table-responsive container" >
                                    <table class="table">
                                        <tr>
                                            <th style="border-top: none;">Tên lớp:</th>
                                            <td style="text-align: center;border-top: none;" ><?php echo e($lop->mmc_classname); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Số sinh viên:</th>
                                            <td style="text-align: center"><?php echo e($lop->mmc_numstudent); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Lớp trưởng:</th>
                                            <td style="text-align: center"><?php echo e($lop->mmc_monitor); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Bí thư:</th>
                                            <td style="text-align: center"><?php echo e($lop->mmc_secretary); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <table class="table">
                                    <tr>
                                        <th style="border-top: none;">Xuất sắc :</th>
                                        <td style="text-align: center; border-top: none;">10</td>
                                    </tr>
                                    <tr>
                                        <th>Giỏi :</th>
                                        <td style="text-align: center">5</td>
                                    </tr>
                                    <tr>
                                        <th>Khá  :</th>
                                        <td style="text-align: center">4</td>
                                    </tr>
                                    <tr>
                                        <th>Trung Bình :</th>
                                        <td style="text-align: center">3</td>
                                    </tr>
                                    <tr>
                                        <th>Kém :</th>
                                        <td style="text-align: center">2</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <h1 style="text-align: center;"><b>Bảng sinh viên lớp</b></h1>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Mã sinh viên</th>
                                    <th>Tên sinh viên</th>
                                    <th>Email</th>
                                    <th>SĐT</th>
                                    <th>Điểm hệ 4</th>
                                    <th>Điểm hệ 10</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $student; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th><?php echo e($item->mmc_studentid); ?></th>
                                        <td><?php echo e($item->mmc_fullname); ?></td>
                                        <td><?php echo e($item->mmc_email); ?></td>
                                        <td><?php echo e($item->mmc_phone); ?></td>
                                        <td>2.5</td>
                                        <td>6.75</td>
                                    </tr>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/oneclass/index.blade.php ENDPATH**/ ?>