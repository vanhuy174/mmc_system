@extends('layouts.backend')
@section('css')

<link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">

@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Thêm Công Việc</h2>
            <span><a href="{{route('home')}}">Home</a> > <a href="{{route('giaoviec.index')}}"> Quản lý Công Việc</a> > Thêm Công Việc </span>
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
                    <div class="card-header">Thêm</div>
                    <div class="card-body">
                        <form action="{{route('giaoviec.store')}}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Người Nhận:</label>
                                        <br>
                                        <select data-placeholder="chọn người nhận" class="chosen-select " name="mmc_nguoinhan[]" multiple style="width:350px;" tabindex="4">
                                            @foreach($department as $item)
                                                <optgroup label="{{$item->mmc_deptname}}">
                                                    @foreach($employee as $employeeitem)
                                                        @if($employeeitem->mmc_deptid == $item->mmc_deptid)
                                                            <option value="{{$employeeitem->mmc_employeeid}}">{{$employeeitem->mmc_name}}</option>
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                        {{-- <select name="mmc_nguoinhan[]" class="mdb-select md-form" multiple size="24" >
                                            <br>
                                            @foreach($department as $item)
                                                <optgroup label="{{$item->mmc_deptname}}">
                                                    @foreach($employee as $employeeitem)
                                                        @if($employeeitem->mmc_deptid == $item->mmc_deptid)
                                                            <option value="{{$employeeitem->mmc_employeeid}}">{{$employeeitem->mmc_name}}</option>
                                                            
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select> --}}
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="form-group">
                                        <label>Ngày Bắt Đầu:</label>
                                        <input type="date" class="form-control" name="mmc_batdau">
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày Kết Thúc:</label>
                                        <input type="date" class="form-control" name="mmc_ketthuc">
                                    </div>
                                    <div class="form-group">
                                        <label>Tiêu Đề:</label>
                                        <input type="text" class="form-control" name="mmc_tieude">
                                    </div>
                                    <div class="form-group" hidden>
                                        <label>Công Việc Chung:</label>
                                        <input type="text" class="form-control" value="{{$cvc}}" name="mmc_cv">
                                    </div>
                                    <div class="form-group">
                                        <label>Nội Dung Công Việc:</label>
                                        <textarea class="form-control" rows="5" name="mmc_noidung" ></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Ghi Chú:</label>
                                        <textarea class="form-control" rows="2" name="mmc_ghichu" ></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary float-right">Giao Việc</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')

<script src="js/plugins/chosen/chosen.jquery.js"></script>

<script>
    $(document).ready(function(){
    $('.chosen-select').chosen({width: "100%"});
    });

</script>
@endsection
