@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý Ngành</h2>
            <span><a href="{{route('home')}}">Home</a> > Quản lý ngành </span>
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
                    <div class="card-header">Ngành</div>
                    <div class="card-body">
                        <a href="{{route('major.create')}}" class="btn btn-primary btn-sm" title="Thêm mới ngành">
                            <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới
                        </a>
                        {!! Form::open(['method' => 'GET', 'url' => '/admin/major', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Tìm kiếm...">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="submit" style="margin-bottom: 0px;">
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
                                    <th>Mã Ngành</th>
                                    <th>Tên Ngành</th>
                                    <th>Bộ Môn</th>
                                    <th>Mô Tả</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($major as $item)
                                <tr>
                                    <td>{{$item->mmc_majorid}}</td>
                                    <td>{{$item->mmc_majorname}}</td>
                                    <td>{{App\Http\Controllers\Admin\MajorController::getDepartment($item->mmc_deptid)}}</td>
                                    <td>{{$item->mmc_description}}</td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-center"> {!! $major->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

