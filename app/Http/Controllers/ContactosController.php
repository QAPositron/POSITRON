<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use App\Models\Contactosede;
use App\Models\Empresa;
use App\Models\Sede;
use Illuminate\Http\Request;

class ContactosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search() 
    {
        $contactos = Contacto::all();
        $contactosede = Contacto::leftjoin('contactosedes', 'contactos.id_contacto', '=', 'contactosedes.contacto_id')
        ->leftjoin('sedes', 'contactosedes.sede_id', '=', 'sedes.id_sede')
        ->leftjoin('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->select("*")
        ->get();
        /* return $contactosede; */
        return view('contacto.buscar_contacto', compact('contactos', 'contactosede'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $empresas = Empresa::all();
        /* $sedes = Sede::where('empresas_id', '=', $id)->get(); */
        return view('contacto.crear_contacto', compact('empresas'));
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
            
            'primer_nombre_contacto'      => 'required',              
            'primer_apellido_contacto'    => 'required',
            'segundo_apellido_contacto'   => 'required',
            'tipoIden_contacto'           => 'required',
            'cedula_contacto'             => 'required',    
            'genero_contacto'             => 'required',
            'correo_contacto'             => 'required',
            'telefono_contacto'           => 'required|max:12',
            'profesion_contacto'          => 'required',
            
        ]);
        $contacto = new Contacto();

        $contacto->primer_nombre_contacto       = strtoupper($request->primer_nombre_contacto);
        $contacto->segundo_nombre_contacto      = strtoupper($request->segundo_nombre_contacto);
        $contacto->primer_apellido_contacto     = strtoupper($request->primer_apellido_contacto);
        $contacto->segundo_apellido_contacto    = strtoupper($request->segundo_apellido_contacto);
        $contacto->tipo_iden_contacto           = strtoupper($request->tipoIden_contacto);
        $contacto->cedula_contacto              = $request->cedula_contacto;
        $contacto->genero_contacto              = strtoupper($request->genero_contacto);
        $contacto->correo_contacto              = strtoupper($request->correo_contacto);
        $contacto->telefono_contacto            = $request->telefono_contacto;
        $contacto->profesion_contacto           = strtoupper($request->profesion_contacto);
        $contacto->lider_ava                    = $request->lider_ava;
        $contacto->lider_dosimetria             = $request->lider_dosimetria;
        
        $contacto->save();

        if(empty($request->id_sedes)){
            
        }else{
            for($i=0; $i<count($request->id_sedes); $i++){
    
                $contactosede = new Contactosede();
    
                $contactosede->contacto_id   = $contacto->id_contacto;
                $contactosede->sede_id       = $request->id_sedes[$i];
                $contactosede->save();
                /* return $contactosede; */
            }
        }
        
        return redirect()->route('contactos.search')->with('guardar', 'ok');
    }

    public function edit(Contacto $contacto){
        $contactosede= Contactosede::join('sedes', 'contactosedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('contacto_id', '=', $contacto->id_contacto)
        ->select("*")
        ->get();
        $empresas = Empresa::all();
        /* return $contactosede; */
        return view('contacto.edit_contacto', compact('contacto', 'contactosede', 'empresas'));
    }

    public function update(Request $request, Contacto $contacto){
        /* return $request; */
        $request->validate([
            
            'primer_nombre_contacto'      => 'required',              
            'primer_apellido_contacto'    => 'required',
            'segundo_apellido_contacto'   => 'required',
            'tipoIden_contacto'           => 'required',
            'cedula_contacto'             => 'required',    
            'genero_contacto'             => 'required',
            'correo_contacto'             => 'required',
            'telefono_contacto'           => 'required|max:12',
            'profesion_contacto'          => 'required',
            
        ]);

        $contacto->primer_nombre_contacto       = strtoupper($request->primer_nombre_contacto);
        $contacto->segundo_nombre_contacto      = strtoupper($request->segundo_nombre_contacto);
        $contacto->primer_apellido_contacto     = strtoupper($request->primer_apellido_contacto);
        $contacto->segundo_apellido_contacto    = strtoupper($request->segundo_apellido_contacto);
        $contacto->tipo_iden_contacto           = strtoupper($request->tipoIden_contacto);
        $contacto->cedula_contacto              = strtoupper($request->cedula_contacto);
        $contacto->genero_contacto              = strtoupper($request->genero_contacto);
        $contacto->correo_contacto              = strtoupper($request->correo_contacto);
        $contacto->telefono_contacto            = strtoupper($request->telefono_contacto);
        $contacto->profesion_contacto           = strtoupper($request->profesion_contacto);
        $contacto->lider_ava                    = strtoupper($request->lider_ava);
        $contacto->lider_dosimetria             = strtoupper($request->lider_dosimetria);
        
        $contacto->save();
        
        /* return $contacto; */
        return redirect()->route('contactos.search');
    }

    public function destroy(Contacto $contacto){
        $contacto->delete();
        return redirect()->route('contactos.search')->with('eliminar', 'ok');
    }
}
