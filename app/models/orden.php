<?php

namespace restaurant\models;

use Illuminate\Database\Eloquent\Model;

class orden extends Model
{
    protected $table = "orden";
    public $timestamps = false;

    /*public function mesa()
    {
        return $this->belongsToMany(TipoUsuario::class, 'menu_usuario');//parecido al join- muchos a muchos
    }*/
}
