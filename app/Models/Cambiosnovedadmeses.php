<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cambiosnovedadmeses extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_cambionovedadmeses';

    public function novedadmesescontdosidepto(){
        /* return $this->belongsTo('App\Models\Empresa'); */
        return $this->belongsTo(Novedadmesescontdosisededepto::class, 'novedadmesescontdosidepto_id', 'id_novedadmesescontdosi');
    }
    //Relacion uno a uno (inversa) con trabajadordosimetro
    public function trabajadordosimetro(){
        return $this->belongsTo(Trabajadordosimetro::class, 'trabajadordosimetro_id', 'id_trabajadordosimetro');
    }
    //Relacion uno a uno (inversa) con trabajadordosimetro
    public function trabajadordosimetroAnterior(){
        return $this->belongsTo(Trabajadordosimetro::class, 'trabajadordosimetro_ant_id', 'id_trabajadordosimetro');
    }
    //Relacion uno a uno (inversa) con trabajadordosimetro
    public function persona(){
        return $this->belongsTo(Persona::class, 'persona_id', 'id_persona');
    }
    //Relacion uno a uno (inversa) con holder
    public function dosiareacontdosisedes(){
        return $this->belongsTo(Dosiareacontdosisede::class, 'dosiarea_id', 'id_dosiareacontdosisedes');
    }
    //Relacion uno a uno (inversa) con holder
    public function dosiareacontdosisedesAnterior(){
        return $this->belongsTo(Dosiareacontdosisede::class, 'dosiarea_ant_id', 'id_dosiareacontdosisedes');
    }
    //Relacion uno a uno (inversa) con trabajadordosimetro
    public function areadepartamentosede(){
        return $this->belongsTo(Areadepartamentosede::class, 'areadepartamentosede_id', 'id_areadepartamentosede');
    }
    //Relacion uno a uno (inversa) con holder
    public function dosicontrolcontdosisedes(){
        return $this->belongsTo(Dosicontrolcontdosisede::class, 'dosicontrol_id', 'id_dosicontrolcontdosisedes');
    }
}
