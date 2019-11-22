@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý Bộ môn</h2>
            <span><a href="{{route('home')}}">Home</a> > <a href="{{route('department.index')}}">Quản lý bộ môn</a> > Thêm mới bộ môn </span>
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Thêm mới bộ môn</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/department') }}" title="Back"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Quay lại</button></a>
                        <p>
                        @if ($errors->any())
                            <ul class="alert alert-danger" style="list-style: none">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            @endif
                            </p>
                            {!! Form::open(['url' => '/admin/department', 'class' => 'form-horizontal']) !!}

                            @include ('admin.department.form', ['formMode' => 'create'])

                            {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

