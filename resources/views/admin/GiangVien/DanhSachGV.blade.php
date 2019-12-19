@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý Giảng Viên</h2>
            <span><a href="{{route('home')}}">Home</a> > <a href="{{route('danh-sach-giang-vien')}}">Quản Lý Giảng Viên</a></span>
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        @if (session('thongbao'))
            <div class="alert alert-success ">
                <strong>Thành Công! </strong> {{session('thongbao')}}
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

                        {!! Form::open([
                            'method' => 'post', 
                            'url' => '/admin/giang-vien/tim-kiem-thong-tin-giang-vien', 
                            'class' => 'form-inline my-2 my-lg-0 float-right',
                            'role' => 'search'
                            ])  !!}
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
                                    <th>Tên giảng viên</th>
                                    <th>Mã giảng viên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($danhsach as $ds)
                                    <tr>
                                        <td><a href="{{route('get-thong-tin-giang-vien',$ds->id)}}">{{$ds->mmc_name}}</a></td>
                                        <td>{{$ds->mmc_employeeid}}</td>
                                        <td>{{$ds->email}}</td>
                                        <td>{{$ds->mmc_phone}}</td>
                                        <td>
                                            <a href="{{route('get-thong-tin-giang-vien',$ds->id)}}" title="Xem"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            <a href="{{route('get-sua-thong-tin-giang-vien',$ds->id)}}" title="Sửa Giảng Viên"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                            {{-- <a href="{{route('get-xoa-giang-vien',$ds->id)}}" title="Xóa"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a> --}}
                                            {!! Form::open([
                                                'method' => 'get',
                                                'url' => ['/admin/giang-vien/xoa-giang-vien',$ds->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Xóa bộ môn',
                                                    'onclick'=>'return confirm("Xác nhận xóa?")'
                                            )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $danhsach->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

