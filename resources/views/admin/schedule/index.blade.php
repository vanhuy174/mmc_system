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
                {{-- <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Draggable Events</h5>
                    </div>
                    <div class="ibox-content">
                        <div id='external-events'>
                            <p>Drag a event and drop into callendar.</p>
                            <div class='external-event navy-bg'>Go to shop and buy some products.</div>
                            <div class='external-event navy-bg'>Check the new CI from Corporation.</div>
                            <div class='external-event navy-bg'>Send documents to John.</div>
                            <div class='external-event navy-bg'>Phone to Sandra.</div>
                            <div class='external-event navy-bg'>Chat with Michael.</div>
                            <p class="m-t">
                                <input type='checkbox' id='drop-remove' class="i-checks" checked /> <label for='drop-remove'>remove after drop</label>
                            </p>
                        </div>
                    </div>
                </div> --}}


{{--                <div class="ibox ">--}}
{{--                    <div class="ibox-title">--}}
{{--                        <h5>Draggable Events</h5>--}}
{{--                    </div>--}}
{{--                    <div class="ibox-content">--}}
{{--                        <div id='external-events'>--}}
{{--                            <p>Drag a event and drop into callendar.</p>--}}
{{--                            <div class='external-event navy-bg'>Go to shop and buy some products.</div>--}}
{{--                            <div class='external-event navy-bg'>Check the new CI from Corporation.</div>--}}
{{--                            <div class='external-event navy-bg'>Send documents to John.</div>--}}
{{--                            <div class='external-event navy-bg'>Phone to Sandra.</div>--}}
{{--                            <div class='external-event navy-bg'>Chat with Michael.</div>--}}
{{--                            <p class="m-t">--}}
{{--                                <input type='checkbox' id='drop-remove' class="i-checks" checked /> <label for='drop-remove'>remove after drop</label>--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <button id="acceptOffer">12</button>--}}
{{--                <button id="declineOffer">1234</button>--}}

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
            {{--$("#acceptOffer").click(function () {--}}
            {{--    alert('1111');--}}
            {{--    $("#form").attr("action", "{{route('schedule.create')}}").submit();;--}}
            {{--});--}}

            {{--$("#declineOffer").click(function () {--}}
            {{--    alert('2222');--}}
            {{--    $("#form").attr("action", "{{route('schedule.show',['id'=>1])}}").submit();;--}}
            {{--});--}}

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
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            console.log(date,d,y,m);
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                lang: 'vi',
                events: [
                    <?php for( $i=0; $i< count($calendar) ; $i++){?>
                        {
                            title: 'Tiết {{$calendar[$i]['tiethoc']}}{{$calendar[$i]['tenlophocphan']}}',
                            <?php 
                                $m3=explode("-",$calendar[$i]['ngayhoc']);
                                $y= (int)$m3[0];
                                $m= (int)$m3[1]-1;
                                $d= (int)$m3[2];

                                $m3=explode(",",$calendar[$i]['tiethoc']);
                                
                            ?>  
                            start: new Date({{$y}},{{$m}},{{$d}})
                        },
                    <?php } ?> 
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

    </script>
@endsection

