<!DOCTYPE html>
    <html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{@$title}} | Pingnotif</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta content="pingnotif for whatsapp Broadcast" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="pingnotif" name="technogis">
    <!-- App favicon -->
    <link rel="pingnotif icon" href="{{asset('images/logo.ico')}}">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{asset('plugins/morris/morris.css')}}">
    <link href="{{asset('plugins/metro/MetroJs.min.css')}}" rel="stylesheet">
        <link href="{{asset('plugins/dropify/css/dropify.min.css')}}" rel="stylesheet">
       
    <!-- App css -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/jquery.min.js')}}"></script>
     <script src="{{asset('plugins/dropify/js/dropify.min.js')}}"></script>
</head>
<body>
     <style type="text/css">
      
        .superadmin {
    background: #fff;
    padding: 5px;
}
    </style>
    <!-- Top Bar Start -->
   <!--  {!!request()->aktifasi['alert']!!} -->
    <div class="topbar">
        <!-- LOGO -->
        <div class="topbar-left">
            <a href="/" class="logo">
               
                <span>
                    <img src="{{asset('images/logo.png')}}" alt="logo-large" class="logo-lg">
                    <img src="{{asset('images/logo-wht.png')}}" alt="logo-small" class="logo-sm">
                </span>
            </a>
        </div>
        <!-- Navbar -->
        <nav class="navbar-custom">
            <!-- Search input -->
            <!-- <div class="search-wrap" id="search-wrap">
                <div class="search-bar">
                    <input class="search-input" type="search" placeholder="Search here..">
                    <a href="javascript:void(0);" class="close-search search-btn" data-target="#search-wrap">
                        <i class="mdi mdi-close-circle"></i>
                    </a>
                </div>
            </div> -->
            <ul class="list-unstyled topbar-nav float-right mb-0">
                <li class="dropdown notif">
                    <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            
                            <i class="mdi mdi-bell-outline nav-icon"></i> 
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                            <h6 class="dropdown-item-text">Notifikasi</h6>
                           
                        </div>
                </li>
               
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{asset('images/default.jpeg')}}" alt="profile-user" class="rounded-circle"> 
                        <span class="ml-1 nav-user-name hidden-sm">{{ Auth::user()->name }}<i class="mdi mdi-chevron-down"></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{route('profile')}}"><i class="dripicons-user text-muted mr-2"></i> Profil</a>
                        <!-- <a class="dropdown-item" href="#"><i class="mdi mdi-account-convert text-muted mr-2"></i> Affiliasi</a>  -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                        <i class="dripicons-exit text-muted mr-2"></i> Keluar</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
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
                
                <li>
                    <a href="/dashboard"><i class="mdi mdi-speedometer"></i><span>Dashboard</span></a>
                </li>
                <li>
                    <a href="/whatsapp"><i class="fa fa-whatsapp"></i><span>Whatsapp</span></a>
                </li> 
                <li>
                    <a href="/pesan-otomatis"><i class="mdi mdi-alarm-plus"></i><span>Pesan Otomatis</span></a>
                </li>

                <li>
                    <a href="/dokumentasi-api"><i class="fa fa-book"></i><span>Dokumentasi API</span></a>
                </li>
                 <li>
                    <a href="/billing"><i class="mdi mdi-clock-fast"></i><span>Billing</span></a>
                </li>
                @if(Auth::user()->status_dev=='superadmin')
                <li>
                    <a href="{{route('super_admin')}}"><i class="mdi mdi-clock-fast"></i><span>SuperAdmin</span></a>
                </li>
                <li>
                   <a> <div class="superadmin">Menu super admin hanya bisa tampil dan di akses oleh super admin saja </div></a>
                </li>
                @endif
            </ul>
        </div>

        <!-- end left-sidenav-->

        <!-- Page Content-->
        <div class="page-content">
            <div class="container-fluid" style="margin-top:30px; ">

               <!--  <div class="bg_wa"></div> -->
                @yield('content')
            </div>
        </div>
        <!-- container -->
        <footer class="footer text-center text-sm-left">&copy;  Pingnotif 
            <span class="text-muted d-none d-sm-inline-block float-right">Crafted with
             <i class="mdi mdi-heart text-danger"></i> by Technogis
            </span>
        </footer>
    </div>
    <!-- end page content -->
</div>

<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/metisMenu.min.js')}}"></script>
<script src="{{asset('js/waves.min.js')}}"></script>
<script src="{{asset('js/jquery.slimscroll.min.js')}}"></script>
<!--Plugins-->
<script src="{{asset('plugins/morris/morris.min.js')}}"></script>
<script src="{{asset('pages/jquery.dashboard.init.js')}}"></script>
<script src="{{asset('js/menu.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(e)
    {

            const Form_notifikasi     = new FormData();
            Form_notifikasi.append('_token', '{{csrf_token()}}');
            fetch('{{route('notifikasi')}}', { method: 'POST',body:Form_notifikasi}).then(res => res.json()).then(data => 
            {
                if(data.jmlNotif!=0)
                {
                    $('.notif .waves-effect').append(`<span class="badge badge-danger badge-pill noti-icon-badge">`+data.jmlNotif+`</span>`);
                    var list_not='';
                    $.each(data.notif_tagihan,function(y,p)
                    {
                        var keterangan=p.status_akses=='kredit'?'Perpanjangan masa aktif untuk nomor wa '+p.number:'Penambahan saldo baru';
                        list_not +=` <div class="slimscroll notification-list">
                                <a href="{{url('billing')}}" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-warning">
                                        <i class="dripicons-warning"></i>
                                    </div>
                                    <p class="notify-details">`+p.id_invoice+`<small class="text-muted">`+keterangan+`</small></p>
                                </a>
                            </div>`;
                    });
                    $('.notif .dropdown-menu-right').append(list_not);
                }

            });
    })
</script>

</body>
</html>