<?php

namespace restaurant\models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use restaurant\models\tipo_usuario;
use Illuminate\Support\Facades\Session;

class usuario extends Authenticatable
{
    use Notifiable;
	protected $model = 'models';
    protected $table = "usuario";
    protected $fillable = ['nombre','apellido','username','password','tipo_documento_id',
                            'nrodocumento','telefono','celular','direccion'];
    protected $hidden = ['password'];  
    public $timestamps = false;
    protected $remember_token = false;
    public function roles()
    {
        return $this->belongsToMany(tipo_usuario::class, 'usuario_tipousuario');
    }
    public function setSession($roles)
    {
        if (count($roles) == 1) {
            Session::put(
                [
                    'rol_id' => $roles[0]['id'],
                    'rol_nombre' => $roles[0]['nombre'],
                    'usuario' => $this->username,
                    'usuario_id' => $this->id,
                    'nombre_usuario' => $this->nombre
                ]
            );
        }else{

        }
    }
}
