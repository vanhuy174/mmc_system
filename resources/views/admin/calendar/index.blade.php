@extends('layouts.backend')

@section('linkstyle')
	<link href="../../css/mmc_homestudent.css" rel="stylesheet">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Quản lý lịch giảng dạy</h2>
		<span><a href="{{route('home')}}">Trang chủ</a> > <a href="{{route('homeCalendar')}}">Quản lý lịch giảng dạy</a></span>
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
				<div class="card-header">Lịch giảng dạy</div>
				<div class="card-body">
					<div class="padding-5">
						<a class="btn btn-primary float-left margin-left-10" href="" data-toggle="modal" data-target="#themfile">Thêm bằng file</a>
						{{-- <a class="btn btn-primary float-left margin-left-10" href="{{route('exportStudent')}}">Xuất ra file</a> --}}
						<!-- Modal -->
						<div class="modal fade" id="themfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h3 class="modal-title" id="exampleModalLabel">Thêm lịch giảng dạy bằng file.</h3>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="{{ route('importCalendar') }}" method="POST" enctype="multipart/form-data">
										@csrf
										<div class="modal-body">
                                            <div class="form-group">
                                                <label class="color-red">Chọn học kỳ:</label>
                                                <select class="form-control" name="semester">
                                                    @foreach(semester() as $key)
                                                        <option value="{{$key}}">{{$key}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Chọn file: </label>
                                                <input type="file" class="form-control" required="required" name="file">
                                            </div>
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary">Thêm</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Tên giảng viên</th>
                                    <th>Bộ môn</th>
                                    <th>Lớp học phần</th>
                                    <th>Số tín chỉ</th>
                                    <th>Số tiết</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                	 <tr>
                                        <td>{{$item->mmc_name}}</td>
                                        <td>{{$item->department->mmc_deptname}}</td>
                                        <td>
		                                	@foreach($item->subjectclass as $sjc)
		                                        {{$sjc->mmc_subjectclassname}}</br>
											@endforeach
										</td>
                                        <td>
                                        	@foreach($item->subjectclass as $sjc)
		                                        {{$sjc->subject->mmc_theory + $sjc->subject->mmc_practice}}</br>
											@endforeach
                                        </td>
                                        <td>
                                        	@foreach($item->subjectclass as $sjc)
		                                        {{tinhsotiet($sjc->subject->mmc_theory, $sjc->subject->mmc_practice)}}</br>
											@endforeach
                                        </td>
									</tr>
                                    @endforeach
                                </tbody>
                            </table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
