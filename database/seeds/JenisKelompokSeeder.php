<?php

use Illuminate\Database\Seeder;
use App\JenisKelompok;


class JenisKelompokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisKelompok::insert([
            'name' => 'UAP (Usaha Ekonomi Produktif)',
        ]);

        JenisKelompok::insert([
            'name' => 'SPP (Simpan Pinjam Perempuan)',
        ]);
    }
}
