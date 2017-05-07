<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Mascotas extends Model
{
    //

    protected $fillable = [
        'id','user_id', 'Nombre', 'Animal', 'Raza', 'Genero', 'tamanyo', 'avatar', 'edad',
    ];

    protected $table = 'mascotas';

    public function user(){
        return $this->hasOne('App\User');
    }
}
