<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use App\Models\Personasedes;
use Database\Seeders\PersonaSeeder;
use Illuminate\Http\Request;

class LiderdosimrolController extends Controller
{
    //
    /* public function index()
    {   $personasede = Persona::join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
        ->join('sedes', 'personasedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('id_persona', auth()->user()->id)
        ->get();
        
        return view('liderdosimRol.home_liderdosimrol', compact('personasede'));
    } */
    public function sedes()
    {
        return view('liderdosimRol.empresasede_liderdosimrol');
    }
}
