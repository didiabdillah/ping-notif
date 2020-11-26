<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SuperAdminBillingController extends Controller
{
    public function index()
    {
        $billing = DB::table('tb_billing')
            ->select('wa_account.number', 'users.name', 'tb_billing.id_billing', 'tb_billing.masa_aktif', DB::raw('DATE(tb_billing.created_at) AS awal'))
            ->join('users', 'tb_billing.id_user', '=', 'users.id')
            ->join('wa_account', 'tb_billing.id_wa', '=', 'wa_account.id')
            ->orderBy('tb_billing.id_billing', 'desc')
            ->get();


        // $pengguna = DB::table('users')
        //     ->select('users.name', DB::raw('DATE(users.created_at) as daftar'), DB::raw('COUNT(wa_account.user_id) as jumlah_wa'))
        //     ->leftJoin('wa_account', 'users.id', '=', 'wa_account.user_id')
        //     ->groupBy('users.name')
        //     ->groupBy('daftar')
        //     ->orderBy('user.name', 'asc')
        //     ->get();

        return view('superadmin/billing/billing', compact('billing'));
    }
}
