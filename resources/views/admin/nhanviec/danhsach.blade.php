@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Thông Báo</h2>
            <span><a href="{{route('home')}}">Home</a> > Thông báo</span>
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Các thông báo</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" style="table-layout:fixed;">
                                <thead>
                                <tr>
                                    <th>Tên người gửi </th>
                                    <th>Tiêu Đề</th>
                                    <th>Ngày Bắt Đầu</th>
                                    <th>Ngày Kết Thúc</th>
                                    <th>Kết Qủa</th>
                                    <th>Nhận Xét</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                @foreach($danhsach as $gv)
                                    <tr>
                                        <td>{{$gv->nguoigui->mmc_name}}</td>
                                        <td style="width: auto;
                                        text-overflow: ellipsis;
                                        overflow: hidden;
                                        white-space: nowrap;">
                                        <a href="{{route('nhanviec.show',$gv->id)}}">{{$gv->mmc_tieude}}</a></td>
                                        <td>{{$gv->mmc_batdau}}</td>
                                        <td>{{$gv->mmc_ketthuc}}</td>
                                        <td >{{$gv->mmc_ketqua}}</td>
                                        <td style="width: auto;
                                        text-overflow: ellipsis;
                                        overflow: hidden;
                                        white-space: nowrap;">
                                        {{$gv->mmc_nhanxet}}</td>
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

