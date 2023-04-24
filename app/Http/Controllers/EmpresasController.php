<?php

namespace App\Http\Controllers;

use App\Models\Areadepartamentosede;
use App\Models\Coldepartamento;
use App\Models\Colmunicipio;
use App\Models\Contacto;
use App\Models\Contactosede;
use App\Models\Departamento;
use App\Models\Departamentosede;
use App\Models\Empresa;
use App\Models\Persona;
use App\Models\Personasperfiles;
use App\Models\Personasroles;
use App\Models\Sede;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmpresasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create(){
        $departamentoscol = Coldepartamento::all();
        $municipioscol = Colmunicipio::all();
        $especialidades = Departamento::all();
        return view('empresa.crear_empresa', compact('departamentoscol', 'municipioscol', 'especialidades'));
        /* return $departamentoscol; */
    }

    public function selectmunicipios(Request $request)
    {
        $municipios = Colmunicipio::where('departamentocol_id', '=', $request->departamento_id)->get();
        foreach($municipios as $muni){
            $municipiosArray[$muni->id_municipiocol] = $muni->nombre_municol;
        }
        return response()->json($municipiosArray);
        echo "CONSULTA REALIZADA".$municipiosArray;        
    }
    public function save(Request $request){
        
        $request->validate([
            'nombre_empresa'      => ['required', Rule::unique('empresas', 'nombre_empresa')],
            'tipo_empresa'        => ['required'],               
            'tipoIden_empresa'    => ['required'], 
            
            'nitdv_empresa'       => ['max:1'], 
            'actividad_empresa'   => ['required', 'min:4', 'max:4'],
            'respoIva_empresa'    => ['required'],   
            'respoFiscal_empresa' => ['required'],
            'telefono_empresa'    => ['required', 'max:10', 'min:10'],
            'correo_empresa'      => ['required', 'email',  Rule::unique('empresas', 'email_empresa')],
            'direccion_empresa'   => ['required'],
            'pais_empresa'        => ['required'],
            'ciudad_empresa'      => ['required']
            /* 'nombreRepr_empresa'  => ['required'],
            'tipoIden_repreLegal' => ['required'],
            'cedula_Repr_empresa' => ['required'] */
            
        ]);
        if($request->tipoIden_empresa == 'NIT'){
            $request->validate([
                'numero_ident'    => ['required', 'min:9','max:9',  Rule::unique('empresas', 'num_iden_empresa')],
            ]);
        }elseif($request->tipoIden_empresa == 'CÉDULA DE CIUDADANIA'){
            $request->validate([
                'numero_ident'    => ['required', 'min:7',  Rule::unique('empresas', 'num_iden_empresa')],
            ]);
        }
        
        $empresa = new Empresa();

        $empresa->nombre_empresa                    = mb_strtoupper($request->nombre_empresa);
        $empresa->tipo_identificacion_empresa       = mb_strtoupper($request->tipoIden_empresa);
        $empresa->num_iden_empresa                  = $request->numero_ident;
        $empresa->DV                                = $request->nitdv_empresa;
        $empresa->tipo_empresa                      = mb_strtoupper($request->tipo_empresa);
        $empresa->actividad_economica_empresa       = $request->actividad_empresa;
        $empresa->respo_iva_empresa                 = mb_strtoupper($request->respoIva_empresa);
        $empresa->respo_fiscal_empresa              = mb_strtoupper($request->respoFiscal_empresa);
        $empresa->telefono_empresa                  = $request->telefono_empresa;
        $empresa->email_empresa                     = mb_strtoupper($request->correo_empresa);
        $empresa->email_verified_at                 = now();
        $empresa->direccion_empresa                 = mb_strtoupper($request->direccion_empresa);
        $empresa->pais_empresa                      = mb_strtoupper($request->pais_empresa);
        $empresa->municipiocol_id                   = $request->ciudad_empresa;
        $empresa->nombre_representantelegal         = mb_strtoupper($request->nombreRepr_empresa);
        $empresa->tipo_iden_representantelegal      = mb_strtoupper($request->tipoIden_repreLegal);
        $empresa->cedula_representantelegal         = $request->cedula_Repr_empresa;
        
        $empresa->save();

        if(!empty($request->especialidades)){
            $sede = new Sede();

            $sede->empresas_id         = $empresa->id_empresa;
            $sede->nombre_sede         = 'PRINCIPAL';
            $sede->municipiocol_id     = $request->ciudad_empresa;       
            $sede->direccion_sede	   = mb_strtoupper($request->direccion_empresa);
            
            $sede->save();

            for($i=0; $i<count($request->especialidades); $i++){

                $deptosede = new Departamentosede();

                $deptosede->sede_id                 = $sede->id_sede;
                $deptosede->departamento_id         = $request->especialidades[$i];
                
                $deptosede->save();
            }
        }
        return redirect()->route('empresas.search')->with('guardar', 'ok');
    }

    public function search(){
        $empresa = Empresa::all();
        return view('empresa.buscar_empresa', compact('empresa'));
    }

    public function edit(Empresa $empresa){
        $departamentoscol = Coldepartamento::all();
        return view('empresa.edit_empresa', compact('empresa', 'departamentoscol'));
    }

    public function update(Request $request, Empresa $empresa){
       
        $request->validate([
            'nombre_empresa'      => ['required', Rule::unique('empresas', 'nombre_empresa')->ignore($empresa->id_empresa, 'id_empresa')],
            'tipo_empresa'        => ['required'],              
            'tipoIden_empresa'    => ['required'],   
            'numero_ident'        => ['required', 'max:10', Rule::unique('empresas', 'num_iden_empresa')->ignore($empresa->id_empresa, 'id_empresa')],
            'nitdv_empresa'       => ['max:1'],  
            'actividad_empresa'   => ['required', 'max:4', 'min:4'],
            'respoIva_empresa'    => ['required'],       
            'respoFiscal_empresa' => ['required'],   
            'telefono_empresa'    => ['required', 'max:10', 'min:10'],
            'correo_empresa'      => ['required', 'email', Rule::unique('empresas', 'email_empresa')->ignore($empresa->id_empresa, 'id_empresa')],   
            'direccion_empresa'   => ['required'],   
            'pais_empresa'        => ['required'],   
            'ciudad_empresa'      => ['required'],   
            'departamento_empresa'=> ['required'],
            'nombreRepr_empresa'  => ['required'],
            'tipoIden_repreLegal' => ['required'],
            'cedula_Repr_empresa' => ['required']
        ]);
        
        $empresa->nombre_empresa                    = mb_strtoupper($request->nombre_empresa);
        $empresa->tipo_identificacion_empresa       = mb_strtoupper($request->tipoIden_empresa);
        $empresa->num_iden_empresa                  = $request->numero_ident;
        $empresa->DV                                = $request->nitdv_empresa;
        $empresa->tipo_empresa                      = mb_strtoupper($request->tipo_empresa);
        $empresa->actividad_economica_empresa       = $request->actividad_empresa;
        $empresa->respo_iva_empresa                 = mb_strtoupper($request->respoIva_empresa);
        $empresa->respo_fiscal_empresa              = mb_strtoupper($request->respoFiscal_empresa);
        $empresa->telefono_empresa                  = $request->telefono_empresa;
        $empresa->email_empresa                     = mb_strtoupper($request->correo_empresa);
        $empresa->email_verified_at                 = now();
        $empresa->direccion_empresa                 = mb_strtoupper($request->direccion_empresa);
        $empresa->pais_empresa                      = mb_strtoupper($request->pais_empresa);
        $empresa->municipiocol_id                   = $request->ciudad_empresa;
        $empresa->nombre_representantelegal         = mb_strtoupper($request->nombreRepr_empresa);
        $empresa->tipo_iden_representantelegal      = mb_strtoupper($request->tipoIden_repreLegal);
        $empresa->cedula_representantelegal         = $request->cedula_Repr_empresa;
        
        $empresa->save();
        return redirect()->route('empresas.search')->with('actualizar', 'ok');
    }

    public function destroy(Empresa $empresa){
        $empresa->delete();
        return redirect()->route('empresas.search')->with('eliminar', 'ok');
    }

    public function info(Empresa $empresa){
        /* SELECT * FROM trabajadors INNER JOIN trabajadorsedes ON trabajadors.id_trabajador = trabajadorsedes.trabajador_id INNER JOIN sedes ON trabajadorsedes.sede_id = sedes.id_sede INNER JOIN empresas ON sedes.empresas_id = empresas.id_empresa WHERE empresas.id_empresa = 1; */
        $sede = Sede::where('empresas_id', $empresa->id_empresa)->get();
        $departamentos = Departamento::join('departamentosedes', 'departamentos.id_departamento', '=', 'departamentosedes.departamento_id')
        ->join('sedes', 'departamentosedes.sede_id', '=', 'sedes.id_sede')
        ->where('empresas_id', '=', $empresa->id_empresa)
        ->select('nombre_departamento', 'sede_id', 'id_departamentosede')
        ->get();
        $areadeptos = Areadepartamentosede::join('departamentosedes', 'areadepartamentosedes.departamentosede_id', '=', 'departamentosedes.id_departamentosede')
        ->join('departamentos', 'departamentosedes.departamento_id', '=', 'departamentos.id_departamento')
        ->join('sedes','departamentosedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('empresas_id', '=', $empresa->id_empresa)
        ->orderBy('nombre_departamento', 'ASC')
        ->get();
        /* $trabajador = Trabajador::join('trabajadorsedes','trabajadors.id_trabajador', '=', 'trabajadorsedes.trabajador_id')
        ->join('sedes','trabajadorsedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('empresas.id_empresa', '=', $empresa->id_empresa)
        ->orderBy('sedes.id_sede')
        ->select("*")
        ->get(); */
        /* SELECT * FROM `personas` INNER join personasroles ON personas.id_persona = personasroles.persona_id 
        INNER JOIN roles ON personasroles.rol_id = roles.id_rol 
        INNER JOIN personasedes ON personas.id_persona = personasedes.persona_id 
        INNER JOIN sedes ON personasedes.sede_id = sedes.id_sede
         where roles.nombre_rol = 'TOE' OR roles.nombre_rol = 'OPR' AND sedes.empresas_id = 1; */
        $trabajadorDosim = Persona::join('personasroles', 'personas.id_persona', '=', 'personasroles.persona_id')
        ->join('roles', 'personasroles.rol_id', '=', 'roles.id_rol')
        ->join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
        ->join('sedes', 'personasedes.sede_id', 'sedes.id_sede')
        ->where('sedes.empresas_id', '=', $empresa->id_empresa)
        ->where(function($query) {
            $query->orWhere('roles.nombre_rol', 'TOE')
                  ->orWhere('roles.nombre_rol', 'OPR')
                  ->orWhere('roles.nombre_rol', 'PUBLICO');
        })->orderBy('sedes.id_sede')->get();
        $personasperfiles = Personasperfiles::all();
        $personasroles = Personasroles::all();
        $estudianteAva = Persona::join('personasroles', 'personas.id_persona', '=', 'personasroles.persona_id')
        ->join('roles', 'personasroles.rol_id', '=', 'roles.id_rol')
        ->join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
        ->join('sedes', 'personasedes.sede_id', 'sedes.id_sede')
        ->where('sedes.empresas_id', '=', $empresa->id_empresa)
        ->where('roles.nombre_rol',  '=', 'ESTUDIANTE')
        ->orderBy('sedes.id_sede')->get(); 
        /* SELECT * FROM `contactos` INNER JOIN contactosedes ON contactos.id_contacto = contactosedes.id_contactosede INNER JOIN sedes ON contactosedes.sede_id = sedes.id_sede INNER JOIN empresas ON sedes.empresas_id = empresas.id_empresa ORDER BY sedes.id_sede; */
       /*  $contacto = Contactosede::join('contactos', 'contactosedes.contacto_id', '=', 'contactos.id_contacto')
        ->join('sedes', 'contactosedes.sede_id', '=', 'sedes.id_sede') 
        ->join('empresas','sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('empresas.id_empresa', '=', $empresa->id_empresa)
        ->orderBy('sedes.id_sede')
        ->select("*")
        ->get(); */
        $contacto = Persona::join('personasroles', 'personas.id_persona', '=', 'personasroles.persona_id')
        ->join('roles', 'personasroles.rol_id', '=', 'roles.id_rol')
        ->join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
        ->join('sedes', 'personasedes.sede_id', 'sedes.id_sede')
        ->where('sedes.empresas_id', '=', $empresa->id_empresa)
        ->where('roles.nombre_rol',  '=', 'CONTACTO')
        ->orderBy('sedes.id_sede')->get(); 
        /* return $trabajadorDosim; */
        return view('empresa.info_empresa', compact('empresa' ,'sede', 'trabajadorDosim', 'personasperfiles', 'personasroles', 'estudianteAva', 'contacto', 'departamentos', 'areadeptos'));
    }
   
}
