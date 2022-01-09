<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //
    protected $table = 'Rol';
    protected $primaryKey = 'IdRol';
    protected $fillable = ['NombreRol'];
    public $timestamps = false;

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'UsuarioRol', 'IdUsuario', 'IdRol');
    }

    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'RolPermiso', 'IdRol', 'IdPermiso');
    }
}
