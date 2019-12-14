<div class="form-group">
    <?php echo Form::label('name', 'Mã ngành: ', ['class' => 'control-label']); ?>

    <?php echo Form::text('mmc_majorid', null, ['class' => 'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('name', 'Tên ngành: ', ['class' => 'control-label']); ?>

    <?php echo Form::text('mmc_majorname', null, ['class' => 'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('mmc_deptid', 'Bộ môn: ', ['class' => 'control-label']); ?>

    <select name="mmc_deptid" class="custom-select">
        <option value="0">Không thuộc bộ môn nào</option>
        <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if( isset($major) && $major->mmc_deptid==$item->mmc_deptid): ?>
                <option value="<?php echo e($item->mmc_deptid); ?>" selected="selected"><?php echo e($item->mmc_deptname); ?></option>
            <?php else: ?>
                <option value="<?php echo e($item->mmc_deptid); ?>"><?php echo e($item->mmc_deptname); ?></option>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<div class="form-group">
    <?php echo Form::label('description', 'Mô tả: ', ['class' => 'control-label']); ?>

    <?php echo Form::text('mmc_description', null, ['class' => 'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::submit($formMode === 'edit' ? 'Sửa' : 'Thêm mới', ['class' => 'btn btn-primary']); ?>

</div>
<?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/major/form.blade.php ENDPATH**/ ?>