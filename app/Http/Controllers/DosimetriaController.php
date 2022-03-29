<?php

namespace App\Http\Controllers;

use App\Models\ContratoDosimetria;

use App\Models\Contratodosimetriasede;
use App\Models\Contratodosimetriasededepto;
use App\Models\ContratosDosimetriaEmpresa;
use App\Models\Departamentosede;
use App\Models\Dosicontrolcontdosisede;
use App\Models\DosimControlcontdosiSede;
use App\Models\Dosimetriacontrato;
use App\Models\Dosimetro;
use App\Models\Empresa;
use App\Models\Holder;
use App\Models\Sede;
use App\Models\Trabajador;
use App\Models\Trabajadordosimetro;
use App\Models\Trabajadorsede;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Adapter\PDFLib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
/* use PDF; */
use Barryvdh\DomPDF\Facade as PDF;
use Exception;
use Illuminate\Support\Facades\DB;

class DosimetriaController extends Controller
{
    /* public function index(){
        $empresa = ContratosDosimetriaEmpresa::all();
        return view('dosimetria.empresas_dosimetria', compact('empresa'));
    } */
    public function createEmpresa(){
        $empresas = Empresa::all();
        $empresaDosi = ContratosDosimetriaEmpresa::all();
        return view('dosimetria.crear_empresas_dosimetria', compact('empresas', 'empresaDosi'));
    }
    /* public function saveEmpresa(Request $request){

         $request->validate([
            'id_empresa'      => 'required',
        ]);
        $empresaDosi = new ContratosDosimetriaEmpresa();

        $empresaDosi->empresa_id                   = $request->id_empresa;
        $empresaDosi->numtotal_dosi_cuerpo_entero  = 0;
        $empresaDosi->numtotal_dosi_control        = 0;
        $empresaDosi->numtotal_dosi_ambiental      = 0;
        $empresaDosi->numtotal_dosi_ezclip         = 0;

        $empresaDosi->save();
        return redirect()->route('empresasdosi.create'); 
    } */

