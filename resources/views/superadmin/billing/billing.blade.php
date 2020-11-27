@extends('superadmin.templates.superadmin_main')

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
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 align-self-center">
                                <div class="icon-info">
                                    <i class="mdi mdi-cash-multiple text-primary"></i>
                                </div>
                            </div>
                            <div class="col-8 align-self-center text-center">
                                <div class="ml-2 text-right">
                                    <p class="mb-1 text-muted font-size-13">Total Pemasukan</p>
                                    <h4 class="mt-0 mb-1 font-20">Rp. @if($billing["total"] != ''){{$billing["total"]}}@else{{'0'}}@endif</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 align-self-center">
                                <div class="icon-info">
                                    <i class="mdi mdi-cash-multiple text-success"></i>
                                </div>
                            </div>
                            <div class="col-9 align-self-center text-center">
                                <div class="ml-2 text-right">
                                    <p class="mb-1 text-muted font-size-13">Pemasukan Bulanan</p>
                                    <h4 class="mt-0 mb-1 font-20">Rp. @if($billing["bulanan"] != ''){{$billing["bulanan"]}}@else{{'0'}}@endif</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 align-self-center">
                                <div class="icon-info">
                                    <i class="mdi mdi-cash-multiple text-warning"></i>
                                </div>
                            </div>
                            <div class="col-10 align-self-center text-center">
                                <div class="ml-2 text-right">
                                    <p class="mb-1 text-muted font-size-13">Pemasukan Mingguan</p>
                                    <h4 class="mt-0 mb-1 font-20">Rp. @if($billing["mingguan"] != ''){{$billing["mingguan"]}}@else{{'0'}}@endif</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 align-self-center">
                                <div class="icon-info">
                                    <i class="mdi mdi-cash-multiple text-danger"></i>
                                </div>
                            </div>
                            <div class="col-9 align-self-center text-center">
                                <div class="ml-2 text-right">
                                    <p class="mb-1 text-muted font-size-13">Pemasukan Harian</p>
                                    <h4 class="mt-0 mb-1 font-20">Rp. @if($billing["harian"] != ''){{$billing["harian"]}}@else{{'0'}}@endif</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mt-0">Pendapatan Satu Tahun</h5>
                        <div class="row">
                            <div class="col-lg col-xl border-right">
                                <div class="card shadow-none mb-0">
                                    <div class="card-body">
                                        <div id="morris-line-chart-billing" class="morris-chart overview-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                        <th>Pengguna</th>
                                        <th>Nominal</th>
                                        <th>Status Akses</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($billing["billing"] as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->number}}</td>
                                        <td>{{$data->terbit}}</td>
                                        <td>{{$data->name}}</td>
                                        <td>{{$data->nominal}}</td>
                                        <td>{{$data->status_akses}}</td>
                                        <td><span class="badge 
                                        @if($data->status == 'pending')    
                                        {{'badge-warning'}}
                                        @elseif($data->status == 'konfirmasi')
                                        {{'badge-secondary'}}
                                        @elseif($data->status == 'lunas')
                                        {{'badge-success'}}
                                        @elseif($data->status == 'batal')
                                        {{'badge-danger'}}
                                        @endif
                                            ">{{$data->status}}</span>
                                            @if($data->status != 'lunas')
                                            <h5><a href="{{url('superadmin/billing/' . $data->id_his_bill . '/konfirmasi')}}"><span class="badge badge-link"> Konfirmasi </span></a></h5>
                                            @endif
                                        </td>
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