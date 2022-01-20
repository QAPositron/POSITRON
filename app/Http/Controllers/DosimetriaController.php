<?php

namespace App\Http\Controllers;

use App\Models\ContratoDosimetria;

use App\Models\Contratodosimetriasede;

use App\Models\ContratosDosimetriaEmpresa;
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
use Illuminate\Http\Request;

class DosimetriaController extends Controller
{
    /* public function index(){
        $empresa = ContratosDosimetriaEmpresa::all();
        return view('dosimetria.empresas_dosimetria', compact('empresa'));
    } */
    public function createEmpresa(){
        $empresa = Empresa::all();
        $empresaDosi = ContratosDosimetriaEmpresa::all();
        return view('dosimetria.crear_empresas_dosimetria', compact('empresa', 'empresaDosi'));
    }
    public function saveEmpresa(Request $request){

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

        /* return $empresaDosi; */
        return redirect()->route('empresasdosi.create');
    }
    
    public function createContrato($id){
        $empresa = Empresa::find($id);

        $sedes = Sede::leftJoin('contratodosimetriasedes', 'sedes.id_sede', '=', 'contratodosimetriasedes.sede_id')
        ->where('sedes.empresas_id', $id)
        ->whereNull('contratodosimetriasedes.sede_id')
        ->get();
      
        $dosimetriacontrato = Dosimetriacontrato::where('dosimetriacontratos.empresa_id', $id)
        ->get();
        return view('dosimetria.crear_contratos_dosimetria', compact('empresa', 'sedes', 'dosimetriacontrato'));
        /* return $empresa; */
    }

    public function saveContrato(Request $request){

        $request->validate([
            'codigo_contrato'               => 'required',
            'fecha_inicio_contrato'         => 'required',
            'fecha_finalizacion_contrato'   => 'required',
            'periodo_recambio_contrato'     => 'required',
            'id_sede'                       => 'required',
            
        ]);
        $contratoDosi = new Dosimetriacontrato();

        $contratoDosi->codigo_contrato              = $request->codigo_contrato;
        $contratoDosi->empresa_id                   = $request->empresa_contrato;
        $contratoDosi->fecha_inicio                 = $request->fecha_inicio_contrato;
        $contratoDosi->fecha_finalizacion           = $request->fecha_finalizacion_contrato;
        $contratoDosi->periodo_recambio             = $request->periodo_recambio_contrato;
        
        $contratoDosi->save();

        for($i=0; $i<count($request->id_sede); $i++){

            $contratoDosiSede = new Contratodosimetriasede();

            $contratoDosiSede->sede_id               = $request->id_sede[$i];
            $contratoDosiSede->contratodosimetria_id = $contratoDosi->id_contratodosimetria;
            $contratoDosiSede->dosi_cuerpo_entero    = $request->num_dosi_ce[$i];
            $contratoDosiSede->dosi_ambiental        = $request->num_dosi_ambiental[$i];
            $contratoDosiSede->dosi_control          = $request->num_dosi_caso[$i];
            $contratoDosiSede->dosi_ezclip           = $request->num_dosi_ezclip[$i];
            $contratoDosiSede->save();
        }
        
        
        return redirect()->route('contratosdosi.create', $contratoDosi->empresa_id);

    }

    public function createdetalleContrato($id){
        $dosimetriacontrato = Dosimetriacontrato::find($id);
        $dosimecontra = Dosimetriacontrato::join('contratodosimetriasedes', 'id_contratodosimetria', '=', 'contratodosimetria_id')
        ->join('sedes', 'sede_id', '=', 'id_sede')
        ->join('empresas', 'empresas_id', '=', 'id_empresa')
        ->select('codigo_contrato', 'fecha_inicio', 'fecha_finalizacion', 'periodo_recambio','id_sede','nombre_sede', 'nombre_empresa', 'dosi_cuerpo_entero', 'dosi_ambiental', 'dosi_ezclip', 'dosi_control', 'id_contratodosimetriasede')
        ->where('id_contratodosimetria', '=', $id)
        ->get();
        return view('dosimetria.detalle_contrato_dosimetria', compact('dosimetriacontrato', 'dosimecontra'));
       /*  return $dosimecontra; */
    }

    public function createdetsedeContrato($id){
        $dosisedecontra = Contratodosimetriasede::find($id);
        $trabjasigcontra = Trabajadordosimetro::where('contratodosimetriasede_id', '=', $id)
        ->get();
        return view('dosimetria.detalle_sede_contrato_dosimetria', compact('dosisedecontra', 'trabjasigcontra'));
        /* return $dosisedecontra; */
    }

    public function asignaDosiContrato($id)
    {
        $contdosisede = Contratodosimetriasede::find($id);
        $trabjadosi = Trabajador::leftjoin('trabajadordosimetros', 'trabajadors.id_trabajador', '=', 'trabajadordosimetros.trabajador_id')
        ->whereNull('trabajadordosimetros.trabajador_id')
        ->select("*")
        ->get();
        $trabajadores = Trabajadorsede::where('sede_id', '=', $contdosisede->sede_id)
        ->get();
        $dosimetros =Dosimetro::leftJoin('trabajadordosimetros','dosimetros.id_dosimetro','=','trabajadordosimetros.dosimetro_id')
        ->whereNull('trabajadordosimetros.dosimetro_id')
        ->select("*")
        ->get();
        $holders = Holder::leftJoin('trabajadordosimetros','holders.id_holder', '=', 'trabajadordosimetros.holder_id') 
        ->whereNull('trabajadordosimetros.holder_id')
        ->select("*")
        ->get();
        return view('dosimetria.asignar_dosimetro_contrato', compact('contdosisede', 'trabajadores', 'dosimetros', 'holders'));
        /* return $contdosisede; */
        /* return $trabajadores; */
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

            $asigdosim->contratodosimetriasede_id    = $request->id_contrato_asigdosim;
            $asigdosim->trabajador_id                = $request->id_trabajador_asigdosim[$i];
            $asigdosim->dosimetro_id                 = $request->id_dosimetro_asigdosim[$i];
            $asigdosim->holder_id                    = $request->id_holder_asigdosim[$i];
            $asigdosim->primer_dia_uso               = $request->primerDia_asigdosim;
            $asigdosim->ultimo_dia_uso               = $request->ultimoDia_asigdosim;
            $asigdosim->ocupacion                    = $request->ocupacion_asigdosim[$i];
            
            
            $asigdosim->save();
        }
        ////////////////// SAVE DE DOSIMETRO TIPO  CONTROL /////////////////////////
        
        for($i=0; $i<count($request->id_dosimetro_asigdosim_control); $i++){

            $asigdosim_control = new Dosicontrolcontdosisede();

            $asigdosim_control->dosimetro_id                = $request->id_dosimetro_asigdosim_control[$i];
            $asigdosim_control->contratodosimetriasede_id   = $request->id_contrato_asigdosim_control;
            $asigdosim_control->sede_id                     = $request->id_sede_asigdosim_control;
            $asigdosim_control->primer_dia_uso              = $request->primerDia_asigdosim;
            $asigdosim_control->ultimo_dia_uso              = $request->ultimoDia_asigdosim;
            $asigdosim_control->ocupacion                   = $request->ocupacion_asigdosim_control[$i];
            $asigdosim_control->energia                     = $request->energia_asigdosim;
            
            $asigdosim_control->save();
        }
        return redirect()->route('detallesedecont.create', $request->id_contrato_asigdosim);

        /* return $request; */
        
    }
}