<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý chương trình đào tạo</h2>
            <span><a href="<?php echo e(route('home')); ?>">Home</a> > <a href="<?php echo e(route('department.index')); ?>">Quản lý chương trình đào tạo</a> > Thêm mới  </span>
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        <?php if($errors->any()): ?>
            <ul class="alert alert-danger" style="list-style: none">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">CTĐT</div>
                    <div class="card-body">
                        <a href="<?php echo e(url('/admin/educationprogram')); ?>" title="Back"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Quay lại</button></a>
                        <p>
                        </p>
                        <div style="text-align: center">
                            <h5>ĐẠI HỌC THÁI NGUYÊN</h5>
                            <h5>TRƯỜNG ĐẠI HỌC CÔNG NGHỆ THÔNG TIN VÀ TRUYỀN THÔNG</h5>
                            <br>
                            <h5>KHUNG CHƯƠNG TRÌNH ĐÀO TẠO </h5>
                            <h5><?php echo e(\App\Http\Controllers\Admin\ClassController::getmajor($majorid)); ?></h5>
                            <h5>( Thực hiện từ khóa <?php echo e($course); ?> )</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Tên môn học</th>
                                    <th>Số tín chỉ</th>
                                    <th>Số tín lý thuyết</th>
                                    <th>Số tín thực hành</th>
                                    <th>Học kỳ</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr><td colspan="5" style="text-align: center;font-weight: bold">Khối kiến thức giáo dục đại cương</td></tr>
                                    <?php $__currentLoopData = $educationprogram; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($item->mmc_classify=='KKTGDDC'&&$item->mmc_elective==null): ?>
                                            <tr>
                                                <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::getname($item->mmc_subjectid)); ?></td>
                                                <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::gettinchi($item->mmc_subjectid)); ?></td>
                                                <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::gettheory($item->mmc_subjectid)); ?></td>
                                                <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::getpractice($item->mmc_subjectid)); ?></td>
                                                <td><?php echo e($item->mmc_semester); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php for($i=0;$i<count($educationprogramtcdc)/2;$i++): ?>
                                        <tr>
                                            <td class="b-color-red" style="text-align: center;">Học phần tự chọn đại cương <?php echo e($i+1); ?></td>
                                            <td colspan="4"></td>
                                        </tr>
                                        <?php $__currentLoopData = $educationprogramtcdc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($item->mmc_elective==$educationprogramtcdc[$i]['mmc_elective']): ?>
                                                <tr>
                                                    <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::getname($item->mmc_subjectid)); ?></td>
                                                    <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::gettinchi($item->mmc_subjectid)); ?></td>
                                                    <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::gettheory($item->mmc_subjectid)); ?></td>
                                                    <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::getpractice($item->mmc_subjectid)); ?></td>
                                                    <td><?php echo e($item->mmc_semester); ?></td>
                                        </tr>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endfor; ?>
                                    <tr><td colspan="5" style="text-align: center;font-weight: bold">Khối kiến thức cơ sở ngành</td></tr>
                                    <?php $__currentLoopData = $educationprogram; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($item->mmc_classify=='KKTCSN'&&$item->mmc_elective==null): ?>
                                            <tr>
                                                <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::getname($item->mmc_subjectid)); ?></td>
                                                <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::gettinchi($item->mmc_subjectid)); ?></td>
                                                <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::gettheory($item->mmc_subjectid)); ?></td>
                                                <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::getpractice($item->mmc_subjectid)); ?></td>
                                                <td><?php echo e($item->mmc_semester); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php for($i=0;$i<count($educationprogramtccsn)/2;$i++): ?>
                                        <tr>
                                            <td class="b-color-red" style="text-align: center;">Học phần tự chọn cơ sở ngành <?php echo e($i+1); ?></td>
                                            <td colspan="4"></td>
                                        </tr>
                                        <?php $__currentLoopData = $educationprogramtccsn; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($item->mmc_elective==$educationprogramtccsn[$i]['mmc_elective']): ?>
                                                <tr>
                                                    <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::getname($item->mmc_subjectid)); ?></td>
                                                    <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::gettinchi($item->mmc_subjectid)); ?></td>
                                                    <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::gettheory($item->mmc_subjectid)); ?></td>
                                                    <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::getpractice($item->mmc_subjectid)); ?></td>
                                                    <td><?php echo e($item->mmc_semester); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endfor; ?>
                                    <tr><td colspan="5" style="text-align: center;font-weight: bold">Khối kiến thức chuyên ngành</td></tr>
                                    <?php $__currentLoopData = $educationprogram; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($item->mmc_classify=='KKTCN'&&$item->mmc_elective==null): ?>
                                            <tr>
                                                <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::getname($item->mmc_subjectid)); ?></td>
                                                <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::gettinchi($item->mmc_subjectid)); ?></td>
                                                <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::gettheory($item->mmc_subjectid)); ?></td>
                                                <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::getpractice($item->mmc_subjectid)); ?></td>
                                                <td><?php echo e($item->mmc_semester); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php for($i=0;$i<count($educationprogramtccn)/2;$i++): ?>
                                        <tr>
                                            <td class="b-color-red" style="text-align: center;">Học phần tự chọn chuyên ngành <?php echo e($i+1); ?></td>
                                            <td colspan="4"></td>
                                        </tr>
                                        <?php $__currentLoopData = $educationprogramtccn; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($item->mmc_elective==$educationprogramtccn[$i]['mmc_elective']): ?>
                                                <tr>
                                                    <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::getname($item->mmc_subjectid)); ?></td>
                                                    <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::gettinchi($item->mmc_subjectid)); ?></td>
                                                    <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::gettheory($item->mmc_subjectid)); ?></td>
                                                    <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::getpractice($item->mmc_subjectid)); ?></td>
                                                    <td><?php echo e($item->mmc_semester); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endfor; ?>
                                    <tr><td colspan="5" style="text-align: center;font-weight: bold">Thực tập khóa luân tốt nghiệp</td></tr>
                                    <?php $__currentLoopData = $educationprogram; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($item->mmc_classify=='TTKLTN'&&$item->mmc_elective==null): ?>
                                            <tr>
                                                <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::getname($item->mmc_subjectid)); ?></td>
                                                <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::gettinchi($item->mmc_subjectid)); ?></td>
                                                <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::gettheory($item->mmc_subjectid)); ?></td>
                                                <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::getpractice($item->mmc_subjectid)); ?></td>
                                                <td><?php echo e($item->mmc_semester); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php for($i=0;$i<count($educationprogramtctn)/2;$i++): ?>
                                        <tr>
                                            <td class="b-color-red" style="text-align: center;">Học phần tự chọn khóa luận tốt nghiệp <?php echo e($i+1); ?></td>
                                            <td colspan="4"></td>
                                        </tr>
                                        <?php $__currentLoopData = $educationprogramtctn; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($item->mmc_elective==$educationprogramtctn[$i]['mmc_elective']): ?>
                                                <tr>
                                                    <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::getname($item->mmc_subjectid)); ?></td>
                                                    <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::gettinchi($item->mmc_subjectid)); ?></td>
                                                    <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::gettheory($item->mmc_subjectid)); ?></td>
                                                    <td><?php echo e(\App\Http\Controllers\Admin\SubjectController::getpractice($item->mmc_subjectid)); ?></td>
                                                    <td><?php echo e($item->mmc_semester); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/educationprogram/show.blade.php ENDPATH**/ ?>