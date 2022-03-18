<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table='members';
    protected $primaryKey='id';
    protected $fillable=[
    	'nama_member', 'alamat', 'jenis_kelamin', 'telp'
    ];
}
