<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosiareacontdosisede extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_dosiareacontdosisedes';

    //Relacion uno a muchos (inversa) con contrato dosimetria sede
    public function contratodosimetriasede(){
        return $this->belongsTo(Contratodosimetriasede::class, 'contratodosimetriasede_id', 'id_contratodosimetriasede');
    }
      //Relacion uno a muchos (inversa) con contratodosimetriasededepto
    public function contratodosimetriasededepto(){
        return $this->belongsTo(Contratodosimetriasededepto::class, 'contdosisededepto_id','id_contdosisededepto');
    }
      //Relacion uno a muchos (inversa) con dosimetros
    public function dosimetro(){
        return $this->belongsTo(Dosimetro::class, 'dosimetro_id', 'id_dosimetro');
    }
    public function areadepartamentosede(){
      return $this->belongsTo(Areadepartamentosede::class, 'areadepartamentosede_id', 'id_areadepartamentosede');
    }
}
