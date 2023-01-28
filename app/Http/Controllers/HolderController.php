<?php

namespace App\Http\Controllers;

use App\Models\Holder;
use Illuminate\Http\Request;

class HolderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create(){
        
        return view('holder.crear_holder_dosimetro');
    }

    public function save(Request $request){

        $request->validate([
            'codigo_holder'                   => 'required',
            'tipo_holder'                     => 'required',
            'estado_holder'                   => 'required',
        ]);
        $holder = new Holder();

        $holder->codigo_holder  = $request->codigo_holder;
        $holder->tipo_holder    = strtoupper($request->tipo_holder);
        $holder->estado_holder  = strtoupper($request->estado_holder);
        
        $holder->save();

        
        return redirect()->route('dosimetros.search');
    }

    public function search(){

        /* $trabajadores = Trabajador::all(); */
        $holder = Holder::all();
        
        return view('holder.buscar_holder', compact('holder'));
    }
    public function edit(Holder $holder){
        
        return view('holder.edit_holder_dosimetro', compact('holder'));
    }

    public function update(Request $request, Holder $holder){
        $request->validate([
            'codigo_holder'                   => 'required',
            'tipo_holder'                     => 'required',
            'estado_holder'                   => 'required',
            
        ]);
        $holder->codigo_holder      = $request->codigo_holder;
        $holder->tipo_holder        = strtoupper($request->tipo_holder);
        $holder->estado_holder      = strtoupper($request->estado_holder);

        $holder->save();
        return redirect()->route('dosimetros.search')->with('actualizar', 'ok');
    }

    public function destroy(Holder $holder){   
        $holder->delete();
        return redirect()->route('dosimetros.search')->with('eliminar', 'ok');
    }
}
