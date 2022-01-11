<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Sede;
use App\Models\Trabajador;
use App\Models\Trabajadorsede;
use Illuminate\Http\Request;

class PruebaController extends Controller
{
    public function index(){
        $empresas = Empresa::all();
        echo $empresas;
        return view('sede.prueba1', compact('empresas'));
    }
    public function index1(){
        $empresas = Empresa::all();
        echo $empresas;
        return view('sede.prueba1', compact('empresas'));
    }
    public function prueba2(Request $request){
        
        $sedes = Sede::where('empresas_id','=', $request->empresa_id)->get();
        foreach($sedes as $sede){
            $sedesArray[$sede->id_sede] = $sede->nombre_sede;
        }
        return response()->json($sedesArray);
        echo "consulta realizada".$sedesArray;
    }

    public function prueba3(Request $request){
        
        $trabajadores = Trabajadorsede::join('trabajadors','trabajadorsedes.trabajador_id','=','trabajadors.id_trabajador')
        ->join('sedes','trabajadorsedes.sede_id', '=', 'sedes.id_sede')
        ->where('sedes.id_sede','=', $request->sede_id)
        ->get();
        foreach($trabajadores as $trab){
            $trabArray[$trab->id_trabajador] = $trab->primer_nombre_trabajador .' '. $trab->segundo_nombre_trabajador .' '. $trab->primer_apellido_trabajador .' '. $trab->segundo_apellido_trabajador;
        }
        return response()->json($trabArray);
        echo "consulta realizada".$trabArray;
        /* echo "LA CONSULTA OBTENIDA ES $trabajadores"; */
    }
    
    
}
