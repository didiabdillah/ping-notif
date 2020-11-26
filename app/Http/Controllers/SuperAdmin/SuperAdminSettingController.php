<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SuperAdminSettingController extends Controller
{
    public function index()
    {
        $setting = DB::table('users')
            ->where('id', Session::get('id'))
            ->select('id', 'name', 'email')
            ->first();

        return view('SuperAdmin/setting/setting', compact('setting'));
    }

    public function edit(Request $request)
    {
        $request->validate(
            [
                'email'  => 'required|email:rfc,dns',
                'name'  => 'required'
            ],
            [
                'name.required' => 'The name field is required.',
                'email.required' => 'The email field is required.',
                'email.email' => 'The email field is wrong format.'
            ]
        );

        dd($request);
        return redirect()->back();
    }

    public function ubahpassword(Request $request)
    {
        $request->validate(
            [
                'passwordLama'  => 'required',
                'passwordBaru'  => 'required',
                'konfirmasiPassword'  => 'required|same:passwordBaru'
            ],
            [
                'passwordLama.required' => 'The Password Lama field is required.',
                'passwordBaru.required' => 'The Password Baru field is required.',
                'konfirmasiPassword.required' => 'The Konfirmsi Password field is required.',
                'konfirmasiPassword.same' => 'The Konfirmsi Password field is different.'
            ]
        );

        dd($request);
        return redirect()->back();
    }
}
