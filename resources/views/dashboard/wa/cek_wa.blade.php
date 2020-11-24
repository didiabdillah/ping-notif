@extends('layouts.apphome')
@section('content')

<style type="text/css">
			.box-qr {
    height: 339px;
    overflow: hidden;
    /* box-shadow: 2px 2px 10px 1px rgb(0 0 0 / 62%); */
    position: relative;
    border-radius: 9px;
    margin-top: 51px;
    /* background: #4CAF50; */
}
.bg-qrcode {
    position: absolute;
    width: 245px;
    height: 328px;
    background: rgb(14 206 170);
    margin: auto;
    text-align: center;
    color: #fff;
    left: 0;
    right: 0;
    padding-top: 51px;
    top: 23px;
    border-radius: 27px;
}

.bg-qrcode p {
   
    padding-top: 66px;
}
	.qrcode
	{
		width: 100%;
		height: 100%;

	}
	.loading {
    background-image: url({{url('')}}/images/lsb-loading.gif);
    width: 100%;
    height: 100%;
    position: absolute;

    background-size: 100px 100px;
    background-position: center;
    background-repeat: no-repeat;
}
img.hp {
    width: 436px;
    position: absolute;
    left: -72px;
    top: -44px;
}
.bg-qrcode img:not(.hp) {
    width: 58px;
}
form#test_kirim_wa {
    margin-top: 51px;
    background: #4caf50;
    padding: 15px;
    position: relative;
    overflow: hidden;
    height: 339px;
    /* box-shadow: 2px 2px 10px 1px rgb(0 0 0 / 62%); */
    cursor: pointer;
}
form#test_kirim_wa label
{
	color: #fff;
}
.belum-login {
   	position: absolute;
    left: 0;
    width: 100%;
    top: -339px;
    opacity: 0;
    height: 100%;
    padding-top: 94px;
    text-align: center;
    color: #fff;
    background: #132d46b3;
    z-index: 100;
    font-size: 28px;
    -webkit-transition: all .4s ease-out;
    transition: all .4s ease-out;
}
form#test_kirim_wa:hover .belum-login
{
 top: 0px;
 opacity: 1;
}
.hps_session {
    position: absolute;
    width: 97px;
    left: 0px;
    top: 121px;
    z-index: 11;
    right: 0;
    margin: auto;
    border-radius: 16%;
    display: none;
    cursor: pointer;
}
.m_tp
{
	margin-top: 51px;
}
.code_crl {
    background: rgb(29 7 7);
    /* color: #fff!important; */
    padding: 10px 0px;
    border-left: 5px solid #4CAF50;
}

.code_crl pre {
    color: #fff;
    overflow: unset!important;
}
.code_crl h2 {
    margin: 5px 10px;
    color: #fff;
    border-bottom: 3px solid #4caf50;
}
.bg-qrcode .alert {
    color: #000;
}
.bg-qrcode .alert img {
    width: 82px;
}
</style>
<div class="row">
	<div class="col-md-4" >
		<div class="text-center box-qr">
			<img class="hps_session" id="sesi_berahir_{{Request::segment(2)}}" src="{{asset('images/icon_trash-bug.jpg')}}">
			
		<div class="bg-qrcode" id="bg-qrcode_{{Request::segment(2)}}">
			<div class="alert_{{Request::segment(2)}}"></div>
			<img class="hp" src="{{asset('images/handphone.png')}}">
			<div class="loading" id="loading_{{Request::segment(2)}}"></div>
			<div class="qrcode" id="qrcode_{{Request::segment(2)}}"></div>
		</div>
		</div>
		
	</div>
	<div class="col-md-3">
		<form id="test_kirim_wa" class="test_kirim_wa_{{Request::segment(2)}}">
			<div class="belum-login" id="belumlogin_{{Request::segment(2)}}">Sesi WA Belum Terdaftar</div>

			<label>Testing kirim WA</label>
				<div class="input-group mb-3" >
					<input class="form-control" type="text" name="nomer_hp" placeholder="Nomor wa : 628xxx">
				</div>
				
				<div class="input-group mb-3" >
					<input class="form-control" type="text" name="message" placeholder="Pesan">
				
					<span class="input-group-append">
						<button type="submit" class="btn btn-success"><i class="fa fa-send"></i></button>
					</span>
				</div>
				
				
		</form>
	</div>
	<div class="col-md-5">
	<div class="code_crl m_tp">
		<h2>Contoh Script dengan PHP</h2>
	<pre>
	<?= htmlspecialchars('<?php 
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => "'.url('').'/api-whatsapp",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => array(
	\'number_phone\' 	=> \'6285XXX\',
	\'message\' 		=> \'Coba WA\'),
	CURLOPT_HTTPHEADER => array(
	"Content-Type: application/x-www-form-urlencoded",
	"key: a87ff679a2f3e71d9181a67b7542122c"
	),
	));
	$response = curl_exec($curl);
	curl_close($curl);
	?>')?>
	</pre>
	</div>
	</div>
</div>
<script src="{{ asset('js/jquery-qrcode-0.18.0.js') }}"></script>
<script type="text/javascript">
	var sendwithapi;
	var url_page='{{env('APP_URL')}}';
	var REDIS_HOST='{{env('REDIS_HOST')}}';
	var REDIS_PORT='{{env('REDIS_PORT')}}';
</script> 
<script src="{{ mix('/js/app.js') }}"></script> 
<script type="text/javascript">
</script>
@endsection