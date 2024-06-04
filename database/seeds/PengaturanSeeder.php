<?php

use Illuminate\Database\Seeder;
use App\Pengaturan;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        Pengaturan::insert([
            'waktu_pinjaman' => 10,
            'max_pinjaman' => 10000000,
            'jasa_pinjam' => 2,
        ]);
    }
}
