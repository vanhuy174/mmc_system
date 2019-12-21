<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý Ngành</h2>
            <span><a href="<?php echo e(route('home')); ?>">Home</a> > Quản lý ngành </span>
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
                    <div class="card-header">Ngành</div>
                    <div class="card-body">
                        <a href="<?php echo e(route('major.create')); ?>" class="btn btn-primary btn-sm" title="Thêm mới ngành">
                            <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới
                        </a>
                        <?php echo Form::open(['method' => 'GET', 'url' => '/admin/major', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search']); ?>

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
                            <table class="table" id="major">
                                <thead>
                                <tr>
                                    <th>Mã Ngành</th>
                                    <th>Tên Ngành</th>
                                    <th>Bộ Môn</th>
                                    <th>Mô Tả</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $major; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($item->mmc_majorid); ?></td>
                                    <td data-toggle="modal" data-target="#myModal" style="cursor:pointer"><?php echo e($item->mmc_majorname); ?></td>
                                    <td><?php echo e(App\Http\Controllers\Admin\MajorController::getDepartment($item->mmc_deptid)); ?></td>
                                    <td><?php echo e($item->mmc_description); ?></td>
                                </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <div class="pagination justify-content-center"> <?php echo $major->appends(['search' => Request::get('search')])->render(); ?> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function() {
            $("#major").on("click", "td:nth-child(2)", function() {
                selectVal = $(this).text();
                $.ajax({
                    method: "POST",
                    url: "<?php echo e(route('ajaxgeteducation')); ?>",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        "name": selectVal},
                    success : function ( data ) {

                        $('#mmc_education').html(data);
                    }
                })
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chương trình đào tạo thuộc ngành  </h4>
            </div>
            <div class="modal-body" id="mmc_education">
            </div>
            <div class="modal-footer">
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/major/index.blade.php ENDPATH**/ ?>