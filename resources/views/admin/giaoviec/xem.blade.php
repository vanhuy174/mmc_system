@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý Công Việc</h2>
            <span><a href="{{route('home')}}">Home</a> > <a href="{{route('giaoviec.index')}}"> Quản lý Công Việc</a> > Xem Công Việc</span>
        </div>
    </div>
    <div class="card-body">
        <a href="{{route('giaoviec.index')}}" class="btn btn-primary btn-sm" title="quay về">
            <i class="fa fa-arrow-left" aria-hidden="true"></i> Quay Về
        </a>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Xem</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <h3>Người Gửi:</h3>
                                    <br>
                                    <p>{{$xem->nguoigui->mmc_name}}</p>
                                </div>
                                <div class="form-group">
                                    <h3>Người Nhận:</h3>
                                    <br>
                                    <p>{{$xem->nguoinhan->mmc_name}}</p>
                                </div>
                                <div class="form-group">
                                    <h3>Ngày Bắt Đầu:</h3>
                                    <br>
                                    <p>{{$xem->mmc_batdau}}</p>
                                </div>
                                <div class="form-group">
                                    <h3>Ngày Kết Thúc:</h3>
                                    <br>
                                    <p>{{$xem->mmc_ketthuc}}</p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <h3>Tiêu Đề:</h3>
                                    <br>
                                    <p>{{$xem->mmc_tieude}}</p>
                                </div>
                                <div class="form-group">
                                    <h3>Nội Dung Công Việc:</h3>
                                    <br>
                                    <p>{{$xem->mmc_noidung}}</p>
                                </div>
                                <div class="form-group">
                                    <h3>Ghi Chú:</h3>
                                    <br>
                                    <p>{{$xem->mmc_ghichu}}</p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <h3>Kết Qủa:</h3>
                                    <br>
                                    <p>{{$xem->mmc_ketqua}}</p>
                                </div>
                                <div class="form-group">
                                    <h3>Nhận Xét:</h3>
                                    <br>
                                    <p>{{$xem->mmc_nhanxet}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

