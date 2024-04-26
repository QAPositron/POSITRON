<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function login(){
        $user= Auth::user();
        $roles = $user->roles;
        $rolesName = $roles->pluck('name');
        for ($i=0; $i < count($rolesName); $i++) { 
            if ($rolesName[$i] == 'LIDER DE DOSIMETRIA') {
                /* $liderEmpresas =  */

                $personasede = Persona::join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
                ->join('sedes', 'personasedes.sede_id', '=', 'sedes.id_sede')
                ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
                ->where('id_persona', auth()->user()->id)
                ->get();
                /* return $personasede; */
                return view('liderdosimRol.home_liderdosimrol', compact('personasede'));
            }
        }
        $empresa = Empresa::all();

        return view('empresa.buscar_empresa',compact('empresa'));
        /* return view('home'); */
    }
}
