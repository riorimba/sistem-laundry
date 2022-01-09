<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;
    protected $table = 'outlets';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_outlet', 'alamat'
    ];
    public $timestamps=true;
}
