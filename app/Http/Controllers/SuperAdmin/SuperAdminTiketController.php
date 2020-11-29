<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SuperAdminTiketController extends Controller
{
    public function index()
    {
        $tiket = DB::table('tb_tiket')->get();

        return view('superadmin/tiket/index', ['data' => $tiket]);
    }

    public function detail($id)
    {
        $detail = DB::table('tb_item_tiket')->where('id_tiket', $id)->get();

        return view('superadmin/tiket/detail', ['$data' => $detail]);
    }
}
