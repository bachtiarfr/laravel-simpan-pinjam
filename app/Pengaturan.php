<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';
    protected $primaryKey = 'id';

    protected $fillable = ['waktu_pinjaman', 'jatuh_tempo', 'max_pinjaman', 'jasa_pinjam'];
}
