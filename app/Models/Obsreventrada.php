<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obsreventrada extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_obsreventrada'; 
    //Relacion uno a uno (inversa) con trabajadordosimetro
    public function trabajadordosimetro(){
        return $this->belongsTo(Trabajadordosimetro::class, 'trabajcontdosimetro_id', 'id_trabajadordosimetro');
    }
    //Relacion uno a uno (inversa) con holder
    public function dosicontrolcontdosisedes(){
        return $this->belongsTo(Dosicontrolcontdosisede::class, 'dosicontrol_id', 'id_dosicontrolcontdosisedes');
    }
    //Relacion uno a uno (inversa) con contradodosimetriasede
    public function contratodosimetriasede(){
        return $this->belongsTo(Contratodosimetriasede::class, 'contratodosimetriasede_id', 'id_contratodosimetriasede');
    }
    //Relacion uno a uno (inversa) con contdosisededepto
    public function contdosisededepto(){
        return $this->belongsTo(contdosisededepto::class, 'contdosisededepto_id', 'id_contdosisededepto');
    }
    //Relacion uno a uno (inversa) con novcontdosisededeptos
    public function novcontdosisededepto(){
        return $this->belongsTo(Novcontdosisededepto::class, 'novcontdosisededepto_id', 'id_novcontdosisededepto');
    }
    public function observaciones(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->belongsTo(Observacion::class, 'observacion_id', 'id_observacion');
    }
     //Relacion uno a uno (inversa) con dosiareacontdosisede
     public function dosiareacontdosisede(){
        return $this->belongsTo(Dosiareacontdosisede::class, 'dosiareacontdosimetro_id', 'id_dosiareacontdosisedes');
    }
}
