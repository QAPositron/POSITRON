<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratosDosimetriaEmpresa extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_contrato_dosimetria_emp';
    //Relacion uno a muchos (inversa) con empresa
    public function empresa(){
        
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id_empresa');
    }
}
