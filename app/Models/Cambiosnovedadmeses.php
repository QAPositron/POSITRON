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
    //Relacion uno a uno (inversa) con holder
    public function dosicontrolcontdosisedes(){
        return $this->belongsTo(Dosicontrolcontdosisede::class, 'dosicontrol_id', 'id_dosicontrolcontdosisedes');
    }
    //Relacion uno a uno (inversa) con holder
    public function dosiareacontdosisedes(){
        return $this->belongsTo(Dosiareacontdosisede::class, 'dosiarea_id', 'id_dosiareacontdosisedes');
    }
}
