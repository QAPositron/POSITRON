<?php

namespace App\Http\Controllers;

use App\Models\ContratoDosimetria;

use App\Models\Contratodosimetriasede;

use App\Models\ContratosDosimetriaEmpresa;
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
            $contratoDosiSede->contratodosimetria_id = $contratoDosi->id_contrato_dosimetria;
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
        $dosimecontra = Dosimetriacontrato::join('contratodosimetriasedes', 'id_contrato_dosimetria', '=', 'contratodosimetria_id')
        ->join('sedes', 'sede_id', '=', 'id_sede')
        ->join('empresas', 'empresas_id', '=', 'id_empresa')
        ->select('codigo_contrato', 'fecha_inicio', 'fecha_finalizacion', 'periodo_recambio','id_sede','nombre_sede', 'nombre_empresa', 'dosi_cuerpo_entero', 'dosi_ambiental', 'dosi_ezclip', 'dosi_control', 'id_contratodosimetriasede')
        ->where('id_contrato_dosimetria', '=', $id)
        ->get();
        return view('dosimetria.detalle_contrato_dosimetria', compact('dosimetriacontrato', 'dosimecontra'));
       /*  return $dosimecontra; */
    }
    public function createdetsedeContrato($id){
        $dosisedecontra = Contratodosimetriasede::find($id);
       
        return view('dosimetria.detalle_sede_contrato_dosimetria', compact('dosisedecontra'));
        /* return $dosisedecontra; */
    }

    public function asignaDosiContrato($id)
    {
        $contdosisede = Contratodosimetriasede::find($id);
        $trabajadores = Trabajadorsede::where('sede_id', '=', $contdosisede->sede_id)
        ->get();
        $dosimetros =Dosimetro::all();
        $holder = Holder::all();
        return view('dosimetria.asignar_dosimetro_contrato', compact('contdosisede', 'trabajadores', 'dosimetros', 'holder'));
        /* return $contdosisede; */
        /* return $trabajadores; */
    }
     
    public function saveAsignacionDosiContrato(Request $request){
        $request->validate([
            'primerDia_asigdosim'       => 'required',
            'ultimoDia_asigdosim'       => 'required',
            'id_trabajador_asigdosim'   => 'required',
            'num_dosimetro_asigdosim'   => 'required',
            'num_holder_asigdosim'      => 'required',
            'ocupacion__asigdosim'      => 'required',
        ]);
        for($i=0; $i<count($request->id_trabajador_asigdosim); $i++){

            $asigdosim = new Trabajadordosimetro();

            $asigdosim->trabajador_id                = $request->id_trabajador_asigdosim[$i];
            $asigdosim->dosimetro_id                 = $request->num_dosimetro_asigdosim[$i];
            $asigdosim->holder_id                    = $request->num_holder_asigdosim[$i];
            
            $asigdosim->save();
        }
        return $asigdosim;
    }
}