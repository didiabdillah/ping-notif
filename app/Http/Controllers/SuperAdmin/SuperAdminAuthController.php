<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SuperAdminAuthController extends Controller
{
    public function index()
    {
        return view('auth/superadmin/login');
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'email'  => 'required|email:rfc,dns',
                'password'  => 'required'
            ],
            [
                'user_password.required' => 'The password field is required.',
                'email.required' => 'The username/email field is required.'
            ]
        );

        $email = $request->email;
        $password = $request->password;

        $user = DB::table('users')
            ->where('email', $email)
            ->first();

        if ($user) {
            if ($user->email == $email) {
                if (Hash::check($password, $user->password)) {

                    //buat Session User
                    $data = [
                        'id' => $user->id,
                        'status_dev' => $user->status_dev,
                        'name' => $user->name
                    ];

                    $request->session()->put($data);

                    if ($user->status_dev == "superadmin") {
                        return redirect('/test/dashboard');
                    } else {
                        return redirect('/superadmin/login');
                    }
                } else {
                    Session::flash('failed', 'Password Salah');
                    return redirect('/superadmin/login');
                }
            } else {
                Session::flash('failed', 'Email Salah');
                return redirect('/superadmin/login');
            }
        } else {
            Session::flash('failed', 'Akun Tidak Ditemukan');
            return redirect('/superadmin/login');
        }
    }

    public function logout()
    {
        Session::flush();
        Session::flash('failed', 'Logout Sukses');
        return redirect('/superadmin/login');
    }
}
