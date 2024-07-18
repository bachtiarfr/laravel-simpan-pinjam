<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DokumenAdministrasi extends Model
{
    protected $table = 'dokumen_administrasi';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'path', 'user_id', 'status_persetujuan', 'alasan_persetujuan'];

    public function dokumenAdministrasi()
    {
        
    }
}
