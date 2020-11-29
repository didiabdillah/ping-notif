@extends('superadmin.templates.superadmin_main')

@section('title', "Pengguna")

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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Pengguna</a></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="breadcrumbs">

            <div class="content mt-3">
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="card">
                                <div class="card-header">
                                    <center><strong class="card-title">
                                            <h4 class="page-title">PENGGUNA</h4>
                                        </strong></center>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="table-responsive">
                                                    <table id="datatable" class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th width="5%">No</th>
                                                                <th width="45%">Nama</th>
                                                                <th width="25%">Tanggal Daftar</th>
                                                                <th width="5%">Whatsapp</th>
                                                                <th width="20%">Aksi</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data as $user)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>
                                                                    {{$user->name}}
                                                                </td>
                                                                <td>
                                                                    {{$user->daftar}}
                                                                </td>
                                                                <td>
                                                                    {{$user->jumlah_wa}}
                                                                </td>
                                                                <td>
                                                                    <a href="" class="btn btn-success badge badge-boxed  badge-primary">HUBUNGI</a>
                                                                    <a href="dashboard" class="btn btn-success badge badge-boxed  badge-warning">INTIP</a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                </div>
                                            </div>
                                        </div>





                                        @endsection