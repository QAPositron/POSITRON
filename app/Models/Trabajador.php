<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_trabajador';

    public function empresa(){
        /* return $this->belongsTo('App\Models\Empresa'); */
        return $this->belongsTo(Empresa::class, 'empresas_id', 'id_empresa');
    }
    
    //relacion uno a muchos con trabajadorsedes
    public function trabajadorsedes(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->hasMany(Trabajadorsede::class, 'id_trabajadoresede');
    }
    
    //relacion uno a muchs con trabajadordosimetro
    public function trabajadordosimetro(){
        return $this->hasMany(Trabajadordosimetro::class, 'id_trabajadordosimetro');
    }

}
