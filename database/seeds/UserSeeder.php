<?php

use App\Pegawai;
use App\Direktur;
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
            'nama_user' => 'ini pegawai',
            'email' => 'inipegawai@gmail.com',
            'password' => bcrypt('jomokbangetwir'),
            'roles' => 'pegawai'
        ]);

        $pegawai = User::select('*')->where('nama_user', '=', 'ini pegawai')->where('roles', '=', 'pegawai')->first();

        Pegawai::create([
            'user_id' => $pegawai['id'],
            'nama_pegawai' => 'ini pegawai',
            'jenis_kelamin' => 'laki-laki',
            'jabatan' => 'atmin',
            'no_hp' => '08123456789'
         ]);

        User::insert([
            'nama_user' => 'ireng banget wir',
            'email' => 'jawiricikiwir@gmail.com',
            'password' => bcrypt('jomokbangetwir'),
            'roles' => 'direktur'
        ]);

        $direktur = User::select('*')->where('nama_user', '=', 'ireng banget wir')->where('roles', '=', 'direktur')->first();

        Direktur::create([
            'nama_direktur' => 'ireng banget wir',
            'user_id' => $direktur['id'],
            'email' => 'jawiricikiwir@gmail.com'
        ]);

        User::insert([
            'nama_user' => 'ini anggota wir',
            'email' => 'anggota_icikiwir@gmail.com',
            'password' => bcrypt('jomokbangetwir'),
            'roles' => 'kelompok'
        ]);
    }
}
