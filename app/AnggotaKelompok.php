<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnggotaKelompok extends Model
{
    protected $table = 'anggota_kelompok';
    protected $primaryKey = 'id';

    protected $fillable = ['no_ktp', 'nama_kelompok', 'alamat', 'telepon', 'id_dokumen_administrasi'];
    use SoftDeletes;

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'id_kelompok', 'id');
        // return $this->hasOne(DokumenAdministrasi::class, 'id_dokumen_administrasi', '');
    }
}
