<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    //
    protected $table = 'Proveedor';
    protected $primaryKey = 'IdProveedor';
    protected $fillable = ['NombreProveedor'];
    public $timestamps = false;
}
