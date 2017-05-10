<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPublicacion extends Model
{
    //

    protected $fillable = ['id','tipo'];

    protected $table = 'tipopublicacion';

    public function publicaciones(){
        return $this->hasMany('App\Publicaciones');
    }
}
