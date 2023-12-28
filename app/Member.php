<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Hashidable;


class Member extends Model
{
    // use Hashidable;
    // protected $appends = ['hashed_id'];
    protected $table='members';
    protected $primaryKey='id';
    protected $fillable=[
    	'nama_member', 'alamat', 'jenis_kelamin', 'telp'
    ];
    // public function getHashedIdAttribute($value) {
    //     return \Hashids::connection(get_called_class())->encode($this->getKey());
    // }
}


