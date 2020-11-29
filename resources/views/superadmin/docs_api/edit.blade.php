@extends('superadmin.templates.superadmin_main')

@section('title', "Edit Dokumen Api")

@section('page')

<div class="page-content">
    <div class="container-fluid">
        <div class="row, mt-4">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mt-0">Edit Document API</h5>
                        <br>
                        <form action="{{url('superadmin/api/edit/'. $data->id_docs)}}" method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <input class="form-control" type="hidden" name="id" id="id" value="{{ $data->id_docs}}">
                                <label for="subject">Subject</label>
                                <input class="form-control @error('subject') is-invalid @enderror" type="text" name="subject" id="subject" value="{{ $data->subject}}" placeholder="Masukkan subject"> @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea rows="17" class="form-control @error('content') is-invalid @enderror" name="content" id="content" placeholder="masukkan content">{{$data->content}}</textarea>
                                @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group float-right">
                                <button class="btn btn-lg btn-danger" type="reset">Reset</button>
                                <button class="btn btn-lg btn-primary" type="submit" value="Simpan Data">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection