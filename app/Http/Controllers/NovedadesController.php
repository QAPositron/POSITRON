<?php

namespace App\Http\Controllers;

use App\Models\Contratodosimetriasede;
use App\Models\Contratodosimetriasededepto;
use App\Models\ContratosDosimetriaEmpresa;
use App\Models\Dosicontrolcontdosisede;
use App\Models\Dosimetriacontrato;
use App\Models\Dosimetro;
use App\Models\Holder;
use App\Models\Mesescontdosisedeptos;
use App\Models\Persona;
use App\Models\Trabajador;
use App\Models\Trabajadordosimetro;
use Illuminate\Http\Request;

class NovedadesController extends Controller
{
    //
    public function index(){ 
        $empresasDosi = ContratosDosimetriaEmpresa::all();
        $dosimetrosDisponibles = Dosimetro::where('estado_dosimetro', '=', 'STOCK')
        ->where('tipo_dosimetro', '=', 'GENERAL')
        ->get();
        $dosimetrosDisponiblesEzclip = Dosimetro::where('estado_dosimetro', '=', 'STOCK')
        ->where('tipo_dosimetro', '=', 'EZCLIP')
        ->get();
        $holdersDisponibles = Holder::where('estado_holder', '=', 'STOCK')
        ->get();

        return view('novedades.form_novedades', compact('empresasDosi', 'dosimetrosDisponibles', 'holdersDisponibles', 'dosimetrosDisponiblesEzclip'));
    }
    public function contratoDosimetria(Request $request){
        $contratosDosi = Dosimetriacontrato::where('empresa_id', '=', $request->empresa_id)->get();
        foreach($contratosDosi as $contratos){
            $contratosArray[$contratos->id_contratodosimetria] = $contratos->codigo_contrato;
        }
        return response()->json($contratosArray);
        echo "CONSULTA REALIZADA".$contratosArray;
    }
    public function sedescontDosimetria(Request $request){
        /* return $request; */
        $sedescontdosi = Contratodosimetriasede::where('contratodosimetria_id', '=', $request->contrato_id)
        ->select('id_contratodosimetriasede', 'sede_id')
        ->get();
        foreach($sedescontdosi as $sedes){
            $sedesArray[$sedes->id_contratodosimetriasede] = $sedes->sede->nombre_sede;
        }
        return response()->json($sedesArray);
        echo "CONSULTA REALIZADA".$sedesArray;
    }
    public function especialidadescontDosimetria(Request $request){
       /*  return $request; */
        $especialidadcontdosi = Contratodosimetriasededepto::where('contratodosimetriasede_id', '=', $request->sede_id)
        ->select('id_contdosisededepto', 'departamentosede_id')
        ->get();
        foreach($especialidadcontdosi as $especialidad){
            $especialidadArray[$especialidad->id_contdosisededepto] = $especialidad->departamentosede->departamento->nombre_departamento;
        }
        return response()->json($especialidadArray);
        echo "CONSULTA REALIZADA".$especialidadArray;
    }
    public function contratodosi(Request $request){
       /*  return $request;    */ 
        $contratodosi = Dosimetriacontrato::where('id_contratodosimetria', '=', $request->contrato_id)->get();
        /* $contdosisededepto = Contratodosimetriasededepto::where('id_contdosisededepto', '=', $request->especialidad_id)->get(); */
        return response()->json($contratodosi);
    }
    public function mesescontDosimetria(Request $request){
        $mesescontratodosi = Mesescontdosisedeptos::where('contdosisededepto_id', '=', $request->especialidad_id)->get();
        return response()->json($mesescontratodosi);
        echo "MESES" +$mesescontratodosi;
    }
    public function meseschangecontratoDosi(Request $request){
        $meseschange = Mesescontdosisedeptos::where('contdosisededepto_id', '=', $request->especialidad_id)
        ->get();
        return response()->json($meseschange);
    }
    public function mesactualcontDosimetria(Request $request){
        /* return $request;  */
        $mesactualcontratodosiasig = Trabajadordosimetro::where('contdosisededepto_id', '=', $request->especialidad_id)
        ->select('mes_asignacion')
        ->latest()->first();
        return response()->json($mesactualcontratodosiasig);
    }
    public function cantidadDosimetrosmesactual(Request $request){
        /* return $request; */
        $mesactualcantidadDosimetros = Mesescontdosisedeptos::where('contdosisededepto_id', '=', $request->contdosisededepto_id)
        ->where('mes_asignacion', '=', $request->mes)
        ->latest()->first();
        return response()->json($mesactualcantidadDosimetros);
    }

