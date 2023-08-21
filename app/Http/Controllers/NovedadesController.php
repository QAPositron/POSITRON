<?php

namespace App\Http\Controllers;

use App\Models\Areadepartamentosede;
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
    public function detalleNovedad($nota, $deptodosi){
        $contdosisededepto = Contratodosimetriasededepto::find($deptodosi);
        $novedad = Novedadmesescontdosisededepto::where('nota_cambiodosim', '=', $nota)
        ->get();
        
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
            ->leftjoin('holders', 'dosicontrolcontdosisedes.holder_id', '=', 'holders.id_holder')
            ->where('contratodosimetria_id', '=', $request->contratodosimetria_id)
            ->where('mes_asignacion', '=', $request->mes)
            ->get();
            return response()->json($dosiasignadoscontrolmesactual);
        }
        
        $dosiasignadoscontrolmesactual = Dosicontrolcontdosisede::join('dosimetros', 'dosicontrolcontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->leftjoin('holders', 'dosicontrolcontdosisedes.holder_id', '=', 'holders.id_holder')
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
            for($i=0; $i<count($request->id_trabajador_asig); $i++){
                
                if($request->id_ubicacion_asig[$i] == 'CONTROL TORAX'){
    
                    $newasignacionDosimetroControl = new Dosicontrolcontdosisede();
    
                    $newasignacionDosimetroControl->dosimetro_id              = $request->id_dosimetro_asig[$i];
                    $newasignacionDosimetroControl->contratodosimetriasede_id = $request->id_contratodosimetriasede;
                    $newasignacionDosimetroControl->contdosisededepto_id      = $request->id_contdosisededepto;
                    $newasignacionDosimetroControl->mes_asignacion            = $request->mestrabj_asig;
                    $newasignacionDosimetroControl->dosimetro_uso             = 'TRUE';
                    $newasignacionDosimetroControl->primer_dia_uso            = $request->primerDia_asigdosim;
                    $newasignacionDosimetroControl->ultimo_dia_uso            = $request->ultimoDia_asigdosim;
                    $newasignacionDosimetroControl->fecha_dosim_enviado       = $request->fecha_dosim_enviado;
                    $newasignacionDosimetroControl->energia                   = 'F';
                    $newasignacionDosimetroControl->save();
        
                    $updateDosimetros = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asig[$i])
                    ->update([
                        'estado_dosimetro' => 'EN USO',
                        'uso_dosimetro' => 'CONTROL'
                    ]);
                    $updateHolder = Holder::where('id_holder', '=', $request->id_holder_asig[$i])
                    ->update([
                        'estado_holder' => 'EN USO'
                    ]);
                    $updateEstadoDosimControlmesig = Dosicontrolcontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                        ->where('contdosisededepto_id', $request->id_contdosisededepto)
                        ->where('mes_asignacion', ($request->mestrabj_asig)-1)
                        ->update([
                            'estado_dosimetro' => 'EN LECTURA',
                    ]); 
                    $dosi_control_torax += 1;
                    for($x=0; $x<count($request->inputnotas); $x++){
                        if($i==$x){
                            array_push($num_dosi_control, array('id'=> $newasignacionDosimetroControl->id_dosicontrolcontdosisedes, 'nota'=> $request->inputnotas[$x]));
                        }
                    }
                }else{
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
                    for($x=0; $x<count($request->inputnotas); $x++){
                        if($i==$x){
                            array_push($num_dosi, array('id'=> $newasignacionDosimetro->id_trabajadordosimetro, 'nota'=> $request->inputnotas[$x]));
                        }
                    }
                    /* array_push($num_dosi, $newasignacionDosimetro->id_trabajadordosimetro); */
                    
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
                    for($x=0; $x<count($request->inputnotasAreas); $x++){
                        if($i==$x){
                            array_push($num_dosi_area, array('id'=> $newasignacionDosimetroArea->id_dosiareacontdosisedes, 'nota'=> $request->inputnotasAreas[$x]));
                        }
                    }
                }
            }
            $newMesescontdosisedeptos = new Mesescontdosisedeptos();
            $newMesescontdosisedeptos->contdosisededepto_id     = $request->id_contdosisededepto;
            $newMesescontdosisedeptos->mes_asignacion           = $request->mestrabj_asig;
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

            foreach ($num_dosi_control as $dosicontrol) {
                $newNovedadmesescontdosisededepto = new Novedadmesescontdosisededepto();
                
                $newNovedadmesescontdosisededepto->mescontdosisededepto_id  = $newMesescontdosisedeptos->id_mescontdosisededepto;
                $newNovedadmesescontdosisededepto->dosicontrol_id           = $dosicontrol['id'];
                $newNovedadmesescontdosisededepto->contdosisededepto_id     = $request->id_contdosisededepto;
                $newNovedadmesescontdosisededepto->mes_asignacion           = $request->mestrabj_asig;
                $newNovedadmesescontdosisededepto->tipo_novedad             = $request->tipo_novedad;
                $newNovedadmesescontdosisededepto->nota_cambiodosim         = mb_strtoupper($dosicontrol['nota']);
                
                $newNovedadmesescontdosisededepto->save();
            }
            
            foreach ($num_dosi as $dosi) {
                $newNovedadmesescontdosisededepto = new Novedadmesescontdosisededepto();
                
                $newNovedadmesescontdosisededepto->mescontdosisededepto_id  = $newMesescontdosisedeptos->id_mescontdosisededepto;
                $newNovedadmesescontdosisededepto->trabajadordosimetro_id   = $dosi['id'];
                $newNovedadmesescontdosisededepto->contdosisededepto_id     = $request->id_contdosisededepto;
                $newNovedadmesescontdosisededepto->mes_asignacion           = $request->mestrabj_asig;
                $newNovedadmesescontdosisededepto->tipo_novedad             = $request->tipo_novedad;
                $newNovedadmesescontdosisededepto->nota_cambiodosim     = mb_strtoupper($dosi['nota']);
            
                $newNovedadmesescontdosisededepto->save();
            }
    
            foreach ($num_dosi_area as $dosiarea) {
                $newNovedadmesescontdosisededepto = new Novedadmesescontdosisededepto();
                
                $newNovedadmesescontdosisededepto->mescontdosisededepto_id  = $newMesescontdosisedeptos->id_mescontdosisededepto;
                $newNovedadmesescontdosisededepto->dosiarea_id              = $dosiarea['id'];
                $newNovedadmesescontdosisededepto->contdosisededepto_id     = $request->id_contdosisededepto;
                $newNovedadmesescontdosisededepto->mes_asignacion           = $request->mestrabj_asig;
                $newNovedadmesescontdosisededepto->tipo_novedad             = $request->tipo_novedad;
                $newNovedadmesescontdosisededepto->nota_cambiodosim         = mb_strtoupper($dosiarea['nota']);
                
                $newNovedadmesescontdosisededepto->save();
            }

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
        }else{
            $newNovcontdosisededepto = new Novcontdosisededepto();
            
            $newNovcontdosisededepto->contdosisededepto_id          = $request->id_contdosisededepto;
            $newNovcontdosisededepto->contratodosimetriasede_id     = $request->id_contratodosimetriasede;
            $newNovcontdosisededepto->departamentosede_id           = $request->id_departamentosede;
            $newNovcontdosisededepto->mes_asignacion                = $request->mestrabj_asig;
            $newNovcontdosisededepto->estado_nov                    = 'ACTIVO';
            
            $newNovcontdosisededepto->save();
            
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
                for($x=0; $x<count($request->inputnotasControl); $x++){
                    if($i==$x){
                        array_push($num_dosi_control, array('id'=> $newasignacionDosimetroControl->id_dosicontrolcontdosisedes, 'nota'=> $request->inputnotasControl[$x]));
                    }
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
                    for($x=0; $x<count($request->inputnotasAreas); $x++){
                        if($i==$x){
                            array_push($num_dosi_area, array('id'=> $newasignacionDosimetroArea->id_dosiareacontdosisedes, 'nota'=> $request->inputnotasAreas[$x]));
                        }
                    }
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
                    for($x=0; $x<count($request->inputnotas); $x++){
                        if($i==$x){
                            array_push($num_dosi, array('id'=> $newasignacionDosimetro->id_trabajadordosimetro, 'nota'=> $request->inputnotas[$x]));
                        }
                    }
                }
            }
            $newMesescontdosisedeptos = new Mesescontdosisedeptos();
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

            foreach ($num_dosi_control as $dosicontrol) {
                $newNovedadmesescontdosisededepto = new Novedadmesescontdosisededepto();
                
                $newNovedadmesescontdosisededepto->mescontdosisededepto_id  = $newMesescontdosisedeptos->id_mescontdosisededepto;
                $newNovedadmesescontdosisededepto->dosicontrol_id           = $dosicontrol['id'];
                $newNovedadmesescontdosisededepto->novcontdosisededepto_id  = $newNovcontdosisededepto->id_novcontdosisededepto;
                $newNovedadmesescontdosisededepto->mes_asignacion           = $request->mestrabj_asig;
                $newNovedadmesescontdosisededepto->tipo_novedad             = $request->tipo_novedad;
                $newNovedadmesescontdosisededepto->nota_cambiodosim         = mb_strtoupper($dosicontrol['nota']);
                
                $newNovedadmesescontdosisededepto->save();
            }
            
            foreach ($num_dosi as $dosi) {
                $newNovedadmesescontdosisededepto = new Novedadmesescontdosisededepto();
                
                $newNovedadmesescontdosisededepto->mescontdosisededepto_id  = $newMesescontdosisedeptos->id_mescontdosisededepto;
                $newNovedadmesescontdosisededepto->trabajadordosimetro_id   = $dosi['id'];
                $newNovedadmesescontdosisededepto->novcontdosisededepto_id  = $newNovcontdosisededepto->id_novcontdosisededepto;
                $newNovedadmesescontdosisededepto->mes_asignacion           = $request->mestrabj_asig;
                $newNovedadmesescontdosisededepto->tipo_novedad             = $request->tipo_novedad;
                $newNovedadmesescontdosisededepto->nota_cambiodosim         = mb_strtoupper($dosi['nota']);
            
                $newNovedadmesescontdosisededepto->save();
            }
    
            foreach ($num_dosi_area as $dosiarea) {
                $newNovedadmesescontdosisededepto = new Novedadmesescontdosisededepto();
                
                $newNovedadmesescontdosisededepto->mescontdosisededepto_id  = $newMesescontdosisedeptos->id_mescontdosisededepto;
                $newNovedadmesescontdosisededepto->dosiarea_id              = $dosiarea['id'];
                $newNovedadmesescontdosisededepto->novcontdosisededepto_id  = $newNovcontdosisededepto->id_novcontdosisededepto;
                $newNovedadmesescontdosisededepto->mes_asignacion           = $request->mestrabj_asig;
                $newNovedadmesescontdosisededepto->tipo_novedad             = $request->tipo_novedad;
                $newNovedadmesescontdosisededepto->nota_cambiodosim         = mb_strtoupper($dosiarea['nota']);
                
                $newNovedadmesescontdosisededepto->save();
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
        
        $dosi_control = 0;
        $dosi_torax= 0;
        $dosi_area = 0; /////////FALTA TODO LO RELACIONADO CON DOSIMETROS TIPO CASO Y AREA
        $dosi_caso = 0;
        $dosi_cristalino = 0;
        $dosi_muñeca = 0;
        $dosi_dedo = 0;

        $newasignacionAntiguaControl = new Dosicontrolcontdosisede();
        $newasignacionAntiguaNull = new Trabajadordosimetro();

        $num_dosi_control = [];
        $num_dosi = [];
        ////GUARDAR SI HAY UN CONTROL EN UNA ASIGNACION ANTIGUA///////
        if(!empty($request->id_dosimetro_asigdosimControl)){
            
            for($i=0; $i<count($request->id_dosimetro_asigdosimControl); $i++){


                $newasignacionAntiguaControl->dosimetro_id              = $request->id_dosimetro_asigdosimControl[$i] == 'null' ? NULL : $request->id_dosimetro_asigdosimControl[$i];
                $newasignacionAntiguaControl->contratodosimetriasede_id = $request->contratodosimetriasede;
                $newasignacionAntiguaControl->contdosisededepto_id      = $request->contdosisededepto;
                $newasignacionAntiguaControl->mes_asignacion            = $request->mes_asig_siguiente;
                $newasignacionAntiguaControl->dosimetro_uso             = 'TRUE';
                $newasignacionAntiguaControl->primer_dia_uso            = $request->primerDia_asigdosim2;
                $newasignacionAntiguaControl->ultimo_dia_uso            = $request->ultimoDia_asigdosim2;
                $newasignacionAntiguaControl->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado;
                $newasignacionAntiguaControl->ocupacion                 = $request->ocupacion_asigdosimControl[$i] == 'null' ? NULL : $request->ocupacion_asigdosimControl[$i];
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
    
                $newasignacionAntiguaNull->contratodosimetriasede_id = $request->contratodosimetriasede;
                $newasignacionAntiguaNull->persona_id                = $request->id_trabj_asigdosim_null[$i];
                $newasignacionAntiguaNull->dosimetro_id              = $request->id_dosimetro_asigdosim_null[$i] == 'null' ? NULL : $request->id_dosimetro_asigdosim_null[$i];
                $newasignacionAntiguaNull->holder_id                 = null;
                $newasignacionAntiguaNull->contdosisededepto_id      = $request->contdosisededepto;
                $newasignacionAntiguaNull->mes_asignacion            = $request->mes_asig_siguiente;
                $newasignacionAntiguaNull->dosimetro_uso             = 'TRUE';
                $newasignacionAntiguaNull->primer_dia_uso            = $request->primerDia_asigdosim2;
                $newasignacionAntiguaNull->ultimo_dia_uso            = $request->ultimoDia_asigdosim2;
                $newasignacionAntiguaNull->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado;
                $newasignacionAntiguaNull->ocupacion                 = $request->id_ocupacion_asigdosim_null[$i] == 'null' ? NULL : $request->id_ocupacion_asigdosim_null[$i];
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
                $newasignacionAntigua->dosimetro_id              = $request->id_dosimetro_asigdosim[$i] == 'null' ? NULL : $request->id_dosimetro_asigdosim[$i];
                $newasignacionAntigua->holder_id                 = $request->id_holder_asigdosim[$i] == 'null' ? NULL : $request->id_holder_asigdosim[$i];
                $newasignacionAntigua->contdosisededepto_id      = $request->contdosisededepto;
                $newasignacionAntigua->mes_asignacion            = $request->mes_asig_siguiente;
                $newasignacionAntigua->dosimetro_uso             = 'TRUE';
                $newasignacionAntigua->primer_dia_uso            = $request->primerDia_asigdosim2;
                $newasignacionAntigua->ultimo_dia_uso            = $request->ultimoDia_asigdosim2;
                $newasignacionAntigua->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado;
                $newasignacionAntigua->ocupacion                 = $request->id_ocupacion_asigdosim[$i] == 'null' ? NULL : $request->id_ocupacion_asigdosim[$i];
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
                if($request->ubicacion_asigdosim[$i] == 'ANILLO'){
                    $dosi_dedo += 1 ;
                }
                if($request->ubicacion_asigdosim[$i] == 'CRISTALINO'){
                    $dosi_cristalino += 1 ;
                }
            }  
        }
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
                    for($x=0; $x<count($request->inputnotas); $x++){
                        if($i==$x){
                            array_push($num_dosi_control, array('id'=> $newasignacionDosimetroControl->id_dosicontrolcontdosisedes, 'nota'=> $request->inputnotas[$x]));
                        }
                    }
                    /* array_push($num_dosi_control, $newasignacionDosimetroControl->id_dosicontrolcontdosisedes); */
                }else{
    
                    $newasignacion = new Trabajadordosimetro();
            
                    $newasignacion->contratodosimetriasede_id    = $request->contratodosimetriasede;
                    $newasignacion->persona_id                   = $request->id_trabajador_asig[$i];
                    $newasignacion->dosimetro_id                 = $request->id_dosimetro_asig[$i] == 'null' ? NULL : $request->id_dosimetro_asig[$i];
                    $newasignacion->holder_id                    = $request->id_holder_asig[$i] == 'null' ? NULL : $request->id_holder_asig[$i];
                    $newasignacion->contdosisededepto_id         = $request->contdosisededepto;
                    $newasignacion->mes_asignacion               = $request->mes_asig_siguiente;
                    $newasignacion->dosimetro_uso                = 'TRUE';
                    $newasignacion->primer_dia_uso               = $request->primerDia_asigdosim2;
                    $newasignacion->ultimo_dia_uso               = $request->ultimoDia_asigdosim2;
                    $newasignacion->fecha_dosim_enviado          = $request->fecha_envio_dosim_asignado;
                    $newasignacion->ocupacion                    = $request->ocupacion_asig[$i] == 'null' ? NULL : $request->ocupacion_asig[$i];
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
                    if($request->id_ubicacion_asig[$i] == 'ANILLO'){
                        $dosi_dedo += 1 ;
                    }
                    if($request->id_ubicacion_asig[$i] == 'CRISTALINO'){
                        $dosi_cristalino += 1 ;
                    }
                    if($request->id_ubicacion_asig[$i] == 'TORAX'){
                        $dosi_torax += 1 ;
                    }
                    for($x=0; $x<count($request->inputnotas); $x++){
                        if($i==$x){
                            array_push($num_dosi, array('id'=> $newasignacion->id_trabajadordosimetro, 'nota'=> $request->inputnotas[$x]));
                        }
                    }
                    /* array_push($num_dosi, $newasignacion->id_trabajadordosimetro); */
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
        
        $newMesescontdosisedeptos->save();

        if(!empty($num_dosi_control)){
         
            foreach ($num_dosi_control as $dosicontrol) {
                $newNovedadmesescontdosisededepto = new Novedadmesescontdosisededepto();
                
                $newNovedadmesescontdosisededepto->mescontdosisededepto_id  = $newMesescontdosisedeptos->id_mescontdosisededepto;
                $newNovedadmesescontdosisededepto->dosicontrol_id           = $dosicontrol['id'];
                $newNovedadmesescontdosisededepto->contdosisededepto_id     = $request->contdosisededepto;
                $newNovedadmesescontdosisededepto->mes_asignacion           = $request->mes_asig_siguiente;
                $newNovedadmesescontdosisededepto->tipo_novedad             = $request->tipo_novedad;
                $newNovedadmesescontdosisededepto->nota_cambiodosim         = mb_strtoupper($dosicontrol['nota']);
                
                $newNovedadmesescontdosisededepto->save();
            }
        }elseif(!empty($num_dosi)){
            foreach ($num_dosi as $dosi) {
                $newNovedadmesescontdosisededepto = new Novedadmesescontdosisededepto();
                
                $newNovedadmesescontdosisededepto->mescontdosisededepto_id  = $newMesescontdosisedeptos->id_mescontdosisededepto;
                $newNovedadmesescontdosisededepto->trabajadordosimetro_id   = $dosi['id'];
                $newNovedadmesescontdosisededepto->contdosisededepto_id     = $request->contdosisededepto;
                $newNovedadmesescontdosisededepto->mes_asignacion           = $request->mes_asig_siguiente;
                $newNovedadmesescontdosisededepto->tipo_novedad             = $request->tipo_novedad;
                $newNovedadmesescontdosisededepto->nota_cambiodosim         = mb_strtoupper($dosi['nota']);
            
                
                $newNovedadmesescontdosisededepto->save();
            }
        }else{

            for($x=0; $x<count($request->inputnotas); $x++){
                $newNovedadmesescontdosisededepto = new Novedadmesescontdosisededepto();
                    
                $newNovedadmesescontdosisededepto->mescontdosisededepto_id  = $newMesescontdosisedeptos->id_mescontdosisededepto;
                $newNovedadmesescontdosisededepto->contdosisededepto_id     = $request->contdosisededepto;
                $newNovedadmesescontdosisededepto->mes_asignacion           = $request->mes_asig_siguiente;
                $newNovedadmesescontdosisededepto->tipo_novedad             = $request->tipo_novedad;
                $newNovedadmesescontdosisededepto->nota_cambiodosim         = mb_strtoupper($request->inputnotas[$x]);
                $newNovedadmesescontdosisededepto->save();
            }
        }
        
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
        $novedadesCont = Contratodosimetriasede::join('contratodosimetriasededeptos','contratodosimetriasedes.id_contratodosimetriasede', '=', 'contratodosimetriasededeptos.contratodosimetriasede_id')
        ->join('novedadmesescontdosisededeptos', 'contratodosimetriasededeptos.id_contdosisededepto', '=', 'novedadmesescontdosisededeptos.contdosisededepto_id' )
        ->where('contratodosimetria_id', '=', $request->contrato_id)
        ->get();
        return response()->json($novedadesCont);
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
