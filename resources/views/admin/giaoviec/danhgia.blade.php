@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Đánh Gía Công Việc</h2>
            <span><a href="{{route('home')}}">Home</a> > <a href="{{route('giaoviec.index')}}"> Quản lý Công Việc</a> > Đánh Gía Công Việc </span>
        </div>
    </div>
    <div class="card-body">
        <a href="{{route('giaoviec.index')}}" class="btn btn-primary btn-sm" title="quay về">
            <i class="fa fa-arrow-left" aria-hidden="true"></i> Quay Về
        </a>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        {{-- @if (session('thongbao'))
            <div class="alert alert-success ">
                {{session('thongbao')}}
            </div>
        @endif --}}

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Đánh Gía</div>
                    <div class="card-body">
                        <form action="{{route('postdanhgia',$danhgia->id)}}" method="post">
                            {{-- {{ method_field('PUT') }} --}}
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label>Người Nhận:</label>
                                        <input type="text" class="form-control" name="mmc_employeeid" value="{{$danhgia->nguoinhan->mmc_name}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày Bắt Đầu:</label>
                                        <input type="date" class="form-control" name="mmc_batdau" value="{{$danhgia->mmc_batdau}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày Kết Thúc:</label>
                                        <input type="date" class="form-control" name="mmc_ketthuc" value="{{$danhgia->mmc_ketthuc}}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <label>Tiêu Đề:</label>
                                        <input type="text" class="form-control" name="mmc_tieude" value="{{$danhgia->mmc_tieude}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Nội Dung Công Việc:</label>
                                        <textarea class="form-control" rows="5" name="mmc_noidung"readonly >{{$danhgia->mmc_noidung}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Ghi Chú:</label>
                                        <textarea class="form-control" rows="2" name="mmc_ghichu" readonly>{{$danhgia->mmc_ghichu}}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Kết Qủa:</label>
                                        <select class="browser-default custom-select" name="mmc_ketqua">
                                            @foreach (config('test.kq') as $kq)
                                                <option value="{{$kq}}" {{$kq==$danhgia->mmc_ketqua ? 'selected' : ''}}>{{$kq}}</option>
                                            @endforeach          
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nhận Xét:</label>
                                        <textarea class="form-control" rows="5" name="mmc_nhanxet" >{{$danhgia->mmc_nhanxet}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary float-right">Giao Việc</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

