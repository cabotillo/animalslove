<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Mascotas;
use App\Provincias;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','nombre', 'apellidos', 'login', 'email', 'password', 'telefono', 'provincia_id', 'avatar', 'tipo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $table = 'users';

    public function provincia(){
        return $this->belongsTo('App\Provincias');
    }

    public function mascotas(){
        return $this->hasMany('App\Mascotas');
    }

    public function publicaciones(){
        return $this->hasMany('App\Publicaciones');
    }
}
