<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    //

    public function index()
    {
        return BarangModel::all();
    }

    public function store(Request $request)
    {
        $id = BarangModel::create($request->all());
        return response()->json($id, 201);
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

    public function destroy(BarangModel $user)
    {
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terhapus',
        ]);
    }
}
