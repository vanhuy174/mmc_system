<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý ngành</h2>
            <span><a href="<?php echo e(route('home')); ?>">Home</a> > <a href="<?php echo e(route('major.index')); ?>">Quản lý ngành</a> >Sửa ngành </span>

    </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Sửa ngành</div>
                    <div class="card-body">
                        <a href="<?php echo e(url('/admin/major')); ?>" title="Back"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Quay lại</button></a>
                        <p>
                        <?php if($errors->any()): ?>
                            <ul class="alert alert-danger" style="list-style: none">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <?php endif; ?>
                            </p>
                            <?php echo Form::model($major, [
                            'method' => 'PATCH',
                            'url' => ['/admin/major', $major->id],
                            'class' => 'form-horizontal',
                            'files' => true
                                 ]); ?>


                            <?php echo $__env->make('admin.major.form', ['formMode' => 'edit'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <?php echo Form::close(); ?>



                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/major/edit.blade.php ENDPATH**/ ?>