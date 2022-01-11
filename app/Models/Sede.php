<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_sede';
    //Relacion uno a muchos (inversa) con empresa
    public function empresa(){
        /* return $this->belongsTo('App\Models\Empresa'); */
        return $this->belongsTo(Empresa::class, 'empresas_id', 'id_empresa');
    }

    //relacion uno a muchos con trabajadores
    public function trabajadorsede(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->hasMany(TrabajadorSede::class, 'id_trabajadorsede');
    }

    //relacion uno a muchos con contactos
    public function contactosede(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->hasMany(Contactosede::class, 'id_contactosede');
    }


    public function trabajadordosimetro(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->hasMany(Trabajadordosimetro::class, 'id_trabajadordosimetro');
    }

    //relacion uno a muchos con contrato dosimetria sede
    public function contratodosimetriasede(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->hasMany(Contratodosimetriasede::class, 'id_contratodosimetriasede');
    }
}
