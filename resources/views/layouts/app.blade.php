<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Checkin System">
    <meta name="author" content="HungJiuChong">
    <meta name="keywords" content="Checkin System">

    <!-- Title Page-->
    <title>Checkin System | Welcome</title>

    <!-- Fontfaces CSS-->
    <link href="{{asset('css/font-face.css')}}" rel="stylesheet" media="all">

    <link href="{{asset('vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{asset('vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('css/theme.css')}}" rel="stylesheet" media="all">
    @yield('header_style')

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop3 d-none d-lg-block">
            <div class="section__content section__content--p35">
                <div class="header3-wrap">
                    <div class="header__logo">
                        <a href="#">
                            <h3 style="color: #eee;">Checkin System</h3>
                        </a>
                    </div>
                    <div class="header__navbar">
                        <ul class="list-unstyled">
                            <li >
                                <a href="/home">
                                    <i class="fas fa-home"></i>Home
                                    <span class="bot-line"></span>
                                </a>
                                
                            </li>

                        @if(Auth::user()->role == "EventManager" || Auth::user()->role == "SystemManager")
                            <li class="has-sub">
                                    <a href="#" >
                                        <i class="fas fa-tasks"></i>Event Manager
                                    </a>
                                    <ul class="header3-sub-list list-unstyled">
                                         <li>
                                            <a href="/upcomingEvents">Upcoming Events </a>
                                        </li>
                                        <li>
                                            <a href="/userlist">User List </a>
                                        </li>
                                    </ul>
                            </li>
                        @endif
                        @if(Auth::user()->role == "DoorWorker" || Auth::user()->role == "SystemManager")
                            <li>
                                <a href="/doorworker">
                                    <i class="fas fa-calendar"></i>
                                    <span class="bot-line"></span>Door Worker</a>
                            </li>
                        @endif
                            <li>
                                <a href="/statistics">
                                    <i class="fas fa-briefcase"></i>
                                    <span class="bot-line"></span>Statistics</a>
                            </li>
                        @if(Auth::user()->role == "SystemManager")
                            <li class="has-sub">
                                <a href="#">
                                    <i class="fas fa-cog"></i>System Manager
                                    <span class="bot-line"></span>
                                </a>
                                <ul class="header3-sub-list list-unstyled">
                                    <li>
                                        <a href="/location">Location </a>
                                    </li>
                                     <li>
                                        <a href="/organization">Organization </a>
                                    </li>
                                     <li>
                                        <a href="/user">User </a>
                                    </li>
                                </ul>
                            </li>
                           
                        @endif
                        </ul>
                    </div>
                    <div class="header__tool">
                        @guest
                            <div class="header-button-item">
                                <a href="login" style="color: #ccc;">
                                    <i class="fas fa-user"></i>
                                </a>
                            </div>
                            <div class="header-button-item">
                                <a href="register" style="color: #ccc;"     >
                                    <i class="fas fa-users"></i>
                                </a>
                            </div>
                        @else
                            <div class="account-wrap">
                                <div class="account-item account-item--style2 clearfix js-item-menu">
                                    <div class="image">
                                        <img src="{{asset('images/icon/avatar-01.jpg')}}" alt="" />
                                    </div>
                                    <div class="content">
                                        <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                                    </div>
                                    <div class="account-dropdown js-dropdown">
                                        <div class="info clearfix">
                                            <div class="image">
                                                <a href="#">
                                                    <img src="{{asset('images/icon/avatar-01.jpg')}}"  />
                                                </a>
                                            </div>
                                            <div class="content">
                                                <h5 class="name">
                                                    <a href="#">{{ Auth::user()->name }}</a>
                                                </h5>
                                                <span class="email">{{ Auth::user()->email }}</span>
                                            </div>
                                        </div>

                                        <div class="account-dropdown__footer">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                <i class="zmdi zmdi-power"></i>{{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER DESKTOP-->

        <!-- HEADER MOBILE-->
        <header class="header-mobile header-mobile-2 d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <h3 style="color: #eee;">Checkin System</h3>
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="">
                            <a  href="#">
                                <i class="fas fa-home"></i>Home</a>
                        </li>
                        @if(Auth::user()->role == "EventManager" || Auth::user()->role == "SystemManager")
                        <li class="">
                            <a href="/upcomingEvents">
                                <i class="fas fa-tasks"></i>Event Manager</a>
                            
                        </li>
                        @endif
                        @if(Auth::user()->role == "EventManager" || Auth::user()->role == "SystemManager")
                            <li class="has-sub">
                                    <a href="#" class="js-arrow">
                                        <i class="fas fa-tasks"></i>Event Manager
                                    </a>
                                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                         <li>
                                            <a href="/upcomingEvents">Event Manager </a>
                                        </li>
                                        <li>
                                            <a href="/userlist">User List </a>
                                        </li>
                                    </ul>
                            </li>
                        @endif
                        @if(Auth::user()->role == "DoorWorker" || Auth::user()->role == "SystemManager")
                        <li>
                            <a href="/doorworker">
                                <i class="fas fa-calendar"></i>Door Worker</a>
                        </li>
                        @endif
                        <li>
                            <a href="/statistics">
                                <i class="fas fa-briefcase"></i>Statistics</a>
                        </li>
                        @if(Auth::user()->role == "SystemManager")
                        <li class="has-sub">
                                <a href="#" class="js-arrow">
                                    <i class="fas fa-cog"></i>System Manager
                                </a>
                                <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                    <li>
                                        <a href="/location">Location </a>
                                    </li>
                                     <li>
                                        <a href="/organization">Organization </a>
                                    </li>
                                     <li>
                                        <a href="/user">User </a>
                                    </li>
                                </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </header>
        <div class="sub-header-mobile-2 d-block d-lg-none">
            <div class="header__tool">
                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                        <div class="image">
                            <img src="{{asset('images/icon/avatar-01.jpg')}}" alt="" />
                        </div>
                        <div class="content">
                            <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                        </div>
                        <div class="account-dropdown js-dropdown">
                            <div class="info clearfix">
                                <div class="image">
                                    <a href="#">
                                        <img src="{{asset('images/icon/avatar-01.jpg')}}" alt="John Doe" />
                                    </a>
                                </div>
                                <div class="content">
                                    <h5 class="name">
                                        <a href="#">{{ Auth::user()->name }}</a>
                                    </h5>
                                    <span class="email">{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                            <div class="account-dropdown__footer">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i class="zmdi zmdi-power"></i>{{ __('Logout') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END HEADER MOBILE -->

        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
            <!-- BREADCRUMB-->
            <section class="au-breadcrumb2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="au-breadcrumb-content">
                                <div class="au-breadcrumb-left">
                                    <span class="au-breadcrumb-span">You are here:</span>
                                    <ul class="list-unstyled list-inline au-breadcrumb__list">
                                        <li class="list-inline-item active">
                                            <a href="#">Home</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item">Welcome</li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

            @yield('content')
            <!-- COPYRIGHT-->
            <section class="p-t-60 p-b-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2019 HungJiuChong.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END COPYRIGHT-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{asset('vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset('vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{asset('vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{asset('vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{asset('vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{asset('vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/select2/select2.min.js')}}">
    </script>

    <!-- Main JS-->
    <script src="{{asset('js/main.js')}}"></script>
    @yield('footer_script')
</body>

</html>
<!-- end document-->
