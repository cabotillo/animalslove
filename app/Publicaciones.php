<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicaciones extends Model
{
    //

    protected $fillable = ['id','titulo', 'cuerpo', 'user_id', 'mascota_id','disponible'];

    protected $table = 'publicaciones';

    public function user(){
        return $this->hasMany('App\User');
    }
    public function mascota(){
        return $this->hasOne('App\Mascotas');
    }
    public function tipoPublicacion(){
        $this->hasOne('App\TipoPublicacion');
    }
}
