@extends('superadmin.templates.superadmin_main')

@section('title', "Dokumen Api")

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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Document API</a></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <a href="{{route('superadmin_create_docs_api')}}" class="btn btn-success btn-sm">TAMBAH</a>
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <center><strong class="card-title">
                                        <h4 class="page-title">DOKUMEN API</h4>
                                    </strong></center>
                            </div>

                            <!-- <div class="row">
                        <div class="col-lg-12">
                            <div class="card m-b-20">
                                <div class="card-body">
                                    <h5 class="mt-0">Tampilan Code Api</h5>
                                    <p class="text-muted font-13 mb-4">Deskripsi</p>
                                    <pre class="language-markup"><code class="language-markup">
&lt;html&gt;
&lt;!-- this is a comment --&gt;
    &lt;head&gt;
        &lt;title&gt;HTML Example&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        The indentation tries to be &lt;em&gt;somewhat &amp;quot;do what
        I mean&amp;quot;&lt;/em&gt;... but might not match your style.
    &lt;/body&gt;
&lt;/html&gt;
                                    </code></pre>
                                </div>
                            </div>
                        </div> -->
                            <!-- ditulis setelah tag </div> penutup Daftar Buku -->
                            <div class="col-12">
                                <div class="#">
                                    @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <!-- ditulis sebelum tag <div> pembuka tabel -->
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="10%">NO</th>
                                            <th width="20%">SUBJECT</th>
                                            <th>CONTENT</th>
                                            <th width="15%">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $api)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$api->subject}}</td>
                                            <td>{{$api->content}}</td>
                                            <td>
                                                <a href="{{url('superadmin/api/edit/' . $api->id_docs)}}" class="btn btn-info btn-sm">Edit</a>
                                                <form class="form-horizontal" action="{{url('superadmin/api/delete/' . $api->id_docs)}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('delete')
                                                    <br>
                                                    <button type="submit" class="btn btn-danger btn-flat" onclick="return confirm('yakin?');" id="simpan">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </div>

                            @endsection