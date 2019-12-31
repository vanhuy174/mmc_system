@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý Giảng Viên</h2>
            <span><a href="{{route('home')}}">Home</a> > Quản Lý Giảng Viên</span>
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        @if (session('thongbao'))
            <div class="alert alert-success ">
                {{session('thongbao')}}
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Giảng Viên</div>
                    <div class="card-body">
                        <a href="{{route('giangvien.create')}}" class="btn btn-primary btn-sm" title="Thêm bộ môn">
                            <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới
                        </a>
                        <a href="{{route('getXoa')}}" class="btn btn-primary btn-sm" title="Thêm bộ môn">
                            <i class="fa fa-trash-o" aria-hidden="true"></i> Danh Sách Giảng Viên Đã Xóa
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/giangvien', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Tìm kiếm...">
                            <span class="input-group-btn">

                                <button class="btn btn-primary" type="submit" style=" margin-bottom: 0px;">
                                    <i class="fa fa-search" ></i>
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
                                    <th>Tên giảng viên</th>
                                    <th>Mã giảng viên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Quyền</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($giangvien as $gv)
                                    <tr>
                                        <td><a href="{{route('giangvien.show',$gv->id)}}">{{$gv->mmc_name}}</a></td>
                                        <td>{{$gv->mmc_employeeid}}</td>
                                        <td>{{$gv->email}}</td>
                                        <td>{{$gv->mmc_phone}}</td>
                                        <td >
                                            
                                            @if ( $gv->mmc_level ==1)
                                                Admin
                                            @else   
                                                Member
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/giangvien/'.$gv->id.'/edit') }}" title="Sửa thông tin giảng viên"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                            {{-- <a href="" title="phân quyền"><button class="btn btn-primary btn-sm"><i class="fa fa-sitemap" aria-hidden="true"></i></button></a> --}}
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'url' => ['/admin/giangvien',$gv->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Xóa giảng viên',
                                                    'onclick'=>'return confirm("Xác nhận xóa?")'
                                            )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-center"> {!! $giangvien->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

