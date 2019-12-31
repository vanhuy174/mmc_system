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
                    <form class="form-inline" action="{{route('homeStudent')}}">
                            <div class="form-group mb-2">
                                <label for="amajor">Ngành:&emsp;</label>
                                <select class="form-control amajor" name="manghanh">
                                    @if(isset($majorid))
                                        <option value="">...</option>
                                        @foreach($data_major as $key)
                                            @if($majorid == $key->mmc_majorid)
                                                <option value="{{$key->mmc_majorid}}" selected>{{$key->mmc_majorname}}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value="">...</option>
                                    @endif
                                    @foreach($data_major as $key)
                                        <option value="{{$key->mmc_majorid}}">{{$key->mmc_majorname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="aclass">&emsp;Lớp:&emsp;</label>
                                <select class="form-control width-200 aclass" name="malop">
                                    @if(isset($classid))
                                        @foreach($data_class as $key)
                                            @if($classid == $key->mmc_classid)
                                                <option value="{{$key->mmc_classid}}" selected>{{$key->mmc_classname}}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value="">...</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="aclass">&emsp;Trạng thái:&emsp;</label>
                                <select class="form-control width-200" name="status">
                                    <option value="">...</option>
                                    <option <?php if(isset($status) && $status == 'danghoc') echo 'selected';?> value="danghoc">Đang học</option>
                                    <option <?php if(isset($status) && $status == 'baoluu') echo 'selected';?> value="baoluu">Bảo lưu</option>
                                    <option <?php if(isset($status) && $status == 'dinhchi') echo 'selected';?> value="dinhchi">Đình chỉ</option>
                                    <option <?php if(isset($status) && $status == 'thoihoc') echo 'selected';?> value="thoihoc">Thôi học</option>
                                    <option <?php if(isset($status) && $status == 'totngiep') echo 'selected';?> value="totngiep">Tốt nghiệp</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <button class="btn btn-primary" type="submit">Xem</button>
                            </div>
                    </form>
                </div>
				<div class="card-body">
					<div class="padding-5">
						<a class="btn btn-primary float-left" href="{{route('formcreateStudent')}}">Thêm mới</a>
						<a class="btn btn-primary float-left margin-left-10" href="" data-toggle="modal" data-target="#themfile">Nhập file</a>
						<a class="btn btn-primary float-left margin-left-10" href="" data-toggle="modal" data-target="#xuatfile">Xuất file</a>
						<!-- Modal them bang file excel-->
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
                        <!-- Modal xuất ra file excel-->
                        <div class="modal fade" id="xuatfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="exampleModalLabel">Xuất file Excel danh sách sinh viên.</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{route('exportStudent')}}">
                                        <div class="modal-body">
                                            <div class="form-group mb-2">
                                                <label for="amajor">Ngành:&emsp;</label>
                                                <select class="form-control amajor" name="manghanh">
                                                    @if(isset($majorid))
                                                        <option value="">...</option>
                                                        @foreach($data_major as $key)
                                                            @if($majorid == $key->mmc_majorid)
                                                                <option value="{{$key->mmc_majorid}}" selected>{{$key->mmc_majorname}}</option>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <option value="">...</option>
                                                    @endif
                                                    @foreach($data_major as $key)
                                                        <option value="{{$key->mmc_majorid}}">{{$key->mmc_majorname}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="aclass">&emsp;Lớp:&emsp;</label>
                                                <select class="form-control aclass" name="malop">
                                                    @if(isset($classid))
                                                        @foreach($data_class as $key)
                                                            @if($classid == $key->mmc_classid)
                                                                <option value="{{$key->mmc_classid}}" selected>{{$key->mmc_classname}}</option>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <option value="">...</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="aclass">&emsp;Trạng thái:&emsp;</label>
                                                <select class="form-control" name="status">
                                                    <option value="">...</option>
                                                    <option <?php if(isset($status) && $status == 'danghoc') echo 'selected';?> value="danghoc">Đang học</option>
                                                    <option <?php if(isset($status) && $status == 'baoluu') echo 'selected';?> value="baoluu">Bảo lưu</option>
                                                    <option <?php if(isset($status) && $status == 'dinhchi') echo 'selected';?> value="dinhchi">Đình chỉ</option>
                                                    <option <?php if(isset($status) && $status == 'thoihoc') echo 'selected';?> value="thoihoc">Thôi học</option>
                                                    <option <?php if(isset($status) && $status == 'totngiep') echo 'selected';?> value="totngiep">Tốt nghiệp</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Xuất file</button>
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
                    <form action="{{route('setstatus')}}" method="post">
                        @csrf
					<table class="table table-hover">
						<tr>
                            <th><input type="checkbox" onclick="checkall();" id="checkall"></th>
                            <th>Mã sinh viên</th>
                            <th>Họ tên</th>
							<th>Lớp</th>
							<th>Email</th>
							<th>Số điện thoại</th>
							<th>Trạng thái</th>
							<th>Thao tác</th>
						</tr>
						@if(isset($data))
						@foreach($data as $row)
						<tr>
                            <td><input class="checkone" type="checkbox" value="{{$row->id}}" name="check[]"></td>
                            <td>{{$row->mmc_studentid}}</td>
							<td><a href="{{route('showStudent',['id'=>$row['id']])}}">{{$row->mmc_fullname}}</a></td>
							<td>
								@foreach($data_class as $classid)
									@if($classid['mmc_classid'] == $row['mmc_classid'])
										{{$classid['mmc_classname']}}
									@endif
								@endforeach
							</td>
							<td>{{$row->mmc_email}}</td>
							<td>{{$row->mmc_phone}}</td>
							<td>@if($row->mmc_status == 'danghoc')
                                    Đang học
                                @elseif($row->mmc_status == 'baoluu')
                                    Bảo lưu
                                @elseif($row->mmc_status == 'dinhchi')
                                    Đình chỉ
                                @elseif($row->mmc_status == 'thoihoc')
                                    Thôi học
                                @else
                                    Tốt nghiệp
                                @endif
                            </td>
							<td>
								<a href="{{route('editStudent',['id'=>$row['id']])}}" class="btn btn-primary btn-sm" title="Sửa"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
								<a href="{{route('destroyStudent',['id'=>$row['id']])}}" onclick="return confirm('Bạn có muốn xoá không!')" class="btn btn-danger btn-sm" title="Xóa"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
							</td>
						</tr>
						@endforeach
						@endif
					</table>
					<div class="pagination justify-content-center"> {!! $data->appends(['search' => Request::get('search'), 'manghanh' => Request::get('manghanh'), 'malop' => Request::get('malop'), 'status' => Request::get('status')])->render() !!} </div>
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
                    </div>
                    </form>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.amajor').on('change', function () {
                var selectVal = $(this).val();
                console.log(selectVal);
                $.ajax({
                    method: "POST",
                    url: "{{ route('ajaxmajor') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": selectVal},
                    success : function ( data ) {
                        $('.aclass').html(data);
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
