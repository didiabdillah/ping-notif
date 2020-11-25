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

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 align-self-center">
                                <div class="icon-info">
                                    <i class="mdi mdi-account-multiple text-success"></i>
                                </div>
                            </div>
                            <div class="col-8 align-self-center text-center">
                                <div class="ml-2 text-right">
                                    <p class="mb-1 text-muted font-size-13">Pengguna</p>
                                    <h4 class="mt-0 mb-1 font-20">999.999.999</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 align-self-center">
                                <div class="icon-info">
                                    <i class="mdi mdi-whatsapp text-primary"></i>
                                </div>
                            </div>
                            <div class="col-8 align-self-center text-center">
                                <div class="ml-2 text-right">
                                    <p class="mb-1 text-muted font-size-13">Whatsapp</p>
                                    <h4 class="mt-0 mb-1 font-20">999.999.999</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 align-self-center">
                                <div class="icon-info">
                                    <i class="mdi mdi-cash-multiple text-warning"></i>
                                </div>
                            </div>
                            <div class="col-8 align-self-center text-center">
                                <div class="ml-2 text-right">
                                    <p class="mb-1 text-muted font-size-13">Pemasukan</p>
                                    <h4 class="mt-0 mb-1 font-20">Rp. 999.999.999</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Pendaftar Tiap Hari</h5>
                        <div class="row justify-content-end">
                            <div class="col-xl-12 align-self-center">
                                <ul class="list-unstyled list-inline float-right">
                                    <li class="list-inline-item px-3">
                                        <h5 class="mt-0">999.999.999</h5>
                                        <small class="font-size-14 text-muted">Total Pendaftar</small>
                                    </li>
                                    <li class="list-inline-item px-3">
                                        <h5 class="mb-2">999.999.999</h5>
                                        <small class="font-size-14 text-muted">Pendaftar Hari Ini</small>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="extra-area-chart" class="morris-charts project-budget-chart" style="height: 322px;" dir="ltr"></div>
                        <ul class="list-unstyled text-center text-muted mb-0 mt-2">
                            <li class="list-inline-item font-size-13"><i class="mdi mdi-album font-size-16 text-primary mr-2"></i>Total Budget</li>
                            <li class="list-inline-item font-size-13"><i class="mdi mdi-album font-size-16 text-success mr-2"></i>Amount Used</li>
                            <li class="list-inline-item font-size-13"><i class="mdi mdi-album font-size-16 text-secondary mr-2"></i>Target Amount</li>
                        </ul>
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