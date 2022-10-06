<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosimetro extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_dosimetro';
    //relacion uno a muchos con trabajadordosimetro
    public function trabajadordosimetro(){
        return $this->hasMany(Trabajadordosimetro::class, 'id_trabajadordosimetro');
    }
   
    //relacion uno a muchos con la tabla dosicontrolcontdosisedes
    public function dosicontrolcontratodosisede(){
        return $this->hasMany(Dosicontrolcontdosisede::class, 'id_dosicontrolcontdosisedes');
    }
    
    //relacion uno a muchos con trabajadordosimetro
    public function temptrabajdosimrev(){
        return $this->hasMany(Temptrabajdosimrev::class, 'id_temptrabajdosimrev');
    }
}
