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
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Quản lý giảng viên </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Quản lý danh mục</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="table-responsive">
                                    <table class="table" id="major">
                                        <thead>
                                        <tr>
                                            <th>Giảng viên</th>
                                            <th>Nhiệm vụ</th>
                                            <th>Hệ số quy đổi</th>
                                            <th>Số giờ chuẩn</th>
                                            <th>Link</th>
                                            <th>File</th>
                                            <th>Trạng thái</th>
                                            <th>Chức năng</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($items as $item)
                                            <tr>
                                                <td>{{$item->mmc_employeeid}}</td>
                                                <td>{{$item->item->mmc_mission}}</td>
                                                <td>{{$item->item->mmc_coefficient}}</td>
                                                <td>{{$item->item->mmc_sogiochuan}}</td>
                                                <td><a href="{{$item->mmc_link}}">{{$item->mmc_link}}</a></td>
                                                <td  class="click" data-toggle="modal" data-target="#myModal" style="cursor:pointer">{{$item->mmc_file}}</td>
                                                <td>@if($item->mmc_status==0)Chưa duyệt @else Đã duyệt @endif</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm update" value="{{$item->id}}"><i class="fa fa-check" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <br/>
                                <a href="{{route('science.create')}}" class="btn btn-primary btn-sm" title="Thêm mới ngành">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới
                                </a>
                                <div class="table-responsive">
                                    <table class="table" id="major">
                                        <thead>
                                        <tr>
                                            <th>Nhiệm vụ</th>
                                            <th>Hệ số quy đổi</th>
                                            <th>Số giờ chuẩn</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $i=1;
                                        @endphp
                                        @foreach($listitem as $item)
                                            <tr>
                                                <td colspan="3" style="color:red">- {{$item->mmc_mission}}</td>
                                            </tr>
                                            @foreach($item->items as $mission)
                                                <tr>
                                                    <td>{{$i}}. {{$mission->mmc_mission}}</td>
                                                    <td>{{$mission->mmc_coefficient}}</td>
                                                    <td>{{$mission->mmc_sogiochuan}}</td>
                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                </div>
                <div class="modal-body" >
                    <embed width="100%" height="500" id="pdf">
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(".update").click(function(e) {
            selectVal = $(this).val();
            $.ajax({
                method: "POST",
                url: "{{route('ajaxupdate')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": selectVal},
                success : function ( data ) {
                    location.reload();
                }
            })
        });
        $(document).ready(function(){
            $(document).on('click', '.click', function () {//load document
                var s=$(this).text();
                $("#pdf").attr('src','/PDF/'+s+'');
            });
        });
    </script>
@endsection

