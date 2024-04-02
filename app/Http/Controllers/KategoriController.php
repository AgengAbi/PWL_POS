<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Http\Requests\StorePostRequest;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable)
    {
        return $dataTable->render('kategori.index');
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(StorePostRequest $request) // type before Request
    {
        $validated = $request->validate([
            'kategori_kode' => 'bail|required|unique:m_kategori, kategori_kode',
            'kategori_nama' => 'required',
        ]);

        try {
            //code...
            // The incoming requst is valid...

            // Retrieve the validated input data
            $validated = $request->validated();

            // Retrieve a portion of the validated input data...
            $validated = $request->safe()->only(['kategori_kode', 'kategori_nama']);
            $validated = $request->safe()->except(['kategori_kode', 'kategori_nama']);

            KategoriModel::create([
                'kategori_kode' => $request->kodeKategori,
                'kategori_nama' => $request->namaKategori,
            ]);

            // the post is valid

            return redirect('/kategori')->with('success', 'Data kategori berhasil disimpan');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Data kategori gagal disimpan, silahkan cek dan coba lagi');
        }
    }

    public function edit($id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.edit', ['data' => $kategori]);
    }

    public function edit_save($id, Request $request)
    {
        $item = KategoriModel::find($id);
        $item->kategori_kode = $request->kategori_kode;
        $item->kategori_nama = $request->kategori_nama;
        $item->save();
        return redirect('/kategori');
    }

    public function delete($id)
    {
        $item = KategoriModel::find($id);
        if (!$item) {
            return redirect()->route('/kategori')->with('error', 'Data not found');
        }

        $item->delete($id);
        return redirect()->route('/kategori')->with('success', 'Data delete successfully');
    }
}
