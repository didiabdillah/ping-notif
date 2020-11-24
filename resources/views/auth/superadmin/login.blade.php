@extends('layouts.applogin')

@section('content')
<style type="text/css">
  .bd-nice::before {
    background-image: url(/assets/images/technology.png);
  }

  .bd-nice {
    right: 0px;
  }

  .login-alert {
    color: black;
    margin-bottom: 15px;
    background-color: #F6BDC0;
    padding: 8px;
    margin-top: -10px;
  }
  }
</style>

<div class="wd-sc">
  <div class="bd-nice"></div>
  <div class="pen-title">
    <h2>Super Admin</h1><span>Ping Notif</span>
  </div>
  <!-- Form Module-->
  <div class="module form-module">

    <div class="form Masuk">

      <h2 class="text-center">Silahkan Masuk</h2>

      @if (Session::has('failed'))
      <div class="alert alert-primary login-alert" role="alert">{{ Session::get('failed') }}</div>
      @endif

      <form method="POST" action="{{ route('superadmin_login') }}">
        @csrf
        <input id="email" type="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus name="email" />
        @error('email')
        <p style="margin-top: -10px!important; font-size: 12px; color: red;">{{ $message }}</p>
        @enderror
        <input id="password" name="password" required autocomplete="current-password" type="password" placeholder="Password" />
        @error('password')
        <p style="margin-top: -10px!important; font-size: 12px; color: red;">{{ $message }}</p>
        @enderror
        <button type="submit">Masuk</button>
      </form>
    </div>

  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('.form').hide();
    var url = window.location.href;
    url = url.split('#')[1] ? url.split('#')[1] : 'Masuk';
    var text_ = url == 'Masuk' ? 'Registrasi' : 'Masuk';
    console.log(url);
    $("." + url).show();
    $(".cls-daftar").text(text_);

    $('body').delegate('.cls-daftar', 'click', function(e) {
      e.preventDefault();
      //$(this).toggleClass('active');

      var active_ = $(this).hasClass('active');
      var cek = $(this).text();
      window.history.pushState({
        'historycontent': '#' + cek
      }, null, '#' + cek);


      if (!active_) {
        $(this).text('Masuk');
        $(this).addClass('active');

      } else {
        $(this).removeClass('active');
        $(this).text('Registrasi');
      }
      // Switches the forms
      $(".form").animate({
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