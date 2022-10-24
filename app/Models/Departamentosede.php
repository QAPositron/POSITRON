<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamentosede extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_departamentosede';

    //Relacion uno a muchos (inversa) con sede
    public function sede(){
        return $this->belongsTo(Sede::class, 'sede_id', 'id_sede');
    }
     //relacion uno a muchos con la tabla contratodosimetriasedesdepto
    public function contratodosimetriasededepto(){
        return $this->hasMany(Contratodosimetriasededepto::class, 'id_contdosisededepto');
    }

    //relacion uno a muchos con la tabla areadepartamentosede
    public function areadepartamentosede(){
        return $this->hasMany(Areadepartamentosede::class, 'id_areadepartamentosede');
    }
    public function departamento(){
        /* return $this->belongsTo('App\Models\Empresa'); */
        return $this->belongsTo(Departamento::class, 'departamento_id', 'id_departamento');
    }
}
