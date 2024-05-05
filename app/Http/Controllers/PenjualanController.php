<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\PenjualanDetailModel;
use App\Models\PenjualanModel;
use App\Models\StokModel;
use App\Models\UserModel;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PenjualanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Penjualan',
            'list' => ['Home', 'Penjualan'],
        ];
        $page = (object) [
            'title' => 'Daftar Penjualan yang terdaftar dalam sistem',
        ];

        $activeMenu = 'penjualan';

        $barang = BarangModel::all();

        return view('penjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $penjualans = PenjualanModel::select('penjualan_id', 'pembeli', 'user_id', 'penjualan_tanggal', 'penjualan_kode')->with('user')
            ->withCount(['penjualan_detail as total_harga' => function (Builder $query) {
                $query->select(DB::raw('SUM(harga)'));
            }]);

        if ($request->barang_id) {
            $penjualans->whereHas('penjualan_detail', function ($query) use ($request) {
                $query->where('barang_id', $request->barang_id);
            });
        }

        return DataTables::of($penjualans)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penjualan) {
                $btn = '<a href="' . url('/penjualan/' . $penjualan->penjualan_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/penjualan/' . $penjualan->penjualan_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/penjualan/' . $penjualan->penjualan_id) . '">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Penjualan',
            'list' => ['Home', 'Penjualan', 'Tambah']
        ];
        $page = (object)[
            'title' => 'Tambah Penjualan Baru'
        ];

        $itemsCounts = PenjualanModel::count() + 1;
        $itemCode = "SELL" . $itemsCounts;

        $barang = BarangModel::all(); //ambil data untuk ditampilkan di form
        $user = UserModel::all(); //ambil data untuk ditampilkan di form
        $activeMenu = 'penjualan';
        return view('penjualan.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'user' => $user, 'activeMenu' => $activeMenu, 'itemCode' => $itemCode]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id' => 'bail|required|integer',
            'pembeli' => 'required|string|max:100',
            'penjualan_kode' => 'required|string|max:100|unique:t_penjualan,penjualan_kode',
            'penjualan_tanggal' => 'required|date',
            'barang_id' => 'required|array',
            'total_harga' => 'required|array',
            'jumlah' => 'required|array',
        ]);
        $penjualan = PenjualanModel::create([
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli,
            'penjualan_kode' => $request->penjualan_kode,
            'penjualan_tanggal' => $request->penjualan_tanggal
        ]);

        foreach ($request->barang_id as $key => $barangId) {
            PenjualanDetailModel::create([
                'penjualan_id' => $penjualan->penjualan_id,
                'barang_id' => $barangId,
                'harga' => $request->total_harga[$key],
                'jumlah' => $request->jumlah[$key]
            ]);

            //
            $item = StokModel::find($barangId);
            $item->stok_jumlah -= $request->jumlah[$key];
            $item->save();
        }

        return redirect('/penjualan')->with('success', 'Data Penjualan berhasil disimpan');
    }

    public function getHarga($id)
    {
        $barang = BarangModel::findOrFail($id); // Cari barang berdasarkan ID

        return response()->json([
            'harga_jual' => $barang->harga_jual, // Kembalikan harga jual barang dalam respons JSON
        ]);
    }

    public function show(string $id)
    {
        $penjualan = PenjualanModel::find($id);
        $penjualanDetail = PenjualanDetailModel::where('penjualan_id', $penjualan->penjualan_id)->get();

        $breadcrumb = (object)[
            'title' => 'Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail']
        ];
        $page = (object)[
            'title' => 'Detail Penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.show', ['penjualan' => $penjualan, 'penjualanDetail' => $penjualanDetail, 'breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $penjualan = PenjualanModel::find($id);
        $barang = BarangModel::all();
        $user = UserModel::all();
        $penjualanDetail = PenjualanDetailModel::where('penjualan_id', $penjualan->penjualan_id)->get();

        $breadcrumb = (object)[
            'title' => 'Edit Penjualan',
            'list' => ['Home', 'Penjualan', 'Edit']
        ];
        $page = (object)[
            'title' => 'Edit Penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'penjualan' => $penjualan, 'penjualanDetail' => $penjualanDetail, 'barang' => $barang, 'user' => $user]);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'user_id' => 'bail|required|integer',
            'pembeli' => 'required|string|max:100',
            'penjualan_kode' => 'required|string|max:100|unique:t_penjualan,penjualan_kode,' . $id . ',penjualan_id',
            'penjualan_tanggal' => 'required|date',
            'barang_id' => 'required|array',
            'total_harga' => 'required|array',
            'jumlah' => 'required|array',
        ]);

        $penjualan = PenjualanModel::find($id);
        $penjualan->update([
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli,
            'penjualan_kode' => $request->penjualan_kode,
            'penjualan_tanggal' => $request->penjualan_tanggal
        ]);

        $oldPenjualanDetail = PenjualanDetailModel::where('penjualan_id', $penjualan->penjualan_id)->get();
        foreach ($oldPenjualanDetail as $item) {
            $barang = StokModel::where('barang_id', $item->barang_id)->first();
            $barang->stok_jumlah += $item->jumlah;
            $barang->save();
        };

        PenjualanDetailModel::where('penjualan_id', $id)->delete();

        // Menambahkan kembali detail penjualan yang baru
        foreach ($request->barang_id as $index => $barang_id) {
            // Tambahkan detail penjualan baru
            PenjualanDetailModel::create([
                'penjualan_id' => $id,
                'barang_id' => $barang_id,
                'jumlah' => $request->jumlah[$index],
                'harga' => $request->total_harga[$index],
            ]);


            $item = StokModel::find($barang_id);
            $item->stok_jumlah -= $request->jumlah[$index];
            $item->save();
        }

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = PenjualanModel::find($id);
        if (!$check) {
            return redirect('/penjualan')->with('error', 'Data penjualan tidak ditemukan');
        }

        try {
            $penjualanDetails = PenjualanDetailModel::where('penjualan_id', $check->penjualan_id)->get();

            // Hapus semua detail penjualan
            foreach ($penjualanDetails as $detail) {
                $detail->delete();
            }

            PenjualanModel::destroy($id);

            return redirect('/penjualan')->with('success', 'Data penjualan berhasil dihapus');
        } catch (\illuminate\Database\QueryException $e) {
            return redirect('/penjualan')->with('error', 'Data penjualan gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}