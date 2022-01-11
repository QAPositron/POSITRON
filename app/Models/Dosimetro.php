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
   
}
