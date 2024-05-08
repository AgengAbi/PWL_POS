<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        return UserModel::all();
    }

    public function store(Request $request)
    {
        $id = UserModel::create($request->all());
        return response()->json($id, 201);
    }

    public function show(UserModel $id)
    {
        return UserModel::find($id);
    }

    public function update(Request $request, UserModel $id)
    {
        $id->update($request->all());
        return UserModel::find($id);
    }

    public function destroy(UserModel $user)
    {
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terhapus',
        ]);
    }
}
