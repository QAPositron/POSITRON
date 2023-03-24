<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Sede;
use App\Models\Trabajador;
use App\Models\Trabajadorsede;
use Illuminate\Http\Request;

class TrabajadorsController extends Controller
{
    public function create($id){
        $empresa = Empresa::find($id);
        $sedes = Sede::where('empresas_id', '=', $id)->get();
        
        return view('trabajador.crear_trabajador', compact('sedes', 'empresa'));
    }

    /* public function save(Request $request){

        $request->validate([
            'id_empresas'                   => 'required',
            'id_sedes'                      => 'required',
            'primer_nombre_trabajador'      => 'required',              
            'primer_apellido_trabajador'    => 'required',
            'segundo_apellido_trabajador'   => 'required',
            'tipoIden_trabajador'           => 'required',
            'cedula_trabajador'             => 'required',    
            'genero_trabajador'             => 'required',
            'correo_trabajador'             => 'required',
            'telefono_trabajador'           => 'required|max:11',
            'tipo_trabajador'               => 'required',
            
        ]);
        
        $trabajador = new Trabajador();
        $trabajador->empresa_id                     = $request->id_empresas;
        $trabajador->primer_nombre_trabajador       = strtoupper($request->primer_nombre_trabajador);
        $trabajador->segundo_nombre_trabajador      = strtoupper($request->segundo_nombre_trabajador);
        $trabajador->primer_apellido_trabajador     = strtoupper($request->primer_apellido_trabajador);
        $trabajador->segundo_apellido_trabajador    = strtoupper($request->segundo_apellido_trabajador);
        $trabajador->tipo_iden_trabajador           = strtoupper($request->tipoIden_trabajador);
        $trabajador->cedula_trabajador              = $request->cedula_trabajador;
        $trabajador->genero_trabajador              = strtoupper($request->genero_trabajador);
        $trabajador->email_trabajador               = strtoupper($request->correo_trabajador);
        $trabajador->telefono_trabajador            = $request->telefono_trabajador;
        $trabajador->tipo_trabajador                = strtoupper($request->tipo_trabajador);
        $trabajador->aula_virtual                   = strtoupper($request->ckeckAulaVirtual);
        $trabajador->dosimetria                     = strtoupper($request->checkDosimetria);
        
        $trabajador->save();

        $trabajadorsede = new Trabajadorsede();
        
        $trabajadorsede->trabajador_id   = $trabajador->id_trabajador;
        $trabajadorsede->sede_id         = $request->id_sedes;
        
        $trabajadorsede->save();
        return redirect()->route('empresas.info', $request->id_empresas);
        
    } */
    
    
    public function edit(Trabajadorsede $trabajador){
       /*  $trabajador = Trabajador::find($id); */
        /* return $trabajador; */
        return view('trabajador.edit_trabajador', compact('trabajador'));
    }
    /* public function update(Request $request, Trabajador $trabajador){
        
        $request->validate([
            
            'primer_nombre_trabajador'      => 'required',
                          
            'primer_apellido_trabajador'    => 'required',  
            'segundo_apellido_trabajador'   => 'required',
            'cedula_trabajador'             => 'required',
            'genero_trabajador'             => 'required',
            'correo_trabajador'             => 'required',
            'telefono_trabajador'           => 'required',
            'tipo_trabajador'               => 'required',
           
        ]);

        $trabajador->primer_nombre_trabajador  = strtoupper($request->primer_nombre_trabajador);
        $trabajador->segundo_nombre_trabajador = strtoupper($request->segundo_nombre_trabajador);
        $trabajador->primer_apellido_trabajador = strtoupper($request->primer_apellido_trabajador);
        $trabajador->segundo_apellido_trabajador = strtoupper($request->segundo_apellido_trabajador);
        $trabajador->cedula_trabajador = strtoupper($request->cedula_trabajador);
        $trabajador->genero_trabajador = strtoupper($request->genero_trabajador);
        $trabajador->email_trabajador  = strtoupper($request->correo_trabajador);
        $trabajador->telefono_trabajador  = strtoupper($request->telefono_trabajador);
        $trabajador->tipo_trabajador  = strtoupper($request->tipo_trabajador);
        
        $trabajador->save();
        
        
        return redirect()->route('empresas.info', $request->id_empresas)->with('actualizar', 'ok');
    } */
    public function destroy(Trabajador $trabajador){
       /* return $trabajador; */
       
        $trabajador->delete();
        return redirect()->route('empresas.info', $trabajador->empresa_id)->with('eliminar', 'ok');
    }
}