    public function createlistContrato($id){
        $empresa = Empresa::find($id);
        $dosimetriacontrato = Dosimetriacontrato::where('dosimetriacontratos.empresa_id', $id)
        ->get();
        /* SELECT * FROM `departamentosedes` INNER JOIN sedes on departamentosedes.sede_id = sedes.id_sede INNER 
        JOIN empresas ON sedes.empresas_id = empresas.id_empresa WHERE empresas.id_empresa = 1; */
        $sedes = Sede::leftJoin('contratodosimetriasedes', 'sedes.id_sede', '=', 'contratodosimetriasedes.sede_id')
        ->where('sedes.empresas_id', $id)
        ->whereNull('contratodosimetriasedes.sede_id')
        ->get();
        $departamentos = Departamentosede::join('sedes', 'departamentosedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('empresas.id_empresa', $id)
        ->get();
        return view('dosimetria.crear_listar_contratos_dosimetria', compact('empresa', 'dosimetriacontrato', 'sedes','departamentos'));
        /* return $sedes; */
    }

    
    public function selectdepa(Request $request){
        $departamentos = DB::table('departamentosedes')
            ->where('sede_id', $request->sede_id)
            ->select("*")
            ->get();
        echo "$departamentos";
    }

    public function saveContratodosi(Request $request){
        /* return $request; */

        $request->validate([
            'codigo_contrato'               => 'required',
            'fecha_inicio_contrato'         => 'required',
            'periodo_recambio_contrato'     => 'required',


        ]);
        $contratoDosi = new Dosimetriacontrato();

        $contratoDosi->codigo_contrato              = $request->codigo_contrato;
        $contratoDosi->empresa_id                   = $request->empresa_contrato;
        $contratoDosi->fecha_inicio                 = $request->fecha_inicio_contrato;
        $contratoDosi->fecha_finalizacion           = $request->fecha_finalizacion_contrato;
        $contratoDosi->periodo_recambio             = $request->periodo_recambio_contrato;

        $contratoDosi->save();

        for($i=1; $i<20; $i++){
            if($request->input('id_sede'.$i) != null){

                $contratoDosiSede = new Contratodosimetriasede();
                $contratoDosiSede->contratodosimetria_id = $contratoDosi->id_contratodosimetria;
                $contratoDosiSede->sede_id = $request->input('id_sede'.$i)[0];
                $contratoDosiSede->save();




                $longitudepto = count($request->input('departamentos_sede'.$i));
                //return $longitudepto ;
                for($x=0; $x<$longitudepto; $x++){
                    $contratoDosiSedeDepto = new Contratodosimetriasededepto();
                    $contratoDosiSedeDepto->contratodosimetriasede_id = $contratoDosiSede->id_contratodosimetriasede;
                    $contratoDosiSedeDepto->departamentosede_id =  $request->input('departamentos_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_cuerpo_entero = $request->input('dosimetro_cuerpoEntero_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_control = $request->input('dosimetro_caso_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_ambiental = $request->input('dosimetro_ambiental_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_ezclip = $request->input('dosimetro_ezclip_sede'.$i)[$x];
                    $contratoDosiSedeDepto->save();
                }
            }else{
                break;
            }
        }
        return redirect()->route('detallecontrato.create', $contratoDosi->id_contratodosimetria);
    }

    public function  createTrabajadorSede(Request $request) {
        $request->validate([
            'idTrabajador'            => 'required',
            'id_sede_asigdosim'      => 'required',

        ]);

            $trabajadorNuevo = new Trabajadorsede();
            $trabajadorNuevo->trabajador_id = $request->idTrabajador;
            $trabajadorNuevo->sede_id = $request->id_sede_asigdosim;
            $trabajadorNuevo->save();
        return redirect()->route('asignadosicontrato.create',['asigdosicont' =>$request->contratoId, 'mesnumber'=> $request->mesnumber] );
    }

    public function createdetalleContrato($id){
        $dosimetriacontrato = Dosimetriacontrato::find($id);
        /* SELECT * FROM `dosimetriacontratos` INNER JOIN contratodosimetriasedes ON dosimetriacontratos.id_contratodosimetria = contratodosimetriasedes.contratodosimetria_id
         INNER JOIN empresas ON dosimetriacontratos.empresa_id = empresas.id_empresa
         INNER JOIN sedes ON contratodosimetriasedes.sede_id = sedes.id_sede
         INNER JOIN contratodosimetriasededeptos ON contratodosimetriasedes.id_contratodosimetriasede = contratodosimetriasededeptos.contratodosimetriasede_id
         INNER JOIN departamentosedes ON contratodosimetriasededeptos.departamentosede_id = departamentosedes.id_departamentosede;; */
        $dosimecontrasedeptos = Dosimetriacontrato::join('empresas', 'empresa_id', '=', 'id_empresa')
        ->join('contratodosimetriasedes', 'id_contratodosimetria', '=', 'contratodosimetria_id')
        ->join('sedes', 'sede_id', '=', 'id_sede')
        ->join('contratodosimetriasededeptos', 'id_contratodosimetriasede', '=', 'contratodosimetriasede_id')
        ->join('departamentosedes', 'departamentosede_id', '=', 'id_departamentosede')
        ->select('nombre_empresa', 'nombre_sede', 'codigo_contrato','fecha_inicio', 'fecha_finalizacion', 'periodo_recambio','nombre_departamento', 'dosi_cuerpo_entero', 'dosi_control', 'dosi_ambiental', 'dosi_ezclip', 'id_contdosisededepto')
        ->where('id_contratodosimetria', '=', $id)
        ->get();

        return view('dosimetria.detalle_contrato_dosimetria', compact('dosimetriacontrato', 'dosimecontrasedeptos'));
        /* return $dosimecontrasedeptos; */
    }

    public function createdetsedeContrato($id){
        $dosisededeptocontra = Contratodosimetriasededepto::find($id);
        /* $dosisededepacontra = Contratodosimetriasededepto::join('departamentosedes', 'departamentosede_id', '=', 'id_departamentosede')
        ->where('contratodosimetriasede_id', '=', $id)
        ->get(); */
        $trabjasigcontra = Trabajadordosimetro::where('contdosisededepto_id', '=', $id)
        ->get();
        $mes1Assign = Trabajadordosimetro::where('contdosisededepto_id', $id)
            ->where('mes_asignacion', 1)
            ->select("*")
            ->count();
        $mes2Assign = Trabajadordosimetro::where('contdosisededepto_id', $id)
            ->where('mes_asignacion', 2)
            ->select("*")
            ->count();
        $mes3Assign = Trabajadordosimetro::where('contdosisededepto_id', $id)
            ->where('mes_asignacion', 3)
            ->select("*")
            ->count();
        $mes4Assign = Trabajadordosimetro::where('contdosisededepto_id', $id)
            ->where('mes_asignacion', 4)
            ->select("*")
            ->count();
        $mes5Assign = Trabajadordosimetro::where('contdosisededepto_id', $id)
            ->where('mes_asignacion', 5)
            ->select("*")
            ->count();
        $mes6Assign = Trabajadordosimetro::where('contdosisededepto_id', $id)
            ->where('mes_asignacion', 6)
            ->select("*")
            ->count();
        $mes7Assign = Trabajadordosimetro::where('contdosisededepto_id', $id)
            ->where('mes_asignacion', 7)
            ->select("*")
            ->count();
        $mes8Assign = Trabajadordosimetro::where('contdosisededepto_id', $id)
            ->where('mes_asignacion', 8)
            ->select("*")
            ->count();
        $mes9Assign = Trabajadordosimetro::where('contdosisededepto_id', $id)
            ->where('mes_asignacion', 9)
            ->select("*")
            ->count();
        $mes10Assign = Trabajadordosimetro::where('contdosisededepto_id', $id)
            ->where('mes_asignacion', 10)
            ->select("*")
            ->count();
        $mes11Assign = Trabajadordosimetro::where('contdosisededepto_id', $id)
            ->where('mes_asignacion', 11)
            ->select("*")
            ->count();
        $mes12Assign = Trabajadordosimetro::where('contdosisededepto_id', $id)
            ->where('mes_asignacion', 12)
            ->select("*")
            ->count();
        $mesTotal = [
            $mes1Assign, $mes2Assign,
            $mes3Assign, $mes4Assign,
            $mes5Assign, $mes6Assign,
            $mes7Assign, $mes8Assign,
            $mes9Assign, $mes10Assign,
            $mes11Assign, $mes12Assign
        ];
        return view('dosimetria.detalle_sede_contrato_dosimetria', compact('dosisededeptocontra', 'trabjasigcontra',
        'mesTotal'));
        /* return $dosisededeptocontra; */
    }

    public function asignaDosiContrato($id, $mesnumber)
    {
        $contdosisededepto = Contratodosimetriasededepto::find($id);
        $dosimetrosControlAsignados = Dosicontrolcontdosisede::where('contratodosimetriasede_id', $id)
            ->where('dosimetro_uso', 'TRUE')
            ->where('mes_asignacion', $mesnumber)
            ->select("*")
        ->count();
        $dosimetrosControlAsignadosAnteriores = Dosicontrolcontdosisede::where('contdosisededepto_id', $id)
            ->where('mes_asignacion', ($mesnumber-1))
            ->where('dosimetro_uso', 'TRUE')
            ->select("*")
            ->select("*")
            ->get();
        $allWorks = DB::table('trabajadors')->get();
        $dosimetrosControl = Dosicontrolcontdosisede::where('mes_asignacion', $mesnumber)
            ->where('contratodosimetriasede_id', $id)
            ->select("*")
            ->get();
        $dosimetrosTrabajadores = Trabajadordosimetro::where('contdosisededepto_id', $id)
            ->where('mes_asignacion', ($mesnumber - 1))
            ->where('dosimetro_uso', 'TRUE')
            ->select("*")
            ->get();
        $dosimetrosTrabajadoresMes = Trabajadordosimetro::where('contratodosimetriasede_id', $id)
            ->where('mes_asignacion', $mesnumber)
            ->select("*")
            ->get();
        $dosimetroControlEzclipAsignados=Dosicontrolcontdosisede::where('contratodosimetriasede_id', $id)
            ->join('dosimetros','dosimetros.id_dosimetro','=','dosicontrolcontdosisedes.dosimetro_id')
            ->where('tipo_dosimetro', 'EZCLIP')
            ->select("*")
            ->count();
            $dosimetroControlCuerpoAsignados=Dosicontrolcontdosisede::where('contratodosimetriasede_id', $id)
                ->join('dosimetros','dosimetros.id_dosimetro','=','dosicontrolcontdosisedes.dosimetro_id')
                ->where('tipo_dosimetro', 'CUERPO')
                ->select("*")
                ->count();
                $dosimetrosControlAmbientalAsignados=Dosicontrolcontdosisede::where('contratodosimetriasede_id', $id)
                    ->join('dosimetros','dosimetros.id_dosimetro','=','dosicontrolcontdosisedes.dosimetro_id')
                    ->where('tipo_dosimetro', 'AMBIENTAL')
                    ->select("*")
                    ->count();
        $dosimetrosEzClipAsignados = Trabajadordosimetro::where('contratodosimetriasede_id', $id)
        ->join('dosimetros','dosimetros.id_dosimetro','=','trabajadordosimetros.dosimetro_id')
            ->where('tipo_dosimetro', 'EZCLIP')
            ->where('dosimetro_uso', 'TRUE')
            ->where('mes_asignacion', $mesnumber)
            ->select("*")
            ->count();
        $dosimetrosCuerpoEnteroAsignados = Trabajadordosimetro::where('contratodosimetriasede_id', $id)
        ->join('dosimetros','dosimetros.id_dosimetro','=','trabajadordosimetros.dosimetro_id')
            ->where('tipo_dosimetro', 'CUERPO')
            ->where('dosimetro_uso', 'TRUE')
            ->where('mes_asignacion', $mesnumber)
            ->select("*")
            ->count();
        $dosimetrosAmbienteAsignados = Trabajadordosimetro::where('contratodosimetriasede_id', $id)
        ->join('dosimetros','dosimetros.id_dosimetro','=','trabajadordosimetros.dosimetro_id')
            ->where('tipo_dosimetro', 'AMBIENTAL')
            ->where('dosimetro_uso', 'TRUE')
            ->where('mes_asignacion', $mesnumber)
            ->select("*")
            ->count();
        $trabjadosi = Trabajador::leftjoin('trabajadordosimetros', 'trabajadors.id_trabajador', '=', 'trabajadordosimetros.trabajador_id')
        ->whereNull('trabajadordosimetros.trabajador_id')
        ->select("*")
        ->get();
        $trabajadores = Trabajadorsede::where('sede_id', '=', $contdosisededepto->contratodosimetriasede->sede->id_sede)
        ->get();
        $dosimetros =Dosimetro::select("*")
        ->get();
        $holders = Holder::leftJoin('trabajadordosimetros','holders.id_holder', '=', 'trabajadordosimetros.holder_id')
            ->whereNull('trabajadordosimetros.dosimetro_uso')
            ->orWhere(function ($query) {
                $query->where('holders.estado_holder', 'STOCK');
            })
        ->select("*")
        ->get();
        $trabajadoresAsignadosAntes= Trabajadordosimetro::where('mes_asignacion', ($mesnumber-1))
            ->where('contdosisededepto_id', $id)
        ->get();
        $holdersDisponibles = Holder::join('trabajadordosimetros','holders.id_holder', '=', 'trabajadordosimetros.holder_id')
            ->select("*")
            ->get();
        $dosimetrosDisponibles =Dosimetro::join('trabajadordosimetros','dosimetros.id_dosimetro','=','trabajadordosimetros.dosimetro_id')
            ->select("*")
            ->get();
        $ocupacionesMap = collect([
             ['key' => 'T', 'value' => 'TELETERAPIA'],
            ['key' => 'C', 'value' => 'CASA']
        ]);

        return view('dosimetria.asignar_dosimetro_contrato', compact('contdosisededepto', 'trabajadores', 'dosimetros', 'holders', 'dosimetrosControlAsignados', 'dosimetrosEzClipAsignados',
        'dosimetrosCuerpoEnteroAsignados', 'dosimetrosAmbienteAsignados', 'dosimetrosControl', 'ocupacionesMap', 'dosimetrosTrabajadores',
        'holdersDisponibles', 'dosimetrosDisponibles', 'allWorks', 'dosimetroControlEzclipAsignados',
        'dosimetroControlCuerpoAsignados', 'dosimetrosControlAmbientalAsignados',
        'dosimetrosControlAsignadosAnteriores', 'dosimetrosTrabajadoresMes', 'trabajadoresAsignadosAntes'));
        /* return $contdosisede; */
        /* return $trabajadores; */
    }
    public function deleteTrabajadorSede($idWork, $contratoId, $mesnumber) {
        $estado = 'STOCK';
        $trabajadorSede = Trabajadorsede::where('trabajador_id', $idWork)
        ->delete();
        $idHolder = Trabajadordosimetro::where('trabajador_id', $idWork)
            ->where('mes_asignacion', $mesnumber)
        ->select('holder_id', 'dosimetro_id')
        ->get();
        $dosimetroTrabajador = Trabajadordosimetro::where('trabajador_id', $idWork )
        ->where('mes_asignacion', $mesnumber)
        ->delete();
        $holderTrabajador = DB::table('holders')->where('id_holder', $idHolder[0]['holder_id'])
        ->update([
            'estado_holder' => $estado
        ]);
        $result = DB::table('dosimetros')
            ->where('id_dosimetro', $idHolder[0]['dosimetro_id'])
            ->update([
                'estado_dosimetro' => $estado
            ]);
        return redirect()->route('asignadosicontrato.create', ['asigdosicont' =>$contratoId, 'mesnumber'=> $mesnumber]);
    }
    public function deleteDosimetro($idWork, $contratoId, $mesnumber) {
        $dosiTrabajador = Trabajadordosimetro::where('trabajador_id', $idWork)
            ->select("dosimetro_id", "holder_id")
            ->get();
        $result = DB::table('holders')
            ->where('id_holder', $dosiTrabajador[0]['holder_id'])
            ->update([
                'estado_holder' => 'STOCK'
            ]);
        /*$dosimetrosTrabajadores = Trabajadordosimetro::where('trabajador_id', $idWork)
        ->delete();*/
        $resultDosimetros = DB::table('trabajadordosimetros')
            ->where('trabajador_id', $idWork)
            ->where('mes_asignacion', ($mesnumber-1))
            ->update([
                'dosimetro_uso' => 'FALSE'
            ]);
        return $this->callAction('patchDosimetroDelete', ['idDosimetro' =>$dosiTrabajador[0]['dosimetro_id'],
            'contratoId'=> $contratoId, 'mesnumber'=>$mesnumber ]);
    }
    public function patchDosimetroDelete($idDosimetro, $contratoId, $mesnumber) {
        $estado='EN LECTURA';
        $result = DB::table('dosimetros')
            ->where('id_dosimetro', $idDosimetro)
            ->update([
                'estado_dosimetro' => $estado
            ]);

        return redirect()->route('asignadosicontrato.create', ['asigdosicont' =>$contratoId, 'mesnumber'=> $mesnumber]);
        //return $holdersId;
    }
    public function deleteDosimetroControl($idDosiControl, $contratoId, $mesnumber) {
        $idDosimetro = Dosicontrolcontdosisede::where('id_dosicontrolcontdosisedes', $idDosiControl)
        ->select("dosimetro_id")
        ->get();
       /* $dosiControl = Dosicontrolcontdosisede::where('id_dosicontrolcontdosisedes', $idDosiControl)
        ->delete();*/
        $resultDosimetros = DB::table('dosicontrolcontdosisedes')
            ->where('id_dosicontrolcontdosisedes', $idDosiControl)
            ->where('mes_asignacion', $mesnumber)
            ->update([
                'dosimetro_uso' => 'FALSE'
            ]);
        return $this->callAction('patchDosimetroDelete', ['idDosimetro' =>$idDosimetro[0]['dosimetro_id'],
            'contratoId'=> $contratoId, 'mesnumber'=>($mesnumber+1) ]);

    }
    public function patchDosimetroStock($idDosimetro, $contratoId, $mesnumber) {
        $idDosimetroTotal = json_decode($idDosimetro);
        $estado='EN USO';
        $dosimetrosControlAsignados = Dosicontrolcontdosisede::where('contratodosimetriasede_id', $contratoId)
            ->where('mes_asignacion', $mesnumber)
            ->select("*")
            ->count();
        $dosimetroTrabajadorAsignados = Trabajadordosimetro::where('contratodosimetriasede_id', $contratoId)
            ->where('mes_asignacion', $mesnumber)
            ->select("*")
            ->count();
        for($i=0; $i<count($idDosimetroTotal); $i++) {
            $result = DB::table('dosimetros')
                ->where('id_dosimetro', $idDosimetroTotal[$i])
                ->update([
                   'estado_dosimetro' => $estado
                ]);
        }
        $holdersId=collect();
        $idsHolders=collect([]);
        $holdersIdControl=collect();
        for($i=0; $i<count($idDosimetroTotal); $i++) {
            $holdersId[] = Trabajadordosimetro::where('dosimetro_id', $idDosimetroTotal[$i])
            ->where('mes_asignacion', $mesnumber)
            ->select('holder_id')
            ->get();
            }

        $contenedor=null;
        for($i=0; $i<(count($holdersId)-$dosimetrosControlAsignados); $i++) {
            $contenedor = json_encode($holdersId[$i]->first());
            $contenedor = substr_replace($contenedor, '', -1, 1);
            $contenedor = substr($contenedor, 13, 10);
                if($contenedor != 'null') {
                    $resultHolder = DB::table('holders')
                        ->where('id_holder', $contenedor)
                        ->update([
                            'estado_holder' => $estado
                        ]);
                } else {
                    continue;
                }

        }

       // return
        //return $contenedor;
        return redirect()->route('detallesedecont.create', $contratoId);
    }

    public function saveAsignacionDosiContrato(Request $request){
         $request->validate([
            'primerDia_asigdosim'       => 'required',
            'ultimoDia_asigdosim'       => 'required',
            'id_trabajador_asigdosim'   => 'required',
            'id_dosimetro_asigdosim'    => 'required',
            'id_holder_asigdosim'       => 'required',
            'ocupacion_asigdosim'       => 'required',

         ]);
         for($i=0; $i<count($request->id_trabajador_asigdosim); $i++){

            $asigdosim = new Trabajadordosimetro();

            $asigdosim->contratodosimetriasede_id    = $request->id_contrato_asigdosim_sede;
            $asigdosim->contdosisededepto_id         = $request->id_departamento_asigdosim_control;
            $asigdosim->mes_asignacion               = $request->mesNumber1;
            $asigdosim->fecha_dosim_enviado          = $request->fecha_envio_dosim_asignado;
            $asigdosim->fecha_dosim_recibido         = $request->fecha_recibido_dosim_asignado;
            $asigdosim->fecha_dosim_devuelto         = $request->fecha_devuelto_dosim_asignado;
            $asigdosim->trabajador_id                = $request->id_trabajador_asigdosim[$i];
            $asigdosim->dosimetro_id                 = $request->id_dosimetro_asigdosim[$i];
            $asigdosim->holder_id                    = $request->id_holder_asigdosim[$i];
            $asigdosim->primer_dia_uso               = $request->primerDia_asigdosim;
            $asigdosim->ultimo_dia_uso               = $request->ultimoDia_asigdosim;
            $asigdosim->ocupacion                    = $request->ocupacion_asigdosim[$i];
            $asigdosim->energia                      = $request->energia_asigdosim;
            $asigdosim->dosimetro_uso                = 'TRUE';

            $asigdosim->save();
         }
        ////////////////// SAVE DE DOSIMETRO TIPO  CONTROL /////////////////////////

          for($i=0; $i<count($request->id_dosimetro_asigdosim_control); $i++){

             $asigdosim_control = new Dosicontrolcontdosisede();

            $asigdosim_control->dosimetro_id                = $request->id_dosimetro_asigdosim_control[$i];
            $asigdosim_control->mes_asignacion              = $request->mesNumber1;
            $asigdosim_control->contratodosimetriasede_id   = $request->id_contrato_asigdosim_control_sede;
            $asigdosim_control->fecha_dosim_enviado         = $request->fecha_envio_dosim_asignado;
            $asigdosim_control->fecha_dosim_recibido        = $request->fecha_recibido_dosim_asignado;
            $asigdosim_control->fecha_dosim_devuelto        = $request->fecha_devuelto_dosim_asignado;
            $asigdosim_control->contdosisededepto_id        = $request->id_departamento_asigdosim_control;
            $asigdosim_control->primer_dia_uso              = $request->primerDia_asigdosim;
            $asigdosim_control->ultimo_dia_uso              = $request->ultimoDia_asigdosim;
            $asigdosim_control->ocupacion                   = $request->ocupacion_asigdosim_control[$i];
            $asigdosim_control->energia                     = $request->energia_asigdosim;
            $asigdosim_control->dosimetro_uso               = 'TRUE';

            $asigdosim_control->save();
         }

        $dosimetrosTotal = array_merge($request->id_dosimetro_asigdosim, $request->id_dosimetro_asigdosim_control);
        $dosimetrosTotal = json_encode($dosimetrosTotal);
        //return redirect()->route('detallesedecont.create', $request->id_contrato_asigdosim);
          return $this->callAction('patchDosimetroStock',['idDosimetro' =>$dosimetrosTotal,
             'contratoId'=> $request->id_contrato_asigdosim, 'mesnumber'=>$request->mesNumber1 ]);
        /*return route('dosimetroStock.patch',  ['idDosimetro' =>$dosimetrosTotal,
            'contratoId'=> $request->id_contrato_asigdosim, 'mesnumber'=>$request->mesNumber1 ] );*/
        //return $request;
    }

    public function info($id, $mesnumber, Request $request){
        $contdosisededepto = Contratodosimetriasededepto::find($id);
        $dosicontrolasig = Dosicontrolcontdosisede::where('contdosisededepto_id', '=', $id)
        ->where('mes_asignacion', '=', $mesnumber)
        ->get();
        $trabjasignados = Trabajadordosimetro::where('contdosisededepto_id', '=', $id)
        ->where('mes_asignacion', '=', $mesnumber)
        ->get();

        $dosimetros =Dosimetro::leftJoin('trabajadordosimetros','dosimetros.id_dosimetro','=','trabajadordosimetros.dosimetro_id')
            ->whereNull('trabajadordosimetros.dosimetro_uso')
            ->orWhere(function ($query) {
                $query->where('dosimetros.estado_dosimetro', 'STOCK');
            })
            ->select("*")
            ->get();
        $holders = Holder::leftJoin('trabajadordosimetros','holders.id_holder', '=', 'trabajadordosimetros.holder_id')
            ->whereNull('trabajadordosimetros.dosimetro_uso')
            ->orWhere(function ($query) {
                $query->where('holders.estado_holder', 'STOCK');
            })
            ->select("*")
            ->get();

        return view('dosimetria.info_asignacion_dosimetros_contrato', compact('contdosisededepto', 'trabjasignados', 'dosicontrolasig',
        'holders', 'dosimetros'));
        /* return $contdosisededepto; */
    }

    public function updateInfo($idWork, $contratoId, $mesnumber, Request $request) {
        $dosiTrabajador = Trabajadordosimetro::where('trabajador_id', $idWork)
            ->select("dosimetro_id", "holder_id")
            ->get();
        $result = DB::table('holders')
            ->where('id_holder', $dosiTrabajador[0]['holder_id'])
            ->update([
                'estado_holder' => 'STOCK'
            ]);
        $resultDosimetroStock = DB::table('dosimetros')
            ->where('id_dosimetro', $dosiTrabajador[0]['dosimetro_id'])
            ->update([
                'estado_dosimetro' => 'STOCK'
            ]);

        $resultDosimetros = DB::table('trabajadordosimetros')
            ->where('trabajador_id', $idWork)
            ->where('mes_asignacion', ($mesnumber))
            ->update([
                'dosimetro_uso' => 'TRUE',
                'dosimetro_id' => $request->id_dosimetro_asigdosim,
                'holder_id' => $request->id_holder_asigdosim,
                'ocupacion' => $request->ocupacion_asigdosim_control
            ]);



        $dosiTrabajador = Trabajadordosimetro::where('trabajador_id', $idWork)
            ->select("dosimetro_id", "holder_id")
            ->get();
        $result = DB::table('holders')
            ->where('id_holder', $dosiTrabajador[0]['holder_id'])
            ->update([
                'estado_holder' => 'EN USO'
            ]);
        $resultDosimetroStock = DB::table('dosimetros')
            ->where('id_dosimetro', $dosiTrabajador[0]['dosimetro_id'])
            ->update([
                'estado_dosimetro' => 'EN USO'
            ]);

        return redirect()->route('asignadosicontrato.info', ["asigdosicont" =>$contratoId, "mesnumber" => $mesnumber]);
    }

    public function deleteInfo($idWork,$contratoId, $mesnumber) {
        $dosiTrabajador = Trabajadordosimetro::where('trabajador_id', $idWork)
            ->select("dosimetro_id", "holder_id")
            ->get();
        $result = DB::table('holders')
            ->where('id_holder', $dosiTrabajador[0]['holder_id'])
            ->update([
                'estado_holder' => 'STOCK'
            ]);
        $resultDosimetros = DB::table('trabajadordosimetros')
            ->where('trabajador_id', $idWork)
            ->where('mes_asignacion', ($mesnumber))
            ->update([
                'dosimetro_uso' => 'FALSE'
            ]);
        $resultDosimetroStock = DB::table('dosimetros')
            ->where('id_dosimetro', $dosiTrabajador[0]['dosimetro_id'])
            ->update([
                'estado_dosimetro' => 'STOCK'
            ]);
        $resultDosimetrosDelete = DB::table('trabajadordosimetros')
            ->where('trabajador_id', $idWork)
            ->where('mes_asignacion', $mesnumber)
            ->delete();
        return redirect()->route('asignadosicontrato.info', ["asigdosicont" =>$contratoId, "mesnumber" => $mesnumber]);
    }

    public function lecturadosi($id){
        $trabjasig = Trabajadordosimetro::find($id);
        /* return $trabjasig; */
        return view('dosimetria.lectura_dosimetro_contrato', compact('trabjasig'));
    }
    public function savelecturadosi(Request $request, $id){

        $trabjasig = Trabajadordosimetro::find($id);

        $request->validate([
            'measurement_date'              => 'required',
            'zeroLevel_date'                => 'required',
            'verification_Date'             => 'required',
            'verification_required_before'  => 'required',
        ]);

        $trabjasig->zero_level_date         = $request->zeroLevel_date;
        $trabjasig->measurement_date        = $request->measurement_date;
        $trabjasig->Hp007_calc_dose         = $request->hp007_calc_dose;
        $trabjasig->Hp007_background_dose   = $request->hp007_background_dose;
        $trabjasig->Hp007_raw_dose          = $request->hp007_raw_dose;
        $trabjasig->Hp10_calc_dose          = $request->hp10_calc_dose;
        $trabjasig->Hp10_background_dose    = $request->hp10_background_dose;
        $trabjasig->Hp10_raw_dose           = $request->hp10_raw_dose;
        $trabjasig->EzClip_calc_dose        = $request->ezclip_calc_dose;
        $trabjasig->EzClip_background_dose  = $request->ezclip_background_dose;
        $trabjasig->EzClip_raw_dose         = $request->ezclip_raw_dose;
        $trabjasig->Hp3_calc_dose           = $request->hp3_calc_dose;
        $trabjasig->Hp3_background_dose     = $request->hp3_background_dose;
        $trabjasig->Hp3_raw_dose            = $request->hp3_raw_dose;
        $trabjasig->H_10_calc_dose          = $request->h10_cal_dose;
        $trabjasig->verification_date       = $request->verification_Date;
        $trabjasig->verification_required_on_or_before  = $request->verification_required_before;
        $trabjasig->remaining_days_available_for_use    = $request->remaining_days_available_use;

        $trabjasig->save();

        if($request->estado_uso == 'TRUE'){

            $dosiestado = Dosimetro::find($trabjasig->dosimetro->id_dosimetro);
    
            $dosiestado->estado_dosimetro = 'STOCK';
            $dosiestado->save();
        }
        if($request->estadoholder_uso == 'TRUE'){
            $dosiholderestado = Holder::find($trabjasig->holder->id_holder);

            $dosiholderestado->estado_holder = 'STOCK';
            $dosiholderestado->save();
        } 

        return redirect()->route('asignadosicontrato.info', ["asigdosicont" => $request->id_contratodosimetriasededepto, "mesnumber" => $request->mes_asignacion])->with('actualizar', 'ok');
        /* return $request; */
    }
    public function editlecturadosi($id){
        $trabjasig = Trabajadordosimetro::find($id);
        return view('dosimetria.lectura_dosimetro_contrato_edit', compact('trabjasig'));

    }

    public function lecturadosicontrol($id){
        $dosicontasig = Dosicontrolcontdosisede::find($id);

        return view('dosimetria.lectura_dosimetro_control_contrato', compact('dosicontasig'));

    }
    public function savelecturadosicontrol(Request $request, $id){

        $dosicontasig = Dosicontrolcontdosisede::find($id);

        $request->validate([
            'measurement_date'              => 'required',
            'zeroLevel_date'                => 'required',
            'verification_Date'             => 'required',
            'verification_required_before'  => 'required',
        ]);

        $dosicontasig->zero_level_date                     = $request->zeroLevel_date;
        $dosicontasig->measurement_date                    = $request->measurement_date;
        $dosicontasig->Hp007_calc_dose                     = $request->hp007_calc_dose;
        $dosicontasig->Hp007_background_dose               = $request->hp007_background_dose;
        $dosicontasig->Hp007_raw_dose                      = $request->hp007_raw_dose;
        $dosicontasig->Hp10_calc_dose                      = $request->hp10_calc_dose;
        $dosicontasig->Hp10_background_dose                = $request->hp10_background_dose;
        $dosicontasig->Hp10_raw_dose                       = $request->hp10_raw_dose;
        $dosicontasig->EzClip_calc_dose                    = $request->ezclip_calc_dose;
        $dosicontasig->EzClip_background_dose              = $request->ezclip_background_dose;
        $dosicontasig->EzClip_raw_dose                     = $request->ezclip_raw_dose;
        $dosicontasig->Hp3_calc_dose                       = $request->hp3_calc_dose;
        $dosicontasig->Hp3_background_dose                 = $request->hp3_background_dose;
        $dosicontasig->Hp3_raw_dose                        = $request->hp3_raw_dose;
        $dosicontasig->H_10_calc_dose                      = $request->h10_cal_dose;
        $dosicontasig->verification_date                   = $request->verification_Date;
        $dosicontasig->verification_required_on_or_before  = $request->verification_required_before;
        $dosicontasig->remaining_days_available_for_use    = $request->remaining_days_available_use;
        
        $dosicontasig->save();

        if($request->estado_uso == 'TRUE'){

            $dosiestado = Dosimetro::find($dosicontasig->dosimetro->id_dosimetro);
    
            $dosiestado->estado_dosimetro = 'STOCK';
            $dosiestado->save();
        }

        return redirect()->route('asignadosicontrato.info',["asigdosicont" => $request->id_contratodosimetriasededepto, "mesnumber" => $request->mes_asignacion])->with('actualizar', 'ok');
        /* return $dosicontasig->dosimetro->id_dosimetro; */
    }
    public function editlecturadosicontrol($id){
        $dosicontasig = Dosicontrolcontdosisede::find($id);
        return view('dosimetria.lectura_dosimetro_control_edit', compact('dosicontasig'));
    }

    public function pdf($id, $mesnumber){

        /* SELECT * FROM `contratodosimetriasededeptos` INNER JOIN contratodosimetriasedes ON contratodosimetriasededeptos.contratodosimetriasede_id = contratodosimetriasedes.id_contratodosimetriasede 
        INNER JOIN contactosedes ON contratodosimetriasedes.sede_id = contactosedes.sede_id 
        INNER JOIN contactos ON contactosedes.contacto_id = contactos.id_contacto 
        INNER JOIN sedes ON contratodosimetriasedes.sede_id = sedes.id_sede 
        INNER JOIN colmunicipios on sedes.municipiocol_id = colmunicipios.id_municipiocol 
        INNER JOIN coldepartamentos ON colmunicipios.departamentocol_id = coldepartamentos.id_departamentocol 
        INNER JOIN dosimetriacontratos ON contratodosimetriasedes.contratodosimetria_id = dosimetriacontratos.id_contratodosimetria 
        INNER JOIN empresas ON dosimetriacontratos.empresa_id = empresas.id_empresa 
        WHERE contratodosimetriasededeptos.id_contdosisededepto = 1 AND contactos.lider_dosimetria='TRUE'; */
        $contratoDosi = Contratodosimetriasededepto::join('contratodosimetriasedes', 'contratodosimetriasededeptos.contratodosimetriasede_id','=','contratodosimetriasedes.id_contratodosimetriasede')
        ->join('contactosedes', 'contratodosimetriasedes.sede_id', '=', 'contactosedes.sede_id')
        ->join('contactos', 'contactosedes.contacto_id', '=', 'contactos.id_contacto')
        ->join('sedes', 'contratodosimetriasedes.sede_id', '=', 'sedes.id_sede')
        ->join('colmunicipios', 'sedes.municipiocol_id', '=', 'colmunicipios.id_municipiocol')
        ->join('coldepartamentos', 'colmunicipios.departamentocol_id', '=', 'coldepartamentos.id_departamentocol')
        ->join('dosimetriacontratos', 'contratodosimetriasedes.contratodosimetria_id', '=', 'dosimetriacontratos.id_contratodosimetria')
        ->join('empresas', 'dosimetriacontratos.empresa_id', '=', 'empresas.id_empresa')
        ->where('contratodosimetriasededeptos.id_contdosisededepto', '=', $id)
        ->where('contactos.lider_dosimetria', '=', 'TRUE')
        ->select("*")
        ->get();

        $trabajdosiasig= Trabajadordosimetro::where('contdosisededepto_id', '=', $id)
        ->where('mes_asignacion', '=', $mesnumber)
        ->get();

        /* $fechainiciodositrabaj = array(); */
        for($i=0; $i<count($trabajdosiasig); $i++){
            $fechainiciodositrabaj[]=Trabajadordosimetro::where('trabajador_id','=', $trabajdosiasig[$i]->trabajador_id)->first();
        }
       
        /* SELECT * FROM `dosicontrolcontdosisedes` INNER JOIN contratodosimetriasededeptos ON dosicontrolcontdosisedes.contdosisededepto_id = contratodosimetriasededeptos.id_contdosisededepto
        INNER JOIN departamentosedes ON contratodosimetriasededeptos.departamentosede_id = departamentosedes.id_departamentosede; */
        $dosicontrolasig = Dosicontrolcontdosisede::join('dosimetros', 'dosicontrolcontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->join('contratodosimetriasededeptos', 'dosicontrolcontdosisedes.contdosisededepto_id', '=', 'contratodosimetriasededeptos.id_contdosisededepto')
        ->join('departamentosedes','contratodosimetriasededeptos.departamentosede_id', '=', 'departamentosedes.id_departamentosede')
        ->where('contdosisededepto_id', '=', $id)
        ->where('mes_asignacion', '=', $mesnumber)
        ->get();

        for($i=0; $i<count($trabajdosiasig); $i++){

            $trabajadoresaisgxmeses[] = Trabajadordosimetro::where('trabajador_id', '=', $trabajdosiasig[$i]->trabajador_id)->get();
        }

        $pdf = PDF::loadView('dosimetria.reportePDF_dosimetria', compact('trabajdosiasig', 'dosicontrolasig', 'contratoDosi', 'fechainiciodositrabaj', 'trabajadoresaisgxmeses'));
        $pdf->setPaper('8.5x14', 'landscape');
        /* return $dosicontrolasig; */
        return $pdf->stream();
       /*  return $contratoDosi; */

    }


}
