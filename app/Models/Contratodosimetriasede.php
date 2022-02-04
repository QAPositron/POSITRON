<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contratodosimetriasede extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_contratodosimetriasede';

    //Relacion uno a muchos (inversa) con sede
    public function sede(){
        /* return $this->belongsTo('App\Models\Empresa'); */
        return $this->belongsTo(Sede::class, 'sede_id', 'id_sede');
    }
    //Relacion uno a muchos (inversa) con dosimetria contrato
    public function dosimetriacontrato(){
        /* return $this->belongsTo('App\Models\Empresa'); */
        return $this->belongsTo(Dosimetriacontrato::class, 'contratodosimetria_id', 'id_contratodosimetria');
    }
     //relacion uno a muchos con la tabla trabajadordosimetro
     public function trabajadordosimetro(){
        return $this->hasMany(Trabajadordosimetro::class, 'id_trabajadordosimetro');
    }
    //relacion uno a muchos con la tabla dosicontrolcontdosisedes
    public function dosicontrolcontratodosisede(){
        return $this->hasMany(Dosicontrolcontdosisede::class, 'id_dosicontrolcontdosisedes');
    }
    //relacion uno a muchos con la tabla contratodosimetriasedesdepto
    public function contratodosimetriasededepto(){
        return $this->hasMany(Contratodosimetriasededepto::class, 'id_contdosisededepto');
    }
}
