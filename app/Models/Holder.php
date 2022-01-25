<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holder extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_holder';

    //relacion uno a muchos con trabajador dosiemtro
    public function trabajadordosimetro(){
        return $this->hasOne(Trabajadordosimetro::class, 'id_trabajadordosimetro');
    }
}
