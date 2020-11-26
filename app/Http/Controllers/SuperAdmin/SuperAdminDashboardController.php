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
        $jumlahuser = DB::table('users')
            ->where('status_dev', '!=', 'superadmin')
            ->orWhere('status_dev', NULL)
            ->count();

        $jumlahwa = DB::table('wa_account')
            ->count();

        $jumlahpemasukan = DB::table('history_billing')
            ->select(DB::raw('SUM(nominal) as pemasukan'))
            ->where('status', 'lunas')
            ->get();

        $data = [
            "user" => $jumlahuser,
            "wa" => $jumlahwa,
            "pemasukan" => $jumlahpemasukan[0]->pemasukan
        ];

        return view('superadmin/dashboard/dashboard', compact('data'));
    }

    public function grafik_data()
    {
        // $data = DB::table('users')
        //     ->select(DB::raw('DATE(created_at) AS tanggal, COUNT(*) AS jumlah_harian'))
        //     ->where('status_dev', '!=', 'superadmin')
        //     ->orWhere('status_dev', NULL)
        //     ->groupBy('tanggal')
        //     ->orderBy('tanggal', 'ASC')
        //     ->orderBy('id', 'DESC')
        //     ->limit(7)
        //     ->get();

        $data_graf = [];

        for ($i = 0; $i < 7; $i++) {
            $data = DB::table('users')
                ->select(DB::raw('DATE(created_at) AS tanggal, COUNT(*) AS jumlah_harian'))
                ->where(DB::raw('DATE(created_at)'), DB::raw('SUBDATE(CURDATE(),' . $i . ')'))
                ->groupBy('tanggal')
                ->get();

            if ($data->count() > 0) {
                $data_graf[$i]["tanggal"] = $data[0]->tanggal;
                $data_graf[$i]["jumlah_harian"] = $data[0]->jumlah_harian;
            } else {
                $data_graf[$i]["tanggal"] = date('Y-m-d', strtotime(date('Y-m-d')) - (($i + 0) * 24 * 60 * 60));
                $data_graf[$i]["jumlah_harian"] = 0;
            }
        }

        return json_encode($data_graf, true);
    }
}
