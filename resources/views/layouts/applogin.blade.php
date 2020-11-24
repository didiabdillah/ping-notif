<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<title>{{ config('app.name', 'Laravel') }}</title>
   <meta name="viewport" content="width=device-width,initial-scale=1">
</head>

<link href="{{asset('css/icons.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('libraries/fontawesome/css/all.min.css')}}" rel="stylesheet">
<script src="{{asset('js/jquery.min.js')}}"></script>
<style type="text/css">
body {
     background: #f9f8f7!important;
    color: #ffffff;
    font-family: 'RobotoDraft', 'Roboto', sans-serif;
    font-size: 14px;
    -webkit-font-smoothing: antialiased; 
}

.pen-title {
    padding: 50px 0;
    text-align: center;
    letter-spacing: 2px;
    position: absolute;
    color: #00bfa5;
    right: 105px;
    top: 5%;
    width: 320px;
}
.pen-title h1 {
  margin: 0 0 20px;
  font-size: 48px;
  font-weight: 300;
}
.pen-title span {
  font-size: 12px;
}
.pen-title span .fa {
  color: #33b5e5;
}
.pen-title span a {
  color: #33b5e5;
  font-weight: 600;
  text-decoration: none;
}

/* Form Module */
.form-module {
    position: absolute;
    background: #ffffff;
    max-width: 320px;
    width: 100%;
    border-top: 5px solid #ffffff;
    box-shadow: 0 0 24px 0 rgb(0 0 0 / 23%);
    right: 105px;
    top: 30%;
}
.form-module .toggle {
  cursor: pointer;
  position: absolute;
  top: -0;
  right: -0;
  background: #33b5e5;
  width: 30px;
  height: 30px;
  margin: -5px 0 0;
  color: #ffffff;
  font-size: 12px;
  line-height: 30px;
  text-align: center;
}
.form-module .toggle .tooltip {
  position: absolute;
  top: 5px;
  right: -65px;
  display: block;
  background: rgba(0, 0, 0, 0.6);
  width: auto;
  padding: 5px;
  font-size: 10px;
  line-height: 1;
  text-transform: uppercase;
}
.form-module .toggle .tooltip:before {
  content: '';
  position: absolute;
  top: 5px;
  left: -5px;
  display: block;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent;
  border-right: 5px solid rgba(0, 0, 0, 0.6);
}
.form-module .form {
  display: none;
  padding: 40px;
}
.form-module .form:nth-child(2) {
  display: block;
}
.form-module h2 {
    margin: 0 0 20px;
    color: #6c7978;
    font-size: 18px;
    font-weight: 400;
    line-height: 1;
}
.form-module input {
  outline: none;
  display: block;
  width: 100%;
  border: 1px solid #d9d9d9;
  margin: 0 0 20px;
  padding: 10px 15px;
  box-sizing: border-box;
  font-wieght: 400;
  -webkit-transition: 0.3s ease;
  transition: 0.3s ease;
}
.form-module input:focus {
  border: 1px solid #33b5e5;
  color: #333333;
}
.form-module button {
    cursor: pointer;
    background: #57dc5d;
    width: 100%;
    border: 0;
    padding: 10px 15px;
    color: #ffffff;
    -webkit-transition: 0.3s ease;
    transition: 0.3s ease;
}
.form-module button:hover {
    background: #2ead33;
}
.form-module .cta {
    background: #00bfb6;
    width: 100%;
    padding: 15px 40px;
    box-sizing: border-box;
    color: #666666;
    font-size: 12px;
    text-align: center;
}
.form-module .cta a {
    color: #ffffff;
    text-decoration: none;
}

.wd-sc {
    position: fixed;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
}
.bd-nice {
    position: absolute;
    top: 0;
    left: 0;
    right: 305px;
    bottom: 0;
    background: #f9f9f9;
}
.bd-nice:before {
    background-image: url(./images/beautiful-smart-asian-young-entrepreneur-business-woman-owner-sme-checking-product-stock-scan-qr-code-working-home_7861-1369.png);
    position: absolute;
    z-index: 0;
    content: "";
    background-size: 100%;
    width: 100%;
    height: 100%;
    right: 0;
    top: 0;
    background-repeat: no-repeat;
    opacity: 0.5;
}
@media(max-width:1024px)
{
  .bd-nice
  {
    width: 100%;
  }
.pen-title {
    position: relative;
    padding: 0;
    width: 100%;
    right: 0;
}
.form-module
{
    position: relative;
    padding: 0;
    width: 100%;
    right: 0;
    margin: auto;
}
}

</style> 
<body>
	@yield('content')
</body>
</html>