<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //
    protected $table = 'Rol';
    protected $primaryKey = 'IdRol';
    protected $fillable = ['NombreRol'];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'UsuarioRol', 'IdUsuario', 'IdRol');
    }
}
