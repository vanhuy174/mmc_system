@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý điểm sinh viên</h2>
            <span><a href="{{route('home')}}">Home</a> > Điểm sinh viên</span>
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        @if (session('status'))
    <br> <div id="error" class="alert alert-info">{{session('status')}}</div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <ul style="overflow-y: scroll; max-height: 250px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <form class="form-inline" action="{{route('studentpoint')}}">
                            <div class="form-group mb-2">
                                <label for="amajor">Ngành:&emsp;</label>
                                <select class="form-control" id="amajor" name="manghanh">
                                    @if(isset($majorid))
                                        @foreach($data_major as $key)
                                            @if($majorid == $key->mmc_majorid)
                                                <option value="{{$key->mmc_majorid}}" selected>{{$key->mmc_majorname}}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option>...</option>
                                    @endif
                                    @foreach($data_major as $key)
                                        <option value="{{$key->mmc_majorid}}">{{$key->mmc_majorname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="aclass">&emsp;Lớp:&emsp;</label>
                                <select class="form-control " id="aclass" name="malop" style="width: 200px;">
                                    @if(isset($classid))
                                        @foreach($data_class as $key)
                                            @if($classid == $key->mmc_classid)
                                                <option value="{{$key->mmc_classid}}" selected>{{$key->mmc_classname}}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option>...</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <button class="btn btn-primary" type="submit">Xem</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="row ibox-content">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="ibox ">
                                    <div>
                                        <h4>Điểm sinh viên</h4>
                                    </div>
                                    <div class="ibox-content">
                                        <div>
                                            <canvas id="gran" height="120"></canvas>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã sinh viên</th>
                                    <th>Tên sinh viên</th>
                                    <th>Lớp</th>
                                    <th>Điểm hệ 4</th>
                                    <th>Điểm hệ 10</th>
                                    <th>Ghi chú</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; ?>
                                @foreach($pointstudent as $std)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$std->mmc_studentid}}</td>
                                        <td>{{$std->mmc_fullname}}</td>
                                        <td>{{$std->class->mmc_classname}}</td>
                                        <td>{{$std->pointdetail->mmc_4grade}}</td>
                                        <td>{{$std->pointdetail->mmc_10grade}}</td>
                                        <td>{{$std->mmc_note}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-center"> {!! $pointstudent->appends(['manghanh' => Request::get('manghanh'), 'malop' => Request::get('malop')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Import Excel</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="{{url('/admin/subject/import')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <input type="file" name="file" class="form-control">
                                <br>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary"> <i class="fa fa-file-excel-o"></i> Import Excel</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#amajor').on('change', function () {
                var selectVal = $(this).val();
                console.log(selectVal);
                $.ajax({
                    method: "POST",
                    url: "{{ route('ajaxmajor') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": selectVal},
                    success : function ( data ) {
                        $('#aclass').html(data);
                    }
                })
            });
        });
        $(function () {
            var point_array = <?php echo json_encode($hocluc); ?>;
            var doughnutData = {
                labels: ["Yếu","Trung bình","Khá","Giỏi","Xuất sắc" ],
                datasets: [{
                    data: point_array,
                    backgroundColor: ["#E18500","#0B48E1","#00E1B2","#a3e1d4","#FF0100"]
                }]
            } ;
            var doughnutOptions = {
                responsive: true
            };
            var ctx4 = document.getElementById("gran").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

        });
    </script>
    <script src="js/plugins/chartJs/Chart.min.js"></script>
@endsection
