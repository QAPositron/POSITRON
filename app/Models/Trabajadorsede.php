<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajadorsede extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_trabajadoresede';

    //Relacion uno a muchos (inversa) con empresa
    public function trabajador(){
        /* return $this->belongsTo('App\Models\Empresa'); */
        return $this->belongsTo(Trabajador::class, 'trabajador_id', 'id_trabajador');

    }
    //Relacion uno a muchos (inversa) con sede
    public function sede(){
        /* return $this->belongsTo('App\Models\Empresa'); */
        return $this->belongsTo(Sede::class, 'sede_id', 'id_sede');
    }
}
