@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý lớp giảng dạy</h2>
            <span><a href="{{route('home')}}">Home</a> > Quản lý lớp giảng dạy </span>
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        @if (!empty($flash_message))
            <div class="container col-md-12 error">
                <div class="alert alert-success">
                    {{ $flash_message }}
                </div>
            </div>
        @else
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Lớp chủ nhiệm</div>
                    <div class="card-body">
                        <br/>
                        <br/>
                        <h1 style="text-align: center;"><b>Thông tin cơ bản</b></h1>
                        <div class="table-responsive container" style="width: 50%;">
                            <table class="table">
                                <tr>
                                    <th>Tên lớp:</th>
                                    <td style="text-align: center">{{$lop->mmc_classname}}</td>
                                </tr>
                                <tr>
                                    <th>Số sinh viên:</th>
                                    <td style="text-align: center">{{$lop->mmc_numstudent}}</td>
                                </tr>
                                <tr>
                                    <th>Lớp trưởng:</th>
                                    <td style="text-align: center">{{$lop->mmc_monitor}}</td>
                                </tr>
                                <tr>
                                    <th>Bí thư:</th>
                                    <td style="text-align: center">{{$lop->mmc_secretary}}</td>
                                </tr>
                            </table>
                        </div>
                        <h1 style="text-align: center;"><b>Bảng sinh viên lớp</b></h1>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Mã sinh viên</th>
                                    <th>Tên sinh viên</th>
                                    <th>Email</th>
                                    <th>SĐT</th>
                                    <th>Điểm hệ 4</th>
                                    <th>Điểm hệ 10</th>
                                    <th>Trạng thái</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($student as $item)
                                    <tr>
                                        <th>{{$item->mmc_studentid}}</th>
                                        <td>{{$item->mmc_fullname}}</td>
                                        <td>{{$item->mmc_email}}</td>
                                        <td>{{$item->mmc_phone}}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                 @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="pagination justify-content-center"> {!! $student->appends(['search' => Request::get('search')])->render() !!} </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection

