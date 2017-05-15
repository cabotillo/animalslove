<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    //

    protected $fillable = ['id','user_id', 'mascota_id', 'publicacion_id'];

    protected $table = 'reportes';

    public function user(){
        return $this->hasOne('App\User');
    }
    public function mascota(){
        return $this->hasOne('App\Mascotas');
    }
    public function publicacion(){
        return $this->hasOne('App\Publicaciones');
    }
}
