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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id){
        $empresa = Empresa::find($id);
        $sedes = Sede::where('empresas_id', '=', $id)->get();
        return view('contacto.crear_contacto', compact('empresa', 'sedes'));
    }
   
    public function save(Request $request){

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
        $contacto->lider_dosimetria            = $request->lider_dosimetria;
        
        $contacto->save();

        $contactosede = new Contactosede();
        
        
        $contactosede->contacto_id   = $contacto->id_contacto;
        $contactosede->sede_id       = $request->id_sedes;

        $contactosede->save();
        /* return $request; */
        /* return$contactosede; */
        return redirect()->route('empresas.info', $request->id_empresas);
    }

   

    public function edit(Contactosede $contacto){
        
        return view('contacto.edit_contacto', compact('contacto'));
    }

    public function update(Request $request, Contacto $contacto){
        
        $request->validate([
            'id_sedes'                    => 'required',
            'id_empresas'                 => 'required',
            'primer_nombre_contacto'      => 'required',              
            'primer_apellido_contacto'    => 'required',
            'segundo_apellido_contacto'   => 'required',
            'tipoIden_contacto'           => 'required',
            'cedula_contacto'             => 'required',    
            'genero_contacto'             => 'required',
            'correo_contacto'             => 'required',
            'telefono_contacto'           => 'required|max:12',
            'tipo_contacto'               => 'required',
            
        ]);

        $contacto->primer_nombre_contacto  = strtoupper($request->primer_nombre_contacto);
        $contacto->segundo_nombre_contacto = strtoupper($request->segundo_nombre_contacto);
        $contacto->primer_apellido_contacto = strtoupper($request->primer_apellido_contacto);
        $contacto->segundo_apellido_contacto = strtoupper($request->segundo_apellido_contacto);
        $contacto->tipo_iden_contacto = strtoupper($request->tipoIden_contacto);
        $contacto->cedula_contacto = strtoupper($request->cedula_contacto);
        $contacto->genero_contacto = strtoupper($request->genero_contacto);
        $contacto->correo_contacto  = strtoupper($request->correo_contacto);
        $contacto->telefono_contacto  = strtoupper($request->telefono_contacto);
        $contacto->tipo_contacto  = strtoupper($request->tipo_contacto);
        
        $contacto->save();
        
        /* return $contacto; */
        return redirect()->route('empresas.search');
    }
    public function destroy(Contacto $contacto){
        $contacto->delete();
        return redirect()->route('empresas.search')->with('eliminar', 'ok');
    }
}
