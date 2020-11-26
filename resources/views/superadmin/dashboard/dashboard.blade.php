@extends('superadmin.templates.superadmin_main')

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
                                    <h4 class="mt-0 mb-1 font-20">{{$data["user"]}}</h4>
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
                                    <h4 class="mt-0 mb-1 font-20">{{$data["wa"]}}</h4>
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
                                    <h4 class="mt-0 mb-1 font-20">Rp.{{$data["pemasukan"]}}</h4>
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
                        <h5 class="mt-0">Pendaftar Tiap Hari</h5>
                        <div class="row">
                            <div class="col-lg col-xl border-right">
                                <div class="card shadow-none mb-0">
                                    <div class="card-body">
                                        <div id="morris-line-chart" class="morris-chart overview-chart"></div>
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