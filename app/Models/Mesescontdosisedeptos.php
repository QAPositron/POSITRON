<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Mesescontdosisedeptos extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_mescontdosisededepto';

    //Relacion uno a muchos (inversa) con contrato dosimetria sedes
    public function contratodosimetriasededepto(){
        return $this->belongsTo(Contratodosimetriasededepto::class, 'contdosisededepto_id', 'id_contdosisededepto');
    }

    //relacion uno a muchos (inversa) con novcontdosisededeptos
    public function novcontdosisededepto(){
        return $this->belongsTo(Novcontdosisededepto::class, 'novcontdosisededepto_id ', 'id_novcontdosisededepto');
    }
}