<?php

namespace App\Http\Controllers;

use App\Models\Dosimetro;
use App\Models\Holder;
use App\Models\Trabajadordosimetro;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'tipo_dosimetro'                => ['required'],
            'tecnologia_dosimetro'          => ['required'],              
            'codigo_dosimetro'              => ['required','array','min:1'],
            'codigo_dosimetro.*'            => ['required','distinct', Rule::unique('dosimetros', 'codigo_dosimeter')],  
            'fecha_ingre_serv_dosimetro'    => ['required'],
            'estado_dosimetro'              => ['required'],
        ]);
        for ($i=0; $i <count($request->codigo_dosimetro) ; $i++) { 
            
            $dosimetro = new Dosimetro();
    
            $dosimetro->tipo_dosimetro          =  mb_strtoupper($request->tipo_dosimetro);
            $dosimetro->tecnologia_dosimetro    =  mb_strtoupper($request->tecnologia_dosimetro);
            $dosimetro->codigo_dosimeter        = $request->codigo_dosimetro[$i];
            $dosimetro->fecha_ingreso_servicio  = $request->fecha_ingre_serv_dosimetro;
            $dosimetro->estado_dosimetro        =  mb_strtoupper($request->estado_dosimetro);
            $dosimetro->uso_dosimetro           = '';
           
            $dosimetro->save();
        }

    
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
            'tipo_dosimetro'                => ['required'],
            'tecnologia_dosimetro'          => ['required'],              
            'codigo_dosimetro'              => ['required', Rule::unique('dosimetros', 'codigo_dosimeter')->ignore($dosimetro->id_dosimetro, 'id_dosimetro')],  
            'fecha_ingre_serv_dosimetro'    => ['required'],
            'estado_dosimetro'              => ['required']
            
        ]);
        $dosimetro->tipo_dosimetro          =  mb_strtoupper($request->tipo_dosimetro);
        $dosimetro->tecnologia_dosimetro    =  mb_strtoupper($request->tecnologia_dosimetro);
        $dosimetro->codigo_dosimeter        = $request->codigo_dosimetro;
        $dosimetro->fecha_ingreso_servicio  = $request->fecha_ingre_serv_dosimetro;
        $dosimetro->estado_dosimetro        =  mb_strtoupper($request->estado_dosimetro);

        $dosimetro->save();
        return redirect()->route('dosimetros.search')->with('actualizar', 'ok');
    }
    public function destroy(Dosimetro $dosimetro){
        $dosimetro->delete();
        return redirect()->route('dosimetros.search')->with('eliminar', 'ok'); 
    }
}
