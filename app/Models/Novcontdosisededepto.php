<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novcontdosisededepto extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_novcontdosisededepto'; 

    //Relacion uno a muchos (inversa) con contratodosimetriasededepto
    public function contratodosimetriasededepto(){
        return $this->belongsTo(Contratodosimetriasededepto::class, 'contdosisededepto_id', 'id_contdosisededepto');
    }
    //Relacion uno a muchos (inversa) con contrato dosimetria sedes
    public function contratodosimetriasede(){
        return $this->belongsTo(Contratodosimetriasede::class, 'contratodosimetriasede_id', 'id_contratodosimetriasede');
    }
    //Relacion uno a muchos (inversa) con departamentosede
    public function departamentosede(){
        return $this->belongsTo(Departamentosede::class, 'departamentosede_id', 'id_departamentosede');
    }
    //relacion uno a muchos con la tabla novedadmesescontdosisedepto
    public function novedadmesescontdosisededepto(){
        return $this->hasMany(Novedadmesescontdosisededepto::class, 'id_novedadmesescontdosi');
    }
    //relacion uno a muchos con la tabla mesescontdosisedeptos
    public function mesescontdosisedeptos(){
        return $this->hasMany(Mesescontdosisedeptos::class, 'id_mescontdosisededepto');
    }
    //relacion uno a muchos con la tabla dosicontrolcontdosisedes
    public function dosicontrolcontratodosisede(){
        return $this->hasMany(Dosicontrolcontdosisede::class, 'id_dosicontrolcontdosisedes');
    }
    //relacion uno a muchos con la tabla dosiareacontdosisedes
    public function dosiareacontdosisedes(){
        return $this->hasMany(Dosiareacontdosisede::class, 'id_dosiareacontdosisedes');
    }
    //relacion uno a muchos con la tabla trabajadordosimetro
    public function trabajadordosimetro(){
        return $this->hasMany(Trabajadordosimetro::class, 'id_trabajadordosimetro');
    }
    //relacion uno a muchos con la tabla obsreventrada
    public function obsreventrada(){
        return $this->hasMany(Obsreventrada::class, 'id_obsreventrada');
    }
}
