<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Outlet extends Model
{
    protected $table = 'outlets';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama', 'alamat', 'telp'
    ];
    public $timestamps=true;
}
