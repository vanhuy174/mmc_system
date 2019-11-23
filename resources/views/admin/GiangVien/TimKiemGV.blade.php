@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Tìm Kiếm Thông Tin Giảng Viên</h2>
            <span><a href="{{route('home')}}">Home</a> > <a href="{{route('danh-sach-giang-vien')}}">Quản Lý Giảng Viên</a> > <a href="{{route('get-tim-kiem-giang-vien')}}">Tìm Kiếm Thông Tin Giảng Viên</a></span>
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        {{-- @if (Session::has('flash_message'))
            <div class="container col-md-12 error">
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            </div>
        @endif --}}
        @if (session('thongbao'))
            <div class="alert alert-success ">
                <strong>Success! </strong> {{session('thongbao')}}
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    {{-- <div class="card-header">Giảng Viên</div> --}}
                    <div class="card-body">
                        <a href="{{route('get-them-giang-vien')}}" class="btn btn-primary btn-sm" title="Thêm bộ môn">
                            <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới
                        </a>

                        {!! Form::open(['method' => 'post', 'url' => '/admin/giang-vien/tim-kiem-thong-tin-giang-vien', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control " name="tukhoa" placeholder="Tìm kiếm...">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">
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
                                    <th>Id</th>
                                    <th>Tên giảng viên</th>
                                    <th>Mã giảng viên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($thongtin as $tt)
                                    <tr>
                                        <td>{{$tt->id}}</td>
                                        <td>{{$tt->mmc_name}}</td>
                                        <td>{{$tt->mmc_employeeid}}</td>
                                        <td>{{$tt->email}}</td>
                                        <td>{{$tt->mmc_phone}}</td>
                                        <td>
                                            <a href="{{route('get-thong-tin-giang-vien',$tt->id)}}" title="Xem"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            <a href="{{route('get-sua-thong-tin-giang-vien',$tt->id)}}" title="Sửa Giảng Viên"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                            <a href="{{route('get-xoa-giang-vien',$tt->id)}}" title="Xóa"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
                                            {{-- {!! Form::open([
                                                'method' => 'DELETE',
                                                'url' => ['/admin/giang-vien/xoa-giang-vien',$ds->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Xóa bộ môn',
                                                    'onclick'=>'return confirm("Xác nhận xóa?")'
                                            )) !!}
                                            {!! Form::close() !!} --}}
                                        </td>
                                    </tr>
                                @endforeach
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

