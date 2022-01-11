<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajadordosimetro extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_trabajadordosimetro';
    //Relacion uno a muchos (inversa) con dosimetros
    public function dosimetro(){
        return $this->belongsTo(Dosimetro::class, 'dosimetro_id', 'id_dosimetro');
    }

    //Relacion uno a muchos (inversa) con trabajadores
    public function trabajador(){
        return $this->belongsTo(Trabajador::class, 'trabajador_id', 'id_trabajador');
    }
    //Relacion uno a uno (inversa) con holder
    public function holder(){
        /* return $this->belongsTo('App\Models\Empresa'); */
        return $this->belongsTo(Holder::class, 'holders_id', 'id_holder');
    }

    public function empresa(){
        /* return $this->belongsTo('App\Models\Empresa'); */
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id_empresa');
    }
    public function sede(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->belongsTo(Sede::class, 'sede_id', 'id_sede');
    }
}
