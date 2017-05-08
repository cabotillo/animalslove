<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raza extends Model
{
    //

    protected $fillable = ['id','id_animal', 'nombre'];

    protected $table = 'razas';

    public function animal(){
        return $this->hasOne('App\Animal');
    }
    public function mascota(){
        return $this->hasOne('App\Mascotas');
    }
}