<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table='detail_transaksis';
    protected $primaryKey='id';
    protected $fillable=[
        'id_transaksi','subtotal','keterangan'
    ];
    public function transaksi()
    {
        return $this->belongsT0('App\Transaksi', 'id_transaksi', 'id');
    }
    public $timestamps=true;
}
