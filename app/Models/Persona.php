<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_persona';

    public function personasroles(){
        return $this->hasMany(Personasroles::class, 'id_personarol');
    }
    
    public function personasperfiles(){
        return $this->hasMany(Personasperfiles::class, 'id_personaperfil');
    }

    public function personasedes(){
        return $this->hasMany(Personasedes::class, 'id_personasede');
    }
     //relacion uno a muchs con trabajadordosimetro
     public function trabajadordosimetro(){
        return $this->hasMany(Trabajadordosimetro::class, 'id_trabajadordosimetro');
    }
}
