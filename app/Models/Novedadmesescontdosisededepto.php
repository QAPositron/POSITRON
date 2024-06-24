<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novedadmesescontdosisededepto extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_novedadmesescontdosi'; 

    //Relacion uno a muchos (inversa) con empresa
    public function mesescontdosisedepto(){
        /* return $this->belongsTo('App\Models\Empresa'); */
        return $this->belongsTo(Mesescontdosisedeptos::class, 'mescontdosisededepto_id', 'id_mescontdosisededepto');
    }
    //Relacion uno a muchos (inversa) con dosimetria contrato
    public function novedad(){
        /* return $this->belongsTo('App\Models\Empresa'); */
        return $this->belongsTo(Novedad::class, 'novedad_id', 'id_novedad');
    }
     //Relacion uno a muchos (inversa) con contratodosimetriasededepto
    public function contratodosimetriasededepto(){
        return $this->belongsTo(Contratodosimetriasededepto::class, 'contdosisededepto_id', 'id_contdosisededepto');
    }
    //relacion uno a muchos (inversa) con novcontdosisededeptos
    public function novcontdosisededepto(){
        /* return $this->belongsTo(Novcontdosisededepto::class, 'novcontdosisededepto_id ', 'id_novcontdosisededepto'); */
        return $this->belongsTo(Novcontdosisededepto::class, 'novcontdosisededepto_id', 'id_novcontdosisededepto');
    }
    public function cambiosnovedadmeses(){
        return $this->hasMany(Cambiosnovedadmeses::class, 'id_cambionovedadmeses');
    }
}

