<?php
namespace App\Helpers;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
class Helpers
{

	public static function str_endcode($str)
	{
		return  stripslashes(strip_tags(htmlspecialchars($str,ENT_QUOTES)));
	}

	public static function paginator($database,$perPage=1,$page=1)
    {
            $collection     =  collect($database);
            $page           =  request('page',$page);
            $perPage        =  request('show',$perPage);
            $pageend        =  0;
            $dataall        =$collection->count();
            $paginator      = new LengthAwarePaginator($collection->forPage($page, $perPage), $dataall, $perPage, $page, ['path'=>'']);
            return $paginator;

    }

	public static function keIndonesia($Carbon,$date=false,$time=false)
	{
		
		if(preg_match("/[a-z]/", $Carbon)==true)
		{
			return;
		}
		$dt = new Carbon($Carbon);

		setlocale(LC_TIME, 'IND');
		if($date==true && $time==false)
		{

			$tanggal='%d %B %Y';
			return $dt->formatLocalized($tanggal);
		}
		elseif($date==true && $time==true)
		{
			$tanggal='%d %B %Y %H:%M:%S';
			return $dt->formatLocalized($tanggal);
		}
		elseif($date==false && $time==true)
		{
			$tanggal='%H:%M:%S';
			return $dt->formatLocalized($tanggal);
		}
		elseif($date==false && $time==false)
		{
			$tanggal='%d %B %Y %H:%M:%S';
			return $dt->formatLocalized($tanggal);
		}

		
	}
   public static function Waktu_History($date)
	{
		

		$dateend 		=Carbon::now()->format('Y-m-d H:i:s');
		$datestar 		=Carbon::parse($date)->format('Y-m-d H:i:s');
		$selisihWaktu 	=Helpers::mktimeWaktu($datestar,$dateend);
		$selisihWaktu 	=Helpers::RentanWaktu($selisihWaktu);
		$waktu 			='';

		if($selisihWaktu['jam'] < 24)
		{

		      	if($selisihWaktu['jam'] <1)
		      	{
					$waktu=$selisihWaktu['menit'].' Menit yang lalu';
		      	}
		      	else
		      	{
		      		$waktu=$selisihWaktu['jam'].' Jam yang lalu';
		      	}
		}
		else
		{
		  	$hari=ceil($selisihWaktu['jam']/24);
		  	if($hari<7)
		  	{
		  		$waktu=$hari.' Hari yang Lalu';

		  	}
		  	else
		  	{
		  		$waktu=Helpers::keIndonesia($datestar,true,false);
		  	}
		}

		return $waktu;


	}        

    public static function formatBytes($size, $precision = 2)
    {
        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        } else {
            return $size;
        }
    }
public static function potong_dekripsi($deskripsi,$jml=200)
	{
			$deskripsi_perusahaan_sm    =@str_replace('\"',"",substr(preg_replace("/[\n\r]/","",@html_entity_decode(@$deskripsi)),0,$jml));
			return $deskripsi_perusahaan_sm;
	}

	public static function keIndonesiaa($Carbon,$date=false,$time=false)
	{
if(preg_match("/[a-z]/", $Carbon)==true)
		{
			return;
		}
		$dt = new Carbon($Carbon);
		setlocale(LC_TIME, 'IND');
		if($date==true && $time==false)
		{

			$tanggal='%B %Y';
			return $dt->formatLocalized($tanggal);
		}
		elseif($date==true && $time==true)
		{
			$tanggal='%d %B %Y %H:%M:%S';
			return $dt->formatLocalized($tanggal);
		}
		elseif($date==false && $time==true)
		{
			$tanggal='%H:%M:%S';
			return $dt->formatLocalized($tanggal);
		}
		elseif($date==false && $time==false)
		{
			$tanggal='%d %B %Y %H:%M:%S';
			return $dt->formatLocalized($tanggal);
		}

		
	}

