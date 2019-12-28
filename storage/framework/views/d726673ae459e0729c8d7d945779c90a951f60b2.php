<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý lớp chủ nhiệm </h2>
            <span><a href="<?php echo e(route('home')); ?>">Home</a> > Quản lý lớp chủ nhiệm </span>
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
                                            <td style="text-align: center;border-top: none;"><?php echo e($lop->mmc_classname); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Số sinh viên:</th>
                                            <td style="text-align: center"><?php echo e($member); ?></td>
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
                                    <?php
                                    $yeu=0; $tb=0; $kha=0; $gioi=0; $xs=0;
                                    foreach ($student as $item){
                                        if(!is_null($item->pointdetail)){
                                            $point= $item->pointdetail->mmc_4grade;
                                            if($point < 2.0){
                                                $yeu++;
                                            }elseif ($point >= 2.0 && $point < 2.5 ){
                                                $tb++;
                                            }elseif ($point >= 2.5 && $point < 3.2 ){
                                                $kha++;
                                            }elseif ($point >= 3.2 && $point < 3.6 ){
                                                $gioi++;
                                            }else{
                                                $xs++;
                                            }
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <th style="border-top: none;">Xuất sắc :</th>
                                        <td style="text-align: center; border-top: none;"><?php echo e($xs); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Giỏi :</th>
                                        <td style="text-align: center"><?php echo e($gioi); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Khá  :</th>
                                        <td style="text-align: center"><?php echo e($kha); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Trung Bình :</th>
                                        <td style="text-align: center"><?php echo e($tb); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Yếu :</th>
                                        <td style="text-align: center"><?php echo e($yeu); ?></td>
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
                                    <th>Trạng thái</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $student; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th><?php echo e($item->mmc_studentid); ?></th>
                                        <td><?php echo e($item->mmc_fullname); ?></td>
                                        <td><?php echo e($item->mmc_email); ?></td>
                                        <td><?php echo e($item->mmc_phone); ?></td>
                                        <td><?php echo e($item->pointdetail->mmc_4grade); ?></td>
                                        <td><?php echo e($item->pointdetail->mmc_10grade); ?></td>
                                        <td><?php echo e($item->mmc_status); ?></td>
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