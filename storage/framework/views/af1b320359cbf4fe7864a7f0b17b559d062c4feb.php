<div class="form-group">
    <?php echo Form::label('name', 'Danh mục: ', ['class' => 'control-label']); ?>

    <?php echo Form::select('mmc_missionid', $list,null,['class' => 'form-control','id'=>'mmc_missionid']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('name', 'Nhiệm vụ: ', ['class' => 'control-label']); ?>

    <?php echo Form::select('mmc_mission', $item,null , ['class' => 'form-control','id'=>'mmc_mission']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('name', 'Link bài viết: ', ['class' => 'control-label']); ?>

    <?php echo Form::text('mmc_link', null, ['class' => 'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('name', 'File PDF: ', ['class' => 'control-label']); ?>

    <?php echo Form::file('mmc_file', null, ['class' => 'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::submit($formMode === 'edit' ? 'Sửa' : 'Thêm mới', ['class' => 'btn btn-primary']); ?>

</div>
<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function() {
            $('#mmc_missionid').on('change', function () {
                var selectVal = $(this).val();
                $.ajax({
                    method: "POST",
                    url: "<?php echo e(route('ajaxmission')); ?>",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        "id": selectVal},
                    success : function ( data ) {
                        $('#mmc_mission').html(data);
                    }
                })
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/scienceemployee/form.blade.php ENDPATH**/ ?>