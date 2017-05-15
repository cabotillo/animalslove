<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mascotas extends Model
{
    //


    protected $fillable = ['id', 'user_id', 'nombre', 'animal_id', 'raza_id', 'genero', 'tamanyo', 'avatar', 'edad', 'updated_at'];
    protected $table = 'mascotas';
    protected $primaryKey = 'id';
    protected $connection = 'mysql';


    public function animal()
    {
        return $this->hasOne('App\Animal');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function raza()
    {
        return $this->hasOne('App\Raza');
    }

}