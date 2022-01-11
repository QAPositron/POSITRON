<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holder extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_holder';

    //relacion uno a muchos
    public function trabajadordosimetro(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->hasOne(Trabajadordosimetro::class, 'id_trabajadordosimetro');
    }
}
