@extends('layouts.backend')
@section('css')
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
    <link href="css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'>
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Lịch giảng dạy</h2>
            <span><a href="{{route('home')}}">Home</a> > Lịch giảng dạy </span>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row animated fadeInDown">
            <div class="col-lg-3" >
                <div class="ibox ">
                    <div class="ibox-content time_class">
                        <h3>Thời gian ra vào lớp</h3>
                        <div>
                            <table>
                                <tr>
                                    <td><?php if(Auth::user()->mmc_level==1) echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edittime">Sửa thời gian</button>'; ?></td>
                                    <td><h4 id="clock" style="margin-left: 10px;" ></h4></td>
                                </tr>
                            </table>
                            <div class="modal" id="edittime">
                              <div class="modal-dialog">
                                <div class="modal-content" style="width: 102%;">
                                <form action="{{route('edittime')}}" method="post">
                                {{ csrf_field() }}
                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">Sửa thời gian ra vào lớp</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>

                                  <!-- Modal body -->
                                  <div class="modal-body">
                                    <table border="1" style="float: left;">
                                        <tr>
                                            <th rowspan="2">Tiết: </th>
                                            <th colspan="2">Mùa hè(Bắt đầu từ 15/4)</th>
                                        </tr>
                                        <tr>
                                            <th>Giờ vào</th>
                                            <th>Giờ ra</th>
                                        </tr>
                                        <?php $tiet=1;?>
                                        @foreach($time as $timeone)
                                        @if($timeone->season == 2)
                                        <tr>
                                            <td>Tiết {{$tiet++}}: </td>
                                            <td style="display:none;"><input type="text" name="id[]" value="{{$timeone->id}}" hidden=""></td>
                                            <td><input type="time" name="time_in[]" value="{{$timeone->time_in}}"></td>
                                            <td><input type="time" name="time_out[]" value="{{$timeone->time_out}}"></td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </table>
                                    <table border="1">
                                        <tr>
                                            <th colspan="2">mùa đông(Bắt đầu từ 15/10)</th>
                                        </tr>
                                        <tr>
                                            <th>Giờ vào</th>
                                            <th>Giờ ra</th>
                                        </tr>
                                        @foreach($time as $timeone)
                                        @if($timeone->season == 1)
                                        <tr>
                                            <td style="display:none;"><input type="text" name="id[]" value="{{$timeone->id}}" hidden=""></td>
                                            <td><input type="time" name="time_in[]" value="{{$timeone->time_in}}"></td>
                                            <td><input type="time" name="time_out[]" value="{{$timeone->time_out}}"></td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </table>
                                  </div>

                                  <!-- Modal footer -->
                                  <div class="modal-footer">
                                    <button type="submit" name="luu" class="btn btn-primary">Lưu</button>
                                  </div>
                                </form>
                                </div>
                              </div>
                            </div>
                        </div>
                        <?php $tiet=1;?>
                        @foreach($time as $onetime)
                        @if($onetime->season == $key_season)
                        <p>Tiết {{$tiet++}} : <?php if($tiet<=10) echo "&nbsp"; ?> <b>{{$onetime->time_in}}</b> - <b>{{$onetime->time_out}}</b></p>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Lịch biểu</h5>
                    </div>
                    <div class="ibox-content">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Lịch</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
            <!-- Modal body -->
            <div class="modal-body">
                <b>Thời gian : </b> <span class="lich-tg"> </span><br>
                <b>Dạy : </b> <span class="lich-mh"> </span><br>
                <b>Phòng học : </b> <span class="lich-ph"> </span><br>
                <button class="btn btn-primary" data-toggle="modal" data-target="#editcalendar" onclick="sendid()">Sửa lịch</button>
            </div>
        </div>
    </div>
