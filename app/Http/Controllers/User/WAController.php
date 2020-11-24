<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\SocketIO;
use ElephantIO\Client;
use Helpers;
use ElephantIO\Engine\SocketIO\Version2X;

class WAController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $wa = DB::table('wa_account')
        ->where('user_id', Auth::user()->id)
        ->where('status', 'aktif')
        ->orderBy('id','DESC')->paginate(10);
        $i=0;
        foreach ($wa as $key) 
        {
            $masa_aktif         =Helpers::MasaAkit($key->id);
            $wa[$i]->masa_aktif =$masa_aktif['hari'];
            $wa[$i]->trial      =$masa_aktif['trial']!=true?'Masa trial':'Berlangganan';
            $wa[$i]->tgl_expired =Helpers::keIndonesia($masa_aktif['tgl_expired'],true,false);

            $i++;   
        }
        return view('dashboard.wa.list', ['whatsapp'=>$wa])->with('title', 'WhatsApp');
    }



    public function save_no_wa(Request $request)
    {
        $error  =true;
        $alert  ='';
        $id_user=Auth::user()->id;
        $no_wa  =$request->input('no_whatsapp');
        if(!$request->input('no_whatsapp'))
        {
           $alert='Nomor wa Belum di masukan';
            print json_encode(array('error'=>true,'alert'=>$alert));
            return; 
        }
        $wa     =DB::table('wa_account')->where('user_id',$id_user)->where('number',$no_wa)->first();
        if($wa)
        {
            $alert='Nomor wa sudah terdaftar';
            print json_encode(array('error'=>true,'alert'=>$alert));
            return;
        }  

        $data['user_id']        =$id_user;
        $data['number']         =$no_wa;
        $data['created_at']     =Carbon::now();
        $data['updated_at']     =Carbon::now();
        $data['status']         ='aktif';
        $simpan= DB::table('wa_account')->insert($data);
        print json_encode(array('error'=>false,'alert'=>'Simpan sukses'));
        return;

    }

    public function tambah(Request $request)
    {
        $id_user    =Auth::user()->id;
        $wa         = DB::table('wa_account')
                        ->select('user_id','id','number','token')
                        ->where('number', @$request->id_wa)
                        ->where('user_id', @$id_user)
                        ->first();
                        if(!$wa)
                        {
                            return  redirect('whatsapp');
                        }
        $masa_aktif         =Helpers::MasaAkit($wa->id);
        if($masa_aktif['hari']<0)
        {
            return  redirect('whatsapp')->with('error-report', 'Masa aktif telah berahir');
        }

        $api_key     =@$wa->token;    
        $number_wa  = @$wa->number;          
        $colection   =@$wa->token?@$wa->token:md5($wa->user_id.$wa->id.str_shuffle(123456789).Carbon::now()->format('ymdhis'));
        return view('dashboard.wa.tambah',compact('colection','number_wa','api_key'))->with('title', 'Tambah WhatsApp');
    }





    public function hapus(Request $request)
    {
        $decrypt=$request->input('id');

        $wa     = DB::table('wa_account')
                    ->where('user_id', Auth::user()->id)
                    ->where('id', $decrypt)
                    ->delete();
        $sukses =$wa?true:false;
        print json_encode(array('statusabsen'=>$sukses));
    }

public function whatsappdetail(Request $request)
    {
         $data = DB::table('tb_domain')
         ->select('tb_domain.*')
         ->leftJoin('wa_account','tb_domain.id_no_hp','=','wa_account.id')
         ->where('wa_account.number', $request->no_hp)
         ->where('wa_account.user_id',Auth::user()->id)
         ->orderBy('id_domain','DESC')->paginate(10);
         $dt_history= DB::table('history_wa')
                    ->select('history_wa.*')
                    ->leftJoin('wa_account','history_wa.id_wa','=','wa_account.id')
                    ->where('wa_account.number', $request->no_hp)
                    ->where('wa_account.user_id',Auth::user()->id)
                    ->orderBy('history_wa.id_his_wa','DESC')->paginate(10);
        return view('dashboard.wa.detaillist', ['domain'=>$data,'dt_history'=>$dt_history])->with('title', 'Whatsapp');
    }
