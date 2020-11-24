@extends('under_construction.templates.superadmin_main')

@section('title', "Dashboard")

@section('page')
<!-- Page Content-->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Super Admin</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mt-0">Pendaftar Perhari</h5>
                        <div class="row">
                            <div class="col-lg-9 col-xl-9 border-right">
                                <div class="card shadow-none mb-0">
                                    <div class="card-body">
                                        <div id="morris-line-chart" class="morris-chart overview-chart"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-3 col-xl-3">
                                <div class="card mb-0 overview shadow-none">
                                    <div class="card-body border-bottom">
                                        <div class="">
                                            <div class="row align-items-center">
                                                <div class="col-2">
                                                    <div class="overview-content"><i class="mdi mdi-account-multiple text-success"></i></div>
                                                </div>
                                                <div class="col-10 text-right">
                                                    <p class="text-muted font-13 mb-0">Jumlah Pengguna</p>
                                                    <h4 class="mb-0 font-20">999.999</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body border-bottom">
                                        <div class="">
                                            <div class="row align-items-center">
                                                <div class="col-2">
                                                    <div class="overview-content"><i class="mdi mdi-whatsapp text-purple"></i></div>
                                                </div>
                                                <div class="col-10 text-right">
                                                    <p class="text-muted font-13 mb-0">Jumlah Whatsapp</p>
                                                    <h4 class="mb-0 font-20">999.999</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body border-bottom">
                                        <div class="">
                                            <div class="row align-items-center">
                                                <div class="col-2">
                                                    <div class="overview-content"><i class="mdi mdi-cash-multiple text-warning"></i></div>
                                                </div>
                                                <div class="col-10 text-right">
                                                    <p class="text-muted font-13 mb-0">Jumlah Pemasukan</p>
                                                    <h4 class="mb-0 font-20">Rp. 999.999.999</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->

    </div>
    <!-- container -->
    <footer class="footer text-center text-sm-left">
        &copy; <script>
            document.write(new Date().getFullYear());
        </script> Ping Notif <span class="text-muted d-none d-sm-inline-block float-right">Crafted with <i class="mdi mdi-heart text-danger"></i> by PingNotif</span>
    </footer>
</div>
<!-- end page content -->
</div>
@endsection