</div>
    <div class="modal" id="editcalendar">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Sửa Lịch Giảng Dạy</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body ">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3 class="text-center">Lịch dạy cũ </h3>
                            <hr>
                            <b>ID: </b> <span class="lich-id" id="lich-id"></span><br>
                            <b>Thời gian : </b> <span class="lich-tg"> </span><br>
                            <b>Dạy : </b> <span class="lich-mh"> </span><br>
                            <b>Phòng học : </b> <span class="lich-ph"> </span><br>
                        </div>
                        <div class="col-lg-6">
                            <form action="{{route('updatecalendar')}}" method="post">
                                @csrf
                                <h3 class="text-center">Lịch dạy mới </h3>
                                <hr>
                                <input type="text" id="setid" name="id" value="" hidden>
                                <div class="form-group">
                                    <label >Ngày: (Tháng - Ngày - Năm)</label>
                                    <input type="date" class="form-control" name="date" id="lich-ngay" value="">
                                </div>
                                <div class="form-group">
                                    <label >Chọn tiết bắt đầu :</label>
                                    <select name="tiet" class="form-control" id="lich-tiet">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label >Nhập số tiết :</label>
                                    <input type="number" name="sotiet" class="form-control" id="lich-sotiet" value="" placeholder="VD: 3">
                                </div>
                                <div class="form-group">
                                    <label >Phòng Học:</label>
                                    <input type="text" name="phonghoc" class="form-control" id="lich-phong" value="" placeholder="VD: C5 201">
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Sửa Lịch</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="js/plugins/fullcalendar/moment.min.js"></script>

    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>

    <!-- Full Calendar -->
    <script src="js/plugins/fullcalendar/fullcalendar.min.js"></script>
    <script src="js/plugins/fullcalendar/lang/lang-all.js"></script>
    <script>
        $(document).ready(function() {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

            /* initialize the external events
             -----------------------------------------------------------------*/


            $('#external-events div.external-event').each(function() {

                // store data so the calendar knows to render an event upon drop
                $(this).data('event', {
                    title: $.trim($(this).text()), // use the element's text as the event title
                    stick: true // maintain when user navigates (see docs on the renderEvent method)
                });

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1111999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

            });


            /* initialize the calendar
             -----------------------------------------------------------------*/

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                lang: 'vi',
                editable: true,
                events: [
                    @for( $i=0; $i< count($calendar) ; $i++)
                        {
                            title: '*{{$calendar[$i]['id']}}*\n Tiết {{$calendar[$i]['tiethoc']}}\n -{{$calendar[$i]['tenlophocphan']}}\n {{$calendar[$i]['phonghoc']}}',
                            @php
                                $m3=explode("-",$calendar[$i]['ngayhoc']);
                                $y= (int)$m3[0];
                                $m= (int)$m3[1]-1;
                                $d= (int)$m3[2];
                                $m3=explode(",",$calendar[$i]['tiethoc']);
                                $tiethoc=explode(",",$calendar[$i]['tiethoc']);

                                $start=explode(":",App\Http\Controllers\Admin\ScheduleController::getstar($tiethoc[0]));
                                $end=explode(":",App\Http\Controllers\Admin\ScheduleController::getend($tiethoc[count($tiethoc)-1]));
                            @endphp
                            start: new Date({{$y}},{{$m}},{{$d}},),
                            end: new Date({{$y}},{{$m}},{{$d}},)
                        },
                   @endfor
                ]
            });
        });
            function time() {
                var today = new Date();
                var h=today.getHours();
                var m=today.getMinutes();
                var s=today.getSeconds();
                m=checkTime(m);
                s=checkTime(s);
                nowTime = h+":"+m+":"+s;
                tmp='<span class="date">'+nowTime+'</span>';
                document.getElementById("clock").innerHTML=tmp;
                clocktime=setTimeout("time()","1000","JavaScript");
                function checkTime(i)
                {
                    if(i<10){
                        i="0" + i;
                    }
                    return i;
                }
            }
    $(document).ready(function(){
    time();
    });
    $(document).ready(function(){
        $(document).on('click', '.click', function () {//load document
            // var s=$(this).children(".fc-time").text();
            var s=$(this).children(".fc-time").text();
            var t=$(this).children(".fc-title").text();
            var idc= t.split("*");
            var id= idc[1];
            var p=idc[2].substr(idc[2].length-7, 7);
            var m=idc[2].substring(0,idc[2].length-7);
            $(".lich-id").text(id);
            $(".lich-tg").text(s);
            $(".lich-mh").text(m);
            $(".lich-ph").text(p);
        });
    });

    function sendid() {
        document.getElementById("setid").value = document.getElementById('lich-id').innerHTML;
    }
    </script>
@endsection

