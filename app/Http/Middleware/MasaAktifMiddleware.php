<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure; 
use Session;
use Helpers;
class MasaAktifMiddleware
{
	
	public function handle($request,Closure $next)
	{
		// $masaakitif = Helpers::MasaAkit(@Auth::user()->id);
		// $alert 		='';
		// $style 		=' style="position: fixed;width: 100%;z-index: 10001;top: 0;left: 0;right: 0;text-align: center;padding: 1px;border-radius: 0;"';

		// $style_bg= $request->segment(1)!="billing"?'style="position: fixed;z-index: 10000;top: 0;bottom: 0;left: 0;right: 0;width: 100%;background: rgb(0 0 0 / 65%);"':'';
		// if($masaakitif['hari']<=7)
		// {
		// 	$alert 		='<div '.$style.' class="alert alert-warning">Masa aktif anda masih '.$masaakitif['hari'].' hari lagi, aktifkan  di menu <a href="'.url('billing').'">Billing</a></div>';
		// }
		// if($masaakitif['hari']<=5)
		// {
		// 	$alert 		='<div '.$style.' class="alert alert-danger">Masa aktif anda masih '.$masaakitif['hari'].' hari lagi, aktifkan  di menu <a href="'.url('billing').'">Billing</a></div>';
		// }
		// if($masaakitif['hari']<=1)
		// {
		// 	$alert 		='<div '.$style.' class="alert alert-danger">Masa aktif anda masih '.$masaakitif['hari'].' hari lagi, aktifkan  di menu <a href="'.url('billing').'">Billing</a></div>';
		// }
		// if($masaakitif['hari']<=0)
		// {
		// 	$alert 		='<div '.$style.' class="alert alert-danger">Masa aktif anda telah Berahir, aktifkan kembali di menu <a href="'.url('billing').'">Billing</a></div><div '.$style_bg.'></div>';
		// }
		// $request->aktifasi=array('masaakitif'=>$masaakitif['hari'],'alert'=>$alert);
		return $next($request);
		
		
	}
}
