<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosicontrolcontdosisede extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_dosicontrolcontdosisedes';

    //Relacion uno a muchos (inversa) con contrato dosimetria sede
    public function contratodosimetriasede(){
        return $this->belongsTo(Contratodosimetriasede::class, 'contratodosimetriasede_id', 'id_contratodosimetriasede');
    }
    //Relacion uno a muchos (inversa) con sedes
    public function sede(){
        return $this->belongsTo(Sede::class, 'sede_id', 'id_sede');
    }
     //Relacion uno a muchos (inversa) con dosimetros
     public function dosimetro(){
        return $this->belongsTo(Dosimetro::class, 'dosimetro_id', 'id_dosimetro');
    }
}
