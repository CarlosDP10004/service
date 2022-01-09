<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    //

    protected $table = 'Permiso';
    protected $primaryKey = 'IdPermiso';
    protected $fillable = ['NombrePermiso', 'Modulo'];

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'RolPermiso', 'IdRol', 'IdPermiso');
    }
}
