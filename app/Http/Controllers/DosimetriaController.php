<?php

namespace App\Http\Controllers;

use App\Models\ContratoDosimetria;
use App\Models\ContratoDosimetriaSede;
use App\Models\ContratosDosimetriaEmpresa;
use App\Models\Dosimetriacontrato;
use App\Models\Empresa;
use App\Models\Sede;
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
        $sedes = Sede::join('empresas', 'empresas_id', '=', 'id_empresa')
        ->select('id_sede', 'nombre_sede')
        ->get();
        
        return view('dosimetria.crear_contratos_dosimetria', compact('empresa', 'sedes'));
        /* return $sedes; */
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
        $contratoDosi->fecha_inicio                 = $request->fecha_inicio_contrato;
        $contratoDosi->fecha_finalizacion           = $request->fecha_finalizacion_contrato;
        $contratoDosi->periodo_recambio             = $request->periodo_recambio_contrato;
        
        $contratoDosi->save();

        $contratoDosiSede = new ContratoDosimetriaSede();

        $contratoDosiSede->contratodosimetria_id    = $contratoDosi->id_contrato_dosimetria;
        $contratoDosiSede->sede_id                  = $request->id_sede;
        $contratoDosiSede->dosi_cuerpo_entero       = $request->num_dosi_ce_contrato_sede;
        $contratoDosiSede->dosi_ambiental           = $request->num_dosi_ambiental_contrato_sede;
        $contratoDosiSede->dosi_ezclip              = $request->num_dosi_ezclip_contrato_sede;

        $contratoDosiSede->save();

        return $contratoDosiSede;
        /* return $contratoDosiSede; */
        /* return redirect()->route('empresasdosi.create'); */
    }
}
