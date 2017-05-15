<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raza extends Model
{
    //

    protected $fillable = ['id','id_animal', 'raza'];

    protected $table = 'razas';

    public function animal(){
        return $this->hasOne('App\Animal');
    }
}
