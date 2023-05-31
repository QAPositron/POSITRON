<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_cotizacion';

     //relacion uno a muchos con CotizacionProductos
    public function cotizacionProductos(){
        return $this->hasMany(Cotizacionproducto::class, 'id_cotiprod');
    }
    //Relacion uno a uno (inversa) con Empresa
    public function empresa(){
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id_empresa');
    }
    //Relacion uno a uno (inversa) con Sede
    public function sede(){
        return $this->belongsTo(Sede::class, 'sede_id', 'id_sede');
    }
}
