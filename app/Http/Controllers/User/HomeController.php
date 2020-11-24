<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Helpers;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $datawa     =DB::table('wa_account')->where('status','aktif')->where('user_id','=',Auth::user()->id)->count();
        $dt_saldo   =DB::table('tb_saldo')->select('nominal')->where('id_user','=',Auth::user()->id)->first();
        $saldo      =@$dt_saldo->nominal?Helpers::rupiah(@$dt_saldo->nominal):0;
        $dt_tagihan  =DB::table('users')
                    ->leftJoin('history_billing','users.id','=','history_billing.id_user')
                    ->where('users.id','=',Auth::user()->id)
                    ->where('history_billing.status','=','pending')
                    ->sum('history_billing.nominal');
                    $tagihan     =@$dt_tagihan?Helpers::rupiah(@$dt_tagihan):0;
        return view('dashboard.home.home',compact('datawa','saldo','tagihan'))->with('title', 'Dashboard');
    }
    
    
    
    
}
