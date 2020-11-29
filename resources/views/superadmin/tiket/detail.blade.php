@extends('superadmin.templates.superadmin_main')

@section('title', "Detail Tiket")

@section('page')

<style>
    .cd-timeline-block.kanan .cd-timeline-content,
    .cd-timeline-block.kanan .cd-timeline-content:before {
        float: right;
    }
</style>
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Super Admin</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Detail Tiket</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="breadcrumbs">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">
                        <h4 class="page-title">DETAIL TIKET</h4>
                    </strong>
                </div>
                <div class="card-body">
                    <p>No : </p>
                    <p>Nama : </p>
                    <p>Subjek : </p>
                    <p>Tanggal : </p>
                    <p>Gambar : </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <strong class="card-title">
                        <h4 class="page-title">KOMENTAR</h4>
                    </strong>
                    <section id="cd-timeline" class="cd-container" dir="ltr">
                        <?php $i = 1;
                        $list_koment = DB::table('tb_item_tiket')->where('id_tiket', @app('request')->id_item)->get();
                        foreach ($list_koment as $data) { ?>
                            <div class="cd-timeline-block <?php @Auth::user()->id == @$data->id_user ? 'kanan' : ''; ?>">
                                <div class="cd-timeline-img bg-success">
                                    <i class="mdi mdi-face-profile"></i>
                                </div>
                                <!-- cd-timeline-img -->

                                <div class="cd-timeline-content">
                                    <span class="left-number">{{$i}}.</span>
                                    <h3>{{@$data->subject}}</h3>
                                    <p class="mb-0 font-size-13">
                                        {{@$data->pesan}}</p>
                                    <span class="cd-date">{{@$data->created_at}}</span>
                                </div>
                                <!-- cd-timeline-content -->
                            </div>
                            <!-- cd-timeline-block -->
                        <?php $i++;
                        } ?>
                        <!-- cd-timeline-block -->


                    </section>
                    <!-- cd-timeline -->
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <div class="breadcrumbs">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">
                    <h4 class="page-title">FORM TIKET</h4>
                </strong>
            </div>
            <div class="card-body">
                <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    @csrf

                    <div class="row form-group">
                        <div class="col col-md-2"><label for="pesan" class=" form-control-label">Pesan</label></div>
                        <div class="col-12 col-md-10">
                            <textarea id="pesan" name="pesan" placeholder="Pesan..." class="@error('pesan') is-invalid @enderror form-control" value="{{old('pesan')}}"></textarea>
                            @error('pesan')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-2"><label for="gambar" class="form-control-label">Gambar</label></div>
                        <div class="col-12 col-md-10">
                            <input type="file" id="gambar" name="gambar" class="@error('gambar') is-invalid @enderror form-control">
                            @error('gambar')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md">Balas</button>
                </form>
            </div>
        </div>
    </div>

    @endsection