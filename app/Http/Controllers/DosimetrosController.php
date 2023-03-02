<?php

namespace App\Http\Controllers;

use App\Models\Dosimetro;
use App\Models\Holder;
use App\Models\Trabajadordosimetro;
use Illuminate\Http\Request;

class DosimetrosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create(){
        return view('dosimetro.crear_dosimetro');
    }
    public function save(Request $request){
        
        $request->validate([
            'tipo_dosimetro'                => 'required',
            'tecnologia_dosimetro'          => 'required',              
            'codigo_dosimetro'              => 'required',  
            'fecha_ingre_serv_dosimetro'    => 'required',
            'estado_dosimetro'              => 'required',
        ]);
        
        $dosimetro = new Dosimetro();

        $dosimetro->tipo_dosimetro          = strtoupper($request->tipo_dosimetro);
        $dosimetro->tecnologia_dosimetro    = strtoupper($request->tecnologia_dosimetro);
        $dosimetro->codigo_dosimeter        = $request->codigo_dosimetro;
        $dosimetro->fecha_ingreso_servicio  = $request->fecha_ingre_serv_dosimetro;
        $dosimetro->estado_dosimetro        = strtoupper($request->estado_dosimetro);
        $dosimetro->uso_dosimetro           = '';
       
        $dosimetro->save();

    
        /* return $request; */
        return redirect()->route('dosimetros.search')->with('guardar', 'ok');
    }
    public function search(){

        /* $trabajadores = Trabajador::all(); */
        /* $dosimetro= Dosimetro::paginate(5);
        $holder = Holder::paginate(5); */
        $dosimetro= Dosimetro::all();
        $holder = Holder::all();

        return view('dosimetro.buscar_dosimetro', compact('dosimetro', 'holder'));
    }

    public function edit(Dosimetro $dosimetro){
       
        return view('dosimetro.edit_dosimetro', compact('dosimetro'));
    }

    public function update(Request $request, Dosimetro $dosimetro){
        $request->validate([
            'tipo_dosimetro'                => 'required',
            'tecnologia_dosimetro'          => 'required',              
            'codigo_dosimetro'              => 'required',  
            'fecha_ingre_serv_dosimetro'    => 'required',
             
            
        ]);
        $dosimetro->tipo_dosimetro          = strtoupper($request->tipo_dosimetro);
        $dosimetro->tecnologia_dosimetro    = strtoupper($request->tecnologia_dosimetro);
        $dosimetro->codigo_dosimeter        = $request->codigo_dosimetro;
        $dosimetro->fecha_ingreso_servicio  = $request->fecha_ingre_serv_dosimetro;
        $dosimetro->estado_dosimetro        = strtoupper($request->estado_dosimetro);

        $dosimetro->save();
        return redirect()->route('dosimetros.search')->with('actualizar', 'ok');
    }
    public function destroy(Dosimetro $dosimetro){
        $dosimetro->delete();
        return redirect()->route('dosimetros.search')->with('eliminar', 'ok');
    }
}
