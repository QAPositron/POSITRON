<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personasperfiles extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_personaperfil';

    public function persona(){
        return $this->belongsTo(Persona::class,'persona_id', 'id_persona');
    }

    public function perfiles(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->belongsTo(Perfiles::class, 'perfil_id', 'id_perfil');
    }

    
}
