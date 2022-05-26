<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Areadepartamentosede extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_areadepartamentosede';

    //Relacion uno a muchos (inversa) con departamentosede
    public function departamentosede(){
        return $this->belongsTo(Departamentosede::class, 'departamentosede_id', 'id_departamentosede');
    }
    public function dosiareacontdosisede(){
        return $this->hasMany(Dosiareacontdosisede::class, 'id_dosiareacontdosisedes');
    }

}
