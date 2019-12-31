@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý Công Việc</h2>
            <span><a href="{{route('home')}}">Home</a> > Quản lý Công Việc</span>
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
                    <div class="card-header">Quản lý Công Việc</div>
                    <div class="card-body">
                        <a href="{{route('giaoviec.create')}}" class="btn btn-primary btn-sm" title="Thêm bộ môn">
                            <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/giaoviec', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
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
                            <table class="table table-bordered" style="table-layout:fixed;">
                                <thead>
                                <tr>
                                    <th>Tên người nhận </th>
                                    <th>Công Việc</th>
                                    <th>Ngày Bắt Đầu</th>
                                    <th>Ngày Kết Thúc</th>
                                    <th>Kết Qủa</th>
                                    <th>Nhận Xét</th>
                                    <th>Chức Năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                @foreach($danhsach as $gv)
                                    <tr>
                                        <td>{{$gv->nguoinhan->mmc_name}}</td>
                                        <td style="width: auto;
                                        text-overflow: ellipsis;
                                        overflow: hidden;
                                        white-space: nowrap;" ><a href="{{route('giaoviec.show',$gv->id)}}">{{$gv->mmc_tieude}}</a></td>
                                        <td>{{$gv->mmc_batdau}}</td>
                                        <td>{{$gv->mmc_ketthuc}}</td>
                                        <td >{{$gv->mmc_ketqua}}</td>
                                        <td style="width: auto;
                                        text-overflow: ellipsis;
                                        overflow: hidden;
                                        white-space: nowrap;">{{$gv->mmc_nhanxet}}</td>
                                        <td>
                                            <a href="{{ route('getdanhgia',$gv->id) }}" title="đánh giá công việc"><button class="btn btn-primary btn-sm"><i class="fa fa-archive" aria-hidden="true"></i></button></a>
                                            <a href="{{ url('/admin/giaoviec/'.$gv->id.'/edit') }}" title="Sửa công việc"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'url' => ['/admin/giaoviec',$gv->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Xóa công việc',
                                                    'onclick'=>'return confirm("Xác nhận xóa?")'
                                            )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-center"> {!! $danhsach->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

