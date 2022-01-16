<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plaza extends Model
{
    //
    protected $table = 'Plaza';
    protected $primaryKey = 'IdPlaza';
    protected $fillable = ['NombrePlaza', 'IdUnidad'];
    public $timestamps = false;

    public function unidad(){
        return $this->hasOne(Unidad::class, 'IdUnidad', 'IdUnidad');
    }
}