    public function dosiasginadosmesactual(Request $request){
       /*  return $request; */
       /*  $dosiasginadosmesactual = Trabajadordosimetro::join('trabajadors', 'trabajadordosimetros.trabajador_id', '=', 'trabajadors.id_trabajador')
        ->join('dosimetros', 'trabajadordosimetros.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->LEFTjoin('holders', 'trabajadordosimetros.holder_id', '=', 'holders.id_holder')
        ->where('contdosisededepto_id', '=', $request->contdosisededepto_id)
        ->where('mes_asignacion', '=', $request->mes)
        ->get();*/
        $dosiasginadosmesactual = Trabajadordosimetro::join('personas', 'trabajadordosimetros.persona_id', '=', 'personas.id_persona')
        ->join('dosimetros', 'trabajadordosimetros.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->leftjoin('holders', 'trabajadordosimetros.holder_id', '=', 'holders.id_holder')
        ->where('contratodosimetriasede_id', '=', $request->contratodosimetriasede_id)
        ->where('contdosisededepto_id', '=', $request->contdosisededepto_id)
        ->where('mes_asignacion', '=', $request->mes)
        ->get();
        return response()->json($dosiasginadosmesactual);
    }

    public function dosiasginadoscontrolmesactual(Request $request){
       
        $dosiasignadoscontrolmesactual = Dosicontrolcontdosisede::join('dosimetros', 'dosicontrolcontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->where('contdosisededepto_id', '=', $request->contdosisededepto_id)
        ->where('mes_asignacion', '=', $request->mes)
        ->get();
        return response()->json($dosiasignadoscontrolmesactual);
    }
    public function trabajadoresempresa(Request $request){
        /* return $request; */
        $trabajadores = Persona::join('personasroles', 'personas.id_persona', '=', 'personasroles.persona_id')
        ->join('roles', 'personasroles.rol_id', '=', 'roles.id_rol')
        ->join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
        ->join('sedes', 'personasedes.sede_id', 'sedes.id_sede')
        ->where('sedes.empresas_id', '=', $request->id_empresa)
        ->where(function($query) {
            $query->orWhere('roles.nombre_rol', 'TOE')
                  ->orWhere('roles.nombre_rol', 'OPR');
        })->orderBy('sedes.id_sede')->get();
        
       /*  Persona::join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
        ->join('sedes', 'personasedes.sede_id', '=', 'sedes.id_sede')
        ->join('personasroles', 'personas.id_persona', '=', 'personasroles.persona_id')
        ->join('roles', 'personasroles.rol_id', '=', 'roles.id_rol')
        ->where('sedes.empresa_id', '=', $request->id_empresa) */
        return response()->json($trabajadores);
        
    } 
   
    public function savecambiocantdosim(Request $request){

        $dosi_control = $request->dosi_control;
        $dosi_torax= $request->dosi_torax;
        $dosi_area = $request->dosi_area; /////////FALTA TODO LO RELACIONADO CON DOSIMETROS TIPO CASO Y AREA
        $dosi_caso = $request->dosi_caso;
        $dosi_cristalino = $request->dosi_cristalino;
        $dosi_muñeca = $request->dosi_muñeca;
        $dosi_dedo = $request->dosi_dedo;
        
        
        for($i=0; $i<count($request->id_trabajador_asig); $i++){
            
            if($request->id_ubicacion_asig[$i] == 'CONTROL'){
                $newasignacionDosimetroControl = new Dosicontrolcontdosisede();
    
                $newasignacionDosimetroControl->dosimetro_id              = $request->id_dosimetro_asig[$i];
                $newasignacionDosimetroControl->contratodosimetriasede_id = $request->id_contratodosimetriasede;
                $newasignacionDosimetroControl->contdosisededepto_id      = $request->id_contdosisededepto;
                $newasignacionDosimetroControl->mes_asignacion            = $request->mestrabj_asig;
                $newasignacionDosimetroControl->dosimetro_uso             = 'TRUE';
                $newasignacionDosimetroControl->primer_dia_uso            = $request->primerDia_asigdosim;
                $newasignacionDosimetroControl->ultimo_dia_uso            = $request->ultimoDia_asigdosim;
                $newasignacionDosimetroControl->fecha_dosim_enviado       = $request->fecha_dosim_enviado;
                $newasignacionDosimetroControl->ocupacion                 = $request->ocupacion_asig[$i];
                $newasignacionDosimetroControl->energia                   = 'F';
                $newasignacionDosimetroControl->save();
    
                $updateDosimetros = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asig[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro' => 'CONTROL'
                ]);
                $updateEstadoDosimControlmesig = Dosicontrolcontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                    ->where('contdosisededepto_id', $request->id_contdosisededepto)
                    ->where('mes_asignacion', ($request->mestrabj_asig)-1)
                    ->update([
                        'estado_dosimetro' => 'EN LECTURA',
                ]); 
                $dosi_control += 1;
            }else{
                $newasignacionDosimetro = new Trabajadordosimetro();
        
                $newasignacionDosimetro->contratodosimetriasede_id = $request->id_contratodosimetriasede;
                $newasignacionDosimetro->persona_id                = $request->id_trabajador_asig[$i];
                $newasignacionDosimetro->dosimetro_id              = $request->id_dosimetro_asig[$i];
                $newasignacionDosimetro->holder_id                 = $request->id_holder_asig[$i];
                $newasignacionDosimetro->contdosisededepto_id      = $request->id_contdosisededepto;
                $newasignacionDosimetro->mes_asignacion            = $request->mestrabj_asig;
                $newasignacionDosimetro->dosimetro_uso             = 'TRUE';
                $newasignacionDosimetro->primer_dia_uso            = $request->primerDia_asigdosim;
                $newasignacionDosimetro->ultimo_dia_uso            = $request->ultimoDia_asigdosim;
                $newasignacionDosimetro->fecha_dosim_enviado       = $request->fecha_dosim_enviado;
                $newasignacionDosimetro->ocupacion                 = $request->ocupacion_asig[$i];
                $newasignacionDosimetro->ubicacion                 = $request->id_ubicacion_asig[$i];
                $newasignacionDosimetro->energia                   = 'F';
                $newasignacionDosimetro->save();
                
                $updateDosimetros = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asig[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro' => $request->id_ubicacion_asig[$i]  
                ]);
                $updateHolder = Holder::where('id_holder', '=', $request->id_holder_asig[$i])
                ->update([
                    'estado_holder' => 'EN USO'
                ]);
                if($request->id_ubicacion_asig[$i] == 'MUÑECA'){
                    $dosi_muñeca += 1 ;
                } 
                if($request->id_ubicacion_asig[$i] == 'DEDO'){
                    $dosi_dedo += 1 ;
                }
                if($request->id_ubicacion_asig[$i] == 'CRISTALINO'){
                    $dosi_cristalino += 1 ;
                }
                if($request->id_ubicacion_asig[$i] == 'TORAX'){
                    $dosi_torax += 1 ;
                }
            }
        } 
        $newMesescontdosisedeptos = new Mesescontdosisedeptos();
        $newMesescontdosisedeptos->contdosisededepto_id = $request->id_contdosisededepto;
        $newMesescontdosisedeptos->mes_asignacion       = $request->mestrabj_asig;
        $newMesescontdosisedeptos->dosi_control         = $dosi_control == null ? 0 : $dosi_control;
        $newMesescontdosisedeptos->dosi_torax           = $dosi_torax == null ? 0 : $dosi_torax;
        $newMesescontdosisedeptos->dosi_area            = $dosi_area == null ? 0 : $dosi_area; 
        $newMesescontdosisedeptos->dosi_caso            = $dosi_caso == null ? 0 : $dosi_caso;
        $newMesescontdosisedeptos->dosi_cristalino      = $dosi_cristalino == null ? 0 : $dosi_cristalino;
        $newMesescontdosisedeptos->dosi_muñeca          = $dosi_muñeca == null ? 0 : $dosi_muñeca;
        $newMesescontdosisedeptos->dosi_dedo            = $dosi_dedo == null ? 0 : $dosi_dedo;    
        $newMesescontdosisedeptos->nota_cambiodosim     = strtoupper($request->nota_cambio_dosimetros);

        $newMesescontdosisedeptos->save();

        $updatecontratoDosisedepto = Contratodosimetriasededepto::where('id_contdosisededepto', $request->id_contdosisededepto)
        ->update([
            'mes_actual'    => $request->mestrabj_asig,
            'dosi_control'  => $dosi_control == null ? 0 : $dosi_control,
            'dosi_torax'    => $dosi_torax == null ? 0 : $dosi_torax,
            'dosi_area'     => $dosi_area == null ? 0 : $dosi_area,
            'dosi_caso'     => $dosi_caso == null ? 0 : $dosi_caso,
            'dosi_cristalino' => $dosi_cristalino == null ? 0 : $dosi_cristalino,
            'dosi_muñeca'   => $dosi_muñeca == null ? 0 : $dosi_muñeca,
            'dosi_dedo'     => $dosi_dedo == null ? 0 : $dosi_dedo
        ]);
        return back()->with('guardar', 'ok');
        /* return $request; */
    }
    public function savemesiguientecambiocantdosim(Request $request){
        $dosi_control = 0;
        $dosi_torax= 0;
        $dosi_area = 0; /////////FALTA TODO LO RELACIONADO CON DOSIMETROS TIPO CASO Y AREA
        $dosi_caso = 0;
        $dosi_cristalino = 0;
        $dosi_muñeca = 0;
        $dosi_dedo = 0;

        if(!empty($request->id_trabajador_asig)){

            for($i=0; $i<count($request->id_trabajador_asig); $i++){
    
                if($request->id_ubicacion_asig[$i] == 'CONTROL'){
                    $newasignacionDosimetroControl = new Dosicontrolcontdosisede();
    
                    $newasignacionDosimetroControl->dosimetro_id              = $request->id_dosimetro_asig[$i];
                    $newasignacionDosimetroControl->contratodosimetriasede_id = $request->contratodosimetriasede;
                    $newasignacionDosimetroControl->contdosisededepto_id      = $request->contdosisededepto;
                    $newasignacionDosimetroControl->mes_asignacion            = $request->mes_asig_siguiente;
                    $newasignacionDosimetroControl->dosimetro_uso             = 'TRUE';
                    $newasignacionDosimetroControl->primer_dia_uso            = $request->primerDia_asigdosim2;
                    $newasignacionDosimetroControl->ultimo_dia_uso            = $request->ultimoDia_asigdosim2;
                    $newasignacionDosimetroControl->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado;
                    $newasignacionDosimetroControl->ocupacion                 = $request->ocupacion_asig[$i];
                    $newasignacionDosimetroControl->energia                   = 'F';
                    $newasignacionDosimetroControl->save();
    
                    $updateDosimetros = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asig[$i])
                    ->update([
                        'estado_dosimetro' => 'EN USO',
                        'uso_dosimetro' => 'CONTROL'
                    ]);
                    $updateEstadoDosimControlmesig = Dosicontrolcontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                        ->where('contdosisededepto_id', $request->contdosisededepto)
                        ->where('mes_asignacion', ($request->mes_asig_siguiente)-1)
                        ->update([
                            'estado_dosimetro' => 'EN LECTURA',
                    ]); 
                    $dosi_control += 1;
                }else{
    
                    $newasignacion = new Trabajadordosimetro();
            
                    $newasignacion->contratodosimetriasede_id    = $request->contratodosimetriasede;
                    $newasignacion->persona_id                   = $request->id_trabajador_asig[$i];
                    $newasignacion->dosimetro_id                 = $request->id_dosimetro_asig[$i];
                    $newasignacion->holder_id                    = $request->id_holder_asig[$i];
                    $newasignacion->contdosisededepto_id         = $request->contdosisededepto;
                    $newasignacion->mes_asignacion               = $request->mes_asig_siguiente;
                    $newasignacion->dosimetro_uso                = 'TRUE';
                    $newasignacion->primer_dia_uso               = $request->primerDia_asigdosim2;
                    $newasignacion->ultimo_dia_uso               = $request->ultimoDia_asigdosim2;
                    $newasignacion->fecha_dosim_enviado          = $request->fecha_envio_dosim_asignado;
                    $newasignacion->ocupacion                    = $request->ocupacion_asig[$i];
                    $newasignacion->ubicacion                    = $request->id_ubicacion_asig[$i];
                    $newasignacion->energia                      = 'F';
                    $newasignacion->save();
    
                    $updateDosimetros = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asig[$i])
                    ->update([
                        'estado_dosimetro' => 'EN USO',
                        'uso_dosimetro' => $request->id_ubicacion_asig[$i]  
                    ]);
                    $updateHolder = Holder::where('id_holder', '=', $request->id_holder_asig[$i])
                    ->update([
                        'estado_holder' => 'EN USO'
                    ]);
                    $updateEstadoDosimasigmesig = Trabajadordosimetro::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                        ->where('contdosisededepto_id', $request->contdosisededepto)
                        ->where('mes_asignacion', ($request->mes_asig_siguiente)-1)
                        ->update([
                            'estado_dosimetro' => 'EN LECTURA',
                    ]);
                    if($request->id_ubicacion_asig[$i] == 'MUÑECA'){
                        $dosi_muñeca += 1 ;
                    } 
                    if($request->id_ubicacion_asig[$i] == 'DEDO'){
                        $dosi_dedo += 1 ;
                    }
                    if($request->id_ubicacion_asig[$i] == 'CRISTALINO'){
                        $dosi_cristalino += 1 ;
                    }
                    if($request->id_ubicacion_asig[$i] == 'TORAX'){
                        $dosi_torax += 1 ;
                    }
                }
    
            }
        }
        ////GUARDAR SI HAY UN CONTROL EN UNA ASIGNACION ANTIGUA///////
        if(!empty($request->id_dosimetro_asigdosimControl)){

            for($i=0; $i<count($request->id_dosimetro_asigdosimControl); $i++){
                $newasignacionAntiguaControl = new Dosicontrolcontdosisede();

                $newasignacionAntiguaControl->dosimetro_id              = $request->id_dosimetro_asigdosimControl[$i];
                $newasignacionAntiguaControl->contratodosimetriasede_id = $request->contratodosimetriasede;
                $newasignacionAntiguaControl->contdosisededepto_id      = $request->contdosisededepto;
                $newasignacionAntiguaControl->mes_asignacion            = $request->mes_asig_siguiente;
                $newasignacionAntiguaControl->dosimetro_uso             = 'TRUE';
                $newasignacionAntiguaControl->primer_dia_uso            = $request->primerDia_asigdosim2;
                $newasignacionAntiguaControl->ultimo_dia_uso            = $request->ultimoDia_asigdosim2;
                $newasignacionAntiguaControl->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado;
                $newasignacionAntiguaControl->ocupacion                 = $request->ocupacion_asigdosimControl[$i];
                $newasignacionAntiguaControl->energia                   = 'F';
                $newasignacionAntiguaControl->save();

                $updateDosimetros = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimControl[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro' => 'CONTROL'
                ]);
                $updateEstadoDosimControlmesig = Dosicontrolcontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                    ->where('contdosisededepto_id', $request->contdosisededepto)
                    ->where('mes_asignacion', ($request->mes_asig_siguiente)-1)
                    ->update([
                        'estado_dosimetro' => 'EN LECTURA',
                ]); 
                $dosi_control += 1 ;
            }
        }
        //////GUARDAR SI HAY UN TORAX QUE TIENE HOLDER EN NULL EN UNA ASIGNACION ANTIGUA//////
        if(!empty($request->id_trabj_asigdosim_null)){

            for($i=0; $i<count($request->id_trabj_asigdosim_null); $i++){
                $newasignacionAntiguaNull = new Trabajadordosimetro();
    
                $newasignacionAntiguaNull->contratodosimetriasede_id = $request->contratodosimetriasede;
                $newasignacionAntiguaNull->persona_id                = $request->id_trabj_asigdosim_null[$i];
                $newasignacionAntiguaNull->dosimetro_id              = $request->id_dosimetro_asigdosim_null[$i];
                $newasignacionAntiguaNull->holder_id                 = null;
                $newasignacionAntiguaNull->contdosisededepto_id      = $request->contdosisededepto;
                $newasignacionAntiguaNull->mes_asignacion            = $request->mes_asig_siguiente;
                $newasignacionAntiguaNull->dosimetro_uso             = 'TRUE';
                $newasignacionAntiguaNull->primer_dia_uso            = $request->primerDia_asigdosim2;
                $newasignacionAntiguaNull->ultimo_dia_uso            = $request->ultimoDia_asigdosim2;
                $newasignacionAntiguaNull->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado;
                $newasignacionAntiguaNull->ocupacion                 = $request->id_ocupacion_asigdosim_null[$i];
                $newasignacionAntiguaNull->ubicacion                 = $request->ubicacion_asigdosim_null[$i];
                $newasignacionAntiguaNull->energia                   = 'F';
                $newasignacionAntiguaNull->save(); 
                
                $updateDosimetros = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosim_null[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro' => $request->ubicacion_asigdosim_null[$i]  
                ]);
                $updateEstadoDosimasigmesig = Trabajadordosimetro::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                    ->where('contdosisededepto_id', $request->contdosisededepto)
                    ->where('mes_asignacion', ($request->mes_asig_siguiente)-1)
                    ->update([
                        'estado_dosimetro' => 'EN LECTURA',
                ]); 
                if($request->ubicacion_asigdosim_null[$i] == 'TORAX'){
                    $dosi_torax += 1 ;
                }
            }
        }
        ////GUARDAR SI ES UN DOSIMETRO CRISTALINO,MUÑECA,DEDO DE UNA ASIGNACION ANTIGUA///
        if(!empty($request->id_trabj_asigdosim)){

            for($i=0; $i<count($request->id_trabj_asigdosim); $i++){
                $newasignacionAntigua = new Trabajadordosimetro();
    
                $newasignacionAntigua->contratodosimetriasede_id = $request->contratodosimetriasede;
                $newasignacionAntigua->persona_id                = $request->id_trabj_asigdosim[$i];
                $newasignacionAntigua->dosimetro_id              = $request->id_dosimetro_asigdosim[$i];
                $newasignacionAntigua->holder_id                 = $request->id_holder_asigdosim[$i];
                $newasignacionAntigua->contdosisededepto_id      = $request->contdosisededepto;
                $newasignacionAntigua->mes_asignacion            = $request->mes_asig_siguiente;
                $newasignacionAntigua->dosimetro_uso             = 'TRUE';
                $newasignacionAntigua->primer_dia_uso            = $request->primerDia_asigdosim2;
                $newasignacionAntigua->ultimo_dia_uso            = $request->ultimoDia_asigdosim2;
                $newasignacionAntigua->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado;
                $newasignacionAntigua->ocupacion                 = $request->id_ocupacion_asigdosim[$i];
                $newasignacionAntigua->ubicacion                 = $request->ubicacion_asigdosim[$i];
                $newasignacionAntigua->energia                   = 'F';
                $newasignacionAntigua->save(); 
    
                $updateDosimetros = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosim[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro' => $request->ubicacion_asigdosim[$i]  
                ]);
                $updateHolder = Holder::where('id_holder', '=', $request->id_holder_asigdosim[$i])
                ->update([
                    'estado_holder' => 'EN USO'
                ]);
                $updateEstadoDosimasigmesig = Trabajadordosimetro::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                    ->where('contdosisededepto_id', $request->contdosisededepto)
                    ->where('mes_asignacion', ($request->mes_asig_siguiente)-1)
                    ->update([
                        'estado_dosimetro' => 'EN LECTURA',
                ]); 
                if($request->ubicacion_asigdosim[$i] == 'MUÑECA'){
                    $dosi_muñeca += 1 ;
                } 
                if($request->ubicacion_asigdosim[$i] == 'DEDO'){
                    $dosi_dedo += 1 ;
                }
                if($request->ubicacion_asigdosim[$i] == 'CRISTALINO'){
                    $dosi_cristalino += 1 ;
                }
            }  
        }
        
        $newMesescontdosisedeptos = new Mesescontdosisedeptos();
        $newMesescontdosisedeptos->contdosisededepto_id = $request->contdosisededepto;
        $newMesescontdosisedeptos->mes_asignacion       = $request->mes_asig_siguiente;
        $newMesescontdosisedeptos->dosi_control         = $dosi_control;
        $newMesescontdosisedeptos->dosi_torax           = $dosi_torax;
        $newMesescontdosisedeptos->dosi_area            = $dosi_area;
        $newMesescontdosisedeptos->dosi_caso            = $dosi_caso;
        $newMesescontdosisedeptos->dosi_cristalino      = $dosi_cristalino;
        $newMesescontdosisedeptos->dosi_muñeca          = $dosi_muñeca;
        $newMesescontdosisedeptos->dosi_dedo            = $dosi_dedo;  
        $newMesescontdosisedeptos->nota_cambiodosim     = strtoupper($request->nota_cambio_dosimetros);  
        $newMesescontdosisedeptos->save();

        $updatecontratoDosisedepto = Contratodosimetriasededepto::where('id_contdosisededepto', $request->contdosisededepto)
        ->update([
            'mes_actual'    => $request->mes_asig_siguiente,
            'dosi_control'  => $dosi_control,
            'dosi_torax'    => $dosi_torax ,
            'dosi_area'     => $dosi_area,
            'dosi_caso'     => $dosi_caso,
            'dosi_cristalino' => $dosi_cristalino,
            'dosi_muñeca'   => $dosi_muñeca,
            'dosi_dedo'     => $dosi_dedo
        ]);
        
        return back()->with('guardar', 'ok');

        /* return $request; */
        
    }

    public function clearAsignacionAnteriorMn(Request $request){
        $cleardosicontrolasigmesant = Dosicontrolcontdosisede::where('contdosisededepto_id', $request->contdosisededepto_id)
        ->where('contratodosimetriasede_id', $request->contratodosimetriasede_id)
        ->where('mes_asignacion',($request->mes)-1)
        ->update([
            'dosimetro_uso' => 'FALSE'
        ]);
        $cleardositrabajasigmesant = Trabajadordosimetro::where('contdosisededepto_id', $request->contdosisededepto_id)
        ->where('contratodosimetriasede_id', $request->contratodosimetriasede_id)
        ->where('mes_asignacion',($request->mes)-1)
        ->update([
            'dosimetro_uso' => 'FALSE'
        ]);
        $dosiasginadosmesactual = Trabajadordosimetro::join('personas', 'trabajadordosimetros.persona_id', '=', 'personas.id_persona')
        ->join('dosimetros', 'trabajadordosimetros.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->leftjoin('holders', 'trabajadordosimetros.holder_id', '=', 'holders.id_holder')
        ->where('contratodosimetriasede_id', '=', $request->contratodosimetriasede_id)
        ->where('contdosisededepto_id', '=', $request->contdosisededepto_id)
        ->where('mes_asignacion', '=', ($request->mes)-1)
        ->get();
        return response()->json($dosiasginadosmesactual);
        /* return response()->json($cleardositrabajasigmesant); */
        /* return $request; */
        /* return back(); */
    }
}
