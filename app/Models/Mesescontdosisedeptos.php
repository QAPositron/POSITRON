<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Mesescontdosisedeptos extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_mescontdosisededepto';

    //Relacion uno a muchos (inversa) con contrato dosimetria sedes
    public function contratodosimetriasededepto(){
        return $this->belongsTo(Contratodosimetriasededepto::class, 'contdosisededepto_id', 'id_contdosisededepto');
    }

    //relacion uno a muchos 
    public function novedadmesescontdosi(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->hasMany(Novedadmesescontdosisededepto::class, 'id_novedadmesescontdosi');
    }
}