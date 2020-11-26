@extends('under_construction.templates.superadmin_main')

@section('title', "Billing")

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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Billing</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Billing</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Whatsapp</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Masa Aktif</th>
                                        <th>Pengguna</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($billing as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->number}}</td>
                                        <td>{{$data->awal}}</td>
                                        <td>{{$data->masa_aktif}}</td>
                                        <td>{{$data->name}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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