<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Direktur extends Model
{
    protected $table = 'direktur';
    protected $primaryKey = 'id';

    protected $fillable = ['nama_direktur', 'user_id', 'alamat', 'email'];
    use SoftDeletes;

    public function direktur()
    {
        
    }
}
