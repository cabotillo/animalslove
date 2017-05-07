<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    //

    protected $fillable = [
        'id','nombre',
        ];

    protected $table = 'animal';

    public function mascotas(){
        return $this->hasMany('App\Mascotas');
    }

    public function raza(){
        return $this->hasOne('App\Raza');
    }
}
