<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagenes extends Model
{
    //
    protected $table = ['imagenes'];
    protected $fillable = ['id', 'mascota_id', 'imagen'];


}
