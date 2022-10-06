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
    //relacion uno a uno con la tabla dosicontrolcontdosisedes
    public function dosicontrolcontratodosisede(){
        return $this->hasOne(Dosicontrolcontdosisede::class, 'contdosisededepto_id', 'id_contdosisededepto');
    }
    //relacion uno a muchos con la tabla trabajadordosimetros
    public function trabajadordosimetro(){
        return $this->hasMany(Trabajadordosimetro::class, 'id_trabajadordosimetro');
    }
    //relacion uno a muchos con la tabla trabajadordosimetros
    public function temptrabajdosimrev(){
        return $this->hasMany(Temptrabajdosimrev::class, 'id_temptrabajdosimrev');
    }
     //Relacion uno a muchos (inversa) con departamentosede
    public function departamentosede(){
        return $this->belongsTo(Departamentosede::class, 'departamentosede_id', 'id_departamentosede');
    }
    //relacion uno a uno con la tabla dosicontrolcontdosisedes
    public function dosiareacontratodosisede(){
        return $this->hasMany(Dosiareacontdosisede::class, 'id_dosiareacontdosisedes');
    }
    //relacion uno a muchos con la tabla mesescontratodosimetriasedepto
    public function mesescontratodosimetriasedepto(){
        return $this->hasMany(Mesescontdosisedeptos::class, 'id_mescontdosisededepto');
    }

}
