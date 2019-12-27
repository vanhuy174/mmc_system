@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý chương trình đào tạo</h2>
            <span><a href="{{route('home')}}">Home</a> > <a href="{{route('educationprogram.index')}}">Quản lý chương trình đào tạo</a> > Thêm mới  </span>
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        @if ($errors->any())
            <ul class="alert alert-danger" style="list-style: none">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">CTĐT</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/educationprogram') }}" title="Back"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Quay lại</button></a>
                        <p>
                        </p>
                        <div style="text-align: center">
                            <h5>ĐẠI HỌC THÁI NGUYÊN</h5>
                            <h5>TRƯỜNG ĐẠI HỌC CÔNG NGHỆ THÔNG TIN VÀ TRUYỀN THÔNG</h5>
                            <br>
                            <h5>KHUNG CHƯƠNG TRÌNH ĐÀO TẠO </h5>
                            <h5>{{\App\Http\Controllers\Admin\ClassController::getmajor($majorid)}}</h5>
                            <h5>( Thực hiện từ khóa {{$course}} )</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Tên môn học</th>
                                    <th>Số tín chỉ</th>
                                    <th>Số tín lý thuyết</th>
                                    <th>Số tín thực hành</th>
                                    <th>Học kỳ</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr><td colspan="5" style="text-align: center;font-weight: bold">Khối kiến thức giáo dục đại cương</td></tr>
                                    @foreach($educationprogram as $item)
                                        @if($item->mmc_classify=='KKTGDDC'&&$item->mmc_elective==null)
                                            <tr>
                                                <td>{{\App\Http\Controllers\Admin\SubjectController::getname($item->mmc_subjectid)}}</td>
                                                <td>{{\App\Http\Controllers\Admin\SubjectController::gettinchi($item->mmc_subjectid)}}</td>
                                                <td>{{\App\Http\Controllers\Admin\SubjectController::gettheory($item->mmc_subjectid)}}</td>
                                                <td>{{\App\Http\Controllers\Admin\SubjectController::getpractice($item->mmc_subjectid)}}</td>
                                                <td>{{$item->mmc_semester}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @for($i=0;$i<count($educationprogramtcdc)/2;$i++)
                                        <tr>
                                            <td class="b-color-red" style="text-align: center;">Học phần tự chọn đại cương {{$i+1}}</td>
                                            <td colspan="4"></td>
                                        </tr>
                                        @foreach($educationprogramtcdc as $item)
                                            @if($item->mmc_elective==$educationprogramtcdc[$i]['mmc_elective'])
                                                <tr>
                                                    <td>{{\App\Http\Controllers\Admin\SubjectController::getname($item->mmc_subjectid)}}</td>
                                                    <td>{{\App\Http\Controllers\Admin\SubjectController::gettinchi($item->mmc_subjectid)}}</td>
                                                    <td>{{\App\Http\Controllers\Admin\SubjectController::gettheory($item->mmc_subjectid)}}</td>
                                                    <td>{{\App\Http\Controllers\Admin\SubjectController::getpractice($item->mmc_subjectid)}}</td>
                                                    <td>{{$item->mmc_semester}}</td>
                                        </tr>
                                            @endif
                                        @endforeach
                                    @endfor
                                    <tr><td colspan="5" style="text-align: center;font-weight: bold">Khối kiến thức cơ sở ngành</td></tr>
                                    @foreach($educationprogram as $item)
                                        @if($item->mmc_classify=='KKTCSN'&&$item->mmc_elective==null)
                                            <tr>
                                                <td>{{\App\Http\Controllers\Admin\SubjectController::getname($item->mmc_subjectid)}}</td>
                                                <td>{{\App\Http\Controllers\Admin\SubjectController::gettinchi($item->mmc_subjectid)}}</td>
                                                <td>{{\App\Http\Controllers\Admin\SubjectController::gettheory($item->mmc_subjectid)}}</td>
                                                <td>{{\App\Http\Controllers\Admin\SubjectController::getpractice($item->mmc_subjectid)}}</td>
                                                <td>{{$item->mmc_semester}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @for($i=0;$i<count($educationprogramtccsn)/2;$i++)
                                        <tr>
                                            <td class="b-color-red" style="text-align: center;">Học phần tự chọn cơ sở ngành {{$i+1}}</td>
                                            <td colspan="4"></td>
                                        </tr>
                                        @foreach($educationprogramtccsn as $item)
                                            @if($item->mmc_elective==$educationprogramtccsn[$i]['mmc_elective'])
                                                <tr>
                                                    <td>{{\App\Http\Controllers\Admin\SubjectController::getname($item->mmc_subjectid)}}</td>
                                                    <td>{{\App\Http\Controllers\Admin\SubjectController::gettinchi($item->mmc_subjectid)}}</td>
                                                    <td>{{\App\Http\Controllers\Admin\SubjectController::gettheory($item->mmc_subjectid)}}</td>
                                                    <td>{{\App\Http\Controllers\Admin\SubjectController::getpractice($item->mmc_subjectid)}}</td>
                                                    <td>{{$item->mmc_semester}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endfor
                                    <tr><td colspan="5" style="text-align: center;font-weight: bold">Khối kiến thức chuyên ngành</td></tr>
                                    @foreach($educationprogram as $item)
                                        @if($item->mmc_classify=='KKTCN'&&$item->mmc_elective==null)
                                            <tr>
                                                <td>{{\App\Http\Controllers\Admin\SubjectController::getname($item->mmc_subjectid)}}</td>
                                                <td>{{\App\Http\Controllers\Admin\SubjectController::gettinchi($item->mmc_subjectid)}}</td>
                                                <td>{{\App\Http\Controllers\Admin\SubjectController::gettheory($item->mmc_subjectid)}}</td>
                                                <td>{{\App\Http\Controllers\Admin\SubjectController::getpractice($item->mmc_subjectid)}}</td>
                                                <td>{{$item->mmc_semester}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @for($i=0;$i<count($educationprogramtccn)/2;$i++)
                                        <tr>
                                            <td class="b-color-red" style="text-align: center;">Học phần tự chọn chuyên ngành {{$i+1}}</td>
                                            <td colspan="4"></td>
                                        </tr>
                                        @foreach($educationprogramtccn as $item)
                                            @if($item->mmc_elective==$educationprogramtccn[$i]['mmc_elective'])
                                                <tr>
                                                    <td>{{\App\Http\Controllers\Admin\SubjectController::getname($item->mmc_subjectid)}}</td>
                                                    <td>{{\App\Http\Controllers\Admin\SubjectController::gettinchi($item->mmc_subjectid)}}</td>
                                                    <td>{{\App\Http\Controllers\Admin\SubjectController::gettheory($item->mmc_subjectid)}}</td>
                                                    <td>{{\App\Http\Controllers\Admin\SubjectController::getpractice($item->mmc_subjectid)}}</td>
                                                    <td>{{$item->mmc_semester}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endfor
                                    <tr><td colspan="5" style="text-align: center;font-weight: bold">Thực tập khóa luân tốt nghiệp</td></tr>
                                    @foreach($educationprogram as $item)
                                        @if($item->mmc_classify=='TTKLTN'&&$item->mmc_elective==null)
                                            <tr>
                                                <td>{{\App\Http\Controllers\Admin\SubjectController::getname($item->mmc_subjectid)}}</td>
                                                <td>{{\App\Http\Controllers\Admin\SubjectController::gettinchi($item->mmc_subjectid)}}</td>
                                                <td>{{\App\Http\Controllers\Admin\SubjectController::gettheory($item->mmc_subjectid)}}</td>
                                                <td>{{\App\Http\Controllers\Admin\SubjectController::getpractice($item->mmc_subjectid)}}</td>
                                                <td>{{$item->mmc_semester}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @for($i=0;$i<count($educationprogramtctn)/2;$i++)
                                        <tr>
                                            <td class="b-color-red" style="text-align: center;">Học phần tự chọn khóa luận tốt nghiệp {{$i+1}}</td>
                                            <td colspan="4"></td>
                                        </tr>
                                        @foreach($educationprogramtctn as $item)
                                            @if($item->mmc_elective==$educationprogramtctn[$i]['mmc_elective'])
                                                <tr>
                                                    <td>{{\App\Http\Controllers\Admin\SubjectController::getname($item->mmc_subjectid)}}</td>
                                                    <td>{{\App\Http\Controllers\Admin\SubjectController::gettinchi($item->mmc_subjectid)}}</td>
                                                    <td>{{\App\Http\Controllers\Admin\SubjectController::gettheory($item->mmc_subjectid)}}</td>
                                                    <td>{{\App\Http\Controllers\Admin\SubjectController::getpractice($item->mmc_subjectid)}}</td>
                                                    <td>{{$item->mmc_semester}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endfor
                                </tbody>
                            </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

