<!DOCTYPE html>
<html>

<head>
    <base href="{{asset('layout/backend')}}/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MMC</title>

    @yield('linkstyle')

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    @yield('css')
</head>


<body>

<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        {{-- <img alt="image" class="rounded-circle" src="img/profile_small.jpg"/> --}}
                        <img alt="image" class="img-circle" width="50px" height="50px" style="object-fit: cover;" src="/IMG/{{Auth::user()->mmc_avatar}}">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            {{-- <span class="block m-t-xs font-bold">Bon Bon</span>
                            <span class="text-muted text-xs block">Giảng Viên<b class="caret"></b></span> --}}
                            <span class="block m-t-xs font-bold">{{Auth::user()->mmc_name}}</span>
                            <span class="text-muted text-xs block">{{Auth::user()->mmc_position}}<b class="caret"></b></span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="dropdown-item" href="{{route('get-thong-tin-ca-nhan',Auth::user()->id)}}">Thông tin cá nhân</a></li>
                            <li><a class="dropdown-item" href="mailbox.html">Thông báo</a></li>
                            <li class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout')}}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        MMC+
                    </div>
                </li>
                @if(Auth::user()->mmc_level==1)
                    <li>
                        <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Admin</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="{{route('department.index')}}">Quản lý bộ môn</a></li>
                            <li><a href="{{route('major.index')}}">Quản lý ngành</a></li>
                            <li><a href="{{route('educationprogram.index')}}">Quản lý CTĐT</a></li>
                            <li><a href="{{route('class.index')}}">Quản lý lớp học</a></li>
                            <li><a href="{{route('danh-sach-giang-vien')}}">Quản lý giảng viên</a></li>
                            <li><a href="{{route('homeStudent')}}">Quản lý sinh viên</a></li>
                            <li><a href="{{route('subject.index')}}">Quản lý môn học</a></li>
                            <li><a href="{{route('homeCalendar')}}">Quản lý lịch giảng dạy</a></li>
                        </ul>
                    </li>
                @endif
                <li>
                    <a href="{{route('schedule.index')}}"><i class="fa fa-calendar"></i> <span class="nav-label">Lịch giảng dạy</span>  </a>
                </li>
                <li>
                    <a href="{{route('oneclass.index')}}"><i class="fa fa-users"></i> <span class="nav-label">Lớp chủ nhiệm</span>  </a>
                </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i>
                            {{ __('Logout') }}
                        </a>

                        {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form> --}}
                    </li>
                </ul>

            </nav>
        </div>
        @yield('content')
        <div class="footer">
            <div class="float-right">
               Free
            </div>
        </div>
    </div>
</div>



<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- script -->
<script src="../../js/alert_flash.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>
<script src="js/plugins/fullcalendar/moment.min.js"></script>

<script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- iCheck -->
<script src="js/plugins/iCheck/icheck.min.js"></script>

<!-- Full Calendar -->
<script src="js/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="js/plugins/fullcalendar/lang/lang-all.js"></script>
@yield('scripts')
<script>
    $(document).ready(function(){
        setTimeout(function(){
            $(".error").hide("2000")}, 3000);
    });

$(function($) {
    var url = window.location.href;
    $('li a').each(function() {
        if (this.href === url) {
            $(this.parentNode).addClass('active');
            $(this.parentNode.parentNode).addClass('in');
        }
    });
});
</script>

{{-- hiện thị ảnh --}}
<script src="js/img.js"></script>
{{-- hiện thị --}}
<script src="js/input.js"></script>

</body>

</html>




