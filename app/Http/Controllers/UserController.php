<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\DataTables\UserDataTable;
use App\Http\Requests\StorePostRequest;
use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

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

    // js6
    // public function index(UserDataTable $dataTable)
    // {
    //     return $dataTable->render('user.index');
    // }

    // public function tambah()
    // {
    //     return view('user_tambah');
    // }

    // public function tambah_simpan(StorePostRequest $request) //Request
    // {
    //     $validated = $request->validate([
    //         'username' => 'bail|required|unique:m_user, username',
    //         'nama' => 'required',
    //         'password' => 'required',
    //         'level_id' => 'required',
    //     ]);

    //     try {
    //         //code...

    //         // Retrieve the validated input data
    //         $validated = $request->validated();

    //         // Retrieve a portion of the validated input data...
    //         $validated = $request->safe()->only(['username', 'nama', 'password', 'level_id']);
    //         $validated = $request->safe()->except(['username', 'nama', 'password', 'level_id']);

    //         UserModel::create([
    //             'username' => $request->username,
    //             'nama' => $request->nama,
    //             'password' => Hash::make($request->password),
    //             'level_id' => $request->level_id,
    //         ]);
    //         return redirect('/user')->with('success', 'Data user berhasil disimpan');
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //         return redirect()->back()->with('error', 'Data user gagal disimpan, silahkan cek dan coba lagi');
    //     }
    // }

    // public function ubah($id)
    // {
    //     $user = UserModel::find($id);
    //     return  view('user_ubah', ['data' => $user]);
    // }

    // public function ubah_simpan($id, Request $request)
    // {
    //     $user = UserModel::find($id);
    //     $user->username = $request->username;
    //     $user->nama = $request->nama;
    //     $user->password = Hash::make($request->password);
    //     $user->level_id = $request->level_id;
    //     $user->save();
    //     return redirect('/user');
    // }

    // public function edit($id)
    // {
    //     $user = UserModel::find($id);
    //     return view('user.edit', ['data' => $user]);
    // }

    // public function hapus($id)
    // {
    //     // $user = UserModel::find($id);
    //     // $user->delete();
    //     // return redirect('/user');
    //     $user = UserModel::find($id);
    //     if (!$user) {
    //         return redirect()->route('/user')->with('error', 'Data not found');
    //     }

    //     $user->delete($id);
    //     return redirect()->route('/user')->with('success', 'Data delete successfully');
    // }

    // js7
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];

        $page = (object)[
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user'; // set menu yang sedang aktif

        $level = LevelModel::all();

        return view('users.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
            ->with('level');

        // Filter data user berdasarkan level_id
        if ($request->level_id) {
            $users->where('level_id', $request->level_id);
        }

        return DataTables::of($users)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
                $btn = '<a href="' . url('/user/' . $user->user_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/user/' . $user->user_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/user/' . $user->user_id) . '">'
                    . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah user baru'
        ];

        $level = LevelModel::all(); // ambil data level untuk ditampilkan di form
        $activeMenu = 'user'; // set menu yang sedang aktif

        return view('users.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            // username harus diisi, berupa string, minimal 3 karakter, harus unik dan disimpan di tabel m_user kolom username
            'username' => 'required|string|min:3|unique:m_user,username',
            // nama harus diisi bertipe string dan maksimal 100 karakter
            'nama'     => 'required|string|max:100',
            // password harus diisi dan minimal 5 karakter
            'password' => 'required|min:5',
            // level harus diisi dan bertipe angka
            'level_id' => 'required|integer'
        ]);

        UserModel::create([
            'username' => $request->username,
            'nama'     => $request->nama,
            'password' => bcrypt($request->password), // password akan dienkripsi terlebih dahulu sebelum disimpan
            'level_id' => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil disimpan');
    }

    public function show(string $id)
    {
        $user = UserModel::with('level')->find($id);

        $breadcrumb = (object)[
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail User',
        ];

        $activeMenu = 'user'; //set menu yang sedang aktif

        return view('users.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    // Menampilkan halaman form edit user
    public function edit(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit'],
        ];

        $page = (object) [
            'title' => 'Edit User',
        ];

        $activeMenu = 'user'; //set menu yang sedang aktif

        return view('users.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan perubahan data user
    public function update(Request $request, string $id)
    {
        $request->validate([
            // username harus diisi, berupa string, minimal 3 karakter, harus unik dan disimpan di tabel m_user kolom username
            'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
            // nama harus diisi bertipe string dan maksimal 100 karakter
            'nama'     => 'required|string|max:100',
            // password harus diisi dan minimal 5 karakter
            'password' => 'required|min:5',
            // level harus diisi dan bertipe angka
            'level_id' => 'required|integer'
        ]);

        UserModel::find($id)->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
            'level_id' => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = UserModel::find($id);
        if (!$check) { // untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
        }
        try {
            UserModel::destroy($id); // hapus data level

            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/user')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
