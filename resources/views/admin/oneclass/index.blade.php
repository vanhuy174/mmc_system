@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý lớp giảng dạy</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        @if (!empty($flash_message))
            <div class="container col-md-12 error">
                <div class="alert alert-success">
                    {{ $flash_message }}
                </div>
            </div>
        @else
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Lớp giảng dạy</div>
                    <div class="card-body">
                        {!! Form::open(['method' => 'GET', 'url' => '/admin/oneclass', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
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
                                    <th>Mã sinh viên</th>
                                    <th>Tên sinh viên</th>
                                    <th>Email</th>
                                    <th>SĐT</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($student as $item)
                                    <tr>
                                        <th>{{$item->mmc_studentid}}</th>
                                        <td>{{$item->mmc_fullname}}</td>
                                        <td>{{$item->mmc_email}}</td>
                                        <td>{{$item->mmc_phone}}</td>
                                    </tr>
                                 @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-center"> {!! $student->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection

