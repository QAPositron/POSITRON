<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coldepartamento extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_departamentocol ';
     //relacion uno a muchos con colmunicipio
     public function colmunicipio(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->hasMany(Colmunicipio::class, 'id_municipiocol');
    }
}
