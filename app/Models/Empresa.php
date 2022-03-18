<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_empresa'; 
    //relacion uno a muchos
    public function sedes(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->hasMany(Sede::class, 'id_sede');
    }

    public function trabajador(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->hasMany(Trabajador::class, 'id_trabajador');
    }

    public function trabajadordosimetro(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->hasMany(Trabajadordosimetro::class, 'id_trabajadordosimetro');
    }
    
    //relacion uno a muchos
    public function dosimetriacontratos(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->hasMany(Dosimetriacontrato::class, 'id_contratodosimetria');
    }

    //relacion uno a muchos
    public function contratosDosimetriaEmpresas(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->hasMany(ContratosDosimetriaEmpresa::class, 'id_contratodosimetria_emp');
    }
    //relacion uno a uno con municipioscol
    public function municipios(){
        return $this->belongsTo(Colmunicipio::class, 'municipiocol_id', 'id_municipiocol');
    }
    
    
}
