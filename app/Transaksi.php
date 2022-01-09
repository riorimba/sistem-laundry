<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tanggal', 'batas_waktu', 'tanggal_bayar',
        'status', 'dibayar', 'id_user'
    ];
    public $timestamps=true;
}
