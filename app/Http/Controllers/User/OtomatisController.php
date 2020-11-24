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

class OtomatisController extends Controller
{
  
    public function pesanotomatis(Request $request)
    {
        $i=0;
        $dt_list=DB::table('tb_pesan_otomatis')->where('id_user',Auth::user()->id)->orderBy('id_otomatis','DESC')->paginate(10);
        foreach($dt_list as $key)
        {       
                $nowa                       =DB::table('wa_account')->select('number')->where('id',$key->id_wa)->first();
                $dt_list[$i]->nomor         =@$nowa->number;
                $dt_list[$i]->pesan         =Helpers::potong_dekripsi($key->pesan,20);
                $dt_list[$i]->pesanori      =$key->pesan;
                $dt_list[$i]->tgl_terbit    =Helpers::keindonesia($key->tanggal_terbit,true,false);
                $dt_list[$i]->jam_terbit    =Helpers::HM($key->waktu);
                $dt_list[$i]->setiap_waktu  =$key->setiap_waktu;
                $dt_list[$i]->status        =$key->status;
                $dt_list[$i]->nomor_kirim_wa=unserialize($key->nomor_kirim_wa);
                $i++;
        }
        return view('dashboard.pesanOtomatis.list_pesan_otomatis',compact('dt_list'))->with('title', 'Pesan Otomatis');
    }

    public function simpan_pesan_otomatis(Request $request)
    {
        $alert ='';
        $error=true;
        $alert .=$request->input('pesan')?'':'<li>Pesan wajib di isikan</li>';
        $alert .=$request->input('id_wa')?'':'<li>Nomor WA pengirim wajib di isikan</li>';
        $alert .=$request->input('no_tujuan')?'':'<li>Nomor WA tujuan wajib di isikan</li>';
        $alert .=$request->input('tanggal_terbit')?'':'<li>Tanggal terbit wajib di isikan</li>';
        $alert .=$request->input('jam')?'':'<li>Jam wajib di isikan</li>';
        $alert .=$request->input('menit')?'':'<li>Menit wajib di isikan</li>';
        if($alert!='')
        {
            $alert ='<ul>'.$alert.'</ul>';
            print json_encode(array('error'=>$error,'alert'=>$alert));
            return ;
        }


        $data['id_wa']          = $request->input('id_wa');
        $data['waktu']          = $request->input('jam').':'. $request->input('menit').':00';
        $data['tanggal_terbit'] = $request->input('tanggal_terbit');
        $data['nomor_kirim_wa'] = serialize($request->input('no_tujuan'));
        $data['pesan']          = $request->input('pesan');
        $data['id_user']        = Auth::user()->id;
        $data['status']         =$request->input('status')?'aktif':'non_aktif';
        $data['setiap_waktu']   =$request->input('setiap_waktu')?'ya':'tidak';
        if($request->input('id_otomatis'))
        {
            $simpan                 = DB::table('tb_pesan_otomatis')->where('id_otomatis',$request->input('id_otomatis'))->update($data);
            
        }
        else
        {
            $data['created_at']     = Carbon::now();
            $simpan                 = DB::table('tb_pesan_otomatis')->insert($data);
        }

        if($simpan)
        {
            $error=false;
            $alert='Berhasil menambahkan pesan otomatis';
        }
        print json_encode(array('error'=>$error,'alert'=>$alert));
    return ;

        

    }





}
