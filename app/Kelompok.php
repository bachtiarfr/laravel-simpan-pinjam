<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelompok extends Model
{
    protected $table = 'kelompok';
    protected $primaryKey = 'id';

    protected $fillable = ['no_ktp', 'nama_kelompok', 'alamat', 'telepon', 'approved', 'document_administrations'];
    use SoftDeletes;

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'id_kelompok', 'id');
    }
}
