@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý hoạt động nghiên cứu khoa học</h2>
            <span><a href="{{route('home')}}">Home</a> > Quản lý hoạt động nghiên cứu khoa học </span>
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        @if (Session::has('flash_message'))
            <div class="container col-md-12 error">
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Họat động khoa học công nghệ</div>
                    <div class="card-body">
                        <a href="{{route('scienceemployee.create')}}" class="btn btn-primary btn-sm" title="Thêm mới ngành">
                            <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table" id="major">
                                <thead>
                                <tr>
                                    <th>Nhiệm vụ</th>
                                    <th>Hệ số quy đổi</th>
                                    <th>Số giờ chuẩn</th>
                                    <th>Link</th>
                                    <th>File</th>
                                    <th>Trạng thái</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{$item->item->mmc_mission}}</td>
                                        <td>{{$item->item->mmc_coefficient}}</td>
                                        <td>{{$item->item->mmc_sogiochuan}}</td>
                                        <td><a href="{{$item->mmc_link}}">{{$item->mmc_link}}</a></td>
                                        <td>{{$item->mmc_file}}</td>
                                        <td>@if($item->mmc_status==0)Chưa duyệt @else Đã duyệt @endif</td>
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

