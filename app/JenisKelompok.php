<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisKelompok extends Model
{
    protected $table = 'jenis_kelompok';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'name'];

    public function kelompok()
    {
        return $this->hasMany(AnggotaKelompok::class, 'jenis_kelompok_id', 'id');
    }
}