public function delete_no_wa(Request $request)
    {
          $wa     = DB::table('wa_account')
                    ->where('user_id', Auth::user()->id)
                    ->where('number', $request->input('id_delete'))
                    ->update([
                        'status'=>'nonaktif',
                        'session'=>null,
                        'token'=>null
                    ]);
        print json_encode(array('error'=>false));
    }
      



public function simpandomain(Request $request)
    {
        $error  =true;
        $alert  ='';
        $no_hp  =$request->input('no_hp');
        $domain =$request->input('domain');

        if(!$request->input('domain'))
        {
           $alert='Domain belum di masukan';
            print json_encode(array('error'=>true,'alert'=>$alert));
            return; 
        }

            $newdomain    =str_replace('www.','',strtolower($domain));
            $newdomain    =str_replace('http.','',strtolower($newdomain));
            $newdomain    =str_replace('https.','',strtolower($newdomain));
            $newdomain    =str_replace('/','',strtolower($newdomain));

        if(@explode('.',$newdomain)[1]==null)
        {
            $alert='Bukan domain';
            print json_encode(array('error'=>true,'alert'=>$alert));
            return; 
        }
        $dt_hp      =DB::table('wa_account')
                        ->where('user_id',Auth::user()->id)
                        ->where('number',$no_hp)
                        ->first();

        $domain     =DB::table('tb_domain')->where('domain',$newdomain)->first();

        
        if($domain)
        {
            $alert='Domain wa sudah terdaftar';
            print json_encode(array('error'=>true,'alert'=>$alert));
            return;
        }  

        $data['id_no_hp']        =$dt_hp->id;
        $data['domain']         =$newdomain;
        $data['created_at']     = Carbon::now();
        $simpan= DB::table('tb_domain')->insert($data);
        print json_encode(array('error'=>false,'alert'=>'Simpan sukses'));
        return;


    }
    public function deleteDomain(Request $request)
    {
        $newdomain  =$request->input('dataid');
        DB::table('tb_domain')->where('id_domain',$newdomain)->delete();
        print json_encode(array('error'=>false,'alert'=>'Hapus data sukses'));
        return;
    }


    public function getsession(Request $request)
    {
        $id_user    =Auth::user()->id;
        $wa = DB::table('wa_account')
                ->select('session','token')
                ->where('user_id',$id_user)
                ->where('number', $request->input('id_wa'))
                ->first();
        print json_encode(array('token'=>$wa->token,'session'=>unserialize(@$wa->session)));
    }

     public function savesessionwa(Request $request)
    {
        $data       =json_decode(file_get_contents('php://input'),1);
        $session    =@serialize($data['session']);
        $id_user    =Auth::user()->id;
        $no_hp      =@$data['no_hp'];
        $error      =true;
       
        $wa         = DB::table('wa_account')
                        ->select('user_id','id','number','token')
                        ->where('number', @$no_hp)
                        ->where('user_id', @$id_user)
                        ->first();
                        

        if($wa)
        {
            $token   = md5($no_hp.$id_user.Carbon::now()); 
            $data    = array('user_id'     =>Auth::user()->id,
                                            'session'     =>$session,
                                            'updated_at'  =>Carbon::now(),
                                            'token'       =>$token);
                $wa_account = DB::table('wa_account')->where('id',$wa->id)->update($data);
                print json_encode(
                array(  'error'     =>false,
                        'id_wa'     =>$wa->id,
                        'number_wa' =>$no_hp,
                        'api_key'   =>$token)
                    );
       
        }
      
      
    }
    
    public function hapussesi(Request $request)
    {
         $wa_account   = DB::table('wa_account')
         ->where('number', $request->input('no_hp_hps'))
          ->where('user_id', Auth::user()->id)
         ->update(['session'=>NULL,'token'=>NULL]);
          print json_encode(array('error'=>false));
    }
    public function dokumentasiapi(Request $request)
    {
            $wa_account   = DB::table('wa_account')
            ->where('user_id', Auth::user()->id)
            ->where('status', 'aktif')
            ->whereNotNull('token')
            ->orderBy('id','DESC')
            ->get();
          return view('dashboard.wa.dokumentasiapi',compact('wa_account'))->with('title', 'Dokumentasi Api');
    }



    public function apiwhatsapp(Request $request)
    {
            dd($request);
            $number_phone   =$request->input('number_phone');
            $message        =$request->input('message'); 
            $token_         =$request->header('key');   
            $host           =$request->header('host'); 

          

            if($request->input('number_phone')=="" ||$request->input('message')=="")
            {
                print json_encode(array('error'=>true,'status'=>'anda belum melengkapi data'));
                return;
            }

            $wa     = DB::table('wa_account')->select('session','user_id','id')->where('token', $token_)->first();

            if(!$wa)
            {
                print json_encode(array('error'=>true,'status'=>'Token Tidak tersedia'));
                return;
            }
            $tb_domain     = DB::table('tb_domain')
            ->where('id_no_hp', $wa->id)
            ->where('domain','like', $host)->first();
            if(!$tb_domain)
            {
                print json_encode(array('error'=>true,'status'=>'domain tidak cocok'));
                return;
            }
            $masaakitif = Helpers::MasaAkit(@$wa->id);
            if(intval($masaakitif['hari'])<=0)
            {
                print json_encode(array('error'=>true,'status'=>'Masa aktif telah berahir'));
                return;
            }
                

            $client = new Client(new Version2X('https://app.pingnotif.com:8443'));
            $client->initialize();
            $client->emit('action', 
                    [
                        'session_wa' => json_encode(@unserialize(@$wa->session)),
                        'number_phone'=> $number_phone.'@c.us',
                        'message'=> $message
                    ]
                );
            $client->close(); 
            $data['id_wa']=@$wa->id;
            $data['no_tujuan']=@$nomor_hp;
            $data['isi_pesan']=@$pesan;
            $data['created_at']=Carbon::now();
            DB::table('history_wa')->insert($data);
           
           
            print json_encode(array('error'=>false,'status'=>'Pesan telah terkirim'));


    }
 public function kirim_wa_manual(Request $request)
    {

            $apikey        =$request->input('apikey');
            $nomor_hp      =$request->input('nomor_hp'); 
            $pesan         =$request->input('pesan');
          

            if($request->input('nomor_hp')=="" ||$request->input('pesan')=="")
            {
                print json_encode(array('error'=>true,'status'=>'anda belum melengkapi data'));
                return;
            }

            $wa     = DB::table('wa_account')->select('session','user_id','id')->where('token', $apikey)->first();
            if(!$wa)
            {
                print json_encode(array('error'=>true,'status'=>'Token Tidak tersedia'));
                return;
            }
            $masaakitif = Helpers::MasaAkit(@$wa->id);
            if(intval($masaakitif['hari'])<=0)
            {
                print json_encode(array('error'=>true,'status'=>'Masa aktif telah berahir'));
                return;
            }

            $client = new Client(new Version2X('https://app.pingnotif.com:8443'));
            $client->initialize();
            $client->emit('action', 
                    [
                        'session_wa' => json_encode(@unserialize(@$wa->session)),
                        'number_phone'=> $nomor_hp.'@c.us',
                        'message'=> $pesan
                    ]
                );

                $client->close();  
                $data['id_wa']=@$wa->id;
                $data['no_tujuan']=@$nomor_hp;
                $data['isi_pesan']=@$pesan;
                $data['created_at']=Carbon::now();
                DB::table('history_wa')->insert($data);
           
            
            print json_encode(array('error'=>false,'status'=>'Pesan telah terkirim'));
    }
   public function sendwa(Request $request)
    {  
             $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => "https://app.pingnotif.com/api-whatsapp",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "number_phone=6289605544341&message=Test Pesan Wa",
                CURLOPT_HTTPHEADER => array(
                    "key: da69c4a27f287ab2f27d526eee7d28e8",
                    "Content-Type: application/x-www-form-urlencoded",
                    "Host ".$_SERVER['SERVER_NAME']
                  ),
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                echo $response;

    }



}
