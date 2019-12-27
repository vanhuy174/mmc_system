<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản Lý Khoa</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        <?php if(Session::has('flash_message')): ?>
            <div class="container col-md-12 error">
                <div class="alert alert-success">
                    <?php echo e(Session::get('flash_message')); ?>

                </div>
            </div>
        <?php endif; ?>
        <div class="row " >
            <div class="col-lg-4 " style="padding-right: 0px">
                <div class="widget navy-bg no-padding">
                    <div class="p-m">
                        <h3 class="m-xs">Tổng số giảng viên</h3>
                        <h3 class="font-bold no-margins" style="padding-left: 15px">
                            <?php echo e($numberemploy); ?>

                        </h3>
                        <small></small>
                    </div>
                    <div class="flot-chart">
                        <div class="flot-chart-content" id="flot-chart1"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 " style="padding-right: 0px">
                <div class="widget lazur-bg no-padding">
                    <div class="p-m">
                        <h3 class="m-xs">Tổng số sinh viên</h3>
                        <h3 class="font-bold no-margins" style="padding-left: 15px">
                            <?php echo e($numberstudent); ?>

                        </h3>
                        <small></small>
                    </div>
                    <div class="flot-chart">
                        <div class="flot-chart-content" id="flot-chart2"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="widget yellw-bg no-padding" >
                    <div class="p-m">
                        <h3 class="m-xs">Tổng số lớp học</h3>
                        <h3 class="font-bold no-margins" style="padding-left: 15px">
                            <?php echo e($numberclass); ?>

                        </h3>
                        <small></small>
                    </div>
                    <div class="flot-chart">
                        <div class="flot-chart-content" id="flot-chart3"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>
                            Số sinh viên mỗi ngành
                        </h5>
                    </div>
                    <div class="ibox-content">
                        <div>
                            <canvas id="lineChart" height="140"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Điểm sinh viên</h5>

                    </div>
                    <div class="ibox-content">
                        <div>
                            <canvas id="doughnutChart" height="140"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script>
        $(document).ready(function(){
            var d1 = [[1262304000000, 6], [1264982400000, 3057], [1267401600000, 20434], [1270080000000, 31982], [1272672000000, 26602], [1275350400000, 27826], [1277942400000, 24302], [1280620800000, 24237], [1283299200000, 21004], [1285891200000, 12144], [1288569600000, 10577], [1291161600000, 10295]];
            var d2 = [[1262304000000, 5], [1264982400000, 200], [1267401600000, 1605], [1270080000000, 6129], [1272672000000, 11643], [1275350400000, 19055], [1277942400000, 30062], [1280620800000, 39197], [1283299200000, 37000], [1285891200000, 27000], [1288569600000, 21000], [1291161600000, 17000]];

            var data1 = [
                { label: "Data 1", data: d1, color: '#17a084'},
                { label: "Data 2", data: d2, color: '#127e68' }
            ];
            $.plot($("#flot-chart1"), data1, {
                xaxis: {
                    tickDecimals: 0
                },
                series: {
                    lines: {
                        show: true,
                        fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 1
                            }, {
                                opacity: 1
                            }]
                        }
                    },
                    points: {
                        width: 0.1,
                        show: false
                    }
                },
                grid: {
                    show: false,
                    borderWidth: 0
                },
                legend: {
                    show: false
                }
            });

            var data2 = [
                { label: "Data 1", data: d1, color: '#19a0a1'}
            ];
            $.plot($("#flot-chart2"), data2, {
                xaxis: {
                    tickDecimals: 0
                },
                series: {
                    lines: {
                        show: true,
                        fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 1
                            }, {
                                opacity: 1
                            }]
                        }
                    },
                    points: {
                        width: 0.1,
                        show: false
                    }
                },
                grid: {
                    show: false,
                    borderWidth: 0
                },
                legend: {
                    show: false
                }
            });

            var data3 = [
                { label: "Data 1", data: d1, color: '#fbbe7b'},
                { label: "Data 2", data: d2, color: '#f8ac59' }
            ];
            $.plot($("#flot-chart3"), data3, {
                xaxis: {
                    tickDecimals: 0
                },
                series: {
                    lines: {
                        show: true,
                        fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 1
                            }, {
                                opacity: 1
                            }]
                        }
                    },
                    points: {
                        width: 0.1,
                        show: false
                    }
                },
                grid: {
                    show: false,
                    borderWidth: 0
                },
                legend: {
                    show: false
                }
            });
        });
        $(function () {
            var now=new Date();;
            var year= now.getFullYear();
            <?php $year=  date("y");?>
            var lineData = {
                labels: [year-4 , year-3 , year-2 , year-1, year],
                datasets: [
                    <?php $__currentLoopData = \App\Http\Controllers\Admin\MajorController::getmajor(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    {
                        label: "<?php echo e($item->mmc_majorname); ?>",
                        backgroundColor: 'rgba(<?php echo e($item->r); ?>,<?php echo e($item->g); ?>,<?php echo e($item->b); ?>,0.3)',
                        borderColor: "rgba(<?php echo e($item->r); ?>,<?php echo e($item->g); ?>,<?php echo e($item->b); ?>,0.7)",
                        pointBorderColor: "#fff",
                        data: [<?php echo e(\App\Http\Controllers\Admin\homeController::countstudent($year-4, $item->mmc_majorid)); ?>,
                                <?php echo e(\App\Http\Controllers\Admin\homeController::countstudent($year-3, $item->mmc_majorid)); ?>,
                                <?php echo e(\App\Http\Controllers\Admin\homeController::countstudent($year-2, $item->mmc_majorid)); ?>,
                                <?php echo e(\App\Http\Controllers\Admin\homeController::countstudent($year-1, $item->mmc_majorid)); ?>,
                                <?php echo e(\App\Http\Controllers\Admin\homeController::countstudent($year, $item->mmc_majorid)); ?>]
                    },
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ]
            };
            var lineOptions = {
                responsive: true
            };
            var ctx = document.getElementById("lineChart").getContext("2d");
            new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});
            var point_array = <?php echo json_encode($hocluc); ?>;
            var doughnutData = {
                labels: ["Yếu","Trung bình","Khá","Giỏi","Xuất sắc"],
                datasets: [{
                    data: point_array,
                    backgroundColor: ["#E18500","#0B48E1","#00E1B2","#a3e1d4","#FF0100"]
                }]
            } ;
            var doughnutOptions = {
                responsive: true
            };
            var ctx4 = document.getElementById("doughnutChart").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

        });
    </script>
    <script src="js/plugins/chartJs/Chart.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/mmc/MMC-system/resources/views/admin/index.blade.php ENDPATH**/ ?>