<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/templatealte', function () {
    return view('templateALTE');
});

// user
Route::get('/user', [UserController::class, 'index']);
Route::get('user/tambah', [UserController::class, 'tambah']);
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus'])->name('user.delete');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');

// kategori
Route::get('/kategori', [KategoriController::class, 'index']);
Route::post('/kategori/store', [KategoriController::class, 'store']);
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/edit_save/{id}', [KategoriController::class, 'edit_save'])->name('kategori.save');
Route::delete('/kategori/delete/{id}', [KategoriController::class, 'delete'])->name('kategori.delete');

// level
Route::get('/level', [LevelController::class, 'index']);
Route::get('/level/create', [LevelController::class, 'create']);


// resource
Route::resource('user', POSController::class);
