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
        return $this->hasOne(Trabajadordosimetro::class, 'holder_id', 'id_holder');
    }
    //relacion uno a muchos con trabajador dosiemtro
    public function temptrabajdosimrev(){
        return $this->hasOne(Temptrabajdosimrev::class, 'holder_id', 'id_holder');
    }

    //relacion uno a muchos con trabajador dosiemtro
    public function temptrabajdosimentradarev(){
        return $this->hasOne(Temptrabajdosimentradarev::class, 'holder_id', 'id_holder');
    }

}
