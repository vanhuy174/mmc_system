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
<<<<<<< HEAD
                    <form class="form-inline" action="{{route('homeStudent')}}">
                            <div class="form-group mb-2">
                                <label for="amajor">Ngành:&emsp;</label>
                                <select class="form-control" id="amajor" name="manghanh">
                                    @if(isset($majorid))
                                        @foreach($data_major as $key)
                                            @if($majorid == $key->mmc_majorid)
                                                <option value="{{$key->mmc_majorid}}" selected>{{$key->mmc_majorname}}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option>...</option>
                                    @endif
                                    @foreach($data_major as $key)
                                        <option value="{{$key->mmc_majorid}}">{{$key->mmc_majorname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="aclass">&emsp;Lớp:&emsp;</label>
                                <select class="form-control width-200" id="aclass" name="malop">
                                    @if(isset($classid))
                                        @foreach($data_class as $key)
                                            @if($classid == $key->mmc_classid)
                                                <option value="{{$key->mmc_classid}}" selected>{{$key->mmc_classname}}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option>...</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <button class="btn btn-primary" type="submit">Xem</button>
                            </div>
=======
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
>>>>>>> ca394d0ecc9e0d7888c08cfe92ac2984e09038f9
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
								<input type="text" class="form-control" placeholder="Nhập họ tên, mã sinh viên hoặc email" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" name="search">
								<div class="input-group-append">
									<button class="btn btn-primary margin-bottom">Tìm kiếm</button>
								</div>
							</div>
						</form>
					</div>
<<<<<<< HEAD
                    <form action="{{route('setstatus')}}" method="post">
                        @csrf
					<table class="table table-hover">
						<tr>
                            <th><input type="checkbox" onclick="checkall();" id="checkall"></th>
=======
                    <form action="{{route('statusstudent')}}" method="post">
                        @csrf
					<table class="table table-hover">
						<tr>
                            <th><input type="checkbox" id="checkall" value=""></th>
>>>>>>> ca394d0ecc9e0d7888c08cfe92ac2984e09038f9
							<th>Họ tên</th>
							<th>Mã sinh viên</th>
							<th>Lớp</th>
							<th>Email</th>
							<th>Số điện thoại</th>
<<<<<<< HEAD
							<th>Trạng thái</th>
=======
                            <th>Trạng thái</th>
>>>>>>> ca394d0ecc9e0d7888c08cfe92ac2984e09038f9
							<th>Thao tác</th>
						</tr>
						@if(isset($student))
						@foreach($student as $row)
						<tr>
<<<<<<< HEAD
                            <td><input class="checkone" type="checkbox" value="{{$row->id}}" name="check[]"></td>
							<td><a href="{{route('showStudent',['id'=>$row['id']])}}">{{$row->mmc_fullname}}</a></td>
=======
                            <td><input type="checkbox" class="checkone" name="student[]" value="{{$row->id}}"></td>
							<td>{{$row->mmc_fullname}}</td>
>>>>>>> ca394d0ecc9e0d7888c08cfe92ac2984e09038f9
							<td>{{$row->mmc_studentid}}</td>
							<td>
								@foreach($class as $classid)
									@if($classid['mmc_classid'] == $row['mmc_classid'])
										{{$classid['mmc_classname']}}
									@endif
								@endforeach
							</td>
<<<<<<< HEAD
							<td>{{date('d-m-Y', strtotime($row['mmc_dateofbirth']))}}</td>
							<td>
								@if($row->mmc_gender == 0) Nam
								@else Nữ
								@endif
							</td>
=======
>>>>>>> ca394d0ecc9e0d7888c08cfe92ac2984e09038f9
							<td>{{$row->mmc_email}}</td>
							<td>{{$row->mmc_phone}}</td>
							<td>{{$row->mmc_status}}</td>
							<td>
								<a href="{{route('editStudent',['id'=>$row['id']])}}" class="btn btn-primary btn-sm" title="Sửa"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
								<a href="{{route('destroyStudent',['id'=>$row['id']])}}" onclick="return confirm('Bạn có muốn xoá không!')" class="btn btn-danger btn-sm" title="Xóa"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
							</td>
						</tr>
						@endforeach
						@endif
					</table>
<<<<<<< HEAD
					<div class="pagination justify-content-center"> {!! $data->appends(['search' => Request::get('search'), 'manghanh' => Request::get('manghanh'), 'malop' => Request::get('malop')])->render() !!} </div>
				    <div class="form-inline">
                        <div class="form-group mb-2">
                            <label>Trạng thái:&emsp;</label>
                            <select class="form-control width-200" id="" name="status">
                                <option value="danghoc">Đang học</option>
                                <option value="baoluu">Bảo lưu</option>
                                <option value="dinhchi">Đình chỉ</option>
                                <option value="thoihoc">Thôi học</option>
                                <option value="totngiep">Tốt nghiệp</option>
                            </select>
                        </div>
                        <input class="btn btn-primary" type="submit" value="Thay đổi">
=======
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
>>>>>>> ca394d0ecc9e0d7888c08cfe92ac2984e09038f9
                    </div>
                    </form>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<<<<<<< HEAD
    <script>
        $(document).ready(function() {
            $('#amajor').on('change', function () {
                var selectVal = $(this).val();
                console.log(selectVal);
                $.ajax({
                    method: "POST",
                    url: "{{ route('ajaxmajor') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": selectVal},
                    success : function ( data ) {
                        $('#aclass').html(data);
                    }
                })
            });
        });
        $(document).ready(function() {
            $("#checkall").click(function() {
                $(":checkbox").attr('checked',
                    $('#checkall').is(':checked'));
                $(this).closest('tr').toggleClass('highlight');
            });
        });
    </script>
@endsection
=======
    <script src="js/checkbox.js"></script>
@endsection

>>>>>>> ca394d0ecc9e0d7888c08cfe92ac2984e09038f9
