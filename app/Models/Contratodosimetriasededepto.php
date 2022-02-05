<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contratodosimetriasededepto extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_contdosisededepto';

    //Relacion uno a muchos (inversa) con contrato dosimetria sedes
    public function contratodosimetriasede(){
        return $this->belongsTo(Contratodosimetriasede::class, 'contratodosimetriasede_id', 'id_contratodosimetriasede');
    }

    /* //relacion uno a muchos con la tabla dosicontrolcontdosisedes
    public function dosicontrolcontratodosisede(){
        return $this->hasOne(Dosicontrolcontdosisede::class, 'id_dosicontrolcontdosisedes');
    } */

    //relacion uno a muchos con la tabla trabajadordosimetros
    public function trabajadordosimetro(){
        return $this->hasMany(Trabajadordosimetro::class, 'id_trabajadordosimetro');
    }
     //Relacion uno a muchos (inversa) con departamentosede
    public function departamentosede(){
        return $this->belongsTo(Departamentosede::class, 'departamentosede_id', 'id_departamentosede');
    }
}
