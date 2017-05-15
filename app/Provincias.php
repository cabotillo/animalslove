<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincias extends Model
{
    //
    protected $table = 'provincias';

    protected $fillable = ['id', 'provincia',];

    public function users(){
        return $this->hasMany('App\User');
    }
}
