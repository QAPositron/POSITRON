<?php

namespace App\Http\Controllers;

use App\Models\Areadepartamentosede;
use App\Models\Coldepartamento;
use App\Models\Colmunicipio;
use App\Models\Contacto;
use App\Models\Contactosede;
use App\Models\Departamentosede;
use App\Models\Empresa;
use App\Models\Sede;
use App\Models\Trabajador;
use Illuminate\Http\Request;

class EmpresasController extends Controller
{
    
    public function create(){
        $departamentoscol = Coldepartamento::all();
        return view('empresa.crear_empresa', compact('departamentoscol'));
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
            'nombre_empresa'      => 'required|unique:empresas,nombre_empresa',
            'tipo_empresa'        => 'required',              
            'tipoIden_empresa'    => 'required',  
            'numero_ident'        => 'required|max:10|unique:empresas,num_iden_empresa',
             
            'actividad_empresa'   => 'required|max:4',
            'respoIva_empresa'    => 'required',    
            'respoFiscal_empresa' => 'required',
            'telefono_empresa'    => 'required|max:10',
            'correo_empresa'      => 'required',
            'direccion_empresa'   => 'required',
            'pais_empresa'        => 'required',
            'ciudad_empresa'      => 'required',
            
        ]);
        
        $empresa = new Empresa();

        $empresa->nombre_empresa                    = strtoupper($request->nombre_empresa);
        $empresa->tipo_identificacion_empresa       = strtoupper($request->tipoIden_empresa);
        $empresa->num_iden_empresa                  = $request->numero_ident;
        $empresa->DV                                = $request->nitdv_empresa;
        $empresa->tipo_empresa                      = strtoupper($request->tipo_empresa);
        $empresa->actividad_economica_empresa       = $request->actividad_empresa;
        $empresa->respo_iva_empresa                 = strtoupper($request->respoIva_empresa);
        $empresa->respo_fiscal_empresa              = strtoupper($request->respoFiscal_empresa);
        $empresa->telefono_empresa                  = $request->telefono_empresa;
        $empresa->email_empresa                     = strtoupper($request->correo_empresa);
        $empresa->email_verified_at                 = now();
        $empresa->direccion_empresa                 = strtoupper($request->direccion_empresa);
        $empresa->pais_empresa                      = strtoupper($request->pais_empresa);
        $empresa->municipiocol_id                   = $request->ciudad_empresa;
        
        
        $empresa->save();

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
            'nombre_empresa'      => 'required',
            'tipo_empresa'        => 'required',              
            'tipoIden_empresa'    => 'required',  
            'numero_ident'        => 'required|max:10',
             
            'actividad_empresa'   => 'required|max:4',
            'respoIva_empresa'    => 'required',    
            'respoFiscal_empresa' => 'required',
            'telefono_empresa'    => 'required|max:10',
            'correo_empresa'      => 'required',
            'direccion_empresa'   => 'required',
            'pais_empresa'        => 'required',
            'ciudad_empresa'      => 'required',
            'departamento_empresa'=> 'required',
        ]);
        
        $empresa->nombre_empresa                    = strtoupper($request->nombre_empresa);
        $empresa->tipo_identificacion_empresa       = strtoupper($request->tipoIden_empresa);
        $empresa->num_iden_empresa                  = $request->numero_ident;
        $empresa->DV                                = $request->nitdv_empresa;
        $empresa->tipo_empresa                      = strtoupper($request->tipo_empresa);
        $empresa->actividad_economica_empresa       = $request->actividad_empresa;
        $empresa->respo_iva_empresa                 = strtoupper($request->respoIva_empresa);
        $empresa->respo_fiscal_empresa              = strtoupper($request->respoFiscal_empresa);
        $empresa->telefono_empresa                  = $request->telefono_empresa;
        $empresa->email_empresa                     = strtoupper($request->correo_empresa);
        $empresa->email_verified_at                 = now();
        $empresa->direccion_empresa                 = strtoupper($request->direccion_empresa);
        $empresa->pais_empresa                      = strtoupper($request->pais_empresa);
        $empresa->municipiocol_id                   = $request->ciudad_empresa;
        
        
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
        $departamentos = Departamentosede::join('sedes', 'departamentosedes.sede_id', '=', 'sedes.id_sede')
        ->where('empresas_id', '=', $empresa->id_empresa)
        ->select('nombre_departamento', 'sede_id', 'id_departamentosede')
        ->get();
        $areadeptos = Areadepartamentosede::join('departamentosedes', 'areadepartamentosedes.departamentosede_id', '=', 'departamentosedes.id_departamentosede')
        ->join('sedes','departamentosedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('empresas_id', '=', $empresa->id_empresa)
        ->orderBy('nombre_departamento', 'ASC')
        ->get();
        $trabajador = Trabajador::join('trabajadorsedes','trabajadors.id_trabajador', '=', 'trabajadorsedes.trabajador_id')
        ->join('sedes','trabajadorsedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('empresas.id_empresa', '=', $empresa->id_empresa)
        ->orderBy('sedes.id_sede')
        ->select("*")
        ->get();
        /* SELECT * FROM `contactos` INNER JOIN contactosedes ON contactos.id_contacto = contactosedes.id_contactosede INNER JOIN sedes ON contactosedes.sede_id = sedes.id_sede INNER JOIN empresas ON sedes.empresas_id = empresas.id_empresa ORDER BY sedes.id_sede; */
        $contacto = Contactosede::join('contactos', 'contactosedes.contacto_id', '=', 'contactos.id_contacto')
        ->join('sedes', 'contactosedes.sede_id', '=', 'sedes.id_sede') 
        ->join('empresas','sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('empresas.id_empresa', '=', $empresa->id_empresa)
        ->orderBy('sedes.id_sede')
        ->select("*")
        ->get();
        /* return $areadeptos; */
        return view('empresa.info_empresa', compact('empresa' ,'sede', 'trabajador', 'contacto', 'departamentos', 'areadeptos'));
    }
   
}
