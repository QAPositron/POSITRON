<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosimetriacontrato extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_contratodosimetria';

    //relacion uno a muchos con contrato dosimetria sede
    public function contratodosimetriasede(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->hasMany(Contratodosimetriasede::class, 'id_contratodosimetriasede');
    }
    //relacion uno a muchos con contrato dosimetria sede
    public function novedadmesescontdosisededepto(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->hasMany(Novedadmesescontdosisededepto::class, 'id_novedadmesescontdosi');
    }
     //Relacion uno a muchos (inversa) con empresa
    public function empresa(){
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id_empresa');
    }
    //relacion uno a muchos con contrato dosimetria sede
    public function dosicontrolcontdosisede(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->hasMany(Dosicontrolcontdosisede::class, 'id_dosicontrolcontdosisedes');
    }
}
