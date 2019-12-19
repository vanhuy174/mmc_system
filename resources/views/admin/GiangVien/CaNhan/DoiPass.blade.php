@extends('layouts.backend')


@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Đổi PassWord</h2>
		<span><a href="{{route('home')}}">Home</a> > <a href="{{route('get-thong-tin-ca-nhan',Auth::user()->id)}}">Thông Tin Cá Nhân</a> > <a href="{{route('get-doi-pass',Auth::user()->id)}}">Đổi Mật Khẩu</a></span>
	</div>
</div>
{{-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Sửa Thông Tin Giảng Viên</h2>
    </div>
</div> --}}
{{-- <div class="card-body">
    <a href="{{route('danh-sach-giang-vien')}}" class="btn btn-success btn-sm" title="quay về">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> Quay Về
    </a>
</div> --}}
<div class="wrapper wrapper-content  animated fadeInRight blog">
    <div class="row my-3">
        <div class="col-lg-12">
            {{-- @if (count($errors)>0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $err)
                        <strong>Warning! </strong>{{$err}}<br>
                    @endforeach
                </div> 
            @endif --}}
            
            @if (session('errors'))
                <div class="alert alert-danger ">
                    <strong>Success! </strong> {{session('errors')}}
                </div>
            @endif

            @if (session('thongbao'))
                <div class="alert alert-success ">
                    <strong>Success! </strong> {{session('thongbao')}}
                </div>
            @endif
        </div>
    </div>
	<div class="row">
        <div class="col-lg-1"></div>
		<div class="col-lg-10">
			<div class="card">
				<div class="container">
					<form action="{{route('post-doi-pass',Auth::user()->id)}}" method="post">
                        {{ csrf_field() }}
                        <div class="col-lg-12 bg-white mt-3">
                            <h2 class="text-center">Đổi Mật Khẩu</h2>
                            <div class="input-group mb-3 input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Mật Khẩu Cũ: <b style="color:red;" >*</b></span>
                                </div>
                                <input type="password" name="password_Cu" minlength="3" class="form-control" required autocomplete="off" >
                            </div>
                            <div class="input-group mb-3 input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Mật Khẩu Mới: <b style="color:red;" >*</b></span>
                                </div>
                                <input type="password" name="password_Moi1" minlength="3" class="form-control" required autocomplete="off" >
                            </div>
                            <div class="input-group mb-3 input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Nhập lại Mật Khẩu Mới: <b style="color:red;" >*</b></span>
                                </div>
                                <input type="password" name="password_Moi2" minlength="3" class="form-control" required autocomplete="off" >
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success float-right">Thay đổi Mật Khẩu </button>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>
</div>
@endsection