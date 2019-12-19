<div class="form-group">
    <?php echo Form::label('name', 'Mã học phần: ', ['class' => 'control-label']); ?>

    <?php echo Form::text('mmc_subjectid', null, ['class' => 'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('name', 'Tên học phần: ', ['class' => 'control-label']); ?>

    <?php echo Form::text('mmc_subjectname', null, ['class' => 'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('tinchi', 'Số tín lý thuyết: ', ['class' => 'control-label']); ?>

    <?php echo Form::number('mmc_theory', null, ['class' => 'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('tinchi', 'Số tín thực hành: ', ['class' => 'control-label']); ?>

    <?php echo Form::number('mmc_practice', null, ['class' => 'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('description', 'Mô tả: ', ['class' => 'control-label']); ?>

    <?php echo Form::text('mmc_description', null, ['class' => 'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::submit($formMode === 'edit' ? 'Sửa' : 'Thêm mới', ['class' => 'btn btn-primary']); ?>

</div>
<?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/subject/form.blade.php ENDPATH**/ ?>