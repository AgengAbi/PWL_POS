<?php

namespace App\Models;

use App\DataTables\KategoriDataTable;
use Illuminate\Database\Eloquent\Factories\BelongsToRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class BarangModel extends Model
{
    protected $table = 'm_barang';
    protected $primaryKey = 'barang_id';
    protected $fillable = ['barang_kode', 'barang_nama', 'kategori_id', 'harga_beli', 'harga_jual', 'image'];
    // use HasFactory;
    public function index(BarangModel $dataTables)
    {
        return $dataTables->render('kategori.index');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }

    protected function image(): Attribute{
        return Attribute::make(
            get: fn($image) => url('/storage/posts/' . $image),
        );
    }
}
