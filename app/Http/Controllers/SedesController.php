<?php

namespace App\Http\Controllers;

use App\Models\Coldepartamento;
use App\Models\Colmunicipio;
use App\Models\Departamentosede;
use App\Models\Empresa;
use App\Models\Sede;
use Illuminate\Http\Request;

class SedesController extends Controller
{
    public function create($id){
        $empresa = Empresa::find($id);
        $departamentoscol = Coldepartamento::all();
        /* return $empresa; */
        return view('sede.crear_sede', compact('empresa', 'departamentoscol'));
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
            'id_empresa'                => 'required',
            'nombre_sede'               => 'required',
            'municipio_sede'            => 'required',              
            'departamento_sede'         => 'required',  
            'direccion_sede'            => 'required',
            'multiple_select_depsede'   => 'required',
           
        ]);
        
        $sede = new Sede();

        $sede->empresas_id         =$request->id_empresa;
        $sede->nombre_sede         =strtoupper($request->nombre_sede);
        $sede->municipiocol_id     =strtoupper($request->municipio_sede);       
        $sede->direccion_sede	   =strtoupper($request->direccion_sede);
        
        $sede->save();

        for($i=0; $i<count($request->multiple_select_depsede); $i++){

            $deptosede = new Departamentosede();

            $deptosede->sede_id                 = $sede->id_sede;
            $deptosede->nombre_departamento     = $request->multiple_select_depsede[$i];
            
            $deptosede->save();
        }
        return redirect()->route('empresas.info', $request->id_empresa);
        /* return $request; */
    }


    public function edit(Sede $sede){
        
        /* return $sede; */
        return view('sede.edit_sede', compact('sede'));
    }

    public function update(Request $request, Sede $sede){
        
        $request->validate([
            
            'nombre_sede'           => 'required',
            'municipio_sede'        => 'required',              
            'departamento_sede'     => 'required',  
            'direccion_sede'        => 'required',
           
        ]);

        $sede->empresas_id         =strtoupper($request->empresas_id);
        $sede->nombre_sede         =strtoupper($request->nombre_sede);
        $sede->municipio_sede      =strtoupper($request->municipio_sede);
        $sede->departamento_sede   =strtoupper($request->departamento_sede);
        $sede->direccion_sede	   =strtoupper($request->direccion_sede);
        
        $sede->save();
        
        
        return redirect()->route('empresas.info', $request->empresas_id);
    }
    public function destroy(Sede $sede){
        $sede->delete();
        return redirect()->route('empresas.search')->with('eliminar', 'ok');
    }

}
