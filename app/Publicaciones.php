<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicaciones extends Model
{
    //

    protected $fillable = ['id','titulo', 'cuerpo', 'user_id', 'mascota_id'];

    protected $table = 'publicaciones';

    public function user(){
        return $this->hasMany('App\User');
    }
    public function mascota(){
        return $this->hasOne('App\Mascotas');
    }
}
