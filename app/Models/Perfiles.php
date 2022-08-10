<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfiles extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_perfil'; 

    public function personasperfiles(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->hasMany(Personasperfiles::class, 'id_personaperfil');
    }
}
