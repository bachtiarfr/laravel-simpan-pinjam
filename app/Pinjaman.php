<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pinjaman extends Model
{
    protected $table = 'pinjaman';
    protected $primaryKey = 'id';

    protected $fillable = ['id_kelompok', 'nominal', 'bagi_hasil', 'jangka_waktu', 'bayar_pokok', 'hasil_bagi', 'bayar_perbulan', 'total', 'keterangan', 'status'];

    use SoftDeletes;

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'kelompok_id');
    }

    public function bayar_pinjaman()
    {
        return $this->hasMany(BayarPinjaman::class, 'pinjaman_id', 'id');
    }
}
