<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; 
use Helpers;
class WAbillingController extends Controller
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
    public function billing()
    {
        //$Carbon=Carbon::now();
        //$tanggal=Helpers::keIndonesia($Carbon);
         return view('dashboard.billing.list_billing')->with('title', 'Billing');
    }
  

    public function tambahkan_saldo(Request $request)
    {
        $error          =true;
        $nominal        =$request->input('nominal');
        if(!$nominal)
        {
            print json_encode(array('error'=>$error,'alert'=>'Nominal belum di isikan','data'=>array()));
            return;
        }
        $nominal        =preg_replace('/\D/', '', $nominal);
        $tanggal_order  =Carbon::now();
        $id_user        =Auth::user()->id;
        if($nominal<250000)
        {
            print json_encode(array('error'=>$error,'alert'=>'Minimal Nominal Pembelian saldo Harus Rp.250.000','data'=>array()));
            return;
        }
        $db_saldo          = DB::table('tb_saldo')->where('id_user',$id_user)->first();
        $nominal_saldo     = @$db_saldo->nominal?@$db_saldo->nominal:0;
        $history_billing   =DB::table('history_billing')
                                ->where('status','!=','lunas')
                                ->where('status','!=','batal')
                                ->where('id_user',@$id_user)->get();
        if(count($history_billing)>=3)
        {
            print json_encode(array('error'=>$error,'alert'=>'Pembelian Paket yang belum terbayar masih dalam antrian','data'=>array()));
            return;
        } 
        $kd_unik                    =intval(substr(str_shuffle('123456789987654321'),0,3));
        $id_invoice                 ='Inv-'.$id_user.Carbon::now()->format('ymdhis');
        $data_his['id_user']        =@$id_user;
        $data_his['created_at']     =Carbon::now();
        $data_his['id_invoice']     =$id_invoice;
        $data_his['kd_unik']     =$kd_unik;
        $data_his['status']         ='pending';
        $data_his['nominal']        = $nominal+$kd_unik;
        $data_his['status_akses']   ='debit';
        $history_biling             = DB::table('history_billing')->insertGetId($data_his,'id_his_bill');
        if($history_biling)
        {
            $data_new_hist        = DB::table('history_billing')->where('id_his_bill',$history_biling)->first(); 
            print json_encode(array('error'=>false,'alert'=>$data_his['keterangan'],'data'=>$data_new_hist));
            return;

        }

    }

    public function load_history(Request $request)
    {

            $p                  = $request->input('page')? $request->input('page'):0;
            $p                  = $p<=1?0:(($p*15)-15);
            $jm_page            = ceil($p);
            $id_user            = Auth::user()->id;
            $history_billing    =DB::table('history_billing')
                                ->select('history_billing.*','wa_account.number as no_wa')
                                ->leftJoin('wa_account','history_billing.id_wa','=','wa_account.id')
                                ->skip($p)
                                ->take(15)
                                ->where('id_user',@$id_user)->orderBy('id_his_bill','DESC')->get();
                                $i=0;

            foreach ($history_billing as $key) {
                $history_billing[$i]->created_at=Helpers::keIndonesia($key->created_at,true,false);
                $history_billing[$i]->nominal   =Helpers::rupiah($key->nominal);
                $i++;
            }
            $tb_saldo   =DB::table('tb_saldo')->where('id_user',@$id_user)->first();
            $saldo      =@$tb_saldo->nominal?Helpers::rupiah(@$tb_saldo->nominal):0;
            $status_bayar=@$tb_saldo->nominal>250000?true:false;
            $jmlh       =DB::table('history_billing')->where('id_user',@$id_user)->count();
            $dt_tagihan =DB::table('users')
                            ->leftJoin('history_billing','users.id','=','history_billing.id_user')
                            ->where('users.id','=',Auth::user()->id)
                            ->where('history_billing.status','=','pending')
                            ->where('history_billing.status_akses','=','kredit')
                            ->sum('history_billing.nominal'); 
             $dt_wa     =DB::table('wa_account')->select('id')->where('user_id',@$id_user)->where('status','aktif')->get();
             $wa_aktif=0;
             foreach ($dt_wa as $key) 
                {
                    $ms=Helpers::MasaAkit($key->id);
                    if($ms['hari']>0)
                    {
$wa_aktif++;
                    }
                }          
            print json_encode(array('status_bayar'=>$status_bayar,'page'=>$p,'data_hist'=>$history_billing,'jmlh'=>$jmlh,'saldo'=>$saldo,'tagihan'=>Helpers::rupiah($dt_tagihan),'wa_aktif'=>$wa_aktif));
            return;




    }


 public function simpan_konfirmasi(Request $request)
    {
        $error              = true;
        $id_user            = Auth::user()->id;
        $bank               = $request->input('bank');
        $tanggal_transfer   = $request->input('tanggal_transfer');
        $file               = $request->file('file');
        $id_history         = $request->input('id_history');
                           
        $alert              ='';
        $alert              .=$bank==""?'<li>bank wajib di isi</li>':'';
        $alert              .=$tanggal_transfer==""?'<li>tanggal wajib di isi</li>':'';
        $alert              .=$file==""?'<li>bukti wajib di isi</li>':'';
        if($alert)
        {
            $alert='<ul>'.$alert.'</ul>';
            print json_encode(array('error'=> $error,'alert'=>$alert));
            return;
        }

        $path               =Helpers::create_folder_user($id_user);
        $namefile           =Helpers::Upload_gambar($file,$path['document']);
        $data['id_user']    =$id_user;
        $data['status']     ='pending';
        $data['created_at'] =Carbon::now();
        $data['tanggal_transfer'] =Carbon::parse($tanggal_transfer)->format('Y-m-d');
        $data['id_his_bill'] =$id_history;
        $data['metode']     ='manual';
        $data['bank']       =$bank;
        $data['keterangan'] ='konfirmasi manual';
        $data['bukti']      =$namefile;
        $dt_konfirmasi      =DB::table('tb_konfirmasi')->insert($data);
        if($dt_konfirmasi)
        {
            DB::table('history_billing')->where('id_his_bill',$id_history)->update(['status'=>'konfirmasi']);
            $error=false;
            $alert='Konfirmasi berhasil di kirim mohon ditunggu untuk proses approve';
        }
         print json_encode(array('error'=> $error,'alert'=>$alert));
            return;
             

    }


    public function tambahsaldomanual(Request $request)
    {
       
        $id_user            = Auth::user()->id;
        $id_history         = $request->id_his;
        DB::table('history_billing')->where('id_his_bill',$id_history)->update(['status'=>'lunas']);
        echo  Helpers::tambahsaldo($id_user,$id_history);
    }

    public function WAbillingController(Request $request)
    {
        $tanggal_order  =Carbon::now();
        $dt_wa          =DB::table('wa_account')->select('wa_account.id','wa_account.user_id')->get();
        foreach ($dt_wa as $key) 
        {
             $ms=Helpers::MasaAkit($key->id);
             if($ms['hari']>=7)
             {
                $dt_hit=DB::table('history_billing')
                ->where('id_wa',$key->id)
                ->where('status','pending')
                ->first();
                if(!$dt_hit)
                {
                    $kd_unik                    =intval(substr(str_shuffle('01234567899876543210'),0,3));
                    $harga                      =250000;
                    $id_invoice                 ='Inv_'.$id_user.Carbon::now()->format('ymdhis');
                    $data_his['id_user']        =@$key->user_id;
                    $data_his['created_at']     =Carbon::now();
                    $data_his['id_invoice']     =$id_invoice;
                    $data_his['kd_unik']     =$kd_unik;
                    $data_his['status']         ='pending';
                    $data_his['nominal']        =$harga+$kd_unik;
                    $data_his['status_akses']   ='kredit';
                    $history_biling             = DB::table('history_billing')->insertGetId($data_his,'id_his_bill');
                }

             }
        }  

    }

 public function perpanjang_konfirmasi(Request $request)
    {
        $id_user    =Auth::user()->id;
        $id_history =$request->input('id_perpanjang');
        $jmlh_paket =30;
        $potongan   =Helpers::pengurangansaldo($id_user,$id_history);
        if($potongan==true)
        {
            $dt=DB::table('history_billing')->where('id_his_bill',$id_history)->first();
            Helpers::TambahmasaAktif($dt->id_wa,$jmlh_paket);
            print json_encode(array('error'=> false,'alert'=>'Masa akif no wa berhasil di tambahkan'));
            return;

        }
         print json_encode(array('error'=> true,'alert'=>'Masa akif no wa gagal di tambahkan'));
         return;
    }

    public function cronjob(Request $request)
    {   
        if(Auth::user()->status_dev!='superadmin') 
            {
                return redirect()->route('404');
            }

         $wa =   DB::table('wa_account')->where('status','aktif')->select('id','user_id')->get();
            foreach ($wa as $key) 
            {
                $dt         =Helpers::MasaAkit($key->id);
                $masa_aktif =$dt['hari'];
                $dt_hist    =DB::table('history_billing')
                            ->select('id_his_bill')
                            ->where('id_wa',$key->id)
                            ->where('id_user',$key->user_id)
                            ->where('status','pending')
                            ->where('status_akses','kredit')
                            ->first();
                if(intval($masa_aktif)<=7&&!$dt_hist)
                {
                    Helpers::create_paket($key->id,$key->user_id);
                }
            }  

    }
    public function detail_billing(Request $request)
    { 
        $id_inv =$request->invoice;
        $dt     =DB::table('history_billing')
        ->select('history_billing.*','wa_account.number','wa_account.created_at')
        ->leftJoin('wa_account','history_billing.id_wa','=','wa_account.id')
        ->where('history_billing.id_user',Auth::user()->id)
        ->where('history_billing.id_invoice',$id_inv)
        ->first();
        if(!$dt)
        {
            return redirect()->route('billing')->with('alert','invoice tidak ada');
        }
        $dt->masa_aktif     =$dt->id_wa?Helpers::MasaAkit($dt->id_wa):'';
        $dt->ket_detail     =$dt->status_akses=='kredit'?'Penambahan masa aktif selama 30 hari':'Pembelian saldo';
        $dt->id_invoice     =str_replace('Inv-', '', $dt->id_invoice);
        $dt->id_invoice     =str_replace('Invoice_', '', $dt->id_invoice);
        $dt->nominal_ttl    =Helpers::rupiah($dt->nominal);
        $dt->nominal        =Helpers::rupiah($dt->nominal-$dt->kd_unik);
        $dt->no_unik        =Helpers::rupiah($dt->kd_unik);
        
        return view('dashboard.billing.detail_biling',['dt_inv'=>$dt])->with('title', 'Detail Billing '.$id_inv);

    }

     public function notifikasi(Request $request)
        { 
            $id_user        =Auth::user()->id;
            $notif_tagihan  =DB::table('history_billing')
            ->select('history_billing.*','wa_account.number')
            ->leftJoin('wa_account','history_billing.id_wa','=','wa_account.id')
            ->where('history_billing.status','pending')
            ->where('history_billing.status_akses','kredit')
            ->where('history_billing.id_user',$id_user)
            ->get();  
            $jmlNotif=count($notif_tagihan );
            print json_encode(array('notif_tagihan'=>$notif_tagihan,'jmlNotif'=> $jmlNotif)); 

        }



}
