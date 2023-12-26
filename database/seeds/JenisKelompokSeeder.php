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
            'name' => 'UAP (usaha ekonomi produktif)',
        ]);

        JenisKelompok::insert([
            'name' => 'SPP (simpan pinjam perempuan)',
        ]);
    }
}
