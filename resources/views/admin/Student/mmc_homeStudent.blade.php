@extends('layouts.backend')

@section('linkstyle')
	<link href="../../css/mmc_homestudent.css" rel="stylesheet">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Quản lý sinh viên</h2>
		<span><a href="{{route('home')}}">Trang chủ</a> > <a href="{{route('homeStudent')}}">Quản lý sinh viên</a></span>
	</div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight blog">
	@if (session('status'))
	<br> <div id="error" class="alert alert-info">{{session('status')}}</div>
	@endif
	@if($errors->any())
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
        <ul style="overflow-y: scroll; max-height: 250px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">Danh sách sinh viên</div>
				<div class="card-body">
					<div class="padding-5">
						<a class="btn btn-primary float-left" href="{{route('formcreateStudent')}}">Thêm mới</a>
						<a class="btn btn-primary float-left margin-left-10" href="" data-toggle="modal" data-target="#themfile">Thêm bằng file</a>
						<a class="btn btn-primary float-left margin-left-10" href="{{route('exportStudent')}}">Xuất ra file</a>
						<!-- Modal -->
						<div class="modal fade" id="themfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h3 class="modal-title" id="exampleModalLabel">Thêm sinh viên bằng file.</h3>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="{{ route('importStudent') }}" method="POST" enctype="multipart/form-data">
										@csrf
										<div class="modal-body">
											<input type="file" class="form-control" required="required" name="file">
										</div>
										<div class="modal-footer">
											<span>Bạn chưa có mẫu file: <a href="{{route('downloadfileExcel')}}"> Nhấn vào đây </a> để tải về </span>
											<button type="submit" class="btn btn-primary">Thêm</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<form action="{{route('homeStudent')}}" method="get" role="form">
							{{-- {{ csrf_field() }} --}}
							<div class="input-group mb-3 center-block width-40 float-right">
								<input type="text" class="form-control" placeholder="Nhập họ tên, mã sinh viên, ngành hoặc email" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" name="search">
								<div class="input-group-append">
									<button class="btn btn-primary margin-bottom">Tìm kiếm</button>
								</div>
							</div>
						</form>
					</div>

					<table class="table table-hover">
						<tr>
							<th>Họ tên</th>
							<th>Mã sinh viên</th>
							<th>Lớp</th>
							<th>Ngày sinh</th>
							<th>Giới tính</th>
							<th>Email</th>
							<th>Số điện thoại</th>
							<th>Thao tác</th>
						</tr>
						@if(isset($data))
						@foreach($data as $row)
						<tr>

							<td>{{$row -> mmc_fullname}}</td>
							<td>{{$row -> mmc_studentid}}</td>
							<td>
								@foreach($data_class as $classid)
									@if($classid['mmc_classid'] == $row['mmc_classid'])
										{{$classid['mmc_classname']}}
									@endif
								@endforeach
							</td>
							<td>{{date('d-m-Y', strtotime($row['mmc_dateofbirth']))}}</td>
							<td>
								@if($row -> mmc_gender == 0) Nam 
								@else Nữ
								@endif
							</td>
							<td>{{$row -> mmc_email}}</td>
							<td>{{$row -> mmc_phone}}</td>
							<td>
								<a href="{{route('showStudent',['id'=>$row['id']])}}" title="View User"><button class="btn btn-info btn-sm">Xem</button></a>
								<a href="{{route('editStudent',['id'=>$row['id']])}}" title="Edit User"><button class="btn btn-primary btn-sm">Sửa</button></a>
								<a href="{{route('destroyStudent',['id'=>$row['id']])}}" onclick="return confirm('Bạn có muốn xoá không!')"><button class="btn btn-danger btn-sm">Xoá</button></a>
							</td>
						</tr>
						@endforeach
						@endif
					</table>
					<div class="pagination justify-content-center"> {!! $data->appends(['search' => Request::get('search')])->render() !!} </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection