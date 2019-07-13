<?php

namespace restaurant\models;

use Illuminate\Database\Eloquent\Model;

class carta_item extends Model
{
    protected $table = "carta_item";
    public $timestamps = false;
    protected $fillable = ['carta_id', 'tipo_carta_id', 'producto_id', 'stock'];
    protected $guarded = ['id'];

    public function productos()
    {
        return $this->hasMany(producto::class,  'id', 'producto_id');//parecido al join- muchos a muchos
    }
}
