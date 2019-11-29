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
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-content">
                        <h3>Thời gian ra vào lớp</h3>
                        <h4 id="clock"></h4>
                        <p>Tiết 1 :</p>
                        <p>Tiết 2 </p>
                        <p>Tiết 3 </p>
                        <p>Tiết 4 </p>
                        <p>Tiết 5</p>
                        <p>Tiết 6 </p>
                        <p>Tiết 7 </p>
                        <p>Tiết 8 </p>
                        <p>Tiết 9 </p>
                        <p>Tiết 10 </p>
                        <p>Tiết 11 </p>
                        <p>Tiết 12 </p>
                        <p>Tiết 13 </p>
                        <p>Tiết 14 </p>
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
                            title: 'Tiết {{$calendar[$i]['tiethoc']}}\n{{$calendar[$i]['tenlophocphan']}}\n{{$calendar[$i]['phonghoc']}}',
                            <?php
                                $m3=explode("-",$calendar[$i]['ngayhoc']);
                                $y= (int)$m3[0];
                                $m= (int)$m3[1]-1;
                                $d= (int)$m3[2];
                                $m3=explode(",",$calendar[$i]['tiethoc']);
                                $tiethoc=explode(",",$calendar[$i]['tiethoc']);
                                $start=explode(":",App\Http\Controllers\Admin\ScheduleController::getstar($tiethoc[0]));
                                $end=explode(":",App\Http\Controllers\Admin\ScheduleController::getend($tiethoc[count($tiethoc)-1]));
                            ?>
                            start: new Date({{$y}},{{$m}},{{$d}},{{$start[0]}},{{$start[1]}}),
                            end: new Date({{$y}},{{$m}},{{$d}},{{$end[0]}},{{$end[1]}})
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

