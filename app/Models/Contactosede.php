<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactosede extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_contactosede';

        //Relacion uno a muchos (inversa) con contactos
        public function contacto(){
            /* return $this->belongsTo('App\Models\Empresa'); */
            return $this->belongsTo(Contacto::class, 'contacto_id', 'id_contacto');
    
        }
        //Relacion uno a muchos (inversa) con sede
        public function sede(){
            /* return $this->belongsTo('App\Models\Empresa'); */
            return $this->belongsTo(Sede::class, 'sede_id', 'id_sede');
    
        }

}
