            @extends('layouts.apphome')
            @section('content')
            <!-- Page-Title -->
            <style type="text/css">
.no_wa {
    position: absolute;
    width: 338px;
    padding: 10px;
    background: #4CAF50;
    color: #ffff;
    /* border-radius: 10px 1px 15px 0px; */
    left: -39px;
    top: 53px;
    box-shadow: -3px 3px 7px 0px rgb(0 0 0 / 71%);
}
@media(max-width:500px)
{
    .no_wa {
       position: relative!important;
    width: 100%;
    z-index: 20;
       
    }
}
.card.bg-qr {
    height: 407px;
    box-shadow: -6px 4px 11px 5px rgb(0 0 0 / 19%), 0 1px 0 0 rgba(0,0,0,.02);
    color: #343a40;
    background: #00BCD4;
}
.no_wa label
{
    color: #fff;
}
.g-qrcode {
height: 500px;
}
.show_qr {
    position: relative;
    width: 242px;
    height: 485px;
    background: rgb(242 245 247);
    margin: auto;
    text-align: center;
    color: #fff;
    left: 0;
    right: 0;
    padding-top: 51px;
    top: 23px;
    border-radius: 27px; 
}
.show_qr .hp {
width: 436px;
position: absolute;
left: -72px;
top: -44px;
}
.loading {
    background-image: url({{url('')}}/images/lsb-loading.gif);
    width: 100%;
    height: 100%;
    position: absolute;
    background-size: 100px 100px;
    background-position: center;
    background-repeat: no-repeat;
    top: -85px;
    top: -85px;
    z-index: 1000;
}
.show_qr .alert img {
    width: 100px;
}

.show_qr .alert {
    color: #000;
}
.note {
    position: absolute;
    top: 171px;
    background: #fff;
    padding: 31px;
    font-size: 24px;
    z-index: 1;
}
.apikey {
    font-size: 15px;
    background: #ccc;
    padding: 5px;
}
.apikey i {
    position: absolute;
    right: -21px;
    background: #545252;
    color: #fff;
    padding: 5px;
    top: 0;
    bottom: 0;
    cursor: pointer;
}
            </style>
            <div class="row ">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="float-right">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('whatsapp')}}">WhatsApp</a></li>
                                <li class="breadcrumb-item active">Tambah</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Tambah WhatsApp</h4></div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-lg-8 col-sm-8">
                    <div class="card bg-qr">
                        <div class="card-body">
                            <form method="post"  name="simpan_noWA" id="simpan_noWA">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="no_wa">
                                             <label class="">Nomor WhatsApp</label>
                                        <input class="form-control" type="text" id="nom_{{$colection}}" name="number" required="" value="{{$number_wa}}" {!!$number_wa?'readonly="readonly"':''!!} placeholder="628xxx">
                                        </div>
                                        <div class="note" id="note_{{$colection}}">
                                            {!!$api_key?'API KEY ANDA :<div class="apikey">'.$api_key.'<i class="mdi mdi-content-copy"></i></div>':'Pastikan nomor Hp whatsapp ter isi'!!}
                                        </div>
                                       
                                    </div>
                                    <div class="col-md-6 g-qrcode" id="bar_id_{{$colection}}">
                                        <div class="show_qr">
                                            <img class="hp" src="{{asset('images/handphone.png')}}">
                                            <div class="loading"></div>
                                            <div class="alert"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- <button type="submit" class="btn btn-primary px-4">Tambahkan</button> -->
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                    // function hanyaAngka(evt) {
                    //   var charCode = (evt.which) ? evt.which : event.keyCode
                    //    if (charCode > 31 && (charCode < 48 || charCode > 57))
                    //     return false;
                    //   return true;
                    // }
                </script>
                <script src="{{ asset('js/jquery-qrcode-0.18.0.js') }}"></script>
                <script type="text/javascript">
                var sendwithapi;
                var url_page    ='{{url('')}}';
                var REDIS_HOST  ='{{env('REDIS_HOST')}}';
                var REDIS_PORT  ='{{env('REDIS_PORT')}}';
                var csrf_token  ='{{csrf_token()}}'; 
                var colection   ='{{$colection}}';
                var id_wa       ='{{Request::segment(3)}}';
                </script> 
                <script src="{{ mix('/js/app.js') }}"></script> 
                @endsection