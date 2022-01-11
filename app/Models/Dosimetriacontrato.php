<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosimetriacontrato extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_contrato_dosimetria';

    //relacion uno a muchos con contrato dosimetria sede
    public function contratodosimetriasede(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->hasMany(Contratodosimetriasede::class, 'id_contratodosimetriasede');
    }
}
