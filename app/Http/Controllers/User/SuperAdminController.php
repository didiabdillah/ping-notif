<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; 
use Helpers;
class SuperAdminController extends Controller
{
  
    public function index(Request $request)
    { 
        $p                  = $request->input('page')? $request->input('page'):0;

        $take               = 15;
        $p                  = $p<=1?0:(($p*$take)-$take);
        $id_user            = Auth::user()->id;
        $data               = DB::table('users');
                              $data->selectRaw('users.id, users.name, users.email, users.created_at,  
                                COUNT(DISTINCT(CASE WHEN status = \'pending\' THEN id_user END)) as  konf');
                                $data->leftJoin('tb_konfirmasi','users.id','=','tb_konfirmasi.id_user');
                                $data->groupBy('users.id');
                                $data->groupBy('users.name');
                                $data->groupBy('users.email');
                                $data->groupBy('users.created_at');
                                $data->orderBy('users.id','DESC');
                              $data->skip($p);
                              $data->take($take);
                              if($request->input('cari'))
                              {
                                $data->where('name','like','%'.$request->input('cari').'%');
                              }
                              $data->orderBy('id','DESC');
        $users              = $data->get();
        $i                  = 0;
        $pg_users           = DB::table('users')
                              ->orderBy('id','DESC')->get();
        $paginator          = Helpers::paginator($pg_users,$take);  
        $cari               =$request->input('cari');           
        return view('admin.admin',compact('users','paginator','cari'))->with('title', 'list user | Admin');
    }

  
    public function billing(Request $request)
    {
        //return view('admin.admin')->with('title', 'Admin');
    }

    public function konfirmasi(Request $request)
    {
        //return view('admin.admin')->with('title', 'Admin');
    }
    public function detail_user(Request $request)
    {
        $id_user        =$request->input('id_user');
        $saldo          =DB::table('tb_saldo')->select('nominal')->where('id_user',$id_user)->first();
        $saldo          =@$saldo->nominal?Helpers::rupiah($saldo->nominal):Helpers::rupiah(0);
        $dt_tagihan     =DB::table('users')
                        ->leftJoin('history_billing','users.id','=','history_billing.id_user')
                        ->where('users.id','=',$id_user)
                        ->where('history_billing.status','=','pending')
                        ->sum('history_billing.nominal');
                        $tagihan     =@$dt_tagihan?Helpers::rupiah(@$dt_tagihan):0;
        $datawa             =DB::table('wa_account')->where('user_id','=',$id_user)->count();
        $tb_konfirmasi     =DB::table('tb_konfirmasi')->where('status','=','pending')->where('id_user','=',$id_user)->orderBy('id_konfirmasi','DESC')->limit(3)->get();
    
        $i      =0;
        foreach ($tb_konfirmasi as $key) {
           $tb_konfirmasi[$i]->tanggal_transfer =Helpers::keIndonesia($key->tanggal_transfer,true,false);
           $tb_konfirmasi[$i]->created_at       =Helpers::keIndonesia($key->created_at,true,false);
           $tb_konfirmasi[$i]->bukti            = asset('images/'.$id_user.'/dokumen/'.$key->bukti);
           $i++;
        }
        $wa_account     =DB::table('wa_account')->select('number','id')->where('status','aktif')->where('user_id','=',$id_user)->orderBy('id','DESC')->limit(15)->get();
        $i      =0;
        foreach ($wa_account as $key) {
            $ms=Helpers::MasaAkit($key->id);
           $wa_account[$i]->masa_aktif       =$ms['hari'];
           $wa_account[$i]->status_langganan = $ms['trial'];
           $i++;
        }
        print json_encode(array('wa_account'=>$wa_account,'saldo'=>$saldo,'tagihan'=>$tagihan,'datawa'=>$datawa,'tb_konfirmasi'=>$tb_konfirmasi));
        return;
        
    }

    public function konfirmasi_manual(Request $request)
    {
        $id_hist=DB::table('tb_konfirmasi')->select('id_his_bill','id_user')->where('id_konfirmasi','=',$request->input('id_konfirmasi'))->first();
        switch ($request->input('sts_aksi')) 
        {
            case 'Batalkan':
                DB::table('tb_konfirmasi')->where('id_konfirmasi','=',$request->input('id_konfirmasi'))->update(['status'=>'batal']);
                DB::table('history_billing')->where('id_his_bill','=',$id_hist->id_his_bill)->update(['status'=>'pending']);
                print json_encode(array('error'=>false,'alert'=>'Anda telah membatalkan data konfirmasi manual ini.'));
                return;
            break;
            case'Masukan':
                DB::table('tb_konfirmasi')->where('id_konfirmasi','=',$request->input('id_konfirmasi'))->update(['status'=>'sukses']);
                DB::table('history_billing')->where('id_his_bill','=',$id_hist->id_his_bill)->update(['status'=>'lunas']);
                $tambahsaldo=Helpers::tambahsaldo($id_hist->id_user,$id_hist->id_his_bill);
                if($tambahsaldo)
                {
                    $dt=DB::table('history_billing')->select('id_wa')->where('id_his_bill',$id_hist->id_his_bill)->first();
                    Helpers::TambahmasaAktif($dt->id_wa,30);
                }
                print json_encode(array('error'=>false,'alert'=>'berhasil menambahkan masa aktif.','id_user'=>$id_hist->id_user));
                return;
            break;
        }

    }
    
    




}
