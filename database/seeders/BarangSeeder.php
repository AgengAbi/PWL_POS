<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $namaBarang = [
            'Asus Laptop', 'Lenovo Laptop',
            'Samsung Smartphone', 'Apple Smartphone',
            'Nikon Camera', 'Canon Camera',
            'Sony Headphones', 'Bose Headphones',
            'Logitech Keyboard', 'Razer Keyboard'
        ];

        $kategoriIds = [
            1, 1,
            2, 2,
            3, 3,
            4, 4,
            5, 5
        ];

        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'kategori_id' => $kategoriIds[$i],
                'barang_kode' => 'BRG' . ($i + 1),
                'barang_nama' => $namaBarang[$i],
                'harga_jual' => random_int(200, 300),
                'harga_beli' => random_int(100, 200),
            ];
        }

        DB::table('m_barang')->insert($data);
    }
}
