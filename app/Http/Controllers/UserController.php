<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\DataTables\UserDataTable;
use App\Http\Requests\StorePostRequest;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function index()
    // {
    // $data = [
    //     'username' => 'customer-1',
    //     'nama' => 'Pelanggan',
    //     'password' => Hash::make('12345'),
    //     'level_id' => 5,
    // ];
    // UserModel::insert($data);

    // $data = [
    //     'nama' => 'Pelanggan Pertama',
    // ];
    // UserModel::where('username', 'customer-1')->update($data);

    // $data = [
    //     'level_id' => 2,
    //     'username' => 'Manager tiga',
    //     'nama' => 'Manager 3',
    //     'password' => Hash::make('12345'),
    // ];
    // UserModel::create($data);

    // $user = UserModel::all(); // ambil semua data dari tabel m_user
    // return view('user', ['data' => $user]);

    // $user = UserModel::find(1);
    // return view('user', ['data' => $user]);

    // $user = UserModel::where('level_id', 1)->first();
    // $user = UserModel::firstWhere('level_id', 1);
    // return view('user', ['data' => $user]);

    // $user = UserModel::findOr(20, ['username', 'nama'], function () {
    //     abort(404);
    // });

    // return view('user', ['data' => $user]);

    // $user = UserModel::findOrFail(1);
    // return view('user', ['data' => $user]);

    // $user = UserModel::where('username', 'manager9')->firstOrFail();
    // return view('user', ['data' => $user]);

    // $user = UserModel::where('level_id', 2)->count();
    // // dd($user);
    // return view('user', ['data' => $user]);

    // $user = UserModel::firstOrCreate(
    //     [
    //         'username' => 'manager',
    //         'nama' => 'Manager',
    //     ]
    // );
    // return view('user', ['data' => $user]);

    // $user = UserModel::firstOrCreate(
    //     [
    //         'username' => 'manager22',
    //         'nama' => 'Manager Dua Dua',
    //         'password' => Hash::make('12345'),
    //         'level_id' => 2
    //     ]
    // );

    // return view('user', ['data' => $user]);

    // $user = UserModel::firstOrNew(
    //     [
    //         'username' => 'manager33',
    //         'nama' => 'Manager Tiga Tiga',
    //         'password' => Hash::make('12345'),
    //         'level_id' => 2
    //     ]
    // );
    // $user->save(); //untuk menyimpan model ke database

    // return view('user', ['data' => $user]);

    // $user = UserModel::create(
    //     [
    //         'username' => 'manager55',
    //         'nama' => 'Manager55',
    //         'password' => Hash::make('12345'),
    //         'level_id' => 2,
    //     ]
    // );
    // $user->username = 'manager56'; //merubah username

    // $user->isDirty(); // true
    // $user->isDirty('username'); //true
    // $user->isDirty('nama'); //false
    // $user->isDirty(['nama', 'username']); //true

    // $user->isClean(); //false
    // $user->isClean('username'); //true
    // $user->isClean('nama'); //true
    // $user->isClean(['nama', 'username']);

    // $user->save();

    // $user->isDirty(); //false
    // $user->isClean(); //true
    // dd($user->isDirty());

    // // wasChanged
    // $user->wasChanged(); //true
    // $user->wasChanged('username'); //true
    // $user->wasChanged(['username', 'level_id']); //true
    // $user->wasChanged('nama'); //false
    // $user->wasChanged(['nama', 'username']); //true

    // $user = UserModel::create(
    //     [
    //         'username' => 'manager11',
    //         'nama' => 'Manager11',
    //         'password' => Hash::make('12345'),
    //         'level_id' => 2,
    //     ]
    // );
    // $user->username = 'manager12';

    // $user->save();

    // $user->wasChanged(); //true
    // $user->wasChanged('username'); //true
    // $user->wasChanged(['username', 'level_id']); //true
    // $user->wasChanged('nama'); //false
    // dd($user->wasChanged(['nama', 'username'])); //true

    // CRUD
    // $user = UserModel::all();
    // return view('user', ['data' => $user]);

    // relation
    //     $user = UserModel::with('level')->get();
    //     // dd($user);
    //     return view('/user', ['data' => $user]);
    // }

    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('user.index');
    }

    public function tambah()
    {
        return view('user_tambah');
    }

    public function tambah_simpan(StorePostRequest $request) //Request
    {
        $validated = $request->validate([
            'username' => 'bail|required|unique:m_user, username',
            'nama' => 'required',
            'password' => 'required',
            'level_id' => 'required',
        ]);

        try {
            //code...

            // Retrieve the validated input data
            $validated = $request->validated();

            // Retrieve a portion of the validated input data...
            $validated = $request->safe()->only(['username', 'nama', 'password', 'level_id']);
            $validated = $request->safe()->except(['username', 'nama', 'password', 'level_id']);

            UserModel::create([
                'username' => $request->username,
                'nama' => $request->nama,
                'password' => Hash::make($request->password),
                'level_id' => $request->level_id,
            ]);
            return redirect('/user')->with('success', 'Data user berhasil disimpan');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Data user gagal disimpan, silahkan cek dan coba lagi');
        }
    }

    public function ubah($id)
    {
        $user = UserModel::find($id);
        return  view('user_ubah', ['data' => $user]);
    }

    public function ubah_simpan($id, Request $request)
    {
        $user = UserModel::find($id);
        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make($request->password);
        $user->level_id = $request->level_id;
        $user->save();
        return redirect('/user');
    }

    public function edit($id)
    {
        $user = UserModel::find($id);
        return view('user.edit', ['data' => $user]);
    }

    public function hapus($id)
    {
        // $user = UserModel::find($id);
        // $user->delete();
        // return redirect('/user');
        $user = UserModel::find($id);
        if (!$user) {
            return redirect()->route('/user')->with('error', 'Data not found');
        }

        $user->delete($id);
        return redirect()->route('/user')->with('success', 'Data delete successfully');
    }
}