public static function create_mktimeWaktu($datestar)
	{
		$start 			= 	new Carbon($datestar);
	
		//mktime(date("H"), date(“i”), date(“s”), date(“m”), date(“d”), date(“Y”));
		$jam_start 		=	$start->format('H');
		$menit_start 	=	$start->format('i');
		$detik_start 	=	$start->format('s');
		$bulan_start 	=	$start->format('m');
		$hari_start 	=	$start->format('d');
		$tahun_start 	=	$start->format('Y');
		$waktu_start 	= 	mktime($jam_start,$menit_start,$detik_start,$bulan_start,$hari_start,$tahun_start);
	
	
		return $waktu_start;
	}

	public static function mktimeWaktu($datestar,$dateend)
	{
		$start 			= 	new Carbon($datestar);
		$end 			= 	new Carbon($dateend);
		//mktime(date("H"), date(“i”), date(“s”), date(“m”), date(“d”), date(“Y”));
		$jam_start 		=	$start->format('H');
		$menit_start 	=	$start->format('i');
		$detik_start 	=	$start->format('s');
		$bulan_start 	=	$start->format('m');
		$hari_start 	=	$start->format('d');
		$tahun_start 	=	$start->format('Y');

		$jam_end 		=	$end->format('H');
		$menit_end 		=	$end->format('i');
		$detik_end 		=	$end->format('s');
		$bulan_end 		=	$end->format('m');
		$hari_end 		=	$end->format('d');
		$tahun_end 	 	=	$end->format('Y');
		$waktu_start 	= 	mktime($jam_start,$menit_start,$detik_start,$bulan_start,$hari_start,$tahun_start);
		$waktu_end 		= 	mktime($jam_end,$menit_end,$detik_end,$bulan_end,$hari_end,$tahun_end);
		$selisih_waktu	= 	$waktu_end-$waktu_start;
		return $selisih_waktu;
	}
	public static function RentanWaktu($selisih_waktu)
	{


				$rangeWaktu['hari'] 	= floor(($selisih_waktu/86400));
				$sisa 					= $selisih_waktu % 86400;
				$rangeWaktu['jam'] 		= floor($sisa/3600);
				$sisa 					= $selisih_waktu % 3600;
				$rangeWaktu['menit'] 	= floor($sisa/60);
				$sisa 					= $sisa % 60;
				$rangeWaktu['detik'] 	= floor($sisa/1);


				return $rangeWaktu;

	}
	

	public static function NamaHari($Carbon)
	{

		$dt = new Carbon($Carbon);
		setlocale(LC_TIME, 'IND');
		$namahari =$dt->format('D');
		switch ($namahari) {
				case 'Mon':
					return 'Senin';
				break;
				case 'Tue':
				return 'Selasa';
				break;
				case 'Wed':
				return 'Rabu';
				break;
				case 'Thu': 
				return 'Kamis';
				break;
				case 'Fri':
				return 'Jum\'at';
				break;
				case 'Sat':
				return 'Sabtu';
				break;
				case 'Sun':
				return 'Minggu';
				break;
		}

	}

	public static function nama_hari($nama){
		switch ($nama) {
				case 'Mon':
					return 'Senin';
				break;
				case 'Tue':
				return 'Selasa';
				break;
				case 'Wed':
				return 'Rabu';
				break;
				case 'Thu': 
				return 'Kamis';
				break;
				case 'Fri':
				return 'Jum\'at';
				break;
				case 'Sat':
				return 'Sabtu';
				break;
				case 'Sun':
				return 'Minggu';
				break;
				default:
					return $nama;
				break;
		}
	}
	public static function Bulan_tahun($Carbon,$tahun=false)
	{
		$dt = new Carbon($Carbon);
		setlocale(LC_TIME, 'IND');

		$show[0]='%B';
		if($tahun==true)
		{
			$show[1]='%Y';
		}
		$date=implode(' ',$show);
		return $dt->formatLocalized($date);
	}
	public static function rupiah($rp)
	{
		return $rp!=0?'Rp '.number_format($rp,0,'.','.').',-':0;
		
	}
	


 public static function HM($hm)
     {   
     	
     	 $hm=explode(':',$hm);
     	 if(!$hm)
     	 {
			return '-';
     	 } 
     	 else
     	 {
     	 	$hm=@$hm[0].':'.@$hm[1];
     	 	if($hm==':')
     	 	{
     	 		return '-';
     	 	}
     	 	return $hm;
     	 }
     	 

     }
