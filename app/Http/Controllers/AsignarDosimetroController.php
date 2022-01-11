<?php

namespace App\Http\Controllers;

use App\Models\Dosimetro;
use App\Models\Empresa;
use App\Models\Holder;
use App\Models\Sede;
use App\Models\Trabajadordosimetro;
use App\Models\Trabajadorsede;
use Illuminate\Http\Request;

class AsignarDosimetroController extends Controller
{
    public function create(){
        /* $dosimetro = Dosimetro::leftJoin('trabajadordosimetros','dosimetros.id_dosimetro','=','trabajadordosimetros.dosimetro_id')
        ->whereNull('trabajadordosimetros.dosimetro_id')
        ->select("*")
        ->get();
        $holder = Holder::leftJoin('trabajadordosimetros','holders.id_holder', '=', 'trabajadordosimetros.holder_id') 
        ->whereNull('trabajadordosimetros.holder_id')
        ->select("*")
        ->get(); */
        $empresas = Empresa::all();
        /* return $empresas; */
        return view('dosimetro.asignar_dosimetro', compact('empresas')); 
    }

    public function save(Request $request){
        
        $request->validate([
            'codigo_dosimetro'  => 'required',
            'holder_dosimetro'  => 'required',              
            'id_empresas'       => 'required',  
            'id_sedes'          => 'required',
            'id_trabajadores'   => 'required',
        ]);
        
        $dosiasignado = new Trabajadordosimetro();

        $dosiasignado->dosimetro_id        = $request->codigo_dosimetro;
        $dosiasignado->trabajador_id       = $request->id_trabajadores;
        $dosiasignado->holders_id          = $request->holder_dosimetro;
        $dosiasignado->empresa_id          = $request->id_empresas;
        $dosiasignado->sede_id             = $request->id_sedes;
       
        $dosiasignado->save();

    
        return $dosiasignado;
        
    }

    
}
