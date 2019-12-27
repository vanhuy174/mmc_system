<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý điểm sinh viên</h2>
            <span><a href="<?php echo e(route('home')); ?>">Home</a> > Điểm sinh viên</span>
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
                        <form class="form-inline" action="<?php echo e(route('studentpoint')); ?>">
                            <div class="form-group mb-2">
                                <label for="amajor">Ngành:&emsp;</label>
                                <select class="form-control" id="amajor" name="manghanh">
                                    <?php if(isset($majorid)): ?>
                                        <?php $__currentLoopData = $data_major; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($majorid == $key->mmc_majorid): ?>
                                                <option value="<?php echo e($key->mmc_majorid); ?>" selected><?php echo e($key->mmc_majorname); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <option>...</option>
                                    <?php endif; ?>
                                    <?php $__currentLoopData = $data_major; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key->mmc_majorid); ?>"><?php echo e($key->mmc_majorname); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="aclass">&emsp;Lớp:&emsp;</label>
                                <select class="form-control " id="aclass" name="malop" style="width: 200px;">
                                    <?php if(isset($classid)): ?>
                                        <?php $__currentLoopData = $data_class; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($classid == $key->mmc_classid): ?>
                                                <option value="<?php echo e($key->mmc_classid); ?>" selected><?php echo e($key->mmc_classname); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <option>...</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <button class="btn btn-primary" type="submit">Xem</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="row ibox-content">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="ibox ">
                                    <div>
                                        <h4>Điểm sinh viên</h4>
                                    </div>
                                    <div class="ibox-content">
                                        <div>
                                            <canvas id="gran" height="120"></canvas>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã sinh viên</th>
                                    <th>Tên sinh viên</th>
                                    <th>Lớp</th>
                                    <th>Điểm hệ 4</th>
                                    <th>Điểm hệ 10</th>
                                    <th>Ghi chú</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; ?>
                                <?php $__currentLoopData = $pointstudent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $std): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($i++); ?></td>
                                        <td><?php echo e($std->mmc_studentid); ?></td>
                                        <td><?php echo e($std->mmc_fullname); ?></td>
                                        <td><?php echo e($std->class->mmc_classname); ?></td>
                                        <td><?php echo e($std->pointdetail->mmc_4grade); ?></td>
                                        <td><?php echo e($std->pointdetail->mmc_10grade); ?></td>
                                        <td><?php echo e($std->mmc_note); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <div class="pagination justify-content-center"> <?php echo $pointstudent->appends(['manghanh' => Request::get('manghanh'), 'malop' => Request::get('malop')])->render(); ?> </div>
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
<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function() {
            $('#amajor').on('change', function () {
                var selectVal = $(this).val();
                console.log(selectVal);
                $.ajax({
                    method: "POST",
                    url: "<?php echo e(route('ajaxmajor')); ?>",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        "id": selectVal},
                    success : function ( data ) {
                        $('#aclass').html(data);
                    }
                })
            });
        });
        $(function () {
            var point_array = <?php echo json_encode($hocluc); ?>;
            var doughnutData = {
                labels: ["Yếu","Trung bình","Khá","Giỏi","Xuất sắc" ],
                datasets: [{
                    data: point_array,
                    backgroundColor: ["#E18500","#0B48E1","#00E1B2","#a3e1d4","#FF0100"]
                }]
            } ;
            var doughnutOptions = {
                responsive: true
            };
            var ctx4 = document.getElementById("gran").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

        });
    </script>
    <script src="js/plugins/chartJs/Chart.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/point/index.blade.php ENDPATH**/ ?>