<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosicontrolcontdosisede extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_dosicontrolcontdosisedes';

    //Relacion uno a muchos (inversa) con contrato dosimetria sede
    public function contratodosimetriasede(){
        return $this->belongsTo(Contratodosimetriasede::class, 'contratodosimetriasede_id', 'id_contratodosimetriasede');
    }
    //Relacion uno a muchos (inversa) con sedes
    public function sede(){
        return $this->belongsTo(Sede::class, 'sede_id', 'id_sede');
    }
     //Relacion uno a muchos (inversa) con dosimetros
    public function dosimetro(){
        return $this->belongsTo(Dosimetro::class, 'dosimetro_id', 'id_dosimetro');
    }
     //Relacion uno a muchos (inversa) con contratodosimetriasededepto
    public function contratodosimetriasededepto(){
        return $this->belongsTo(Contratodosimetriasededepto::class, 'contdosisededepto_id','id_contdosisededepto');
    }
     //relacion uno a uno con novedadmesescontdosisedepto
    public function novedadmesescontdosi(){
        return $this->hasOne(Novedadmesescontdosisededepto::class, 'dosicontrol_id', 'id_dosicontrolcontdosisedes');
    }
}
