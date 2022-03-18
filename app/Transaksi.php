<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    // use HasFactory;
    protected $table='transaksis';
    protected $primaryKey='id';
    protected $fillable=[
    	'id_outlet','id_member','id_paket','qty','tgl', 'batas_waktu','tgl_bayar','status','dibayar'
    ];

    public function outlet()
    {
        return $this->belongsT0('App\Models\Outlet', 'id_outlet', 'id');
    }

    public function member()
    {
        return $this->belongsT0('App\Models\Member', 'id_member', 'id');
    }

    public function paket()
    {
        return $this->belongsT0('App\Models\Paket', 'id_paket', 'id');
    }
}
