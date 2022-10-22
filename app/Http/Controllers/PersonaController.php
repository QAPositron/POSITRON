<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Perfiles;
use App\Models\Persona;
use App\Models\Personasedes;
use App\Models\Personasperfiles;
use App\Models\Personasroles;
use App\Models\Roles;
use App\Models\Sede;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    //
    public function search(){
        $persona = Persona::all();
        /* SELECT * FROM `personas` INNER JOIN personasedes ON personas.id_persona = personasedes.persona_id 
        INNER JOIN personasperfiles ON personas.id_persona = personasperfiles.persona_id 
        INNER JOIN perfiles ON personasperfiles.perfil_id = perfiles.id_perfil 
        INNER JOIN personasroles ON personas.id_persona = personasroles.persona_id 
        INNER JOIN roles ON personasroles.rol_id = roles.id_rol; */
        $personasrolesperfilesedes = Persona::join('personasedes', 'personas.id_persona',  '=', 'personasedes.persona_id')
        ->join('personasperfiles', 'personas.id_persona', '=', 'personasperfiles.persona_id')
        ->join('perfiles', 'personasperfiles.perfil_id', '=', 'perfiles.id_perfil')
        ->join('personasroles', 'personas.id_persona', '=', 'personasroles.persona_id')
        ->join('roles', 'personasroles.rol_id', '=', 'roles.id_rol')
        ->select("*")
        ->get();
        $personasedes = Personasedes::all();
        $personasperfiles = Personasperfiles::all();
        $personasroles = Personasroles::all(); 
        return view('persona.buscar_persona', compact('persona', 'personasrolesperfilesedes', 'personasperfiles', 'personasroles', 'personasedes'));
       
    }
    
    public function create(){
        $empresas = Empresa::all();
        $perfiles = Perfiles::all();
        $roles    = Roles::all();
        return view('persona.crear_persona', compact('empresas', 'perfiles', 'roles'));
    }
    public function selectsedes(Request $request){
        $sedes = Sede::where('empresas_id','=', $request->empresa_id)->get();
        foreach($sedes as $sede){
            $sedesArray[$sede->id_sede] = $sede->nombre_sede;
        }
        return response()->json($sedesArray);
        echo "consulta realizada".$sedesArray;
    }
    public function save(Request $request){

        $request->validate([
            
            'primer_nombre_persona'      => 'required',              
            'primer_apellido_persona'    => 'required',
            'segundo_apellido_persona'   => 'required',
            'tipoIden_persona'           => 'required',
            'cedula_persona'             => 'required|unique:App\Models\Persona,cedula_persona,',    
            'genero_persona'             => 'required',
            'correo_persona'             => 'required',
            'telefono_persona'           => 'required|max:12',
            
        ]);

        $persona = new Persona();

        $persona->primer_nombre_persona     = strtoupper($request->primer_nombre_persona);
        $persona->segundo_nombre_persona    = strtoupper($request->segundo_nombre_person);
        $persona->primer_apellido_persona   = strtoupper($request->primer_apellido_persona);
        $persona->segundo_apellido_persona  = strtoupper($request->segundo_apellido_persona);
        $persona->tipo_iden_persona         = strtoupper($request->tipoIden_persona);
        $persona->genero_persona            = strtoupper($request->genero_persona);
        $persona->cedula_persona            = $request->cedula_persona;
        $persona->correo_persona            = strtoupper($request->correo_persona);
        $persona->telefono_persona          = $request->telefono_persona;
        $persona->lider_ava                 = $request->lider_ava;
        $persona->lider_dosimetria          = $request->lider_dosimetria;
        $persona->lider_controlescalidad    = $request->lider_contcal;

        $persona->save();
        if(!empty($request->perfil_personas)){
            for($i=0; $i<count($request->perfil_personas); $i++){
                $personasPerfiles = new Personasperfiles();
                
                $personasPerfiles->persona_id = $persona->id_persona;
                $personasPerfiles->perfil_id  = $request->perfil_personas[$i];
                
                $personasPerfiles->save();
            }
        }
        if(!empty($request->rol_personas)){
            for($i=0; $i<count($request->rol_personas); $i++){
                $personasRoles = new Personasroles();
    
                $personasRoles->persona_id  = $persona->id_persona;
                $personasRoles->rol_id      = $request->rol_personas[$i];
    
                $personasRoles->save();
            }
        }
        if(!empty($request->id_sedes)){
            for($i=0; $i<count($request->id_sedes); $i++){
                $personaSedes = new Personasedes();
    
                $personaSedes->persona_id   = $persona->id_persona;
                $personaSedes->sede_id      = $request->id_sedes[$i];
    
                $personaSedes->save();
            }
        }

        return redirect()->route('personas.search')->with('guardar', 'ok');
    }
    public function edit(Persona $persona){
        /* return $persona; */
        $personasede = Personasedes::where('persona_id', '=', $persona->id_persona)
        ->get();
        $personasperfil = Personasperfiles::where('persona_id', '=', $persona->id_persona)
        ->get();
        $personasrol = Personasroles::where('persona_id', '=', $persona->id_persona)
        ->get();
        $empresas = Empresa::all();
        $perfiles = Perfiles::all();
        $roles    = Roles::all();
        return view('persona.edit_persona', compact('persona', 'personasede', 'empresas', 'perfiles', 'roles', 'personasperfil', 'personasrol'));
    }

    public function update(Request $request, Persona $persona){
        /*return $request;*/
        $request->validate([
            
            'primer_nombre_persona'      => 'required',              
            'primer_apellido_persona'    => 'required',
            'segundo_apellido_persona'   => 'required',
            'tipoIden_persona'           => 'required',
            'cedula_persona'             => 'required',    
            'genero_persona'             => 'required',
            'correo_persona'             => 'required',
            'telefono_persona'           => 'required|max:12',
            
        ]);
        $persona->primer_nombre_persona     = strtoupper($request->primer_nombre_persona);
        $persona->segundo_nombre_persona    = strtoupper($request->segundo_nombre_persona);
        $persona->primer_apellido_persona   = strtoupper($request->primer_apellido_persona);
        $persona->segundo_apellido_persona  = strtoupper($request->segundo_apellido_persona);
        $persona->genero_persona            = strtoupper($request->genero_persona);
        $persona->tipo_iden_persona         = strtoupper($request->tipoIden_persona);
        $persona->cedula_persona            = $request->cedula_persona;
        $persona->correo_persona            = strtoupper($request->correo_persona);
        $persona->telefono_persona          = $request->telefono_persona;
        $persona->lider_ava                 = $request->lider_ava;
        $persona->lider_dosimetria          = $request->lider_dosimetria;
        $persona->lider_controlescalidad    = $request->lider_contcal;

        $persona->save();
        if(!empty($request->perfil_personas)){

            for($i=0; $i<count($request->perfil_personas); $i++){
                $personasPerfiles = new Personasperfiles();
                
                $personasPerfiles->persona_id = $persona->id_persona;
                $personasPerfiles->perfil_id  = $request->perfil_personas[$i];
                
                $personasPerfiles->save();
            }
        }
        if(!empty($request->rol_personas)){

            for($i=0; $i<count($request->rol_personas); $i++){
                $personasRoles = new Personasroles();
    
                $personasRoles->persona_id  = $persona->id_persona;
                $personasRoles->rol_id      = $request->rol_personas[$i];
    
                $personasRoles->save();
            }
        }
        if(!empty($request->id_sedes)){

            for($i=0; $i<count($request->id_sedes); $i++){
                $personaSedes = new Personasedes();
    
                $personaSedes->persona_id   = $persona->id_persona;
                $personaSedes->sede_id      = $request->id_sedes[$i];
    
                $personaSedes->save();
            }
        }

        return redirect()->route('personas.search')->with('actualizar', 'ok');
    }
    public function destroy(Persona $persona){
        /* return $persona;  */
        $persona->delete();
        return back()->with('eliminar', 'ok');
    }
}
