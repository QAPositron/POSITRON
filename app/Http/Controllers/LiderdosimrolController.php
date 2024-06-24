<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contratodosimetriasede;
use App\Models\Contratodosimetriasededepto;
use App\Models\ContratosDosimetriaEmpresa;
use App\Models\Dosimetriacontrato;
use App\Models\Empresa;
use App\Models\Novcontdosisededepto;
use App\Models\Persona;
use App\Models\Personasedes;
use App\Models\Sede;
use App\Models\Trabajadordosimetro;
use Barryvdh\DomPDF\Facade as PDF;
use Database\Seeders\PersonaSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LiderdosimrolController extends Controller
{
    //
    public function index()
    {   
        $user= Auth::user();
        $roles = $user->roles;
        $rolesName = $roles->pluck('name');
        for ($i=0; $i < count($rolesName); $i++) { 
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
       /*  return view('liderdosimRol.home_liderdosimrol', compact('personasede')); */
    } 
    public function contratos(Request $request){
        $empresa = Empresa::where('razon_social_empresa', '=', $request->empresa)->get();
        $contratos = Dosimetriacontrato::where('empresa_id', '=', $empresa[0]->id_empresa)->get();
        
        return response()->json($contratos);
    }
    public function sedes(Request $request){
        $sedescontdosi = Contratodosimetriasede::join('sedes', 'contratodosimetriasedes.sede_id', '=', 'sedes.id_sede')
        ->where('contratodosimetria_id','=', $request->contrato)->get();
        foreach($sedescontdosi as $sede){
            $sedescontdosiArray[$sede->id_contratodosimetriasede] = $sede->nombre_sede;
        }
        return response()->json($sedescontdosiArray);
    }
    public function especialidades(Request $request){
        $contdosisededepto = Contratodosimetriasededepto::join('departamentosedes','contratodosimetriasededeptos.departamentosede_id', '=', 'departamentosedes.id_departamentosede')
        ->join('departamentos', 'departamentosedes.departamento_id', '=', 'departamentos.id_departamento')
        ->where('contratodosimetriasededeptos.contratodosimetriasede_id', '=', $request->sedecontdosi)->get();
        foreach($contdosisededepto as $contdosidepto){
            $contdosideptoArray[$contdosidepto->id_contdosisededepto] = $contdosidepto->nombre_departamento;
        }
        return response()->json($contdosideptoArray);
    }
    public function especialidadesnovedad(Request $request){    
        $novcontdosisededepto = Novcontdosisededepto::where('contdosisededepto_id', '=', $request->espnov)->get();
        return response()->json($novcontdosisededepto);
    }
    public function dosisededeptocontraDetalle($idpersona, $id){
        $personasede = Persona::join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
        ->join('sedes', 'personasedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('personasedes.lider_dosimetria', '=', 'TRUE')
        ->where('id_persona',$idpersona)
        ->get();
        
        $arrayempresas = [];
        foreach ($personasede as $personsed) {
            if(! in_array($personsed->razon_social_empresa, $arrayempresas)){
                array_push($arrayempresas, $personsed->razon_social_empresa);
            }
        }
        
        $contdosisededepto = Contratodosimetriasededepto::find($id);
        return view('liderdosimRol.detalle_esp_sede_liderdosimrol', compact('arrayempresas','personasede', 'contdosisededepto'));
        
    }
    public function dosisededeptocontDetalleSupEsp($idpersona, $id){
        
        $personasede = Persona::join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
        ->join('sedes', 'personasedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('personasedes.lider_dosimetria', '=', 'TRUE')
        ->where('id_personasede',$idpersona)
        ->get();
        $arrayempresas = [];
        foreach ($personasede as $personsed) {
            if(! in_array($personsed->razon_social_empresa, $arrayempresas)){
                array_push($arrayempresas, $personsed->razon_social_empresa);
            }
        }
        $novcontdosisededepto = Novcontdosisededepto::find($id);
        return view('liderdosimRol.detalle_subesp_sede_liderdosimrol', compact('arrayempresas','personasede', 'novcontdosisededepto'));
    }
    public function contratoTrabajadorDetalle($id){
        
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
        $contratodosimetria = Dosimetriacontrato::find($id);
        $trabajadores = Dosimetriacontrato::join('contratodosimetriasedes', 'dosimetriacontratos.id_contratodosimetria', '=', 'contratodosimetriasedes.contratodosimetria_id')
        ->join('trabajadordosimetros', 'contratodosimetriasedes.id_contratodosimetriasede', '=', 'trabajadordosimetros.contratodosimetriasede_id')
        ->join('personas', 'trabajadordosimetros.persona_id', '=', 'personas.id_persona')
        ->where('dosimetriacontratos.id_contratodosimetria', $id)
        ->get();
        /* return $trabajadores; */
        $trabajadoresUnic = $trabajadores->unique('id_persona');
        
        return view('liderdosimRol.detalle_trabajador_liderdosimrol', compact('arrayempresas', 'contratodosimetria', 'trabajadores', 'trabajadoresUnic', 'personasede'));
    }
    public function reportedosiParticular($id, $finiperiodo, $contrato){
        
        $persona = Persona::find($id);
        $asignaciones = Trabajadordosimetro::where('persona_id', '=', $id)
        ->where('measurement_date', '!=', NULL)
        ->where('primer_dia_uso', '<=', $finiperiodo)
        ->get();
        $fechainiciodositrabaj =Trabajadordosimetro::where('persona_id','=', $id)->first();
        $ultimadositrabaj = Trabajadordosimetro::where('persona_id','=', $id)
        ->where('measurement_date', '!=', NULL)
        ->where('primer_dia_uso', '<=', $finiperiodo)
        ->latest()->first();
        
        $pdf = PDF::loadView('liderdosimRol.reporteParticularPDF_dosimetria_liderdosimrol', compact('finiperiodo','persona', 'asignaciones', 'fechainiciodositrabaj', 'ultimadositrabaj'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream();
    }
}
