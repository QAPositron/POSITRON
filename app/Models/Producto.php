<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_producto';


     //relacion uno a muchos con CotizacionProductos
    public function cotizacionProductos(){
        return $this->hasMany(Cotizacionproducto::class, 'id_cotiprod');
    }
}
