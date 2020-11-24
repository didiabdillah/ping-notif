@extends('layouts.applogin')

@section('content')
<style type="text/css">
  
</style>
<div class="wd-sc">
  <div class="bd-nice"></div>
<div class="pen-title">
  <h1>Pingnotif</h1><span>Nikmati Segala Kemudahannya !</span>
</div>
<!-- Form Module-->
<div class="module form-module">

  <div class="form Registrasi">
     <h2>Silahkan Daftar</h2>
    <form method="POST" action="{{ route('register') }}">
      @csrf
        <input id="name" type="text" placeholder="Nama" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus/>
        @error('name')
            <p style="margin-top: -10px!important; font-size: 12px; color: red;">{{ $message }}</p>
        @enderror
        <input id="email" type="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus name="email" />
        @error('email')
        <p style="margin-top: -10px!important; font-size: 12px; color: red;">{{ $message }}</p>
        @enderror
        <input id="password" name="password" required autocomplete="current-password" type="password" placeholder="Password"/>
        @error('password')
        <p style="margin-top: -10px!important; font-size: 12px; color: red;">{{ $message }}</p>
        @enderror
        <input id="password" name="password_confirmation" required autocomplete="new-password" type="password" placeholder="Konfirmasi Password"/>
        <button type="submit">Daftar</button>
    </form>
  </div>

  <div class="form Masuk">
     
      <h2>Silahkan Masuk</h2>
      <form method="POST" action="{{ route('login') }}">
          @csrf
          <input id="email" type="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus name="email" />
          @error('email')
          <p style="margin-top: -10px!important; font-size: 12px; color: red;">{{ $message }}</p>
          @enderror
          <input id="password" name="password" required autocomplete="current-password" type="password" placeholder="Password"/>
          @error('password')
          <p style="margin-top: -10px!important; font-size: 12px; color: red;">{{ $message }}</p>
          @enderror
          <button type="submit">Masuk</button>
      </form>
    </div>

    <div class="cta"><a href="#" class="cls-daftar">Registrasi</a></div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
      $('.form').hide();
        var url=window.location.href;   
        url= url.split('#')[1]?url.split('#')[1]:'Masuk';
        var text_=url=='Masuk'?'Registrasi':'Masuk';
        console.log(url);
       $("."+url).show();
       $(".cls-daftar").text(text_);

        $('body').delegate('.cls-daftar','click',function(e)
        {
          e.preventDefault();
          //$(this).toggleClass('active');
         
          var active_=$(this).hasClass('active');
          var cek=$(this).text();
          window.history.pushState({'historycontent':'#'+cek}, null,'#'+cek);


          if(!active_)
          {
            $(this).text('Masuk');
            $(this).addClass('active');

          }
          else
          {
            $(this).removeClass('active');
            $(this).text('Registrasi');
          }
              // Switches the forms
              $(".form").animate(
                {
                  height: "toggle",
                  "padding-top": "toggle",
                  "padding-bottom": "toggle",
                  opacity: "toggle"
                },
                "slow"
              );
        });  
    });
</script>
@endsection
