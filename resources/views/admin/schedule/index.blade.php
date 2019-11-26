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
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-content">
                        <h3>Thời gian ra vào lớp</h3>
                        <h4 id="clock"></h4>
                        <form method="get" id="form">
                            <select name="tiethoc">
                                <option value="1">T1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </form>
                    </div>
                </div>
<<<<<<< HEAD
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
=======
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
>>>>>>> tvduong
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

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                lang: 'vi',
                events: [
                    {
                        title: 'Tiết 1 2 3 4 5',
                        start: new Date(y, m, d,7,30),
                        end: new Date(y, m, d,11,45)
                    },
                    {
                        title: 'Tiết 6 7 8 9 10',
                        start: new Date(y, m, d+2),
                        end: new Date(y, m, d+2)
                    }
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

