<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KategoriModel;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    //
    public function index()
    {
        return KategoriModel::all();
    }

    public function store(Request $request)
    {
        $id = KategoriModel::create($request->all());
        return response()->json($id, 201);
    }

    public function show($id)
    {
        return KategoriModel::find($id);
    }

    public function update(Request $request, KategoriModel $id)
    {
        $id->update($request->all());
        return KategoriModel::find($id);
    }

    public function destroy($id)
    {
        $ktg = KategoriModel::find($id);
        $ktg->delete();

        return response()->json([
            'success' => true,
            'data' => $ktg,
            'message' => 'Data terhapus',
        ]);
    }
}
