<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>AMS | AIM Inc</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="{{ csrf_token() }}" name="_token" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        @yield('moreCss') 

        <!-- App css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
        <style>
            .st-table{
                font-size: 11px;
                border-collapse: collapse;
                border-spacing: 0; width: 100%;
            }

            .st-header-table{
                background-color: #34708a;
                color: white
            }

        </style>

    </head>


    <body>
        {{-- @if (!(auth()->user()->type)) onmousemove="BaseModel.checkControl()" @endif --}}
        <!-- Loader -->
        @include('layout.preloader')

        <div class="header-bg">
            <!-- Navigation Bar-->
            <header id="topnav">
                <div class="topbar-main">
                    <div class="container-fluid">

                        <!-- Logo-->
                        <div>
                            
                            <a href="#" class="logo">
                                <img src="{{ asset('assets/images/landed-icon-white.png') }}" alt="" height="35"> 
                            </a>

                        </div>
                        <!-- End Logo-->

                        <div class="menu-extras topbar-custom navbar p-0">

                            <ul class="list-inline ml-auto mb-0">
                                
                                <!-- User-->
                                <li class="list-inline-item dropdown notification-list nav-user">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="false" aria-expanded="false">
                                        <img src="{{ asset('assets/images/avatar.png') }}" alt="user" class="rounded-circle">
                                        <span class="d-none d-md-inline-block ml-1">{{ auth()->user()->name ?? '' }} <i class="mdi mdi-chevron-down"></i> </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                                        <div class="dropdown-divider"></div>
                                        <a style="cursor: pointer;" class="dropdown-item text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="dripicons-exit text-muted"></i> Logout</a>
                                    </div>
                                </li>
                                <li class="menu-item list-inline-item">
                                    <!-- Mobile menu toggle-->
                                    <a class="navbar-toggle nav-link">
                                        <div class="lines">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </a>
                                    <!-- End mobile menu toggle-->
                                </li>

                            </ul>

                        </div>
                        <!-- end menu-extras -->

                        <div class="clearfix"></div>

                    </div> <!-- end container -->
                </div>
                <!-- end topbar-main -->

                <!-- MENU Start -->
                <div class="navbar-custom">
                    <div class="container-fluid">
                        <div id="navigation">
                            <!-- Navigation Menu-->
                            <ul class="navigation-menu">

                                <li class="has-submenu">
                                    <a href="{{ route('authorize.index') }}"><i class="dripicons-graph-pie"></i> Main</a>
                                </li>
                                <li class="has-submenu">
                                    <a href="#"><i class="dripicons-view-thumb"></i> Assets <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('authorize.asset') }}"><i class="fas fa-ethernet mr-2"></i> Assets</a></li>
                                        <li><a href="{{ route('authorize.asset.pullout') }}"><i class="fas fa-network-wired mr-2"></i> Pullout Asset</a></li>
                                    </ul>
                                </li>
                                <li class="has-submenu">
                                    <a href="{{ route('authorize.user') }}"><i class="fas fa-user-shield"></i> Employee</a>
                                </li>
                                <li class="has-submenu">
                                    <a href="#"><i class="dripicons-gear" style="color: #2a58a7;"></i> Configure<i class="mdi mdi-chevron-down mdi-drop"></i></a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('authorize.department') }}"><i class="fas fa-ethernet mr-2"></i> Department</a></li>
                                        <li><a href="{{ route('authorize.category') }}"><i class="fas fa-network-wired mr-2"></i> Category</a></li>
                                        <li><a href="{{ route('authorize.sub.category') }}"><i class="fas fa-network-wired mr-2"></i> Sub Category</a></li>
                                        {{-- <li><a href=""><i class="dripicons-arrow-thin-right mr-2" style="font-size:10px"></i>Types</a></li> --}}
                                    </ul>
                                </li>
                                <li class="has-submenu">
                                    <a class="text-danger" style="cursor:pointer"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="dripicons-exit"></i>Sign out</a>
                                    <form id="logout-form" action="{{ route('authorize.signout') }}" method="POST" class="d-none">@csrf</form>
                                </li>

                            </ul>
                            <!-- End navigation menu -->
                        </div> <!-- end #navigation -->
                    </div> <!-- end container -->
                </div> <!-- end navbar-custom -->
            </header>
            <!-- End Navigation Bar-->

        </div>
        <!-- header-bg -->

        <div class="wrapper">
            <div class="alert p-1" style="font-size: 11px; background:#bbdaee" role="alert">
                <div class="container-fluid"><span class="ml-2"><b>Public beta testing</b> - <span class="text-dark">The product is publicly released to the general public via channels</span></span></div>
            </div>
            <div class="container-fluid">
                @yield('content')
            </div> <!-- end container-fluid -->
        </div>
        <!-- end wrapper -->


        <!-- Footer -->
            @include('layout.footer')
        <!-- End Footer -->


        <!-- jQuery  -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
        <script src="{{ asset('assets/js/waves.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('plugins/jquery-number/jquery.number.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('assets/js/global.js') }}"></script>
        @yield('moreJs')
        
        <!-- App js -->
        <script src="{{ asset('assets/js/app.js') }}"></script>
    </body>
</html>