@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý lớp</h2>
            <span><a href="{{route('home')}}">Home</a> > Quản lý lớp
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        @if (Session::has('flash_message'))
            <div class="error">
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            </div>
        @endif
        @if($errors->any())
<<<<<<< HEAD
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <ul>
=======
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <ul>
>>>>>>> tvduong
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
<<<<<<< HEAD
            </ul>
        </div>
        @endif
        
        <div class="row">
=======
                </ul>
            </div>
        @endif

                <div class="row">
>>>>>>> tvduong
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Lớp</div>
                    <div class="card-body">
                        <a href="{{route('class.create')}}" class="btn btn-primary btn-sm" title="Thêm mới lớp">
                            <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới
                        </a>
                        <a href="{{ url('/admin/class/export') }}" class="btn btn-primary btn-sm" title="Export Excel">
                            <i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Excel
                        </a>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-file-excel-o"></i> Import Excel</button>
                        {!! Form::open(['method' => 'GET', 'url' => '/admin/class', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Tìm kiếm...">
                            <span class="input-group-btn">
<<<<<<< HEAD
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search" style="
                                    margin-bottom: 0px;
                                "></i>
=======
                                <button class="btn btn-secondary" type="submit" style=" margin-bottom: 0px;">
                                    <i class="fa fa-search" ></i>
>>>>>>> tvduong
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
                                    <th>Tên lớp</th>
                                    <th>Ngành</th>
                                    <th>Giáo viên chủ nhiệm</th>
                                    <th>Số sinh viên</th>
                                    <th>Mô tả</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($class as $item)
                                    <tr>
                                        <td>{{$item->mmc_classname}}</td>
                                        <td>{{\App\Http\Controllers\Admin\ClassController::getmajor($item->mmc_major)}}</td>
                                        <td>{{$item->mmc_headteacher}}</td>
                                        <td>{{$item->mmc_numstudent}}</td>
                                        <td>{{$item->mmc_description}}</td>
                                        <td>
<<<<<<< HEAD
                                            {{-- <a href="{{ url('#') }}" title="Hiển thị lớp"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a> --}}
=======
>>>>>>> tvduong
                                            <a href="{{ url('/admin/class/'.$item->id.'/edit') }}" title="Sửa lớp"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'url' => ['/admin/class', $item->id],
                                                    'style' => 'display:inline'
                                                ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Xóa Lớp',
                                                        'onclick'=>'return confirm("Xác nhận xóa?")'
                                                )) !!}
                                                {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-center"> {!! $class->appends(['search' => Request::get('search')])->render() !!} </div>
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
                        <form action="{{url('/admin/class/import')}}" method="POST" enctype="multipart/form-data">
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

