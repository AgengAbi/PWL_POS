<?php

namespace App\Http\Controllers;

use App\DataTables\LevelDataTable;
use App\Http\Requests\StorePostRequest;
use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index(LevelDataTable $dataTable) // before kosong
    {
        // DB::insert('insert into m_level(level_kode, level_nama, created_at) values(?,?,?)', ['CUS', 'Pelanggan', now()]);
        // return 'insert data baru berhasil';

        // $row = DB::update('update m_level set level_nama = ? where level_kode = ?', ['Customer', 'CUS']);
        // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row . ' baris';

        // $row = DB::delete('delete from m_level where level_kode=?', ['CUS']);
        // return 'Delete data berhasil. Jumlah data yang dihapus ' . $row . ' baris';

        // $data = DB::select('select * from m_level');
        // return view('level', ['data' => $data]);

        return $dataTable->render('level.index');
    }

    public function create()
    {
        return view('level.create');
    }

    public function store(StorePostRequest $request) // type before Request
    {
        $validated = $request->validate([
            'level_kode' => 'bail|required|unique:m_level, level_kode',
            'level_nama' => 'required',
        ]);

        try {
            //code...
            // The incoming requst is valid...

            // Retrieve the validated input data
            $validated = $request->validated();

            // Retrieve a portion of the validated input data...
            $validated = $request->safe()->only(['level_kode', 'level_nama']);
            $validated = $request->safe()->except(['level_kode', 'level_nama']);

            LevelModel::create([
                'level_kode' => $request->kodeLevel,
                'level_nama' => $request->namaLevel,
            ]);

            // the post is valid

            return redirect('/level')->with('success', 'Data level berhasil disimpan');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Data level gagal disimpan, silahkan cek dan coba lagi');
        }
    }
}
