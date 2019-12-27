<h4 style="text-align: center">Thêm mới danh mục</h4>
<div class="form-group">
    <?php echo Form::label('name', 'Danh mục: ', ['class' => 'control-label']); ?>

    <?php echo Form::select('mmc_missionid', $list, null, ['class' => 'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('name', 'Nhiệm vụ: ', ['class' => 'control-label']); ?>

    <?php echo Form::text('mmc_missions', null, ['class' => 'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('name', 'Hệ số: ', ['class' => 'control-label']); ?>

    <?php echo Form::text('mmc_coefficient', null, ['class' => 'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('name', 'Số giờ chuẩn: ', ['class' => 'control-label']); ?>

    <?php echo Form::text('mmc_sogiochuan', null, ['class' => 'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::submit($formMode === 'edit' ? 'Sửa' : 'Thêm mới', ['class' => 'btn btn-primary']); ?>

</div>
<?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/science/form2.blade.php ENDPATH**/ ?>