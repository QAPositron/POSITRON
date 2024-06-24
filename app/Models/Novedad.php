<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novedad extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_novedad'; 
    
    public function dosimetriacontrato(){
        /* return $this->belongsTo('App\Models\Empresa'); */
        return $this->belongsTo(Dosimetriacontrato::class, 'contratodosimetria_id', 'id_contratodosimetria');
    } 

    public function novedadmesescontdosi(){
        return $this->hasMany(Novedadmesescontdosisededepto::class, 'id_novedadmesescontdosi');
    }
    
}
