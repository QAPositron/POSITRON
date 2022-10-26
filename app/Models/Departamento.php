<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_departamento';

    public function departamentosedes(){
        return $this->hasMany(Departamentosede::class, 'id_departamentosede');
    }
}
