<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SuperAdminDashboardController extends Controller
{
    public function index()
    {
        $data = DB::table('users')
            ->select(DB::raw('DATE(created_at) AS tanggal, COUNT(*) AS jumlah_harian'))
            ->where('status_dev', '!=', 'superadmin')
            ->orWhere('status_dev', NULL)
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'ASC')
            ->orderBy('id', 'DESC')
            ->limit(7)
            ->get();

        return view('superadmin/dashboard/dashboard', ['data' => json_encode($data)]);
    }

    public function grafik_data()
    {
        $data = [
            "abc" => 123,
            "def" => 456
        ];

        json_encode($data);
    }
}
