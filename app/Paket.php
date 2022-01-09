<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    protected $table = 'pakets';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_paket', 'harga'
    ];
    public $timestamps=true;
}
