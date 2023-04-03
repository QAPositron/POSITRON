<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_observacion'; 

    public function obsreventrada(){
        /* return $this->hasMany('App\Models\Sede'); */
        return $this->hasMany(Obsreventrada::class, 'id_obsreventrada');
    }
}
