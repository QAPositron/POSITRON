<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personasedes extends Model
{
    use HasFactory; 
    protected $primaryKey = 'id_personasede';
    
    public function persona(){
        return $this->belongsTo(Persona::class,'persona_id', 'id_persona');
    }

    public function sede(){
        return $this->belongsTo(Sede::class, 'sede_id', 'id_sede');
    }

}
