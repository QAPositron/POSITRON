<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacionobservacion extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_cotiobs';

    //Relacion uno a muchos (inversa) con cotizacion
    public function cotizacion(){
        return $this->belongsTo(Cotizacion::class, 'cotizacion_id', 'id_cotizacion');
    }

}
