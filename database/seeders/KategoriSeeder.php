<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $kategoriBarang = ['laptop', 'smartphone', 'camera', 'headphones', 'keyboard'];
        for ($i = 0; $i < 5; $i++) {
            $data[] = [
                'kategori_kode' => 'KBE' . ($i + 1),
                'kategori_nama' => $kategoriBarang[$i],
            ];
        }

        DB::table('m_kategori')->insert($data);
    }
}
