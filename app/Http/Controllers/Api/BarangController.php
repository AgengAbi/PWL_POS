<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    //

    public function index()
    {
        return BarangModel::all();
    }

    public function store(Request $request)
    {
        // set validation
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required|integer',
            'barang_kode' => 'bail|required|string|unique:m_barang,barang_kode',
            'barang_nama' => 'required|string|max:100',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // if validations fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        };

        // create Barang
        $brg = BarangModel::create([
            'kategori_id' => $request->kategori_id,
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'image' => $request->image->hashName(),
        ]);

        // return response JSON user is created
        if ($brg) {
            return Response()->json([
                'success' => true,
                'barang' => $brg,
            ], 201);
        }

        // return JSON process insert failed
        return response()->json([
            'success' => false,
        ], 409);


        // $id = BarangModel::create($request->all());
        // return response()->json($id, 201);
    }

    public function show($id)
    {
        return BarangModel::find($id);
    }

    public function update(Request $request, BarangModel $id)
    {
        $id->update($request->all());
        return BarangModel::find($id);
    }

    public function destroy($id)
    {
        $brg = BarangModel::find($id);
        $brg->delete();

        return response()->json([
            'success' => true,
            'data' => $brg,
            'message' => 'Data terhapus',
        ]);
    }
}
