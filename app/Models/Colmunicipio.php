<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colmunicipio extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_municipiocol' ;

     //Relacion uno a muchos (inversa) con coldepartamento
    public function coldepartamento(){
        return $this->belongsTo(Coldepartamento::class, 'departamentocol_id', 'id_departamentocol');
    }
    //relacion uno a uno (inversa) con empresa
    public function empresa(){
        return $this->hasOne(Empresa::class, 'municipiocol_id', 'id_municipiocol');
    }
    //relacion uno a uno (inversa) con empresa  
    public function sede(){
        return $this->hasOne(Sede::class, 'municipiocol_id', 'id_municipiocol');
    }

}
