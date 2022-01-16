<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    //
    protected $table = 'Unidad';
    protected $primaryKey = 'IdUnidad';
    protected $fillable = ['NombreUnidad', 'IdUsuario'];
    public $timestamps = false;

    public function encargado(){
        return $this->hasOne(User::class, 'IdUsuario', 'IdUsuario');
    }
}
