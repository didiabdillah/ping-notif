@extends('superadmin.templates.superadmin_main')

@section('title', "Tambah Dokumen Api")

@section('page')

<div class="page-content">
    <div class="container-fluid">
        <div class="row, mt-4">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mt-0">Tambah API</h5>
                        <!-- <p class="text-muted font-13 mb-4">Here’s a quick example to demonstrate Bootstrap’s form styles. Keep reading for documentation on required classes, form layout, and more.</p> -->
                        <form action="{{route('superadmin_store_docs_api')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="example-email-input1" class="col-form-label">Subject</label>
                                <div class="">
                                    <input name="subject" class="form-control" type="name" value="" id="example-email-input1" placeholder="(Your subject)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email-input1" class="col-form-label">Description</label>
                                <textarea name="desc" rows="16" class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="(Your description)"></textarea>
                            </div>

                            <button type="submit" class="btn btn-success btn-sm">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection