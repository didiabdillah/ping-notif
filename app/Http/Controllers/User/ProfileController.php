<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use File;
use Illuminate\Support\Str;

class ProfileController extends Controller
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
        return view('dashboard.profile.profile')->with('title', 'Profile');
    }

    public function simpan(Request $request) {

        $message = [
            'required' => 'Wajib diisi.',
            'unique' => 'Email sudah terpakai.',
            'email' => 'Email tidak valid.',
            'image' => 'File harus berbentuk gambar.',
            'max' => 'Maksimal besar file :max mb.',
            'confirmed' => 'Password tidak sama'
        ];

        $cek_email = DB::table('users')->where('id', Auth::user()->id)->where('email', $request->input('email'))->first();
        if($cek_email){
            if($request->input('password') == ''){
                $validatedData = $request->validate([
                        'name' => 'required',
                        'email' => 'required|email',
                ], $message);
            }
            else {
                $validatedData = $request->validate([
                        'name' => 'required',
                        'email' => 'required|email',
                        'password' => 'min:8|confirmed',
                ], $message);
            }
        }
        else {
            if($request->input('password') == ''){
                $validatedData = $request->validate([
                        'name' => 'required',
                        'email' => 'required|email|unique:mysql.users',
                ], $message);
            }
            else {
                $validatedData = $request->validate([
                        'name' => 'required',
                        'email' => 'required|email|unique:mysql.users',
                        'password' => 'min:8|confirmed',
                ], $message);
            }
        }
        $datauser['name']           = $request->input('name');
        $datauser['email']          = $request->input('email');
        if($request->input('password') != '') {
            $datauser['password']   = Hash::make($request->input('password'));
        }
        $datauser['updated_at']     = Carbon::now();

        DB::table('users')->where('id', Auth::user()->id)->update($datauser);

        return redirect()->route('profile')->with('berhasil', 'Berhasil ! Anda Mengedit Profile');
    }
}