public static function JamMenit($hm)
     {   
     	
     	 $hm=explode(':',$hm);
     	 if(!$hm)
     	 {
			return '-';
     	 } 
     	 else
     	 {
     	 	@$h[0]=@$hm[0]!=0?@$hm[0].' Jam':'';
			@$h[1]=@$hm[1]!=0?@$hm[1].' Menit':'';
     		$hm=implode(' ',$h);
     		if($hm==' ')
     		{
			return '-';
     		}
     	 	return $hm;
     	 }
     	 

     }

 public static function makecircle_image_map($image,$_url,$urlasal)
     { 
		
  		$img    =  Image::make(public_path($urlasal.'/'.$image));
        $img->resize(300, 300, function ($constraint){});
        $width  = $img->getWidth();
        $height = $img->getHeight();
        $mask   = Image::canvas($width, $height);
        // draw a white circle
        $mask->circle($width, $width/2, $height/2, function ($draw) {$draw->background('#fff');});
        $img->mask($mask, false);
        $extensi 	=explode('.',$image);
        $image 		=$extensi[1]=='jpg'?$extensi[0].'.png':$image;
        $img->save(public_path($_url.'/'.$image));
    }


 	public static function int($s){return($a=preg_replace('/[^\-\d]*(\-?\d*).*/','$1',$s))?$a:'0';}

	public static function Upload_gambar($files,$dir_save_original,$dir_save_small="")
	{
	        
			$dt                     = Carbon::now();
			$filename               = rand(1111,9999).'-'.$dt->format('YmdHis').'.png';           
			if($dir_save_small!='')
			{
				$filesmall              = Image::make($files->getRealPath());
				$filesmall->resize(600, null, function ($constraint) 
				{
					$constraint->aspectRatio();
					$constraint->upsize();
				});
	       		$filesmall->save($dir_save_small.'\\'.$filename);
			}
			
	        $filelarge              = Image::make($files->getRealPath());   
	        $filelarge->save($dir_save_original.'\\'.$filename);
	      	return $filename;
	}

	
   public static function create_folder_user($id) 
    {
    	
		$profile   			= 'images\\'.$id.'\\user';
		$user  				= 'images\\'.$id.'\\dokumen';
		$usertumb  			= 'images\\'.$id.'\\thumbnail';

		$cek_profile 		= file_exists(public_path($profile));
		$cek_user 	 		= file_exists(public_path($user));
		$cek_usertumb 		= file_exists(public_path($usertumb));
		

		if(!$cek_profile){mkdir(public_path($profile), 7777, true);}
		if(!$cek_user){mkdir(public_path($user), 7777, true);}
		if(!$cek_usertumb){mkdir(public_path($usertumb), 7777, true);}

		$data['profile']	=public_path($profile);
		$data['document'] 	=public_path($user);
		$data['usertumb'] 	=public_path($usertumb);

		return $data;
    }
 

 	public static function tambahsaldo($id_user,$id_history)
     {
        $sukses             =false;
        $tb_saldo          =DB::table('tb_saldo')->where('id_user',@$id_user)->first();
        $history_billing   =DB::table('history_billing')
                                ->where('status','=','lunas')
                                ->where('id_his_bill',@$id_history)->first();

         if(!$history_billing)
         {
         	return $sukses;
         } 
         switch ($history_billing->status_akses) {
         	case 'kredit':
         		$pemakaian_saldo =250000;
				$penambahan_saldo =intval($history_billing->nominal)-250000;
         		break;
         	default:
         		$pemakaian_saldo =0;
         		$penambahan_saldo =intval($history_billing->nominal);
         		break;
         }
         //$item_debit =DB::table('item_debit')->where('id_his_bill',@$history_billing->id_his_bill)->first();

         if($tb_saldo)
        {
 			$ttlsaldo 		=@$tb_saldo->nominal+$penambahan_saldo;
            $smpn_saldo     =DB::table('tb_saldo')->where('id_user',@$id_user)->update(['nominal'=>@$ttlsaldo]);
        }
        else
        {
        	$ttlsaldo 		=$penambahan_saldo ;
            $smpn_saldo     =DB::table('tb_saldo')->insert(
                                [
                                    'nominal'   =>@$ttlsaldo,
                                    'id_user'   =>@$id_user,
                                    'created_at'=>Carbon::now()
                                ]
                            );
        }
        if($smpn_saldo)
        {
            DB::table('item_debit')->insert(['id_his_bill'=>@$id_history]);
            $sukses=true;
        }
        return $sukses;


     }

     public static function pengurangansaldo($id_user,$id_history)
     { 
     	
        $tb_saldo          =DB::table('tb_saldo')->where('id_user',@$id_user)->first();
        $saldo             =@$tb_saldo->nominal?@$tb_saldo->nominal:0;
        $history_billing   =DB::table('history_billing')
                                ->where('status','=','pending')
                                ->where('id_his_bill',@$id_history)->first();

        if(!$history_billing)
        {
        	return false;
        }
        $tambahan_saldo    =@$history_billing->nominal?@$history_billing->nominal:0;
        $ttlsaldo          =$saldo-$tambahan_saldo;  
 		if($ttlsaldo<0)
        {
            return false;
        }
        
        if($tb_saldo)
        {
            $smpn_saldo        =DB::table('tb_saldo')->where('id_user',@$id_user)->update(['nominal'=>@$ttlsaldo]);
        }
        else
        {
            $smpn_saldo        =DB::table('tb_saldo')->insert(
                                [
                                    'nominal'   =>@$ttlsaldo,
                                    'id_user'   =>@$id_user,
                                    'created_at'=>Carbon::now()
                                ]
                            );
        }
        DB::table('history_billing')->where('id_his_bill',@$id_history)->update(['status'=>'lunas']);
		return true;
     }
	public static function TambahmasaAktif($id_wa,$jmlh_paket)
	{
		$date_now 		=Carbon::now();
		$ms_atif 		=Helpers::MasaAkit($id_wa)['hari'];
		$ms_atif 		=$ms_atif<0?1:$ms_atif;
		$jmlh_paket 	=$jmlh_paket+$ms_atif;
		$date_end  		= $date_now->addDays($jmlh_paket);
		$tb_billing 	=DB::table('tb_billing')->where('id_wa',@$id_wa)->update(['masa_aktif'=>$date_end]);
		return $tb_billing ;
	}

     public static function MasaAkit($id)
     {
     	$tb_billing 			=DB::table('tb_billing') ->where('id_wa',@$id)->first();
     	$date_now 				=Carbon::now()->format('Y-m-d H:i:s');
        $wa    		 			=DB::table('wa_account')->select('created_at')->where('id',@$id)->first();
        $created_at 			=Carbon::parse(@$wa->created_at);
        $created_at 			=$created_at->addDays(8);
        $MasaAkit 				=@$tb_billing->masa_aktif!=null?@$tb_billing->masa_aktif:$created_at;
        $trial 		 			=@$tb_billing->masa_aktif!=null?true:false;
		$selisih  				=Helpers::mktimeWaktu($date_now,$MasaAkit);
        $rentanwaktu_mk 		=Helpers::RentanWaktu($selisih);
       	$data 					=[];
       	$data['tgl_expired'] 	=$MasaAkit;
       	$data['trial']			=$trial;
       	$data['hari'] 			=ceil($rentanwaktu_mk['hari']);

		return 	$data;
     }
	public static function create_paket($id_wa,$user_id)
    {
        $error          =true;
        $kd_unik        =intval(substr(str_shuffle('123456789987654321'),0,3));
        $paket  		=250000;
        $jmlh_paket     =30;
        $tanggal_order  =Carbon::now();
        $dt_biling      =DB::table('tb_billing')->where('id_wa',$id_wa)->first();
		$id_biling      =@$dt_biling->id_billing;
        if(!$dt_biling)
        {

            $data['created_at'] =$tanggal_order;
            $data['id_wa']      =$id_wa;
            $data['id_user']    =$user_id;
            $id_biling          =DB::table('tb_billing')->insertGetId($data,'id_billing'); 
        }

 		
        $db_saldo          = DB::table('tb_saldo')->where('id_user',$user_id)->first();
        $nominal_saldo     = @$db_saldo->nominal?@$db_saldo->nominal:0;

        $id_invoice                 ='Inv-'.$user_id.$id_biling.Carbon::now()->format('ymdhis');
        $data_his['id_user']        =@$user_id;
        $data_his['id_wa']         	=@$id_wa;
        $data_his['created_at']     =Carbon::now();
        $data_his['id_invoice']     =$id_invoice;
		$hargattl 					=$paket+$kd_unik;
        $data_his['kd_unik']     =$kd_unik;
        $data_his['nominal']        =intval($hargattl);
        $data_his['status_akses']   ='kredit';   
        $data_his['status']         =intval($paket)<$nominal_saldo?'lunas':'pending';
        

        $id_his_bil 	     		=DB::table('history_billing')->insertGetId($data_his,'id_his_bill'); 
        if($id_his_bil)
        { 
        	$status             =Helpers::pengurangansaldo($user_id,@$id_his_bil); 
	        if($status)
	        {
	            Helpers::TambahmasaAktif($user_id,$jmlh_paket);
	        }

        } 
       

    }


}