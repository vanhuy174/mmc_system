@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Giảng Viên Đã Xóa</h2>
            <span><a href="{{route('home')}}">Home</a> > Giảng Viên Đã Xóa</span>
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        {{-- @if (session('thongbao'))
            <div class="alert alert-success ">
                {{session('thongbao')}}
            </div>
        @endif --}}

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Giảng Viên Đã Xóa</div>
                    <div class="card-body">
                        {{-- <a href="{{route('giangvien.create')}}" class="btn btn-primary btn-sm" title="Thêm bộ môn">
                            <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới
                        </a> --}}

                        {{-- {!! Form::open(['method' => 'GET', 'url' => '/admin/giangvien', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Tìm kiếm...">
                            <span class="input-group-btn">

                                <button class="btn btn-primary" type="submit" style=" margin-bottom: 0px;">
                                    <i class="fa fa-search" ></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!} --}}
                        <br/>
                        <br/>
                        
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Tên giảng viên</th>
                                    <th>Mã giảng viên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($xoa as $x)
                                    <tr>
                                        <td><a href="{{route('getThongTin',$x->id)}}">{{$x->mmc_name}}</a></td>
                                        <td>{{$x->mmc_employeeid}}</td>
                                        <td>{{$x->email}}</td>
                                        <td>{{$x->mmc_phone}}</td>
                                        <td>
                                            <a href="{{route('getPhucHoi',$x->id)}}" title="phục hồi"><button class="btn btn-primary btn-sm"><i class="fa fa-refresh" aria-hidden="true"></i></button></a>
                                            {!! Form::open([
                                                'method' => 'GET',
                                                'url' => ['admin/giangvien/xoavinhvien',$x->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Xóa vĩnh viễn',
                                                    'onclick'=>'return confirm("Xác nhận xóa?")'
                                            )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="pagination justify-content-center"> {!! $giangvien->appends(['search' => Request::get('search')])->render() !!} </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

