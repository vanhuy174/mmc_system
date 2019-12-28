@extends('layouts.backend')

@section('linkstyle')
<link href="css/mmc_createstudent.css" rel="stylesheet">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Quản lý sinh viên</h2>
		<span><a href="{{route('home')}}">Trang chủ</a> > <a href="{{route('homeStudent')}}">Quản lý sinh viên</a> > Sửa thông tin sinh viên</span>
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
				<div class="card-header">Sửa thông tin sinh viên</div>
				<div class="card-body">
					<div class="container">
						<div class="text-center">
							<h2>SƠ YẾU LÝ LỊCH SINH VIÊN</h2>
						</div>
						<form action="{{route('updateStudent',['id'=>$data['id']])}}" method="post" role="form">
							{{ csrf_field() }}
							{{-- {{ method_field('POST') }} --}}
							<div class="row">
								<div class="col-md-12">
									<h3 class="tieude">I. PHẦN BẢN THÂN SINH VIÊN</h3>
								</div>
								<div class="col-md-6">
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Họ và tên: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="text" name="mmc_fullname" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" value="{{$data['mmc_fullname']}}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Ngày sinh: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="date" name="mmc_dateofbirth" class="form-control" data-format="dd/mm/yyyy" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" value="{{$data['mmc_dateofbirth']}}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Dân tộc: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="text" name="mmc_ethnic" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off" value="{{$data['mmc_ethnic']}}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Tôn giáo: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="text" name="mmc_religion" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off"  value="{{$data['mmc_religion']}}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Số CMND: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="int" name="mmc_personalid" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off"  value="{{$data['mmc_personalid']}}">
									</div>
                                    <div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Khoá: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="text" name="mmc_course" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off"  value="{{$data['mmc_course']}}">
									</div>

									<div class="form-group">
										<label for="comment">Khen thưởng: </label>
										<textarea  name="mmc_reward" class="form-control" rows="2">{{$data['mmc_reward']}}</textarea>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Lớp: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<select class="form-control" id="sel1" name="mmc_classid">
											@foreach($data_class as $classid)
											<option value="{{$classid['mmc_classid']}}">{{$classid['mmc_classname']}}</option>
											@endforeach
										</select>
									</div>
<<<<<<< HEAD

=======
>>>>>>> 9ebf5f8656a348f20c1c0344f8436ce209bb5cf6
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Mã sinh viên: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="text" name="mmc_studentid" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off"  value="{{$data['mmc_studentid']}}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Giới tính: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<div class="form-check-inline" style="margin-left: 10px;">
											<label class="form-check-label" for="radio1">
												<input type="radio" class="form-check-input" id="radio1" name="mmc_gender" value="0" {{$data['mmc_gender']==0 ? 'checked': '' }}>Nam
											</label>
										</div>
										<div class="form-check-inline">
											<label class="form-check-label" for="radio2">
												<input type="radio" class="form-check-input" id="radio2" name="mmc_gender" value="1" {{$data['mmc_gender']!=0 ? 'checked' : ''}}>Nữ
											</label>
										</div>
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Địa chỉ: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="text" name="mmc_address" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off"  value="{{$data['mmc_address']}}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">SĐT: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="int" name="mmc_phone" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off"  value="{{$data['mmc_phone']}}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Email: <b class="color-red">&nbsp;&nbsp;*</b></span>
										</div>
										<input type="email" name="mmc_email" class="form-control" required oninvalid="this.setCustomValidity('Không được để trống')" oninput="this.setCustomValidity('')" autocomplete="off"  value="{{$data['mmc_email']}}">
									</div>
									<div class="form-group">
										<label for="comment">Kỷ luật: </label>
										<textarea  name="mmc_descipline" class="form-control" rows="2">{{$data['mmc_descipline']}}</textarea>
									</div>
								</div>
<<<<<<< HEAD

