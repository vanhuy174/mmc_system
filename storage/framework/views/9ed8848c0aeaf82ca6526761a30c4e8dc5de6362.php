<h4 style="text-align: center">Thêm mới danh mục gốc</h4>
<div class="form-group">
    <?php echo Form::label('name', 'Tên danh mục: ', ['class' => 'control-label']); ?>

    <?php echo Form::text('mmc_mission', null, ['class' => 'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::submit($formMode === 'edit' ? 'Sửa' : 'Thêm mới', ['class' => 'btn btn-primary']); ?>

</div>
<?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/science/form.blade.php ENDPATH**/ ?>