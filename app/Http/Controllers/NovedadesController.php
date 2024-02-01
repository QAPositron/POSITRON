<?php

namespace App\Http\Controllers;

use App\Models\Areadepartamentosede;
use App\Models\Cambiosnovedadmeses;
use App\Models\Contratodosimetriasede;
use App\Models\Contratodosimetriasededepto;
use App\Models\ContratosDosimetriaEmpresa;
use App\Models\Departamentosede;
use App\Models\Dosiareacontdosisede;
use App\Models\Dosicontrolcontdosisede;
use App\Models\Dosimetriacontrato;
use App\Models\Dosimetro;
use App\Models\Holder;
use App\Models\Mesescontdosisedeptos;
use App\Models\Novcontdosisededepto;
use App\Models\Novedadmesescontdosisededepto;
use App\Models\Novedadmesescontdosisedepto;
use App\Models\Persona;
use App\Models\Trabajador;
use App\Models\Trabajadordosimetro;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NovedadesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //el metodo INDEX esta provicional se debe eliminar 
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
    public function nuevoDosimetro(){ 
        $empresasDosi = ContratosDosimetriaEmpresa::all();
        $dosimetrosDisponibles = Dosimetro::where('estado_dosimetro', '=', 'STOCK')
        ->where('tipo_dosimetro', '=', 'GENERAL')
        ->get();
        $dosimetrosDisponiblesEzclip = Dosimetro::where('estado_dosimetro', '=', 'STOCK')
        ->where('tipo_dosimetro', '=', 'EZCLIP')
        ->get();
        $holdersDisponibles = Holder::where('estado_holder', '=', 'STOCK')
        ->get();
        $codigoNovedadSubEsp = Novcontdosisededepto::latest()->first();
        
        return view('novedades.novedad_nuevo_dosimetro', compact('empresasDosi', 'dosimetrosDisponibles', 'holdersDisponibles', 'dosimetrosDisponiblesEzclip'));
    }
    public function retiroDosimetro(){
        $empresasDosi = ContratosDosimetriaEmpresa::all();
        $dosimetrosDisponibles = Dosimetro::where('estado_dosimetro', '=', 'STOCK')
        ->where('tipo_dosimetro', '=', 'GENERAL')
        ->get();
        $dosimetrosDisponiblesEzclip = Dosimetro::where('estado_dosimetro', '=', 'STOCK')
        ->where('tipo_dosimetro', '=', 'EZCLIP')
        ->get();
        $holdersDisponibles = Holder::where('estado_holder', '=', 'STOCK')
        ->get();
        return view('novedades.novedad_retiro_dosimetro', compact('empresasDosi', 'dosimetrosDisponibles', 'holdersDisponibles', 'dosimetrosDisponiblesEzclip'));
    }
    public function cambioTrabajador(){
        $empresasDosi = ContratosDosimetriaEmpresa::all();
        $dosimetrosDisponibles = Dosimetro::where('estado_dosimetro', '=', 'STOCK')
        ->where('tipo_dosimetro', '=', 'GENERAL')
        ->get();
        $dosimetrosDisponiblesEzclip = Dosimetro::where('estado_dosimetro', '=', 'STOCK')
        ->where('tipo_dosimetro', '=', 'EZCLIP')
        ->get();
        $holdersDisponibles = Holder::where('estado_holder', '=', 'STOCK')
        ->get();
        return view('novedades.novedad_cambio_trabajador', compact('empresasDosi', 'dosimetrosDisponibles', 'holdersDisponibles', 'dosimetrosDisponiblesEzclip'));
    }
    public function detalleNovedad($id, $deptodosi){
        $contdosisededepto = Contratodosimetriasededepto::find($deptodosi);
        $novedad = Novedadmesescontdosisededepto::find($id); 
        return view('novedades.detalle_novedad', compact('novedad', 'contdosisededepto'));
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
        $sedescontdosi = Contratodosimetriasede::join('sedes', 'contratodosimetriasedes.sede_id', '=', 'sedes.id_sede')
        ->where('contratodosimetria_id', '=', $request->contrato_id)
        ->get();
       
        return response()->json($sedescontdosi);
    }
    public function especialidadescontDosimetria(Request $request){
       /*  return $request; */
        $especialidadcontdosi = Contratodosimetriasededepto::where('contratodosimetriasede_id', '=', $request->contratodosimetriasede_id)
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
        /* $mesactualcontratodosiasig = Trabajadordosimetro::where('contdosisededepto_id', '=', $request->especialidad_id)
        ->select('mes_asignacion')
        ->latest()->first(); */
        $mesactualcontratodosiasig = Contratodosimetriasededepto::join('contratodosimetriasedes', 'contratodosimetriasededeptos.contratodosimetriasede_id', '=', 'contratodosimetriasedes.id_contratodosimetriasede')
        ->join('dosimetriacontratos','contratodosimetriasedes.contratodosimetria_id', '=', 'dosimetriacontratos.id_contratodosimetria')
        ->where('contratodosimetriasededeptos.id_contdosisededepto', '=', $request->especialidad_id)
        ->where('contratodosimetriasedes.id_contratodosimetriasede', '=', $request->contratodosimetriasede)
        ->get();
        return response()->json($mesactualcontratodosiasig);
    }
    public function cantidadDosimetrosmesactual(Request $request){
        /* return $request; */
        $mesactualcantidadDosimetros = Mesescontdosisedeptos::where('contdosisededepto_id', '=', $request->contdosisededepto_id)
        ->where('mes_asignacion', '=', $request->mes)
        ->latest()->first();
        return response()->json($mesactualcantidadDosimetros);
    }
    public function novedadactualDosimetria(Request $request){
        $novedad = array();
        $novedadmesactual = Novedadmesescontdosisededepto::where('contdosisededepto_id', '=', $request->contdosisededepto_id)
        ->where('mes_asignacion', '=', $request->mes)
        ->get();
        if(count($novedadmesactual) == 0){
            $novedadactual = Novedadmesescontdosisededepto::latest()->first();
            return response()->json($novedadactual);
        }elseif(count($novedadmesactual) == 0 && $request->mes == 1){
            return response()->json($novedad);
        }else{
            $novedadactual = Novedadmesescontdosisededepto::latest()->first();
            array_push($novedad,$novedadactual);

            for($i=0; $i<count($novedadmesactual); $i++){
                array_push($novedad,$novedadmesactual[$i]);
            }
            return response()->json($novedad);
        }
    }
    public function dosiasginadosmesactual(Request $request){
       
        $dosiasginadosmesactual = Trabajadordosimetro::join('personas', 'trabajadordosimetros.persona_id', '=', 'personas.id_persona')
        ->join('dosimetros', 'trabajadordosimetros.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->leftjoin('holders', 'trabajadordosimetros.holder_id', '=', 'holders.id_holder')
        ->where('contratodosimetriasede_id', '=', $request->contratodosimetriasede_id)
        ->where('contdosisededepto_id', '=', $request->contdosisededepto_id)
        ->where('mes_asignacion', '=', $request->mes)
        ->get();
        return response()->json($dosiasginadosmesactual);
    }
    public function dosiareasginadosmesactual(Request $request){
        $dosiareasginadosmesactual = Dosiareacontdosisede::join('dosimetros', 'dosiareacontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->join('areadepartamentosedes', 'dosiareacontdosisedes.areadepartamentosede_id', '=', 'areadepartamentosedes.id_areadepartamentosede')
        ->where('contratodosimetriasede_id', '=', $request->contratodosimetriasede_id)
        ->where('contdosisededepto_id', '=', $request->contdosisededepto_id)
        ->where('mes_asignacion', '=', $request->mes)
        ->get();
        return response()->json($dosiareasginadosmesactual);
    }
    public function dosiasginadoscontrolmesactual(Request $request){
        $contdosisededepto = Contratodosimetriasededepto::find($request->contdosisededepto_id);
        
        if($contdosisededepto->controlTransT_unicoCont == 'TRUE' || $contdosisededepto->controlTransC_unicoCont == 'TRUE' || $contdosisededepto->controlTransA_unicoCont == 'TRUE'){
            $dosiasignadoscontrolmesactual = Dosicontrolcontdosisede::join('dosimetros', 'dosicontrolcontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
            /* ->leftjoin('holders', 'dosicontrolcontdosisedes.holder_id', '=', 'holders.id_holder') */
            ->where('contratodosimetria_id', '=', $request->contratodosimetria_id)
            ->where('mes_asignacion', '=', $request->mes+1)
            ->get();
            if(count($dosiasignadoscontrolmesactual) == 0){
                $dosiasignadoscontrolmesactual = Dosicontrolcontdosisede::join('dosimetros', 'dosicontrolcontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
                ->leftjoin('holders', 'dosicontrolcontdosisedes.holder_id', '=', 'holders.id_holder')
                ->where('contratodosimetria_id', '=', $request->contratodosimetria_id)
                ->where('mes_asignacion', '=', $request->mes)
                ->get();
            }
        }else{
            $dosiasignadoscontrolmesactual = Dosicontrolcontdosisede::join('dosimetros', 'dosicontrolcontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
            ->leftjoin('holders', 'dosicontrolcontdosisedes.holder_id', '=', 'holders.id_holder')
            ->where('contdosisededepto_id', '=', $request->contdosisededepto_id)
            ->where('mes_asignacion', '=', $request->mes)
            ->get();
        }
        return response()->json($dosiasignadoscontrolmesactual);
        
        
    }
    public function trabajadoresempresa(Request $request){
        /* return $request; */
        $trabajadores = Persona::join('personasroles', 'personas.id_persona', '=', 'personasroles.persona_id')
        ->join('roles', 'personasroles.rol_id', '=', 'roles.id_rol')
        ->join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
        ->join('sedes', 'personasedes.sede_id', 'sedes.id_sede')
        ->where('sedes.nombre_sede', '=', $request->id_sede)
        ->where(function($query) {
            $query->orWhere('roles.nombre_rol', 'TOE')
                  ->orWhere('roles.nombre_rol', 'OPR')
                  ->orWhere('roles.nombre_rol', 'PUBLICO');
        })->get();
       
        return response()->json($trabajadores);
    } 
    public function areasespecialidadesempresa(Request $request){
        $areasEspecialidades = Contratodosimetriasededepto::join('departamentosedes', 'contratodosimetriasededeptos.departamentosede_id', '=', 'departamentosedes.id_departamentosede')
        ->join('areadepartamentosedes', 'departamentosedes.id_departamentosede', '=', 'areadepartamentosedes.departamentosede_id')
        ->where('contratodosimetriasededeptos.id_contdosisededepto', '=', $request->contdosisededepto_id)
        ->where('departamentosedes.sede_id', '=', $request->id_sede)
        ->get();
        return response()->json($areasEspecialidades);
    }

    public function savecambiocantdosim(Request $request){

        /* return $request; */
        $dosi_control_torax = $request->dosi_control_torax;
        $dosi_control_cristalino = $request->dosi_control_cristalino;
        $dosi_control_dedo = $request->dosi_control_dedo;
        $dosi_torax= $request->dosi_torax;
        $dosi_area = $request->dosi_area; 
        $dosi_caso = $request->dosi_caso;
        $dosi_cristalino = $request->dosi_cristalino;
        $dosi_dedo = $request->dosi_dedo;
        
        $num_dosi_control = [];
        $num_dosi = [];
        $num_dosi_area = [];
        if($request->subEspecialidad == null){

            $newNovedadmesescontdosisededepto = Novedadmesescontdosisededepto::find($request->id_novedad);
            if(empty($newNovedadmesescontdosisededepto)){
                $newNovedad = new Novedadmesescontdosisededepto();
                $newNovedad->codigo_novedad           = $request->id_novedad;
                $newNovedad->contdosisededepto_id     = $request->id_contdosisededepto;
                $newNovedad->mes_asignacion           = $request->mestrabj_asig;
                $newNovedad->save();
            } 
            if(!empty($request->tipo_novedad == 2)){
                if(!empty($request->dosimRetiradosControl1)){
                    for($i= 0; $i<count($request->dosimRetiradosControl1); $i++){
                        
                        if($request->dosimRetiradosControl1[$i] != null){
                            $cambioNovedadDosimetria = new Cambiosnovedadmeses();
                            $cambioNovedadDosimetria->novedadmesescontdosidepto_id = empty($newNovedadmesescontdosisededepto) ? $newNovedad->id_novedadmesescontdosi : $newNovedadmesescontdosisededepto->id_novedadmesescontdosi;
                            /* $cambioNovedadDosimetria->dosicontrol_id               = $request->dosiRetiradosControl1[$i];     */
                            $cambioNovedadDosimetria->tipo_novedad                 = $request->tipo_novedad;
                            $cambioNovedadDosimetria->nota_cambiodosim             = $request->inputnotasControl[$i];
                            $cambioNovedadDosimetria->save();
    
                            $retiroDosiControl = Dosicontrolcontdosisede::find($request->dosimRetiradosControl1[$i]);    
                            if($retiroDosiControl->ubicacion == 'TORAX' && $dosi_control_torax != 0){
                                $dosi_control_torax -= 1;
                            }elseif($retiroDosiControl->ubicacion == 'CRISTALINO' && $dosi_control_cristalino != 0){
                                $dosi_control_cristalino -= 1;
                            }elseif($retiroDosiControl->ubicacion == 'ANILLO' && $dosi_control_dedo != 0){
                                $dosi_control_dedo -= 1;
                            }
                            $updateDosimetros = Dosimetro::where('id_dosimetro', '=', $retiroDosiControl->dosimetro_id)
                            ->update([
                                'estado_dosimetro' => 'STOCK',
                                'uso_dosimetro' => ''
                            ]);
                            $updateHolders = Holder::where('id_holder', '=', $retiroDosiControl->holder_id)
                            ->update([
                                'estado_holder' => 'STOCK'
                            ]);
                            $retiroDosiControl->delete();
                        }
                    }
                }
                if(!empty($request->dosimRetiradosArea1)){
                    for($i= 0; $i<count($request->dosimRetiradosArea1); $i++){
                        if($request->dosimRetiradosArea1[$i] != null){
                            $cambioNovedadDosimetria = new Cambiosnovedadmeses();
            
                            $cambioNovedadDosimetria->novedadmesescontdosidepto_id = empty($newNovedadmesescontdosisededepto) ? $newNovedad->id_novedadmesescontdosi : $newNovedadmesescontdosisededepto->id_novedadmesescontdosi;
                            /* $cambioNovedadDosimetria->dosiarea_id                  = $request->dosimRetiradosArea1[$i]; */
                            $cambioNovedadDosimetria->tipo_novedad                 = $request->tipo_novedad;
                            $cambioNovedadDosimetria->nota_cambiodosim             = $request->inputnotasAreas[$i];
                            $cambioNovedadDosimetria->save();  
    
                            $retiroDosiArea = Dosiareacontdosisede::find($request->dosimRetiradosArea1[$i]);
                            if($dosi_area != 0){
                                $dosi_area -= 1;
                            }
                            
                            $updateDosimetros = Dosimetro::where('id_dosimetro', '=', $retiroDosiArea->dosimetro_id)
                            ->update([
                                'estado_dosimetro' => 'STOCK',
                                'uso_dosimetro' => ''
                            ]);
                            $retiroDosiArea->delete();
                        }
                    }
                }
                if(!empty($request->dosimRetirados1)){
                    for($i= 0; $i<count($request->dosimRetirados1); $i++){
                        if($request->dosimRetirados1[$i] != null){
                            $cambioNovedadDosimetria = new Cambiosnovedadmeses();
                            $cambioNovedadDosimetria->novedadmesescontdosidepto_id = empty($newNovedadmesescontdosisededepto) ? $newNovedad->id_novedadmesescontdosi : $newNovedadmesescontdosisededepto->id_novedadmesescontdosi;
                            /*  $cambioNovedadDosimetria->trabajadordosimetro_id       = $request->dosimRetirados1[$i]; */
                            $cambioNovedadDosimetria->tipo_novedad                 = $request->tipo_novedad;
                            $cambioNovedadDosimetria->nota_cambiodosim             = $request->inputnotas[$i];
                            $cambioNovedadDosimetria->save();
    
                            $retiroDosiTrabj = Trabajadordosimetro::find($request->dosimRetirados1[$i]);
                            if($retiroDosiTrabj->ubicacion == 'TORAX' && $dosi_torax != 0){
                                $dosi_torax -= 1;
                            }elseif($retiroDosiTrabj->ubicacion == 'CASO' && $dosi_caso != 0){
                                $dosi_caso -= 1;
                            }elseif($retiroDosiTrabj->ubicacion == 'CRISTALINO' && $dosi_cristalino != 0){
                                $dosi_cristalino -= 1;
                            }elseif($retiroDosiTrabj->ubicacion == 'ANILLO' && $dosi_dedo != 0){
                                $dosi_dedo -= 1;
                            }
                            $updateDosimetros = Dosimetro::where('id_dosimetro', '=', $retiroDosiTrabj->dosimetro_id)
                            ->update([
                                'estado_dosimetro' => 'STOCK',
                                'uso_dosimetro' => ''
                            ]);
                            $updateHolders = Holder::where('id_holder', '=', $retiroDosiTrabj->holder_id)
                            ->update([
                                'estado_holder' => 'STOCK'
                            ]);
                            $retiroDosiTrabj->delete();
                        }
                    }
                }
            }

            if(!empty($request->id_ubicacion_control_asig)){
                for($i=0; $i<count($request->id_ubicacion_control_asig); $i++){
                    $newasignacionDosimetroControl = new Dosicontrolcontdosisede();
    
                    $newasignacionDosimetroControl->dosimetro_id              = $request->id_dosimetro_control_asig[$i];
                    $newasignacionDosimetroControl->holder_id                 = $request->id_holder_control_asig[$i] == 'NA' ? NULL : $request->id_holder_control_asig[$i];
                    $newasignacionDosimetroControl->contratodosimetriasede_id = $request->id_contratodosimetriasede;
                    $newasignacionDosimetroControl->contdosisededepto_id      = $request->id_contdosisededepto;
                    $newasignacionDosimetroControl->mes_asignacion            = $request->mestrabj_asig;
                    $newasignacionDosimetroControl->dosimetro_uso             = 'TRUE';
                    $newasignacionDosimetroControl->primer_dia_uso            = $request->primerDia_asigdosim;
                    $newasignacionDosimetroControl->ultimo_dia_uso            = $request->ultimoDia_asigdosim;
                    $newasignacionDosimetroControl->fecha_dosim_enviado       = $request->fecha_dosim_enviado;
                    $newasignacionDosimetroControl->ubicacion                 = $request->id_ubicacion_control_asig[$i];
                    $newasignacionDosimetroControl->energia                   = 'F';
                    $newasignacionDosimetroControl->save();
        
                    $updateDosimetros = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_control_asig[$i])
                    ->update([
                        'estado_dosimetro' => 'EN USO',
                        'uso_dosimetro' => 'CONTROL '.$request->id_ubicacion_control_asig[$i]
                    ]);
                    $updateHolder = Holder::where('id_holder', '=', $request->id_holder_control_asig[$i])
                    ->update([
                        'estado_holder' => 'EN USO'
                    ]);
                    $updateEstadoDosimControlmesig = Dosicontrolcontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                    ->where('contdosisededepto_id', $request->id_contdosisededepto)
                    ->where('mes_asignacion', ($request->mestrabj_asig)-1)
                    ->update([
                        'estado_dosimetro' => 'EN LECTURA',
                    ]); 
                    if($request->id_ubicacion_control_asig[$i] == 'ANILLO'){
                        $dosi_control_dedo += 1 ;
                    }
                    if($request->id_ubicacion_control_asig[$i] == 'CRISTALINO'){
                        $dosi_control_cristalino += 1 ;
                    }
                    if($request->id_ubicacion_control_asig[$i] == 'TORAX'){
                        $dosi_control_torax += 1 ;
                    }
                    
                    /* for($x=0; $x<count($request->inputnotas); $x++){
                        if($i==$x){
                            array_push($num_dosi_control, array('id'=> $newasignacionDosimetroControl->id_dosicontrolcontdosisedes, 'nota'=> $request->inputnotas[$x]));
                        }
                    } */
                    $cambioNovedadDosimetria = new Cambiosnovedadmeses();

                    $cambioNovedadDosimetria->novedadmesescontdosidepto_id = empty($newNovedadmesescontdosisededepto) ? $newNovedad->id_novedadmesescontdosi : $newNovedadmesescontdosisededepto->id_novedadmesescontdosi;
                    $cambioNovedadDosimetria->dosicontrol_id               = $newasignacionDosimetroControl->id_dosicontrolcontdosisedes;
                    $cambioNovedadDosimetria->tipo_novedad                 = $request->tipo_novedad;
                    $cambioNovedadDosimetria->nota_cambiodosim             = $request->inputnotasControl[$i];
                    $cambioNovedadDosimetria->save();
                }
            }
            if(!empty($request->id_trabajador_asig)){
                for($i=0; $i<count($request->id_trabajador_asig); $i++){
                    $newasignacionDosimetro = new Trabajadordosimetro();
            
                    $newasignacionDosimetro->contratodosimetriasede_id = $request->id_contratodosimetriasede;
                    $newasignacionDosimetro->persona_id                = $request->id_trabajador_asig[$i];
                    $newasignacionDosimetro->dosimetro_id              = $request->id_dosimetro_asig[$i];
                    $newasignacionDosimetro->holder_id                 = $request->id_holder_asig[$i] == 'NA' ? NULL : $request->id_holder_asig[$i];
                    $newasignacionDosimetro->contdosisededepto_id      = $request->id_contdosisededepto;
                    $newasignacionDosimetro->mes_asignacion            = $request->mestrabj_asig;
                    $newasignacionDosimetro->dosimetro_uso             = 'TRUE';
                    $newasignacionDosimetro->primer_dia_uso            = $request->primerDia_asigdosim;
                    $newasignacionDosimetro->ultimo_dia_uso            = $request->ultimoDia_asigdosim;
                    $newasignacionDosimetro->fecha_dosim_enviado       = $request->fecha_dosim_enviado;
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
                    if($request->id_ubicacion_asig[$i] == 'ANILLO'){
                        $dosi_dedo += 1 ;
                    }
                    if($request->id_ubicacion_asig[$i] == 'CRISTALINO'){
                        $dosi_cristalino += 1 ;
                    }
                    if($request->id_ubicacion_asig[$i] == 'TORAX'){
                        $dosi_torax += 1 ;
                    }
                    if($request->id_ubicacion_asig[$i] == 'CASO'){
                        $dosi_caso += 1 ;
                    }
                    /* for($x=0; $x<count($request->inputnotas); $x++){
                        if($i==$x){
                            array_push($num_dosi, array('id'=> $newasignacionDosimetro->id_trabajadordosimetro, 'nota'=> $request->inputnotas[$x]));
                        }
                    } */
                    /* array_push($num_dosi, $newasignacionDosimetro->id_trabajadordosimetro); */
                    $cambioNovedadDosimetria = new Cambiosnovedadmeses();

                    $cambioNovedadDosimetria->novedadmesescontdosidepto_id = empty($newNovedadmesescontdosisededepto) ? $newNovedad->id_novedadmesescontdosi : $newNovedadmesescontdosisededepto->id_novedadmesescontdosi;
                    $cambioNovedadDosimetria->trabajadordosimetro_id       = $newasignacionDosimetro->id_trabajadordosimetro;
                    $cambioNovedadDosimetria->tipo_novedad                 = $request->tipo_novedad;
                    $cambioNovedadDosimetria->nota_cambiodosim             = $request->inputnotas[$i];
                    $cambioNovedadDosimetria->save();
                    
                } 
            }
            if(!empty($request->id_area_asig)){
                for($i=0; $i<count($request->id_area_asig); $i++){
                    $newasignacionDosimetroArea = new Dosiareacontdosisede();
        
                    $newasignacionDosimetroArea->areadepartamentosede_id   = $request->id_area_asig[$i];
                    $newasignacionDosimetroArea->dosimetro_id              = $request->id_dosimetro_area_asig[$i];
                    $newasignacionDosimetroArea->contratodosimetriasede_id = $request->id_contratodosimetriasede;
                    $newasignacionDosimetroArea->contdosisededepto_id      = $request->id_contdosisededepto;
                    $newasignacionDosimetroArea->mes_asignacion            = $request->mestrabj_asig;
                    $newasignacionDosimetroArea->dosimetro_uso             = 'TRUE';
                    $newasignacionDosimetroArea->primer_dia_uso            = $request->primerDia_asigdosim;
                    $newasignacionDosimetroArea->ultimo_dia_uso            = $request->ultimoDia_asigdosim;
                    $newasignacionDosimetroArea->fecha_dosim_enviado       = $request->fecha_dosim_enviado;
                    $newasignacionDosimetroArea->energia                   = 'F';
                    $newasignacionDosimetroArea->save();
        
                    $updateDosimetros = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_area_asig[$i])
                    ->update([
                        'estado_dosimetro' => 'EN USO',
                        'uso_dosimetro' => 'AMBIENTAL'
                    ]);
                    $dosi_area += 1;
                    /* for($x=0; $x<count($request->inputnotasAreas); $x++){
                        if($i==$x){
                            array_push($num_dosi_area, array('id'=> $newasignacionDosimetroArea->id_dosiareacontdosisedes, 'nota'=> $request->inputnotasAreas[$x]));
                        }
                    } */
                    $cambioNovedadDosimetria = new Cambiosnovedadmeses();

                    $cambioNovedadDosimetria->novedadmesescontdosidepto_id = empty($newNovedadmesescontdosisededepto) ? $newNovedad->id_novedadmesescontdosi : $newNovedadmesescontdosisededepto->id_novedadmesescontdosi;
                    $cambioNovedadDosimetria->dosiarea_id                  = $newasignacionDosimetroArea->id_dosiareacontdosisedes;
                    $cambioNovedadDosimetria->tipo_novedad                 = $request->tipo_novedad;
                    $cambioNovedadDosimetria->nota_cambiodosim             = $request->inputnotasAreas[$i];
                    $cambioNovedadDosimetria->save();
                }
            }
            $newMesescontdosisedeptos = new Mesescontdosisedeptos();
            $newMesescontdosisedeptos->contdosisededepto_id     = $request->id_contdosisededepto;
            $newMesescontdosisedeptos->mes_asignacion           = $request->mestrabj_asig;
            if($request->controlTransT_unicoCont == 'TRUE'){
                $newMesescontdosisedeptos->dosi_control_torax       = $dosi_control_torax == null ? 0 : $dosi_control_torax;
            }
            if($request->controlTransC_unicoCont == 'TRUE'){
                $newMesescontdosisedeptos->dosi_control_cristalino  = $dosi_control_cristalino == null ? 0 : $dosi_control_cristalino;
            }
            if($request->controlTransA_unicoCont == 'TRUE'){
                $newMesescontdosisedeptos->dosi_control_dedo        = $dosi_control_dedo == null ? 0 : $dosi_control_dedo;
            }
            $newMesescontdosisedeptos->dosi_control_torax       = $dosi_control_torax == null ? 0 : $dosi_control_torax;
            $newMesescontdosisedeptos->dosi_control_cristalino  = $dosi_control_cristalino == null ? 0 : $dosi_control_cristalino;
            $newMesescontdosisedeptos->dosi_control_dedo        = $dosi_control_dedo == null ? 0 : $dosi_control_dedo;
            $newMesescontdosisedeptos->dosi_torax               = $dosi_torax == null ? 0 : $dosi_torax;
            $newMesescontdosisedeptos->dosi_area                = $dosi_area == null ? 0 : $dosi_area; 
            $newMesescontdosisedeptos->dosi_caso                = $dosi_caso == null ? 0 : $dosi_caso;
            $newMesescontdosisedeptos->dosi_cristalino          = $dosi_cristalino == null ? 0 : $dosi_cristalino;
            $newMesescontdosisedeptos->dosi_dedo                = $dosi_dedo == null ? 0 : $dosi_dedo;  
            $newMesescontdosisedeptos->controlTransT_unicoCont  = $request->controlTransT_unicoCont;
            $newMesescontdosisedeptos->controlTransC_unicoCont  = $request->controlTransC_unicoCont;
            $newMesescontdosisedeptos->controlTransA_unicoCont  = $request->controlTransA_unicoCont;
            $newMesescontdosisedeptos->save();
            if(empty($newNovedadmesescontdosisededepto)){
                $updateNovedadmeses = Novedadmesescontdosisededepto::where('id_novedadmesescontdosi', '=', $newNovedad->id_novedadmesescontdosi)
                ->update([
                    'mescontdosisededepto_id' => $newMesescontdosisedeptos->id_mescontdosisededepto
                ]);
            }else{
                $updateNovedadmeses = Novedadmesescontdosisededepto::where('id_novedadmesescontdosi', '=', $newNovedadmesescontdosisededepto->id_novedadmesescontdosi)
                ->update([
                    'mescontdosisededepto_id' => $newMesescontdosisedeptos->id_mescontdosisededepto
                ]);
            }
            if($request->periodoVacio == 'TRUE'){
                $updatecontratoDosisedepto = Contratodosimetriasededepto::where('id_contdosisededepto', $request->id_contdosisededepto)
                ->update([
                    'mes_actual'               => $request->mestrabj_asig + 1,
                    'dosi_control_torax'       => $dosi_control_torax == null ? 0 : $dosi_control_torax,
                    'dosi_control_cristalino'  => $dosi_control_cristalino == null ? 0 : $dosi_control_cristalino,
                    'dosi_control_dedo'        => $dosi_control_dedo == null ? 0 : $dosi_control_dedo,
                    'dosi_torax'               => $dosi_torax == null ? 0 : $dosi_torax,
                    'dosi_area'                => $dosi_area == null ? 0 : $dosi_area,
                    'dosi_caso'                => $dosi_caso == null ? 0 : $dosi_caso,
                    'dosi_cristalino'          => $dosi_cristalino == null ? 0 : $dosi_cristalino,
                    'dosi_dedo'                => $dosi_dedo == null ? 0 : $dosi_dedo,
                    'controlTransT_unicoCont'  => $request->controlTransT_unicoCont,
                    'controlTransC_unicoCont'  => $request->controlTransC_unicoCont,
                    'controlTransA_unicoCont'  => $request->controlTransA_unicoCont,
                ]);
            }else{
                $updatecontratoDosisedepto = Contratodosimetriasededepto::where('id_contdosisededepto', $request->id_contdosisededepto)
                ->update([
                    'mes_actual'               => $request->mestrabj_asig,
                    'dosi_control_torax'       => $dosi_control_torax == null ? 0 : $dosi_control_torax,
                    'dosi_control_cristalino'  => $dosi_control_cristalino == null ? 0 : $dosi_control_cristalino,
                    'dosi_control_dedo'        => $dosi_control_dedo == null ? 0 : $dosi_control_dedo,
                    'dosi_torax'               => $dosi_torax == null ? 0 : $dosi_torax,
                    'dosi_area'                => $dosi_area == null ? 0 : $dosi_area,
                    'dosi_caso'                => $dosi_caso == null ? 0 : $dosi_caso,
                    'dosi_cristalino'          => $dosi_cristalino == null ? 0 : $dosi_cristalino,
                    'dosi_dedo'                => $dosi_dedo == null ? 0 : $dosi_dedo,
                    'controlTransT_unicoCont'  => $request->controlTransT_unicoCont,
                    'controlTransC_unicoCont'  => $request->controlTransC_unicoCont,
                    'controlTransA_unicoCont'  => $request->controlTransA_unicoCont,
                ]);
            }
            $ControlesUnicoContrato = Contratodosimetriasededepto::join('contratodosimetriasedes', 'contratodosimetriasede_id', '=', 'id_contratodosimetriasede')
            ->where('contratodosimetria_id', '=', $request->id_contratodosimetria)
            ->get();
            for($i= 0; $i<count($ControlesUnicoContrato); $i++){
                if($ControlesUnicoContrato[$i]->controlTransT_unicoCont != $request->controlTransT_unicoCont){
                    $updateControlUnicoContrato = Contratodosimetriasededepto::join('contratodosimetriasedes', 'contratodosimetriasede_id', '=', 'id_contratodosimetriasede')
                    ->where('contratodosimetria_id', '=', $request->id_contratodosimetria)
                    ->update([
                        'contratodosimetriasededeptos.controlTransT_unicoCont'  => $request->controlTransT_unicoCont,
                    ]);
                }
                if($ControlesUnicoContrato[$i]->controlTransC_unicoCont != $request->controlTransC_unicoCont){
                    $updateControlUnicoContrato = Contratodosimetriasededepto::join('contratodosimetriasedes', 'contratodosimetriasede_id', '=', 'id_contratodosimetriasede')
                    ->where('contratodosimetria_id', '=', $request->id_contratodosimetria)
                    ->update([
                        'contratodosimetriasededeptos.controlTransC_unicoCont'  => $request->controlTransC_unicoCont,
                    ]);
                }
                if($ControlesUnicoContrato[$i]->controlTransA_unicoCont != $request->controlTransA_unicoCont){
                    $updateControlUnicoContrato = Contratodosimetriasededepto::join('contratodosimetriasedes', 'contratodosimetriasede_id', '=', 'id_contratodosimetriasede')
                    ->where('contratodosimetria_id', '=', $request->id_contratodosimetria)
                    ->update([
                        'contratodosimetriasededeptos.controlTransA_unicoCont'  => $request->controlTransA_unicoCont,
                    ]);
                }
            }
        }else{
            $newNovcontdosisededepto = new Novcontdosisededepto();
            
            $newNovcontdosisededepto->contdosisededepto_id          = $request->id_contdosisededepto;
            $newNovcontdosisededepto->contratodosimetriasede_id     = $request->id_contratodosimetriasede;
            $newNovcontdosisededepto->departamentosede_id           = $request->id_departamentosede;
            $newNovcontdosisededepto->mes_asignacion                = $request->mestrabj_asig;
            $newNovcontdosisededepto->estado_nov                    = 'ACTIVO';
            $newNovcontdosisededepto->save();

            $newNovedadmesescontdosisededepto = Novedadmesescontdosisededepto::find($request->id_novedad);
            if(empty($newNovedadmesescontdosisededepto)){
                $newNovedad = new Novedadmesescontdosisededepto();
                $newNovedad->codigo_novedad           = $request->id_novedad;
                $newNovedad->novcontdosisededepto_id  = $newNovcontdosisededepto->id_novcontdosisededepto;
                $newNovedad->mes_asignacion           = $request->mestrabj_asig;
                $newNovedad->save();
            }
            if(!empty($request->id_ubicacion_control_asig)){
                for($i=0; $i<count($request->id_ubicacion_control_asig); $i++){
                    $newasignacionDosimetroControl = new Dosicontrolcontdosisede();
        
                    $newasignacionDosimetroControl->dosimetro_id              = $request->id_dosimetro_control_asig[$i];
                    $newasignacionDosimetroControl->holder_id                 = $request->id_holder_control_asig[$i] == 'NA' ? null : $request->id_holder_control_asig[$i];
                    $newasignacionDosimetroControl->contratodosimetriasede_id = $request->id_contratodosimetriasede;
                    $newasignacionDosimetroControl->contdosisededepto_id      = $request->id_contdosisededepto;
                    $newasignacionDosimetroControl->novcontdosisededepto_id   = $newNovcontdosisededepto->id_novcontdosisededepto;
                    $newasignacionDosimetroControl->mes_asignacion            = $request->mestrabj_asig;
                    $newasignacionDosimetroControl->dosimetro_uso             = 'TRUE';
                    $newasignacionDosimetroControl->primer_dia_uso            = $request->primerDia_asigdosim;
                    $newasignacionDosimetroControl->ultimo_dia_uso            = $request->ultimoDia_asigdosim;
                    $newasignacionDosimetroControl->fecha_dosim_enviado       = $request->fecha_dosim_enviado;
                    $newasignacionDosimetroControl->ubicacion                 = $request->id_ubicacion_control_asig[$i];
                    $newasignacionDosimetroControl->energia                   = 'F';
                    $newasignacionDosimetroControl->save();
        
                    $updateDosimetros = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_control_asig[$i])
                    ->update([
                        'estado_dosimetro' => 'EN USO',
                        'uso_dosimetro' => 'CONTROL '.$request->id_ubicacion_control_asig[$i],
                    ]);
                    $updateHolder = Holder::where('id_holder', '=', $request->id_holder_control_asig[$i])
                    ->update([
                        'estado_holder' => 'EN USO'
                    ]);
                    if($request->id_ubicacion_control_asig[$i] == 'TORAX'){
                        $dosi_control_torax += 1;
                    }elseif($request->id_ubicacion_control_asig[$i] == 'CRISTALINO'){
                        $dosi_control_cristalino += 1;
                    }elseif($request->id_ubicacion_control_asig[$i] == 'ANILLO'){
                        $dosi_control_dedo += 1;
                    }
                    /* for($x=0; $x<count($request->inputnotasControl); $x++){
                        if($i==$x){
                            array_push($num_dosi_control, array('id'=> $newasignacionDosimetroControl->id_dosicontrolcontdosisedes, 'nota'=> $request->inputnotasControl[$x]));
                        }
                    } */
                    $cambioNovedadDosimetria = new Cambiosnovedadmeses();
    
                    $cambioNovedadDosimetria->novedadmesescontdosidepto_id = empty($newNovedadmesescontdosisededepto) ? $newNovedad->id_novedadmesescontdosi : $newNovedadmesescontdosisededepto->id_novedadmesescontdosi;
                    $cambioNovedadDosimetria->dosicontrol_id               = $newasignacionDosimetroControl->id_dosicontrolcontdosisedes;
                    $cambioNovedadDosimetria->tipo_novedad                 = $request->tipo_novedad;
                    $cambioNovedadDosimetria->nota_cambiodosim             = $request->inputnotasControl[$i];
                    $cambioNovedadDosimetria->save();
                }
            }
            if(!empty($request->id_area_asig)){
                for($i=0; $i<count($request->id_area_asig); $i++){
                    $newasignacionDosimetroArea = new Dosiareacontdosisede();
        
                    $newasignacionDosimetroArea->areadepartamentosede_id   = $request->id_area_asig[$i];
                    $newasignacionDosimetroArea->dosimetro_id              = $request->id_dosimetro_area_asig[$i];
                    $newasignacionDosimetroArea->contratodosimetriasede_id = $request->id_contratodosimetriasede;
                    $newasignacionDosimetroArea->contdosisededepto_id      = $request->id_contdosisededepto;
                    $newasignacionDosimetroArea->novcontdosisededepto_id   = $newNovcontdosisededepto->id_novcontdosisededepto;
                    $newasignacionDosimetroArea->mes_asignacion            = $request->mestrabj_asig;
                    $newasignacionDosimetroArea->dosimetro_uso             = 'TRUE';
                    $newasignacionDosimetroArea->primer_dia_uso            = $request->primerDia_asigdosim;
                    $newasignacionDosimetroArea->ultimo_dia_uso            = $request->ultimoDia_asigdosim;
                    $newasignacionDosimetroArea->fecha_dosim_enviado       = $request->fecha_dosim_enviado;
                    $newasignacionDosimetroArea->energia                   = 'F';
                    $newasignacionDosimetroArea->save();
        
                    $updateDosimetros = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_area_asig[$i])
                    ->update([
                        'estado_dosimetro' => 'EN USO',
                        'uso_dosimetro' => 'AMBIENTAL'
                    ]);
                    $dosi_area += 1;
                    /* for($x=0; $x<count($request->inputnotasAreas); $x++){
                        if($i==$x){
                            array_push($num_dosi_area, array('id'=> $newasignacionDosimetroArea->id_dosiareacontdosisedes, 'nota'=> $request->inputnotasAreas[$x]));
                        }
                    } */
                    $cambioNovedadDosimetria = new Cambiosnovedadmeses();

                    $cambioNovedadDosimetria->novedadmesescontdosidepto_id = empty($newNovedadmesescontdosisededepto) ? $newNovedad->id_novedadmesescontdosi : $newNovedadmesescontdosisededepto->id_novedadmesescontdosi;
                    $cambioNovedadDosimetria->dosiarea_id                  = $newasignacionDosimetroArea->id_dosiareacontdosisedes;
                    $cambioNovedadDosimetria->tipo_novedad                 = $request->tipo_novedad;
                    $cambioNovedadDosimetria->nota_cambiodosim             = $request->inputnotasAreas[$i];
                    $cambioNovedadDosimetria->save();
                }
            }
            if(!empty($request->id_trabajador_asig)){
                for($i=0; $i<count($request->id_trabajador_asig); $i++){
                    $newasignacionDosimetro = new Trabajadordosimetro();
                
                    $newasignacionDosimetro->contratodosimetriasede_id = $request->id_contratodosimetriasede;
                    $newasignacionDosimetro->persona_id                = $request->id_trabajador_asig[$i];
                    $newasignacionDosimetro->dosimetro_id              = $request->id_dosimetro_asig[$i];
                    $newasignacionDosimetro->holder_id                 = $request->id_holder_asig[$i] == 'NA' ? NULL : $request->id_holder_asig[$i];
                    $newasignacionDosimetro->contdosisededepto_id      = $request->id_contdosisededepto;
                    $newasignacionDosimetro->novcontdosisededepto_id   = $newNovcontdosisededepto->id_novcontdosisededepto;
                    $newasignacionDosimetro->mes_asignacion            = $request->mestrabj_asig;
                    $newasignacionDosimetro->dosimetro_uso             = 'TRUE';
                    $newasignacionDosimetro->primer_dia_uso            = $request->primerDia_asigdosim;
                    $newasignacionDosimetro->ultimo_dia_uso            = $request->ultimoDia_asigdosim;
                    $newasignacionDosimetro->fecha_dosim_enviado       = $request->fecha_dosim_enviado;
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
                    if($request->id_ubicacion_asig[$i] == 'ANILLO'){
                        $dosi_dedo += 1 ;
                    }
                    if($request->id_ubicacion_asig[$i] == 'CRISTALINO'){
                        $dosi_cristalino += 1 ;
                    }
                    if($request->id_ubicacion_asig[$i] == 'TORAX'){
                        $dosi_torax += 1 ;
                    }
                    if($request->id_ubicacion_asig[$i] == 'CASO'){
                        $dosi_caso += 1 ;
                    }
                    /* for($x=0; $x<count($request->inputnotas); $x++){
                        if($i==$x){
                            array_push($num_dosi, array('id'=> $newasignacionDosimetro->id_trabajadordosimetro, 'nota'=> $request->inputnotas[$x]));
                        }
                    } */
                    $cambioNovedadDosimetria = new Cambiosnovedadmeses();

                    $cambioNovedadDosimetria->novedadmesescontdosidepto_id = empty($newNovedadmesescontdosisededepto) ? $newNovedad->id_novedadmesescontdosi : $newNovedadmesescontdosisededepto->id_novedadmesescontdosi;
                    $cambioNovedadDosimetria->trabajadordosimetro_id       = $newasignacionDosimetro->id_trabajadordosimetro;
                    $cambioNovedadDosimetria->tipo_novedad                 = $request->tipo_novedad;
                    $cambioNovedadDosimetria->nota_cambiodosim             = $request->inputnotas[$i];
                    $cambioNovedadDosimetria->save();
                }
            }
            $newMesescontdosisedeptos = new Mesescontdosisedeptos();
            $newMesescontdosisedeptos->contdosisededepto_id     = $request->id_contdosisededepto;
            $newMesescontdosisedeptos->novcontdosisededepto_id  = $newNovcontdosisededepto->id_novcontdosisededepto;
            $newMesescontdosisedeptos->mes_asignacion           = $request->mestrabj_asig;
            $newMesescontdosisedeptos->dosi_control_torax       = $dosi_control_torax == null ? 0 : $dosi_control_torax;
            $newMesescontdosisedeptos->dosi_control_cristalino  = $dosi_control_cristalino == null ? 0 : $dosi_control_cristalino;
            $newMesescontdosisedeptos->dosi_control_dedo        = $dosi_control_dedo == null ? 0 : $dosi_control_dedo;
            $newMesescontdosisedeptos->dosi_torax               = $dosi_torax == null ? 0 : $dosi_torax;
            $newMesescontdosisedeptos->dosi_area                = $dosi_area == null ? 0 : $dosi_area; 
            $newMesescontdosisedeptos->dosi_caso                = $dosi_caso == null ? 0 : $dosi_caso;
            $newMesescontdosisedeptos->dosi_cristalino          = $dosi_cristalino == null ? 0 : $dosi_cristalino;
            $newMesescontdosisedeptos->dosi_dedo                = $dosi_dedo == null ? 0 : $dosi_dedo;  
    
            $newMesescontdosisedeptos->save();
            if(empty($newNovedadmesescontdosisededepto)){
                $updateNovedadmeses = Novedadmesescontdosisededepto::where('id_novedadmesescontdosi', '=', $newNovedad->id_novedadmesescontdosi)
                ->update([
                    'mescontdosisededepto_id' => $newMesescontdosisedeptos->id_mescontdosisededepto
                ]);
            }else{
                $updateNovedadmeses = Novedadmesescontdosisededepto::where('id_novedadmesescontdosi', '=', $newNovedadmesescontdosisededepto->id_novedadmesescontdosi)
                ->update([
                    'mescontdosisededepto_id' => $newMesescontdosisedeptos->id_mescontdosisededepto
                ]);
            }

            $updatecontratoDosisedepto = Novcontdosisededepto::where('id_novcontdosisededepto', $newNovcontdosisededepto->id_novcontdosisededepto)
            ->update([
                'dosi_control_torax'       => $dosi_control_torax == null ? 0 : $dosi_control_torax,
                'dosi_control_cristalino'  => $dosi_control_cristalino == null ? 0 : $dosi_control_cristalino,
                'dosi_control_dedo'        => $dosi_control_dedo == null ? 0 : $dosi_control_dedo,
                'dosi_torax'               => $dosi_torax == null ? 0 : $dosi_torax,
                'dosi_area'                => $dosi_area == null ? 0 : $dosi_area,
                'dosi_caso'                => $dosi_caso == null ? 0 : $dosi_caso,
                'dosi_cristalino'          => $dosi_cristalino == null ? 0 : $dosi_cristalino,
                'dosi_dedo'                => $dosi_dedo == null ? 0 : $dosi_dedo,
            ]);
        }
    
        return back()->with('guardar', 'ok');
        /* return $request; */
    }
    public function savemesiguientecambiocantdosim(Request $request){
        
        /* return $request; */
        $dosi_control_torax = 0;
        $dosi_control_cristalino = 0;
        $dosi_control_dedo = 0;
        $dosi_torax= 0;
        $dosi_area = 0; 
        $dosi_caso = 0;
        $dosi_cristalino = 0;
        $dosi_dedo = 0;

        $num_dosi_control = [];
        $num_dosi = [];
        $num_dosi_area = [];
        $newNovedadmesescontdosisededepto = Novedadmesescontdosisededepto::find($request->id_novedad);
        if(empty($newNovedadmesescontdosisededepto)){
            $newNovedad = new Novedadmesescontdosisededepto();
            $newNovedad->codigo_novedad           = $request->id_novedad_sig;
            $newNovedad->contdosisededepto_id     = $request->contdosisededepto;
            $newNovedad->mes_asignacion           = $request->mes_asig_siguiente;
            $newNovedad->save();
        }
        
        ////GUARDAR SI HAY UN CONTROL EN UNA ASIGNACION ANTIGUA///////
        if(!empty($request->id_dosimetro_asigdosimControl) && empty($request->checkDelete)){
            
            for($i=0; $i<count($request->id_dosimetro_asigdosimControl); $i++){
                $newasignacionAntiguaControl = new Dosicontrolcontdosisede();

                $newasignacionAntiguaControl->dosimetro_id                  = $request->id_dosimetro_asigdosimControl[$i] == 'null' ? NULL : $request->id_dosimetro_asigdosimControl[$i];
                if($request->id_holder_asigdosimControl[$i] == 'null' || $request->id_holder_asigdosimControl[$i] == 'NA'){
                    $newasignacionAntiguaControl->holder_id                 = NULL;
                }else{
                    $newasignacionAntiguaControl->holder_id                 = $request->id_holder_asigdosimControl[$i];
                }
                if($request->controlTransT_unicoCont2 == 'TRUE' || $request->controlTransC_unicoCont2 == 'TRUE' || $request->controlTransA_unicoCont2 == 'TRUE'){
                    $newasignacionAntiguaControl->contratodosimetria_id     = $request->id_contratodosimetria;
                    $newasignacionAntiguaControl->controlTransT_unicoCont   = $request->controlTransT_unicoCont2;
                    $newasignacionAntiguaControl->controlTransC_unicoCont   = $request->controlTransC_unicoCont2;
                    $newasignacionAntiguaControl->controlTransA_unicoCont   = $request->controlTransA_unicoCont2;
                }else{
                    $newasignacionAntiguaControl->contratodosimetriasede_id = $request->id_contdosisede;
                    $newasignacionAntiguaControl->contdosisededepto_id      = $request->contdosisededepto;
                }
                $newasignacionAntiguaControl->mes_asignacion            = $request->mes_asig_siguiente;
                $newasignacionAntiguaControl->dosimetro_uso             = 'TRUE';
                $newasignacionAntiguaControl->primer_dia_uso            = $request->primerDia_asigdosim2;
                $newasignacionAntiguaControl->ultimo_dia_uso            = $request->ultimoDia_asigdosim2;
                $newasignacionAntiguaControl->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado2;
                $newasignacionAntiguaControl->ubicacion                 = $request->ubicacion_asigdosimControl[$i];
                $newasignacionAntiguaControl->energia                   = 'F';

                $newasignacionAntiguaControl->save();
                
                $updateDosimetros = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimControl[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro' => 'CONTROL '.$request->ubicacion_asigdosimControl[$i],
                ]);
                $updateHolder = Holder::where('id_holder', '=', $request->id_holder_asigdosimControl[$i])
                ->update([
                    'estado_holder' => 'EN USO'
                ]);
                $updateEstadoDosimControlmesig = Dosicontrolcontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                    ->where('contdosisededepto_id', $request->contdosisededepto)
                    ->where('mes_asignacion', ($request->mes_asig_siguiente)-1)
                    ->update([
                        'estado_dosimetro' => 'EN LECTURA',
                ]); 

                if($request->ubicacion_asigdosimControl[$i] == 'TORAX' && $request->controlTransT_unicoCont2 == NULL){
                    $dosi_control_torax += 1 ;
                }elseif($request->ubicacion_asigdosimControl[$i] == 'CRISTALINO' && $request->controlTransC_unicoCont2 == NULL){
                    $dosi_control_cristalino += 1 ;
                }elseif($request->ubicacion_asigdosimControl[$i] == 'ANILLO' && $request->controlTransA_unicoCont2 == NULL){
                    $dosi_control_dedo += 1 ;
                }
                
            }
        }
        ////GUARDAR SI ES UN DOSIMETRO TORAX, CASO, CRISTALINO,DEDO DE UNA ASIGNACION ANTIGUA///
        if(!empty($request->id_trabj_asigdosim)){

            for($i=0; $i<count($request->id_trabj_asigdosim); $i++){
                $newasignacionAntigua = new Trabajadordosimetro();
    
                $newasignacionAntigua->contratodosimetriasede_id = $request->id_contdosisede;
                $newasignacionAntigua->persona_id                = $request->id_trabj_asigdosim[$i];
                $newasignacionAntigua->dosimetro_id              = $request->id_dosimetro_asigdosim[$i] == 'null' ? NULL : $request->id_dosimetro_asigdosim[$i];
                if($request->id_holder_asigdosim[$i] == 'NA' || $request->id_holder_asigdosim[$i] == 'null'){ 
                    $newasignacionAntigua->holder_id             = NULL;
                }else{ 
                    $newasignacionAntigua->holder_id          = $request->id_holder_asigdosim[$i]; 
                }
                $newasignacionAntigua->contdosisededepto_id      = $request->contdosisededepto;
                $newasignacionAntigua->mes_asignacion            = $request->mes_asig_siguiente;
                $newasignacionAntigua->dosimetro_uso             = 'TRUE';
                $newasignacionAntigua->primer_dia_uso            = $request->primerDia_asigdosim2;
                $newasignacionAntigua->ultimo_dia_uso            = $request->ultimoDia_asigdosim2;
                $newasignacionAntigua->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado2;
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
                if($request->ubicacion_asigdosim[$i] == 'TORAX'){
                    $dosi_torax += 1 ;
                }elseif($request->ubicacion_asigdosim[$i] == 'CASO'){
                    $dosi_caso += 1 ;
                }elseif($request->ubicacion_asigdosim[$i] == 'ANILLO'){
                    $dosi_dedo += 1 ;
                }elseif($request->ubicacion_asigdosim[$i] == 'CRISTALINO'){
                    $dosi_cristalino += 1 ;
                }
            }  
        }
        ////GUARDAR SI ES UN DOSIMETRO AREA DE UNA ASIGNACION ANTIGUA///
        if(!empty($request->id_area_asigdosim)){

            for($i=0; $i<count($request->id_area_asigdosim); $i++){
                $newasignacionAntiguaArea = new Dosiareacontdosisede();
                $newasignacionAntiguaArea->areadepartamentosede_id   = $request->id_area_asigdosim[$i];
                $newasignacionAntiguaArea->dosimetro_id              = $request->id_dosimetro_area_asigdosim[$i] == 'null' ? NULL : $request->id_dosimetro_area_asigdosim[$i];
                $newasignacionAntiguaArea->contratodosimetriasede_id = $request->id_contdosisede;
                $newasignacionAntiguaArea->contdosisededepto_id      = $request->contdosisededepto;
                $newasignacionAntiguaArea->mes_asignacion            = $request->mes_asig_siguiente;
                $newasignacionAntiguaArea->dosimetro_uso             = 'TRUE';
                $newasignacionAntiguaArea->primer_dia_uso            = $request->primerDia_asigdosim2;
                $newasignacionAntiguaArea->ultimo_dia_uso            = $request->ultimoDia_asigdosim2;
                $newasignacionAntiguaArea->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado2;
                $newasignacionAntiguaArea->energia                   = 'F';
                $newasignacionAntiguaArea->save(); 
    
                if($request->id_dosimetro_area_asigdosim[$i] != null){
                    $updateDosimetros = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_area_asigdosim[$i])
                    ->update([
                        'estado_dosimetro' => 'EN USO',
                        'uso_dosimetro' => 'AMBIENTAL'
                    ]);
                }
                $updateEstadoDosimasigmesig = Dosiareacontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                    ->where('contdosisededepto_id', $request->contdosisededepto)
                    ->where('mes_asignacion', ($request->mes_asig_siguiente)-1)
                    ->update([
                        'estado_dosimetro' => 'EN LECTURA',
                ]); 
                $dosi_area += 1;
            }  
        }

        ///////SI LA NOVEDAD ES DE TIPO 2 ES DECIR UN RETIRO DE DOSIMETRO SOLO SE GUARDA cambio por cambio segun el tamaño de los arrays/////
        if($request->tipo_novedad == 2){
            if(!empty($request->dosimRetiradosControl)){
                for($i= 0; $i<count($request->dosimRetiradosControl); $i++){
                    if($request->dosimRetiradosControl[$i] != null){
                        $cambioNovedadDosimetria = new Cambiosnovedadmeses();
        
                        $cambioNovedadDosimetria->novedadmesescontdosidepto_id = empty($newNovedadmesescontdosisededepto) ? $newNovedad->id_novedadmesescontdosi : $newNovedadmesescontdosisededepto->id_novedadmesescontdosi;
                        /* $cambioNovedadDosimetria->dosicontrol_id               = $request->dosiRetiradosControl[$i]; */    
                        $cambioNovedadDosimetria->tipo_novedad                 = $request->tipo_novedad;
                        $cambioNovedadDosimetria->nota_cambiodosim             = $request->inputnotasControl[$i];
                        $cambioNovedadDosimetria->save();

                    }
                }
            }
            if(!empty($request->dosimRetiradosArea)){
                for($i= 0; $i<count($request->dosimRetiradosArea); $i++){
                    if($request->dosimRetiradosArea[$i] != null){
                        $cambioNovedadDosimetria = new Cambiosnovedadmeses();
        
                        $cambioNovedadDosimetria->novedadmesescontdosidepto_id = empty($newNovedadmesescontdosisededepto) ? $newNovedad->id_novedadmesescontdosi : $newNovedadmesescontdosisededepto->id_novedadmesescontdosi;
                        /* $cambioNovedadDosimetria->dosiarea_id                  = $request->dosimRetiradosArea[$i]; */
                        $cambioNovedadDosimetria->tipo_novedad                 = $request->tipo_novedad;
                        $cambioNovedadDosimetria->nota_cambiodosim             = $request->inputnotasAreas[$i];
                        $cambioNovedadDosimetria->save();  

                    }
                }
            }
            if(!empty($request->dosimRetirados)){
                for($i= 0; $i<count($request->dosimRetirados); $i++){
                    if($request->dosimRetirados[$i] != null){
                        
                        $cambioNovedadDosimetria = new Cambiosnovedadmeses();
        
                        $cambioNovedadDosimetria->novedadmesescontdosidepto_id = empty($newNovedadmesescontdosisededepto) ? $newNovedad->id_novedadmesescontdosi : $newNovedadmesescontdosisededepto->id_novedadmesescontdosi;
                        /* $cambioNovedadDosimetria->trabajadordosimetro_id       = $request->dosimRetirados[$i]; */
                        $cambioNovedadDosimetria->tipo_novedad                 = $request->tipo_novedad;
                        $cambioNovedadDosimetria->nota_cambiodosim             = $request->inputnotas[$i];
                        $cambioNovedadDosimetria->save();

                    }
                }
            }
           
        }
        ////////GUARDAR ASIGNACION NUEVA TIPO CONTROL Y GUARDAR EL CAMBIO DE LA NOVEDAD TIPO 1////
        if(!empty($request->id_ubicacion_control_asig)){
            for($i=0; $i<count($request->id_ubicacion_control_asig); $i++){
                $newasignacionDosimetroControl = new Dosicontrolcontdosisede();

                $newasignacionDosimetroControl->dosimetro_id              = $request->id_dosimetro_control_asig[$i] == 'null' ? NULL : $request->id_dosimetro_control_asig[$i];
                if($request->id_holder_control_asig[$i] == 'null' || $request->id_holder_control_asig[$i] == 'NA'){
                    $newasignacionDosimetroControl->holder_id    = NULL;
                }else{
                    $request->id_holder_control_asig[$i];
                }
                $newasignacionDosimetroControl->contratodosimetriasede_id = $request->id_contdosisede;
                $newasignacionDosimetroControl->contdosisededepto_id      = $request->contdosisededepto;
                $newasignacionDosimetroControl->mes_asignacion            = $request->mes_asig_siguiente;
                $newasignacionDosimetroControl->dosimetro_uso             = 'TRUE';
                $newasignacionDosimetroControl->primer_dia_uso            = $request->primerDia_asigdosim2;
                $newasignacionDosimetroControl->ultimo_dia_uso            = $request->ultimoDia_asigdosim2;
                $newasignacionDosimetroControl->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado2;
                $newasignacionDosimetroControl->ubicacion                 = $request->id_ubicacion_control_asig[$i];
                $newasignacionDosimetroControl->energia                   = 'F';
                $newasignacionDosimetroControl->save();

                $updateDosimetros = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_control_asig[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro' => 'CONTROL '.$request->id_ubicacion_control_asig[$i],
                ]);
                $updateHolder = Holder::where('id_holder', '=', $request->id_holder_control_asig[$i])
                ->update([
                    'estado_holder' => 'EN USO'
                ]);
                $updateEstadoDosimControlmesig = Dosicontrolcontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                    ->where('contdosisededepto_id', $request->contdosisededepto)
                    ->where('mes_asignacion', ($request->mes_asig_siguiente)-1)
                    ->update([
                        'estado_dosimetro' => 'EN LECTURA',
                ]); 
                if($request->id_ubicacion_control_asig[$i] == 'TORAX'){
                    $dosi_control_torax += 1 ;
                }elseif($request->id_ubicacion_control_asig[$i] == 'CRISTALINO'){
                    $dosi_control_cristalino += 1 ;
                }elseif($request->id_ubicacion_control_asig[$i] == 'ANILLO'){
                    $dosi_control_dedo += 1 ;
                }
                /* for($x=0; $x<count($request->inputnotasControl); $x++){
                    if($i==$x){
                        array_push($num_dosi_control, array('id'=> $newasignacionDosimetroControl->id_dosicontrolcontdosisedes, 'nota'=> $request->inputnotasControl[$x]));
                    }
                } */
                $cambioNovedadDosimetria = new Cambiosnovedadmeses();

                $cambioNovedadDosimetria->novedadmesescontdosidepto_id = empty($newNovedadmesescontdosisededepto) ? $newNovedad->id_novedadmesescontdosi : $newNovedadmesescontdosisededepto->id_novedadmesescontdosi;
                $cambioNovedadDosimetria->dosicontrol_id               = $newasignacionDosimetroControl->id_dosicontrolcontdosisedes;
                $cambioNovedadDosimetria->tipo_novedad                 = $request->tipo_novedad;
                $cambioNovedadDosimetria->nota_cambiodosim             = $request->inputnotasControl[$i];
                $cambioNovedadDosimetria->save();
                /* array_push($num_dosi_control, $newasignacionDosimetroControl->id_dosicontrolcontdosisedes); */
            }
        };
         ////////GUARDAR ASIGNACION NUEVA TIPO TORAX, CASO, CRISTALINO, ANILLO Y GUARDAR EL CAMBIO DE LA NOVEDAD TIPO 1////
        if(!empty($request->id_trabajador_asig)){

            for($i=0; $i<count($request->id_trabajador_asig); $i++){
                $newasignacion = new Trabajadordosimetro();
        
                $newasignacion->contratodosimetriasede_id    = $request->id_contdosisede;
                $newasignacion->persona_id                   = $request->id_trabajador_asig[$i];
                $newasignacion->dosimetro_id                 = $request->id_dosimetro_asig[$i] == 'null' ? NULL : $request->id_dosimetro_asig[$i];
                if($request->id_holder_asig[$i] == 'NA' || $request->id_holder_asig[$i] == 'null'){ 
                    $newasignacion->holder_id             = NULL;
                }else{ 
                    $newasignacion->holder_id             = $request->id_holder_asig[$i]; 
                }
                $newasignacion->contdosisededepto_id         = $request->contdosisededepto;
                $newasignacion->mes_asignacion               = $request->mes_asig_siguiente;
                $newasignacion->dosimetro_uso                = 'TRUE';
                $newasignacion->primer_dia_uso               = $request->primerDia_asigdosim2;
                $newasignacion->ultimo_dia_uso               = $request->ultimoDia_asigdosim2;
                $newasignacion->fecha_dosim_enviado          = $request->fecha_envio_dosim_asignado2;
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
                
                if($request->id_ubicacion_asig[$i] == 'ANILLO'){
                    $dosi_dedo += 1 ;
                }
                if($request->id_ubicacion_asig[$i] == 'CRISTALINO'){
                    $dosi_cristalino += 1 ;
                }
                if($request->id_ubicacion_asig[$i] == 'TORAX'){
                    $dosi_torax += 1 ;
                }
                if($request->id_ubicacion_asig[$i] == 'CASO'){
                    $dosi_caso += 1 ;
                }
                /* for($x=0; $x<count($request->inputnotas); $x++){
                    if($i==$x){
                        array_push($num_dosi, array('id'=> $newasignacion->id_trabajadordosimetro, 'nota'=> $request->inputnotas[$x]));
                    }
                } */
                $cambioNovedadDosimetria = new Cambiosnovedadmeses();

                $cambioNovedadDosimetria->novedadmesescontdosidepto_id = empty($newNovedadmesescontdosisededepto) ? $newNovedad->id_novedadmesescontdosi : $newNovedadmesescontdosisededepto->id_novedadmesescontdosi;
                $cambioNovedadDosimetria->trabajadordosimetro_id       = $newasignacion->id_trabajadordosimetro;
                $cambioNovedadDosimetria->tipo_novedad                 = $request->tipo_novedad;
                $cambioNovedadDosimetria->nota_cambiodosim             = $request->inputnotas[$i];
                $cambioNovedadDosimetria->save();
                /* array_push($num_dosi, $newasignacion->id_trabajadordosimetro); */
            }
        };
          ////////GUARDAR ASIGNACION NUEVA TIPO AMBIENTAL Y GUARDAR EL CAMBIO DE LA NOVEDAD TIPO 1////
        if(!empty($request->id_area_asig)){

            for($i=0; $i<count($request->id_area_asig); $i++){
                $newasignacionArea = new Dosiareacontdosisede();
                
                $newasignacionArea->areadepartamentosede_id      = $request->id_area_asig[$i];
                $newasignacionArea->dosimetro_id                 = $request->id_dosimetro_area_asig[$i] == 'null' ? NULL : $request->id_dosimetro_area_asig[$i];
                $newasignacionArea->contratodosimetriasede_id    = $request->id_contdosisede;
                $newasignacionArea->contdosisededepto_id         = $request->contdosisededepto;
                $newasignacionArea->mes_asignacion               = $request->mes_asig_siguiente;
                $newasignacionArea->dosimetro_uso                = 'TRUE';
                $newasignacionArea->primer_dia_uso               = $request->primerDia_asigdosim2;
                $newasignacionArea->ultimo_dia_uso               = $request->ultimoDia_asigdosim2;
                $newasignacionArea->fecha_dosim_enviado          = $request->fecha_envio_dosim_asignado2;
                $newasignacionArea->energia                      = 'F';
                $newasignacionArea->save();

                $updateDosimetros = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_area_asig[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro' => 'AMBIENTAL'  
                ]);
                $updateEstadoDosimasigmesig = Dosiareacontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                    ->where('contdosisededepto_id', $request->contdosisededepto)
                    ->where('mes_asignacion', ($request->mes_asig_siguiente)-1)
                    ->update([
                        'estado_dosimetro' => 'EN LECTURA',
                ]);
                
                $dosi_area += 1 ;
               /*  for($x=0; $x<count($request->inputnotasAreas); $x++){
                    if($i==$x){
                        array_push($num_dosi_area, array('id'=> $newasignacionArea->id_dosiareacontdosisedes, 'nota'=> $request->inputnotasAreas[$x]));
                    }
                } */
                $cambioNovedadDosimetria = new Cambiosnovedadmeses();

                $cambioNovedadDosimetria->novedadmesescontdosidepto_id = empty($newNovedadmesescontdosisededepto) ? $newNovedad->id_novedadmesescontdosi : $newNovedadmesescontdosisededepto->id_novedadmesescontdosi;
                $cambioNovedadDosimetria->dosiarea_id                  = $newasignacionArea->id_dosiareacontdosisedes;
                $cambioNovedadDosimetria->tipo_novedad                 = $request->tipo_novedad;
                $cambioNovedadDosimetria->nota_cambiodosim             = $request->inputnotasAreas[$i];
                $cambioNovedadDosimetria->save();
                /* array_push($num_dosi, $newasignacion->id_trabajadordosimetro); */
            }
        };
        
        $newMesescontdosisedeptos = new Mesescontdosisedeptos();
        $newMesescontdosisedeptos->contdosisededepto_id     = $request->contdosisededepto;
        $newMesescontdosisedeptos->mes_asignacion           = $request->mes_asig_siguiente;
        if($request->controlTransT_unicoCont2 == 'TRUE'){
            $newMesescontdosisedeptos->dosi_control_torax       = $dosi_control_torax == null ? 0 : $dosi_control_torax;
        }
        if($request->controlTransC_unicoCont2 == 'TRUE'){
            $newMesescontdosisedeptos->dosi_control_cristalino  = $dosi_control_cristalino == null ? 0 : $dosi_control_cristalino;
        }
        if($request->controlTransA_unicoCont2 == 'TRUE'){
            $newMesescontdosisedeptos->dosi_control_dedo        = $dosi_control_dedo == null ? 0 : $dosi_control_dedo;
        }
        $newMesescontdosisedeptos->dosi_control_torax       = $dosi_control_torax == null ? 0 : $dosi_control_torax;
        $newMesescontdosisedeptos->dosi_control_cristalino  = $dosi_control_cristalino == null ? 0 : $dosi_control_cristalino;
        $newMesescontdosisedeptos->dosi_control_dedo        = $dosi_control_dedo == null ? 0 : $dosi_control_dedo;
        $newMesescontdosisedeptos->dosi_torax               = $dosi_torax == null ? 0 : $dosi_torax;
        $newMesescontdosisedeptos->dosi_area                = $dosi_area == null ? 0 : $dosi_area; 
        $newMesescontdosisedeptos->dosi_caso                = $dosi_caso == null ? 0 : $dosi_caso ;
        $newMesescontdosisedeptos->dosi_cristalino          = $dosi_cristalino == null ? 0 : $dosi_cristalino;
        $newMesescontdosisedeptos->dosi_dedo                = $dosi_dedo == null ? 0 : $dosi_dedo; 
        $newMesescontdosisedeptos->controlTransT_unicoCont  = $request->controlTransT_unicoCont2;
        $newMesescontdosisedeptos->controlTransC_unicoCont  = $request->controlTransC_unicoCont2;
        $newMesescontdosisedeptos->controlTransA_unicoCont  = $request->controlTransA_unicoCont2;
        $newMesescontdosisedeptos->save();

        if(empty($newNovedadmesescontdosisededepto)){
            $updateNovedadmeses = Novedadmesescontdosisededepto::where('id_novedadmesescontdosi', '=', $newNovedad->id_novedadmesescontdosi)
            ->update([
                'mescontdosisededepto_id' => $newMesescontdosisedeptos->id_mescontdosisededepto
            ]);
        }else{
            $updateNovedadmeses = Novedadmesescontdosisededepto::where('id_novedadmesescontdosi', '=', $newNovedadmesescontdosisededepto->id_novedadmesescontdosi)
            ->update([
                'mescontdosisededepto_id' => $newMesescontdosisedeptos->id_mescontdosisededepto
            ]);
        }
        
        if($request->periodoVacio2 == 'TRUE' || $request->checkDelete == 'TRUE'){
            $updatecontratoDosisedepto = Contratodosimetriasededepto::where('id_contdosisededepto', $request->contdosisededepto)
            ->update([
                'mes_actual'               => $request->mes_asig_siguiente + 1,
                'dosi_control_torax'       => $dosi_control_torax == null ? 0 : $dosi_control_torax,
                'dosi_control_cristalino'  => $dosi_control_cristalino == null ? 0 : $dosi_control_cristalino,
                'dosi_control_dedo'        => $dosi_control_dedo == null ? 0 : $dosi_control_dedo,
                'dosi_torax'               => $dosi_torax == null ? 0 : $dosi_torax,
                'dosi_area'                => $dosi_area == null ? 0 : $dosi_area,
                'dosi_caso'                => $dosi_caso == null ? 0 : $dosi_caso,
                'dosi_cristalino'          => $dosi_cristalino == null ? 0 : $dosi_cristalino,
                'dosi_dedo'                => $dosi_dedo == null ? 0 : $dosi_dedo,
                'controlTransT_unicoCont'  => $request->controlTransT_unicoCont2,
                'controlTransC_unicoCont'  => $request->controlTransC_unicoCont2,
                'controlTransA_unicoCont'  => $request->controlTransA_unicoCont2,
            ]);
            
        }else{
            $updatecontratoDosisedepto = Contratodosimetriasededepto::where('id_contdosisededepto', $request->contdosisededepto)
            ->update([
                'mes_actual'               => $request->mes_asig_siguiente,
                'dosi_control_torax'       => $dosi_control_torax == null ? 0 : $dosi_control_torax,
                'dosi_control_cristalino'  => $dosi_control_cristalino == null ? 0 : $dosi_control_cristalino,
                'dosi_control_dedo'        => $dosi_control_dedo == null ? 0 : $dosi_control_dedo,
                'dosi_torax'               => $dosi_torax == null ? 0 : $dosi_torax,
                'dosi_area'                => $dosi_area == null ? 0 : $dosi_area,
                'dosi_caso'                => $dosi_caso == null ? 0 : $dosi_caso,
                'dosi_cristalino'          => $dosi_cristalino == null ? 0 : $dosi_cristalino,
                'dosi_dedo'                => $dosi_dedo == null ? 0 : $dosi_dedo,
                'controlTransT_unicoCont'  => $request->controlTransT_unicoCont2,
                'controlTransC_unicoCont'  => $request->controlTransC_unicoCont2,
                'controlTransA_unicoCont'  => $request->controlTransA_unicoCont2,
            ]);

        }
        $ControlesUnicoContrato = Contratodosimetriasededepto::join('contratodosimetriasedes', 'contratodosimetriasede_id', '=', 'id_contratodosimetriasede')
        ->where('contratodosimetria_id', '=', $request->id_contratodosimetria2)
        ->get();
        for($i= 0; $i<count($ControlesUnicoContrato); $i++){
            if($ControlesUnicoContrato[$i]->controlTransT_unicoCont != $request->controlTransT_unicoCont2){
                $updateControlUnicoContrato = Contratodosimetriasededepto::join('contratodosimetriasedes', 'contratodosimetriasede_id', '=', 'id_contratodosimetriasede')
                ->where('contratodosimetria_id', '=', $request->id_contratodosimetria2)
                ->update([
                    'contratodosimetriasededeptos.controlTransT_unicoCont'  => $request->controlTransT_unicoCont2,
                ]);
            }
            if($ControlesUnicoContrato[$i]->controlTransC_unicoCont != $request->controlTransC_unicoCont2){
                $updateControlUnicoContrato = Contratodosimetriasededepto::join('contratodosimetriasedes', 'contratodosimetriasede_id', '=', 'id_contratodosimetriasede')
                ->where('contratodosimetria_id', '=', $request->id_contratodosimetria2)
                ->update([
                    'contratodosimetriasededeptos.controlTransC_unicoCont'  => $request->controlTransC_unicoCont2,
                ]);
            }
            if($ControlesUnicoContrato[$i]->controlTransA_unicoCont != $request->controlTransA_unicoCont2){
                $updateControlUnicoContrato = Contratodosimetriasededepto::join('contratodosimetriasedes', 'contratodosimetriasede_id', '=', 'id_contratodosimetriasede')
                ->where('contratodosimetria_id', '=', $request->id_contratodosimetria2)
                ->update([
                    'contratodosimetriasededeptos.controlTransA_unicoCont'  => $request->controlTransA_unicoCont2,
                ]);
            }
        }
        
        return back()->with('guardar', 'ok');
        
    }
    public function savecambiotrabajadordosim(Request $request){
        /* return $request; */
        $num_dosi = [];
        $num_dosi_area = [];
        $newNovedadmesescontdosisededepto = Novedadmesescontdosisededepto::find($request->id_novedad);
        if(empty($newNovedadmesescontdosisededepto)){
            $newNovedad = new Novedadmesescontdosisededepto();
            $newNovedad->codigo_novedad           = $request->id_novedad;
            $newNovedad->contdosisededepto_id     = $request->id_contdosisededepto;
            $newNovedad->mes_asignacion           = $request->mestrabj;
            $newNovedad->save();
        }
        if(!empty($request->id_trabj_asigdosim_act)){
            for($i=0; $i<count($request->id_trabj_asigdosim_act); $i++){
                $trabjasignacion = Trabajadordosimetro::find($request->id_trabj_asigdosim_act[$i]);

                $trabjasignacion->persona_id = $request->id_trabj_asigdosim[$i];
                $trabjasignacion->revision_salida = NULL;
                $trabjasignacion->save();
                /* for($x=0; $x<count($request->inputnotas); $x++){
                    if($i==$x){
                        array_push($num_dosi, array('id'=> $trabjasignacion->id_trabajadordosimetro, 'nota'=> $request->inputnotas[$x]));
                    }
                } */
                $cambioNovedadDosimetria = new Cambiosnovedadmeses();

                $cambioNovedadDosimetria->novedadmesescontdosidepto_id = empty($newNovedadmesescontdosisededepto) ? $newNovedad->id_novedadmesescontdosi : $newNovedadmesescontdosisededepto->id_novedadmesescontdosi;
                $cambioNovedadDosimetria->trabajadordosimetro_id       = $trabjasignacion->id_trabajadordosimetro;
                $cambioNovedadDosimetria->tipo_novedad                 = $request->tipo_novedad;
                $cambioNovedadDosimetria->nota_cambiodosim             = $request->inputnotas[$i];
                $cambioNovedadDosimetria->save();
            }
            /* foreach ($num_dosi as $dosi) {
                $newNovedadmesescontdosisededepto = new Novedadmesescontdosisededepto();
                
                $newNovedadmesescontdosisededepto->trabajadordosimetro_id   = $dosi['id'];
                $newNovedadmesescontdosisededepto->contdosisededepto_id     = $request->id_contdosisededepto;
                $newNovedadmesescontdosisededepto->mes_asignacion           = $request->mestrabj;
                $newNovedadmesescontdosisededepto->tipo_novedad             = $request->tipo_novedad;
                $newNovedadmesescontdosisededepto->nota_cambiodosim         = mb_strtoupper($dosi['nota']);
                
                $newNovedadmesescontdosisededepto->save();
            } */
        }
       
        if(!empty($request->id_area_asigdosim_act)){
            for($i=0; $i<count($request->id_area_asigdosim_act); $i++){
                $dosiareasignacion = Dosiareacontdosisede::find($request->id_area_asigdosim_act[$i]);

                $dosiareasignacion->areadepartamentosede_id = $request->id_area_asigdosim[$i];
                $dosiareasignacion->revision_salida = NULL;
                $dosiareasignacion->save();
                /* for($x=0; $x<count($request->inputnotasAreas); $x++){
                    if($i==$x){
                        array_push($num_dosi_area, array('id'=> $dosiareasignacion->id_dosiareacontdosisedes, 'nota'=> $request->inputnotasAreas[$x]));
                    }
                } */
                $cambioNovedadDosimetria = new Cambiosnovedadmeses();

                $cambioNovedadDosimetria->novedadmesescontdosidepto_id = empty($newNovedadmesescontdosisededepto) ? $newNovedad->id_novedadmesescontdosi : $newNovedadmesescontdosisededepto->id_novedadmesescontdosi;
                $cambioNovedadDosimetria->dosiarea_id                  = $dosiareasignacion->id_dosiareacontdosisedes;
                $cambioNovedadDosimetria->tipo_novedad                 = $request->tipo_novedad;
                $cambioNovedadDosimetria->nota_cambiodosim             = $request->inputnotasAreas[$i];
                $cambioNovedadDosimetria->save();
            }
            /* foreach ($num_dosi_area as $dosiArea) {
                $newNovedadmesescontdosisededepto = new Novedadmesescontdosisededepto();
                    
                $newNovedadmesescontdosisededepto->dosiarea_id              = $dosiArea['id'];
                $newNovedadmesescontdosisededepto->contdosisededepto_id     = $request->id_contdosisededepto;
                $newNovedadmesescontdosisededepto->mes_asignacion           = $request->mestrabj;
                $newNovedadmesescontdosisededepto->tipo_novedad             = $request->tipo_novedad;
                $newNovedadmesescontdosisededepto->nota_cambiodosim         = mb_strtoupper($dosiArea['nota']);
                $newNovedadmesescontdosisededepto->save();
            } */
        }
        return back()->with('guardar', 'ok');
    }
    public function clearAsignacionAnteriorMn(Request $request){
        $contdosisededepto = Contratodosimetriasededepto::find($request->contdosisededepto_id);
        $dosiLimpios = [];
        if($contdosisededepto->controlTransT_unicoCont == 'TRUE' || $contdosisededepto->controlTransC_unicoCont == 'TRUE' || $contdosisededepto->controlTransA_unicoCont == 'TRUE'){
           
            $verificarDosiControlUnicT = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('ubicacion', 'TORAX')
            ->where('mes_asignacion', $request->mes)
            ->get();
            if($verificarDosiControlUnicT->isEmpty()){
                $cleardosicontrolTunicoasigmesant = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
                ->where('ubicacion', 'TORAX')
                ->where('mes_asignacion', ($request->mes)-1)
                ->where('controlTransT_unicoCont', 'TRUE')
                ->update([
                    'dosimetro_uso' => 'FALSE'
                ]);
                $cleardosicontrolTU = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
                ->where('ubicacion', 'TORAX')
                ->where('mes_asignacion', ($request->mes)-1)
                ->where('controlTransT_unicoCont', 'TRUE')
                ->get();
                for($i= 0; $i<count($cleardosicontrolTU); $i++){
                    array_push($dosiLimpios, array('controlTU'=> $cleardosicontrolTU[$i]->id_dosicontrolcontdosisedes, 'controlCU'=>'', 'controlAU'=>'', 'control'=>'' ,'trabajadorasig'=>'' ,'dosiareasig'=>''));
                }
            }
            $verificarDosiControlUnicC = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('ubicacion', 'CRISTALINO')
            ->where('mes_asignacion', $request->mes)
            ->get();
            if($verificarDosiControlUnicC->isEmpty()){
                $cleardosicontrolCunicoasigmesant = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
                ->where('ubicacion', 'CRISTALINO')
                ->where('mes_asignacion', ($request->mes)-1)
                ->where('controlTransC_unicoCont', 'TRUE')
                ->update([
                    'dosimetro_uso' => 'FALSE'
                ]);
                $cleardosicontrolCU = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
                ->where('ubicacion', 'CRISTALINO')
                ->where('mes_asignacion', ($request->mes)-1)
                ->where('controlTransC_unicoCont', 'TRUE')
                ->get();
                for($i= 0; $i<count($cleardosicontrolCU); $i++){
                    array_push($dosiLimpios, array('controlTU'=>'', 'controlCU'=> $cleardosicontrolCU[$i]->id_dosicontrolcontdosisedes, 'controlAU'=>'', 'control'=>'' ,'trabajadorasig'=>'' ,'dosiareasig'=>''));
                }
            }
            $verificarDosiControlUnicA = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('ubicacion', 'ANILLO')
            ->where('mes_asignacion', $request->mes)
            ->get();
            if($verificarDosiControlUnicA->isEmpty()){
                $cleardosicontrolAunicoasigmesant = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
                ->where('ubicacion', 'ANILLO')
                ->where('mes_asignacion', ($request->mes)-1)
                ->where('controlTransA_unicoCont', 'TRUE')
                ->update([
                    'dosimetro_uso' => 'FALSE'
                ]);
                $cleardosicontrolAU = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
                ->where('ubicacion', 'ANILLO')
                ->where('mes_asignacion', ($request->mes)-1)
                ->where('controlTransA_unicoCont', 'TRUE')
                ->get();
                for($i= 0; $i<count($cleardosicontrolAU); $i++){
                    array_push($dosiLimpios, array('controlTU'=>'', 'controlCU'=>'', 'controlAU'=> $cleardosicontrolAU[$i]->id_dosicontrolcontdosisedes, 'control'=>'' ,'trabajadorasig'=>'' ,'dosiareasig'=>''));
                }
            }
        }else{
            $cleardosicontrolasigmesant = Dosicontrolcontdosisede::where('contdosisededepto_id', $request->contdosisededepto_id)
            ->where('contratodosimetriasede_id', $request->contratodosimetriasede_id)
            ->where('mes_asignacion',($request->mes)-1)
            ->update([
                'dosimetro_uso' => 'FALSE'
            ]);
            $cleardosicontrol= Dosicontrolcontdosisede::where('contdosisededepto_id', $request->contdosisededepto_id)
            ->where('contratodosimetriasede_id', $request->contratodosimetriasede_id)
            ->where('mes_asignacion',($request->mes)-1)
            ->get();
            for($i= 0; $i<count($cleardosicontrol); $i++){
                array_push($dosiLimpios, array('controlTU'=>'', 'controlCU'=>'', 'controlAU'=>'', 'control'=> $cleardosicontrol[$i]->id_dosicontrolcontdosisedes, 'trabajadorasig'=>'', 'dosiareasig'=>''));
            }
        }
        $cleardositrabajasigmesant = Trabajadordosimetro::where('contdosisededepto_id', $request->contdosisededepto_id)
        ->where('contratodosimetriasede_id', $request->contratodosimetriasede_id)
        ->where('mes_asignacion',($request->mes)-1)
        ->update([
            'dosimetro_uso' => 'FALSE'
        ]);
        $cleardositrabajasig = Trabajadordosimetro::where('contdosisededepto_id', $request->contdosisededepto_id)
        ->where('contratodosimetriasede_id', $request->contratodosimetriasede_id)
        ->where('mes_asignacion',($request->mes)-1)
        ->get();
        for($i= 0; $i<count($cleardositrabajasig); $i++){
            array_push($dosiLimpios, array('controlTU'=>'', 'controlCU'=>'', 'controlAU'=>'', 'control'=>'', 'trabajadorasig'=> $cleardositrabajasig[$i]->id_trabajadordosimetro, 'dosiareasig'=>''));
        }
        $cleardosiareasigmesant = Dosiareacontdosisede::where('contdosisededepto_id', $request->contdosisededepto_id)
        ->where('contratodosimetriasede_id', $request->contratodosimetriasede_id)
        ->where('mes_asignacion',($request->mes)-1)
        ->update([
            'dosimetro_uso' => 'FALSE'
        ]);
        $cleardosiareasig = Dosiareacontdosisede::where('contdosisededepto_id', $request->contdosisededepto_id)
        ->where('contratodosimetriasede_id', $request->contratodosimetriasede_id)
        ->where('mes_asignacion',($request->mes)-1)
        ->get();
        for($i= 0; $i<count($cleardosiareasig); $i++){
            array_push($dosiLimpios, array('controlTU'=>'', 'controlCU'=>'', 'controlAU'=>'', 'control'=>'', 'trabajadorasig'=>'', 'dosiareasig'=> $cleardosiareasig[$i]->id_dosiareacontdosisedes));
        }
        
        /*$dosiasginadosmesactual = Trabajadordosimetro::join('personas', 'trabajadordosimetros.persona_id', '=', 'personas.id_persona')
        ->join('dosimetros', 'trabajadordosimetros.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->leftjoin('holders', 'trabajadordosimetros.holder_id', '=', 'holders.id_holder')
        ->where('contratodosimetriasede_id', '=', $request->contratodosimetriasede_id)
        ->where('contdosisededepto_id', '=', $request->contdosisededepto_id)
        ->where('mes_asignacion', '=', ($request->mes)-1)
        ->get();*/
        return response()->json($dosiLimpios);
    }

    public function reportePDFcambiodosim($deptodosi, $mesnumber){
        
        $dosicontrolasig = Dosicontrolcontdosisede::where('contdosisededepto_id', '=', $deptodosi)
        ->where('mes_asignacion', '=', $mesnumber)
        ->get();
        $trabjasignados = Trabajadordosimetro::where('contdosisededepto_id', '=', $deptodosi)
        ->where('mes_asignacion', '=', $mesnumber)
        ->get();
        $contdosisededepto = Contratodosimetriasededepto::find($deptodosi);

        $pdf =  PDF::loadView('novedades.reportePDF_novedad_cambiodosim', compact('deptodosi', 'mesnumber', 'dosicontrolasig', 'trabjasignados', 'contdosisededepto'));
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->stream();
    }



    //////////// NOVEDADES DE DOSIMETRIA (NUEVAS 05/12/22) //////////////

    ///////////////////////////////////// NUEVO MODULO DE NOVEDADES CON HISTORIAL Y OTRA INTERFAZ//////////////////////////
    public function search(){
        $empresasDosi = ContratosDosimetriaEmpresa::all();
        return view('novedades.search_novedades',compact('empresasDosi'));
    }
    public function contratosDosim(Request $request){
        $contratosDosi = Dosimetriacontrato::where('empresa_id', '=', $request->empresa_id)->get();
        return response()->json($contratosDosi);
    }
    public function sedesEspcontDosim(Request $request){
        $sedesEspDosi = Contratodosimetriasededepto::join('contratodosimetriasedes', 'contratodosimetriasededeptos.contratodosimetriasede_id', '=', 'contratodosimetriasedes.id_contratodosimetriasede')
        ->join('dosimetriacontratos', 'contratodosimetriasedes.contratodosimetria_id', '=', 'dosimetriacontratos.id_contratodosimetria')
        ->join('departamentosedes', 'contratodosimetriasededeptos.departamentosede_id', '=', 'departamentosedes.id_departamentosede')
        ->join('departamentos', 'departamentosedes.departamento_id', '=', 'departamentos.id_departamento')
        ->join('sedes', 'contratodosimetriasedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('contratodosimetria_id', '=', $request->contrato_id)
        ->get();
        return response()->json($sedesEspDosi);
    }
    public function novedadesContDosim(Request $request){
        $novedadesCont = Novedadmesescontdosisededepto::where('contdosisededepto_id', '=', $request->contdosisededepto_id)
        ->get();
        
        return response()->json($novedadesCont);
    }
    public function cambiosnovedadesContDosim(Request $request){
        $cambiosnovedadesCont = Cambiosnovedadmeses::where('novedadmesescontdosidepto_id', '=', $request->novedad)
        ->get();
        
        return response()->json($cambiosnovedadesCont);
    }
    public function create(){
        $empresasDosi = ContratosDosimetriaEmpresa::all();
        $dosimetrosDisponibles = Dosimetro::where('estado_dosimetro', '=', 'STOCK')
        ->where('tipo_dosimetro', '=', 'GENERAL')
        ->get();
        $dosimetrosDisponiblesEzclip = Dosimetro::where('estado_dosimetro', '=', 'STOCK')
        ->where('tipo_dosimetro', '=', 'EZCLIP')
        ->get();
        $holdersDisponibles = Holder::where('estado_holder', '=', 'STOCK')
        ->get();
        return view('novedades.crear_novedad',compact('empresasDosi', 'dosimetrosDisponibles', 'dosimetrosDisponiblesEzclip', 'holdersDisponibles'));
    }


}
