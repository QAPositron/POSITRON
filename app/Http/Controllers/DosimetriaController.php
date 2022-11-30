<?php

namespace App\Http\Controllers;

use App\Models\Areadepartamentosede;
use App\Models\ContratoDosimetria;

use App\Models\Contratodosimetriasede;
use App\Models\Contratodosimetriasededepto;
use App\Models\ContratosDosimetriaEmpresa;
use App\Models\Departamento;
use App\Models\Departamentosede;
use App\Models\Dosiareacontdosisede;
use App\Models\Dosicontrolcontdosisede;
use App\Models\DosimControlcontdosiSede;
use App\Models\Dosimetriacontrato;
use App\Models\Dosimetro;
use App\Models\Empresa;
use App\Models\Holder;
use App\Models\Mesescontdosisedeptos;
use App\Models\Mesescontratodosimetriasedepto;
use App\Models\Persona;
use App\Models\Personasedes;
use App\Models\Sede;
use App\Models\Temptrabajdosimentradarev;
use App\Models\Temptrabajdosimrev;
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
        /* $sumaContratodosisededepto = Contratodosimetriasededepto::where */

       return view('dosimetria.crear_empresas_dosimetria', compact('empresas', 'empresaDosi'));
    }
    public function saveEmpresa(Request $request){

         $request->validate([
            'id_empresa'      => 'required',
        ]);
        $empresaDosi = new ContratosDosimetriaEmpresa();

        $empresaDosi->empresa_id                   = $request->id_empresa;
        $empresaDosi->numtotal_dosi_torax          = 0;
        $empresaDosi->numtotal_dosi_cristalino     = 0;
        $empresaDosi->numtotal_dosi_dedo           = 0;
        $empresaDosi->numtotal_dosi_muñeca         = 0;
        $empresaDosi->numtotal_dosi_control        = 0;
        $empresaDosi->numtotal_dosi_ambiental      = 0;
        $empresaDosi->numtotal_dosi_caso           = 0;

        $empresaDosi->save();
        return redirect()->route('empresasdosi.create'); 
    }
