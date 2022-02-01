<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamentosede extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_departamentosede';

    //Relacion uno a muchos (inversa) con sede
    public function sede(){
        return $this->belongsTo(Sede::class, 'sede_id', 'id_sede');
    }
}
