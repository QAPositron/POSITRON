<?php

namespace App\Http\Controllers;

use App\Models\Perfiles;
use Illuminate\Http\Request;

class PerfilesController extends Controller
{
    //
    public function save(Request $request){

        
        /* return $request; */
        $perfil = new Perfiles();
        $perfil->nombre_perfil = strtoupper($request->nombre_perfil_laboral);

        $perfil->save();
        return back()->with('guardar', 'ok');
    }
}
