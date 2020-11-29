@extends('superadmin.templates.superadmin_main')

@section('title', "Tiket")

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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Tiket</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">TIKET</h4>
                </div>
            </div>
        </div>


        <div class="card-body">
            <div class="flash-data" data-flashdata="this->session->flashdata('flash'); ?>"></div>
            <div class="table-responsive">
                <table id="datatables" class="display table table-bordered table-striped table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $tiket)
                        <tr>
                            <td>1</td>
                            <td>{{$tiket->judul}}</td>
                            <td>{{$tiket->created_at}}</td>
                            <td></td>
                            <td><a href="{{ route('superadmin_detail_tiket',$tiket->id_tiket) }}" class="btn btn-success  btn-sm">Detail</a></td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endsection