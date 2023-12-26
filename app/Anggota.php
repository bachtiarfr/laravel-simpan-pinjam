<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anggota extends Model
{
    protected $table = 'anggota';
    protected $primaryKey = 'id';

    protected $fillable = ['no_ktp', 'nama_anggota', 'alamat', 'kota', 'telepon'];
    use SoftDeletes;

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'anggota_id', 'id');
    }
}
