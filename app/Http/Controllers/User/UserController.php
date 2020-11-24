<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Redirect;

class UserController extends Controller
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
        $user = DB::table('users')->where('id_owner', Auth::user()->id)->orderBy('id','DESC')->paginate(10);
        return view('dashboard.user.list', ['user'=>$user])->with('title', 'User');
    }

    public function tambah()
    {
        return view('dashboard.user.tambah')->with('title', 'Tambah User');
    }

    public function simpan(Request $request)
    {
        $message = [
            'required' => 'Wajib diisi.',
            'unique' => 'Email sudah terpakai.',
            'email' => 'Email tidak valid.',
            'image' => 'File harus berbentuk gambar.',
            'max' => 'Maksimal besar file :max mb.',
            'confirmed' => 'Password tidak sama'

        ];

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:mysql.users',
            'password' => 'required||confirmed|min:8',
            'hak_akses_wa' => 'required',
            'hak_akses_sms' => 'required'
        ], $message);

        $data['name']           = $request->input('name');
        $data['email']          = $request->input('email');
        $data['password']       = Hash::make($request->input('password'));
        $data['status_user']    = 'user';
        $data['status_dev']     = 'user';
        $data['id_owner']       = Auth::user()->id;
        $data['hak_akses_wa']   = serialize($request->input('hak_akses_wa'));
        $data['hak_akses_sms']  = serialize($request->input('hak_akses_sms'));
        $data['created_at']     = Carbon::now();
        $data['updated_at']     = Carbon::now();

        $id_user = DB::table('users')->insertGetId($data);

        return redirect()->route('user')->with('berhasil', 'Berhasil ! Anda menambahkan user');

    }

    public function edit($id)
    {
        $decrypt=base64_decode($id);
        $id = substr($decrypt,5);
        $user = DB::table('users')->where('id', $id)->get();
        return view('dashboard.user.edit', ['user'=>$user])->with('title', 'Edit User')->with('id', $id);
    }

    public function simpanedit(Request $request)
    {
        $message = [
            'required' => 'Wajib diisi.',
            'unique' => 'Email sudah terpakai.',
            'email' => 'Email tidak valid.',
            'image' => 'File harus berbentuk gambar.',
            'max' => 'Maksimal besar file :max mb.',
            'confirmed' => 'Password tidak sama'

        ];

        $user = DB::table('users')->where('id', $request->input('id'))->first();
        if($user->email == $request->input('email')){
            if($request->input('password') == null){
                $validatedData = $request->validate([
                    'name' => 'required',
                    'hak_akses_wa' => 'required',
                    'hak_akses_sms' => 'required'
                ], $message);
            }
            else {
                $validatedData = $request->validate([
                    'name' => 'required',
                    'password' => 'required||confirmed|min:8',
                    'hak_akses_wa' => 'required',
                    'hak_akses_sms' => 'required'
                ], $message);
                $data['password']       = Hash::make($request->input('password'));
            }
        }
        else {
            if($request->input('password') == null){
                $validatedData = $request->validate([
                    'name' => 'required',
                    'email' => 'required|email|unique:mysql.users',
                    'hak_akses_wa' => 'required',
                    'hak_akses_sms' => 'required'
                ], $message);
            }
            else {
                $validatedData = $request->validate([
                    'name' => 'required',
                    'email' => 'required|email|unique:mysql.users',
                    'password' => 'required||confirmed|min:8',
                    'hak_akses_wa' => 'required',
                    'hak_akses_sms' => 'required'
                ], $message);
                $data['password']       = Hash::make($request->input('password'));
            }
        }

        $data['name']           = $request->input('name');
        $data['email']          = $request->input('email');
        $data['status_user']    = 'user';
        $data['status_dev']     = 'user';
        $data['id_owner']       = Auth::user()->id;
        $data['hak_akses_wa']   = serialize($request->input('hak_akses_wa'));
        $data['hak_akses_sms']  = serialize($request->input('hak_akses_sms'));
        $data['updated_at']     = Carbon::now();

        $id_user = DB::table('users')->where('id', $request->input('id'))->update($data);

        return redirect()->route('user')->with('berhasil', 'Berhasil ! Anda mengedit user');
    }

    public function hapus(Request $request)
    {
        $decrypt=base64_decode($request->input('id'));
        $id = substr($decrypt,5);
        $wa = DB::table('users')->where('id', $id)->delete();
        // return redirect()->back()->with('berhasil', 'Berhasil ! Menghapus user');
        print json_encode(array('statusabsen'=>'sukses'));
    }
}
