<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::insert([
            'nama_user' => 'deddy gunawan',
            'email' => 'deddygunawan98@gmail.com',
            'password' => bcrypt('akudewe123'),
            'roles' => 'admin'
        ]);

        User::insert([
            'nama_user' => 'ireng banget wir',
            'email' => 'jawiricikiwir@gmail.com',
            'password' => bcrypt('jomokbangetwir'),
            'roles' => 'direktur'
        ]);

        User::insert([
            'nama_user' => 'ini anggota wir',
            'email' => 'anggota_icikiwir@gmail.com',
            'password' => bcrypt('jomokbangetwir'),
            'roles' => 'kelompok'
        ]);
    }
}
