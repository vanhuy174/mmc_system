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
                                            <h4 class="color-red">Hãy chắc chẵn rằng đây là file excel chưa DANH SÁCH SINH VIÊN của lớp học phần này và bạn đã kiểm tra kỹ nó</h4>
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
                                            <h4 class="color-red">Hãy chắc chẵn rằng đây là file excel chứa điểm THƯỜNG XUYÊN của những sinh viên trong lớp học phần này và bạn đã kiểm tra kỹ nó</h4>
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
                                    <form action="{{route('pointtest')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <h4 class="color-red">Hãy chắc chẵn rằng đây là file excel chứa điểm THI của những sinh viên trong lớp học phần này và bạn đã kiểm tra kỹ nó</h4>
                                            <input type="file" class="form-control" required="required" name="file">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @if(count($data) != 0)
                        <div style=" float: right;">
                            <form action="{{route('editratio')}}" method="post">
                            @csrf
                            <input type="text" name="subjectclassid" value="{{$data[0]->mmc_subjectclassid}}" hidden="true">
                            <span>Tỉ lệ điểm</span>
                            <select name="point_ratio" title="Tỉ lệ giữa điểm trên lớp và điểm thi">
                              <option <?php if( $data[0]->point_ratio == 2) echo "selected"; ?> value="2">2 : 8</option>
                              <option <?php if( $data[0]->point_ratio == 3) echo "selected"; ?> value="3">3 : 7</option>
                              <option <?php if( $data[0]->point_ratio == 4) echo "selected"; ?> value="4">4 : 6</option>
                              <option <?php if( $data[0]->point_ratio == 5) echo "selected"; ?> value="5">5 : 5</option>
                            </select>
                            <button type="submit">Sửa</button>
                            </form>
                        </div>
                        @endif
                    </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã sinh viên</th>
                                    <th>Tên sinh viên</th>
                                    <th>Lớp</th>
                                    <th>Chuyên cần</th>
                                    <th>Kiểm tra 1</th>
                                    <th>Kiểm tra 2</th>
                                    <th>Kiểm tra 3</th>
                                    <th>Kiểm tra 4</th>
                                    <th>Điểm thi</th>
                                    <th>Điểm TB</th>
                                    <th>Ghi chú</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; ?>
                                @if(count($data) != 0)
                                @foreach($data as $std)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$std->mmc_studentid}}</td>
                                        <td><a href="{{route('showStudent',['id'=>$std->student->id])}}">{{$std->student->mmc_fullname}}</a></td>
                                        <td>{{$std->student->class->mmc_classname}}</td>
                                        <td>{{$diligentpoint=explode("-",$std->diligentpoint)[0]}}</td>
                                        <td>{{$point1=explode("-",$std->point1)[0]}}</td>
                                        <td>{{$point2=explode("-",$std->point2)[0]}}</td>
                                        <td>{{$point3=explode("-",$std->point3)[0]}}</td>
                                        <td>{{$point4=explode("-",$std->point4)[0]}}</td>
                                        <td>{{$testscore=explode("-",$std->testscore)[0]}}</td>
                                        <td>{{tinhdiemTB($std->subject->mmc_theory, $std->subject->mmc_practice, $data[0]->point_ratio, $diligentpoint, $point1, $point2, $point3, $point4, $testscore)}}</td>
                                        <td>{{explode("-",$std->mmc_note)[0]}}</td>
                                    </tr>
                                @endforeach
                                @endif
                                </tbody>
                            </table>
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
