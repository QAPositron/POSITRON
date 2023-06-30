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
        $dosimetro = Dosimetro::where('estado_dosimetro','=','STOCK')
        ->orWhere('estado_dosimetro','=','PERDIDO')
        ->orWhere('estado_dosimetro','=','DAÑADO')
        ->get();
        $dosimTrabj= Dosimetro::join('trabajadordosimetros','dosimetros.id_dosimetro','=','trabajadordosimetros.dosimetro_id')
        ->where('trabajadordosimetros.dosimetro_uso', 'TRUE')
        ->where(function($query) {
            $query->orWhere('dosimetros.estado_dosimetro', 'EN USO');
        })->select('dosimetros.id_dosimetro','dosimetros.codigo_dosimeter', 'dosimetros.tipo_dosimetro', 'dosimetros.tecnologia_dosimetro', 'dosimetros.fecha_ingreso_servicio',
        'dosimetros.estado_dosimetro', 'dosimetros.uso_dosimetro', 'trabajadordosimetros.contdosisededepto_id', 'trabajadordosimetros.dosimetro_uso', 'trabajadordosimetros.mes_asignacion')
        ->get();
        $dosimLecTrabj = Dosimetro::join('trabajadordosimetros','dosimetros.id_dosimetro','=','trabajadordosimetros.dosimetro_id')
        ->where('trabajadordosimetros.dosimetro_uso', 'FALSE')
        ->where('trabajadordosimetros.revision_entrada', NULL)
        ->where(function($query) {
            $query->orWhere('dosimetros.estado_dosimetro', 'EN LECTURA');
        })->select('dosimetros.id_dosimetro','dosimetros.codigo_dosimeter', 'dosimetros.tipo_dosimetro', 'dosimetros.tecnologia_dosimetro', 'dosimetros.fecha_ingreso_servicio',
        'dosimetros.estado_dosimetro', 'dosimetros.uso_dosimetro', 'trabajadordosimetros.contdosisededepto_id', 'trabajadordosimetros.dosimetro_uso', 'trabajadordosimetros.mes_asignacion')
        ->get();

        $dosimAreas = Dosimetro::join('dosiareacontdosisedes','dosimetros.id_dosimetro','=','dosiareacontdosisedes.dosimetro_id')
        ->where('dosiareacontdosisedes.dosimetro_uso', 'TRUE')
        ->where(function($query) {
            $query->orWhere('dosimetros.estado_dosimetro', 'EN USO');
        })->select('dosimetros.id_dosimetro','dosimetros.codigo_dosimeter', 'dosimetros.tipo_dosimetro', 'dosimetros.tecnologia_dosimetro', 'dosimetros.fecha_ingreso_servicio',
        'dosimetros.estado_dosimetro', 'dosimetros.uso_dosimetro', 'dosiareacontdosisedes.contdosisededepto_id', 'dosiareacontdosisedes.dosimetro_uso', 'dosiareacontdosisedes.mes_asignacion')
        ->get();
        $dosimLecAreas = Dosimetro::join('dosiareacontdosisedes','dosimetros.id_dosimetro','=','dosiareacontdosisedes.dosimetro_id')
        ->where('dosiareacontdosisedes.dosimetro_uso', 'FALSE')
        ->where('dosiareacontdosisedes.revision_entrada', NULL)
        ->where(function($query) {
            $query->orWhere('dosimetros.estado_dosimetro', 'EN LECTURA');
        })->select('dosimetros.id_dosimetro','dosimetros.codigo_dosimeter', 'dosimetros.tipo_dosimetro', 'dosimetros.tecnologia_dosimetro', 'dosimetros.fecha_ingreso_servicio',
        'dosimetros.estado_dosimetro', 'dosimetros.uso_dosimetro', 'dosiareacontdosisedes.contdosisededepto_id', 'dosiareacontdosisedes.dosimetro_uso', 'dosiareacontdosisedes.mes_asignacion')
        ->get();

        $dosimControl = Dosimetro::join('dosicontrolcontdosisedes','dosimetros.id_dosimetro','=','dosicontrolcontdosisedes.dosimetro_id')
        ->where('dosicontrolcontdosisedes.dosimetro_uso', 'TRUE')
        ->where(function($query) {
            $query->orWhere('dosimetros.estado_dosimetro', 'EN USO');
        })->select('dosimetros.id_dosimetro','dosimetros.codigo_dosimeter', 'dosimetros.tipo_dosimetro', 'dosimetros.tecnologia_dosimetro', 'dosimetros.fecha_ingreso_servicio',
        'dosimetros.estado_dosimetro', 'dosimetros.uso_dosimetro', 'dosicontrolcontdosisedes.contdosisededepto_id', 'dosicontrolcontdosisedes.dosimetro_uso', 'dosicontrolcontdosisedes.mes_asignacion')
        ->get();
        $dosimLecControl = Dosimetro::join('dosicontrolcontdosisedes','dosimetros.id_dosimetro','=','dosicontrolcontdosisedes.dosimetro_id')
        ->where('dosicontrolcontdosisedes.dosimetro_uso', 'FALSE')
        ->where('dosicontrolcontdosisedes.revision_entrada', NULL)
        ->where(function($query) {
            $query->orWhere('dosimetros.estado_dosimetro', 'EN LECTURA');
        })->select('dosimetros.id_dosimetro','dosimetros.codigo_dosimeter', 'dosimetros.tipo_dosimetro', 'dosimetros.tecnologia_dosimetro', 'dosimetros.fecha_ingreso_servicio',
        'dosimetros.estado_dosimetro', 'dosimetros.uso_dosimetro', 'dosicontrolcontdosisedes.contdosisededepto_id', 'dosicontrolcontdosisedes.dosimetro_uso', 'dosicontrolcontdosisedes.mes_asignacion')
        ->get();

        $holder = Holder::where('estado_holder','=','STOCK')->get();
        $holderTrabj = Holder::join('trabajadordosimetros','holders.id_holder','=','trabajadordosimetros.holder_id')
        ->select('holders.id_holder','holders.codigo_holder', 'holders.tipo_holder', 'holders.estado_holder','trabajadordosimetros.contdosisededepto_id', 'trabajadordosimetros.mes_asignacion')
        ->get();
        $holderControl = Holder::join('dosicontrolcontdosisedes','holders.id_holder','=','dosicontrolcontdosisedes.holder_id')
        ->select('holders.id_holder','holders.codigo_holder', 'holders.tipo_holder', 'holders.estado_holder', 'dosicontrolcontdosisedes.contdosisededepto_id', 'dosicontrolcontdosisedes.mes_asignacion')
        ->get();

        return view('dosimetro.buscar_dosimetro', compact('dosimetro', 'dosimTrabj','dosimLecTrabj','dosimAreas','dosimLecAreas','dosimControl','dosimLecControl','holder', 'holderTrabj', 'holderControl'));
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
