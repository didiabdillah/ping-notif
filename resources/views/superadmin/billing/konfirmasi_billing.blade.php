@extends('superadmin.templates.superadmin_main')

@section('title', "Konfirmasi Billing")

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
            <div class="col-lg">
                <div class="card ">
                    <div class="card-body">
                        <h5 class="card-title">Konfirmasi Billing</h5>
                        <form method="post" action="{{url('superadmin/billing/' . $data->id_his_bill . '/konfirmasi')}}">
                            @csrf
                            @method('patch');
                            <div class="form-group row">
                                <input type="hidden" name="id" id="id" value="{{$data->id_his_bill}}">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="status" id="status">
                                        <option value="pending" @if($data->status == 'pending') selected @endif>Pending</option>
                                        <option value="konfirmasi" @if($data->status == 'konfirmasi') selected @endif>Konfirmasi</option>
                                        <option value="lunas" @if($data->status == 'lunas') selected @endif>Lunas</option>
                                        <option value="batal" @if($data->status == 'batal') selected @endif>Batal</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-lg">Ubah Status</button>
                        </form>
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