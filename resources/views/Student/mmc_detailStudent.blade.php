@extends('layouts.backend')

@section('linkstyle')
<link href="../../css/mmc_detailstudent.css" rel="stylesheet">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Quản lý sinh viên</h2>
		<span><a href="{{route('home')}}">Trang chủ</a> > <a href="{{route('homeStudent')}}">Quản lý sinh viên</a> > Thông tin sinh viên</span>
	</div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight blog">
	@if (session('status'))
	<br> <div class="alert alert-info">{{session('status')}}</div>
	@endif
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">Thông tin sinh viên</div>
				<a class="btn btn-primary width-100" href="">Xuất file pdf</a>
				<div class="card-body">
					<div class="container">
						<div class="text-center">
							<h2>SƠ YẾU LÝ LỊCH SINH VIÊN</h2>
						</div>
						<div class="row margin-top-10 font-size">

							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<h3 class="margin-top-10">I. PHẦN BẢN THÂN SINH VIÊN</h3>
									</div>
									<div class="col-md-6">
										<div class="input-group mb-3 input-group-sm">
											<span>Họ và tên: &nbsp;&nbsp;{{$data['mmc_fullname']}}</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Ngày tháng và năm sinh: &nbsp;&nbsp;{{date('d-m-Y', strtotime($data['mmc_dateofbirth']))}}</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Dân tộc: &nbsp;&nbsp;{{$data['mmc_ethnic']}}</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Tôn giáo: &nbsp;&nbsp;{{$data['mmc_religion']}}</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Số điện thoại: &nbsp;&nbsp;{{$data['mmc_phone']}}</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Email: &nbsp;&nbsp;{{$data['mmc_email']}}</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Khen thưởng: &nbsp;&nbsp;{{$data['mmc_reward']}}</span>
										</div>
									</div>

									<div class="col-md-6">
										<div class="input-group mb-3 input-group-sm">
											<span>Mã lớp: &nbsp;&nbsp;{{$data['mmc_classid']}}</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Mã sinh viên: &nbsp;&nbsp;{{$data['mmc_studentid']}}</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Giới tính: &nbsp;&nbsp;</span>
											@if($data['mmc_gender']==1)
											<span>Nữ</span>
											@else
											<span>Nam</span>
											@endif
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Hộ khẩu thường trú: &nbsp;&nbsp;{{$data['mmc_address']}}</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Số chứng minh nhân dân: &nbsp;&nbsp;{{$data['mmc_personalid']}}</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Kỷ luật: &nbsp;&nbsp;{{$data['mmc_descipline']}}</span>
										</div>
									</div>
								</div>	
							</div>
							
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<h3 class="margin-top-10">II. THÀNH PHẦN GIA ĐÌNH</h3>
									</div>
									<div class="col-md-12">
										<h3>1. Cha:</h3>
									</div>

									<div class="col-md-6">
										<div class="input-group mb-3 input-group-sm">
											<span>Họ và tên: &nbsp;&nbsp;{{$data['mmc_father']}}</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Dân tộc: &nbsp;&nbsp;{{$data['mmc_fatherethnic']}}</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Số điện thoại: &nbsp;&nbsp;{{$data['mmc_fatherphone']}}</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Email: &nbsp;&nbsp;{{$data['mmc_fatheremail']}}</span>
										</div>

									</div>
									<div class="col-md-6">
										<div class="input-group mb-3 input-group-sm">
											<span>Quốc tịnh: &nbsp;&nbsp;{{$data['mmc_fathernationality']}}</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Tôn giáo: &nbsp;&nbsp;{{$data['mmc_fatherreligion']}}</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Nghề nghiệp: &nbsp;&nbsp;{{$data['mmc_fatherjob']}}</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Hộ khẩu thường trú: &nbsp;&nbsp;{{$data['mmc_fatheraddress']}}</span>
										</div>
									</div>
								</div>
								<h3>2. Mẹ:</h3>
								<div class="row">
									<div class="col-md-6">
										<div class="input-group mb-3 input-group-sm">
											<span>Họ và tên: &nbsp;&nbsp;{{$data['mmc_mother']}}</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Dân tộc: &nbsp;&nbsp;{{$data['mmc_motherethnic']}}</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Số điện thoại: &nbsp;&nbsp;{{$data['mmc_motherphone']}}</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Email: &nbsp;&nbsp;{{$data['mmc_motheremail']}}</span>
										</div>
										
									</div>
									<div class="col-md-6">
										<div class="input-group mb-3 input-group-sm">
											<span>Quốc tịnh: &nbsp;&nbsp;{{$data['mmc_mothernationality']}}</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Tôn giáo: &nbsp;&nbsp;{{$data['mmc_motherreligion']}}</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Nghề nghiệp: &nbsp;&nbsp;{{$data['mmc_motherjob']}}</span>
										</div>
										<div class="input-group mb-3 input-group-sm">
											<span>Hộ khẩu thường trú: &nbsp;&nbsp;{{$data['mmc_motheraddress']}}</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection