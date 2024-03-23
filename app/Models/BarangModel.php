<?php

namespace App\Models;

use App\DataTables\KategoriDataTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    protected $model = 'm_barang';
    protected $primaryKey = 'barang_id';
    // use HasFactory;
    public function index(KategoriDataTable $dataTables)
    {
        return $dataTables->render('kategori.index');
    }
}
