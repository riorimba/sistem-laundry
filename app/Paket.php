<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table = 'pakets';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_outlet','jenis','nama_paket', 'harga'
    ];
    public function outlet()
    {
        return $this->belongsT0('App\Outlet', 'id_outlet', 'id');
    }
    public $timestamps=true;
}
