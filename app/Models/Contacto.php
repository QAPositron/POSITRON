<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_contacto';
     //relacion uno a muchos
    public function trabajadorsedes(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->hasMany(Contactosede::class, 'id_contactosede');
    }
}
