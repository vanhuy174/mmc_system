<h3 style="text-align: center">Trường Đại Học Công Nghệ Thông Tin Và Truyền Thông</h3>
<table style="border-collapse:collapse">
    <thead>
    <tr>
        <th style="border:2px solid black;width: 20px;"><b>Tên Lớp</b></th>
        <th style="border:2px solid black;width: 20px;">Ngành</th>
        <th style="border:2px solid black;width: 20px;">Giáo Viên Chủ Nhiệm</th>
        <th style="border:2px solid black;width: 20px;">Số Sinh Viên</th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td style="border:2px solid black"><?php echo e($class->mmc_classname); ?></td>
            <td style="border:2px solid black"><?php echo e(\App\Http\Controllers\Admin\ClassController::getmajor($class->mmc_major)); ?></td>
            <td style="border:2px solid black"><?php echo e($class->mmc_headteacher); ?></td>
            <td style="border:2px solid black"><?php echo e($class->mmc_numstudent); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<table style="border-collapse:collapse">
    <thead>
    <tr>
        <th style="border:2px solid black;width: 20px;"><b>Tên Lớp</b></th>
        <th style="border:2px solid black;width: 20px;">Ngành</th>
        <th style="border:2px solid black;width: 20px;">Giáo Viên Chủ Nhiệm</th>
        <th style="border:2px solid black;width: 20px;">Số Sinh Viên</th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td style="border:2px solid black"><?php echo e($class->mmc_classname); ?></td>
            <td style="border:2px solid black"><?php echo e(\App\Http\Controllers\Admin\ClassController::getmajor($class->mmc_major)); ?></td>
            <td style="border:2px solid black"><?php echo e($class->mmc_headteacher); ?></td>
            <td style="border:2px solid black"><?php echo e($class->mmc_numstudent); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<table style="border-collapse:collapse">
    <thead>
    <tr>
        <th style="border:2px solid black;width: 20px;"><b>Tên Lớp</b></th>
        <th style="border:2px solid black;width: 20px;">Ngành</th>
        <th style="border:2px solid black;width: 20px;">Giáo Viên Chủ Nhiệm</th>
        <th style="border:2px solid black;width: 20px;">Số Sinh Viên</th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td style="border:2px solid black"><?php echo e($class->mmc_classname); ?></td>
            <td style="border:2px solid black"><?php echo e(\App\Http\Controllers\Admin\ClassController::getmajor($class->mmc_major)); ?></td>
            <td style="border:2px solid black"><?php echo e($class->mmc_headteacher); ?></td>
            <td style="border:2px solid black"><?php echo e($class->mmc_numstudent); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH /var/www/html/mmc/MMC-system/resources/views/export/classes.blade.php ENDPATH**/ ?>