=======
                                    <div class="col-md-12">
                                        <h3 class="tieude">II. NỘI NGOẠI TRÚ <span>(Chỉ điền thông tin cho 1 trong 2)</span></h3>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3 input-group-sm">
                                            <h3>1. Nội trú</h3>
                                        </div>
                                        <div class="input-group mb-3 input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text width-input">Dãy nhà: </span>
                                            </div>
                                            <input type="text" name="mmc_dormitory" class="form-control" placeholder="VD: A2" autocomplete="off" value="{{$data['mmc_dormitory']}}">
                                        </div>
                                        <div class="input-group mb-3 input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text width-input">Số phòng:</span>
                                            </div>
                                            <input type="text" name="mmc_room_dormitory" class="form-control" placeholder="VD: 102" autocomplete="off" value="{{$data['mmc_room_dormitory']}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3 input-group-sm">
                                            <h3>2. Ngoại trú</h3>
                                        </div>
                                        <div class="input-group mb-3 input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text width-input">Họ tên chủ trọ: </span>
                                            </div>
                                            <input type="text" name="mmc_landlord_name" class="form-control" placeholder="VD: Nhuyễn Thị Lan" autocomplete="off" value="{{$data['mmc_landlord_name']}}">
                                        </div>
                                        <div class="input-group mb-3 input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text width-input">SĐT: </span>
                                            </div>
                                            <input type="text" name="mmc_landlord_phone" class="form-control" placeholder="VD: 0915332678" autocomplete="off" value="{{$data['mmc_landlord_phone']}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="comment">Địa chỉ : </label>
                                            <textarea  name="mmc_landlord_address" class="form-control" rows="2" placeholder="VD: Phòng 11, Xóm cô Lan, Tổ 3, Phường Tân Thịnh, Xã Quyết Thắng, TP Thái Nguyên">{{$data['mmc_landlord_address']}}</textarea>
                                        </div>
                                    </div>
>>>>>>> 9ebf5f8656a348f20c1c0344f8436ce209bb5cf6
								<div class="col-md-12">
									<h3 class="tieude">III. THÀNH PHẦN GIA ĐÌNH</h3>
								</div>
								<div class="col-md-12">
									<h3>1. Cha:</h3>
								</div>

								<div class="col-md-6">
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Họ và tên: </span>
										</div>
										<input type="text" name="mmc_father" class="form-control" autocomplete="off"  value="{{$data['mmc_father']}}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Dân tộc: </span>
										</div>
										<input type="text" name="mmc_fatherethnic" class="form-control" autocomplete="off" value="{{$data['mmc_fatherethnic']}}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">SĐT: </span>
										</div>
										<input type="text" name="mmc_fatherphone" class="form-control" autocomplete="off" value="{{$data['mmc_fatherphone']}}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Email: </span>
										</div>
										<input type="email" name="mmc_fatheremail" class="form-control"  autocomplete="off" value="{{$data['mmc_fatheremail']}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Quốc tịnh: </span>
										</div>
										<input type="text" name="mmc_fathernationality" class="form-control" autocomplete="off" value="{{$data['mmc_fathernationality']}}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Tôn giáo: </span>
										</div>
										<input type="text" name="mmc_fatherreligion" class="form-control" autocomplete="off" value="{{$data['mmc_fatherreligion']}}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Nghề nghiệp: </span>
										</div>
										<input type="text" name="mmc_fatherjob" class="form-control" autocomplete="off"  value="{{$data['mmc_fatherjob']}}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Địa chỉ: </span>
										</div>
										<input type="text" name="mmc_fatheraddress" class="form-control" autocomplete="off"  value="{{$data['mmc_fatheraddress']}}">
									</div>
								</div>
							</div>
							<h3>2. Mẹ:</h3>
							<div class="row">
								<div class="col-md-6">
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Họ và tên: </span>
										</div>
										<input type="text" name="mmc_mother" class="form-control" autocomplete="off" value="{{$data['mmc_mother']}}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Dân tộc: </span>
										</div>
										<input type="text" name="mmc_motherethnic" class="form-control" autocomplete="off" value="{{$data['mmc_motherethnic']}}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">SĐT: </span>
										</div>
										<input type="text" name="mmc_motherphone" class="form-control"  autocomplete="off" value="{{$data['mmc_motherphone']}}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Email: </span>
										</div>
										<input type="email" name="mmc_motheremail" class="form-control"  autocomplete="off" value="{{$data['mmc_motheremail']}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Quốc tịnh: </span>
										</div>
										<input type="text" name="mmc_mothernationality" class="form-control"  autocomplete="off"  value="{{$data['mmc_mothernationality']}}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Tôn giáo: </span>
										</div>
										<input type="text" name="mmc_motherreligion" class="form-control"  autocomplete="off" value="{{$data['mmc_motherreligion']}}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Nghề nghiệp: </span>
										</div>
										<input type="text" name="mmc_motherjob" class="form-control"  autocomplete="off" value="{{$data['mmc_motherjob']}}">
									</div>
									<div class="input-group mb-3 input-group-sm">
										<div class="input-group-prepend">
											<span class="input-group-text width-input">Địa chỉ: </span>
										</div>
										<input type="text" name="mmc_motheraddress" class="form-control"  autocomplete="off" value="{{$data['mmc_motheraddress']}}">
									</div>
								</div>
							</div>
							<input class="btn btn-primary" type="submit" name="" value="Sửa thông tin">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
