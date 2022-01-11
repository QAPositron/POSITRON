<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contratodosimetriasede extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_contratodosimetriasede';

    //Relacion uno a muchos (inversa) con empresa
    public function sede(){
        /* return $this->belongsTo('App\Models\Empresa'); */
        return $this->belongsTo(Sede::class, 'sede_id', 'id_sede');
    }

    //Relacion uno a muchos (inversa) con empresa
    public function dosimetriacontrato(){
        /* return $this->belongsTo('App\Models\Empresa'); */
        return $this->belongsTo(Dosimetriacontrato::class, 'contratodosimetria_id', 'id_contrato_dosimetria');
    }
}