/* -----------------------ANALIZAR ESTA FUNCION -------------------- */
    public function createlistContrato($id){
        $empresa = Empresa::find($id);
        $dosimetriacontrato = Dosimetriacontrato::where('dosimetriacontratos.empresa_id', $id)->get();
        $sedes = Sede::where('sedes.empresas_id', $id)->get();
        /* $first = Sede::leftJoin('contratodosimetriasedes', 'sedes.id_sede', '=', 'contratodosimetriasedes.sede_id')->where('sedes.empresas_id', $id);
        $sedes = Sede::rightJoin('contratodosimetriasedes', 'sedes.id_sede', '=', 'contratodosimetriasedes.sede_id')->where('sedes.empresas_id', $id)->union($first)->get(); */
        
        $departamentos = Departamentosede::join('sedes', 'departamentosedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('empresas.id_empresa', $id)
        ->get();
        return view('dosimetria.crear_listar_contratos_dosimetria', compact('empresa', 'dosimetriacontrato', 'sedes','departamentos'));
        /* return $sedes; */
    }
/* ------------------------------------------------------------------------------- */
    public function createContratodosi($id){ 
        $empresa = Empresa::find($id);
        $sedes = Sede::where('sedes.empresas_id', $id)->get();
        $departamentos = Departamento::join('departamentosedes', 'departamentos.id_departamento', '=', 'departamentosedes.departamento_id')
        ->join('sedes', 'departamentosedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('empresas.id_empresa', $id)
        ->get();
        $codigocontratoant = Dosimetriacontrato::latest()->first();
        
        return view('dosimetria.crear_contrato_dosimetria', compact('empresa','sedes', 'departamentos', 'codigocontratoant'));
    }
    
    public function selectdepa(Request $request){
        $departamentos = Departamento::join('departamentosedes', 'departamentos.id_departamento', '=', 'departamentosedes.departamento_id')
            ->where('sede_id', $request->sede_id)
            ->select("*")
            ->get();
        echo "$departamentos";
    }

    public function saveContratodosi(Request $request){
        /* return $request; */
        
        $request->validate([
            'codigo_contrato'               => 'required|unique:dosimetriacontratos,codigo_contrato',
            'periodo_recambio_contrato'     => 'required',
            'fecha_inicio_contrato'         => 'required',
            'fecha_finalizacion_contrato'   => 'required',
            'id_sede1'                      => 'required',

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
                
                for($x=0; $x<$longitudepto; $x++){
                    $contratoDosiSedeDepto = new Contratodosimetriasededepto();
                    $contratoDosiSedeDepto->contratodosimetriasede_id = $contratoDosiSede->id_contratodosimetriasede;
                    $contratoDosiSedeDepto->departamentosede_id       = $request->input('departamentos_sede'.$i)[$x];
                    $contratoDosiSedeDepto->mes_actual                = 1;
                    $contratoDosiSedeDepto->dosi_control              = $request->input('dosimetro_control_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_control_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_torax                = $request->input('dosimetro_torax_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_torax_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_area                 = $request->input('dosimetro_area_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_area_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_caso                 = $request->input('dosimetro_caso_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_caso_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_cristalino           = $request->input('dosimetro_cristalino_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_cristalino_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_muñeca               = $request->input('dosimetro_muneca_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_muneca_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_dedo                 = $request->input('dosimetro_dedo_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_dedo_sede'.$i)[$x];
                    $contratoDosiSedeDepto->save();

                    $mescontdosisedeDepto = new Mesescontdosisedeptos();
                    $mescontdosisedeDepto->contdosisededepto_id      = $contratoDosiSedeDepto->id_contdosisededepto;
                    $mescontdosisedeDepto->mes_asignacion            = $request->primer_mes_asignacion;
                    $mescontdosisedeDepto->dosi_control              = $request->input('dosimetro_control_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_control_sede'.$i)[$x];
                    $mescontdosisedeDepto->dosi_torax                = $request->input('dosimetro_torax_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_torax_sede'.$i)[$x];
                    $mescontdosisedeDepto->dosi_area                 = $request->input('dosimetro_area_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_area_sede'.$i)[$x];
                    $mescontdosisedeDepto->dosi_caso                 = $request->input('dosimetro_caso_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_caso_sede'.$i)[$x];
                    $mescontdosisedeDepto->dosi_cristalino           = $request->input('dosimetro_cristalino_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_cristalino_sede'.$i)[$x];
                    $mescontdosisedeDepto->dosi_muñeca               = $request->input('dosimetro_muneca_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_muneca_sede'.$i)[$x];
                    $mescontdosisedeDepto->dosi_dedo                 = $request->input('dosimetro_dedo_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_dedo_sede'.$i)[$x];
                    $mescontdosisedeDepto->save();

                    $numtotalEmpresasDosi = ContratosDosimetriaEmpresa::where('empresa_id', '=', $request->empresa_contrato)->get();
                    foreach($numtotalEmpresasDosi as $totalEmpDosi){

                        $totalEmpDosi->numtotal_dosi_torax      = ($totalEmpDosi->numtotal_dosi_torax + $request->input('dosimetro_torax_sede'.$i)[$x]);
                        $totalEmpDosi->numtotal_dosi_cristalino = ($totalEmpDosi->numtotal_dosi_cristalino + $request->input('dosimetro_cristalino_sede'.$i)[$x]);
                        $totalEmpDosi->numtotal_dosi_dedo       = ($totalEmpDosi->numtotal_dosi_dedo + $request->input('dosimetro_dedo_sede'.$i)[$x]);
                        $totalEmpDosi->numtotal_dosi_muñeca     = ($totalEmpDosi->numtotal_dosi_muñeca + $request->input('dosimetro_muneca_sede'.$i)[$x]);
                        $totalEmpDosi->numtotal_dosi_control    = ($totalEmpDosi->numtotal_dosi_control + $request->input('dosimetro_control_sede'.$i)[$x]);
                        $totalEmpDosi->numtotal_dosi_ambiental  = ($totalEmpDosi->numtotal_dosi_ambiental + $request->input('dosimetro_area_sede'.$i)[$x]);
                        $totalEmpDosi->numtotal_dosi_caso       = ($totalEmpDosi->numtotal_dosi_caso + $request->input('dosimetro_caso_sede'.$i)[$x]);
                        $totalEmpDosi->save();
                    }
                    

                }
            }else{
                break;
            }
        }
        return redirect()->route('detallecontrato.create', $contratoDosi->id_contratodosimetria)->with('crear', 'ok');
    }
    
    public function pdfContratoDosimetria($contdosi){
        /* $contrato = Dosimetriacontrato::join('empresas', 'dosimetriacontratos.empresa_id', '=', 'empresas.id_empresa')
        ->join('colmunicipios', 'empresas.municipiocol_id', '=', 'colmunicipios.id_municipiocol')
        ->join('coldepartamentos', 'colmunicipios.departamentocol_id', '=', 'coldepartamentos.id_departamentocol')
        ->where('dosimetriacontratos.codigo_contrato', '=', $contdosi)->get(); */
        $contrato = Dosimetriacontrato::where('codigo_contrato', '=', $contdosi)->get();
        /* return $contrato; */
         $pdf =  PDF::loadView('dosimetria.contratoPDF_dosimetria', compact('contrato', 'contdosi'));
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->stream(); 
    }

    public function editContratodosi($empresa, $id){
        $contrato = Dosimetriacontrato::find($id);
        $sedes = Sede::where('empresas_id', '=', $empresa)->get();
        /* SELECT * FROM `contratodosimetriasededeptos` INNER JOIN departamentosedes ON contratodosimetriasededeptos.departamentosede_id = departamentosedes.id_departamentosede 
        INNER JOIN contratodosimetriasedes ON contratodosimetriasededeptos.contratodosimetriasede_id = contratodosimetriasedes.id_contratodosimetriasede 
        INNER JOIN sedes ON contratodosimetriasedes.sede_id = sedes.id_sede 
        INNER JOIN dosimetriacontratos ON contratodosimetriasedes.contratodosimetria_id = dosimetriacontratos.id_contratodosimetria;*/
        $sedesdeptos = Contratodosimetriasededepto::join('departamentosedes', 'departamentosede_id', '=', 'id_departamentosede')
        ->join('sedes', 'sede_id', '=', 'id_sede')
        ->join('contratodosimetriasedes', 'contratodosimetriasede_id', '=', 'id_contratodosimetriasede')
        ->join('dosimetriacontratos', 'contratodosimetria_id', '=', 'id_contratodosimetria')
        ->where('id_contratodosimetria', '=', $id)
        ->select('id_contratodosimetriasede', 'id_contdosisededepto', 'id_sede', 'nombre_sede', 'id_departamentosede', 'nombre_departamento', 'dosi_torax', 'dosi_control', 'dosi_area', 'dosi_caso', 'dosi_cristalino', 'dosi_muñeca', 'dosi_dedo')
        ->get();
        $departamentos = Departamentosede::join('sedes', 'departamentosedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('empresas.id_empresa', $empresa)
        ->get();
       
        return view('dosimetria.edit_contrato_dosimetria', compact('contrato', 'sedesdeptos', 'sedes', 'departamentos', 'empresa'));
        /* return $sedesdeptos; */
    }
    public function updateContratodosi(Request $request, $contrato){
        /* return $request; */
        $request->validate([
            
            'periodo_recambio_contrato'     => 'required',
            'fecha_inicio_contrato'         => 'required',
            'fecha_finalizacion_contrato'   => 'required',
        ]);
        $contratodosi = Dosimetriacontrato::find($contrato);

        $contratodosi->codigo_contrato              = $request->codigo_contrato;
        $contratodosi->empresa_id                   = $request->empresa_contrato;
        $contratodosi->fecha_inicio                 = $request->fecha_inicio_contrato;
        $contratodosi->fecha_finalizacion           = $request->fecha_finalizacion_contrato;
        $contratodosi->periodo_recambio             = strtoupper($request->periodo_recambio_contrato);

        $contratodosi->save();

        for($i=1; $i<20; $i++){
            if($request->input('id_sede'.$i) != null){

                $contratoDosiSede = new Contratodosimetriasede();

                $contratoDosiSede->contratodosimetria_id = $contratodosi->id_contratodosimetria;
                $contratoDosiSede->sede_id               = $request->input('id_sede'.$i)[0];

                $contratoDosiSede->save();

                $longitudepto = count($request->input('departamentos_sede'.$i));
                //return $longitudepto ;
                for($x=0; $x<$longitudepto; $x++){
                    $contratoDosiSedeDepto = new Contratodosimetriasededepto();

                    $contratoDosiSedeDepto->contratodosimetriasede_id = $contratoDosiSede->id_contratodosimetriasede;
                    $contratoDosiSedeDepto->departamentosede_id       = $request->input('departamentos_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_control              = $request->input('dosimetro_control_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_torax                = $request->input('dosimetro_torax_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_area                 = $request->input('dosimetro_area_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_caso                 = $request->input('dosimetro_caso_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_cristalino           = $request->input('dosimetro_cristalino_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_muñeca               = $request->input('dosimetro_muneca_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_dedo                 = $request->input('dosimetro_dedo_sede'.$i)[$x];

                    $contratoDosiSedeDepto->save();
                }
            }else{
                break;
            }
        }
        return redirect()->route('contratosdosi.createlist', $request->empresa_contrato)->with('actualizar', 'ok');
    }
    public function updateContsedepto(Request $request, $contratodosisede, $contratodosisededepto){
         
        /* return $request; */
         $request->validate([
            'id_sede'               => 'required',
            'departamento_sede'     => 'required',
            'id_contrato'           => 'required',
        ]);

        $contdosisede = Contratodosimetriasede::find($contratodosisede);

        $contdosisede->sede_id                  = $request->id_sede;
        $contdosisede->contratodosimetria_id    = $request->id_contrato;
        $contdosisede->save();

        $contdosisededepto = Contratodosimetriasededepto::find($contratodosisededepto);

        $contdosisededepto->contratodosimetriasede_id   = $contratodosisede;
        $contdosisededepto->departamentosede_id         = $request->departamento_sede;
        $contdosisededepto->dosi_control                = $request->num_dosi_control_contrato_sede;
        $contdosisededepto->dosi_torax                  = $request->num_dosi_torax_contrato_sede;
        $contdosisededepto->dosi_area                   = $request->num_dosi_area_contrato_sede;
        $contdosisededepto->dosi_caso                   = $request->num_dosi_caso_contrato_sede;
        $contdosisededepto->dosi_cristalino             = $request->num_dosi_cristalino_contrato_sede;
        $contdosisededepto->dosi_muñeca                 = $request->num_dosi_muneca_contrato_sede;
        $contdosisededepto->dosi_dedo                   = $request->num_dosi_dedo_contrato_sede;

        $contdosisededepto->save(); 

        return redirect()->route('contratosdosi.edit', ['empresadosi' => $request->empresa_contrato, 'contratodosi' => $request->id_contrato])->with('actualizar', 'ok');
    }
    public function destroyContratodosi($empresadosi, $contratodosi){
        
        /* SELECT * FROM `dosimetriacontratos` INNER JOIN contratodosimetriasedes ON dosimetriacontratos.id_contratodosimetria = contratodosimetriasedes.contratodosimetria_id 
        INNER JOIN contratodosimetriasededeptos ON contratodosimetriasedes.id_contratodosimetriasede = contratodosimetriasededeptos.contratodosimetriasede_id 
        INNER JOIN dosicontrolcontdosisedes ON contratodosimetriasededeptos.id_contdosisededepto = dosicontrolcontdosisedes.contdosisededepto_id 
        INNER JOIN dosimetros ON trabajadordosimetros.dosimetro_id = dosimetros.id_dosimetro 
        WHERE dosimetriacontratos.id_contratodosimetria = 1;*/
         $new_estado='STOCK';
        $destroyDosicontrolasig =  Dosimetriacontrato::join('contratodosimetriasedes', 'id_contratodosimetria', '=', 'contratodosimetria_id')
        ->join('contratodosimetriasededeptos', 'id_contratodosimetriasede', '=', 'contratodosimetriasede_id')
        ->join('dosicontrolcontdosisedes', 'id_contdosisededepto', '=', 'contdosisededepto_id')
        ->join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
        ->where('id_contratodosimetria', '=', $contratodosi)
        ->update([
            'estado_dosimetro' => $new_estado
        ]);
        
        $destroyDosiasig = Dosimetriacontrato::join('contratodosimetriasedes', 'id_contratodosimetria', '=', 'contratodosimetria_id')
        ->join('contratodosimetriasededeptos', 'id_contratodosimetriasede', '=', 'contratodosimetriasede_id')
        ->join('trabajadordosimetros', 'id_contdosisededepto', '=', 'contdosisededepto_id')
        ->join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
        ->where('id_contratodosimetria', '=', $contratodosi)
        ->update([
            'estado_dosimetro' => $new_estado
        ]);
        $numContratoDosiSedeDepto = Dosimetriacontrato::join('contratodosimetriasedes', 'id_contratodosimetria', '=', 'contratodosimetria_id')
        ->join('contratodosimetriasededeptos', 'id_contratodosimetriasede', '=', 'contratodosimetriasede_id')
        ->where('id_contratodosimetria', '=', $contratodosi)
        ->get();
        $numtotalEmpresasDosi = ContratosDosimetriaEmpresa::where('empresa_id', '=', $empresadosi)->get();
        foreach($numContratoDosiSedeDepto as $numDosiSedDepto){

            foreach($numtotalEmpresasDosi as $totalEmpDosi){
    
                $totalEmpDosi->numtotal_dosi_torax      = ($totalEmpDosi->numtotal_dosi_torax - $numDosiSedDepto->dosi_torax );
                $totalEmpDosi->numtotal_dosi_cristalino = ($totalEmpDosi->numtotal_dosi_cristalino - $numDosiSedDepto->dosi_cristalino);
                $totalEmpDosi->numtotal_dosi_dedo       = ($totalEmpDosi->numtotal_dosi_dedo - $numDosiSedDepto->dosi_dedo);
                $totalEmpDosi->numtotal_dosi_muñeca     = ($totalEmpDosi->numtotal_dosi_muñeca - $numDosiSedDepto->dosi_muñeca);
                $totalEmpDosi->numtotal_dosi_control    = ($totalEmpDosi->numtotal_dosi_control - $numDosiSedDepto->dosi_control);
                $totalEmpDosi->numtotal_dosi_ambiental  = ($totalEmpDosi->numtotal_dosi_ambiental - $numDosiSedDepto->dosi_area);
                $totalEmpDosi->numtotal_dosi_caso       = ($totalEmpDosi->numtotal_dosi_caso - $numDosiSedDepto->dosi_caso);
                $totalEmpDosi->save();
            }
        }
        
        $contratodosi = Dosimetriacontrato::find($contratodosi);
        $contratodosi->delete();

        return redirect()->route('contratosdosi.createlist', $empresadosi)->with('eliminar', 'ok');
        /* return $destroyDosiasig; */
    }

    public function destroyContdosisedepto($detcont, $contratodosisede, $contratodosisededepto){
        /* return $contratodosisededepto; */
        /* $contdosisede = Contratodosimetriasededepto::find($contratodosisededepto);
        $contdosisede->delete();

        
        return redirect()->route('detallecontrato.create', $detcont)->with('eliminar', 'ok'); */
    }

    /* public function createTrabajadorSede(Request $request) {
        $request->validate([
            'idTrabajador'            => 'required',
            'id_sede_asigdosim'      => 'required',

        ]);

            $trabajadorNuevo = new Trabajadorsede();
            $trabajadorNuevo->trabajador_id = $request->idTrabajador;
            $trabajadorNuevo->sede_id = $request->id_sede_asigdosim;
            $trabajadorNuevo->save();
        return redirect()->route('asignadosicontrato.create',['asigdosicont' =>$request->contratoId, 'mesnumber'=> $request->mesnumber] );
    } */

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
            ->join('departamentos', 'departamento_id', '=', 'id_departamento')
            ->select('nombre_empresa', 'nombre_sede', 'codigo_contrato','fecha_inicio', 'fecha_finalizacion', 'periodo_recambio','nombre_departamento', 'mes_actual', 'dosi_torax', 'dosi_control', 'dosi_area', 'dosi_caso', 'dosi_cristalino', 'dosi_muñeca', 'dosi_dedo', 'id_contdosisededepto', 'contratodosimetriasede_id', 'id_contratodosimetria') 
            ->where('id_contratodosimetria', '=', $id)
            ->get();

        return view('dosimetria.detalle_contrato_dosimetria', compact('dosimetriacontrato', 'dosimecontrasedeptos'));
        /* return $dosimecontrasedeptos; */
    }

    public function createdetsedeContrato($id){
        $dosisededeptocontra = Contratodosimetriasededepto::find($id);
        $mescontdosisededepto = Mesescontdosisedeptos::where('contdosisededepto_id', '=', $id)->latest()->first();
        /* $mesesdosisedeptocontra = Mesescontdosisedeptos::where('contdosisededepto_id', '=', $id)->get(); */
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
        $mes1AssignRev = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', 1)
        ->get();
        $mesAssignRev2 = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', 2)
        ->get();
        $mesAssignRev3 = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', 3)
        ->get();
        $mesAssignRev4 = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', 4)
        ->get();
        $mesAssignRev5 = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', 5)
        ->get();
        $mesAssignRev6 = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', 6)
        ->get();
        $mesAssignRev7 = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', 7)
        ->get();
        $mesAssignRev8 = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', 8)
        ->get();
        $mesAssignRev9 = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', 9)
        ->get();
        $mesAssignRev10 = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', 10)
        ->get();
        $mesAssignRev11 = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', 11)
        ->get();
        $mesAssignRev12 = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', 12)
        ->get();
        $mesesAssig = [
            $mes1AssignRev, $mesAssignRev2,
            $mesAssignRev3, $mesAssignRev4,
            $mesAssignRev5, $mesAssignRev6,
            $mesAssignRev7, $mesAssignRev8,
            $mesAssignRev9, $mesAssignRev10,
            $mesAssignRev11, $mesAssignRev12
        ];
        
        return view('dosimetria.detalle_sede_contrato_dosimetria', compact('dosisededeptocontra', 'trabjasigcontra', 'mesTotal', 'mescontdosisededepto', 'mes1AssignRev', 'mesesAssig'));
        /* return $mescontdosisededepto; */
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
            ->where('mes_asignacion', ($mesnumber-1))
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
        /* $request->validate([
            'primerDia_asigdosim'        => 'required',
            'ultimoDia_asigdosim'        => 'required',
            'fecha_envio_dosim_asignado' => 'required',
            'id_trabajador_asigdosim'    => 'required',
            'id_dosimetro_asigdosim'     => 'required',
            'id_holder_asigdosim'        => 'required',
            'ocupacion_asigdosim'        => 'required',

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
        $dosimetrosTotal = json_encode($dosimetrosTotal); */
        //return redirect()->route('detallesedecont.create', $request->id_contrato_asigdosim);

          /* return $this->callAction('patchDosimetroStock',['idDosimetro' =>$dosimetrosTotal,
             'contratoId'=> $request->id_contrato_asigdosim, 'mesnumber'=>$request->mesNumber1 ]); */
        return $request;
        /*return route('dosimetroStock.patch',  ['idDosimetro' =>$dosimetrosTotal,
            'contratoId'=> $request->id_contrato_asigdosim, 'mesnumber'=>$request->mesNumber1 ] );*/
        //return $request;
    }
    public function asignaDosiContratoM1($id, $mesnumber){ 
        $contdosisededepto = Contratodosimetriasededepto::find($id);
        $trabajadoreSede = Trabajadorsede::where('sede_id', '=', $contdosisededepto->contratodosimetriasede->sede->id_sede)
        ->get();
        $personaSede = Persona::join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
        ->join('personasroles', 'personas.id_persona', '=', 'personasroles.persona_id')
        ->join('roles', 'personasroles.rol_id', '=', 'roles.id_rol')
        ->where('personasedes.sede_id','=', $contdosisededepto->contratodosimetriasede->sede->id_sede)
        ->where(function($query) {
            $query->orWhere('roles.nombre_rol', 'TOE')
                  ->orWhere('roles.nombre_rol', 'OPR');
        })->get();
        $dosimLibresGeneral = Dosimetro::where('estado_dosimetro', 'STOCK')
        ->where('tipo_dosimetro', 'GENERAL')
        ->get();
        $areaSede = Areadepartamentosede::where('departamentosede_id', $contdosisededepto->departamentosede_id)
        ->get();
        $dosimLibresAmbiental = Dosimetro::where('estado_dosimetro', 'STOCK')
        ->where('tipo_dosimetro', 'AMBIENTAL')
        ->get();
        $dosimLibresEzclip = Dosimetro::where('estado_dosimetro', 'STOCK')
        ->where('tipo_dosimetro', 'EZCLIP')
        ->get();
        $holderLibresCristalino = Holder::where('estado_holder', 'STOCK')
        ->where('tipo_holder', 'CRISTALINO')
        ->get();
        $holderLibresExtrem = Holder::where('estado_holder', 'STOCK')
        ->where('tipo_holder', 'EXTREM')
        ->get();
        $holderLibresAnillo = Holder::where('estado_holder', 'STOCK')
        ->where('tipo_holder', 'ANILLO')
        ->get();
        return view('dosimetria.asignar_dosimetro_contrato_m1', compact('mesnumber','contdosisededepto', 'dosimLibresGeneral', 'areaSede', 'dosimLibresAmbiental', 'trabajadoreSede', 'personaSede', 'dosimLibresEzclip', 'holderLibresCristalino', 'holderLibresExtrem', 'holderLibresAnillo'));
        /* return $personaSede; */
    }
    public function saveAsignacionDosiContratoM1(Request $request, $asigdosicont, $mesnumber){
        /* return $request; */
      
        ////////////////// SAVE DE DOSIMETRO TIPO  CONTROL  /////////////////////////

        if(!empty($request->id_dosimetro_asigdosimControl)){

            for($i=0; $i<count($request->id_dosimetro_asigdosimControl); $i++){
                $asigdosim_control = new Dosicontrolcontdosisede();
    
                $asigdosim_control->dosimetro_id                = $request->id_dosimetro_asigdosimControl[$i];
                $asigdosim_control->contratodosimetriasede_id   = $request->id_contrato_asigdosim_sede;
                $asigdosim_control->contdosisededepto_id        = $request->id_departamento_asigdosim;
                $asigdosim_control->mes_asignacion              = $request->mesNumber1;
                $asigdosim_control->dosimetro_uso               = 'TRUE';
                $asigdosim_control->primer_dia_uso              = $request->primerDia_asigdosim;
                $asigdosim_control->ultimo_dia_uso              = $request->ultimoDia_asigdosim;
                $asigdosim_control->fecha_dosim_enviado         = $request->fecha_envio_dosim_asignado;
                $asigdosim_control->fecha_dosim_recibido        = $request->fecha_recibido_dosim_asignado;
                $asigdosim_control->fecha_dosim_devuelto        = $request->fecha_devuelto_dosim_asignado;
                $asigdosim_control->ocupacion                   = $request->ocupacion_asigdosimControl[$i];
                $asigdosim_control->energia                     = $request->energia_asigdosim;
    
                $asigdosim_control->save();
                $estadoDosimControl = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimControl[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro'    => 'CONTROL'
                ]);
            }
            
        }

        ////////////////// SAVE DE DOSIMETRO TIPO TORAX  /////////////////////////.
        if(!empty($request->id_trabajador_asigdosimTorax)){

            for($i=0; $i<count($request->id_trabajador_asigdosimTorax); $i++){
    
                $asigdosimTorax = new Trabajadordosimetro();
    
                $asigdosimTorax->contratodosimetriasede_id = $request->id_contrato_asigdosim_sede;
                $asigdosimTorax->persona_id                = $request->id_trabajador_asigdosimTorax[$i];
                $asigdosimTorax->dosimetro_id              = $request->id_dosimetro_asigdosimTorax[$i];
                $asigdosimTorax->contdosisededepto_id      = $request->id_departamento_asigdosim;
                $asigdosimTorax->mes_asignacion            = $request->mesNumber1;
                $asigdosimTorax->dosimetro_uso             = 'TRUE';
                $asigdosimTorax->primer_dia_uso            = $request->primerDia_asigdosim;
                $asigdosimTorax->ultimo_dia_uso            = $request->ultimoDia_asigdosim;
                $asigdosimTorax->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado;
                $asigdosimTorax->fecha_dosim_recibido      = $request->fecha_recibido_dosim_asignado;
                $asigdosimTorax->fecha_dosim_devuelto      = $request->fecha_devuelto_dosim_asignado;
                $asigdosimTorax->ocupacion                 = $request->ocupacion_asigdosimTorax[$i];
                $asigdosimTorax->ubicacion                 = 'TORAX';
                $asigdosimTorax->energia                   = $request->energia_asigdosim;
    
                $asigdosimTorax->save();
                $estadoDosimTorax = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimTorax[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro'    => 'TORAX'
                ]);
            }
        }

        ///////////////SAVE DE DOSIMETRO TIPO AREA //////////////////////
        if(!empty($request->id_area_asigdosimArea)){
            for($i=0; $i<count($request->id_area_asigdosimArea); $i++){

                $asigdosimArea = new Dosiareacontdosisede();

                $asigdosimArea->areadepartamentosede_id     = $request->id_area_asigdosimArea[$i];
                $asigdosimArea->dosimetro_id                = $request->id_dosimetro_asigdosimArea[$i];
                $asigdosimArea->contratodosimetriasede_id   = $request->id_contrato_asigdosim_sede;
                $asigdosimArea->contdosisededepto_id        = $request->id_departamento_asigdosim;
                $asigdosimArea->mes_asignacion              = $request->mesNumber1;
                $asigdosimArea->dosimetro_uso               = 'TRUE';
                $asigdosimArea->primer_dia_uso              = $request->primerDia_asigdosim;
                $asigdosimArea->ultimo_dia_uso              = $request->ultimoDia_asigdosim;
                $asigdosimArea->fecha_dosim_enviado         = $request->fecha_envio_dosim_asignado;
                $asigdosimArea->fecha_dosim_recibido        = $request->fecha_recibido_dosim_asignado;
                $asigdosimArea->fecha_dosim_devuelto        = $request->fecha_devuelto_dosim_asignado;
                $asigdosimArea->ocupacion                   = $request->ocupacion_asigdosimArea[$i];
                $asigdosimArea->energia                     = $request->energia_asigdosim;

                $asigdosimArea->save();
                $estadoDosimArea = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimArea[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro'    => 'AREA'
                ]);
            } 
        }

        ////////////SAVE DE DOSIMETRO TIPO CASO ///////////
        if(!empty($request->id_trabajador_asigdosimCaso)){
            for($i=0; $i<count($request->id_trabajador_asigdosimCaso); $i++){

                $asigdosimCaso = new Trabajadordosimetro();

                $asigdosimCaso->contratodosimetriasede_id = $request->id_contrato_asigdosim_sede;
                $asigdosimCaso->persona_id                = $request->id_trabajador_asigdosimCaso[$i];
                $asigdosimCaso->dosimetro_id              = $request->id_dosimetro_asigdosimCaso[$i];
                $asigdosimCaso->contdosisededepto_id      = $request->id_departamento_asigdosim;
                $asigdosimCaso->mes_asignacion            = $request->mesNumber1;
                $asigdosimCaso->dosimetro_uso             = 'TRUE';
                $asigdosimCaso->primer_dia_uso            = $request->primerDia_asigdosim;
                $asigdosimCaso->ultimo_dia_uso            = $request->ultimoDia_asigdosim;
                $asigdosimCaso->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado;
                $asigdosimCaso->fecha_dosim_recibido      = $request->fecha_recibido_dosim_asignado;
                $asigdosimCaso->fecha_dosim_devuelto      = $request->fecha_devuelto_dosim_asignado;
                $asigdosimCaso->ocupacion                 = $request->ocupacion_asigdosimCaso[$i];
                $asigdosimCaso->ubicacion                 = 'CASO';
                $asigdosimCaso->energia                   = $request->energia_asigdosim;
    
                $asigdosimCaso->save();
                $estadoDosimCaso = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimCaso[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro'    => 'CASO'
                ]);
            } 
        }
        ////////////////// SAVE DE DOSIMETRO TIPO CRISTALINO ///////////////

        if(!empty($request->id_trabajador_asigdosimCristalino)){
            for($i=0; $i<count($request->id_trabajador_asigdosimCristalino); $i++){

                $asigdosimCristalino = new Trabajadordosimetro();

                $asigdosimCristalino->contratodosimetriasede_id = $request->id_contrato_asigdosim_sede;
                $asigdosimCristalino->persona_id                = $request->id_trabajador_asigdosimCristalino[$i];
                $asigdosimCristalino->dosimetro_id              = $request->id_dosimetro_asigdosimCristalino[$i];
                $asigdosimCristalino->holder_id                 = $request->id_holder_asigdosimCristalino[$i];
                $asigdosimCristalino->contdosisededepto_id      = $request->id_departamento_asigdosim;
                $asigdosimCristalino->mes_asignacion            = $request->mesNumber1;
                $asigdosimCristalino->dosimetro_uso             = 'TRUE';
                $asigdosimCristalino->primer_dia_uso            = $request->primerDia_asigdosim;
                $asigdosimCristalino->ultimo_dia_uso            = $request->ultimoDia_asigdosim;
                $asigdosimCristalino->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado;
                $asigdosimCristalino->fecha_dosim_recibido      = $request->fecha_recibido_dosim_asignado;
                $asigdosimCristalino->fecha_dosim_devuelto      = $request->fecha_devuelto_dosim_asignado;
                $asigdosimCristalino->ocupacion                 = $request->ocupacion_asigdosimCristalino[$i];
                $asigdosimCristalino->ubicacion                 = 'CRISTALINO';
                $asigdosimCristalino->energia                   = $request->energia_asigdosim;
    
                $asigdosimCristalino->save();
                $estadoDosimCristalino = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimCristalino[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro'    => 'CRISTALINO'
                ]);
                $estadoHolderCristalino = Holder::where('id_holder', '=', $request->id_holder_asigdosimCristalino[$i])
                ->update([
                    'estado_holder'    => 'EN USO',
                ]);
            } 
        }
        ////////////////// SAVE DE DOSIMETRO TIPO MUÑECA ///////////////

        if(!empty($request->id_trabajador_asigdosimMuneca)){
            for($i=0; $i<count($request->id_trabajador_asigdosimMuneca); $i++){

                $asigdosimMuneca = new Trabajadordosimetro();

                $asigdosimMuneca->contratodosimetriasede_id = $request->id_contrato_asigdosim_sede;
                $asigdosimMuneca->persona_id                = $request->id_trabajador_asigdosimMuneca[$i];
                $asigdosimMuneca->dosimetro_id              = $request->id_dosimetro_asigdosimMuneca[$i];
                $asigdosimMuneca->holder_id                 = $request->id_holder_asigdosimMuneca[$i];
                $asigdosimMuneca->contdosisededepto_id      = $request->id_departamento_asigdosim;
                $asigdosimMuneca->mes_asignacion            = $request->mesNumber1;
                $asigdosimMuneca->dosimetro_uso             = 'TRUE';
                $asigdosimMuneca->primer_dia_uso            = $request->primerDia_asigdosim;
                $asigdosimMuneca->ultimo_dia_uso            = $request->ultimoDia_asigdosim;
                $asigdosimMuneca->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado;
                $asigdosimMuneca->fecha_dosim_recibido      = $request->fecha_recibido_dosim_asignado;
                $asigdosimMuneca->fecha_dosim_devuelto      = $request->fecha_devuelto_dosim_asignado;
                $asigdosimMuneca->ocupacion                 = $request->ocupacion_asigdosimMuneca[$i];
                $asigdosimMuneca->ubicacion                 = 'MUÑECA';
                $asigdosimMuneca->energia                   = $request->energia_asigdosim;
    
                $asigdosimMuneca->save();
                $estadoDosimMuneca = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimMuneca[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro'    => 'MUÑECA'
                ]);
                $estadoHolderMuneca = Holder::where('id_holder', '=', $request->id_holder_asigdosimMuneca[$i])
                ->update([
                    'estado_holder'    => 'EN USO',
                ]);
            } 
        }
        ////////////////// SAVE DE DOSIMETRO TIPO DEDO ///////////////

        if(!empty($request->id_trabajador_asigdosimDedo)){
            for($i=0; $i<count($request->id_trabajador_asigdosimDedo); $i++){

                $asigdosimDedo = new Trabajadordosimetro();

                $asigdosimDedo->contratodosimetriasede_id = $request->id_contrato_asigdosim_sede;
                $asigdosimDedo->persona_id                = $request->id_trabajador_asigdosimDedo[$i];
                $asigdosimDedo->dosimetro_id              = $request->id_dosimetro_asigdosimDedo[$i];
                $asigdosimDedo->holder_id                 = $request->id_holder_asigdosimDedo[$i];
                $asigdosimDedo->contdosisededepto_id      = $request->id_departamento_asigdosim;
                $asigdosimDedo->mes_asignacion            = $request->mesNumber1;
                $asigdosimDedo->dosimetro_uso             = 'TRUE';
                $asigdosimDedo->primer_dia_uso            = $request->primerDia_asigdosim;
                $asigdosimDedo->ultimo_dia_uso            = $request->ultimoDia_asigdosim;
                $asigdosimDedo->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado;
                $asigdosimDedo->fecha_dosim_recibido      = $request->fecha_recibido_dosim_asignado;
                $asigdosimDedo->fecha_dosim_devuelto      = $request->fecha_devuelto_dosim_asignado;
                $asigdosimDedo->ocupacion                 = $request->ocupacion_asigdosimDedo[$i];
                $asigdosimDedo->ubicacion                 = 'ANILLO';
                $asigdosimDedo->energia                   = $request->energia_asigdosim;
    
                $asigdosimDedo->save();
                $estadoDosimDedo = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimDedo[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro'    => 'ANILLO'
                ]);
                $estadoHolderDedo = Holder::where('id_holder', '=', $request->id_holder_asigdosimDedo[$i])
                ->update([
                    'estado_holder'    => 'EN USO',
                ]);
            } 
        }

        return redirect()->route('asignadosicontrato.info', ["asigdosicont" => $asigdosicont, "mesnumber" => $mesnumber])->with('crear', 'ok');
    }
    public function asignaDosiContratoMn($id, $mesnumber){
        $contdosisededepto = Contratodosimetriasededepto::find($id);
        $mescontdosisededepto = Mesescontdosisedeptos::where('contdosisededepto_id', '=', $id)->latest()->first();
        $trabajadoreSede = Trabajadorsede::where('sede_id', '=', $contdosisededepto->contratodosimetriasede->sede->id_sede)
        ->get();
        $personaSede = Persona::join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
        ->join('personasroles', 'personas.id_persona', '=', 'personasroles.persona_id')
        ->join('roles', 'personasroles.rol_id', '=', 'roles.id_rol')
        ->where('personasedes.sede_id','=', $contdosisededepto->contratodosimetriasede->sede->id_sede)
        ->where(function($query) {
            $query->orWhere('roles.nombre_rol', 'TOE')
                  ->orWhere('roles.nombre_rol', 'OPR');
        })->get();
        $dosimLibresGeneral = Dosimetro::where('estado_dosimetro', 'STOCK')
        ->where('tipo_dosimetro', 'GENERAL')
        ->get();
        $areaSede = Areadepartamentosede::where('departamentosede_id', $contdosisededepto->departamentosede_id)
        ->get();
        $dosimLibresAmbiental = Dosimetro::where('estado_dosimetro', 'STOCK')
        ->where('tipo_dosimetro', 'AMBIENTAL')
        ->get();
        $dosimLibresEzclip = Dosimetro::where('estado_dosimetro', 'STOCK')
        ->where('tipo_dosimetro', 'EZCLIP')
        ->get();
        $holderLibresCristalino = Holder::where('estado_holder', 'STOCK')
        ->where('tipo_holder', 'CRISTALINO')
        ->get();
        $holderLibresExtrem = Holder::where('estado_holder', 'STOCK')
        ->where('tipo_holder', 'EXTREM')
        ->get();
        $holderLibresAnillo = Holder::where('estado_holder', 'STOCK')
        ->where('tipo_holder', 'ANILLO')
        ->get();
        
        $dosicontrolmesant = Dosicontrolcontdosisede::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber-1)
        ->get();
        $dosiareamesant = Dosiareacontdosisede::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber-1)
        ->get();
        $dosicasomesant = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber-1)
        ->where('ubicacion', 'CASO')
        ->get();
        $dositoraxmesant = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber-1)
        ->where('ubicacion', 'TORAX')
        ->get();
        
       /* if($mescontdosisededepto->mes_asignacion == $mesnumber){
            
            $dosicristalinomesant = Mesescontdosisedeptos::join('trabajadordosimetros', 'mesescontdosisedeptos.contdosisededepto_id', '=', 'trabajadordosimetros.contdosisededepto_id')
            ->where('trabajadordosimetros.contdosisededepto_id', $id)
            ->where('trabajadordosimetros.mes_asignacion', $mesnumber-1)
            ->where('trabajadordosimetros.ubicacion', 'CRISTALINO')
            ->where('mesescontdosisedeptos.mes_asignacion', $mesnumber)
            ->select('*')
            ->get();
            
        }else{
            $dosicristalinomesant = Trabajadordosimetro::where('contdosisededepto_id', $id)
            ->where('mes_asignacion', $mesnumber-1)
            ->where('ubicacion', 'CRISTALINO')
            ->get();
        } */
        $dosicristalinomesant = Trabajadordosimetro::where('contdosisededepto_id', $id)
            ->where('mes_asignacion', $mesnumber-1)
            ->where('ubicacion', 'CRISTALINO')
            ->get();
        $dosimuñecamesant = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber-1)
        ->where('ubicacion', 'MUÑECA')
        ->get();
        $dosidedomesant = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber-1)
        ->where('ubicacion', 'ANILLO')
        ->get();
        
        
        return view('dosimetria.asignar_dosimetro_contrato_mn', compact('mesnumber', 'mescontdosisededepto', 'contdosisededepto', 'dosimLibresGeneral',
         'areaSede', 'dosimLibresAmbiental', 'trabajadoreSede', 'personaSede', 'dosimLibresEzclip', 'holderLibresCristalino', 'holderLibresExtrem', 
         'holderLibresAnillo', 'dosicontrolmesant', 'dosiareamesant', 'dosicasomesant', 'dositoraxmesant', 'dosicristalinomesant', 'dosimuñecamesant', 'dosidedomesant' ));
        /* return $contdosisededepto; */
    }

    public function clearAsignacionAnteriorMn($id, $mesnumber){
       /*  $contdosisededepto = Contratodosimetriasededepto::find($id); */
        /* return $contdosisededepto; */
        $cleardosicontrolasigmesant = Dosicontrolcontdosisede::where('contdosisededepto_id', $id)
        ->update([
            'dosimetro_uso' => 'FALSE'
        ]);
        $cleardosiareasigmesant = Dosiareacontdosisede::where('contdosisededepto_id', $id)
        ->update([
            'dosimetro_uso' => 'FALSE'
        ]);
        $cleardositrabajasigmesant = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->update([
            'dosimetro_uso' => 'FALSE'
        ]);

        return redirect()->back()->with('clear', 'ok');
    }
    public function saveAsignacionDosiContratoMn($id, $mesnumber, Request $request){
        /* return $request; */
        
        
        $request->validate([
            'primerDia_asigdosim'        => 'required',
            'ultimoDia_asigdosim'        => 'required',
            'fecha_envio_dosim_asignado' => 'required',
        ]);

        //////////////////ACTUALZAR TABLA CONTRATODOSIMETRIASEDEDEPTOS /////////////////////////
        $dosi_control = empty($request->id_dosimetro_asigdosimControl)  ? 0 : count($request->id_dosimetro_asigdosimControl);
        $dosi_torax = empty($request->id_trabajador_asigdosimTorax)  ? 0 : count($request->id_trabajador_asigdosimTorax);
        $dosi_area = empty($request->id_area_asigdosimArea)  ? 0 : count($request->id_area_asigdosimArea);
        $dosi_caso = empty($request->id_trabajador_asigdosimCaso) ? 0 : count($request->id_trabajador_asigdosimCaso);
        $dosi_cristalino = empty($request->id_trabajador_asigdosimCristalino) ? 0 : count($request->id_trabajador_asigdosimCristalino);
        $dosi_muñeca = empty($request->id_trabajador_asigdosimMuneca) ? 0 : count($request->id_trabajador_asigdosimMuneca);
        $dosi_dedo = empty($request->id_trabajador_asigdosimDedo) ? 0: count($request->id_trabajador_asigdosimDedo);
        $updatecontratoDosisedepto = Contratodosimetriasededepto::where('id_contdosisededepto', $id)
        ->update([
            'mes_actual'    => $mesnumber,
            'dosi_control'  => $dosi_control,
            'dosi_torax'    => $dosi_torax,
            'dosi_area'     => $dosi_area,
            'dosi_caso'     => $dosi_caso,
            'dosi_cristalino' => $dosi_cristalino,
            'dosi_muñeca'   => $dosi_muñeca,
            'dosi_dedo'     => $dosi_dedo
        ]);
        ////////////////// SAVE DE DOSIMETRO TIPO  CONTROL  /////////////////////////
        if(!empty($request->id_dosimetro_asigdosimControl)){

            for($i=0; $i<count($request->id_dosimetro_asigdosimControl); $i++){
                $asigdosim_control = new Dosicontrolcontdosisede();
    
                $asigdosim_control->dosimetro_id                = $request->id_dosimetro_asigdosimControl[$i];
                $asigdosim_control->contratodosimetriasede_id   = $request->id_contrato_asigdosim_sede;
                $asigdosim_control->contdosisededepto_id        = $request->id_departamento_asigdosim;
                $asigdosim_control->mes_asignacion              = $request->mesNumber1;
                $asigdosim_control->dosimetro_uso               = 'TRUE';
                $asigdosim_control->primer_dia_uso              = $request->primerDia_asigdosim;
                $asigdosim_control->ultimo_dia_uso              = $request->ultimoDia_asigdosim;
                $asigdosim_control->fecha_dosim_enviado         = $request->fecha_envio_dosim_asignado;
                $asigdosim_control->fecha_dosim_recibido        = $request->fecha_recibido_dosim_asignado;
                $asigdosim_control->fecha_dosim_devuelto        = $request->fecha_devuelto_dosim_asignado;
                $asigdosim_control->ocupacion                   = $request->ocupacion_asigdosimControl[$i];
                $asigdosim_control->energia                     = $request->energia_asigdosim;
    
                $asigdosim_control->save();

                $estadoDosimControl = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimControl[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro'    => 'CONTROL'
                ]);
                $estadoDosimControlmesant = Dosicontrolcontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                ->where('contdosisededepto_id', $id)
                ->where('mes_asignacion', $mesnumber-1)
                ->update([
                    'estado_dosimetro' => 'EN LECTURA',
                ]);
                
            }
        }

        ////////////////// SAVE DE DOSIMETRO TIPO TORAX  /////////////////////////.
        if(!empty($request->id_trabajador_asigdosimTorax)){

            for($i=0; $i<count($request->id_trabajador_asigdosimTorax); $i++){
    
                $asigdosimTorax = new Trabajadordosimetro();
    
                $asigdosimTorax->contratodosimetriasede_id = $request->id_contrato_asigdosim_sede;
                $asigdosimTorax->persona_id                = $request->id_trabajador_asigdosimTorax[$i];
                $asigdosimTorax->dosimetro_id              = $request->id_dosimetro_asigdosimTorax[$i];
                $asigdosimTorax->contdosisededepto_id      = $request->id_departamento_asigdosim;
                $asigdosimTorax->mes_asignacion            = $request->mesNumber1;
                $asigdosimTorax->dosimetro_uso             = 'TRUE';
                $asigdosimTorax->primer_dia_uso            = $request->primerDia_asigdosim;
                $asigdosimTorax->ultimo_dia_uso            = $request->ultimoDia_asigdosim;
                $asigdosimTorax->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado;
                $asigdosimTorax->fecha_dosim_recibido      = $request->fecha_recibido_dosim_asignado;
                $asigdosimTorax->fecha_dosim_devuelto      = $request->fecha_devuelto_dosim_asignado;
                $asigdosimTorax->ocupacion                 = $request->ocupacion_asigdosimTorax[$i];
                $asigdosimTorax->ubicacion                 = 'TORAX';
                $asigdosimTorax->energia                   = $request->energia_asigdosim;
    
                $asigdosimTorax->save();
                $estadoDosimTorax = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimTorax[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro'    => 'TORAX'
                ]);
                $estadoDosimToraxmesant = Trabajadordosimetro::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                ->where('contdosisededepto_id', $id)
                ->where('mes_asignacion', $mesnumber-1)
                ->update([
                    'estado_dosimetro' => 'EN LECTURA',
                ]);
            }
        }
        ///////////////SAVE DE DOSIMETRO TIPO AREA //////////////////////
        if(!empty($request->id_area_asigdosimArea)){
            for($i=0; $i<count($request->id_area_asigdosimArea); $i++){

                $asigdosimArea = new Dosiareacontdosisede();

                $asigdosimArea->areadepartamentosede_id     = $request->id_area_asigdosimArea[$i];
                $asigdosimArea->dosimetro_id                = $request->id_dosimetro_asigdosimArea[$i];
                $asigdosimArea->contratodosimetriasede_id   = $request->id_contrato_asigdosim_sede;
                $asigdosimArea->contdosisededepto_id        = $request->id_departamento_asigdosim;
                $asigdosimArea->mes_asignacion              = $request->mesNumber1;
                $asigdosimArea->dosimetro_uso               = 'TRUE';
                $asigdosimArea->primer_dia_uso              = $request->primerDia_asigdosim;
                $asigdosimArea->ultimo_dia_uso              = $request->ultimoDia_asigdosim;
                $asigdosimArea->fecha_dosim_enviado         = $request->fecha_envio_dosim_asignado;
                $asigdosimArea->fecha_dosim_recibido        = $request->fecha_recibido_dosim_asignado;
                $asigdosimArea->fecha_dosim_devuelto        = $request->fecha_devuelto_dosim_asignado;
                $asigdosimArea->ocupacion                   = $request->ocupacion_asigdosimArea[$i];
                $asigdosimArea->energia                     = $request->energia_asigdosim;

                $asigdosimArea->save();
                $estadoDosimArea = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimArea[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro'    => 'AREA'
                ]);
                $estadoDosimAreamesant = Dosiareacontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                ->where('contdosisededepto_id', $id)
                ->where('mes_asignacion', $mesnumber-1)
                ->update([
                    'estado_dosimetro' => 'EN LECTURA',
                ]);
            } 
        }
        ////////////SAVE DE DOSIMETRO TIPO CASO ///////////
        if(!empty($request->id_trabajador_asigdosimCaso)){
            for($i=0; $i<count($request->id_trabajador_asigdosimCaso); $i++){

                $asigdosimCaso = new Trabajadordosimetro();

                $asigdosimCaso->contratodosimetriasede_id = $request->id_contrato_asigdosim_sede;
                $asigdosimCaso->persona_id                = $request->id_trabajador_asigdosimCaso[$i];
                $asigdosimCaso->dosimetro_id              = $request->id_dosimetro_asigdosimCaso[$i];
                $asigdosimCaso->contdosisededepto_id      = $request->id_departamento_asigdosim;
                $asigdosimCaso->mes_asignacion            = $request->mesNumber1;
                $asigdosimCaso->dosimetro_uso             = 'TRUE';
                $asigdosimCaso->primer_dia_uso            = $request->primerDia_asigdosim;
                $asigdosimCaso->ultimo_dia_uso            = $request->ultimoDia_asigdosim;
                $asigdosimCaso->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado;
                $asigdosimCaso->fecha_dosim_recibido      = $request->fecha_recibido_dosim_asignado;
                $asigdosimCaso->fecha_dosim_devuelto      = $request->fecha_devuelto_dosim_asignado;
                $asigdosimCaso->ocupacion                 = $request->ocupacion_asigdosimCaso[$i];
                $asigdosimCaso->ubicacion                 = 'CASO';
                $asigdosimCaso->energia                   = $request->energia_asigdosim;
    
                $asigdosimCaso->save();
                $estadoDosimCaso = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimCaso[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro'    => 'CASO'
                ]);
                $estadoDosimCasomesant = Trabajadordosimetro::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                ->where('contdosisededepto_id', $id)
                ->where('mes_asignacion', $mesnumber-1)
                ->update([
                    'estado_dosimetro' => 'EN LECTURA',
                ]);
            } 
        }
        ////////////////// SAVE DE DOSIMETRO TIPO CRISTALINO ///////////////
        if(!empty($request->id_trabajador_asigdosimCristalino)){
            for($i=0; $i<count($request->id_trabajador_asigdosimCristalino); $i++){

                $asigdosimCristalino = new Trabajadordosimetro();

                $asigdosimCristalino->contratodosimetriasede_id = $request->id_contrato_asigdosim_sede;
                $asigdosimCristalino->persona_id                = $request->id_trabajador_asigdosimCristalino[$i];
                $asigdosimCristalino->dosimetro_id              = $request->id_dosimetro_asigdosimCristalino[$i];
                $asigdosimCristalino->holder_id                 = $request->id_holder_asigdosimCristalino[$i];
                $asigdosimCristalino->contdosisededepto_id      = $request->id_departamento_asigdosim;
                $asigdosimCristalino->mes_asignacion            = $request->mesNumber1;
                $asigdosimCristalino->dosimetro_uso             = 'TRUE';
                $asigdosimCristalino->primer_dia_uso            = $request->primerDia_asigdosim;
                $asigdosimCristalino->ultimo_dia_uso            = $request->ultimoDia_asigdosim;
                $asigdosimCristalino->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado;
                $asigdosimCristalino->fecha_dosim_recibido      = $request->fecha_recibido_dosim_asignado;
                $asigdosimCristalino->fecha_dosim_devuelto      = $request->fecha_devuelto_dosim_asignado;
                $asigdosimCristalino->ocupacion                 = $request->ocupacion_asigdosimCristalino[$i];
                $asigdosimCristalino->ubicacion                 = 'CRISTALINO';
                $asigdosimCristalino->energia                   = $request->energia_asigdosim;
    
                $asigdosimCristalino->save();
                $estadoDosimCristalino = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimCristalino[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro'    => 'CRISTALINO'
                ]);
                $estadoHolderCristalino = Holder::where('id_holder', '=', $request->id_holder_asigdosimCristalino[$i])
                ->update([
                    'estado_holder'    => 'EN USO',
                ]);
                $estadoDosimCristalinomesant = Trabajadordosimetro::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                ->where('contdosisededepto_id', $id)
                ->where('mes_asignacion', $mesnumber-1)
                ->update([
                    'estado_dosimetro' => 'EN LECTURA',
                ]);
            } 
        }
        ////////////////// SAVE DE DOSIMETRO TIPO MUÑECA ///////////////
        if(!empty($request->id_trabajador_asigdosimMuneca)){
            for($i=0; $i<count($request->id_trabajador_asigdosimMuneca); $i++){

                $asigdosimMuneca = new Trabajadordosimetro();

                $asigdosimMuneca->contratodosimetriasede_id = $request->id_contrato_asigdosim_sede;
                $asigdosimMuneca->persona_id                = $request->id_trabajador_asigdosimMuneca[$i];
                $asigdosimMuneca->dosimetro_id              = $request->id_dosimetro_asigdosimMuneca[$i];
                $asigdosimMuneca->holder_id                 = $request->id_holder_asigdosimMuneca[$i];
                $asigdosimMuneca->contdosisededepto_id      = $request->id_departamento_asigdosim;
                $asigdosimMuneca->mes_asignacion            = $request->mesNumber1;
                $asigdosimMuneca->dosimetro_uso             = 'TRUE';
                $asigdosimMuneca->primer_dia_uso            = $request->primerDia_asigdosim;
                $asigdosimMuneca->ultimo_dia_uso            = $request->ultimoDia_asigdosim;
                $asigdosimMuneca->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado;
                $asigdosimMuneca->fecha_dosim_recibido      = $request->fecha_recibido_dosim_asignado;
                $asigdosimMuneca->fecha_dosim_devuelto      = $request->fecha_devuelto_dosim_asignado;
                $asigdosimMuneca->ocupacion                 = $request->ocupacion_asigdosimMuneca[$i];
                $asigdosimMuneca->ubicacion                 = 'MUÑECA';
                $asigdosimMuneca->energia                   = $request->energia_asigdosim;
    
                $asigdosimMuneca->save();
                $estadoDosimMuneca = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimMuneca[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro'    => 'MUÑECA'
                ]);
                $estadoHolderMuneca = Holder::where('id_holder', '=', $request->id_holder_asigdosimMuneca[$i])
                ->update([
                    'estado_holder'    => 'EN USO',
                ]);
                $estadoDosimMunecamesant = Trabajadordosimetro::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                ->where('contdosisededepto_id', $id)
                ->where('mes_asignacion', $mesnumber-1)
                ->update([
                    'estado_dosimetro' => 'EN LECTURA',
                ]);
            } 
        }
         ////////////////// SAVE DE DOSIMETRO TIPO DEDO ///////////////
        if(!empty($request->id_trabajador_asigdosimDedo)){
            for($i=0; $i<count($request->id_trabajador_asigdosimDedo); $i++){

                $asigdosimDedo = new Trabajadordosimetro();

                $asigdosimDedo->contratodosimetriasede_id = $request->id_contrato_asigdosim_sede;
                $asigdosimDedo->persona_id                = $request->id_trabajador_asigdosimDedo[$i];
                $asigdosimDedo->dosimetro_id              = $request->id_dosimetro_asigdosimDedo[$i];
                $asigdosimDedo->holder_id                 = $request->id_holder_asigdosimDedo[$i];
                $asigdosimDedo->contdosisededepto_id      = $request->id_departamento_asigdosim;
                $asigdosimDedo->mes_asignacion            = $request->mesNumber1;
                $asigdosimDedo->dosimetro_uso             = 'TRUE';
                $asigdosimDedo->primer_dia_uso            = $request->primerDia_asigdosim;
                $asigdosimDedo->ultimo_dia_uso            = $request->ultimoDia_asigdosim;
                $asigdosimDedo->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado;
                $asigdosimDedo->fecha_dosim_recibido      = $request->fecha_recibido_dosim_asignado;
                $asigdosimDedo->fecha_dosim_devuelto      = $request->fecha_devuelto_dosim_asignado;
                $asigdosimDedo->ocupacion                 = $request->ocupacion_asigdosimDedo[$i];
                $asigdosimDedo->ubicacion                 = 'ANILLO';
                $asigdosimDedo->energia                   = $request->energia_asigdosim;
    
                $asigdosimDedo->save();
                $estadoDosimDedo = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimDedo[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro'    => 'ANILLO'
                ]);
                $estadoHolderDedo = Holder::where('id_holder', '=', $request->id_holder_asigdosimDedo[$i])
                ->update([
                    'estado_holder'    => 'EN USO',
                ]);
                $estadoDosimDedomesant = Trabajadordosimetro::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                ->where('contdosisededepto_id', $id)
                ->where('mes_asignacion', $mesnumber-1)
                ->update([
                    'estado_dosimetro' => 'EN LECTURA',
                ]);
            } 
        }
        return redirect()->route('asignadosicontrato.info', ["asigdosicont" => $id, "mesnumber" => $mesnumber])->with('crear', 'ok');
    } 

    public function info($id, $mesnumber, Request $request){
        $contdosisededepto = Contratodosimetriasededepto::find($id);
        $mescontdosisededepto = Mesescontdosisedeptos::where('contdosisededepto_id', '=', $id)->latest()->first();
        $dosicontrolasig = Dosicontrolcontdosisede::where('contdosisededepto_id', '=', $id)
        ->where('mes_asignacion', '=', $mesnumber)
        ->get();    
        $dosiareasignados = Dosiareacontdosisede::where('contdosisededepto_id', '=', $id)
        ->where('mes_asignacion', '=', $mesnumber)
        ->get();
        $trabjasignados = Trabajadordosimetro::where('contdosisededepto_id', '=', $id)
        ->where('mes_asignacion', '=', $mesnumber)
        ->get();
        $observacionesDelMes = Mesescontdosisedeptos::where('contdosisededepto_id', '=', $id)
        ->where('mes_asignacion', '=', $mesnumber)
        ->get();
       /*  $dosimetros = Dosimetro::leftJoin('trabajadordosimetros','dosimetros.id_dosimetro','=','trabajadordosimetros.dosimetro_id')
            ->whereNull('trabajadordosimetros.dosimetro_uso')
            ->orWhere(function ($query) {
                $query->where('dosimetros.estado_dosimetro', 'STOCK');
            })
            ->select("*")
            ->get(); */
        /* $holders = Holder::leftJoin('trabajadordosimetros','holders.id_holder', '=', 'trabajadordosimetros.holder_id')
            ->whereNull('trabajadordosimetros.dosimetro_uso')
            ->orWhere(function ($query) {
                $query->where('holders.estado_holder', 'STOCK');
            })
            ->select("*")
            ->get(); */
        $DosiControlAsignados = Dosicontrolcontdosisede::where('contdosisededepto_id', $id)
            ->where('mes_asignacion', $mesnumber)
            ->count();
        $DosiToraxAsignados = Trabajadordosimetro::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
            ->where('contdosisededepto_id', $id)
            ->where('ubicacion', 'TORAX')
            ->where('mes_asignacion', $mesnumber)
            ->count();
        $DosiCasoAsignados = Trabajadordosimetro::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
            ->where('contdosisededepto_id', $id)
            ->where('ubicacion', 'CASO')
            ->where('mes_asignacion', $mesnumber)
            ->count();
        $DosiCristalinoAsignados = Trabajadordosimetro::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
            ->where('contdosisededepto_id', $id)
            ->where('ubicacion', 'CRISTALINO')
            ->where('mes_asignacion', $mesnumber)
            ->count(); 
        $DosiMuñecaAsignados = Trabajadordosimetro::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
            ->where('contdosisededepto_id', $id)
            ->where('ubicacion', 'MUÑECA')
            ->where('mes_asignacion', $mesnumber)
            ->count();
        $DosiDedoAsignados = Trabajadordosimetro::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
            ->where('contdosisededepto_id', $id)
            ->where('ubicacion', 'ANILLO')
            ->where('mes_asignacion', $mesnumber)
            ->count();
        return view('dosimetria.info_asignacion_dosimetros_contrato', compact('mesnumber','contdosisededepto', 'mescontdosisededepto', 'dosiareasignados', 'trabjasignados', 'observacionesDelMes', 'dosicontrolasig','DosiControlAsignados', 'DosiToraxAsignados', 'DosiCasoAsignados', 'DosiCristalinoAsignados', 'DosiMuñecaAsignados', 'DosiDedoAsignados'));
        /* return $dosicontrolasig; */
    }

    /* public function updateInfo($idWork, $contratoId, $mesnumber, Request $request) {
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
    } */

    /* public function deleteInfo($idWork,$contratoId, $mesnumber) {
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
        
    } */
    public function updateFechasAsigContrato($id, $mesnumber, Request $request){
        $new_fechaDosiControl = Dosicontrolcontdosisede::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber)
        ->update([
            'fecha_dosim_enviado'  =>$request->fecha_envio_dosim_asignado,
            'fecha_dosim_recibido' =>$request->fecha_recibido_dosim_asignado,
            'fecha_dosim_devuelto' =>$request->fecha_devuelto_dosim_asignado
        ]);
        $new_fechaDosiArea = Dosiareacontdosisede::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber)
        ->update([
            'fecha_dosim_enviado'  =>$request->fecha_envio_dosim_asignado,
            'fecha_dosim_recibido' =>$request->fecha_recibido_dosim_asignado,
            'fecha_dosim_devuelto' =>$request->fecha_devuelto_dosim_asignado
        ]);
        $new_fechaDosiTrabj = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber)
        ->update([
            'fecha_dosim_enviado'  =>$request->fecha_envio_dosim_asignado,
            'fecha_dosim_recibido' =>$request->fecha_recibido_dosim_asignado,
            'fecha_dosim_devuelto' =>$request->fecha_devuelto_dosim_asignado
        ]);
        /* return $mesnumber; */
        return redirect()->back()->with('actualizado', 'ok');
    }
    public function saveObservacionMesAsigdosim(Request $request){
        $newMesescontdosisedeptos = new Mesescontdosisedeptos();
        $newMesescontdosisedeptos->contdosisededepto_id = $request->id_contdosisededepto;
        $newMesescontdosisedeptos->mes_asignacion       = $request->mesnumber;
        $newMesescontdosisedeptos->nota_cambiodosim     = strtoupper($request->nota_cambio_dosimetros);
        $newMesescontdosisedeptos->save();
        
        /* return $request; */
        return back()->with('crear', 'ok');
    }
    public function destroyControlasig($id){
        $new_estado = 'STOCK';
        $liberar_dosim = Dosicontrolcontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
        ->where('id_dosicontrolcontdosisedes', $id)
        ->update([
            'estado_dosimetro' => $new_estado
        ]);
        $dosiControlasig = Dosicontrolcontdosisede::find($id);
        $dosiControlasig->delete();

        return redirect()->back()->with('eliminar', 'ok');
    }
    public function destroyTrabajadorasig($id){
        $new_estado = 'STOCK';
        $liberar_dosim = Trabajadordosimetro::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
        ->where('id_trabajadordosimetro', $id)
        ->update([
            'estado_dosimetro' => $new_estado
        ]);
        $dosiTrabajadorasig = Trabajadordosimetro::find($id);
        $dosiTrabajadorasig->delete();

        return redirect()->back()->with('eliminar', 'ok');
    }

    public function lecturadosi($id){
        $trabjasig = Trabajadordosimetro::find($id);

        /* return "sin dosimetro de control este es el trabajador asignado".$trabjasig; */
        return view('dosimetria.lectura_dosimetro_contrato', compact('trabjasig'));  
        
    }
    public function lecturadosicontrl($id, $idcontrol){
        $trabjasig = Trabajadordosimetro::find($id);
        $dosicontrolasig = Dosicontrolcontdosisede::find($idcontrol);

        /* return "con dosimetro de control".$dosicontrolasig; */
        return view('dosimetria.lectura_dosimetrocontrol_contrato', compact('trabjasig', 'dosicontrolasig'));
        /* return $trabjasig; */
    }


    public function savelecturadosi(Request $request, $id){

        $trabjasig = Trabajadordosimetro::find($id);
        if($request->nota2 != '' || $request->dnl != ''|| $request->eu != '' || $request->dsu !='' || $request->dpl !=''){

        }else{    
            $request->validate([
                'measurement_date'              => 'required',
            
            ]);
        }

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
        $trabjasig->nota1                               = $request->nota1;
        $trabjasig->nota2                               = $request->nota2;
        $trabjasig->nota3                               = $request->nota3;
        $trabjasig->nota4                               = $request->nota4;
        $trabjasig->nota5                               = $request->nota5;
        $trabjasig->nota6                               = $request->nota6;
        $trabjasig->DNL                                 = $request->dnl;
        $trabjasig->EU                                  = $request->eu;
        $trabjasig->DPL                                 = $request->dpl;
        $trabjasig->DSU                                 = $request->dsu;

        $trabjasig->save();

        $estadoDosiTrabajador = Dosimetro::where('id_dosimetro', $trabjasig->dosimetro->id_dosimetro)
        ->update([
            'estado_dosimetro' => 'STOCK',
            'uso_dosimetro'    => ''
        ]);

        if($trabjasig->holder_id != NULL ){
            $estadoHolderTrabajador = Holder::where('id_holder', $trabjasig->holder->id_holder)
            ->update([
                'estado_holder' => 'STOCK',
            ]);
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

        if(($request->nota2 == 'TRUE' && $request->nota5 == 'TRUE') || $request->dnl == ''|| $request->eu == '' || $request->dsu =='' || $request->dpl ==''){
        
        }else{
            $request->validate([
                'measurement_date'              => 'required',
                /* 'zeroLevel_date'                => 'required',
                'verification_Date'             => 'required',
                'verification_required_before'  => 'required', */
            ]);
        }   
        

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
        $dosicontasig->nota1                               = $request->nota1;
        $dosicontasig->nota2                               = $request->nota2;
        $dosicontasig->nota3                               = $request->nota3;
        $dosicontasig->nota4                               = $request->nota4;
        $dosicontasig->nota5                               = $request->nota5;
        $dosicontasig->DNL                                 = $request->dnl;
        $dosicontasig->EU                                  = $request->eu;
        $dosicontasig->DPL                                 = $request->dpl;
        $dosicontasig->DSU                                 = $request->dsu;

        $dosicontasig->save();
        
        $estadoDosiControl = Dosimetro::where('id_dosimetro', $dosicontasig->dosimetro->id_dosimetro)
        ->update([
            'estado_dosimetro' => 'STOCK',
            'uso_dosimetro'    => ''
        ]);

        return redirect()->route('asignadosicontrato.info',["asigdosicont" => $request->id_contratodosimetriasededepto, "mesnumber" => $request->mes_asignacion])->with('actualizar', 'ok');
        /* return $request; */
    }

    public function editlecturadosicontrol($id){
        $dosicontasig = Dosicontrolcontdosisede::find($id);

        return view('dosimetria.lectura_dosimetro_control_edit', compact('dosicontasig'));
    }
    public function lecturadosiarea($id){
        $dosiareasig = Dosiareacontdosisede::find($id);

        return view('dosimetria.lectura_dosimetro_area_contrato', compact('dosiareasig'));
    }
    public function savelecturadosiarea(Request $request, $id){
        $dosiareacontasig = Dosiareacontdosisede::find($id);

        if($request->nota2 != 'TRUE' || $request->dnl != 'TRUE'|| $request->eu != 'TRUE' || $request->dsu !='TRUE' || $request->dpl !='TRUE'){
            $request->validate([
                'measurement_date'              => 'required',
                'zeroLevel_date'                => 'required',
                'verification_Date'             => 'required',
                'verification_required_before'  => 'required',
            ]); 
        }

        $dosiareacontasig->zero_level_date                     = $request->zeroLevel_date;
        $dosiareacontasig->measurement_date                    = $request->measurement_date;
        
        $dosiareacontasig->H_10_calc_dose                      = $request->h10_cal_dose;
        $dosiareacontasig->verification_date                   = $request->verification_Date;
        $dosiareacontasig->verification_required_on_or_before  = $request->verification_required_before;
        $dosiareacontasig->remaining_days_available_for_use    = $request->remaining_days_available_use;
        $dosiareacontasig->nota1                               = $request->nota1;
        $dosiareacontasig->nota2                               = $request->nota2;
        $dosiareacontasig->nota3                               = $request->nota3;
        $dosiareacontasig->nota4                               = $request->nota4;
        $dosiareacontasig->nota5                               = $request->nota5;
        $dosiareacontasig->DNL                                 = $request->dnl;
        $dosiareacontasig->EU                                  = $request->eu;
        $dosiareacontasig->DPL                                 = $request->dpl;
        $dosiareacontasig->DSU                                 = $request->dsu;

        $dosiareacontasig->save();
        
        $estadoDosiArea = Dosimetro::where('id_dosimetro', $dosiareacontasig->dosimetro->id_dosimetro)
        ->update([
            'estado_dosimetro' => 'STOCK',
            'uso_dosimetro'    => ''
        ]);
        return redirect()->route('asignadosicontrato.info',["asigdosicont" => $request->id_contratodosimetriasededepto, "mesnumber" => $request->mes_asignacion])->with('actualizar', 'ok');
        /* return $request; */
    }
    public function pdf($id, $mesnumber){
        
        $contratoDosi = Departamento::join('departamentosedes', 'departamentos.id_departamento', '=', 'departamentosedes.departamento_id')
        ->join('contratodosimetriasededeptos', 'departamentosedes.id_departamentosede', '=', 'contratodosimetriasededeptos.departamentosede_id')
        ->join('contratodosimetriasedes', 'contratodosimetriasededeptos.contratodosimetriasede_id','=','contratodosimetriasedes.id_contratodosimetriasede')
        ->join('sedes', 'contratodosimetriasedes.sede_id', '=', 'sedes.id_sede')
        ->join('colmunicipios', 'sedes.municipiocol_id', '=', 'colmunicipios.id_municipiocol')
        ->join('coldepartamentos', 'colmunicipios.departamentocol_id', '=', 'coldepartamentos.id_departamentocol')
        ->join('dosimetriacontratos', 'contratodosimetriasedes.contratodosimetria_id', '=', 'dosimetriacontratos.id_contratodosimetria')
        ->join('empresas', 'dosimetriacontratos.empresa_id', '=', 'empresas.id_empresa')
        ->where('contratodosimetriasededeptos.id_contdosisededepto', '=', $id)
        ->select('empresas.nombre_empresa', 'sedes.nombre_sede', 'dosimetriacontratos.codigo_contrato', 'departamentos.nombre_departamento', 'empresas.num_iden_empresa', 'colmunicipios.nombre_municol', 'coldepartamentos.abreviatura_deptocol', 'dosimetriacontratos.periodo_recambio')
        ->get();

        $personaEncargada = Contratodosimetriasededepto::join('contratodosimetriasedes', 'contratodosimetriasededeptos.contratodosimetriasede_id', '=', 'contratodosimetriasedes.id_contratodosimetriasede')
        ->join('personasedes', 'contratodosimetriasedes.sede_id', '=', 'personasedes.sede_id')
        ->join('personas', 'personasedes.persona_id', '=', 'personas.id_persona')
        ->join('personasroles', 'personas.id_persona', '=', 'personasroles.persona_id')
        ->join('roles', 'personasroles.rol_id', '=', 'roles.id_rol')
        ->where('personas.lider_dosimetria', '=', 'TRUE')
        ->where('roles.nombre_rol', '=', 'CONTACTO')
        ->select('personas.primer_nombre_persona', 'personas.primer_apellido_persona', 'personas.segundo_apellido_persona', 'roles.nombre_rol')
        ->get();

        $trabajdosiasig= Trabajadordosimetro::where('contdosisededepto_id', '=', $id)
        ->where('mes_asignacion', '=', $mesnumber)
        ->get();

        $fechainiciodositrabaj = array();
        for($i=0; $i<count($trabajdosiasig); $i++){
            $fechainiciodositrabaj[]=Trabajadordosimetro::where('persona_id','=', $trabajdosiasig[$i]->persona_id)->first();
        }

        /* SELECT * FROM `dosicontrolcontdosisedes` INNER JOIN contratodosimetriasededeptos ON dosicontrolcontdosisedes.contdosisededepto_id = contratodosimetriasededeptos.id_contdosisededepto
        INNER JOIN departamentosedes ON contratodosimetriasededeptos.departamentosede_id = departamentosedes.id_departamentosede; */
        $dosicontrolasig = Dosicontrolcontdosisede::join('dosimetros', 'dosicontrolcontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->join('contratodosimetriasededeptos', 'dosicontrolcontdosisedes.contdosisededepto_id', '=', 'contratodosimetriasededeptos.id_contdosisededepto')
        ->join('departamentosedes','contratodosimetriasededeptos.departamentosede_id', '=', 'departamentosedes.id_departamentosede')
        ->where('contdosisededepto_id', '=', $id)
        ->where('mes_asignacion', '=', $mesnumber)
        ->get();

        $dosiareasig = Dosiareacontdosisede::where('contdosisededepto_id', '=', $id)
        ->where('mes_asignacion', '=', $mesnumber)
        ->get();
        
        $mesescantdosi = Mesescontdosisedeptos::where('contdosisededepto_id', '=', $id)
        ->where('mes_asignacion', '=', $mesnumber)
        ->select('nota_cambiodosim')        
        ->get();
        
        $trabajadoresaisgxmeses = array();
        for($i=0; $i<count($trabajdosiasig); $i++){

            $trabajadoresaisgxmeses[] = Trabajadordosimetro::where('persona_id', '=', $trabajdosiasig[$i]->persona_id)->get();
        }
        
        $pdf = PDF::loadView('dosimetria.reportePDF_dosimetria', compact('trabajdosiasig', 'dosicontrolasig', 'dosiareasig', 'contratoDosi', 'personaEncargada', 'fechainiciodositrabaj', 'trabajadoresaisgxmeses', 'mesescantdosi', 'mesnumber'));
        $pdf->setPaper('8.5x14', 'landscape');
        
        
        
        for($i=0; $i<count($contratoDosi); $i++ ){
            
            $empresa = $contratoDosi[$i]->nombre_empresa;
            $sede = $contratoDosi[$i]->nombre_sede;
            $fecha = date("d-m-Y",strtotime($contratoDosi[$i]->fecha_inicio)); 
            $newDate = date("m-Y", strtotime($fecha));
            $date = date("m-Y");				
            /* $mesDesc = date("%e %B %Y", strtotime($newDate)); */
            /* $var = 0;
            foreach($trabajdosiasig as $trab){
                if($trab->Hp007_calc_dose != 'NULL' || $trab->Hp10_calc_dose != 'NULL' || $trab->Hp3_calc_dose != 'NULL' || $trab->EzClip_calc_dose != 'NULL'){
                    return $pdf->with('fallo', 'ok')->stream("RPD_".$date."_".substr($empresa, 0, 4)."-".substr($sede, 0, 4)."-".$contratoDosi[$i]->nombre_departamento.".pdf");
                    break;
                }else{
                    return $pdf->stream("RPD_".$date."_".substr($empresa, 0, 4)."-".substr($sede, 0, 4)."-".$contratoDosi[$i]->nombre_departamento.".pdf");
                }
            } */
            /* return $newDate; */
        }
        /* return $personaEncargada; */
        return $pdf->stream();
       
        

    }
    public function pdfEtiquetas($id, $mesnumber){
        $contratodosi = Contratodosimetriasededepto::join('departamentosedes', 'contratodosimetriasededeptos.departamentosede_id','=', 'departamentosedes.id_departamentosede')
        ->join('departamentos', 'departamentosedes.departamento_id', '=', 'departamentos.id_departamento')
        ->join('sedes', 'departamentosedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('id_contdosisededepto', '=', $id)
        ->get(); 
        $dosicontrolasig = Dosicontrolcontdosisede::where('contdosisededepto_id', '=', $id)
        ->where('mes_asignacion', '=', $mesnumber)
        ->get(); 
        $trabajdosiasig= Trabajadordosimetro::where('contdosisededepto_id', '=', $id)
        ->where('mes_asignacion', '=', $mesnumber)
        ->get();
        /* return $dosicontrolasig; */
        /* $pdf = PDF::loadView('dosimetria.etiquetasPDF_dosimetria', compact('contratodosi', 'trabajdosiasig', 'dosicontrolasig')); */
        $pdf =  PDF::loadView('dosimetria.etiquetasPDF1_dosimetria', compact('contratodosi', 'trabajdosiasig', 'dosicontrolasig'));
        /* $pdf->setPaper('A4', 'portrait'); */
        $pdf->setPaper( array(0, 0,306.141,2834.645), 'portrait'); 
        return $pdf->stream();
    }
    public function revisionDosimetria($id, $mesnumber){
        $contdosisededepto = Contratodosimetriasededepto::find($id);
        $dosicontrolasig = Dosicontrolcontdosisede::where('contdosisededepto_id', '=', $id)
        ->where('mes_asignacion', '=', $mesnumber)
        ->get();
        $trabjasignados = Trabajadordosimetro::where('contdosisededepto_id', '=', $id)
        ->where('mes_asignacion', '=', $mesnumber)
        ->get();

        return view('dosimetria.revision_asignaciones_dosimetria', compact('trabjasignados','dosicontrolasig', 'contdosisededepto', 'mesnumber'));
    }
    
    public function revisionDosimetro(Request $request){
        $dosimetro = Dosimetro::where('codigo_dosimeter', '=', $request->codigo_dosi)->get();
        return response()->json($dosimetro);
    }
    public function revisionCheck(Request $request){
        $trabajadordosimetro = Trabajadordosimetro::where('id_trabajadordosimetro', '=', $request->id_trabajadordosimetro)
        ->update([
            'revision_salida' => 'TRUE'
        ]);
        
        return response()->json($trabajadordosimetro);
    }
    public function revisionCheckControl(Request $request){
        $dosicontrol = Dosicontrolcontdosisede::where('id_dosicontrolcontdosisedes', '=', $request->id_dosicontrolcontdosisedes)
        ->update([
            'revision_salida' => 'TRUE'
        ]);
        return response()->json($dosicontrol);
    }
    public function revisionDosimetriaGeneral(){
        
       /*  $trabajdosiasig = Trabajadordosimetro::join('personas', 'trabajadordosimetros.persona_id', '=', 'personas.id_persona')
        ->join('dosimetros', 'trabajadordosimetros.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->leftJoin('holders', 'trabajadordosimetros.holder_id', '=', 'holders.id_holder')
        ->join('contratodosimetriasedes', 'trabajadordosimetros.contratodosimetriasede_id', '=', 'contratodosimetriasedes.id_contratodosimetriasede')
        ->join('dosimetriacontratos', 'contratodosimetriasedes.contratodosimetria_id', '=', 'dosimetriacontratos.id_contratodosimetria')
        ->join('sedes', 'contratodosimetriasedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->join('contratodosimetriasededeptos', 'trabajadordosimetros.contdosisededepto_id', '=', 'contratodosimetriasededeptos.id_contdosisededepto')
        ->join('departamentosedes', 'contratodosimetriasededeptos.departamentosede_id', '=', 'departamentosedes.id_departamentosede')
        ->where('trabajadordosimetros.dosimetro_uso', '=', 'TRUE')
        ->whereNull('trabajadordosimetros.revision')
        ->select('trabajadordosimetros.id_trabajadordosimetro','trabajadordosimetros.ubicacion', 'trabajadordosimetros.ubicacion', 'trabajadordosimetros.mes_asignacion','personas.primer_nombre_persona', 'personas.segundo_nombre_persona', 'personas.primer_apellido_persona', 'personas.segundo_apellido_persona', 'dosimetros.codigo_dosimeter', 'holders.codigo_holder', 'dosimetriacontratos.codigo_contrato', 'sedes.nombre_sede', 'empresas.nombre_empresa', 'departamentosedes.nombre_departamento')
        ->get();
        $dosicontrolasig = Dosicontrolcontdosisede::join('dosimetros', 'dosicontrolcontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->join('contratodosimetriasedes', 'dosicontrolcontdosisedes.contratodosimetriasede_id', '=', 'contratodosimetriasedes.id_contratodosimetriasede')
        ->join('dosimetriacontratos', 'contratodosimetriasedes.contratodosimetria_id', '=', 'dosimetriacontratos.id_contratodosimetria')
        ->join('sedes', 'contratodosimetriasedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->join('contratodosimetriasededeptos', 'dosicontrolcontdosisedes.contdosisededepto_id', '=', 'contratodosimetriasededeptos.id_contdosisededepto')
        ->join('departamentosedes', 'contratodosimetriasededeptos.departamentosede_id', '=', 'departamentosedes.id_departamentosede')
        ->where('dosicontrolcontdosisedes.dosimetro_uso', '=', 'TRUE')
        ->whereNull('dosicontrolcontdosisedes.revision')
        ->select('dosicontrolcontdosisedes.id_dosicontrolcontdosisedes', 'dosicontrolcontdosisedes.mes_asignacion', 'dosimetros.codigo_dosimeter', 'dosimetriacontratos.codigo_contrato', 'sedes.nombre_sede', 'empresas.nombre_empresa', 'departamentosedes.nombre_departamento')
        ->get(); */
        
       
        return view('dosimetria.revision_asignaciones_dosimetria_general1');
        /* return view('dosimetria.revision_asignaciones_dosimetria_general', compact('trabajdosiasig', 'dosimetros', 'dosicontrolasig') ); */
        /* return $trabajdosiasig; */
    }
    public function asignaciones(Request $request){
        
        $asignacionesall = Trabajadordosimetro::join('personas', 'trabajadordosimetros.persona_id', '=', 'personas.id_persona')
        ->join('dosimetros', 'trabajadordosimetros.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->leftJoin('holders', 'trabajadordosimetros.holder_id', '=', 'holders.id_holder')
        ->join('contratodosimetriasedes', 'trabajadordosimetros.contratodosimetriasede_id', '=', 'contratodosimetriasedes.id_contratodosimetriasede')
        ->join('dosimetriacontratos', 'contratodosimetriasedes.contratodosimetria_id', '=', 'dosimetriacontratos.id_contratodosimetria')
        ->join('sedes', 'contratodosimetriasedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->join('contratodosimetriasededeptos', 'trabajadordosimetros.contdosisededepto_id', '=', 'contratodosimetriasededeptos.id_contdosisededepto')
        ->join('departamentosedes', 'contratodosimetriasededeptos.departamentosede_id', '=', 'departamentosedes.id_departamentosede')
        ->join('departamentos', 'departamentosedes.departamento_id', '=', 'departamentos.id_departamento')
        ->whereNull('trabajadordosimetros.revision_salida')
        ->where('empresas.nombre_empresa', '=', $request->empresa)
        ->select('trabajadordosimetros.id_trabajadordosimetro','trabajadordosimetros.ubicacion', 'trabajadordosimetros.ubicacion', 'trabajadordosimetros.mes_asignacion','personas.primer_nombre_persona', 'personas.segundo_nombre_persona', 'personas.primer_apellido_persona', 'personas.segundo_apellido_persona', 'dosimetros.codigo_dosimeter', 'holders.codigo_holder', 'dosimetriacontratos.codigo_contrato', 'sedes.nombre_sede', 'empresas.nombre_empresa', 'departamentos.nombre_departamento')
        ->get();
        return response()->json($asignacionesall);
    }

    
    /* public function revisionCheckGeneral(Request $request){
        $trabajadordosim = Trabajadordosimetro::where('id_trabajadordosimetro', '=', $request->id_trabajadordosimetro)
        ->update([
            'revision' => 'TRUE'
        ]);
        
        return response()->json($trabajadordosim);
    } */
    
    public function asignacionesControl(Request $request){
        $asignacionesControlall = Dosicontrolcontdosisede::join('dosimetros', 'dosicontrolcontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->join('contratodosimetriasedes', 'dosicontrolcontdosisedes.contratodosimetriasede_id', '=', 'contratodosimetriasedes.id_contratodosimetriasede')
        ->join('dosimetriacontratos', 'contratodosimetriasedes.contratodosimetria_id', '=', 'dosimetriacontratos.id_contratodosimetria')
        ->join('sedes', 'contratodosimetriasedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->join('contratodosimetriasededeptos', 'dosicontrolcontdosisedes.contdosisededepto_id', '=', 'contratodosimetriasededeptos.id_contdosisededepto')
        ->join('departamentosedes', 'contratodosimetriasededeptos.departamentosede_id', '=', 'departamentosedes.id_departamentosede')
        ->whereNull('dosicontrolcontdosisedes.revision_salida')
        ->where('empresas.nombre_empresa', '=', $request->empresa)
        ->select('dosicontrolcontdosisedes.id_dosicontrolcontdosisedes', 'dosicontrolcontdosisedes.mes_asignacion', 'dosimetros.codigo_dosimeter', 'dosimetriacontratos.codigo_contrato', 'sedes.nombre_sede', 'departamentosedes.nombre_departamento')
        ->get();
        
        return response()->json($asignacionesControlall);
    }
    /* public function revisionCheckControlGeneral(Request $request){
        $dosicontrol = Dosicontrolcontdosisede::where('id_dosicontrolcontdosisedes', '=', $request->id_dosicontrolcontdosisedes)
        ->update([
            'revision' => 'TRUE'
        ]);
        return response()->json($dosicontrol);
    } */
    
    public function pdfCertificadorevisionsalida($empresa, $deptodosi, $mesnumber){
        /* return $mesnumber; */
        if($empresa != 0){
            $empresa = Empresa::where('nombre_empresa', '=', $empresa)->get();
        }
        $temptrabjdosimrev = Temptrabajdosimrev::all();
        $dosicontrolasig = Dosicontrolcontdosisede::where('contdosisededepto_id', '=', $deptodosi)
        ->where('mes_asignacion', '=', $mesnumber)
        ->where('revision_salida', '=', 'TRUE')
        ->get();
        $trabjasignados = Trabajadordosimetro::where('contdosisededepto_id', '=', $deptodosi)
        ->where('mes_asignacion', '=', $mesnumber)
        ->where('revision_salida', '=', 'TRUE')
        ->get();
        $contdosisededepto = Contratodosimetriasededepto::find($deptodosi);
        $pdf =  PDF::loadView('dosimetria.certificadoPDF_revision_dosimetria', compact('temptrabjdosimrev', 'empresa', 'dosicontrolasig', 'trabjasignados', 'deptodosi', 'contdosisededepto'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream();
        /* return $empresa; */
    }
    public function revisionDosimetriaEntrada($id, $mesnumber){
        $contdosisededepto = Contratodosimetriasededepto::find($id);
        $dosicontrolasig = Dosicontrolcontdosisede::where('contdosisededepto_id', '=', $id)
        ->where('mes_asignacion', '=', $mesnumber)
        ->get();
        $trabjasignados = Trabajadordosimetro::where('contdosisededepto_id', '=', $id)
        ->where('mes_asignacion', '=', $mesnumber)
        ->get();
        $observacionesDelMes = Mesescontdosisedeptos::where('contdosisededepto_id', '=', $id)
        ->where('mes_asignacion', '=', $mesnumber)
        ->select('nota_cambiodosim')
        ->get();
        /* return $contdosisededepto->departamentosede->departamento->nombre_departamento; */
        return view('dosimetria.revision_entrada_asignaciones_dosimetria', compact('trabjasignados','dosicontrolasig', 'contdosisededepto', 'mesnumber', 'observacionesDelMes'));
    }
    public function revisionCheckControlEntrada(Request $request){
        $dosicontrol = Dosicontrolcontdosisede::where('id_dosicontrolcontdosisedes', '=', $request->id_dosicontrolcontdosisedes)
        ->update([
            'revision_entrada' => 'TRUE'
        ]);
        return response()->json($dosicontrol);
    }
    public function revisionCheckEntrada(Request $request){
        $trabajadordosimetro = Trabajadordosimetro::where('id_trabajadordosimetro', '=', $request->id_trabajadordosimetro)
        ->update([
            'revision_entrada' => 'TRUE'
        ]);
        
        return response()->json($trabajadordosimetro);
    }
    public function revisionDosimetriaEntradaGeneral(){
        
        return view('dosimetria.revision_asignaciones_dosimetria_general_entrada');
        
    }
    public function asignacionesEntrada(Request $request){
        
        $asignacionesall = Trabajadordosimetro::join('personas', 'trabajadordosimetros.persona_id', '=', 'personas.id_persona')
        ->join('dosimetros', 'trabajadordosimetros.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->leftJoin('holders', 'trabajadordosimetros.holder_id', '=', 'holders.id_holder')
        ->join('contratodosimetriasedes', 'trabajadordosimetros.contratodosimetriasede_id', '=', 'contratodosimetriasedes.id_contratodosimetriasede')
        ->join('dosimetriacontratos', 'contratodosimetriasedes.contratodosimetria_id', '=', 'dosimetriacontratos.id_contratodosimetria')
        ->join('sedes', 'contratodosimetriasedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->join('contratodosimetriasededeptos', 'trabajadordosimetros.contdosisededepto_id', '=', 'contratodosimetriasededeptos.id_contdosisededepto')
        ->join('departamentosedes', 'contratodosimetriasededeptos.departamentosede_id', '=', 'departamentosedes.id_departamentosede')
        ->join('departamentos', 'departamentosedes.departamento_id', '=', 'departamentos.id_departamento')
        ->whereNull('trabajadordosimetros.revision_entrada')
        ->where('empresas.nombre_empresa', '=', $request->empresa)
        ->select('trabajadordosimetros.id_trabajadordosimetro','trabajadordosimetros.ubicacion', 'trabajadordosimetros.ubicacion', 'trabajadordosimetros.mes_asignacion','personas.primer_nombre_persona', 'personas.segundo_nombre_persona', 'personas.primer_apellido_persona', 'personas.segundo_apellido_persona', 'dosimetros.codigo_dosimeter', 'holders.codigo_holder', 'dosimetriacontratos.codigo_contrato', 'sedes.nombre_sede', 'empresas.nombre_empresa', 'departamentos.nombre_departamento')
        ->get();
        return response()->json($asignacionesall);
    }
    public function asignacionesControlEntrada(Request $request){
        $asignacionesControlall = Dosicontrolcontdosisede::join('dosimetros', 'dosicontrolcontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->join('contratodosimetriasedes', 'dosicontrolcontdosisedes.contratodosimetriasede_id', '=', 'contratodosimetriasedes.id_contratodosimetriasede')
        ->join('dosimetriacontratos', 'contratodosimetriasedes.contratodosimetria_id', '=', 'dosimetriacontratos.id_contratodosimetria')
        ->join('sedes', 'contratodosimetriasedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->join('contratodosimetriasededeptos', 'dosicontrolcontdosisedes.contdosisededepto_id', '=', 'contratodosimetriasededeptos.id_contdosisededepto')
        ->join('departamentosedes', 'contratodosimetriasededeptos.departamentosede_id', '=', 'departamentosedes.id_departamentosede')
        ->whereNull('dosicontrolcontdosisedes.revision_entrada')
        ->where('empresas.nombre_empresa', '=', $request->empresa)
        ->select('dosicontrolcontdosisedes.id_dosicontrolcontdosisedes', 'dosicontrolcontdosisedes.mes_asignacion', 'dosimetros.codigo_dosimeter', 'dosimetriacontratos.codigo_contrato', 'sedes.nombre_sede', 'departamentosedes.nombre_departamento')
        ->get();
        
        return response()->json($asignacionesControlall);
    }
    public function observacionesRevsEntradaGeneral(Request $request){
        
        $obsercacionentradanewmes = new Mesescontdosisedeptos;
        $obsercacionentradanewmes->contdosisededepto_id = $request->id_contdosisededepto;
        $obsercacionentradanewmes->mes_asignacion       = $request->mesnumber;
        $obsercacionentradanewmes->nota_cambiodosim     = strtoupper($request->nota_cambio_dosimetros);
        $obsercacionentradanewmes->save();

        return back()->with('crear', 'ok');
    }
    public function pdfCertificadorevisionentrada($empresa, $deptodosi, $mesnumber){
        /* return $mesnumber; */
        if($empresa != 0){
            $empresa = Empresa::where('nombre_empresa', '=', $empresa)->get();
        }
        $temptrabjdosimrevsentrada = Temptrabajdosimentradarev::all();
        $dosicontrolasig = Dosicontrolcontdosisede::where('contdosisededepto_id', '=', $deptodosi)
        ->where('mes_asignacion', '=', $mesnumber)
        ->where('revision_salida', '=', 'TRUE')
        ->get();
        $trabjasignados = Trabajadordosimetro::where('contdosisededepto_id', '=', $deptodosi)
        ->where('mes_asignacion', '=', $mesnumber)
        ->where('revision_salida', '=', 'TRUE')
        ->get();
        $contdosisededepto = Contratodosimetriasededepto::find($deptodosi);
        $pdf =  PDF::loadView('dosimetria.certificadoPDF_revision_entrada_dosimetria', compact('temptrabjdosimrevsentrada', 'empresa', 'dosicontrolasig', 'trabjasignados', 'deptodosi', 'contdosisededepto'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream();
        /* return $empresa; */
    }
}
