@extends('superadmin.templates.superadmin_main')

@section('title', "Setting")

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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Setting</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Setting</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card ">
                    <div class="card-body">
                        <h5 class="card-title">General</h5>
                        @if (Session::has('alert'))
                        <div class="alert alert-danger" role="alert">{{ Session::get('alert') }}</div>
                        @endif
                        <form method="POST" action="{{route('superadmin_setting_edit')}}">
                            @csrf
                            @method('put')
                            <div class="form-group ">
                                <input class="form-control" type="hidden" id="id" name="id" value="{{$setting->id}}">
                                <label for="name" class="col-form-label">Nama</label>
                                <div class="">
                                    <input class="form-control  @error('name') is-invalid @enderror" type="text" id="name" name="name" placeholder="Nama" value="{{$setting->name}}">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="email" class="col-form-label pt-0">Email</label>
                                <div class="">
                                    <input class="form-control  @error('email') is-invalid @enderror" type="email" value="{{$setting->email}}" name="email" id="email" placeholder="Email">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <button type="reset" class="btn btn-secondary w-lg">Batal</button>
                            <button type="submit" class="btn btn-primary w-lg">Ubah</button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-lg-6">
                <div class="card ">
                    <div class="card-body">
                        <h5 class="card-title">Ubah Password</h5>
                        @if (Session::has('alert2'))
                        <div class="alert alert-danger" role="alert">{{ Session::get('alert2') }}</div>
                        @endif
                        <form method="POST" action="{{route('superadmin_setting_ubah_password')}}">
                            @csrf
                            @method('patch')
                            <input class="form-control" type="hidden" id="id" name="id" value="{{$setting->id}}">
                            <div class="form-group ">
                                <label for="passwordLama" class="col-form-label">Password Lama</label>
                                <div class="">
                                    <input class="form-control @error('passwordLama') is-invalid @enderror" type="password" id="passwordLama" name="passwordLama" placeholder="Password Lama" value="">
                                    @error('passwordLama')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="passwordBaru" class="col-form-label">Password Baru</label>
                                <div class="">
                                    <input class="form-control @error('passwordBaru') is-invalid @enderror" type="password" id="passwordBaru" name="passwordBaru" placeholder="Password Baru" value="">
                                    @error('passwordBaru')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="konfirmasiPassword" class="col-form-label">Konfirmasi Password Baru</label>
                                <div class="">
                                    <input class="form-control  @error('konfirmasiPassword') is-invalid @enderror" type="password" id="konfirmasiPassword" name="konfirmasiPassword" placeholder="Konfirmasi Password Baru" value="">
                                    @error('konfirmasiPassword')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <button type="reset" class="btn btn-secondary w-lg">Batal</button>
                            <button type="submit" class="btn btn-primary w-lg">Ubah</button>
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