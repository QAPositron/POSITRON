<?php

namespace App\Http\Controllers;

use App\Models\Areadepartamentosede;
use Illuminate\Http\Request;

class AreadepartamentosedeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function save(Request $request){
        /* return $request; */
        $request->validate([
            'nombre_area'       =>'required'
            
        ]);

        $areadepto = new Areadepartamentosede();

        $areadepto->departamentosede_id = $request->id_departamentosede;
        $areadepto->nombre_area         =  mb_strtoupper($request->nombre_area);
        $areadepto->descripcion         =  mb_strtoupper($request->descripcion_area);

        $areadepto->save();
        return back()->with('guardada', 'ok');;
    }
    public function update(Request $request){
        $area = Areadepartamentosede::where('id_areadepartamentosede', '=', $request->id_areadepartamentosede)->first();
        
        $area->nombre_area  =   mb_strtoupper($request->nombre_area_edit);
        $area->descripcion  =   mb_strtoupper($request->descripcion_area_edit);
        
        $area->save();
        return back()->with('actualizada', 'ok');
    }

    public function destroy(Areadepartamentosede $area){
        /* return $area; */
        $area->delete();
        /* return redirect()->route('empresas.search')->with('eliminar', 'ok'); */
        return back()->with('eliminada', 'ok');;
    }

}
