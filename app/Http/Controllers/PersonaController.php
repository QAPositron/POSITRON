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
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class PersonaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
        /* return $request; */
        $request->validate([
            /* 'rol_personas'               => ['required'], */
            'primer_nombre_persona'      => ['required'],              
            'primer_apellido_persona'    => ['required'],
            'tipoIden_persona'           => ['required'],
            'cedula_persona'             => ['nullable', Rule::unique('personas', 'cedula_persona')],    
            'genero_persona'             => ['required'],
            'correo_persona'             => ['nullable', 'email', Rule::unique('personas', 'correo_persona')],
            'telefono_persona'           => ['nullable', 'min:10', 'max:10'],
            /* 'lider_dosiemtria'           => [Rule::unique('personas', 'lider_dosimetria')->where(fn ($query) => $query->where('personasedes', 'sede_id'))], */
        ]);
        
        $persona = new Persona();

        $persona->primer_nombre_persona     =  mb_strtoupper($request->primer_nombre_persona);
        $persona->segundo_nombre_persona    =  mb_strtoupper($request->segundo_nombre_persona);
        $persona->primer_apellido_persona   =  mb_strtoupper($request->primer_apellido_persona);
        $persona->segundo_apellido_persona  =  mb_strtoupper($request->segundo_apellido_persona);
        $persona->tipo_iden_persona         =  mb_strtoupper($request->tipoIden_persona);
        $persona->genero_persona            =  mb_strtoupper($request->genero_persona);
        $persona->cedula_persona            = $request->cedula_persona;
        $persona->correo_persona            =  mb_strtoupper($request->correo_persona);
        $persona->telefono_persona          = $request->telefono_persona;
        $persona->lider_ava                 = $request->lider_ava;
        $persona->lider_controlescalidad    = $request->lider_contcal;

        if($request->lider_dosimetria == 'TRUE' && count($request->id_sedes) != 0){
            for($i=0; $i<count($request->id_sedes); $i++){

                $consulta = Persona::join('personasedes', 'personas.id_persona',  '=', 'personasedes.persona_id')
                ->where('personas.lider_dosimetria', '=', 'TRUE')
                ->where('personasedes.sede_id', '=', $request->id_sedes[$i])->get();
                if(count($consulta) == 0){
                    $persona->lider_dosimetria          = $request->lider_dosimetria;
                    $persona->save();
                }else{
                    return redirect()->route('personas.search')->with('error', 'ok');
                }
            }
        }else{
            $persona->save();
        } 

        if(!empty($request->perfil_personas)){
            for($i=0; $i<count($request->perfil_personas); $i++){
                if($request->perfil_personas[$i] == 1){
                    $personasPerfiles = new Personasperfiles();
                    $personasPerfiles->persona_id = $persona->id_persona;
                    $personasPerfiles->perfil_id  = $request->perfil_personas[$i];
                    
                    $personasPerfiles->save();

                    $personasRoles = new Personasroles();
                    $personasRoles->persona_id  = $persona->id_persona;
                    $personasRoles->rol_id      = 2;
            
                    $personasRoles->save();
                }else{
                    $personasPerfiles = new Personasperfiles();
                    $personasPerfiles->persona_id = $persona->id_persona;
                    $personasPerfiles->perfil_id  = $request->perfil_personas[$i];
                    
                    $personasPerfiles->save();
                }
            }
        }
        $personaContacto = Personasroles::where('persona_id', '=', $persona->id_persona)
        ->where('rol_id', '=', 2)->get();

        if($persona->lider_dosimetria == TRUE && count($personaContacto) == 0){
            
            $personasRoles = new Personasroles();
            $personasRoles->persona_id  = $persona->id_persona;
            $personasRoles->rol_id      = 2;
            $personasRoles->save();
            for($i=0; $i<count($request->rol_personas); $i++){
                if( $request->rol_personas[$i] != 2){
                    $personasRoles = new Personasroles();
                    $personasRoles->persona_id  = $persona->id_persona;
                    $personasRoles->rol_id      = $request->rol_personas[$i];
            
                    $personasRoles->save();
                }
            }
        }elseif(!empty($request->rol_personas)){
            
            for($i=0; $i<count($request->rol_personas); $i++){
                if( $request->rol_personas[$i] == 2 && count($personaContacto) != 0){
                  
                }else{
                    
                    $personasRoles = new Personasroles();
                    $personasRoles->persona_id  = $persona->id_persona;
                    $personasRoles->rol_id      = $request->rol_personas[$i];
            
                    $personasRoles->save();
                }
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
        if(!empty($request->id_sedes_add)){
            for($i=0; $i<count($request->id_sedes_add); $i++){
                $personaSedesAdd = new Personasedes();
    
                $personaSedesAdd->persona_id   = $persona->id_persona;
                $personaSedesAdd->sede_id      = $request->id_sedes_add[$i];
    
                $personaSedesAdd->save();
            }
        }
        
        return redirect()->route('personas.search')->with('guardar', 'ok');
    }
    public function createTrabEstuContEmp(Empresa $empresa, $id){
        $perfiles = Perfiles::all();
        $roles    = Roles::all();
        $sedes = Sede::where('empresas_id', '=', $empresa->id_empresa)->get();
        
        return view('persona.crear_persona_trabajador_empresa', compact('empresa', 'id', 'perfiles', 'roles', 'sedes'));
    }
    public function savePersonasEmpresa(Request $request){
       /*  return $request; */
        $request->validate([
            'rol_personas'               => ['required'],
            'primer_nombre_persona'      => ['required'],
            'primer_apellido_persona'    => ['required'],
            'tipoIden_persona'           => ['required'],
            'cedula_persona'             => ['nullable', Rule::unique('personas', 'cedula_persona')],
            'genero_persona'             => ['required'],
            'correo_persona'             => ['nullable', 'email', Rule::unique('personas', 'correo_persona')],
            'telefono_persona'           => ['nullable','min:10', 'max:10'],
            'id_sedes'                   => ['required']
        ]); 

        $persona = new Persona();

        $persona->primer_nombre_persona     =  mb_strtoupper($request->primer_nombre_persona);
        $persona->segundo_nombre_persona    =  mb_strtoupper($request->segundo_nombre_persona);
        $persona->primer_apellido_persona   =  mb_strtoupper($request->primer_apellido_persona);
        $persona->segundo_apellido_persona  =  mb_strtoupper($request->segundo_apellido_persona);
        $persona->tipo_iden_persona         =  mb_strtoupper($request->tipoIden_persona);
        $persona->genero_persona            =  mb_strtoupper($request->genero_persona);
        $persona->cedula_persona            = $request->cedula_persona;
        $persona->correo_persona            =  mb_strtoupper($request->correo_persona);
        $persona->telefono_persona          = $request->telefono_persona;
        $persona->lider_ava                 = $request->lider_ava;
        $persona->lider_controlescalidad    = $request->lider_contcal;
        
        if($request->lider_dosimetria == 'TRUE' && count($request->id_sedes) != 0){
            for($i=0; $i<count($request->id_sedes); $i++){

                $consulta = Persona::join('personasedes', 'personas.id_persona',  '=', 'personasedes.persona_id')
                ->where('personas.lider_dosimetria', '=', 'TRUE')
                ->where('personasedes.sede_id', '=', $request->id_sedes[$i])->get();
                if(count($consulta) == 0){
                    $persona->lider_dosimetria          = $request->lider_dosimetria;
                    $persona->save();
                }else{
                    return redirect()->route('empresas.info', $request->id_empresa)->with('error', 'ok');
                }
            }
        }else{
            $persona->save();
        }   

        if(!empty($request->perfil_personas)){
            for($i=0; $i<count($request->perfil_personas); $i++){
                if($request->perfil_personas[$i] == 1){
                    $personasPerfiles = new Personasperfiles();
                    $personasPerfiles->persona_id = $persona->id_persona;
                    $personasPerfiles->perfil_id  = $request->perfil_personas[$i];
                    
                    $personasPerfiles->save();

                    $personasRoles = new Personasroles();
                    $personasRoles->persona_id  = $persona->id_persona;
                    $personasRoles->rol_id      = 2;
            
                    $personasRoles->save();
                }else{
                    $personasPerfiles = new Personasperfiles();
                    $personasPerfiles->persona_id = $persona->id_persona;
                    $personasPerfiles->perfil_id  = $request->perfil_personas[$i];
                    
                    $personasPerfiles->save();
                }
            }
        }
        $personaContacto = Personasroles::where('persona_id', '=', $persona->id_persona)
        ->where('rol_id', '=', 2)->get();

        if($persona->lider_dosimetria == TRUE && count($personaContacto) == 0){
            $personasRoles = new Personasroles();
            $personasRoles->persona_id  = $persona->id_persona;
            $personasRoles->rol_id      = 2;
            $personasRoles->save();
            for($i=0; $i<count($request->rol_personas); $i++){
                if( $request->rol_personas[$i] != 2){
                    $personasRoles = new Personasroles();
                    $personasRoles->persona_id  = $persona->id_persona;
                    $personasRoles->rol_id      = $request->rol_personas[$i];
            
                    $personasRoles->save();
                }
            }
        
        }elseif(!empty($request->rol_personas)){
            for($i=0; $i<count($request->rol_personas); $i++){
                if( $request->rol_personas[$i] == 2 && count($personaContacto) != 0){
                    
                }else{
                    $personasRoles = new Personasroles();
                    $personasRoles->persona_id  = $persona->id_persona;
                    $personasRoles->rol_id      = $request->rol_personas[$i];
            
                    $personasRoles->save();
                }
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
       
        return redirect()->route('empresas.info', $request->id_empresa)->with('guardar', 'ok');
    }
    public function edit(Persona $persona, $id, $empresa){
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
        if($empresa != 0){
            $empresa = Empresa::find($empresa);
        }
        return view('persona.edit_persona', compact('persona', 'personasede', 'empresas', 'perfiles', 'roles', 'personasperfil', 'personasrol', 'id', 'empresa'));
        /* return $empresa; */
    }

    public function update(Request $request, Persona $persona){
        /* return $request; */
        $request->validate([
            /* 'rol_personas'               => ['required'], */
            'primer_nombre_persona'      => ['required'],             
            'primer_apellido_persona'    => ['required'],
            'tipoIden_persona'           => ['required'],
            'cedula_persona'             => ['nullable', Rule::unique('personas', 'cedula_persona')->ignore($persona->id_persona, 'id_persona')],    
            'genero_persona'             => ['required'],
            'correo_persona'             => ['nullable', 'email', Rule::unique('personas', 'correo_persona')->ignore($persona->id_persona, 'id_persona')],
            'telefono_persona'           => ['nullable', 'min:10', 'max:10'],
            
        ]);
        $persona->primer_nombre_persona     =  mb_strtoupper($request->primer_nombre_persona);
        $persona->segundo_nombre_persona    =  mb_strtoupper($request->segundo_nombre_persona);
        $persona->primer_apellido_persona   =  mb_strtoupper($request->primer_apellido_persona);
        $persona->segundo_apellido_persona  =  mb_strtoupper($request->segundo_apellido_persona);
        $persona->genero_persona            =  mb_strtoupper($request->genero_persona);
        $persona->tipo_iden_persona         =  mb_strtoupper($request->tipoIden_persona);
        $persona->cedula_persona            = $request->cedula_persona;
        $persona->correo_persona            =  mb_strtoupper($request->correo_persona);
        $persona->telefono_persona          = $request->telefono_persona;
        $persona->lider_ava                 = $request->lider_ava;
        $persona->lider_controlescalidad    = $request->lider_contcal;
       
        $personasede = Personasedes::where('persona_id', '=', $persona->id_persona)->get();
        if(count($personasede) != 0){
            if($request->lider_dosimetria == 'TRUE' && $persona->lider_dosimetria == NULL){
                for($i=0; $i<count($personasede); $i++){
    
                    $consulta = Persona::join('personasedes', 'personas.id_persona',  '=', 'personasedes.persona_id')
                    ->where('personas.lider_dosimetria', '=', 'TRUE')
                    ->where('personasedes.sede_id', '=', $personasede[$i]->sede_id)->get();
                    if(count($consulta) == 0){
                        $persona->lider_dosimetria          = $request->lider_dosimetria;
                        $persona->save();
                    }else{
                        return redirect()->route('empresas.info', $request->id_empresa)->with('error', 'ok');
                    }
                }
            
            }else{
                $persona->lider_dosimetria          = NULL;
                $persona->save();
                
            }
        }elseif(count($request->id_sedes) != 0){
            if($request->lider_dosimetria == 'TRUE' && $persona->lider_dosimetria == NULL){
                for($i=0; $i<count($request->id_sedes); $i++){
    
                    $consulta = Persona::join('personasedes', 'personas.id_persona',  '=', 'personasedes.persona_id')
                    ->where('personas.lider_dosimetria', '=', 'TRUE')
                    ->where('personasedes.sede_id', '=', $request->id_sedes[$i])->get();
                    if(count($consulta) == 0){
                        $persona->lider_dosimetria          = $request->lider_dosimetria;
                        $persona->save();
                    }else{
                        return redirect()->route('empresas.info', $request->id_empresa)->with('error', 'ok');
                    }
                }
            
            }else{
                $persona->lider_dosimetria          = NULL;
                $persona->save();
                
            }
        }

        /* if($request->lider_dosimetria == 'TRUE' && count($request->id_sedes) != 0){
            for($i=0; $i<count($request->id_sedes); $i++){

                $consulta = Persona::join('personasedes', 'personas.id_persona',  '=', 'personasedes.persona_id')
                ->where('personas.lider_dosimetria', '=', 'TRUE')
                ->where('personasedes.sede_id', '=', $request->id_sedes[$i])->get();
                if(count($consulta) == 0){
                    $persona->lider_dosimetria          = $request->lider_dosimetria;
                    $persona->save();
                }else{
                    return redirect()->route('empresas.info', $request->id_empresa)->with('error', 'ok');
                }
            }
        
        }else{
            $persona->save();
        }   */
      
        if(!empty($request->perfil_personas)){
            for($i=0; $i<count($request->perfil_personas); $i++){
                $personaPerfil = Personasperfiles::where('persona_id', '=', $persona->id_persona)
                ->where('perfil_id', '=', $request->perfil_personas[$i])->get();
                if(count($personaPerfil) == 0){
                    

                    if($request->perfil_personas[$i] == 1){
                        $personasPerfiles = new Personasperfiles();
                        $personasPerfiles->persona_id = $persona->id_persona;
                        $personasPerfiles->perfil_id  = $request->perfil_personas[$i];
                        $personasPerfiles->save();
                        $personaContacto = Personasroles::where('persona_id', '=', $persona->id_persona)
                        ->where('rol_id', '=', 2)->get();
                        if(count($personaContacto)== 0){
                            $personasRoles = new Personasroles();
                            $personasRoles->persona_id  = $persona->id_persona;
                            $personasRoles->rol_id      = 2;
                            $personasRoles->save();
                        }
                    }else{
                        $personasPerfiles = new Personasperfiles();
                        $personasPerfiles->persona_id = $persona->id_persona;
                        $personasPerfiles->perfil_id  = $request->perfil_personas[$i];
                        $personasPerfiles->save();
                    }
                }
            }
        }
        $personaContacto = Personasroles::where('persona_id', '=', $persona->id_persona)
        ->where('rol_id', '=', 2)->get();

        if($persona->lider_dosimetria == TRUE && count($personaContacto) == 0){
            $personasRoles = new Personasroles();
            $personasRoles->persona_id  = $persona->id_persona;
            $personasRoles->rol_id      = 2;
            $personasRoles->save();
            if(!empty($request->rol_personas)){
                for($i=0; $i<count($request->rol_personas); $i++){
                    if( $request->rol_personas[$i] != 2){
                        $personasRoles = new Personasroles();
                        $personasRoles->persona_id  = $persona->id_persona;
                        $personasRoles->rol_id      = $request->rol_personas[$i];
                
                        $personasRoles->save();
                    }
                }
            }
        }elseif(!empty($request->rol_personas)){
            for($i=0; $i<count($request->rol_personas); $i++){
                $personaRoles = Personasroles::where('persona_id', '=', $persona->id_persona)
                ->where('rol_id', '=', $request->rol_personas[$i])->get();
                if( $request->rol_personas[$i] == 2 && count($personaRoles) != 0 && count($personaContacto) != 0){
                    
                }else{
                    $personasRoles = new Personasroles();
                    $personasRoles->persona_id  = $persona->id_persona;
                    $personasRoles->rol_id      = $request->rol_personas[$i];
                    $personasRoles->save();

                }
            }
        }
        
        if(!empty($request->id_sedes)){
            for($i=0; $i<count($request->id_sedes); $i++){
                $personaSedes = Personasedes::where('persona_id', '=', $persona->id_persona)
                ->where('sede_id', '=', $request->id_sedes[$i])->get();
                if(count($personaSedes) == 0){
                    $personaSedes = new Personasedes();
                    $personaSedes->persona_id   = $persona->id_persona;
                    $personaSedes->sede_id      = $request->id_sedes[$i];
                    $personaSedes->save();
                }
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
