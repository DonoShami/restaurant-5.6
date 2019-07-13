<?php

namespace restaurant\models;

use Illuminate\Database\Eloquent\Model;

class carta extends Model
{
    protected $table = "carta";
    protected $fillable = ['version'];
    protected $guarded = ['id','fecha'];
    public $timestamps = false;
    public static function getHeaders(){
        return ['id','version','fecha'];
    }
    public static function getPull(){
    	return ['version'];
    }
    public function productosCarta()
    {
        return $this->belongsToMany(producto::class, 'carta_item');
    }
}
