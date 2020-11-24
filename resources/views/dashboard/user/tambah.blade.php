            @extends('layouts.apphome')

            @section('content')
            <?php
            $wa = DB::table('wa_account')->where('user_id', Auth::user()->id)->orderBy('id','DESC')->get();
            $sms = DB::table('sms_account')->where('user_id', Auth::user()->id)->orderBy('id','DESC')->get();
            $optionlistwa='';
            foreach ($wa as $key) {
                $optionlistwa .= '<option value="'.$key->id.'">'.$key->number.'</option>';
            }
            $optionlistsms='';
            foreach ($sms as $key) {
                $optionlistsms .= '<option value="'.$key->id.'">'.$key->number.'</option>';
            }
            ?>
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="float-right">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('user')}}">User</a></li>
                                <li class="breadcrumb-item active">Tambah</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Tambah User</h4></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{route('simpanuser')}}">
                                @csrf
                                <div class="form-group">
                                    <label class="col-form-label">Nama</label>
                                    <div class="">
                                        <input class="form-control" type="text" id="name" name="name" placeholder="Nama" required="" value="{{ old('name') }}">
                                    </div>
                                    @error('name')
                                        <span class="txt1" style="color: red !important;">
                                        {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Email</label>
                                    <div class="">
                                        <input class="form-control" type="email" id="email" name="email" placeholder="Email" required="" value="{{ old('email') }}">
                                    </div>
                                    @error('email')
                                        <span class="txt1" style="color: red !important;">
                                        {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <div class="">
                                        <input class="form-control" type="password" id="password" name="password" placeholder="Password" required="" value="{{ old('password') }}">
                                    </div>
                                    @error('password')
                                        <span class="txt1" style="color: red !important;">
                                        {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Ulangi Password</label>
                                    <div class="">
                                        <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Akses WhatsApp</label>
                                    <div class="">
                                        <select class="form-control select2" id="hak_akses_wa" name="hak_akses_wa[]" multiple="multiple" required="">
                                            {!!$optionlistwa!!}
                                        </select>
                                    </div>
                                    @error('hak_akses_wa')
                                        <span class="txt1" style="color: red !important;">
                                        {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Akses SMS</label>
                                    <div class="">
                                        <select class="form-control select2" id="hak_akses_sms" name="hak_akses_sms[]" multiple="multiple" required="">
                                            {!!$optionlistsms!!}
                                        </select>
                                    </div>
                                    @error('hak_akses_sms')
                                        <span class="txt1" style="color: red !important;">
                                        {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary px-4">Tambahkan</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endsection