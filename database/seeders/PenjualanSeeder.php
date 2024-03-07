<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $listPembeli = ['Ahmad', 'Sutrisno', 'Rahmat', 'Putri', 'Siti', 'Lestari', 'Indah', 'Wahyu', 'Purnama', 'Nurul'];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'user_id' => 3,
                'pembeli' => $listPembeli[$i],
                'penjualan_kode' => 'SELL' . $i + 1,
                'penjualan_tanggal' => now(),
            ];
        }

        DB::table('t_penjualan')->insert($data);
    }
}
