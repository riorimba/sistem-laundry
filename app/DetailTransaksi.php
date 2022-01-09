<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;
    protected $table = 'detail_transaksis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_transaksi', 'id_paket', 'berat', 'total_harga'
    ];
    public $timestamps=true;
}
