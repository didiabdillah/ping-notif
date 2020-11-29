<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SuperAdminDocsApiController extends Controller
{
    public function index()
    {
        $api = DB::table('tb_docs_api')
            ->orderBy('id_docs', 'desc')
            ->get();

        return view('superadmin/docs_api/index', ['data' => $api]);
    }

    public function create()
    {
        // memanggil view create
        return view('superadmin/docs_api/create');
    }

    public function store(Request $api)

    {
        $data = [
            "subject" => $api->subject,
            "content" => $api->desc
        ];
        DB::table('tb_docs_api')->insert($data);
        return redirect()->route('superadmin_docs_api')->with('status', 'Data Api Berhasil Ditambah');
    }

    public function edit($id)
    {
        $api = DB::table('tb_docs_api')->where('id_docs', $id)->first();
        // memanggil view edit
        return view('superadmin/docs_api/edit', ['data' => $api]);
    }

    public function update(Request $request)
    {
        // update data books
        DB::table('tb_docs_api')->where('id_docs', $request->id)->update([
            'subject' => $request->subject,
            'content' => $request->content,
        ]);
        // alihkan halaman edit ke halaman books
        return redirect()->route('superadmin_docs_api')->with('status', 'Data Api Berhasil Diganti');
    }

    public function destroy($id)
    {
        // menghapus data books berdasarkan id yang dipilih
        DB::table('tb_docs_api')->where('id_docs', $id)->delete();
        return redirect()->route('superadmin_docs_api')->with('status', 'Data Api Berhasil Dihapus');
    }
}
