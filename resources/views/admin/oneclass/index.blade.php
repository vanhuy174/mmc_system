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
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="table-responsive container" >
                                    <table class="table">
                                        <tr>
                                            <th style="border-top: none;">Tên lớp:</th>
                                            <td style="text-align: center;border-top: none;" >{{$lop->mmc_classname}}</td>
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
                            </div>
                            <div class="col-lg-4">
                                <table class="table">
                                    <tr>
                                        <th style="border-top: none;">Xuất sắc :</th>
                                        <td style="text-align: center; border-top: none;">10</td>
                                    </tr>
                                    <tr>
                                        <th>Giỏi :</th>
                                        <td style="text-align: center">5</td>
                                    </tr>
                                    <tr>
                                        <th>Khá  :</th>
                                        <td style="text-align: center">4</td>
                                    </tr>
                                    <tr>
                                        <th>Trung Bình :</th>
                                        <td style="text-align: center">3</td>
                                    </tr>
                                    <tr>
                                        <th>Kém :</th>
                                        <td style="text-align: center">2</td>
                                    </tr>
                                </table>
                            </div>
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
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($student as $item)
                                    <tr>
                                        <th>{{$item->mmc_studentid}}</th>
                                        <td>{{$item->mmc_fullname}}</td>
                                        <td>{{$item->mmc_email}}</td>
                                        <td>{{$item->mmc_phone}}</td>
                                        <td>2.5</td>
                                        <td>6.75</td>
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

