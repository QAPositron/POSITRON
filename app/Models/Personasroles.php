<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Personasroles extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_personarol';

    public function persona(){
        return $this->belongsTo(Persona::class,'persona_id', 'id_persona');
    }


    public function roles(){
        return $this->belongsTo(Role::class,'role_id', 'id');
    }
}
