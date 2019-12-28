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
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Quản lý giảng viên </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Quản lý danh mục</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="table-responsive">
                                    <table class="table" id="major">
                                        <thead>
                                        <tr>
                                            <th>Giảng viên</th>
                                            <th>Nhiệm vụ</th>
                                            <th>Hệ số quy đổi</th>
                                            <th>Số giờ chuẩn</th>
                                            <th>Link</th>
                                            <th>File</th>
                                            <th>Trạng thái</th>
                                            <th>Chức năng</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($item->mmc_employeeid); ?></td>
                                                <td><?php echo e($item->item->mmc_mission); ?></td>
                                                <td><?php echo e($item->item->mmc_coefficient); ?></td>
                                                <td><?php echo e($item->item->mmc_sogiochuan); ?></td>
                                                <td><a href="<?php echo e($item->mmc_link); ?>"><?php echo e($item->mmc_link); ?></a></td>
                                                <td  class="click" data-toggle="modal" data-target="#myModal" style="cursor:pointer"><?php echo e($item->mmc_file); ?></td>
                                                <td><?php if($item->mmc_status==0): ?>Chưa duyệt <?php else: ?> Đã duyệt <?php endif; ?></td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm update" value="<?php echo e($item->id); ?>"><i class="fa fa-check" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <br/>
                                <a href="<?php echo e(route('science.create')); ?>" class="btn btn-primary btn-sm" title="Thêm mới ngành">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới
                                </a>
                                <div class="table-responsive">
                                    <table class="table" id="major">
                                        <thead>
                                        <tr>
                                            <th>Nhiệm vụ</th>
                                            <th>Hệ số quy đổi</th>
                                            <th>Số giờ chuẩn</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $i=1;
                                        ?>
                                        <?php $__currentLoopData = $listitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td colspan="3" style="color:red">- <?php echo e($item->mmc_mission); ?></td>
                                            </tr>
                                            <?php $__currentLoopData = $item->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($i); ?>. <?php echo e($mission->mmc_mission); ?></td>
                                                    <td><?php echo e($mission->mmc_coefficient); ?></td>
                                                    <td><?php echo e($mission->mmc_sogiochuan); ?></td>
                                                </tr>
                                                <?php
                                                    $i++;
                                                ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                </div>
                <div class="modal-body" >
                    <embed width="100%" height="500" id="pdf">
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        $(".update").click(function(e) {
            selectVal = $(this).val();
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('ajaxupdate')); ?>",
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "id": selectVal},
                success : function ( data ) {
                    location.reload();
                }
            })
        });
        $(document).ready(function(){
            $(document).on('click', '.click', function () {//load document
                var s=$(this).text();
                $("#pdf").attr('src','/PDF/'+s+'');
            });
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/science/index.blade.php ENDPATH**/ ?>