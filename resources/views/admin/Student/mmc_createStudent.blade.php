@extends('layouts.backend')

@section('linkstyle')
<link href="css/mmc_createstudent.css" rel="stylesheet">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Quản lý sinh viên</h2>
		<span><a href="{{route('home')}}">Trang chủ</a> > <a href="{{route('homeStudent')}}">Quản lý sinh viên</a> > Thêm sinh viên</span>
	</div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight blog">
	@if($errors->any())
	<div id="error" class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">Thêm mới sinh viên</div>
				<div class="card-body">
					<div class="container">
						<div class="text-center">
							<h2>SƠ YẾU LÝ LỊCH SINH VIÊN</h2>
						</div>
						@if (session('status'))
						<br> <div class="alert alert-info">{{session('status')}}</div>
						@endif

						<form action="{{route('createStudent')}}" method="post" role="form">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-12">
									<h3 class="tieude">I. PHẦN BẢN THÂN SINH VIÊN</h3>
								</div>
								<div class="col-md-6">
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Họ và tên: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="text" name="mmc_fullname" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" value="{{ old('mmc_fullname') }}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Ngày tháng và năm sinh: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="date" name="mmc_dateofbirth" class="form-control" data-format="dd/mm/yyyy" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" value="{{ old('mmc_dateofbirth') }}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Dân tộc: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="text" name="mmc_ethnic" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" value="{{ old('mmc_ethnic') }}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Tôn giáo: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="text" name="mmc_religion" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" value="{{ old('mmc_religion') }}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Số chứng minh nhân dân: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="int" name="mmc_personalid" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" value="{{ old('mmc_religion') }}">
									</div>
									<div class="form-group">
										<label for="comment">Khen thưởng: </label>
										<textarea  name="mmc_reward" class="form-control" rows="4">{{ old('mmc_reward') }}</textarea>
									</div>

								</div>

								<div class="col-md-6">
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Lớp: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<select class="form-control" id="sel1" name="mmc_classid">
											@foreach($data as $classid)
											<option value="{{$classid['mmc_classid']}}">{{$classid['mmc_classname']}}</option>
											@endforeach
										</select>
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Mã sinh viên: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="text" name="mmc_studentid" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" value="{{ old('mmc_studentid') }}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Giới tính: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<div class="form-check-inline margin-left-10">
											<label class="form-check-label" for="radio1">
												<input type="radio" class="form-check-input" id="radio1" name="mmc_gender" value="0" checked>Nam
											</label>
										</div>
										<div class="form-check-inline">
											<label class="form-check-label" for="radio2">
												<input type="radio" class="form-check-input" id="radio2" name="mmc_gender" value="1">Nữ
											</label>
										</div>
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Hộ khẩu thường trú: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="text" name="mmc_address" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" value="{{ old('mmc_address') }}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Số điện thoại: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="int" name="mmc_phone" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" value="{{ old('mmc_phone') }}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Email: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="email" name="mmc_email" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" value="{{ old('mmc_email') }}">
									</div>
									<div class="form-group">
										<label for="comment">Kỷ luật: </label>
										<textarea  name="mmc_descipline" class="form-control" rows="2">{{ old('mmc_descipline') }}</textarea>
									</div>
								</div>

							</div>
							<br>

							<div class="row">
								<div class="col-md-12">
									<h3 class="tieude">II. THÀNH PHẦN GIA ĐÌNH</h3>
								</div>
								<div class="col-md-12">
									<h4>1. Cha:</h4>
								</div>

								<div class="col-md-6">
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Họ và tên: </span>
										</div>
										<input type="text" name="mmc_father" class="form-control" autocomplete="off" value="{{ old('mmc_father') }}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Dân tộc: </span>
										</div>
										<input type="text" name="mmc_fatherethnic" class="form-control" autocomplete="off" value="{{ old('mmc_fatherethnic') }}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Số điện thoại: </span>
										</div>
										<input type="text" name="mmc_fatherphone" class="form-control" autocomplete="off" value="{{ old('mmc_fatherphone') }}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Email: </span>
										</div>
										<input type="email" name="mmc_fatheremail" class="form-control"  autocomplete="off" value="{{ old('mmc_fatheremail') }}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Quốc tịnh: </span>
										</div>
										<input type="text" name="mmc_fathernationality" class="form-control" autocomplete="off" value="{{ old('mmc_fathernationality') }}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Tôn giáo: </span>
										</div>
										<input type="text" name="mmc_fatherreligion" class="form-control" autocomplete="off" value="{{ old('mmc_fatherreligion') }}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Nghề nghiệp: </span>
										</div>
										<input type="text" name="mmc_fatherjob" class="form-control" autocomplete="off" value="{{ old('mmc_fatherjob') }}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Hộ khẩu thường trú: </span>
										</div>
										<input type="text" name="mmc_fatheraddress" class="form-control" autocomplete="off" value="{{ old('mmc_fatheraddress') }}">
									</div>
								</div>
							</div>
							<h4>2. Mẹ:</h4>
							<div class="row">
								<div class="col-md-6">
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Họ và tên: </span>
										</div>
										<input type="text" name="mmc_mother" class="form-control" autocomplete="off" value="{{ old('mmc_mother') }}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Dân tộc: </span>
										</div>
										<input type="text" name="mmc_motherethnic" class="form-control" autocomplete="off" value="{{ old('mmc_motherethnic') }}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Số điện thoại: </span>
										</div>
										<input type="text" name="mmc_motherphone" class="form-control" autocomplete="off" value="{{ old('mmc_motherphone') }}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Email: </span>
										</div>
										<input type="email" name="mmc_motheremail" class="form-control"  autocomplete="off" value="{{ old('mmc_motheremail') }}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Quốc tịnh: </span>
										</div>
										<input type="text" name="mmc_mothernationality" class="form-control" autocomplete="off" value="{{ old('mmc_mothernationality') }}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Tôn giáo: </span>
										</div>
										<input type="text" name="mmc_motherreligion" class="form-control" autocomplete="off" value="{{ old('mmc_motherreligion') }}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Nghề nghiệp: </span>
										</div>
										<input type="text" name="mmc_motherjob" class="form-control" autocomplete="off" value="{{ old('mmc_motherjob') }}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text">Hộ khẩu thường trú: </span>
										</div>
										<input type="text" name="mmc_motheraddress" class="form-control" autocomplete="off" value="{{ old('mmc_motheraddress') }}">
									</div>
								</div>

							</div>
							<input class="btn btn-primary" type="submit" name="" value="Thêm thông tin">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
