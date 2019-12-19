<div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
    <?php echo Form::label('name', 'Tên bộ môn: ', ['class' => 'control-label']); ?>

    <?php echo Form::text('mmc_deptname', null, ['class' => 'form-control']); ?>

    <?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
    <?php echo Form::label('description', 'Mô tả: ', ['class' => 'control-label']); ?>

    <?php echo Form::text('mmc_description', null, ['class' => 'form-control']); ?>

    <?php echo $errors->first('description', '<p class="help-block">:message</p>'); ?>

</div>
<div class="form-group">
    <?php echo Form::submit($formMode === 'edit' ? 'Sửa' : 'Thêm mới', ['class' => 'btn btn-primary']); ?>

</div>
<?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/department/form.blade.php ENDPATH**/ ?>