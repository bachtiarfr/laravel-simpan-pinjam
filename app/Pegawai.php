<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'nama_pegawai', 'jenis_kelamin', 'jabatan', 'no_hp'];
    use SoftDeletes;

    public function pegawai()
    {
        
    }
}
