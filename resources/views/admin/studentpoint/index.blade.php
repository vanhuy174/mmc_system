@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý lớp lớp học phần</h2>
            <span><a href="{{route('home')}}">Home</a> > Lớp học phần</span>
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
                    <div class="card-header">Chi tiết lớp học phần: {{$nameclass->mmc_subjectclassname}}</div>
                    <div class="card-body">
                        <a href="" class="btn btn-primary btn-sm" title="Cập nhật danh sách sinh viên" data-toggle="modal" data-target="#dssinhvien">
                            <i class="fa fa-plus" aria-hidden="true"></i> Cập nhật DS sinh viên
                        </a>
                        <div class="modal fade" id="dssinhvien" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="exampleModalLabel">Cập nhật danh sách sinh viên bằng file.</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('infoStudent') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="file" class="form-control" required="required" name="file">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <a href="" class="btn btn-primary btn-sm" title="Cập nhật điểm thường xuyên cho sinh viên" data-toggle="modal" data-target="#diemthuongxuyen">
                            <i class="fa fa-plus" aria-hidden="true"></i> Cập nhật điểm thường xuyên
                        </a>
                        <div class="modal fade" id="diemthuongxuyen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="exampleModalLabel">Cập nhật điểm thường xuyên sinh viên bằng file.</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('pointstudent') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="file" class="form-control" required="required" name="file">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <a href="" class="btn btn-primary btn-sm" title="Cập nhật điểm thi cho sinh viên"  data-toggle="modal" data-target="#diemthi">
                            <i class="fa fa-plus" aria-hidden="true"></i> Cập nhật điểm thi
                        </a>
                        <div class="modal fade" id="diemthi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="exampleModalLabel">Cập nhật điểm thi sinh viên bằng file.</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="/" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="file" class="form-control" required="required" name="file">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã sinh viên</th>
                                    <th>Tên sinh viên</th>
                                    <th>Lớp</th>
                                    <th>Điểm CC</th>
                                    <th>Điểm 1</th>
                                    <th>Điểm 2</th>
                                    <th>Điểm 3</th>
                                    <th>Điểm 4</th>
                                    <th>Điểm thi</th>
                                    <th>Ghi chú</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; ?>
                                @foreach($data as $student)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$student->mmc_studentid}}</td>
                                        <td>
                                            {{App\mmc_Student::where('mmc_studentid', '=', $student->mmc_studentid)->value('mmc_fullname')}}
                                        </td>
                                        <td>
                                            <?php $classid= App\mmc_Student::where('mmc_studentid', '=', $student->mmc_studentid)->value('mmc_classid');
                                                $classname= App\mmc_class::where('mmc_classid', '=', $classid)->value('mmc_classname');
                                            ?>
                                            {{$classname}}
                                        </td>
                                        <td>{{explode("-",$student->diligentpoint)[0]}}</td>
                                        <td>{{explode("-",$student->point1)[0]}}</td>
                                        <td>{{explode("-",$student->point2)[0]}}</td>
                                        <td>{{explode("-",$student->point3)[0]}}</td>
                                        <td>{{explode("-",$student->point4)[0]}}</td>
                                        <td>{{explode("-",$student->testscore)[0]}}</td>
                                        <td>{{$student->mmc_note}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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