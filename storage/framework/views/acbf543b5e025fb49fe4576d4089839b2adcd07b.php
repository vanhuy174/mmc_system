<h2>Danh sách sinh viên</h2>
<p><b>Chú thích: </b>Danh sách gồm tất cả các sinh viên thuộc khoa</p>
<table>
    <thead>
    <tr>
        <th><b>STT</b></th>
        <th><b>Mã sinh viên</b></th>
        <th><b>Tên lớp</b></th>
        <th><b>Họ và tên</b></th>
        <th><b>Ngày sinh</b></th>
        <th><b>Giới tính</b></th>
        <th><b>Email</b></th>
        <th><b>Số điện thoại</b></th>
        <th><b>Hộ khẩu thường trú</b></th>
        <th><b>Dân tộc</b></th>
        <th><b>Tôn giáo</b></th>
        <th><b>Khen thưởng</b></th>
        <th><b>Kỷ luật</b></th>
        <th><b>Số CMND</b></th>
        <th><b>Họ tên bố</b></th>
        <th><b>Quốc tịch bố</b></th>
        <th><b>Dân tộc bố</b></th>
        <th><b>Tôn giáo bố</b></th>
        <th><b>Hộ khẩu thường trú Bố</b></th>
        <th><b>Số điện thoại bố</b></th>
        <th><b>Email bố</b></th>
        <th><b>Nghề ngiệp bố</b></th>
        <th><b>Họ tên mẹ</b></th>
        <th><b>Quốc tịch mẹ</b></th>
        <th><b>Dân tộc mẹ</b></th>
        <th><b>Tôn giáo mẹ</b></th>
        <th><b>Hộ khẩu thường trú mẹ</b></th>
        <th><b>Số điện thoại mẹ</b></th>
        <th><b>Email mẹ</b></th>
        <th><b>Nghề ngiệp mẹ</b></th>
    </tr>
    </thead>
    <tbody>
    <?php $i= 1; ?>
    <?php $__currentLoopData = $datastudent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($i++); ?></td>
            <td><?php echo e($data->mmc_studentid); ?></td>
            <td>
                <?php $__currentLoopData = $dataclass; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($data->mmc_classid == $class->mmc_classid): ?>
                    <?php echo e($class->mmc_classname); ?>

                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td><?php echo e($data->mmc_fullname); ?></td>
            <td><?php echo e(date('d-m-Y', strtotime($data->mmc_dateofbirth))); ?></td>
            <td>
                <?php if($data->mmc_gender==1): ?>
                    Nữ
                <?php else: ?>
                    Nam
                <?php endif; ?>
            </td>
            <td><?php echo e($data->mmc_email); ?></td>
            <td><?php echo e($data->mmc_phone); ?></td>
            <td><?php echo e($data->mmc_address); ?></td>
            <td><?php echo e($data->mmc_ethnic); ?></td>
            <td><?php echo e($data->mmc_religion); ?></td>
            <td><?php echo e($data->mmc_reward); ?></td>
            <td><?php echo e($data->mmc_descipline); ?></td>
            <td><?php echo e($data->mmc_personalid); ?></td>
            <td><?php echo e($data->mmc_father); ?></td>
            <td><?php echo e($data->mmc_fathernationality); ?></td>
            <td><?php echo e($data->mmc_fatherethnic); ?></td>
            <td><?php echo e($data->mmc_fatherreligion); ?></td>
            <td><?php echo e($data->mmc_fatheraddress); ?></td>
            <td><?php echo e($data->mmc_fatherphone); ?></td>
            <td><?php echo e($data->mmc_fatheremail); ?></td>
            <td><?php echo e($data->mmc_fatherjob); ?></td>
            <td><?php echo e($data->mmc_mother); ?></td>
            <td><?php echo e($data->mmc_mothernationality); ?></td>
            <td><?php echo e($data->mmc_motherethnic); ?></td>
            <td><?php echo e($data->mmc_motherreligion); ?></td>
            <td><?php echo e($data->mmc_motheraddress); ?></td>
            <td><?php echo e($data->mmc_motherphone); ?></td>
            <td><?php echo e($data->mmc_motheremail); ?></td>
            <td><?php echo e($data->mmc_motherjob); ?></td>
            
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table><?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/Student/mmc_formExport.blade.php ENDPATH**/ ?>