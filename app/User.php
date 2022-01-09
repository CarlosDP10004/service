<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends  Authenticatable 
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "Usuario";
    protected $primaryKey = 'IdUsuario';
    protected $fillable = [
        'NombreUsuario', 'Contrasenna', 'Estado', 'Intento',
    ];
    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'Contrasenna',
    ];

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'UsuarioRol', 'IdUsuario', 'IdRol');
    }
}
