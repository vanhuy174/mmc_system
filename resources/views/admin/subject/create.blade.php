@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý môn học</h2>
            <span><a href="{{route('home')}}">Home</a> ><a href="{{route('educationprogram.index')}}">Quản lý chương trình đào tạo ></a><a href="{{route('subject.index')}}">Quản lý môn học</a> > Thêm mới môn học </span>
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Thêm mới môn học</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/subject') }}" title="Back"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Quay lại</button></a>

                        @if ($errors->any())
                            <ul class="alert alert-danger" style="list-style: none">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            @endif
                            {!! Form::open(['url' => '/admin/subject', 'class' => 'form-horizontal']) !!}

                            @include ('admin.subject.form', ['formMode' => 'create'])

                            {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

