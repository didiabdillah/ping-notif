            @extends('layouts.apphome')

            @section('content')
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="float-right">
                            <ol class="breadcrumb">
<!--                                 <li class="breadcrumb-item"><a href="javascript:void(0);">Amezia</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li> -->
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Profile</h4></div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->
            <div class="row">
                <div class="col-md-12 col-xl-3">
                    <div class="card profile">
                        <div class="card-body">
                            <div class="text-center">
                                @if(Auth::user()->profile_pic != null)
                                <img src="{{asset('images/users/'.Auth::user()->profile_pic)}}" alt="" class="rounded-circle img-thumbnail thumb-xl">
                                @else
                                <img src="{{asset('images/default.jpeg')}}" alt="" class="rounded-circle img-thumbnail thumb-xl">
                                @endif
                                <div class="online-circle"><i class="fa fa-circle text-success"></i></div>
                                <h4 class="">{{ Auth::user()->name }}</h4>
                                <p class="text-muted font-12">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-9">
                    <div class="card">
                        <div class="card-body profile">
                            <h5 class="mt-0">Edit Profile</h5>
                            @if (\Session::has('berhasil'))
                            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <i class="mdi mdi-check-circle mr-2"></i>{{ Session::get('berhasil')}}
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-12">
                                    <form class="form-horizontal form-material mb-0" method="post" action="{{route('simpanprofile')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" placeholder="Name" class="form-control" required="" name="name" value="{{ Auth::user()->name }}">
                                            @error('name')
                                            <span class="txt1" style="color: red !important;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" placeholder="Full Name" class="form-control" required="" name="email" value="{{ Auth::user()->email }}">
                                            @error('email')
                                            <span class="txt1" style="color: red !important;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" placeholder="Password" class="form-control" name="password">
                                            @error('password')
                                            <span class="txt1" style="color: red !important;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Ulangi Password</label>
                                            <input type="password" placeholder="Password" class="form-control"name="password_confirmation">
                                        </div>
                                        <!-- <div class="form-group">
                                            <label>Foto</label>
                                            <input type="file" id="input-file-now-custom-1" name="profile_pic"class="form-control"> <span class="input-icon icon-right" >
                                        </div> -->
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm text-light px-4 mt-3 float-right mb-0" type="submit">Update Profile</button>
                                        </div>
                                    </form>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
                @endsection