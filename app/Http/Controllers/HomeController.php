<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Undefined;

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
        $empresa = Empresa::all();
        $user= Auth::user();
        $roles = $user->roles;
        $rolesName = $roles->pluck('name');
        $arrayRoles = $rolesName->toArray();
        if(in_array("LIDER DE DOSIMETRIA", $arrayRoles)){
            $personasede = Persona::join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
            ->join('sedes', 'personasedes.sede_id', '=', 'sedes.id_sede')
            ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
            ->where('personasedes.lider_dosimetria', '=', 'TRUE')
            ->where('id_persona', auth()->user()->persona_id)
            ->get();
            $arrayempresas = [];
            foreach ($personasede as $personsed) {
                if(! in_array($personsed->razon_social_empresa, $arrayempresas)){
                    array_push($arrayempresas, $personsed->razon_social_empresa);
                }
            }
            $contdosisededepto = null;
            return view('liderdosimRol.home_liderdosimrol', compact('personasede', 'arrayempresas', 'contdosisededepto'));
        }else{
            return view('empresa.buscar_empresa',compact('empresa'));
        }
        /* for ($i=0; $i < count($rolesName); $i++) { 
            if ($rolesName[$i] == 'LIDER DE DOSIMETRIA') {
               

                $personasede = Persona::join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
                ->join('sedes', 'personasedes.sede_id', '=', 'sedes.id_sede')
                ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
                ->where('personasedes.lider_dosimetria', '=', 'TRUE')
                ->where('id_persona', auth()->user()->persona_id)
                ->get();
                $arrayempresas = [];
                foreach ($personasede as $personsed) {
                    if(! in_array($personsed->razon_social_empresa, $arrayempresas)){
                        array_push($arrayempresas, $personsed->razon_social_empresa);
                    }
                }
                
                return view('liderdosimRol.home_liderdosimrol', compact('personasede', 'arrayempresas'));
            }
        }
        

        return view('empresa.buscar_empresa',compact('empresa')); */
        /* return view('home'); */
    }
}
