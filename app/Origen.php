<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Origen extends Model
{
    //
    protected $table = 'Origen';
    protected $primaryKey = 'IdOrigen';
    protected $fillable = ['NombreOrigen'];
    public $timestamps = false;
}
