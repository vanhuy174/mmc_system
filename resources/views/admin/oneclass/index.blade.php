@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Lớp</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        @if (Session::has('flash_message'))
            <div class="container col-md-12 error">
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Lớp</div>
                    <div class="card-body">
                        <a href="{{route('major.create')}}" class="btn btn-primary btn-sm" title="Thêm mới ngành">
                            <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới
                        </a>
                        {!! Form::open(['method' => 'GET', 'url' => '/admin/major', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Tìm kiếm...">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Sinh viên</th>
                                    <th>Mã sinh viên</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                            @if(isset($data))
                            @foreach($data as $row)
                            <tr>

                                <td>{{$row -> mmc_fullname}}</td>
                                <td>{{$row -> mmc_studentid}}</td>
                                <td>
                                  
                                </td>
                                <td>{{date('d-m-Y', strtotime($row['mmc_dateofbirth']))}}</td>
                                <td>
                                    @if($row -> mmc_gender == 0) Nam 
                                    @else Nữ
                                    @endif
                                </td>
                                <td>{{$row -> mmc_email}}</td>
                                <td>{{$row -> mmc_phone}}</td>
                                <td>
                                    <a href="{{route('showStudent',['id'=>$row['id']])}}" title="View User"><button class="btn btn-info btn-sm">Xem</button></a>
                                    <a href="{{route('editStudent',['id'=>$row['id']])}}" title="Edit User"><button class="btn btn-primary btn-sm">Sửa</button></a>
                                    <a href="{{route('destroyStudent',['id'=>$row['id']])}}" onclick="return confirm('Bạn có muốn xoá không!')"><button class="btn btn-danger btn-sm">Xoá</button></a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example" style="padding-left: 1px;">  </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

