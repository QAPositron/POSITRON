<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacionproducto extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_cotiprod';

    //Relacion uno a muchos (inversa) con productos
    public function producto(){
        return $this->belongsTo(Producto::class, 'producto_id', 'id_producto');
    }
    //Relacion uno a muchos (inversa) con cotizacion
    public function cotizacion(){
        return $this->belongsTo(Cotizacion::class, 'cotizacion_id', 'id_cotizacion');
    }
}
