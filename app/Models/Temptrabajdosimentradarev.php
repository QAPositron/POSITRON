<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temptrabajdosimentradarev extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_temptrabajdosimentradarev';

     //Relacion uno a muchos (inversa) con dosimetros
     public function dosimetro(){
        return $this->belongsTo(Dosimetro::class, 'dosimetro_id', 'id_dosimetro');
    }
    
     //Relacion uno a muchos (inversa) con personas
     public function persona(){
        return $this->belongsTo(Persona::class, 'persona_id', 'id_persona');
    }
    //Relacion uno a uno (inversa) con holder
    public function holder(){
        return $this->belongsTo(Holder::class, 'holder_id', 'id_holder');
    }
    //Relacion uno a uno (inversa) con contradodosimetriasede
    public function contratodosimetriasede(){
        return $this->belongsTo(Contratodosimetriasede::class, 'contratodosimetriasede_id', 'id_contratodosimetriasede');
    }
     //Relacion uno a muchos (inversa) con contratodosimetriasededepto
    public function contratodosimetriasededepto(){
        return $this->belongsTo(Contratodosimetriasededepto::class, 'contdosisededepto_id', 'id_contdosisededepto');
    }
    
}
