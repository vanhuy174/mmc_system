@extends('layouts.backend')


@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Đổi PassWord</h2>
		<span><a href="{{route('home')}}">Home</a> > <a href="{{route('canhan.show',Auth::user()->id)}}">Thông Tin Cá Nhân</a> > Đổi Mật Khẩu</span>
	</div>
</div>
<div class="card-body">
    <a href="{{route('canhan.show',Auth::user()->id)}}" class="btn btn-primary btn-sm" title="quay về">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> Quay Về
    </a>
</div>
<div class="wrapper wrapper-content  animated fadeInRight blog">
    <div class="row">
        <div class="col-lg-12">
            @if (session('errors'))
                <div class="alert alert-danger ">
                    {{session('errors')}}
                </div>
            @endif

            @if (session('thongbao'))
                <div class="alert alert-success ">
                    {{session('thongbao')}}
                </div>
            @endif
        </div>
    </div>
	<div class="row">
        <div class="col-lg-1"></div>
		<div class="col-lg-10">
			<div class="card">
                <div class="card-header">Đổi Mật Khẩu</div>
				<div class="container">
					<form action="{{route('getDoiPass',Auth::user()->id)}}" method="POST">
                        {{ csrf_field() }}
                        <div class="col-lg-12 bg-white mt-3">
                            <h2 class="text-center">Đổi Mật Khẩu</h2>
                            <div class="input-group mb-3 input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Mật Khẩu Cũ: <b style="color:red;" >*</b></span>
                                </div>
                                <input type="password" name="password_Cu"  class="form-control" required autocomplete="off" >
                            </div>
                            <div class="input-group mb-3 input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Mật Khẩu Mới: <b style="color:red;" >*</b></span>
                                </div>
                                <input type="password" name="password_Moi1"  class="form-control" required autocomplete="off" >
                            </div>
                            <div class="input-group mb-3 input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Nhập lại Mật Khẩu Mới: <b style="color:red;" >*</b></span>
                                </div>
                                <input type="password" name="password_Moi2"  class="form-control" required autocomplete="off" >
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Thay đổi Mật Khẩu </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection