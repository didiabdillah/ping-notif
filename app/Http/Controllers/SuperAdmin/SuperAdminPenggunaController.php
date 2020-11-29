<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SuperAdminPenggunaController extends Controller
{
    public function index()
    {
        $wa = DB::table('users')
            ->select('users.name', DB::raw('DATE(users.created_at) as daftar'), DB::raw('COUNT(wa_account.user_id) as jumlah_wa'))
            ->leftJoin('wa_account', 'users.id', '=', 'wa_account.user_id')
            ->groupBy('users.name')
            ->groupBy('daftar')
            ->orderBy('users.name', 'asc')
            ->get();

        return view('superadmin/pengguna/index', ['data' => $wa]);
    }
}
