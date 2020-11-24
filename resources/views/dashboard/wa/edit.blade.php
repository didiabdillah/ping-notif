            @extends('layouts.apphome')

            @section('content')
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="float-right">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('wa')}}">WhatsApp</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit WhatsApp</h4></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{route('simpaneditwa')}}">
                                @csrf
                                @foreach($whatsapp as $wa)
                                <input type="hidden" name="id" value="{{$wa->id}}">
                                <div class="form-group">
                                    <label class="col-form-label">Nomor WhatsApp</label>
                                    <div class="">
                                        <input class="form-control" type="text" id="number" name="number" placeholder="Nomor WhatsApp" required="" value="{{$wa->number}}" onkeypress="return hanyaAngka(event)">
                                    </div>
                                    @error('number')
                                        <span class="txt1" style="color: red !important;">
                                        {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                @endforeach
                                <button type="submit" class="btn btn-primary px-4">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                    function hanyaAngka(evt) {
                      var charCode = (evt.which) ? evt.which : event.keyCode
                       if (charCode > 31 && (charCode < 48 || charCode > 57))
             
                        return false;
                      return true;
                    }
                </script>
                @endsection