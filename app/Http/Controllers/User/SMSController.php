<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SMSController extends Controller
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
    public function index()
    {
        $wa = DB::table('sms_account')->where('user_id', Auth::user()->id)->orderBy('id','DESC')->paginate(10);
        return view('dashboard.sms.list', ['sms'=>$wa])->with('title', 'Nomor SMS');
    }

    public function tambah()
    {
        return view('dashboard.sms.tambah')->with('title', 'Tambah Nomor SMS');
    }

    public function simpan(Request $request)
    {
        $message = [
            'required' => 'Wajib diisi.'
        ];
        $validatedData = $request->validate([
            'number' => 'required'
        ], $message);

        $data['user_id']         = Auth::user()->id;
        $data['number']     = $request->input('number');
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        $id_bank = DB::table('sms_account')->insertGetId($data);

        return redirect()->route('sms')->with('berhasil', 'Berhasil ! Menambahkan Nomor SMS');
    }

    public function edit($id)
    {
        $decrypt=base64_decode($id);
        $id = substr($decrypt,4);
        $wa = DB::table('sms_account')->where('id', $id)->get();
        return view('dashboard.sms.edit', ['sms'=>$wa])->with('title', 'Edit Nomor SMS');
    }

    public function simpanedit(Request $request)
    {
        $message = [
            'required' => 'Wajib diisi.'
        ];
        $validatedData = $request->validate([
            'number' => 'required'
        ], $message);

        $data['number']     = $request->input('number');
        $data['updated_at'] = Carbon::now();

        $id_bank = DB::table('sms_account')->where('id', $request->input('id'))->update($data);

        return redirect()->route('sms')->with('berhasil', 'Berhasil ! Mengedit Nomor SMS');
    }

    public function hapus(Request $request)
    {
        $decrypt=base64_decode($request->input('id'));
        $id = substr($decrypt,4);
        $wa = DB::table('sms_account')->where('id', $id)->delete();
        // return redirect()->route('sms')->with('berhasil', 'Berhasil ! Menghapus Nomor SMS');
        print json_encode(array('statusabsen'=> $id));
    }
}
