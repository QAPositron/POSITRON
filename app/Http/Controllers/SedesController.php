<?php

namespace App\Http\Controllers;

use App\Models\Coldepartamento;
use App\Models\Colmunicipio;
use App\Models\Departamento;
use App\Models\Departamentosede;
use App\Models\Empresa;
use App\Models\Sede;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SedesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create($id){
        $empresa = Empresa::find($id); 
        $departamentoscol = Coldepartamento::all();
        /* return $empresa; */
        $especialidades = Departamento::all();
        $municipioscol = Colmunicipio::all();
        return view('sede.crear_sede', compact('empresa', 'departamentoscol', 'especialidades', 'municipioscol'));
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
            'id_empresa'                => ['required'], 
            'nombre_sede'               => ['required', Rule::unique('sedes', 'nombre_sede')->where(fn ($query) => $query->where('empresas_id', $request->id_empresa))], 
            'municipio_sede'            => ['required'],              
            'departamento_sede'         => ['required'],  
            'direccion_sede'            => ['required'],
            'especialidades'            => ['required'] 
        ]);
        
        $sede = new Sede();

        $sede->empresas_id         =$request->id_empresa;
        $sede->nombre_sede         = mb_strtoupper($request->nombre_sede);
        $sede->municipiocol_id     = mb_strtoupper($request->municipio_sede);       
        $sede->direccion_sede	   = mb_strtoupper($request->direccion_sede);
        
        $sede->save();

        for($i=0; $i<count($request->especialidades); $i++){

            $deptosede = new Departamentosede();

            $deptosede->sede_id                 = $sede->id_sede;
            $deptosede->departamento_id         = $request->especialidades[$i];
            
            $deptosede->save();
        }
        return redirect()->route('empresas.info', $request->id_empresa)->with('guardar', 'ok');
        /* return $request; */
    }


    public function edit(Sede $sede){
        $departamentoscol = Coldepartamento::all();
        $deptos = Departamentosede::where('sede_id', '=', $sede->id_sede)->get();
        $especialidades = Departamento::all();
        return view('sede.edit_sede', compact('sede', 'departamentoscol', 'deptos', 'especialidades'));
    }

    public function update(Request $request, Sede $sede){
        
        $request->validate([
            'id_empresa'            => ['required'],
            'nombre_sede'           => ['required',  Rule::unique('sedes', 'nombre_sede')->ignore($sede->id_sede, 'id_sede')->where(fn ($query) => $query->where('empresas_id', $request->id_empresa))], 
            'departamento_sede'     => ['required'],
            'municipio_sede'        => ['required'],               
            'direccion_sede'        => ['required']
            
        ]);

        $sede->empresas_id         =$request->id_empresa;
        $sede->nombre_sede         =strtoupper($request->nombre_sede);
        $sede->municipiocol_id     =$request->municipio_sede;
        $sede->direccion_sede	   =strtoupper($request->direccion_sede);

        /* return $request; */

        $sede->save();
        if(empty($request->especialidades)){

        }else{
            for($i=0; $i<count($request->especialidades); $i++){
    
                $deptosede = new Departamentosede();
    
                $deptosede->sede_id             = $sede->id_sede;
                $deptosede->departamento_id     = $request->especialidades[$i];
                
                $deptosede->save();
            }
        }
        return redirect()->route('empresas.info', $request->id_empresa)->with('actualizar', 'ok');
    }

    public function destroy(Sede $sede){
        $sede->delete();
       
        return redirect()->route('empresas.search')->with('eliminar', 'ok');
    }
    

}
