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
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
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
        ->join('roles', 'personasroles.role_id', '=', 'roles.id')
        ->select("*")
        ->get();
        $personasedes = Personasedes::all();
        $personasperfiles = Personasperfiles::all();
        $personasroles = Personasroles::all(); 
        return view('persona.buscar_persona', compact('persona', 'personasrolesperfilesedes', 'personasperfiles', 'personasroles', 'personasedes'));
       
    }
    
    /* public function create(){
        $empresas = Empresa::all();
        $perfiles = Perfiles::all();
        $roles    = Role::all();
        return view('persona.crear_persona', compact('empresas', 'perfiles', 'roles'));
    } */
    public function selectsedes(Request $request){
        $sedes = Sede::where('empresas_id','=', $request->empresa_id)->get();
        foreach($sedes as $sede){
            $sedesArray[$sede->id_sede] = $sede->nombre_sede;
        }
        return response()->json($sedesArray);
        echo "consulta realizada".$sedesArray;
    }
    public function personasedes(Request $request){

        $personasedes = Personasedes::join('sedes', 'personasedes.sede_id','=', 'sedes.id_sede')
        ->where('sede_id', '=', $request->sede_id)
        ->get();
        
        return response()->json($personasedes);
        
    }
    /* public function save(Request $request){
        return $request;
        $request->validate([
            
            'primer_nombre_persona'      => ['required'],              
            'primer_apellido_persona'    => ['required'],
            'tipoIden_persona'           => ['required'],    
            'genero_persona'             => ['required'],
            'estado_persona'             => ['required'],
            'correo_persona'             => ['nullable', 'email', Rule::unique('personas', 'correo_persona')],
            'telefono_persona'           => ['nullable', 'min:10', 'max:10'],
            
        ]);
        if(!empty($request->rol_personas)){
            for($i=0; $i<count($request->rol_personas); $i++){
                if( $request->rol_personas[$i] == 2){
                    $request->validate([
                        'cedula_persona'             => ['nullable', Rule::unique('personas', 'cedula_persona')],    
                    ]);
                }else{
                    $request->validate([
                        'cedula_persona'             => ['required', Rule::unique('personas', 'cedula_persona')],    
                    ]);
                }
            }
        }else{
            $request->validate([
                'rol_personas'               => ['required'],
            ]);
        }

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
        $persona->estado_persona            = $request->estado_persona;
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
                    $personasRoles->role_id      = 2;
            
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
        ->where('role_id', '=', 2)->get();

        if($persona->lider_dosimetria == TRUE && count($personaContacto) == 0){
            
            $personasRoles = new Personasroles();
            $personasRoles->persona_id  = $persona->id_persona;
            $personasRoles->role_id      = 2;
            $personasRoles->save();
            for($i=0; $i<count($request->rol_personas); $i++){
                if( $request->rol_personas[$i] != 2){
                    $personasRoles = new Personasroles();
                    $personasRoles->persona_id  = $persona->id_persona;
                    $personasRoles->role_id      = $request->rol_personas[$i];
            
                    $personasRoles->save();
                }
            }
        }elseif(!empty($request->rol_personas)){
            
            for($i=0; $i<count($request->rol_personas); $i++){
                if( $request->rol_personas[$i] == 2 && count($personaContacto) != 0){
                  
                }else{
                    
                    $personasRoles = new Personasroles();
                    $personasRoles->persona_id  = $persona->id_persona;
                    $personasRoles->role_id      = $request->rol_personas[$i];
            
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
    } */
    public function createTrabEstuContEmp($idemp, $id){
        
        $perfiles = Perfiles::all();
        $roles    = Role::all();
        $empresas = Empresa::all();
        if($idemp == 0){
            $empresa = null;
            $sedes = null;
        }else{
            $empresa = Empresa::find($idemp);
            $sedes = Sede::where('empresas_id', '=', $empresa->id_empresa)->get();
        }
        return view('persona.crear_persona_trabajador_empresa', compact('empresas', 'empresa', 'id', 'perfiles', 'roles', 'sedes'));
       
    }
    public function savePersonasEmpresa(Request $request){
       /*  return $request; */
        $request->validate([
            'primer_nombre_persona'      => ['required'],
            'primer_apellido_persona'    => ['required'],
            'genero_persona'             => ['required'],
            'estado_persona'             => ['required'],
            'correo_persona'             => ['nullable', 'email', Rule::unique('personas', 'correo_persona')],
            'telefono_persona'           => ['nullable','min:10', 'max:10']
        ]);
        foreach($request->roles as $rol){
            if($rol == 3){
                $request->validate([
                    'correo_persona'             => ['required', 'email', Rule::unique('personas', 'correo_persona')],
                    'cedula_persona'             => ['required', Rule::unique('personas', 'cedula_persona')],    
                ]);
            }
            if($rol == 5){
                $request->validate([
                    'correo_persona'             => ['required', 'email', Rule::unique('personas', 'correo_persona')],
                    'cedula_persona'             => ['nullable', Rule::unique('personas', 'cedula_persona')],    
                ]);
            }
        }
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
        $persona->estado_persona            = $request->estado_persona;

        $persona->save();
        
        ////guardar personasroles///
        foreach($request->roles as $rol){
            $personasRoles = new Personasroles();
            $personasRoles->persona_id  = $persona->id_persona;
            $personasRoles->role_id     = $rol;
            $personasRoles->created_at   = time();
            $personasRoles->updated_at   = time();
    
            $personasRoles->save();
        }
        $sedes = [];
        if(!empty($request->id_sedes)){
            for ($i=0; $i <count($request->id_sedes) ; $i++) { 
                array_push($sedes, $request->id_sedes[$i]);
            }
        }
        if(!empty($request->id_sedes_add)){
            for ($i=0; $i <count($request->id_sedes_add) ; $i++) { 
                array_push($sedes, $request->id_sedes_add[$i]);
            }
        }
       
        ///guardar personas sede y si es lider de dosimetria  guarda el usuario ///
       
        for($i=0; $i<count($sedes); $i++){
            $personaSedes = new Personasedes();

            $personaSedes->persona_id   = $persona->id_persona;
            $personaSedes->sede_id      = $sedes[$i];
            
            foreach($request->roles as $rol){
                $user = User::where('persona_id','=', $persona->id_persona)->get();
                if(!empty($request->liderdosimsedes)){
                    for($x=0; $x<count($request->liderdosimsedes); $x++){  
                        if($rol == '3' && count($user) == 0 && $request->liderdosimsedes[$x] == $sedes[$i]){
                            $personaSedes->lider_dosimetria   = 'TRUE';
    
                            $usuario = new User();
                            $usuario->persona_id    = $persona->id_persona;
                            $usuario->name          = $persona->primer_nombre_persona." ".$persona->segundo_nombre_persona." ".$persona->primer_apellido_persona." ".$persona->segundo_apellido_persona;
                            $usuario->email         = $persona->correo_persona;
                            $usuario->password      = Hash::make($persona->cedula_persona);
                            $usuario->save();
    
                            $personaContacto = Personasroles::where('persona_id', '=', $persona->id_persona)
                            ->where('role_id', '=', 5)->get();
                            if(count($personaContacto) == 0){
                                $personasRoles = new Personasroles();
                                $personasRoles->persona_id  = $persona->id_persona;
                                $personasRoles->role_id      = 5;
                                $personasRoles->save();
                            }
    
                        }elseif($rol == '3' && count($user) != 0 && $request->liderdosimsedes[$x] == $sedes[$i]){
                            $personaSedes->lider_dosimetria   = 'TRUE';
    
                            $personaContacto = Personasroles::where('persona_id', '=', $persona->id_persona)
                            ->where('role_id', '=', 5)->get();
                            if(count($personaContacto) == 0){
                                $personasRoles = new Personasroles();
                                $personasRoles->persona_id  = $persona->id_persona;
                                $personasRoles->role_id      = 5;
                                $personasRoles->save();
                            }
                        }
                    }
                }else{
                    if($rol == '3' && count($user) == 0 ){
                        $personaSedes->lider_dosimetria   = 'TRUE';

                        $usuario = new User();
                        $usuario->persona_id    = $persona->id_persona;
                        $usuario->name          = $persona->primer_nombre_persona." ".$persona->segundo_nombre_persona." ".$persona->primer_apellido_persona." ".$persona->segundo_apellido_persona;
                        $usuario->email         = $persona->correo_persona;
                        $usuario->password      = Hash::make($persona->cedula_persona);
                        $usuario->save();

                        $personaContacto = Personasroles::where('persona_id', '=', $persona->id_persona)
                        ->where('role_id', '=', 5)->get();
                        if(count($personaContacto) == 0){
                            $personasRoles = new Personasroles();
                            $personasRoles->persona_id  = $persona->id_persona;
                            $personasRoles->role_id      = 5;
                            $personasRoles->save();
                        }
                    }elseif($rol == '3' && count($user) != 0){
                        $personaSedes->lider_dosimetria   = 'TRUE';
    
                        $personaContacto = Personasroles::where('persona_id', '=', $persona->id_persona)
                        ->where('role_id', '=', 5)->get();
                        if(count($personaContacto) == 0){
                            $personasRoles = new Personasroles();
                            $personasRoles->persona_id  = $persona->id_persona;
                            $personasRoles->role_id      = 5;
                            $personasRoles->save();
                        }
                    }
                }
            }
            $personaSedes->save();
        }
       
        
        /* if(!empty($request->id_sedes_add)){
            for($i=0; $i<count($request->id_sedes_add); $i++){
                $personaSedesAdd = new Personasedes();
    
                $personaSedesAdd->persona_id   = $persona->id_persona;
                $personaSedesAdd->sede_id      = $request->id_sedes_add[$i];
    
                $personaSedesAdd->save();
            }
        } */
        ////GUARDAR LOS ROLES SELECCIONADOS SOLO PARA EL LOGIN DE USUARIOS A LA PLATAFORMA //////
        /////ES DECIR PERSONAS CON ROL DE LIDER DE DOSIMETRIA, SUPERADMIN Y ADMIN/////
        if(!empty($usuario)){
            $usuario->roles()->sync($request->roles);
        }
        ///////////////////////////////////////
        if(!empty($request->perfil_personas)){
            for($i=0; $i<count($request->perfil_personas); $i++){
                if($request->perfil_personas[$i] == 1){
                    $personasPerfiles = new Personasperfiles();
                    $personasPerfiles->persona_id = $persona->id_persona;
                    $personasPerfiles->perfil_id  = $request->perfil_personas[$i];
                    
                    $personasPerfiles->save();

                    $personasRoles = new Personasroles();
                    $personasRoles->persona_id  = $persona->id_persona;
                    $personasRoles->role_id      = 5;
            
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
        ->where('role_id', '=', 5)->get();

        $personaSede = Personasedes::where('persona_id', '=', $persona->id_persona)->get();
        foreach ($personaSede as $personsede) {
            if($personsede->lider_dosimetria == 'TRUE' && count($personaContacto) == 0){
                $personasRoles = new Personasroles();
                $personasRoles->persona_id  = $persona->id_persona;
                $personasRoles->role_id      = 5;
                $personasRoles->save();
            }
        }
        if($request->id == '0'){
            return redirect()->route('personas.search')->with('guardar', 'ok');
        }else{
            return redirect()->route('empresas.info', $request->id_empresa)->with('guardar', 'ok');
        }
    }
    public function edit(Persona $persona, $id, $empresa){
        
        $personasede = Personasedes::where('persona_id', '=', $persona->id_persona)
        ->get();
        $personasperfil = Personasperfiles::where('persona_id', '=', $persona->id_persona)
        ->get();
        $personasrol = Personasroles::where('persona_id', '=', $persona->id_persona)
        ->get();
        $empresas = Empresa::all();
        $perfiles = Perfiles::all();
        $roles    = Role::all();
        $user = User::where('persona_id', '=', $persona->id_persona)
        ->get();
        if($empresa != 0){
            $empresa = Empresa::find($empresa);
            $sedes = Sede::where('empresas_id', '=', $empresa->id_empresa)->get();

        }else{
            $sedes = null;
        }
        
        return view('persona.edit_persona', compact('persona', 'personasede', 'empresas', 'perfiles', 'roles', 'personasperfil', 'personasrol', 'id', 'empresa', 'sedes', 'user'));
        
    }

    public function update(Request $request, Persona $persona){
        /* return $request; */
        
        $request->validate([
            'primer_nombre_persona'      => ['required'],             
            'primer_apellido_persona'    => ['required'],
            'genero_persona'             => ['required'],
            'estado_persona'             => ['required'],
            'correo_persona'             => ['nullable', 'email', Rule::unique('personas', 'correo_persona')->ignore($persona->id_persona, 'id_persona')],
            'telefono_persona'           => ['nullable', 'min:10', 'max:10'],
            
        ]);
        if(!empty($request->roles)){
            foreach($request->roles as $rol){
                if($rol == 3){
                    $request->validate([
                        'correo_persona'             => ['required', 'email', Rule::unique('personas', 'correo_persona')->ignore($persona->id_persona, 'id_persona')],
                        'cedula_persona'             => ['required', Rule::unique('personas', 'cedula_persona')->ignore($persona->id_persona, 'id_persona')],       
                    ]);
                }elseif($rol == 5){
                    $request->validate([
                        'correo_persona'             => ['required', 'email', Rule::unique('personas', 'correo_persona')->ignore($persona->id_persona, 'id_persona')],
                        'cedula_persona'             => ['nullable', Rule::unique('personas', 'cedula_persona')->ignore($persona->id_persona, 'id_persona')],   
                    ]);
                }
            }
        }

        $persona->primer_nombre_persona     =  mb_strtoupper($request->primer_nombre_persona);
        $persona->segundo_nombre_persona    =  mb_strtoupper($request->segundo_nombre_persona);
        $persona->primer_apellido_persona   =  mb_strtoupper($request->primer_apellido_persona);
        $persona->segundo_apellido_persona  =  mb_strtoupper($request->segundo_apellido_persona);
        $persona->tipo_iden_persona         =  mb_strtoupper($request->tipoIden_persona);
        $persona->genero_persona            =  mb_strtoupper($request->genero_persona);
        $persona->cedula_persona            = $request->cedula_persona;
        $persona->correo_persona            =  mb_strtoupper($request->correo_persona);
        $persona->telefono_persona          = $request->telefono_persona;
        $persona->estado_persona            = $request->estado_persona;

        $persona->save();
        
        /////////////guardar personasroles////////////////////////////
        $arrayroles = [];
        $arraypersonroles = [];
        $rolespersona = Personasroles::where('persona_id', '=', $persona->id_persona)->get();
        foreach ($rolespersona as $personrol) {
            array_push($arrayroles, $personrol->role_id);
        }
        /* return $arrayroles; */
        if(!empty($request->roles)){
            for ($i=0; $i < count($request->roles); $i++) {
                if(!in_array($request->roles[$i], $arrayroles)){
                    array_push($arraypersonroles, $request->roles[$i]);
                }
            } 
        }
       
        if(!empty($arraypersonroles) ){
            foreach($arraypersonroles as $value){
                $personasRoles = new Personasroles();
                $personasRoles->persona_id  = $persona->id_persona;
                $personasRoles->role_id     = $value;
                $personasRoles->created_at   = time();
                $personasRoles->updated_at   = time();
        
                $personasRoles->save();
            }
        }
        $personasedes = Personasedes::where('persona_id', '=', $persona->id_persona)->get();
        $arraypersonsede   = [];
        $arraysedes = [];
        foreach ($personasedes as $personsed) {
            array_push($arraypersonsede, $personsed->sede_id );
        }
        if(!empty($request->id_sedes)){
            for ($i=0; $i < count($request->id_sedes); $i++) { 
                array_push($arraysedes, $request->id_sedes[$i]);
            } 
        }
        if(!empty($request->id_sedes_add)){
            for ($i=0; $i < count($request->id_sedes_add); $i++) { 
                array_push($arraysedes, $request->id_sedes_add[$i]);
            } 
        }
        /////se obtiene diferencia para que no guarde personasede duplicado///
        $diff = collect($arraysedes)->diff(collect($arraypersonsede));
        ///guardar personas sede y si es lider de dosimetria  guarda el usuario y si al mismo tiempo se relaciona con una sede nueva relacionarlos///
        if(!empty($diff)){
            foreach($diff as $value) {
                $personaSedes = new Personasedes();
    
                $personaSedes->persona_id   = $persona->id_persona;
                $personaSedes->sede_id      = $value;
                if(!empty($request->roles)){
                    foreach($request->roles as $rol){
                        $user = User::where('persona_id','=', $persona->id_persona)->get();
                        if(!empty($request->liderdosimsedes)){
                            for($x=0; $x<count($request->liderdosimsedes); $x++){
                                if($rol == '3' && count($user) == 0 && $request->liderdosimsedes[$x] == $value){
                                    $personaSedes->lider_dosimetria   = 'TRUE';
                                    
                                    $usuario = new User();
                                    $usuario->persona_id    = $persona->id_persona;
                                    $usuario->name          = $persona->primer_nombre_persona." ".$persona->segundo_nombre_persona." ".$persona->primer_apellido_persona." ".$persona->segundo_apellido_persona;
                                    $usuario->email         = $persona->correo_persona;
                                    $usuario->password      = Hash::make($persona->cedula_persona);
                                    $usuario->save();
                
                                    $personaContacto = Personasroles::where('persona_id', '=', $persona->id_persona)
                                    ->where('role_id', '=', 5)->get();
                                    if(count($personaContacto) == 0){
                                        $personasRoles = new Personasroles();
                                        $personasRoles->persona_id  = $persona->id_persona;
                                        $personasRoles->role_id      = 5;
                                        $personasRoles->save();
                                    }
                                }elseif($rol == '3' && count($user) != 0 && $request->liderdosimsedes[$x] == $value){
                                    $personaSedes->lider_dosimetria   = 'TRUE';
                
                                    $personaContacto = Personasroles::where('persona_id', '=', $persona->id_persona)
                                    ->where('role_id', '=', 5)->get();
                                    if(count($personaContacto) == 0){
                                        $personasRoles = new Personasroles();
                                        $personasRoles->persona_id  = $persona->id_persona;
                                        $personasRoles->role_id      = 5;
                                        $personasRoles->save();
                                    }
                                }
                            }
                        }/* else{
                            if($rol == '3' && count($user) == 0 ){
                                $personaSedes->lider_dosimetria   = 'TRUE';
    
                                $usuario = new User();
                                $usuario->persona_id    = $persona->id_persona;
                                $usuario->name          = $persona->primer_nombre_persona." ".$persona->segundo_nombre_persona." ".$persona->primer_apellido_persona." ".$persona->segundo_apellido_persona;
                                $usuario->email         = $persona->correo_persona;
                                $usuario->password      = Hash::make($persona->cedula_persona);
                                $usuario->save();
    
                                $personaContacto = Personasroles::where('persona_id', '=', $persona->id_persona)
                                ->where('role_id', '=', 5)->get();
                                if(count($personaContacto) == 0){
                                    $personasRoles = new Personasroles();
                                    $personasRoles->persona_id  = $persona->id_persona;
                                    $personasRoles->role_id      = 5;
                                    $personasRoles->save();
                                }
                            }elseif($rol == '3' && count($user) != 0){
                                $personaSedes->lider_dosimetria   = 'TRUE';
            
                                $personaContacto = Personasroles::where('persona_id', '=', $persona->id_persona)
                                ->where('role_id', '=', 5)->get();
                                if(count($personaContacto) == 0){
                                    $personasRoles = new Personasroles();
                                    $personasRoles->persona_id  = $persona->id_persona;
                                    $personasRoles->role_id      = 5;
                                    $personasRoles->save();
                                }
                            }
                        } */
                    }
                }
                $personaSedes->save();
            }
        } 
        //guardar el lider de dosimetria para relacionar con sedes ya relacionadas anteriormente//
        if(!empty($request->liderdosimsedesExist)){
            foreach($request->roles as $rol){
                $user = User::where('persona_id','=', $persona->id_persona)->get();
                for($x=0; $x<count($request->liderdosimsedesExist); $x++){
                    if($rol == '3' && count($user) == 0){
                        $usuario = new User();
                        $usuario->persona_id    = $persona->id_persona;
                        $usuario->name          = $persona->primer_nombre_persona." ".$persona->segundo_nombre_persona." ".$persona->primer_apellido_persona." ".$persona->segundo_apellido_persona;
                        $usuario->email         = $persona->correo_persona;
                        $usuario->password      = Hash::make($persona->cedula_persona);
                        $usuario->save();

                        $personasede = Personasedes::where('persona_id', '=', $persona->id_persona)
                        ->update(['lider_dosimetria' => 'TRUE']);

                        $personaContacto = Personasroles::where('persona_id', '=', $persona->id_persona)
                        ->where('role_id', '=', 5)->get();
                        if(count($personaContacto) == 0){
                            $personasRoles = new Personasroles();
                            $personasRoles->persona_id  = $persona->id_persona;
                            $personasRoles->role_id      = 5;
                            $personasRoles->save();
                        }
                    }elseif($rol == '3' && count($user) != 0){
                        $personasede = Personasedes::where('persona_id', '=', $persona->id_persona)
                        ->update(['lider_dosimetria' => 'TRUE']);

                        $personaContacto = Personasroles::where('persona_id', '=', $persona->id_persona)
                        ->where('role_id', '=', 5)->get();

                        if(count($personaContacto) == 0){
                            $personasRoles = new Personasroles();
                            $personasRoles->persona_id  = $persona->id_persona;
                            $personasRoles->role_id      = 5;
                            $personasRoles->save();
                        }
                    }
                }
            }
        }
        ////GUARDAR LOS ROLES SELECCIONADOS SOLO PARA EL LOGIN DE USUARIOS A LA PLATAFORMA //////
        /////ES DECIR PERSONAS CON ROL DE LIDER DE DOSIMETRIA, SUPERADMIN Y ADMIN/////
        if(!empty($usuario)){
            $usuario->roles()->sync($request->roles);
        }

        $arrayperfiles = [];
        $arraypersonperf = [];
        $perfilespersona = Personasperfiles::where('persona_id', '=', $persona->id_persona)->get();
        if(!empty($request->perfil_personas)){
            for ($i=0; $i < count($request->perfil_personas); $i++) { 
                array_push($arraypersonperf, $request->perfil_personas[$i]);
            } 
        }
        foreach ($perfilespersona as $personperf) {
            array_push($arrayperfiles, $personperf->perfil_id);
        }
        $diffperfiles = collect($arraypersonperf)->diff(collect($arrayperfiles));
       
        if(!empty($diffperfiles)){
            foreach ($diffperfiles as $value) {
                if($value == 1){
                    $personasPerfiles = new Personasperfiles();
                    $personasPerfiles->persona_id = $persona->id_persona;
                    $personasPerfiles->perfil_id  = $value;
                    
                    $personasPerfiles->save();

                    $personasRoles = new Personasroles();
                    $personasRoles->persona_id  = $persona->id_persona;
                    $personasRoles->role_id      = 5;
            
                    $personasRoles->save();
                }else{
                    $personasPerfiles = new Personasperfiles();
                    $personasPerfiles->persona_id = $persona->id_persona;
                    $personasPerfiles->perfil_id  = $value;
                    
                    $personasPerfiles->save();
                }
            }
        }
        $personaContacto = Personasroles::where('persona_id', '=', $persona->id_persona)
        ->where('role_id', '=', 5)->get();

        $personaSede = Personasedes::where('persona_id', '=', $persona->id_persona)->get();
        foreach ($personaSede as $personsede) {
            if($personsede->lider_dosimetria == 'TRUE' && count($personaContacto) == 0){
                $personasRoles = new Personasroles();
                $personasRoles->persona_id  = $persona->id_persona;
                $personasRoles->role_id      = 5;
                $personasRoles->save();
            }
        }
        if($request->id == '0'){
            return redirect()->route('personas.search')->with('guardar', 'ok');
        }else{
            return redirect()->route('empresas.info', $request->id_empresa)->with('guardar', 'ok');
        }
    }
    public function destroy(Persona $persona){
        /* return $persona;  */
        $persona->delete();
        return back()->with('eliminar', 'ok');
    }
}
