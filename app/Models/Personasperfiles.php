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
    
}
