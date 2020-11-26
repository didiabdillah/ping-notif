<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta content="A premium admin dashboard template by themesbrand" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{URL::asset('images/logo.ico')}}" />
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/morris/morris.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/chartist/css/chartist.min.css')}}" />
    <link href="{{URL::asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/css/metismenu.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />
</head>

<body>

    <!-- Top Bar Start -->
    <div class="topbar">
        <!-- LOGO -->
        <div class="topbar-left" style="background-color: #0cce80">
            <a href="index.html" class="logo">
                <span></span><span><img src="{{URL::asset('images/logo.png')}}" alt="logo-large" class="logo-lg" style="height: 50px;" /></span>
            </a>
        </div>
        <!-- Navbar -->
        <nav class="navbar-custom" style="background-color: #fff">
            <!-- Search input -->
            <div class="search-wrap" id="search-wrap">
                <div class="search-bar">
                    <input class="search-input" type="search" placeholder="Search here.." /> <a href="javascript:void(0);" class="close-search search-btn" data-target="#search-wrap"><i class="mdi mdi-close-circle"></i></a>
                </div>
            </div>
            <ul class="list-unstyled topbar-nav float-right mb-0">
                <li>
                    <a class="nav-link waves-effect waves-light search-btn" href="javascript:void(0);" data-target="#search-wrap"><i class="mdi mdi-magnify nav-icon"></i></a>
                </li>
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="mdi mdi-bell-outline nav-icon"></i> <span class="badge badge-danger badge-pill noti-icon-badge">999+</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                        <!-- item-->
                        <h6 class="dropdown-item-text">Notifications (999+)</h6>
                        <div class="slimscroll notification-list">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                <p class="notify-details">Your order is placed<small class="text-muted">Dummy text of the printing and typesetting industry.</small></p>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-warning"><i class="mdi mdi-message"></i></div>
                                <p class="notify-details">New Message received<small class="text-muted">You have 87 unread messages</small></p>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-info"><i class="mdi mdi-glass-cocktail"></i></div>
                                <p class="notify-details">Your item is shipped<small class="text-muted">It is a long established fact that a reader will</small></p>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-primary"><i class="mdi mdi-cart-outline"></i></div>
                                <p class="notify-details">Your order is placed<small class="text-muted">Dummy text of the printing and typesetting industry.</small></p>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-danger"><i class="mdi mdi-message"></i></div>
                                <p class="notify-details">New Message received<small class="text-muted">You have 87 unread messages</small></p>
                            </a>
                        </div>
                        <!-- All-->
                        <a href="javascript:void(0);" class="dropdown-item text-center text-primary">View all <i class="fi-arrow-right"></i></a>
                    </div>
                </li>
                <li class="hidden-sm">
                    <a class="nav-link waves-effect waves-light" href="javascript:void(0);" id="btn-fullscreen"><i class="mdi mdi-fullscreen nav-icon"></i></a>
                </li>
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{URL::asset('assets/images/users/user-1.jpg')}}" alt="profile-user" class="rounded-circle" /> <span class="ml-1 nav-user-name hidden-sm">{{Session::get('name')}} <i class="mdi mdi-chevron-down"></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{route('superadmin_setting')}}"><i class="dripicons-gear text-muted mr-2"></i> Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('superadmin_logout')}}"><i class="dripicons-exit text-muted mr-2"></i> Logout</a>
                    </div>
                </li>
            </ul>
            <ul class="list-unstyled topbar-nav mb-0">
                <li>
                    <button class="button-menu-mobile nav-link waves-effect waves-light"><i class="mdi mdi-menu nav-icon"></i></button>
                </li>
            </ul>
        </nav>
        <!-- end navbar-->
    </div>
    <!-- Top Bar End -->
    <div class="page-wrapper">
        <!-- Left Sidenav -->
        <div class="left-sidenav">
            <ul class="metismenu left-sidenav-menu" id="side-nav">
                <li class="menu-title">Admin</li>
                <li class="">
                    <a href="{{route('superadmin_dashboard')}}"><i class="mdi mdi-speedometer"></i><span>Dashboard</span></a>
                </li>
                <li>
                    <a href="{{url('/test/pengguna')}}"><i class="mdi mdi-account-multiple"></i><span>Pengguna</span><span class="badge badge-primary badge-pill float-right">999+</span></a>
                </li>
                <li>
                    <a href="calendar.html"><i class="mdi mdi-wechat"></i><span>Tiket</span><span class="badge badge-danger badge-pill float-right">999+</span></a>
                </li>
                <li>
                    <a href="calendar.html"><i class="mdi mdi-file-document"></i><span>Docs API</span></a>
                </li>
                <li>
                    <a href="{{route('superadmin_billing')}}"><i class="mdi mdi-timer"></i><span>Billing</span></a>
                </li>
            </ul>
        </div>
        <!-- end left-sidenav-->

        @yield('page')

        <!-- end page-wrapper -->
        <!-- jQuery  -->
        <script src="{{URL::asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{URL::asset('assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{URL::asset('assets/js/metisMenu.min.js')}}"></script>
        <script src="{{URL::asset('assets/js/waves.min.js')}}"></script>
        <script src="{{URL::asset('assets/js/jquery.slimscroll.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/chartist/js/chartist.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/chartist/js/chartist-plugin-tooltip.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/morris/morris.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/raphael/raphael-min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/peity-chart/jquery.peity.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
        <!-- <script src="{{URL::asset('assets/pages/jquery.dashboard2.init.js')}}"></script> -->
        <!-- Datatable init js -->
        <script src="{{URL::asset('assets/js/datatables.init.js')}}"></script>
        <!-- App js -->
        <script src="{{URL::asset('assets/js/app.js')}}"></script>

        <script>
            $.ajax({
                dataType: "json",
                url: "{{route('superadmin_grafik')}}",
                success: function(data) {
                    const graf = data;
                    var line = new Morris.Line({
                            element: "morris-line-chart",
                            resize: !0,
                            data: graf,
                            xkey: "tanggal",
                            ykeys: ["jumlah_harian"],
                            labels: ["Pendaftar"],
                            gridLineColor: "#eef0f2",
                            lineColors: ["#44a2d2"],
                            lineWidth: 2,
                            hideHover: "auto"
                        }

                    )
                }
            });
        </script>
</body>

</html>