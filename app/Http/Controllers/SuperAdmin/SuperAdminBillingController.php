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
        $total = DB::table('history_billing')
            ->select(DB::raw('SUM(nominal) as total'))
            ->where('status', 'lunas')
            ->get();

        $bulanan = DB::table('history_billing')
            ->select(DB::raw('SUM(nominal) as total'))
            ->where(DB::raw('MONTH(created_at)'), DB::raw('MONTH(CURDATE())'))
            ->where('status', 'lunas')
            ->get();

        $mingguan = DB::table('history_billing')
            ->select(DB::raw('SUM(nominal) as total'))
            ->where(DB::raw('WEEK(created_at)'), DB::raw('WEEK(CURDATE())'))
            ->where('status', 'lunas')
            ->get();

        $harian = DB::table('history_billing')
            ->select(DB::raw('SUM(nominal) as total'))
            ->where(DB::raw('DATE(created_at)'), DB::raw('DATE(CURDATE())'))
            ->where('status', 'lunas')
            ->get();

        $table = DB::table('history_billing')
            ->select('wa_account.number', 'users.name', 'history_billing.id_his_bill', 'history_billing.kd_unik', 'history_billing.status', 'history_billing.status_akses', 'history_billing.id_his_bill', 'history_billing.id_invoice', 'history_billing.nominal', DB::raw('DATE(history_billing.created_at) AS terbit'))
            ->join('users', 'history_billing.id_user', '=', 'users.id')
            ->join('wa_account', 'history_billing.id_wa', '=', 'wa_account.id')
            ->orderBy('history_billing.id_his_bill', 'desc')
            ->get();

        // $pengguna = DB::table('users')
        //     ->select('users.name', DB::raw('DATE(users.created_at) as daftar'), DB::raw('COUNT(wa_account.user_id) as jumlah_wa'))
        //     ->leftJoin('wa_account', 'users.id', '=', 'wa_account.user_id')
        //     ->groupBy('users.name')
        //     ->groupBy('daftar')
        //     ->orderBy('user.name', 'asc')
        //     ->get();

        $billing = [
            "billing" => $table,
            "total" => $total[0]->total,
            "bulanan" => $bulanan[0]->total,
            "mingguan" => $mingguan[0]->total,
            "harian" => $harian[0]->total
        ];


        return view('superadmin/billing/billing', compact('billing'));
    }

    public function konfirmasi($id)
    {
        $data = DB::table('history_billing')->where('id_his_bill', $id)->first();

        return view('superadmin.billing.konfirmasi_billing', compact('data'));
    }

    public function ubahkonfirmasi(Request $request)
    {
        DB::table('history_billing')
            ->where('id_his_bill', $request->id)
            ->update(["status" => $request->status]);

        return redirect()->route('superadmin_billing');
    }

    public function grafik_data()
    {
        $data_graf = [];

        for ($i = 0; $i < 12; $i++) {
            $data = DB::table('history_billing')
                ->select(DB::raw('MONTH(created_at) AS bulan, SUM(nominal) AS jumlah_bulanan'))
                ->where(DB::raw('MONTH(created_at)'), DB::raw('MONTH(CURDATE() - INTERVAL ' . $i . ' MONTH)'))
                ->where('status', 'lunas')
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->get();

            if ($data->count() > 0) {
                $data_graf[$i]["bulan"] = date('Y-') . $data[0]->bulan;
                $data_graf[$i]["jumlah_bulanan"] = $data[0]->jumlah_bulanan;
            } else {
                $data_graf[$i]["bulan"] = date('Y-m', strtotime('-' . $i . 'month'));
                $data_graf[$i]["jumlah_bulanan"] = 0;
            }
        }

        return json_encode($data_graf, true);
    }
}
