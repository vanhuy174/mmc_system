@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý hoạt động nghiên cứu khoa học</h2>
            <span><a href="{{route('home')}}">Home</a> > <a href="{{route('scienceemployee.index')}}">Quản lý hoạt động nghiên cứu khoa học</a> > Thêm mới hoạt động </span>
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Thêm mới ngành</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/scienceemployee') }}" title="Back"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Quay lại</button></a>
                        @if ($errors->any())
                            <ul class="alert alert-danger" style="list-style: none">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        {!! Form::open(['url' => '/admin/scienceemployee', 'class' => 'form-horizontal','files'=>true]) !!}

                        @include ('admin.scienceemployee.form', ['formMode' => 'create'])

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

