@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý Bộ môn</h2>
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
                    <div class="card-header">Bộ môn</div>
                    <div class="card-body">
                        <a href="{{route('department.create')}}" class="btn btn-primary btn-sm" title="Thêm bộ môn">
                            <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/department', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
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
                                    <th>Tên bộ môn</th>
                                    <th>Mô tả</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($department as $item)
                                    <tr>
                                        <td>{{$item->mmc_deptname}}</td>
                                        <td>{{$item->mmc_description}}</td>
                                        <td>
                                            <a href="{{ url('/admin/department/'.$item->id.'/edit') }}" title="Sửa bộ môn"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'url' => ['/admin/department', $item->id],
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
                            <nav aria-label="Page navigation example" style="padding-left: 1px;">  </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

