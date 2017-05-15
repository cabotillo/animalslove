<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    //

    protected $fillable = ['id','user_id', 'mascota_id', 'pùblicacion_id'];

    protected $table = 'reportes';

    public function animal(){
        return $this->hasOne('App\Animal');
    }
    public function mascota(){
        return $this->hasOne('App\Mascotas');
    }
}
