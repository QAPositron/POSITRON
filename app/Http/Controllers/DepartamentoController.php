<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    //
    public function save(Request $request){
        /* return $request; */
        
        $depto = new Departamento();
 
        $depto->nombre_departamento = strtoupper($request->nombre_especialidad);
 
        $depto->save();
        return back()->with('guardar', 'ok');
    }
}
