<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colmunicipio extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_municipiocol' ;

     //Relacion uno a muchos (inversa) con coldepartamento
    public function coldepartamento(){
        return $this->belongsTo(Coldepartamento::class, 'departamentocol_id', 'id_departamentocol');
    }
        /* return $this->belongsTo('App\Models\Empresa'); */

    public function dosicontrolcontratodosisede(){
        return $this->hasOne(Dosicontrolcontdosisede::class, 'contdosisededepto_id', 'id_contdosisededepto');
    }

    /* public function empresa(){
        return $th
    } */

}
