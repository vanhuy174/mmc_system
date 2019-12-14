<div class="row">
    <div class="col-lg-6">
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Tên lớp: <b class="b-color-red">&nbsp;&nbsp;*</b></span>
            </div>
            <?php echo Form::text('mmc_classname', null, ['class' => 'form-control']); ?>


        </div>
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Ngành: <b class="b-color-red">&nbsp;&nbsp;*</b></span>
            </div>
            <?php echo Form::select('mmc_major', $major, isset($class) ? $class->mmc_major : null, ['class' => 'form-control']); ?>

        </div>
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Số sinh viên: <b class="b-color-red">&nbsp;&nbsp;*</b></span>
            </div>
            <?php echo Form::text('mmc_numstudent', null, ['class' => 'form-control']); ?>


        </div>
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Giáo viên chủ nhiệm: <b class="b-color-red">&nbsp;&nbsp;*</b></span>
            </div>
            <select name="mmc_headteacher" class="form-control">
                <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <optgroup label="<?php echo e($item->mmc_deptname); ?>">
                        <?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employeeitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($employeeitem->mmc_deptid == $item->mmc_deptid): ?>
                                <?php if(isset($class) && $employeeitem->mmc_employeeid == $class->mmc_headteacher): ?>
                                  <option value="<?php echo e($employeeitem->mmc_employeeid); ?>" selected><?php echo e($employeeitem->mmc_name); ?></option>
                                <?php else: ?>
                                    <option value="<?php echo e($employeeitem->mmc_employeeid); ?>"><?php echo e($employeeitem->mmc_name); ?></option>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </optgroup>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Mô tả: </span>
            </div>
            <?php echo Form::text('mmc_description', null, ['class' => 'form-control']); ?>


        </div>
    </div>
    <div class="col-lg-6">
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Lớp trưởng: </span>
            </div>
            <?php echo Form::text('mmc_monitor', null, ['class' => 'form-control']); ?>


        </div>
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Bí thư: </span>
            </div>
            <?php echo Form::text('mmc_secretary', null, ['class' => 'form-control']); ?>


        </div>
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Lớp phó: </span>
            </div>
            <?php echo Form::text('mmc_vicemonitor', null, ['class' => 'form-control']); ?>


        </div>
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Ủy viên: </span>
            </div>
            <?php echo Form::text('mmc_vicesecretary1', null, ['class' => 'form-control']); ?>


        </div>
        <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">Ủy viên 2: </span>
            </div>
            <?php echo Form::text('mmc_vicesecretary2', null, ['class' => 'form-control']); ?>

        </div>
    </div>
</div>
<div class="input-group mb-3 input-group-sm">
    <?php echo Form::submit($formMode === 'edit' ? 'Sửa' : 'Thêm mới', ['class' => 'btn btn-primary']); ?>

</div>

<?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/class/form.blade.php ENDPATH**/ ?>