@extends('layouts.backend')

@section('linkstyle')
	<link href="css/mmc_homestudent.css" rel="stylesheet">
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
				<div class="card-header">
                    <form action="{{route("withclass")}}" method="post">
                        @csrf
                        <select class="form-control width-25 float-left" name="majorid">
                            @foreach($major as $key)
                                <option <?php if($majorid == $key->mmc_majorid){ echo "selected";} ?> value="{{$key->mmc_majorid}}">{{$key->mmc_majorname}}</option>
                            @endforeach
                        </select>
                        <select class="form-control width-25 float-left" name="classid">
                            @foreach($class as $key)
                                <option <?php if($classid == $key->mmc_classid){ echo "selected";} ?> value="{{$key->mmc_classid}}">{{$key->mmc_classname}}</option>
                            @endforeach
                        </select>
                        <input type="submit" class="btn btn-primary" value="Xem">
                    </form>
                </div>
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
                    <form action="{{route('statusstudent')}}" method="post">
                        @csrf
					<table class="table table-hover">
						<tr>
                            <th><input type="checkbox" id="checkall" value=""></th>
							<th>Họ tên</th>
							<th>Mã sinh viên</th>
							<th>Lớp</th>
							<th>Email</th>
							<th>Số điện thoại</th>
                            <th>Trạng thái</th>
							<th>Thao tác</th>
						</tr>
						@if(isset($student))
						@foreach($student as $row)
						<tr>
                            <td><input type="checkbox" class="checkone" name="student[]" value="{{$row->id}}"></td>
							<td>{{$row->mmc_fullname}}</td>
							<td>{{$row->mmc_studentid}}</td>
							<td>
								@foreach($class as $classid)
									@if($classid['mmc_classid'] == $row['mmc_classid'])
										{{$classid['mmc_classname']}}
									@endif
								@endforeach
							</td>
							<td>{{$row->mmc_email}}</td>
							<td>{{$row->mmc_phone}}</td>
							<td>{{$row->mmc_status}}</td>
							<td>
								<a href="{{route('showStudent',['id'=>$row['id']])}}" title="View User"><button class="btn btn-info btn-sm">Xem</button></a>
								<a href="{{route('editStudent',['id'=>$row['id']])}}" title="Edit User"><button class="btn btn-primary btn-sm">Sửa</button></a>
								<a href="{{route('destroyStudent',['id'=>$row['id']])}}" onclick="return confirm('Bạn có muốn xoá không!')"><button class="btn btn-danger btn-sm">Xoá</button></a>
							</td>
						</tr>
						@endforeach
						@endif
					</table>
					<div class="pagination justify-content-center"> {!! $student->appends(['search' => Request::get('search')])->render() !!} </div>
                    <div>
                        <select class="form-control width-15 float-left" name="action">
                            <option value="danghoc">Đang học</option>
                            <option value="totnghiep">Đã tốt ngiệp</option>
                            <option value="baoluu">Bảo lưu điêm</option>
                            <option value="dinhchihoc">Đình chỉ học</option>
                            <option value="buocthoihoc">Buộc thôi học</option>
                            <option value="xoa">Xoá</option>
                        </select>
                        <input type="submit" class="btn btn-primary" value="Thực hiện">
                    </div>
                    </form>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
    <script src="js/checkbox.js"></script>
@endsection

