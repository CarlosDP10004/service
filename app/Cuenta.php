<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    //
    protected $table = 'Cuenta';
    protected $primaryKey = 'IdCuenta';
    protected $fillable = ['NombreCuenta', 'Codigo'];
    public $timestamps = false;
}
