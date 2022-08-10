<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_rol'; 

    
    public function personasroles(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->hasMany(Personasroles::class, 'id_personarol');
    }
}
