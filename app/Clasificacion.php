<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clasificacion extends Model
{
    //
    protected $table = 'Clasificacion';
    protected $primaryKey = 'IdClasificacion';
    protected $fillable = ['Descripcion', 'IdCuenta'];
    public $timestamps = false;

    public function cuenta(){
        return $this->hasOne(Cuenta::class, 'IdCuenta', 'IdCuenta');
    }
}
