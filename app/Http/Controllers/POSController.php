<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;

class POSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //fungsi eloquent menampilkan data menggunakan pagination
        $m_user = UserModel::all(); // Mengambil semua isi tabel
        return view('user.index', compact('m_user'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // melakukan validasi data
        $request->validate([
            'user_id' => 'max 20',
            'username' => 'required',
            'nama' => 'required',
        ]);

        UserModel::create($request->all());

        return redirect()->route('user.index')->with('success', 'user berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $m_user = UserModel::find($id);
        return view('user.show', compact('m_user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $m_user = UserModel::find($id);
        return view('user.edit', compact('m_user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'username' => 'required',
            'nama' => 'required',
            'password' => 'required',
        ]);
        // fungsi eloquent untuk mengupdate data inputan kita
        UserModel::find($id)->update($request->all());
        return redirect()->route('user.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $m_user = UserModel::findOrFail($id)->delete();
        return \redirect()->route('user.index')->with('success', 'Data berhasil dihapus');
    }
}
