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
use App\Models\Novcontdosisededepto;
use App\Models\Observacion;
use App\Models\Obsreventrada;
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
use PHPUnit\Framework\Constraint\Count;

class DosimetriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* public function index(){
        $empresa = ContratosDosimetriaEmpresa::all();
        return view('dosimetria.empresas_dosimetria', compact('empresa'));
    } */
    public function createEmpresa(){
        $empresas = Empresa::all();
        $empresaDosi = ContratosDosimetriaEmpresa::all();
        $contdosisededepto = ContratosDosimetriaEmpresa::join('dosimetriacontratos', 'contratos_dosimetria_empresas.empresa_id', '=', 'dosimetriacontratos.empresa_id')
        ->join('contratodosimetriasedes', 'dosimetriacontratos.id_contratodosimetria', '=', 'contratodosimetriasedes.contratodosimetria_id')
        ->join('contratodosimetriasededeptos', 'contratodosimetriasedes.id_contratodosimetriasede', '=', 'contratodosimetriasededeptos.contratodosimetriasede_id')
        ->get();
        $novedadescontdosisededepto = Novcontdosisededepto:: all();
        /* return  $novedadescontdosisededepto; */
        
        $dosimetriacontrato = Dosimetriacontrato::where('estado_contrato', '=', 'ACTIVO')->get();
        $dosimetrosUsados = Dosimetro::where('estado_dosimetro', '=', 'EN USO')->count();
        $dosimestrosLibres = Dosimetro::where('estado_dosimetro', '=', 'STOCK')->count();
        $dosimetrosEnLectura = Dosimetro::where('estado_dosimetro', '=', 'EN LECTURA')->count();
        /* $empresasDosimTrabj = Dosimetriacontrato::join('empresas', 'dosimetriacontratos.empresa_id', '=', 'empresas.id_empresa')
        ->join('contratodosimetriasedes', 'dosimetriacontratos.id_contratodosimetria', '=', 'contratodosimetriasedes.contratodosimetria_id')
        ->join('contratodosimetriasededeptos', 'contratodosimetriasedes.id_contratodosimetriasede', '=', 'contratodosimetriasededeptos.contratodosimetriasede_id')
        ->join('trabajadordosimetros', 'contratodosimetriasededeptos.id_contdosisededepto', '=', 'trabajadordosimetros.contdosisededepto_id')
        ->join('dosimetros', 'trabajadordosimetros.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->where('dosimetriacontratos.codigo_contrato', 1)
        ->where('dosimetros.estado_dosimetro', 'EN USO')
        ->select('dosimetros.id_dosimetro','dosimetros.codigo_dosimeter', 'dosimetros.tipo_dosimetro', 'dosimetros.tecnologia_dosimetro', 'dosimetros.fecha_ingreso_servicio',
        'dosimetros.estado_dosimetro', 'dosimetros.uso_dosimetro', 'trabajadordosimetros.contdosisededepto_id', 'trabajadordosimetros.dosimetro_uso', 'trabajadordosimetros.mes_asignacion')
        ->get(); 
        $empresasDosimDosicont = Dosimetriacontrato::join('empresas', 'dosimetriacontratos.empresa_id', '=', 'empresas.id_empresa')
        ->join('contratodosimetriasedes', 'dosimetriacontratos.id_contratodosimetria', '=', 'contratodosimetriasedes.contratodosimetria_id')
        ->join('contratodosimetriasededeptos', 'contratodosimetriasedes.id_contratodosimetriasede', '=', 'contratodosimetriasededeptos.contratodosimetriasede_id')
        ->join('dosicontrolcontdosisedes', 'contratodosimetriasededeptos.id_contdosisededepto', '=', 'dosicontrolcontdosisedes.contdosisededepto_id')
        ->join('dosimetros', 'dosicontrolcontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->get();
        $empresasDosimDosiarea = Dosimetriacontrato::join('empresas', 'dosimetriacontratos.empresa_id', '=', 'empresas.id_empresa')
        ->join('contratodosimetriasedes', 'dosimetriacontratos.id_contratodosimetria', '=', 'contratodosimetriasedes.contratodosimetria_id')
        ->join('contratodosimetriasededeptos', 'contratodosimetriasedes.id_contratodosimetriasede', '=', 'contratodosimetriasededeptos.contratodosimetriasede_id')
        ->join('dosiareacontdosisedes', 'contratodosimetriasededeptos.id_contdosisededepto', '=', 'dosiareacontdosisedes.contdosisededepto_id')
        ->join('dosimetros', 'dosiareacontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->get(); */
        //////////////
        /* $empresasDosimTrabjUSO = Dosimetro::join('trabajadordosimetros','dosimetros.id_dosimetro','=','trabajadordosimetros.dosimetro_id')
        ->join('contratodosimetriasededeptos', 'trabajadordosimetros.contdosisededepto_id', '=', 'contratodosimetriasededeptos.id_contdosisededepto')
        ->join('contratodosimetriasedes', 'contratodosimetriasededeptos.contratodosimetriasede_id', '=', 'contratodosimetriasedes.id_contratodosimetriasede')
        ->join('sedes', 'contratodosimetriasedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('trabajadordosimetros.dosimetro_uso', 'TRUE')
        ->where('dosimetros.estado_dosimetro', 'EN USO')
        ->get(); */
        $empresasDosimTrabjUSO= Dosimetro::join('trabajadordosimetros','dosimetros.id_dosimetro','=','trabajadordosimetros.dosimetro_id')
        ->join('contratodosimetriasededeptos', 'trabajadordosimetros.contdosisededepto_id', '=', 'contratodosimetriasededeptos.id_contdosisededepto')
        ->join('contratodosimetriasedes', 'contratodosimetriasededeptos.contratodosimetriasede_id', '=', 'contratodosimetriasedes.id_contratodosimetriasede')
        ->join('sedes', 'contratodosimetriasedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('dosimetros.estado_dosimetro', 'EN USO')
        ->where('trabajadordosimetros.dosimetro_uso','=', 'TRUE')
        ->select('dosimetros.id_dosimetro','dosimetros.codigo_dosimeter', 'dosimetros.tipo_dosimetro', 'dosimetros.estado_dosimetro', 'dosimetros.uso_dosimetro', 
        'trabajadordosimetros.contdosisededepto_id', 'trabajadordosimetros.dosimetro_uso', 'trabajadordosimetros.mes_asignacion', 'empresas.id_empresa', 'empresas.nombre_empresa')
        ->get();
        $empresasDosimTrabjLECTURA = Dosimetro::join('trabajadordosimetros','dosimetros.id_dosimetro','=','trabajadordosimetros.dosimetro_id')
        ->join('contratodosimetriasededeptos', 'trabajadordosimetros.contdosisededepto_id', '=', 'contratodosimetriasededeptos.id_contdosisededepto')
        ->join('contratodosimetriasedes', 'contratodosimetriasededeptos.contratodosimetriasede_id', '=', 'contratodosimetriasedes.id_contratodosimetriasede')
        ->join('sedes', 'contratodosimetriasedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('dosimetros.estado_dosimetro', 'EN LECTURA')
        ->where('trabajadordosimetros.dosimetro_uso','=', 'FALSE')
        ->select('dosimetros.id_dosimetro','dosimetros.codigo_dosimeter', 'dosimetros.tipo_dosimetro', 'dosimetros.estado_dosimetro', 'dosimetros.uso_dosimetro', 
        'trabajadordosimetros.contdosisededepto_id', 'trabajadordosimetros.dosimetro_uso', 'trabajadordosimetros.mes_asignacion', 'empresas.id_empresa', 'empresas.nombre_empresa')
        ->get();
        $empresasDosimDosicontUSO = Dosimetro::join('dosicontrolcontdosisedes','dosimetros.id_dosimetro','=','dosicontrolcontdosisedes.dosimetro_id')
        ->join('contratodosimetriasededeptos', 'dosicontrolcontdosisedes.contdosisededepto_id', '=', 'contratodosimetriasededeptos.id_contdosisededepto')
        ->join('contratodosimetriasedes', 'contratodosimetriasededeptos.contratodosimetriasede_id', '=', 'contratodosimetriasedes.id_contratodosimetriasede')
        ->join('sedes', 'contratodosimetriasedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('dosimetros.estado_dosimetro', 'EN USO')
        ->where('dosicontrolcontdosisedes.dosimetro_uso','=', 'TRUE')
        ->select('dosimetros.id_dosimetro','dosimetros.codigo_dosimeter', 'dosimetros.tipo_dosimetro', 'dosimetros.estado_dosimetro', 'dosimetros.uso_dosimetro', 
        'dosicontrolcontdosisedes.contdosisededepto_id', 'dosicontrolcontdosisedes.dosimetro_uso', 'dosicontrolcontdosisedes.mes_asignacion', 'empresas.id_empresa', 'empresas.nombre_empresa')
        ->get();
        $empresasDosimDosicontLECTURA = Dosimetro::join('dosicontrolcontdosisedes','dosimetros.id_dosimetro','=','dosicontrolcontdosisedes.dosimetro_id')
        ->join('contratodosimetriasededeptos', 'dosicontrolcontdosisedes.contdosisededepto_id', '=', 'contratodosimetriasededeptos.id_contdosisededepto')
        ->join('contratodosimetriasedes', 'contratodosimetriasededeptos.contratodosimetriasede_id', '=', 'contratodosimetriasedes.id_contratodosimetriasede')
        ->join('sedes', 'contratodosimetriasedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('dosimetros.estado_dosimetro', 'EN LECTURA')
        ->where('dosicontrolcontdosisedes.dosimetro_uso', 'FALSE')
        ->select('dosimetros.id_dosimetro','dosimetros.codigo_dosimeter', 'dosimetros.tipo_dosimetro', 'dosimetros.estado_dosimetro', 'dosimetros.uso_dosimetro', 
        'dosicontrolcontdosisedes.contdosisededepto_id', 'dosicontrolcontdosisedes.dosimetro_uso', 'dosicontrolcontdosisedes.mes_asignacion', 'empresas.id_empresa', 'empresas.nombre_empresa')
        ->get();
        $empresasDosimDosiareaUSO =  Dosimetro::join('dosiareacontdosisedes','dosimetros.id_dosimetro','=','dosiareacontdosisedes.dosimetro_id')
        ->join('contratodosimetriasededeptos', 'dosiareacontdosisedes.contdosisededepto_id', '=', 'contratodosimetriasededeptos.id_contdosisededepto')
        ->join('contratodosimetriasedes', 'contratodosimetriasededeptos.contratodosimetriasede_id', '=', 'contratodosimetriasedes.id_contratodosimetriasede')
        ->join('sedes', 'contratodosimetriasedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('dosimetros.estado_dosimetro', 'EN USO')
        ->where('dosiareacontdosisedes.dosimetro_uso', 'TRUE')
        ->select('dosimetros.id_dosimetro','dosimetros.codigo_dosimeter', 'dosimetros.tipo_dosimetro', 'dosimetros.estado_dosimetro', 'dosimetros.uso_dosimetro', 
        'dosiareacontdosisedes.contdosisededepto_id', 'dosiareacontdosisedes.dosimetro_uso', 'dosiareacontdosisedes.mes_asignacion', 'empresas.id_empresa', 'empresas.nombre_empresa')
        ->get(); 
        $empresasDosimDosiareaLECTURA =  Dosimetro::join('dosiareacontdosisedes','dosimetros.id_dosimetro','=','dosiareacontdosisedes.dosimetro_id')
        ->join('contratodosimetriasededeptos', 'dosiareacontdosisedes.contdosisededepto_id', '=', 'contratodosimetriasededeptos.id_contdosisededepto')
        ->join('contratodosimetriasedes', 'contratodosimetriasededeptos.contratodosimetriasede_id', '=', 'contratodosimetriasedes.id_contratodosimetriasede')
        ->join('sedes', 'contratodosimetriasedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('dosimetros.estado_dosimetro', 'EN LECTURA')
        ->where('dosiareacontdosisedes.dosimetro_uso', 'FALSE')
        ->select('dosimetros.id_dosimetro','dosimetros.codigo_dosimeter', 'dosimetros.tipo_dosimetro', 'dosimetros.estado_dosimetro', 'dosimetros.uso_dosimetro', 
        'dosiareacontdosisedes.contdosisededepto_id', 'dosiareacontdosisedes.dosimetro_uso', 'dosiareacontdosisedes.mes_asignacion', 'empresas.id_empresa', 'empresas.nombre_empresa')
        ->get(); 
        return view('dosimetria.crear_empresas_dosimetria', compact('empresas', 'empresaDosi', 'contdosisededepto','novedadescontdosisededepto', 'dosimetriacontrato', 'dosimetrosUsados', 'dosimestrosLibres', 'dosimetrosEnLectura', 'empresasDosimTrabjUSO', 'empresasDosimTrabjLECTURA', 'empresasDosimDosicontUSO', 'empresasDosimDosicontLECTURA', 'empresasDosimDosiareaUSO', 'empresasDosimDosiareaLECTURA'));
    }
    public function saveEmpresa(Request $request){
        
        $request->validate([
            'id_empresa'      => 'required|unique:App\Models\ContratosDosimetriaEmpresa,empresa_id,',
        ]);
        $empresaDosi = new ContratosDosimetriaEmpresa();

        $empresaDosi->empresa_id                       = $request->id_empresa;
        $empresaDosi->nombre_empresa                   = $empresaDosi->empresa->nombre_empresa;
        $empresaDosi->num_iden_empresa                 = $empresaDosi->empresa->num_iden_empresa;
        $empresaDosi->numtotal_dosi_torax              = 0;
        $empresaDosi->numtotal_dosi_cristalino         = 0;
        $empresaDosi->numtotal_dosi_dedo               = 0;
        $empresaDosi->numtotal_dosi_muñeca             = 0;
        $empresaDosi->numtotal_dosi_control_torax      = 0;
        $empresaDosi->numtotal_dosi_control_cristalino = 0;
        $empresaDosi->numtotal_dosi_control_dedo       = 0;
        $empresaDosi->numtotal_dosi_ambiental          = 0;
        $empresaDosi->numtotal_dosi_caso               = 0; 
        
        $empresaDosi->save();
        return redirect()->route('empresasdosi.create')->with('crear', 'ok'); 
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
        
        $request->validate([
            'codigo_contrato'               => 'required|unique:dosimetriacontratos,codigo_contrato',
            'periodo_recambio_contrato'     => 'required',
            'numlecturas_año'               => 'required',
            'fecha_inicio_contrato'         => 'required',
            'fecha_finalizacion_contrato'   => 'required',
            'id_sede1'                      => 'required',
            'estado_contrato'               => 'required',
            'ocupacion_contrato'            => 'required'
        ]);
        $contratoDosi = new Dosimetriacontrato();

        $contratoDosi->codigo_contrato              = $request->codigo_contrato;
        $contratoDosi->empresa_id                   = $request->empresa_contrato;
        $contratoDosi->fecha_inicio                 = $request->fecha_inicio_contrato;
        $contratoDosi->fecha_finalizacion           = $request->fecha_finalizacion_contrato;
        $contratoDosi->periodo_recambio             = $request->periodo_recambio_contrato;
        $contratoDosi->numlecturas_año              = $request->numlecturas_año;
        $contratoDosi->estado_contrato              = $request->estado_contrato;
        $contratoDosi->ocupacion                    = $request->ocupacion_contrato;

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
                    $contratoDosiSedeDepto->dosi_torax                = $request->input('dosimetro_torax_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_torax_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_area                 = $request->input('dosimetro_area_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_area_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_caso                 = $request->input('dosimetro_caso_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_caso_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_cristalino           = $request->input('dosimetro_cristalino_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_cristalino_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_dedo                 = $request->input('dosimetro_dedo_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_dedo_sede'.$i)[$x];
                    if($request->unicoControl_contrato == 'TRUE'){
                        $contratoDosiSedeDepto->controlTransT_unicoCont = empty($request->dosi_controlTrans_torax_contrato) ? NULL : 'TRUE';
                        $contratoDosiSedeDepto->controlTransC_unicoCont = empty($request->dosi_controlTrans_cristalino_contrato) ? NULL : 'TRUE';
                        $contratoDosiSedeDepto->controlTransA_unicoCont = empty($request->dosi_controlTrans_dedo_contrato) ? NULL : 'TRUE';
                    }else{
                        $contratoDosiSedeDepto->dosi_control_torax        = empty($request->input('dosimetro_control_torax_sede'.$i.'_depa'.($x+1))) ? 0 : 1;
                        $contratoDosiSedeDepto->dosi_control_cristalino   = empty($request->input('dosimetro_control_cristalino_sede'.$i.'_depa'.($x+1)))? 0 : 1;
                        $contratoDosiSedeDepto->dosi_control_dedo         = empty($request->input('dosimetro_control_dedo_sede'.$i.'_depa'.($x+1))) ? 0 : 1;
                    }
                    $contratoDosiSedeDepto->save();

                    $mescontdosisedeDepto = new Mesescontdosisedeptos();
                    $mescontdosisedeDepto->contdosisededepto_id      = $contratoDosiSedeDepto->id_contdosisededepto;
                    $mescontdosisedeDepto->mes_asignacion            = $request->primer_mes_asignacion;
                    $mescontdosisedeDepto->dosi_torax                = $request->input('dosimetro_torax_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_torax_sede'.$i)[$x];
                    $mescontdosisedeDepto->dosi_area                 = $request->input('dosimetro_area_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_area_sede'.$i)[$x];
                    $mescontdosisedeDepto->dosi_caso                 = $request->input('dosimetro_caso_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_caso_sede'.$i)[$x];
                    $mescontdosisedeDepto->dosi_cristalino           = $request->input('dosimetro_cristalino_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_cristalino_sede'.$i)[$x];
                    $mescontdosisedeDepto->dosi_dedo                 = $request->input('dosimetro_dedo_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_dedo_sede'.$i)[$x];
                    if($request->unicoControl_contrato == 'TRUE'){
                        $mescontdosisedeDepto->controlTransT_unicoCont = empty($request->dosi_controlTrans_torax_contrato) ? NULL : 'TRUE';
                        $mescontdosisedeDepto->controlTransC_unicoCont = empty($request->dosi_controlTrans_cristalino_contrato) ? NULL : 'TRUE';
                        $mescontdosisedeDepto->controlTransA_unicoCont = empty($request->dosi_controlTrans_dedo_contrato) ? NULL : 'TRUE';
                    }else{
                        $mescontdosisedeDepto->dosi_control_torax        = empty($request->input('dosimetro_control_torax_sede'.$i.'_depa'.($x+1))) ? 0 : 1;
                        $mescontdosisedeDepto->dosi_control_cristalino   = empty($request->input('dosimetro_control_cristalino_sede'.$i.'_depa'.($x+1))) ? 0 : 1;
                        $mescontdosisedeDepto->dosi_control_dedo         = empty($request->input('dosimetro_control_dedo_sede'.$i.'_depa'.($x+1))) ? 0 : 1;
                    }
                    $mescontdosisedeDepto->save();

                    $numtotalEmpresasDosi = ContratosDosimetriaEmpresa::where('empresa_id', '=', $request->empresa_contrato)->get();
                    foreach($numtotalEmpresasDosi as $totalEmpDosi){

                        $totalEmpDosi->numtotal_dosi_torax              = ($totalEmpDosi->numtotal_dosi_torax + $request->input('dosimetro_torax_sede'.$i)[$x]);
                        $totalEmpDosi->numtotal_dosi_cristalino         = ($totalEmpDosi->numtotal_dosi_cristalino + $request->input('dosimetro_cristalino_sede'.$i)[$x]);
                        $totalEmpDosi->numtotal_dosi_dedo               = ($totalEmpDosi->numtotal_dosi_dedo + $request->input('dosimetro_dedo_sede'.$i)[$x]);
                        $totalEmpDosi->numtotal_dosi_ambiental          = ($totalEmpDosi->numtotal_dosi_ambiental + $request->input('dosimetro_area_sede'.$i)[$x]);
                        $totalEmpDosi->numtotal_dosi_caso               = ($totalEmpDosi->numtotal_dosi_caso + $request->input('dosimetro_caso_sede'.$i)[$x]);
                        if($request->unicoControl_contrato == 'TRUE'){
                            $totalEmpDosi->controlTransT_unicoCont = empty($request->dosi_controlTrans_torax_contrato) ? NULL : 'TRUE';
                            $totalEmpDosi->controlTransC_unicoCont = empty($request->dosi_controlTrans_cristalino_contrato) ? NULL : 'TRUE';
                            $totalEmpDosi->controlTransA_unicoCont = empty($request->dosi_controlTrans_dedo_contrato) ? NULL : 'TRUE';
                        }else{
                            $totalEmpDosi->numtotal_dosi_control_torax      = empty($request->input('dosimetro_control_torax_sede'.$i.'_depa'.($x+1))) ? $totalEmpDosi->numtotal_dosi_control_torax : ($totalEmpDosi->numtotal_dosi_control_torax + 1);
                            $totalEmpDosi->numtotal_dosi_control_cristalino = empty($request->input('dosimetro_control_cristalino_sede'.$i.'_depa'.($x+1))) ? $totalEmpDosi->numtotal_dosi_control_cristalino : ($totalEmpDosi->numtotal_dosi_control_cristalino + 1);
                            $totalEmpDosi->numtotal_dosi_control_dedo       = empty($request->input('dosimetro_control_dedo_sede'.$i.'_depa'.($x+1))) ? $totalEmpDosi->numtotal_dosi_control_dedo : ($totalEmpDosi->numtotal_dosi_control_dedo + 1);
                        }
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
        
        $pdf =  PDF::loadView('dosimetria.contratoPDF_dosimetria', compact('contrato', 'contdosi'));
        $pdf->setPaper('A4', 'portrait');
        $n = $contdosi;
        $titulo = str_pad($n, 5, "0", STR_PAD_LEFT); 
        /* return $pdf->stream(); */
        return $pdf->stream("QA-CTO-DP-".$titulo.".pdf");
        
    }

    public function editContratodosi($empresa, $id){
        $contrato = Dosimetriacontrato::find($id);
        $sedes = Sede::where('empresas_id', '=', $empresa)->get();
        /* SELECT * FROM `contratodosimetriasededeptos` INNER JOIN departamentosedes ON contratodosimetriasededeptos.departamentosede_id = departamentosedes.id_departamentosede 
        INNER JOIN contratodosimetriasedes ON contratodosimetriasededeptos.contratodosimetriasede_id = contratodosimetriasedes.id_contratodosimetriasede 
        INNER JOIN sedes ON contratodosimetriasedes.sede_id = sedes.id_sede 
        INNER JOIN dosimetriacontratos ON contratodosimetriasedes.contratodosimetria_id = dosimetriacontratos.id_contratodosimetria;*/
        $sedesdeptos = Contratodosimetriasededepto::join('departamentosedes', 'departamentosede_id', '=', 'id_departamentosede')
        ->join('departamentos', 'departamento_id', '=', 'id_departamento')
        ->join('sedes', 'sede_id', '=', 'id_sede')
        ->join('contratodosimetriasedes', 'contratodosimetriasede_id', '=', 'id_contratodosimetriasede')
        ->join('dosimetriacontratos', 'contratodosimetria_id', '=', 'id_contratodosimetria')
        ->where('id_contratodosimetria', '=', $id)
        /* ->select('id_contratodosimetriasede', 'id_contdosisededepto', 'id_sede', 'nombre_sede', 'id_departamentosede', 'nombre_departamento', 'dosi_torax', 'dosi_control', 'dosi_area', 'dosi_caso', 'dosi_cristalino', 'dosi_muñeca', 'dosi_dedo') */
        ->get();
        $departamentos = Departamento::join('departamentosedes', 'departamentos.id_departamento', '=', 'departamentosedes.departamento_id')
        ->join('sedes', 'departamentosedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('empresas.id_empresa', $empresa)
        ->get();
       
        /* return $departamentos; */
        return view('dosimetria.edit_contrato_dosimetria', compact('contrato', 'sedesdeptos', 'sedes', 'departamentos', 'empresa'));
    }
    public function updateContratodosi(Request $request, $contrato){
        /* return $request; */
        $request->validate([
            
            'periodo_recambio_contrato'     => 'required',
            'fecha_inicio_contrato'         => 'required',
            'fecha_finalizacion_contrato'   => 'required',
            'estado_contrato'               => 'required',
        ]);
        $contratodosi = Dosimetriacontrato::find($contrato);

        $contratodosi->codigo_contrato              = $request->codigo_contrato;
        $contratodosi->empresa_id                   = $request->empresa_contrato;
        $contratodosi->fecha_inicio                 = $request->fecha_inicio_contrato;
        $contratodosi->fecha_finalizacion           = $request->fecha_finalizacion_contrato;
        $contratodosi->periodo_recambio             =  mb_strtoupper($request->periodo_recambio_contrato);
        $contratodosi->estado_contrato              = $request->estado_contrato;
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
                    $contratoDosiSedeDepto->ocupacion                 = $request->input('ocupacion_sede'.$i)[$x];
                    $contratoDosiSedeDepto->departamentosede_id       = $request->input('departamentos_sede'.$i)[$x];
                    $contratoDosiSedeDepto->mes_actual                = $request->input('periodo_actual_sede'.$i)[$x];
                    /* $contratoDosiSedeDepto->dosi_control              = $request->input('dosimetro_control_sede'.$i)[$x]; */
                    $contratoDosiSedeDepto->dosi_control_torax        = empty($request->input('dosimetro_control_torax_sede'.$i)[$x]) ? 0 : 1;
                    $contratoDosiSedeDepto->dosi_control_cristalino   = empty($request->input('dosimetro_control_cristalino_sede'.$i)[$x])? 0 : 1;
                    $contratoDosiSedeDepto->dosi_control_dedo         = empty($request->input('dosimetro_control_dedo_sede'.$i)[$x]) ? 0 : 1;
                    $contratoDosiSedeDepto->dosi_torax                = $request->input('dosimetro_torax_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_torax_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_area                 = $request->input('dosimetro_area_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_area_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_caso                 = $request->input('dosimetro_caso_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_caso_sede'.$i)[$x];
                    $contratoDosiSedeDepto->dosi_cristalino           = $request->input('dosimetro_cristalino_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_cristalino_sede'.$i)[$x];
                    /* $contratoDosiSedeDepto->dosi_muñeca               = $request->input('dosimetro_muneca_sede'.$i)[$x]; */
                    $contratoDosiSedeDepto->dosi_dedo                 = $request->input('dosimetro_dedo_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_dedo_sede'.$i)[$x];
                    $contratoDosiSedeDepto->save();

                    $mescontdosisedeDepto = new Mesescontdosisedeptos();
                    $mescontdosisedeDepto->contdosisededepto_id      = $contratoDosiSedeDepto->id_contdosisededepto;
                    $mescontdosisedeDepto->mes_asignacion            = $request->input('periodo_actual_sede'.$i)[$x];
                    $mescontdosisedeDepto->dosi_control_torax        = empty($request->input('dosimetro_control_torax_sede'.$i)[$x]) ? 0 : 1;
                    $mescontdosisedeDepto->dosi_control_cristalino   = empty($request->input('dosimetro_control_cristalino_sede'.$i)[$x]) ? 0 : 1;
                    $mescontdosisedeDepto->dosi_control_dedo         = empty($request->input('dosimetro_control_dedo_sede'.$i)[$x]) ? 0 : 1;
                    $mescontdosisedeDepto->dosi_torax                = $request->input('dosimetro_torax_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_torax_sede'.$i)[$x];
                    $mescontdosisedeDepto->dosi_area                 = $request->input('dosimetro_area_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_area_sede'.$i)[$x];
                    $mescontdosisedeDepto->dosi_caso                 = $request->input('dosimetro_caso_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_caso_sede'.$i)[$x];
                    $mescontdosisedeDepto->dosi_cristalino           = $request->input('dosimetro_cristalino_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_cristalino_sede'.$i)[$x];
                    /* $mescontdosisedeDepto->dosi_muñeca               = $request->input('dosimetro_muneca_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_muneca_sede'.$i)[$x]; */
                    $mescontdosisedeDepto->dosi_dedo                 = $request->input('dosimetro_dedo_sede'.$i)[$x] == NULL ? 0 : $request->input('dosimetro_dedo_sede'.$i)[$x];
                    $mescontdosisedeDepto->save();

                    $numtotalEmpresasDosi = ContratosDosimetriaEmpresa::where('empresa_id', '=', $request->empresa_contrato)->get();
                    foreach($numtotalEmpresasDosi as $totalEmpDosi){

                        $totalEmpDosi->numtotal_dosi_torax              = ($totalEmpDosi->numtotal_dosi_torax + $request->input('dosimetro_torax_sede'.$i)[$x]);
                        $totalEmpDosi->numtotal_dosi_cristalino         = ($totalEmpDosi->numtotal_dosi_cristalino + $request->input('dosimetro_cristalino_sede'.$i)[$x]);
                        $totalEmpDosi->numtotal_dosi_dedo               = ($totalEmpDosi->numtotal_dosi_dedo + $request->input('dosimetro_dedo_sede'.$i)[$x]);
                        /* $totalEmpDosi->numtotal_dosi_muñeca             = ($totalEmpDosi->numtotal_dosi_muñeca + $request->input('dosimetro_muneca_sede'.$i)[$x]); */
                        $totalEmpDosi->numtotal_dosi_control_torax      = empty($request->input('dosimetro_control_torax_sede'.$i)[$x]) ? $totalEmpDosi->numtotal_dosi_control_torax : ($totalEmpDosi->numtotal_dosi_control_torax + 1);
                        $totalEmpDosi->numtotal_dosi_control_cristalino = empty($request->input('dosimetro_control_cristalino_sede'.$i)[$x]) ? $totalEmpDosi->numtotal_dosi_control_cristalino : ($totalEmpDosi->numtotal_dosi_control_cristalino + 1);
                        $totalEmpDosi->numtotal_dosi_control_dedo       = empty($request->input('dosimetro_control_dedo_sede'.$i)[$x]) ? $totalEmpDosi->numtotal_dosi_control_dedo : ($totalEmpDosi->numtotal_dosi_control_dedo + 1);
                        $totalEmpDosi->numtotal_dosi_ambiental          = ($totalEmpDosi->numtotal_dosi_ambiental + $request->input('dosimetro_area_sede'.$i)[$x]);
                        $totalEmpDosi->numtotal_dosi_caso               = ($totalEmpDosi->numtotal_dosi_caso + $request->input('dosimetro_caso_sede'.$i)[$x]);
                        $totalEmpDosi->save();
                    }
                }
            }else{
                break;
            }
        }
        return redirect()->route('contratosdosi.createlist', $request->empresa_contrato)->with('actualizar', 'ok');
    }
    public function updateContsedepto(Request $request, $contratodosisede, $contratodosisededepto){
        /*  return $request; */
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
        $numtotalEmpresasDosi = ContratosDosimetriaEmpresa::where('empresa_id', '=', $request->empresa_contrato)->get();
        foreach($numtotalEmpresasDosi as $totalEmpDosi){
            if($request->num_dosi_torax_contrato_sede != $contdosisededepto->dosi_control_torax){
                $totalEmpDosi->numtotal_dosi_torax              = ($totalEmpDosi->numtotal_dosi_torax - $contdosisededepto->dosi_control_torax + $request->num_dosi_torax_contrato_sede);
            }
            if($request->num_dosi_cristalino_contrato_sede != $contdosisededepto->dosi_cristalino){
                $totalEmpDosi->numtotal_dosi_cristalino         = ($totalEmpDosi->numtotal_dosi_cristalino - $contdosisededepto->dosi_cristalino + $request->num_dosi_cristalino_contrato_sede);
            }
            if($request->num_dosi_dedo_contrato_sede != $contdosisededepto->dosi_dedo){
                $totalEmpDosi->numtotal_dosi_dedo               = ($totalEmpDosi->numtotal_dosi_dedo - $contdosisededepto->dosi_dedo + $request->num_dosi_dedo_contrato_sede);
            }
            if($request->num_dosi_area_contrato_sede != $contdosisededepto->dosi_area){
                $totalEmpDosi->numtotal_dosi_ambiental          = ($totalEmpDosi->numtotal_dosi_ambiental - $contdosisededepto->dosi_area + $request->num_dosi_area_contrato_sede);
            }
            if($request->num_dosi_caso_contrato_sede != $contdosisededepto->dosi_caso){
                $totalEmpDosi->numtotal_dosi_caso               = ($totalEmpDosi->numtotal_dosi_caso  - $contdosisededepto->dosi_caso + $request->num_dosi_caso_contrato_sede);
            }
            if($request->num_dosi_controlTorax_contrato_sede == 1 && $contdosisededepto->dosi_control_torax == 0){
                $totalEmpDosi->numtotal_dosi_control_torax      = ($totalEmpDosi->numtotal_dosi_control_torax + 1);
            }
            if($request->num_dosi_controlCristalino_contrato_sede == 1 && $contdosisededepto->dosi_control_cristalino == 0){
                $totalEmpDosi->numtotal_dosi_control_cristalino      = ($totalEmpDosi->numtotal_dosi_control_cristalino + 1);
            }
            if($request->num_dosi_controlDedo_contrato_sede == 1 && $contdosisededepto->dosi_control_dedo == 0){
                $totalEmpDosi->numtotal_dosi_control_dedo      = ($totalEmpDosi->numtotal_dosi_control_dedo + 1);
            }
            
            $totalEmpDosi->save();
        }
        $contdosisededepto->contratodosimetriasede_id   = $contratodosisede;
        $contdosisededepto->ocupacion                   = $request->ocupacion_contrato_sede;
        $contdosisededepto->departamentosede_id         = $request->departamento_sede;
        $contdosisededepto->dosi_control_torax          = $request->num_dosi_controlTorax_contrato_sede == null ? 0 : $request->num_dosi_controlTorax_contrato_sede;
        $contdosisededepto->dosi_control_cristalino     = $request->num_dosi_controlCristalino_contrato_sede == null ? 0 : $request->num_dosi_controlCristalino_contrato_sede;
        $contdosisededepto->dosi_control_dedo           = $request->num_dosi_dedo_contrato_sede == null ? 0 : $request->num_dosi_dedo_contrato_sede;
        $contdosisededepto->dosi_torax                  = $request->num_dosi_torax_contrato_sede == null ? 0 : $request->num_dosi_torax_contrato_sede;
        $contdosisededepto->dosi_area                   = $request->num_dosi_area_contrato_sede == null ? 0 : $request->num_dosi_area_contrato_sede;
        $contdosisededepto->dosi_caso                   = $request->num_dosi_caso_contrato_sede == null ? 0 : $request->num_dosi_caso_contrato_sede;
        $contdosisededepto->dosi_cristalino             = $request->num_dosi_cristalino_contrato_sede == null ? 0 : $request->num_dosi_cristalino_contrato_sede;
        $contdosisededepto->dosi_dedo                   = $request->num_dosi_dedo_contrato_sede == null ? 0 : $request->num_dosi_dedo_contrato_sede;
        /* $contdosisededepto->dosi_muñeca                 = $request->num_dosi_muneca_contrato_sede; */

        $contdosisededepto->save();  

        $mescontdosisedeDepto = new Mesescontdosisedeptos();
        $mescontdosisedeDepto->contdosisededepto_id      = $request->contdosisededepto;
        $mescontdosisedeDepto->mes_asignacion            = $request->mesactual_contrato;
        $mescontdosisedeDepto->dosi_control_torax        = $request->num_dosi_controlTorax_contrato_sede == null ? 0 : $request->num_dosi_controlTorax_contrato_sede;
        $mescontdosisedeDepto->dosi_control_cristalino   = $request->num_dosi_controlCristalino_contrato_sede == null ? 0 : $request->num_dosi_controlCristalino_contrato_sede;
        $mescontdosisedeDepto->dosi_control_dedo         = $request->num_dosi_controlDedo_contrato_sede == null ? 0 : $request->num_dosi_controlDedo_contrato_sede;
        $mescontdosisedeDepto->dosi_torax                = $request->num_dosi_torax_contrato_sede == null ? 0 : $request->num_dosi_torax_contrato_sede;
        $mescontdosisedeDepto->dosi_area                 = $request->num_dosi_area_contrato_sede == null ? 0 : $request->num_dosi_area_contrato_sede;
        $mescontdosisedeDepto->dosi_caso                 = $request->num_dosi_caso_contrato_sede == null ? 0 : $request->num_dosi_caso_contrato_sede;
        $mescontdosisedeDepto->dosi_cristalino           = $request->num_dosi_cristalino_contrato_sede == null ? 0 : $request->num_dosi_cristalino_contrato_sede;
        $mescontdosisedeDepto->dosi_dedo                 = $request->num_dosi_dedo_contrato_sede == null ? 0 : $request->num_dosi_dedo_contrato_sede;
        /* $mescontdosisedeDepto->dosi_muñeca               = $request->; */
        $mescontdosisedeDepto->save();
       
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
        ->select('nombre_empresa', 'nombre_sede', 'codigo_contrato','fecha_inicio', 'fecha_finalizacion', 'periodo_recambio','nombre_departamento', 'mes_actual', 'dosi_control_torax', 'dosi_control_cristalino', 'dosi_control_dedo', 'controlTransT_unicoCont', 'controlTransC_unicoCont', 'controlTransA_unicoCont','dosi_torax', 'dosi_area', 'dosi_caso', 'dosi_cristalino', 'dosi_muñeca', 'dosi_dedo', 'id_contdosisededepto', 'contratodosimetriasede_id', 'id_contratodosimetria', 'ocupacion', 'numlecturas_año') 
        ->where('id_contratodosimetria', '=', $id)
        ->get();
        $dosimeNovcontrasedeptos =  Dosimetriacontrato::join('empresas', 'empresa_id', '=', 'id_empresa')
        ->join('contratodosimetriasedes', 'id_contratodosimetria', '=', 'contratodosimetria_id')
        ->join('sedes', 'sede_id', '=', 'id_sede')
        ->join('contratodosimetriasededeptos', 'id_contratodosimetriasede', '=', 'contratodosimetriasede_id')
        ->join('departamentosedes', 'departamentosede_id', '=', 'id_departamentosede')
        ->join('departamentos', 'departamento_id', '=', 'id_departamento')
        ->join('novcontdosisededeptos', 'id_contdosisededepto', '=', 'contdosisededepto_id')
        ->select('novcontdosisededeptos.id_novcontdosisededepto','novcontdosisededeptos.contdosisededepto_id','departamentos.nombre_departamento', 'novcontdosisededeptos.mes_asignacion', 'novcontdosisededeptos.dosi_control_torax', 'novcontdosisededeptos.dosi_control_cristalino', 'novcontdosisededeptos.dosi_control_dedo','novcontdosisededeptos.dosi_torax', 'novcontdosisededeptos.dosi_area', 'novcontdosisededeptos.dosi_caso', 'novcontdosisededeptos.dosi_cristalino','novcontdosisededeptos.dosi_dedo', 'novcontdosisededeptos.estado_nov') 
        ->where('id_contratodosimetria', '=', $id)
        ->get();
       /*  return $dosimeNovcontrasedeptos; */
        return view('dosimetria.detalle_contrato_dosimetria', compact('dosimetriacontrato', 'dosimecontrasedeptos','dosimeNovcontrasedeptos'));
    }

    public function createdetsedeContrato($id){
        $dosisededeptocontra = Contratodosimetriasededepto::find($id);
        
        $mescontdosisededepto = Mesescontdosisedeptos::where('contdosisededepto_id', '=', $id)->latest()->first();
        
        $trabjasigcontra = Trabajadordosimetro::where('contdosisededepto_id', '=', $id)
        ->get();
        $areasigcontra = Dosiareacontdosisede::where('contdosisededepto_id', '=', $id)
        ->get();
        $mesTotalTrabjasignados[0] = 'nada';
        for($i= 1; $i<=12; $i++){
            $mes='mes'.$i.'Assign';
            $$mes=Trabajadordosimetro::where('contdosisededepto_id', $id)
            ->where('novcontdosisededepto_id', NULL)
            ->where('mes_asignacion', $i)
            ->select("*")
            ->count();
            array_push($mesTotalTrabjasignados, $$mes);
        }
        
        $mesTotalAreasignados[0] = 'nada';
        for($i= 1; $i<=12; $i++){
            $mes='mes'.$i.'Assign';
            $$mes=Dosiareacontdosisede::where('contdosisededepto_id', $id)
            ->where('novcontdosisededepto_id', NULL)
            ->where('mes_asignacion', $i)
            ->select("*")
            ->count();
            array_push($mesTotalAreasignados, $$mes);
            
        }
        $mesesAssigTrabj[0] = 'nada';
        for($i= 1; $i<=12; $i++){
            $mes='mesAssignRev'.$i;
            $$mes=Trabajadordosimetro::where('contdosisededepto_id', $id)
            ->where('novcontdosisededepto_id', NULL)
            ->where('mes_asignacion', $i)
            ->get();

            array_push($mesesAssigTrabj, $$mes);
            
        }
        $mesesAssigArea[0] = 'nada';
        for($i= 1; $i<=12; $i++){
            $mes='mesAssignRev'.$i;
            $$mes=Dosiareacontdosisede::where('contdosisededepto_id', $id)
            ->where('novcontdosisededepto_id', NULL)
            ->where('mes_asignacion', $i)
            ->get();

            array_push($mesesAssigArea, $$mes);
            
        }
        /* return $mesesAssigArea; */
        $periodo = $dosisededeptocontra->contratodosimetriasede->dosimetriacontrato->periodo_recambio;
        if($periodo == 'TRIMS'){
            return view('dosimetria.detalle_sede_contrato_trimestral_dosimetria', compact('dosisededeptocontra', 'trabjasigcontra', 'areasigcontra', 'mesTotalTrabjasignados','mesTotalAreasignados', 'mescontdosisededepto', 'mesesAssigTrabj', 'mesesAssigArea'));
        }else if($periodo == 'MENS'){
            return view('dosimetria.detalle_sede_contrato_dosimetria', compact('dosisededeptocontra', 'trabjasigcontra', 'areasigcontra', 'mesTotalTrabjasignados','mesTotalAreasignados', 'mescontdosisededepto', 'mesesAssigTrabj', 'mesesAssigArea'));
        }else if($periodo == 'BIMS'){
            return view('dosimetria.detalle_sede_contrato_bimensual_dosimetria', compact('dosisededeptocontra', 'trabjasigcontra', 'areasigcontra', 'mesTotalTrabjasignados','mesTotalAreasignados', 'mescontdosisededepto', 'mesesAssigTrabj', 'mesesAssigArea'));
        }
    }
    public function createdetsedeSubEspCont($id){
        $novcontdosisededepto = Novcontdosisededepto::find($id);
        $mescontdosisededepto = Mesescontdosisedeptos::where('contdosisededepto_id', '=', $id)->latest()->first();
        $trabjasigcontra = Trabajadordosimetro::where('novcontdosisededepto_id', '=', $id)
        ->get();
        $areasigcontra = Dosiareacontdosisede::where('novcontdosisededepto_id', '=', $id)
        ->get();
        return view('dosimetria.detalle_sede_contrato_subEsp_dosimetria', compact('novcontdosisededepto', 'areasigcontra', 'trabjasigcontra'));
    }
    /* public function asignaDosiContrato($id, $mesnumber){
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
        
    } */
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

    public function asignaDosiContratoM1($id, $mesnumber){ 
        $contdosisededepto = Contratodosimetriasededepto::find($id);
        
        $personaSede = Persona::join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
        ->join('personasroles', 'personas.id_persona', '=', 'personasroles.persona_id')
        ->join('roles', 'personasroles.rol_id', '=', 'roles.id_rol')
        ->where('personasedes.sede_id','=', $contdosisededepto->contratodosimetriasede->sede->id_sede)
        ->where(function($query) {
            $query->orWhere('roles.nombre_rol', 'TOE')
                  ->orWhere('roles.nombre_rol', 'OPR')
                  ->orWhere('roles.nombre_rol', 'PUBLICO');
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
        ///////DOSIMETROS DE CONTROL UNICOS PARA EL CONTRATO//////
        $dosimControlTransT = Dosicontrolcontdosisede::where('contratodosimetria_id', '=', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
        ->where('mes_asignacion', '=', 1)
        ->where('controlTransT_unicoCont', '=', 'TRUE')
        ->get();
        /* if(!isset($dosimControlTransT[0])){
            return "ARRAY VACIO";
        }else{ 
            return "ARRAY";
        } */
        $dosimControlTransC = Dosicontrolcontdosisede::where('contratodosimetria_id', '=', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
        ->where('mes_asignacion', '=', 1)
        ->where('controlTransC_unicoCont', '=', 'TRUE')
        ->get(); 
        $dosimControlTransA = Dosicontrolcontdosisede::where('contratodosimetria_id', '=', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
        ->where('mes_asignacion', '=', 1)
        ->where('controlTransA_unicoCont', '=', 'TRUE')
        ->get();
        return view('dosimetria.asignar_dosimetro_contrato_m1', compact('mesnumber','contdosisededepto', 'dosimLibresGeneral', 'areaSede', 'dosimLibresAmbiental', 'personaSede', 'dosimLibresEzclip', 'holderLibresCristalino', 'holderLibresExtrem', 'holderLibresAnillo', 'dosimControlTransT', 'dosimControlTransC', 'dosimControlTransA'));
        /* return $personaSede; */
    }
    public function saveAsignacionDosiContratoM1(Request $request, $asigdosicont, $mesnumber){
        /* return $request; */
      
        ////////////////// SAVE DE DOSIMETRO TIPO  CONTROL TORAX  /////////////////////////

        if(!empty($request->id_dosimetro_asigdosimControlTorax)){

            for($i=0; $i<count($request->id_dosimetro_asigdosimControlTorax); $i++){
                $asigdosim_control = new Dosicontrolcontdosisede();
    
                $asigdosim_control->dosimetro_id                = $request->id_dosimetro_asigdosimControlTorax[$i];
                $asigdosim_control->contratodosimetriasede_id   = $request->id_contrato_asigdosim_sede;
                $asigdosim_control->contdosisededepto_id        = $request->id_departamento_asigdosim;
                $asigdosim_control->mes_asignacion              = $request->mesNumber1;
                $asigdosim_control->dosimetro_uso               = 'TRUE';
                $asigdosim_control->primer_dia_uso              = $request->primerDia_asigdosim;
                $asigdosim_control->ultimo_dia_uso              = $request->ultimoDia_asigdosim;
                $asigdosim_control->fecha_dosim_enviado         = $request->fecha_envio_dosim_asignado;
                $asigdosim_control->ubicacion                   = 'TORAX';
                $asigdosim_control->energia                     = $request->energia_asigdosim;
    
                $asigdosim_control->save();

                $estadoDosimControlTorax = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimControlTorax[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro'    => 'CONTROL TÓRAX'
                ]);
            }
        }else if(!empty($request->id_dosimetro_ControlToraxUnico)){
            $asigdosim_controlTransT = new Dosicontrolcontdosisede();
            
            $asigdosim_controlTransT->dosimetro_id                = $request->id_dosimetro_ControlToraxUnico;
            $asigdosim_controlTransT->contratodosimetria_id       = $request->id_contrato_asigdosim;
            $asigdosim_controlTransT->mes_asignacion              = $request->mesNumber1;
            $asigdosim_controlTransT->dosimetro_uso               = 'TRUE';
            $asigdosim_controlTransT->primer_dia_uso              = $request->primerDia_asigdosim;
            $asigdosim_controlTransT->ultimo_dia_uso              = $request->ultimoDia_asigdosim;
            $asigdosim_controlTransT->fecha_dosim_enviado         = $request->fecha_envio_dosim_asignado;
            $asigdosim_controlTransT->ubicacion                   = 'TORAX';
            $asigdosim_controlTransT->energia                     = $request->energia_asigdosim;
            $asigdosim_controlTransT->controlTransT_unicoCont     = 'TRUE';

            $asigdosim_controlTransT->save();

            $estadoDosimControlTorax = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_ControlToraxUnico)
            ->update([
                'estado_dosimetro' => 'EN USO',
                'uso_dosimetro'    => 'CONTROL TÓRAX'
            ]);
        }
        ////////////////// SAVE DE DOSIMETRO TIPO  CONTROL CRISTALINO  /////////////////////////

        if(!empty($request->id_dosimetro_asigdosimControlCristalino)){

            for($i=0; $i<count($request->id_dosimetro_asigdosimControlCristalino); $i++){
                $asigdosim_control = new Dosicontrolcontdosisede();
    
                $asigdosim_control->dosimetro_id                = $request->id_dosimetro_asigdosimControlCristalino[$i];
                $asigdosim_control->holder_id                   = $request->id_holder_asigdosimControlCristalino[$i];
                $asigdosim_control->contratodosimetriasede_id   = $request->id_contrato_asigdosim_sede;
                $asigdosim_control->contdosisededepto_id        = $request->id_departamento_asigdosim;
                $asigdosim_control->mes_asignacion              = $request->mesNumber1;
                $asigdosim_control->dosimetro_uso               = 'TRUE';
                $asigdosim_control->primer_dia_uso              = $request->primerDia_asigdosim;
                $asigdosim_control->ultimo_dia_uso              = $request->ultimoDia_asigdosim;
                $asigdosim_control->fecha_dosim_enviado         = $request->fecha_envio_dosim_asignado;
                $asigdosim_control->ubicacion                   = 'CRISTALINO';
                $asigdosim_control->energia                     = $request->energia_asigdosim;
    
                $asigdosim_control->save();

                $estadoDosimControlCristalino = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimControlCristalino[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro'    => 'CONTROL CRISTALINO'
                ]);
                $estadoHolderControlCristalino = Holder::where('id_holder', '=', $request->id_holder_asigdosimControlCristalino[$i])
                ->update([
                    'estado_holder'    => 'EN USO',
                ]);
            }
        }else if(!empty($request->id_dosimetro_ControlCristalinoUnico)){
            $asigdosim_controlTransC = new Dosicontrolcontdosisede();

            $asigdosim_controlTransC->dosimetro_id                = $request->id_dosimetro_ControlCristalinoUnico;
            $asigdosim_controlTransC->holder_id                   = $request->id_holder_ControlCristalinoUnico;
            $asigdosim_controlTransC->contratodosimetria_id       = $request->id_contrato_asigdosim;
            $asigdosim_controlTransC->mes_asignacion              = $request->mesNumber1;
            $asigdosim_controlTransC->dosimetro_uso               = 'TRUE';
            $asigdosim_controlTransC->primer_dia_uso              = $request->primerDia_asigdosim;
            $asigdosim_controlTransC->ultimo_dia_uso              = $request->ultimoDia_asigdosim;
            $asigdosim_controlTransC->fecha_dosim_enviado         = $request->fecha_envio_dosim_asignado;
            $asigdosim_controlTransC->ubicacion                   = 'CRISTALINO';
            $asigdosim_controlTransC->energia                     = $request->energia_asigdosim;
            $asigdosim_controlTransC->controlTransC_unicoCont     = 'TRUE';

            $asigdosim_controlTransC->save();

            $estadoDosimControlCristalino = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_ControlCristalinoUnico)
            ->update([
                'estado_dosimetro' => 'EN USO',
                'uso_dosimetro'    => 'CONTROL CRISTALINO'
            ]);
            $estadoHolderControlCristalino = Holder::where('id_holder', '=',   $request->id_holder_ControlCristalinoUnico)
            ->update([
                'estado_holder'    => 'EN USO',
            ]);
        }
        ////////////////// SAVE DE DOSIMETRO TIPO  CONTROL DEDO/////////////////////////

        if(!empty($request->id_dosimetro_asigdosimControlDedo)){

            for($i=0; $i<count($request->id_dosimetro_asigdosimControlDedo); $i++){
                $asigdosim_control = new Dosicontrolcontdosisede();
    
                $asigdosim_control->dosimetro_id                = $request->id_dosimetro_asigdosimControlDedo[$i];
                $asigdosim_control->holder_id                   = $request->id_holder_asigdosimControlDedo[$i];
                $asigdosim_control->contratodosimetriasede_id   = $request->id_contrato_asigdosim_sede;
                $asigdosim_control->contdosisededepto_id        = $request->id_departamento_asigdosim;
                $asigdosim_control->mes_asignacion              = $request->mesNumber1;
                $asigdosim_control->dosimetro_uso               = 'TRUE';
                $asigdosim_control->primer_dia_uso              = $request->primerDia_asigdosim;
                $asigdosim_control->ultimo_dia_uso              = $request->ultimoDia_asigdosim;
                $asigdosim_control->fecha_dosim_enviado         = $request->fecha_envio_dosim_asignado;
                $asigdosim_control->ubicacion                   = 'ANILLO';
                $asigdosim_control->energia                     = $request->energia_asigdosim;
    
                $asigdosim_control->save();

                $estadoDosimControl = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimControlDedo[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro'    => 'CONTROL ANILLO'
                ]);
                $estadoHolderControlDedo = Holder::where('id_holder', '=', $request->id_holder_asigdosimControlDedo[$i])
                ->update([
                    'estado_holder'    => 'EN USO',
                ]);
            }
        }else if(!empty($request->id_dosimetro_ControlDedoUnico)){
            $asigdosim_controlTransA = new Dosicontrolcontdosisede();
    
            $asigdosim_controlTransA->dosimetro_id                = $request->id_dosimetro_ControlDedoUnico;
            $asigdosim_controlTransA->holder_id                   = $request->id_holder_ControlDedoUnico;
            $asigdosim_controlTransA->contratodosimetria_id       = $request->id_contrato_asigdosim;
            $asigdosim_controlTransA->mes_asignacion              = $request->mesNumber1;
            $asigdosim_controlTransA->dosimetro_uso               = 'TRUE';
            $asigdosim_controlTransA->primer_dia_uso              = $request->primerDia_asigdosim;
            $asigdosim_controlTransA->ultimo_dia_uso              = $request->ultimoDia_asigdosim;
            $asigdosim_controlTransA->fecha_dosim_enviado         = $request->fecha_envio_dosim_asignado;
            $asigdosim_controlTransA->ubicacion                   = 'ANILLO';
            $asigdosim_controlTransA->energia                     = $request->energia_asigdosim;
            $asigdosim_controlTransA->controlTransA_unicoCont     = 'TRUE';

            $asigdosim_controlTransA->save();

            $estadoDosimControl = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_ControlDedoUnico)
            ->update([
                'estado_dosimetro' => 'EN USO',
                'uso_dosimetro'    => 'CONTROL ANILLO'
            ]);
            $estadoHolderControlDedo = Holder::where('id_holder', '=', $request->id_holder_ControlDedoUnico)
            ->update([
                'estado_holder'    => 'EN USO',
            ]);
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
                $asigdosimArea->energia                     = $request->energia_asigdosim;

                $asigdosimArea->save();
                $estadoDosimArea = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimArea[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro'    => 'AMBIENTAL'
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
                /* $asigdosimCristalino->ocupacion                 = $request->ocupacion_asigdosimCristalino[$i]; */
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
                /* $asigdosimMuneca->ocupacion                 = $request->ocupacion_asigdosimMuneca[$i]; */
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
                /* $asigdosimDedo->ocupacion                 = $request->ocupacion_asigdosimDedo[$i]; */
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
        return redirect()->route('detallesedecont.create', $asigdosicont)->with('crear', 'ok');
    }
    public function asignaDosiContratoMn($id, $mesnumber){
        $contdosisededepto = Contratodosimetriasededepto::find($id);
        /* return $contdosisededepto; */
        $mescontdosisededepto = Mesescontdosisedeptos::where('contdosisededepto_id', '=', $id)->latest()->first();
        /* $trabajadoreSede = Trabajadorsede::where('sede_id', '=', $contdosisededepto->contratodosimetriasede->sede->id_sede)
        ->get(); */
        $personaSede = Persona::join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
        ->join('personasroles', 'personas.id_persona', '=', 'personasroles.persona_id')
        ->join('roles', 'personasroles.rol_id', '=', 'roles.id_rol')
        ->where('personasedes.sede_id','=', $contdosisededepto->contratodosimetriasede->sede->id_sede)
        ->where(function($query) {
            $query->orWhere('roles.nombre_rol', 'TOE')
                  ->orWhere('roles.nombre_rol', 'OPR')
                  ->orWhere('roles.nombre_rol', 'PUBLICO');
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
        
        $dosicontrolToraxmesant = Dosicontrolcontdosisede::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber-1)
        /* ->where('novcontdosisededepto_id', NULL) */
        ->where('ubicacion', 'TORAX')
        ->get();
        $dosicontrolCristalinomesant = Dosicontrolcontdosisede::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber-1)
        /* ->where('novcontdosisededepto_id', NULL) */
        ->where('ubicacion', 'CRISTALINO')
        ->get();
        $dosicontrolDedomesant = Dosicontrolcontdosisede::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber-1)
        ->where('novcontdosisededepto_id', NULL)
        ->where('ubicacion', 'ANILLO')
        ->get();

        /////DOSIMETROS DE CONTROL TRANSPORTE UNICO POR CONTRATO/////
        $dosicontrolToraxUnicomesact =  Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
        ->where('mes_asignacion', $mesnumber)
        ->where('ubicacion', 'TORAX')
        ->where('controlTransT_unicoCont', 'TRUE')
        ->get();
        
        $dosicontrolToraxUnicomesant =  Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
        ->where('mes_asignacion', $mesnumber-1)
        ->where('ubicacion', 'TORAX')
        ->where('controlTransT_unicoCont', 'TRUE')
        ->get();
        
        $dosicontrolCristalinoUnicomesact = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
        ->where('mes_asignacion', $mesnumber)
        ->where('ubicacion', 'CRISTALINO')
        ->where('controlTransC_unicoCont', 'TRUE')
        ->get();
       
        $dosicontrolCristalinoUnicomesant = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
        ->where('mes_asignacion', $mesnumber-1)
        ->where('ubicacion', 'CRISTALINO') 
        ->where('controlTransC_unicoCont', 'TRUE')
        ->get();
        $dosicontrolDedoUnicomesact = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
        ->where('mes_asignacion', $mesnumber)
        ->where('ubicacion', 'ANILLO')
        ->where('controlTransA_unicoCont', 'TRUE')
        ->get();
        $dosicontrolDedoUnicomesant = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
        ->where('mes_asignacion', $mesnumber-1)
        ->where('ubicacion', 'ANILLO')
        ->where('controlTransA_unicoCont', 'TRUE')
        ->get();
        //////////////////////////////////////////////////////////////////

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
        /* return $dosicontrolCristalinomesant; */
        return view('dosimetria.asignar_dosimetro_contrato_mn', compact('mesnumber', 'mescontdosisededepto', 'contdosisededepto', 'dosimLibresGeneral',
         'areaSede', 'dosimLibresAmbiental', 'personaSede', 'dosimLibresEzclip', 'holderLibresCristalino', 'holderLibresExtrem', 
         'holderLibresAnillo', 'dosicontrolToraxmesant', 'dosicontrolCristalinomesant', 'dosicontrolDedomesant', 'dosiareamesant', 'dosicasomesant',  
         'dositoraxmesant', 'dosicristalinomesant',  'dosimuñecamesant',  'dosidedomesant', 'dosicontrolToraxUnicomesant', 'dosicontrolCristalinoUnicomesant', 'dosicontrolDedoUnicomesant',
        'dosicontrolToraxUnicomesact', 'dosicontrolCristalinoUnicomesact', 'dosicontrolDedoUnicomesact'));
        /* return $contdosisededepto; */
    }
    public function asignaDosiContratoMnNovedad($id, $mesnumber){
        $contdosisededepto = Contratodosimetriasededepto::find($id);
        $mescontdosisededepto = Mesescontdosisedeptos::where('contdosisededepto_id', '=', $id)->latest()->first();
        $asignacionesMes = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber)
        ->get();
        $asignacionesAreaMes = Dosiareacontdosisede::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber)
        ->get();
        $personaSede = Persona::join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
        ->join('personasroles', 'personas.id_persona', '=', 'personasroles.persona_id')
        ->join('roles', 'personasroles.rol_id', '=', 'roles.id_rol')
        ->where('personasedes.sede_id','=', $contdosisededepto->contratodosimetriasede->sede->id_sede)
        ->where(function($query) {
            $query->orWhere('roles.nombre_rol', 'TOE')
                  ->orWhere('roles.nombre_rol', 'OPR')
                  ->orWhere('roles.nombre_rol', 'PUBLICO');
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

        $dosicontrolToraxmesact = Dosicontrolcontdosisede::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber)
        ->where('controlTransT_unicoCont', NULL)
        ->where('ubicacion', 'TORAX')
        ->get();
        $dosicontrolCristalinomesact = Dosicontrolcontdosisede::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber)
        ->where('controlTransC_unicoCont', NULL)
        ->where('ubicacion', 'CRISTALINO')
        ->get();
        $dosicontrolDedomesact = Dosicontrolcontdosisede::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber)
        ->where('controlTransA_unicoCont', NULL)
        ->where('ubicacion', 'ANILLO')
        ->get();
        /////DOSIMETROS DE CONTROL TRANSPORTE UNICO POR CONTRATO/////
        $dosicontrolToraxUnicomesact =  Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
        ->where('mes_asignacion', $mesnumber)
        ->where('ubicacion', 'TORAX')
        ->where('controlTransT_unicoCont', 'TRUE')
        ->get();
        $dosicontrolCristalinoUnicomesact = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
        ->where('mes_asignacion', $mesnumber)
        ->where('ubicacion', 'CRISTALINO')
        ->where('controlTransC_unicoCont', 'TRUE')
        ->get();
        $dosicontrolDedoUnicomesact = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
        ->where('mes_asignacion', $mesnumber)
        ->where('ubicacion', 'ANILLO')
        ->where('controlTransA_unicoCont', 'TRUE')
        ->get();
        //////////////////////////////////////////////////////////////////
        $dosiareamesact = Dosiareacontdosisede::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber)
        ->get();
        $dosicasomesact = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber)
        ->where('ubicacion', 'CASO')
        ->get();
        $dositoraxmesact = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber)
        ->where('ubicacion', 'TORAX')
        ->get();
        $dosicristalinomesact = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber)
        ->where('ubicacion', 'CRISTALINO')
        ->get();
        $dosidedomesact = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber)
        ->where('ubicacion', 'ANILLO')
        ->get();
        return view('dosimetria.asignar_dosimetro_contrato_mn_conovedad', compact('mesnumber','contdosisededepto', 'mescontdosisededepto', 'asignacionesMes','asignacionesAreaMes', 
        'dosimLibresGeneral', 'areaSede', 'dosimLibresAmbiental', 'personaSede', 'dosimLibresEzclip', 'holderLibresCristalino', 'holderLibresExtrem', 'holderLibresAnillo', 
        'dosicontrolToraxmesact', 'dosicontrolCristalinomesact', 'dosicontrolDedomesact', 'dosicontrolToraxUnicomesact', 'dosicontrolCristalinoUnicomesact', 'dosicontrolDedoUnicomesact',
        'dosiareamesact', 'dosicasomesact', 'dositoraxmesact', 'dosicristalinomesact', 'dosidedomesact'));
    }
    public function clearAsignacionAnteriorMn($id, $mesnumber){
        $contdosisededepto = Contratodosimetriasededepto::find($id);
        /* return $contdosisededepto; */

        $cleardosicontrolasigmesant = Dosicontrolcontdosisede::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber-1)
        ->update([
            'dosimetro_uso' => 'FALSE'
        ]);
        $cleardosiareasigmesant = Dosiareacontdosisede::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber-1)
        ->update([
            'dosimetro_uso' => 'FALSE'
        ]);
        $cleardositrabajasigmesant = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber-1)
        ->update([
            'dosimetro_uso' => 'FALSE'
        ]);
        ////////PRIMERO SE VERIFICA SI LOS DOSIMETROS DE CONTROL TRANSPORTE UNICOS PARA LE CONTRATO NO HAN SIDO ASIGNADOS
        /////// ANTERIORMENTE EN ESE MISMO MES, SI NO AHI SI PROCEDE A LIMPIAR LAS ASIGNACIONES//////////
        $verificarDosiControlUnicT = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
        ->where('ubicacion', 'TORAX')
        ->where('mes_asignacion', $mesnumber)
        ->get();
        if($verificarDosiControlUnicT->isEmpty()){
            $cleardosicontrolTunicoasigmesant = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('ubicacion', 'TORAX')
            ->where('mes_asignacion', $mesnumber-1)
            ->where('controlTransT_unicoCont', 'TRUE')
            ->update([
                'dosimetro_uso' => 'FALSE'
            ]);
        }
        $verificarDosiControlUnicC = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
        ->where('ubicacion', 'CRISTALINO')
        ->where('mes_asignacion', $mesnumber)
        ->get();
        if($verificarDosiControlUnicC->isEmpty()){
            $cleardosicontrolCunicoasigmesant = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('ubicacion', 'CRISTALINO')
            ->where('mes_asignacion', $mesnumber-1)
            ->where('controlTransC_unicoCont', 'TRUE')
            ->update([
                'dosimetro_uso' => 'FALSE'
            ]);
        }
        $verificarDosiControlUnicA = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
        ->where('ubicacion', 'ANILLO')
        ->where('mes_asignacion', $mesnumber)
        ->get();
        if($verificarDosiControlUnicA->isEmpty()){
            $cleardosicontrolAunicoasigmesant = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('ubicacion', 'ANILLO')
            ->where('mes_asignacion', $mesnumber-1)
            ->where('controlTransA_unicoCont', 'TRUE')
            ->update([
                'dosimetro_uso' => 'FALSE'
            ]);
        }

        return redirect()->back()->with('clear', 'ok');
    }
    public function saveAsignacionDosiContratoMn($id, $mesnumber, Request $request){
        /* return $request; */

        //////////////////ACTUALZAR TABLA CONTRATODOSIMETRIASEDEDEPTOS /////////////////////////
        $dosi_control_torax = empty($request->id_dosimetro_asigdosimControlTorax)  ? 0 : count($request->id_dosimetro_asigdosimControlTorax);
        $dosi_control_cristalino = empty($request->id_dosimetro_asigdosimControlCristalino)  ? 0 : count($request->id_dosimetro_asigdosimControlCristalino);
        $dosi_control_dedo = empty($request->id_dosimetro_asigdosimControlDedo)  ? 0 : count($request->id_dosimetro_asigdosimControlDedo);

        $dosi_torax = empty($request->id_trabajador_asigdosimTorax)  ? 0 : count($request->id_trabajador_asigdosimTorax);
        $dosi_area = empty($request->id_area_asigdosimArea)  ? 0 : count($request->id_area_asigdosimArea);
        $dosi_caso = empty($request->id_trabajador_asigdosimCaso) ? 0 : count($request->id_trabajador_asigdosimCaso);
        $dosi_cristalino = empty($request->id_trabajador_asigdosimCristalino) ? 0 : count($request->id_trabajador_asigdosimCristalino);
        $dosi_muñeca = empty($request->id_trabajador_asigdosimMuneca) ? 0 : count($request->id_trabajador_asigdosimMuneca);
        $dosi_dedo = empty($request->id_trabajador_asigdosimDedo) ? 0: count($request->id_trabajador_asigdosimDedo);

        $updatecontratoDosisedepto = Contratodosimetriasededepto::where('id_contdosisededepto', $id)
        ->update([
            'mes_actual'              => $mesnumber,
            'dosi_control_torax'      => $dosi_control_torax,
            'dosi_control_cristalino' => $dosi_control_cristalino,
            'dosi_control_dedo'       => $dosi_control_dedo,
            'dosi_torax'              => $dosi_torax,
            'dosi_area'               => $dosi_area,
            'dosi_caso'               => $dosi_caso,
            'dosi_cristalino'         => $dosi_cristalino,
            'dosi_muñeca'             => $dosi_muñeca,
            'dosi_dedo'               => $dosi_dedo
        ]);
        ////////////////// SAVE DE DOSIMETRO TIPO CONTROL TORAX POR ESP. Y  DOSIMETRO CONTROL TRANSPORTE TORAX UNICO POR CONTRATO/////////////////////////
        if(!empty($request->id_dosimetro_asigdosimControlTorax)){

            for($i=0; $i<count($request->id_dosimetro_asigdosimControlTorax); $i++){
                $asigdosim_control_torax = new Dosicontrolcontdosisede();

                $asigdosim_control_torax->dosimetro_id                = $request->id_dosimetro_asigdosimControlTorax[$i];
                $asigdosim_control_torax->contratodosimetriasede_id   = $request->id_contrato_asigdosim_sede;
                $asigdosim_control_torax->contdosisededepto_id        = $request->id_departamento_asigdosim;
                $asigdosim_control_torax->mes_asignacion              = $request->mesNumber1;
                $asigdosim_control_torax->dosimetro_uso               = 'TRUE';
                $asigdosim_control_torax->primer_dia_uso              = $request->primerDia_asigdosim;
                $asigdosim_control_torax->ultimo_dia_uso              = $request->ultimoDia_asigdosim;
                $asigdosim_control_torax->fecha_dosim_enviado         = $request->fecha_envio_dosim_asignado;
                /* $asigdosim_control_torax->ocupacion                   = $request->ocupacion_asigdosimControlTorax[$i]; */
                $asigdosim_control_torax->ubicacion                   = 'TORAX';
                $asigdosim_control_torax->energia                     = $request->energia_asigdosim;
    
                $asigdosim_control_torax->save();

                $estadoDosimControlTorax = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimControlTorax[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro'    => 'CONTROL TORAX'
                ]);
                $estadoDosimControlToraxmesant = Dosicontrolcontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                ->where('contdosisededepto_id', $id)
                ->where('mes_asignacion', $mesnumber-1)
                ->update([
                    'estado_dosimetro' => 'EN LECTURA',
                ]);
                
            }
        }elseif(!empty($request->id_dosimetro_ControlToraxUnico)){
            $asigdosim_controlTransT = new Dosicontrolcontdosisede();

            $asigdosim_controlTransT->dosimetro_id                = $request->id_dosimetro_ControlToraxUnico;
            $asigdosim_controlTransT->contratodosimetria_id       = $request->id_contrato_asigdosim;
            $asigdosim_controlTransT->mes_asignacion              = $request->mesNumber1;
            $asigdosim_controlTransT->dosimetro_uso               = 'TRUE';
            $asigdosim_controlTransT->primer_dia_uso              = $request->primerDia_asigdosim;
            $asigdosim_controlTransT->ultimo_dia_uso              = $request->ultimoDia_asigdosim;
            $asigdosim_controlTransT->fecha_dosim_enviado         = $request->fecha_envio_dosim_asignado;
            $asigdosim_controlTransT->ubicacion                   = 'TORAX';
            $asigdosim_controlTransT->energia                     = $request->energia_asigdosim;
            $asigdosim_controlTransT->controlTransT_unicoCont     = 'TRUE';

            $asigdosim_controlTransT->save();

            $estadoDosimControlTorax = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_ControlToraxUnico)
            ->update([
                'estado_dosimetro' => 'EN USO',
                'uso_dosimetro'    => 'CONTROL TORAX'
            ]);
            $estadoDosimControlToraxmesant = Dosicontrolcontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
            ->where('contratodosimetria_id', $request->id_contrato_asigdosim)
            ->where('mes_asignacion', $mesnumber-1)
            ->update([
                'estado_dosimetro' => 'EN LECTURA',
            ]);
        }

        ////////////////// SAVE DE DOSIMETRO TIPO  CONTROL CRISTALINO POR ESP. Y DOSIMETRO CONTROL TRANSPORTE CRISTALINO UNICO POR CONTRATO /////////////////////////
        if(!empty($request->id_dosimetro_asigdosimControlCristalino)){

            for($i=0; $i<count($request->id_dosimetro_asigdosimControlCristalino); $i++){
                $asigdosim_control_cristalino = new Dosicontrolcontdosisede();

                $asigdosim_control_cristalino->dosimetro_id                = $request->id_dosimetro_asigdosimControlCristalino[$i];
                $asigdosim_control_cristalino->holder_id                   = $request->id_holder_asigdosimControlCristalino[$i];
                $asigdosim_control_cristalino->contratodosimetriasede_id   = $request->id_contrato_asigdosim_sede;
                $asigdosim_control_cristalino->contdosisededepto_id        = $request->id_departamento_asigdosim;
                $asigdosim_control_cristalino->mes_asignacion              = $request->mesNumber1;
                $asigdosim_control_cristalino->dosimetro_uso               = 'TRUE';
                $asigdosim_control_cristalino->primer_dia_uso              = $request->primerDia_asigdosim;
                $asigdosim_control_cristalino->ultimo_dia_uso              = $request->ultimoDia_asigdosim;
                $asigdosim_control_cristalino->fecha_dosim_enviado         = $request->fecha_envio_dosim_asignado;
                $asigdosim_control_cristalino->fecha_dosim_recibido        = $request->fecha_recibido_dosim_asignado;
                $asigdosim_control_cristalino->fecha_dosim_devuelto        = $request->fecha_devuelto_dosim_asignado;
                /* $asigdosim_control_cristalino->ocupacion                   = $request->ocupacion_asigdosimControlTorax[$i]; */
                $asigdosim_control_cristalino->ubicacion                   = 'CRISTALINO';
                $asigdosim_control_cristalino->energia                     = $request->energia_asigdosim;
    
                $asigdosim_control_cristalino->save();

                $estadoDosimControlCristalino = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimControlCristalino[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro'    => 'CONTROL CRISTALINO'
                ]);
                $estadoHolderControlCristalino = Holder::where('id_holder', '=', $request->id_holder_asigdosimControlCristalino[$i])
                ->update([
                    'estado_holder'    => 'EN USO',
                ]);
                $estadoDosimControlCristalinomesant = Dosicontrolcontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                ->where('contdosisededepto_id', $id)
                ->where('mes_asignacion', $mesnumber-1)
                ->update([
                    'estado_dosimetro' => 'EN LECTURA',
                ]);
                
            }
        }elseif(!empty($request->id_dosimetro_ControlCristalinoUnico)){
            $asigdosim_controlTransC = new Dosicontrolcontdosisede();

            $asigdosim_controlTransC->dosimetro_id                = $request->id_dosimetro_ControlCristalinoUnico;
            $asigdosim_controlTransC->holder_id                   = $request->id_holder_ControlCristalinoUnico;
            $asigdosim_controlTransC->contratodosimetria_id       = $request->id_contrato_asigdosim;
            $asigdosim_controlTransC->mes_asignacion              = $request->mesNumber1;
            $asigdosim_controlTransC->dosimetro_uso               = 'TRUE';
            $asigdosim_controlTransC->primer_dia_uso              = $request->primerDia_asigdosim;
            $asigdosim_controlTransC->ultimo_dia_uso              = $request->ultimoDia_asigdosim;
            $asigdosim_controlTransC->fecha_dosim_enviado         = $request->fecha_envio_dosim_asignado;
            $asigdosim_controlTransC->ubicacion                   = 'CRISTALINO';
            $asigdosim_controlTransC->energia                     = $request->energia_asigdosim;
            $asigdosim_controlTransC->controlTransC_unicoCont     = 'TRUE';

            $asigdosim_controlTransC->save();

            $estadoDosimControlCristalino = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_ControlCristalinoUnico)
            ->update([
                'estado_dosimetro' => 'EN USO',
                'uso_dosimetro'    => 'CONTROL CRISTALINO'
            ]);
            $estadoHolderControlCristalino = Holder::where('id_holder', '=', $request->id_holder_ControlCristalinoUnico)
            ->update([
                'estado_holder'    => 'EN USO',
            ]);
            $estadoDosimControlCristalinomesant = Dosicontrolcontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
            ->where('contratodosimetria_id', $request->id_contrato_asigdosim)
            ->where('mes_asignacion', $mesnumber-1)
            ->update([
                'estado_dosimetro' => 'EN LECTURA',
            ]);
        }
        ////////////////// SAVE DE DOSIMETRO TIPO  CONTROL DEDO POR ESP. Y DOSIMETRO CONTROL TRANSPORTE DEDO UNICO POR CONTRATO/////////////////////////
        if(!empty($request->id_dosimetro_asigdosimControlDedo)){

            for($i=0; $i<count($request->id_dosimetro_asigdosimControlDedo); $i++){
                $asigdosim_control_dedo = new Dosicontrolcontdosisede();

                $asigdosim_control_dedo->dosimetro_id                = $request->id_dosimetro_asigdosimControlDedo[$i];
                $asigdosim_control_dedo->holder_id                   = $request->id_holder_asigdosimControlDedo[$i];
                $asigdosim_control_dedo->contratodosimetriasede_id   = $request->id_contrato_asigdosim_sede;
                $asigdosim_control_dedo->contdosisededepto_id        = $request->id_departamento_asigdosim;
                $asigdosim_control_dedo->mes_asignacion              = $request->mesNumber1;
                $asigdosim_control_dedo->dosimetro_uso               = 'TRUE';
                $asigdosim_control_dedo->primer_dia_uso              = $request->primerDia_asigdosim;
                $asigdosim_control_dedo->ultimo_dia_uso              = $request->ultimoDia_asigdosim;
                $asigdosim_control_dedo->fecha_dosim_enviado         = $request->fecha_envio_dosim_asignado;
                $asigdosim_control_dedo->fecha_dosim_recibido        = $request->fecha_recibido_dosim_asignado;
                $asigdosim_control_dedo->fecha_dosim_devuelto        = $request->fecha_devuelto_dosim_asignado;
                /* $asigdosim_control_dedo->ocupacion                   = $request->ocupacion_asigdosimControlTorax[$i]; */
                $asigdosim_control_dedo->ubicacion                   = 'ANILLO';
                $asigdosim_control_dedo->energia                     = $request->energia_asigdosim;
    
                $asigdosim_control_dedo->save();

                $estadoDosimControlDedo = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimControlDedo[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro'    => 'CONTROL ANILLO'
                ]);
                $estadoHolderControlDedo = Holder::where('id_holder', '=', $request->id_holder_asigdosimControlDedo[$i])
                ->update([
                    'estado_holder'    => 'EN USO',
                ]);
                $estadoDosimControlDedomesant = Dosicontrolcontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                ->where('contdosisededepto_id', $id)
                ->where('mes_asignacion', $mesnumber-1)
                ->update([
                    'estado_dosimetro' => 'EN LECTURA',
                ]);
                
            }
        }elseif(!empty($request->id_dosimetro_ControlDedoUnico)){
            $asigdosim_controlTransA = new Dosicontrolcontdosisede();

            $asigdosim_controlTransA->dosimetro_id                = $request->id_dosimetro_ControlDedoUnico;
            $asigdosim_controlTransA->holder_id                   = $request->id_holder_ControlDedoUnico;
            $asigdosim_controlTransA->contratodosimetria_id       = $request->id_contrato_asigdosim;
            $asigdosim_controlTransA->mes_asignacion              = $request->mesNumber1;
            $asigdosim_controlTransA->dosimetro_uso               = 'TRUE';
            $asigdosim_controlTransA->primer_dia_uso              = $request->primerDia_asigdosim;
            $asigdosim_controlTransA->ultimo_dia_uso              = $request->ultimoDia_asigdosim;
            $asigdosim_controlTransA->fecha_dosim_enviado         = $request->fecha_envio_dosim_asignado;
            $asigdosim_controlTransA->ubicacion                   = 'ANILLO';
            $asigdosim_controlTransA->energia                     = $request->energia_asigdosim;
            $asigdosim_controlTransA->controlTransA_unicoCont     = 'TRUE';

            $asigdosim_controlTransA->save();

            $estadoDosimControlDedo = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_ControlDedoUnico)
            ->update([
                'estado_dosimetro' => 'EN USO',
                'uso_dosimetro'    => 'CONTROL ANILLO'
            ]);
            $estadoHolderControlDedo = Holder::where('id_holder', '=', $request->id_holder_ControlDedoUnico)
            ->update([
                'estado_holder'    => 'EN USO',
            ]);
            $estadoDosimControlDedomesant = Dosicontrolcontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
            ->where('contratodosimetria_id', $request->id_contrato_asigdosim)
            ->where('mes_asignacion', $mesnumber-1)
            ->update([
                'estado_dosimetro' => 'EN LECTURA',
            ]);
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
                /* $asigdosimTorax->ocupacion                 = $request->ocupacion_asigdosimTorax[$i]; */
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
               /*  $asigdosimArea->ocupacion                   = $request->ocupacion_asigdosimArea[$i]; */
                $asigdosimArea->energia                     = $request->energia_asigdosim;

                $asigdosimArea->save();
                $estadoDosimArea = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimArea[$i])
                ->update([
                    'estado_dosimetro' => 'EN USO',
                    'uso_dosimetro'    => 'AMBIENTAL'
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
                /* $asigdosimCaso->ocupacion                 = $request->ocupacion_asigdosimCaso[$i]; */
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
                /* $asigdosimCristalino->ocupacion                 = $request->ocupacion_asigdosimCristalino[$i]; */
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
                /* $asigdosimMuneca->ocupacion                 = $request->ocupacion_asigdosimMuneca[$i]; */
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
                /* $asigdosimDedo->ocupacion                 = $request->ocupacion_asigdosimDedo[$i]; */
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
        return redirect()->route('detallesedecont.create', $id)->with('crear', 'ok');
    } 
    public function saveAsignacionDosiContratoMnNovedad($id, $mesnumber, Request $request){
        /* return $request; */
        $contdosisededepto = Contratodosimetriasededepto::find($id);
        if(!empty($request->id_asigdosimControlUnicoT) || !empty($request->id_asigdosimControlUnicoC) || !empty($request->id_asigdosimControlUnicoA)){
            $asignacionesControlMes = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('mes_asignacion', $mesnumber)
            ->get();
        }else{
            $asignacionesControlMes = Dosicontrolcontdosisede::where('contdosisededepto_id', $id)
            ->where('mes_asignacion', $mesnumber)
            ->get();
        }
        $asignacionesMes = Trabajadordosimetro::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber)
        ->get();
        
        $asignacionesAreaMes = Dosiareacontdosisede::where('contdosisededepto_id', $id)
        ->where('mes_asignacion', $mesnumber)
        ->get();
        ///////////////ACTUALIZAR LAS ASIGNACIONES CREADAS EN LA NOVEDAD DE NUEVOS DOSIMETROS A LOS CUALES NO SE LES ASIGNO NADA////////////////////////
        ////////////////// SAVE DE DOSIMETRO TIPO  CONTROL TORAX, CRISTALINO, ANILLO POR ESPECIALIDAD/////////////////////////
        //////////////////SAVE DE DOSIMETRO TIPO  CONTROL TORAX, CRISTALINO, ANILLO UNICO POR CONTRATO ////////////////////////
        if(!empty($request->id_dosimetro_asigdosimControlTorax)){
            for($i=0; $i<count($request->id_asigdosimControlTorax); $i++){
                foreach($asignacionesControlMes as $asignacionControl){
                    if($asignacionControl->id_dosicontrolcontdosisedes == $request->id_asigdosimControlTorax[$i]){
                        $asignacionControl->dosimetro_id            = $request->id_dosimetro_asigdosimControlTorax[$i];
                        $asignacionControl->primer_dia_uso          = $request->primerDia_asigdosim;
                        $asignacionControl->ultimo_dia_uso          = $request->ultimoDia_asigdosim;
                        $asignacionControl->fecha_dosim_enviado     = $request->fecha_envio_dosim_asignado;

                        $asignacionControl->save();   
                        $estadoDosimControl = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimControlTorax[$i])
                        ->update([
                            'estado_dosimetro' => 'EN USO',
                            'uso_dosimetro'    => 'CONTROL TORAX'
                        ]);
                        $estadoDosimControlmesant = Dosicontrolcontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                        ->where('contdosisededepto_id', $id)
                        ->where('mes_asignacion', $mesnumber-1)
                        ->update([
                            'estado_dosimetro' => 'EN LECTURA',
                        ]);
                    }
                }
            } 
        }elseif(!empty($request->id_dosimetro_ControlToraxUnico)){
            for($i=0; $i<count($request->id_asigdosimControlUnicoT); $i++){
                foreach($asignacionesControlMes as $asignacionControl){
                    if($asignacionControl->id_dosicontrolcontdosisedes == $request->id_asigdosimControlUnicoT[$i]){
                        $asignacionControl->dosimetro_id                = $request->id_dosimetro_ControlToraxUnico[$i];
                        $asignacionControl->contratodosimetria_id       = $request->id_contrato_asigdosim;
                        $asignacionControl->mes_asignacion              = $request->mesNumber;
                        $asignacionControl->dosimetro_uso               = 'TRUE';
                        $asignacionControl->primer_dia_uso              = $request->primerDia_asigdosim;
                        $asignacionControl->ultimo_dia_uso              = $request->ultimoDia_asigdosim;
                        $asignacionControl->fecha_dosim_enviado         = $request->fecha_envio_dosim_asignado;
                        $asignacionControl->controlTransT_unicoCont     = 'TRUE';

                        $asignacionControl->save();   
                        $estadoDosimControl = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_ControlToraxUnico[$i])
                        ->update([
                            'estado_dosimetro' => 'EN USO',
                            'uso_dosimetro'    => 'CONTROL TORAX'
                        ]);
                        $estadoDosimControlmesant = Dosicontrolcontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                        ->where('contdosisededepto_id', $id)
                        ->where('mes_asignacion', $mesnumber-1)
                        ->update([
                            'estado_dosimetro' => 'EN LECTURA',
                        ]);
                    }
                }
            }
            
        }
        if(!empty($request->id_dosimetro_asigdosimControlCristalino)){
            for($i=0; $i<count($request->id_asigdosimControlCristalino); $i++){
                foreach($asignacionesControlMes as $asignacionControl){
                    if($asignacionControl->id_dosicontrolcontdosisedes == $request->id_asigdosimControlCristalino[$i]){
                        
                        $asignacionControl->dosimetro_id            = $request->id_dosimetro_asigdosimControlCristalino[$i];
                        $asignacionControl->holder_id               = $request->id_holder_asigdosimControlCristalino[$i];
                        $asignacionControl->primer_dia_uso          = $request->primerDia_asigdosim;
                        $asignacionControl->ultimo_dia_uso          = $request->ultimoDia_asigdosim;
                        $asignacionControl->fecha_dosim_enviado     = $request->fecha_envio_dosim_asignado;
    
                        $asignacionControl->save();   
                        $estadoDosimControl = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimControlCristalino[$i])
                        ->update([
                            'estado_dosimetro' => 'EN USO',
                            'uso_dosimetro'    => 'CONTROL CRISTALINO'
                        ]);
                        $estadoHolderControl = Holder::where('id_holder', '=', $request->id_holder_asigdosimControlCristalino[$i])
                        ->update([
                            'estado_holder'    => 'EN USO',
                        ]);
                        $estadoDosimControlmesant = Dosicontrolcontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                        ->where('contdosisededepto_id', $id)
                        ->where('mes_asignacion', $mesnumber-1)
                        ->update([
                            'estado_dosimetro' => 'EN LECTURA',
                        ]);
                    }
                }
            }
        }elseif(!empty($request->id_dosimetro_ControlCristalinoUnico)){
            for($i=0; $i<count($request->id_asigdosimControlUnicoC); $i++){
                foreach($asignacionesControlMes as $asignacionControl){
                    if($asignacionControl->id_dosicontrolcontdosisedes == $request->id_asigdosimControlUnicoC[$i]){
                        $asignacionControl->dosimetro_id                = $request->id_dosimetro_ControlCristalinoUnico[$i];
                        $asignacionControl->holder_id                   = $request->id_holder_ControlCristalinoUnico[$i];
                        $asignacionControl->contratodosimetria_id       = $request->id_contrato_asigdosim;
                        $asignacionControl->mes_asignacion              = $request->mesNumber;
                        $asignacionControl->dosimetro_uso               = 'TRUE';
                        $asignacionControl->primer_dia_uso              = $request->primerDia_asigdosim;
                        $asignacionControl->ultimo_dia_uso              = $request->ultimoDia_asigdosim;
                        $asignacionControl->fecha_dosim_enviado         = $request->fecha_envio_dosim_asignado;
                        $asignacionControl->controlTransC_unicoCont     = 'TRUE';
                        
                        $asignacionControl->save();   
                        $estadoDosimControl = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_ControlToraxUnico[$i])
                        ->update([
                            'estado_dosimetro' => 'EN USO',
                            'uso_dosimetro'    => 'CONTROL CRISTALINO'
                        ]);
                        $estadoHolderControl = Holder::where('id_holder', '=',$request->id_holder_ControlCristalinoUnico[$i])
                        ->update([
                            'estado_holder'    => 'EN USO',
                        ]);
                        $estadoDosimControlmesant = Dosicontrolcontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                        ->where('contdosisededepto_id', $id)
                        ->where('mes_asignacion', $mesnumber-1)
                        ->update([
                            'estado_dosimetro' => 'EN LECTURA',
                        ]);
                    }
                }
            }
        }
        if(!empty($request->id_dosimetro_asigdosimControlDedo)){
            for($i=0; $i<count($request->id_asigdosimControlDedo); $i++){
                foreach($asignacionesControlMes as $asignacionControl){
                    if($asignacionControl->id_dosicontrolcontdosisedes == $request->id_asigdosimControlDedo[$i]){
                        
                        $asignacionControl->dosimetro_id            = $request->id_dosimetro_asigdosimControlDedo[$i];
                        $asignacionControl->holder_id               = $request->id_holder_asigdosimControlDedo[$i];
                        $asignacionControl->primer_dia_uso          = $request->primerDia_asigdosim;
                        $asignacionControl->ultimo_dia_uso          = $request->ultimoDia_asigdosim;
                        $asignacionControl->fecha_dosim_enviado     = $request->fecha_envio_dosim_asignado;

                        $asignacionControl->save();   
                        $estadoDosimControl = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimControlDedo[$i])
                        ->update([
                            'estado_dosimetro' => 'EN USO',
                            'uso_dosimetro'    => 'CONTROL ANILLO'
                        ]);
                        $estadoHolderControl = Holder::where('id_holder', '=', $request->id_holder_asigdosimControlDedo[$i])
                        ->update([
                            'estado_holder'    => 'EN USO',
                        ]);
                        $estadoDosimControlmesant = Dosicontrolcontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                        ->where('contdosisededepto_id', $id)
                        ->where('mes_asignacion', $mesnumber-1)
                        ->update([
                            'estado_dosimetro' => 'EN LECTURA',
                        ]);
                    }
                }
            }
        }elseif(!empty($request->id_dosimetro_ControlDedoUnico)){
            for($i=0; $i<count($request->id_asigdosimControlUnicoA); $i++){
                foreach($asignacionesControlMes as $asignacionControl){
                    if($asignacionControl->id_dosicontrolcontdosisedes == $request->id_asigdosimControlUnicoA[$i]){
                        $asignacionControl->dosimetro_id                = $request->id_dosimetro_ControlDedoUnico[$i];
                        $asignacionControl->holder_id                   = $request->id_holder_ControlDedoUnico[$i];
                        $asignacionControl->contratodosimetria_id       = $request->id_contrato_asigdosim;
                        $asignacionControl->mes_asignacion              = $request->mesNumber;
                        $asignacionControl->dosimetro_uso               = 'TRUE';
                        $asignacionControl->primer_dia_uso              = $request->primerDia_asigdosim;
                        $asignacionControl->ultimo_dia_uso              = $request->ultimoDia_asigdosim;
                        $asignacionControl->fecha_dosim_enviado         = $request->fecha_envio_dosim_asignado;
                        $asignacionControl->controlTransA_unicoCont     = 'TRUE';

                        $asignacionControl->save();   
                        $estadoDosimControl = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_ControlDedoUnico[$i])
                        ->update([
                            'estado_dosimetro' => 'EN USO',
                            'uso_dosimetro'    => 'CONTROL ANILLO'
                        ]);
                        $estadoHolderControl = Holder::where('id_holder', '=',$request->id_holder_ControlDedoUnico[$i])
                        ->update([
                            'estado_holder'    => 'EN USO',
                        ]);
                        $estadoDosimControlmesant = Dosicontrolcontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                        ->where('contdosisededepto_id', $id)
                        ->where('mes_asignacion', $mesnumber-1)
                        ->update([
                            'estado_dosimetro' => 'EN LECTURA',
                        ]);
                    }
                }
            }
        }
        
        ////////////////// SAVE DE DOSIMETRO TIPO  TORAX  /////////////////////////
        if(!empty($request->id_asigdosimTorax)){

            for($i=0; $i<count($request->id_asigdosimTorax); $i++){
                foreach($asignacionesMes as $asignacionTorax){
                    if($asignacionTorax->ubicacion == 'TORAX' && $asignacionTorax->id_trabajadordosimetro == $request->id_asigdosimTorax[$i]){
                        $asignacionTorax->dosimetro_id            = $request->id_dosimetro_asigdosimTorax[$i];
                        $asignacionTorax->primer_dia_uso          = $request->primerDia_asigdosim;
                        $asignacionTorax->ultimo_dia_uso          = $request->ultimoDia_asigdosim;
                        $asignacionTorax->fecha_dosim_enviado     = $request->fecha_envio_dosim_asignado;

                        $asignacionTorax->save();

                        $estadoDosimControl = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimTorax[$i])
                        ->update([
                            'estado_dosimetro' => 'EN USO',
                            'uso_dosimetro'    => 'TORAX'
                        ]);
                        $estadoDosimControlmesant = Trabajadordosimetro::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                        ->where('contdosisededepto_id', $id)
                        ->where('mes_asignacion', $mesnumber-1)
                        ->update([
                            'estado_dosimetro' => 'EN LECTURA',
                        ]);
                    }
                }
            }
        }
         ////////////////// SAVE DE DOSIMETRO TIPO  AREA /////////////////////////
        if(!empty($request->id_dosiareaAsig)){
            for($i=0; $i<count($request->id_dosiareaAsig); $i++){
                foreach($asignacionesAreaMes as $asignacionArea){
                    if($asignacionArea->id_dosiareacontdosisedes == $request->id_dosiareaAsig[$i]){
               

                        $asignacionArea->dosimetro_id                = $request->id_dosimetro_asigdosimArea[$i];
                        $asignacionArea->primer_dia_uso              = $request->primerDia_asigdosim;
                        $asignacionArea->ultimo_dia_uso              = $request->ultimoDia_asigdosim;
                        $asignacionArea->fecha_dosim_enviado         = $request->fecha_envio_dosim_asignado;

                        $asignacionArea->save();
                        $estadoDosimArea = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimArea[$i])
                        ->update([
                            'estado_dosimetro' => 'EN USO',
                            'uso_dosimetro'    => 'AMBIENTAL'
                        ]);
                        $estadoDosimAreamesant = Dosiareacontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                        ->where('contdosisededepto_id', $id)
                        ->where('mes_asignacion', $mesnumber-1)
                        ->update([
                            'estado_dosimetro' => 'EN LECTURA',
                        ]);
                    }
                }
            } 
        }
         ////////////////// SAVE DE DOSIMETRO TIPO  CASO /////////////////////////
        if(!empty($request->id_asigdosimCaso)){
            for($i=0; $i<count($request->id_asigdosimCaso); $i++){
                foreach($asignacionesMes as $asignacionCaso){
                    if($asignacionCaso->ubicacion == 'CASO' && $asignacionCaso->id_trabajadordosimetro == $request->id_asigdosimCaso[$i]){

                        $asignacionCaso->dosimetro_id              = $request->id_dosimetro_asigdosimCaso[$i];
                        $asignacionCaso->primer_dia_uso            = $request->primerDia_asigdosim;
                        $asignacionCaso->ultimo_dia_uso            = $request->ultimoDia_asigdosim;
                        $asignacionCaso->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado;
            
                        $asignacionCaso->save();
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
            } 
        }
        ////////////////// SAVE DE DOSIMETRO TIPO CRISTALINO ///////////////
        if(!empty($request->id_asigdosimCristalino)){
            for($i=0; $i<count($request->id_asigdosimCristalino); $i++){
                foreach($asignacionesMes as $asignacionCristalino){
                    if($asignacionCristalino->ubicacion == 'CRISTALINO' && $asignacionCristalino->id_trabajadordosimetro == $request->id_asigdosimCristalino[$i]){
                        $asignacionCristalino->dosimetro_id              = $request->id_dosimetro_asigdosimCristalino[$i];
                        $asignacionCristalino->holder_id                 = $request->id_holder_asigdosimCristalino[$i];
                        $asignacionCristalino->primer_dia_uso            = $request->primerDia_asigdosim;
                        $asignacionCristalino->ultimo_dia_uso            = $request->ultimoDia_asigdosim;
                        $asignacionCristalino->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado;
            
                        $asignacionCristalino->save();
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
            } 
        }
         ////////////////// SAVE DE DOSIMETRO TIPO DEDO ///////////////
        if(!empty($request->id_asigdosimDedo)){
            for($i=0; $i<count($request->id_asigdosimDedo); $i++){
                foreach($asignacionesMes as $asignacionDedo){
                    if($asignacionDedo->ubicacion == 'ANILLO' && $asignacionDedo->id_trabajadordosimetro == $request->id_asigdosimDedo[$i]){
                
                        $asignacionDedo->dosimetro_id              = $request->id_dosimetro_asigdosimDedo[$i];
                        $asignacionDedo->holder_id                 = $request->id_holder_asigdosimDedo[$i];
                        $asignacionDedo->primer_dia_uso            = $request->primerDia_asigdosim;
                        $asignacionDedo->ultimo_dia_uso            = $request->ultimoDia_asigdosim;
                        $asignacionDedo->fecha_dosim_enviado       = $request->fecha_envio_dosim_asignado;
            
                        $asignacionDedo->save();
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
            } 
        }
        return redirect()->route('detallesedecont.create', $id)->with('crear', 'ok');
    }   
    public function info($id, $mesnumber, $item){
        if($item == 0){
            $contdosisededepto = Contratodosimetriasededepto::find($id);
           /*  $mescontdosisededepto = Mesescontdosisedeptos::where('contdosisededepto_id', '=', $id)->latest()->first(); */
            $dosicontrolToraxasig = Dosicontrolcontdosisede::where('contdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('novcontdosisededepto_id', NULL)
            ->where('ubicacion', '=', 'TORAX')
            ->get();  
            $dosicontrolCristalinoasig = Dosicontrolcontdosisede::where('contdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('novcontdosisededepto_id', NULL)
            ->where('ubicacion', '=', 'CRISTALINO')
            ->get();  
            $dosicontrolDedoasig = Dosicontrolcontdosisede::where('contdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('novcontdosisededepto_id', NULL)
            ->where('ubicacion', '=', 'ANILLO')
            ->get();    
            $dosicontrolUnicoToraxasig = Dosicontrolcontdosisede::where('mes_asignacion', '=', $mesnumber)
            ->where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('ubicacion', '=', 'TORAX')
            ->get();
            $dosicontrolUnicoCristasig = Dosicontrolcontdosisede::where('mes_asignacion', '=', $mesnumber)
            ->where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('novcontdosisededepto_id', NULL)
            ->where('ubicacion', '=', 'CRISTALINO')
            ->get();
            $dosicontrolUnicoAnilloasig = Dosicontrolcontdosisede::where('mes_asignacion', '=', $mesnumber)
            ->where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('novcontdosisededepto_id', NULL)
            ->where('ubicacion', '=', 'ANILLO')
            ->get();
            $dosiareasignados = Dosiareacontdosisede::where('contdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('novcontdosisededepto_id', NULL)
            ->get();
            $trabjasignados = Trabajadordosimetro::where('contdosisededepto_id', '=', $id)
            ->where('novcontdosisededepto_id', NULL)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            $observacionesDelMes = Mesescontdosisedeptos::where('contdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('novcontdosisededepto_id', NULL)
            ->get();
            /* $DosiControlAsignados = Dosicontrolcontdosisede::where('contdosisededepto_id', $id)
            ->where('mes_asignacion', $mesnumber)
            ->count(); */
            /* $DosiToraxAsignados = Trabajadordosimetro::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
            ->where('contdosisededepto_id', $id)
            ->where('ubicacion', 'TORAX')
            ->where('mes_asignacion', $mesnumber)
            ->count(); */
            /* $DosiCasoAsignados = Trabajadordosimetro::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                ->where('contdosisededepto_id', $id)
                ->where('ubicacion', 'CASO')
                ->where('mes_asignacion', $mesnumber)
                ->count(); */
            /* $DosiCristalinoAsignados = Trabajadordosimetro::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                ->where('contdosisededepto_id', $id)
                ->where('ubicacion', 'CRISTALINO')
                ->where('mes_asignacion', $mesnumber)
                ->count();  */
            /* $DosiMuñecaAsignados = Trabajadordosimetro::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                ->where('contdosisededepto_id', $id)
                ->where('ubicacion', 'MUÑECA')
                ->where('mes_asignacion', $mesnumber)
                ->count(); */
            /* $DosiDedoAsignados = Trabajadordosimetro::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                ->where('contdosisededepto_id', $id)
                ->where('ubicacion', 'ANILLO')
                ->where('mes_asignacion', $mesnumber)
                ->count(); */
        }else if($item == 1){
            $contdosisededepto = Novcontdosisededepto::find($id);
           /*  $mescontdosisededepto = Mesescontdosisedeptos::where('novcontdosisededepto_id', '=', $id)->latest()->first(); */
            $dosicontrolToraxasig = Dosicontrolcontdosisede::where('novcontdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('ubicacion', '=', 'TORAX')
            ->get();  
            $dosicontrolCristalinoasig = Dosicontrolcontdosisede::where('novcontdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('ubicacion', '=', 'CRISTALINO')
            ->get();  
            $dosicontrolDedoasig = Dosicontrolcontdosisede::where('novcontdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('ubicacion', '=', 'ANILLO')
            ->get();    
            $dosicontrolUnicoToraxasig = Dosicontrolcontdosisede::where('mes_asignacion', '=', $mesnumber)
            ->where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('novcontdosisededepto_id', $id)
            ->where('ubicacion', '=', 'TORAX')
            ->get();
            $dosicontrolUnicoCristasig = Dosicontrolcontdosisede::where('mes_asignacion', '=', $mesnumber)
            ->where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('novcontdosisededepto_id', $id)
            ->where('ubicacion', '=', 'CRISTALINO')
            ->get();
            $dosicontrolUnicoAnilloasig = Dosicontrolcontdosisede::where('mes_asignacion', '=', $mesnumber)
            ->where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('novcontdosisededepto_id', $id)
            ->where('ubicacion', '=', 'ANILLO')
            ->get();
            $dosiareasignados = Dosiareacontdosisede::where('novcontdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            $trabjasignados = Trabajadordosimetro::where('novcontdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            $observacionesDelMes = Mesescontdosisedeptos::where('novcontdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            /* $DosiControlAsignados = Dosicontrolcontdosisede::where('contdosisededepto_id', $id)
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
                ->count(); */
        }
        return view('dosimetria.info_asignacion_dosimetros_contrato', compact('mesnumber','contdosisededepto', 'dosiareasignados', 'trabjasignados', 'observacionesDelMes', 'dosicontrolToraxasig', 'dosicontrolCristalinoasig', 'dosicontrolDedoasig',  'dosicontrolUnicoToraxasig', 'dosicontrolUnicoCristasig', 'dosicontrolUnicoAnilloasig', 'item'));
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
        $newMesescontdosisedeptos->nota_cambiodosim     =  mb_strtoupper($request->nota_cambio_dosimetros);
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
    public function destroyAreasig($id){
        $new_estado = 'STOCK';
        $liberar_dosim = Dosiareacontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
        ->where('id_dosiareacontdosisedes', $id)
        ->update([
            'estado_dosimetro' => $new_estado,
            'uso_dosimetro'    => ''
        ]);
        $dosiAreasig = Dosiareacontdosisede::find($id);
        $dosiAreasig->delete();

        return redirect()->back()->with('eliminar', 'ok');
    }
    ////LECTURA DE DOSIMETROS SIN DOSIMETRO DE CONTROL////
    public function lecturadosi($id, $item){
        $trabjasig = Trabajadordosimetro::find($id);
        
        /* return "sin dosimetro de control este es el trabajador asignado".$trabjasig; */
        return view('dosimetria.lectura_dosimetro_contrato', compact('trabjasig', 'item'));  
        
    }
    ////LECTURA DE DOSIMETROS CON DOSIMETRO DE CONTROL////
    public function lecturadosicontrl($id, $idcontrol, $item){
        $trabjasig = Trabajadordosimetro::find($id);
        $dosicontrolasig = Dosicontrolcontdosisede::find($idcontrol);
        /* return $dosicontrolasig; */
        /* return "con dosimetro de control".$dosicontrolasig; */
        return view('dosimetria.lectura_dosimetrocontrol_contrato', compact('trabjasig', 'dosicontrolasig', 'item'));
        /* return $trabjasig; */
    }

    ////GUARDAR LECTURA DE DOSIMETROS CON O SIN DOSIMETRO DE CONTROL /////
    public function savelecturadosi(Request $request, $id, $item){

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
        $trabjasig->Hp007_dif_dosicont      = $request->hp007_calc_dose - $request->hp007_calc_dose_control;
        $trabjasig->Hp10_calc_dose          = $request->hp10_calc_dose;
        $trabjasig->Hp10_background_dose    = $request->hp10_background_dose;
        $trabjasig->Hp10_raw_dose           = $request->hp10_raw_dose;
        $trabjasig->Hp10_dif_dosicont       = $request->hp10_calc_dose - $request->hp10_calc_dose_control;
        $trabjasig->EzClip_calc_dose        = $request->ezclip_calc_dose;
        $trabjasig->EzClip_background_dose  = $request->ezclip_background_dose;
        $trabjasig->EzClip_raw_dose         = $request->ezclip_raw_dose;
        $trabjasig->Hp3_calc_dose           = $request->hp3_calc_dose;
        $trabjasig->Hp3_background_dose     = $request->hp3_background_dose;
        $trabjasig->Hp3_raw_dose            = $request->hp3_raw_dose;
        $trabjasig->Hp3_dif_dosicont        = $request->hp3_calc_dose - $request->hp3_calc_dose_control;
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

        if($item == 0){
            return redirect()->route('asignadosicontrato.info',["asigdosicont" =>$request->id_contratodosimetriasededepto, "mesnumber" =>$request->mes_asignacion, "item"=>$item])->with('actualizar', 'ok');
        }else{
            return redirect()->route('asignadosicontrato.info',["asigdosicont" =>$request->id_novedadcontratodosimetriasededepto, "mesnumber" =>$request->mes_asignacion, "item"=>$item])->with('actualizar', 'ok');
        }
        /* return $request; */
    }
    //// EDITAR DOSIMETROS SIN DOSIMETRO DE CONTROL////
    public function editlecturadosi($id, $item){
        $trabjasig = Trabajadordosimetro::find($id);
        return view('dosimetria.lectura_dosimetro_contrato_edit', compact('trabjasig', 'item'));

    }
    ////EDITAR DOSIMETROS CON DOSIMETRO DE CONTROL////
    public function editlecturadosicontrl($id, $idcontrol, $item){
        $trabjasig = Trabajadordosimetro::find($id);
        $dosicontrolasig = Dosicontrolcontdosisede::find($idcontrol);
        return view('dosimetria.lectura_dosimetrocontrol_contrato_edit', compact('trabjasig', 'dosicontrolasig', 'item'));
    }
    ////LECTURA DE DOSIMETROS CONTROL////
    public function lecturadosicontrol($id, $id_contdosisededepto, $item){
        if($item == 0){
            $contdosisededepto = Contratodosimetriasededepto::find($id_contdosisededepto);
        }else if($item == 1){
            $contdosisededepto = Novcontdosisededepto::find($id_contdosisededepto);
        }
        $dosicontasig = Dosicontrolcontdosisede::find($id);
       
        return view('dosimetria.lectura_dosimetro_control_contrato', compact('dosicontasig', 'contdosisededepto', 'item'));

    }
    ////GUARDAR LECTURA DE DOSIMETROS CONTROL ////
    public function savelecturadosicontrol(Request $request, $id, $item){
        
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
        if($dosicontasig->holder_id != NULL ){
            $estadoHolderControl = Holder::where('id_holder', $dosicontasig->holder->id_holder)
            ->update([
                'estado_holder' => 'STOCK',
            ]);
        }
        if($item == 0){
            return redirect()->route('asignadosicontrato.info',["asigdosicont" =>$request->id_contratodosimetriasededepto, "mesnumber" =>$request->mes_asignacion, "item"=>$item])->with('actualizar', 'ok');
        }else{
            return redirect()->route('asignadosicontrato.info',["asigdosicont" =>$request->id_novedadcontratodosimetriasededepto, "mesnumber" =>$request->mes_asignacion, "item"=>$item])->with('actualizar', 'ok');
        }
        
    }
    ///EDITAR DOSIMETROS DE CONTROL///
    public function editlecturadosicontrol($id, $id_contdosisededepto, $item){
        if($item == 0){
            $contdosisededepto = Contratodosimetriasededepto::find($id_contdosisededepto);
        }else if($item == 1){
            $contdosisededepto = Novcontdosisededepto::find($id_contdosisededepto);
        }
        $dosicontasig = Dosicontrolcontdosisede::find($id);   
        return view('dosimetria.lectura_dosimetro_control_edit', compact('dosicontasig', 'contdosisededepto', 'item'));
    }
    //// LECTURA DOSIMETROS AREA/////
    public function lecturadosiarea($id, $item){
        $dosiareasig = Dosiareacontdosisede::find($id);
        return view('dosimetria.lectura_dosimetro_area_contrato', compact('dosiareasig', 'item'));
    }
    ////LECTURA DE DOSIMETROS AREA CON CONTROL////
    public function lecturadosiareacontrl($id, $idcontrol, $item){
        $dosiareasig = Dosiareacontdosisede::find($id);
        $dosicontrolasig = Dosicontrolcontdosisede::find($idcontrol);
        /* return $dosicontrolasig; */
        /* return "con dosimetro de control".$dosicontrolasig; */
        return view('dosimetria.lectura_dosimetro_areacontrol_contrato', compact('dosiareasig', 'dosicontrolasig', 'item'));
        /* return $trabjasig; */
    }
    //// EDITAR DOSIMETROS AREA CON CONTROL////
    public function editlecturadosiareacontrl($id, $idcontrol, $item){
        $dosiareasig = Dosiareacontdosisede::find($id);
        $dosicontrolasig = Dosicontrolcontdosisede::find($idcontrol);
        return view('dosimetria.lectura_dosimetro_areacontrol_contrato_edit', compact('dosiareasig', 'dosicontrolasig', 'item'));
    }
    ////GUARDAR LECTURA DE DOSIMETROS AREA ///////
    public function savelecturadosiarea(Request $request, $id, $item){
       
        $dosiareacontasig = Dosiareacontdosisede::find($id);

        if($request->nota2 != '' || $request->dnl != ''|| $request->eu != '' || $request->dsu !='' || $request->dpl !=''){
        }else{
            $request->validate([
                'measurement_date'              => 'required',
            ]); 

        }

        $dosiareacontasig->zero_level_date                     = $request->zeroLevel_date;
        $dosiareacontasig->measurement_date                    = $request->measurement_date;
        $dosiareacontasig->Hp007_calc_dose                     = $request->hp007_calc_dose;
        $dosiareacontasig->Hp007_background_dose               = $request->hp007_background_dose;
        $dosiareacontasig->Hp007_raw_dose                      = $request->hp007_raw_dose;
        $dosiareacontasig->Hp007_dif_dosicont                  = $request->hp007_calc_dose - $request->hp007_calc_dose_control;
        $dosiareacontasig->Hp10_calc_dose                      = $request->hp10_calc_dose;
        $dosiareacontasig->Hp10_background_dose                = $request->hp10_background_dose;
        $dosiareacontasig->Hp10_raw_dose                       = $request->hp10_raw_dose;
        $dosiareacontasig->Hp10_dif_dosicont                   = $request->hp10_calc_dose - $request->hp10_calc_dose_control;
        $dosiareacontasig->Hp3_calc_dose                       = $request->hp3_calc_dose;
        $dosiareacontasig->Hp3_background_dose                 = $request->hp3_background_dose;
        $dosiareacontasig->Hp3_raw_dose                        = $request->hp3_raw_dose - $request->hp3_calc_dose_control;
        $dosiareacontasig->H_10_calc_dose                      = $request->h10_cal_dose;
        $dosiareacontasig->verification_date                   = $request->verification_Date;
        $dosiareacontasig->verification_required_on_or_before  = $request->verification_required_before;
        $dosiareacontasig->remaining_days_available_for_use    = $request->remaining_days_available_use;
        $dosiareacontasig->nota1                               = $request->nota1;
        $dosiareacontasig->nota2                               = $request->nota2;
        $dosiareacontasig->nota3                               = $request->nota3;
        $dosiareacontasig->nota4                               = $request->nota4;
        $dosiareacontasig->nota5                               = $request->nota5;
        $dosiareacontasig->nota6                               = $request->nota6;
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
        if($item == 0){
            return redirect()->route('asignadosicontrato.info',["asigdosicont" =>$request->id_contratodosimetriasededepto, "mesnumber" =>$request->mes_asignacion, "item"=>$item])->with('actualizar', 'ok');
        }else{
            return redirect()->route('asignadosicontrato.info',["asigdosicont" =>$request->id_novedadcontratodosimetriasededepto, "mesnumber" =>$request->mes_asignacion, "item"=>$item])->with('actualizar', 'ok');
        }
        /* return $request; */
    }
    /////EDITAR LECTURA DOSIMETROS AREA /////
    public function editlecturadosiarea($id, $item){
        $dosiareasig = Dosiareacontdosisede::find($id);
        return view('dosimetria.lectura_dosimetro_area_edit', compact('dosiareasig', 'item'));
    }
    public function pdf($id, $mesnumber, $item){
        if($item == 0){
            $contdosisededepto = Contratodosimetriasededepto::find($id);
            $contratoDosi = Departamento::join('departamentosedes', 'departamentos.id_departamento', '=', 'departamentosedes.departamento_id')
            ->join('contratodosimetriasededeptos', 'departamentosedes.id_departamentosede', '=', 'contratodosimetriasededeptos.departamentosede_id')
            ->join('contratodosimetriasedes', 'contratodosimetriasededeptos.contratodosimetriasede_id','=','contratodosimetriasedes.id_contratodosimetriasede')
            ->join('sedes', 'contratodosimetriasedes.sede_id', '=', 'sedes.id_sede')
            ->join('colmunicipios', 'sedes.municipiocol_id', '=', 'colmunicipios.id_municipiocol')
            ->join('coldepartamentos', 'colmunicipios.departamentocol_id', '=', 'coldepartamentos.id_departamentocol')
            ->join('dosimetriacontratos', 'contratodosimetriasedes.contratodosimetria_id', '=', 'dosimetriacontratos.id_contratodosimetria')
            ->join('empresas', 'dosimetriacontratos.empresa_id', '=', 'empresas.id_empresa')
            ->where('contratodosimetriasededeptos.id_contdosisededepto', '=', $id)
            ->select('empresas.razon_social_empresa','empresas.nombre_empresa', 'sedes.nombre_sede', 'dosimetriacontratos.codigo_contrato','dosimetriacontratos.ocupacion', 'departamentos.nombre_departamento', 'empresas.tipo_identificacion_empresa','empresas.num_iden_empresa', 'colmunicipios.nombre_municol', 'coldepartamentos.abreviatura_deptocol', 'dosimetriacontratos.periodo_recambio')
            ->get();
            $personaEncargada = Contratodosimetriasededepto::join('contratodosimetriasedes', 'contratodosimetriasededeptos.contratodosimetriasede_id', '=', 'contratodosimetriasedes.id_contratodosimetriasede')
            ->join('personasedes', 'contratodosimetriasedes.sede_id', '=', 'personasedes.sede_id')
            ->join('personas', 'personasedes.persona_id', '=', 'personas.id_persona')
            ->where('contratodosimetriasededeptos.id_contdosisededepto', '=', $id)
            ->where('lider_dosimetria', '=', 'TRUE')
            ->get();
            $personaEncargadaPerfiles = Contratodosimetriasededepto::join('contratodosimetriasedes', 'contratodosimetriasededeptos.contratodosimetriasede_id', '=', 'contratodosimetriasedes.id_contratodosimetriasede')
            ->join('personasedes', 'contratodosimetriasedes.sede_id', '=', 'personasedes.sede_id')
            ->join('personas', 'personasedes.persona_id', '=', 'personas.id_persona')
            ->join('personasperfiles', 'personas.id_persona', '=', 'personasperfiles.persona_id')
            ->join('perfiles', 'personasperfiles.perfil_id', '=', 'perfiles.id_perfil')
            ->where('contratodosimetriasededeptos.id_contdosisededepto', '=', $id)
            ->where('lider_dosimetria', '=', 'TRUE')
            ->get();
    
            $trabajdosiasig= Trabajadordosimetro::where('contdosisededepto_id', '=', $id)
            ->where('novcontdosisededepto_id', '=', NULL)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
    
            $fechainiciodositrabaj = array();
            for($i=0; $i<count($trabajdosiasig); $i++){
                $fechainiciodositrabaj[]=Trabajadordosimetro::where('persona_id','=', $trabajdosiasig[$i]->persona_id)->first();
            }
            $dosicontrolasig = Dosicontrolcontdosisede::join('dosimetros', 'dosicontrolcontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
            ->join('contratodosimetriasededeptos', 'dosicontrolcontdosisedes.contdosisededepto_id', '=', 'contratodosimetriasededeptos.id_contdosisededepto')
            ->join('departamentosedes','contratodosimetriasededeptos.departamentosede_id', '=', 'departamentosedes.id_departamentosede')
            ->where('contdosisededepto_id', '=', $id)
            ->where('novcontdosisededepto_id', '=', NULL)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            $dosicontrolasigUnico = Dosicontrolcontdosisede::where('contratodosimetria_id', '=', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('novcontdosisededepto_id', '=', NULL)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            $dosiareasig = Dosiareacontdosisede::where('contdosisededepto_id', '=', $id)
            ->where('novcontdosisededepto_id', '=', NULL)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            
            $mesescantdosi = Mesescontdosisedeptos::where('contdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->select('nota_cambiodosim')        
            ->get();
            
            $SumatoriaDocemesestrabajadoresaisg = array();
            for($i=0; $i<count($trabajdosiasig); $i++){
    
                $SumatoriaDocemesestrabajadoresaisg[] = Trabajadordosimetro::where('persona_id', '=', $trabajdosiasig[$i]->persona_id)
                ->where('measurement_date', '!=', NULL)
                ->where('ubicacion', '=', $trabajdosiasig[$i]->ubicacion)
                /*->where('contdosisededepto_id', '=', $id)
                ->where('ubicacion', '=', $trabajdosiasig[$i]->ubicacion)
                ->where('mes_asignacion', '<=', $mesnumber)*/
                ->latest()
                ->take(12)
                ->get();
            }
            $SumatoriaDocemesesAreasasig = array();
            for($i=0; $i<count($dosiareasig); $i++){
    
                $SumatoriaDocemesesAreasasig[] = Dosiareacontdosisede::where('areadepartamentosede_id', '=', $dosiareasig[$i]->areadepartamentosede_id)
                ->where('measurement_date', '!=', NULL)
                /*->where('mes_asignacion', '<=', $mesnumber)
                ->where('contdosisededepto_id', '=', $id)
                ->where('mes_asignacion', '<=', $mesnumber)*/
                ->latest()
                ->take(12)
                ->get();
            }
       
            $SumatoriaFechaIngresomesestrabajadoresaisg = array();
            for($i=0; $i<count($trabajdosiasig); $i++){
    
                $SumatoriaFechaIngresomesestrabajadoresaisg[] = Trabajadordosimetro::where('persona_id', '=', $trabajdosiasig[$i]->persona_id)
                ->where('measurement_date', '!=', NULL)
                ->where('ubicacion', '=', $trabajdosiasig[$i]->ubicacion)
                /* ->where('contdosisededepto_id', '=', $id)
                ->where('ubicacion', '=', $trabajdosiasig[$i]->ubicacion)
                ->where('mes_asignacion', '<=', $mesnumber) */
                ->get();
            }
            $SumatoriaFechaIngresomesesAreasasig = array();
            for($i=0; $i<count($dosiareasig); $i++){
    
                $SumatoriaFechaIngresomesesAreasasig[] = Dosiareacontdosisede::where('areadepartamentosede_id', '=', $dosiareasig[$i]->areadepartamentosede_id)
                ->where('measurement_date', '!=', NULL)
                /* ->where('contdosisededepto_id', '=', $id)
                ->where('mes_asignacion', '<=', $mesnumber) */
                ->get();
            }

        }else{
            $contdosisededepto = Novcontdosisededepto::find($id);
            $contratoDosi = Departamento::join('departamentosedes', 'departamentos.id_departamento', '=', 'departamentosedes.departamento_id')
            ->join('novcontdosisededeptos', 'departamentosedes.id_departamentosede', '=', 'novcontdosisededeptos.departamentosede_id')
            ->join('contratodosimetriasedes', 'novcontdosisededeptos.contratodosimetriasede_id','=','contratodosimetriasedes.id_contratodosimetriasede')
            ->join('sedes', 'contratodosimetriasedes.sede_id', '=', 'sedes.id_sede')
            ->join('colmunicipios', 'sedes.municipiocol_id', '=', 'colmunicipios.id_municipiocol')
            ->join('coldepartamentos', 'colmunicipios.departamentocol_id', '=', 'coldepartamentos.id_departamentocol')
            ->join('dosimetriacontratos', 'contratodosimetriasedes.contratodosimetria_id', '=', 'dosimetriacontratos.id_contratodosimetria')
            ->join('empresas', 'dosimetriacontratos.empresa_id', '=', 'empresas.id_empresa')
            ->where('novcontdosisededeptos.id_novcontdosisededepto', '=', $id)
            ->select('empresas.razon_social_empresa','empresas.nombre_empresa', 'sedes.nombre_sede', 'dosimetriacontratos.codigo_contrato','dosimetriacontratos.ocupacion', 'departamentos.nombre_departamento', 'empresas.tipo_identificacion_empresa','empresas.num_iden_empresa', 'colmunicipios.nombre_municol', 'coldepartamentos.abreviatura_deptocol', 'dosimetriacontratos.periodo_recambio')
            ->get();
            $personaEncargada = Novcontdosisededepto::join('contratodosimetriasedes', 'novcontdosisededeptos.contratodosimetriasede_id', '=', 'contratodosimetriasedes.id_contratodosimetriasede')
            ->join('personasedes', 'contratodosimetriasedes.sede_id', '=', 'personasedes.sede_id')
            ->join('personas', 'personasedes.persona_id', '=', 'personas.id_persona')
            ->where('novcontdosisededeptos.id_novcontdosisededepto', '=', $id)
            ->where('lider_dosimetria', '=', 'TRUE')
            ->get();
            $personaEncargadaPerfiles =  Novcontdosisededepto::join('contratodosimetriasedes', 'novcontdosisededeptos.contratodosimetriasede_id', '=', 'contratodosimetriasedes.id_contratodosimetriasede')
            ->join('personasedes', 'contratodosimetriasedes.sede_id', '=', 'personasedes.sede_id')
            ->join('personas', 'personasedes.persona_id', '=', 'personas.id_persona')
            ->join('personasperfiles', 'personas.id_persona', '=', 'personasperfiles.persona_id')
            ->join('perfiles', 'personasperfiles.perfil_id', '=', 'perfiles.id_perfil')
            ->where('novcontdosisededeptos.id_novcontdosisededepto', '=', $id)
            ->where('lider_dosimetria', '=', 'TRUE')
            ->get();
    
            $trabajdosiasig= Trabajadordosimetro::where('novcontdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            
            $fechainiciodositrabaj = array();
            for($i=0; $i<count($trabajdosiasig); $i++){
                $fechainiciodositrabaj[]=Trabajadordosimetro::where('persona_id','=', $trabajdosiasig[$i]->persona_id)->first();
            }
            $dosicontrolasig = Dosicontrolcontdosisede::join('dosimetros', 'dosicontrolcontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
            ->join('novcontdosisededeptos', 'dosicontrolcontdosisedes.novcontdosisededepto_id', '=', 'novcontdosisededeptos.id_novcontdosisededepto')
            ->join('departamentosedes','novcontdosisededeptos.departamentosede_id', '=', 'departamentosedes.id_departamentosede')
            ->where('novcontdosisededeptos.id_novcontdosisededepto', '=', $id)
            ->where('dosicontrolcontdosisedes.mes_asignacion', '=', $mesnumber)
            ->get();
            $dosicontrolasigUnico = Dosicontrolcontdosisede::where('contratodosimetria_id', '=', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('novcontdosisededepto_id', $id)
            ->get();
            $dosiareasig = Dosiareacontdosisede::where('novcontdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            
            $mesescantdosi = Mesescontdosisedeptos::where('novcontdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->select('nota_cambiodosim')        
            ->get();
            
            $SumatoriaDocemesestrabajadoresaisg = array();
            for($i=0; $i<count($trabajdosiasig); $i++){
    
                $SumatoriaDocemesestrabajadoresaisg[] = Trabajadordosimetro::where('persona_id', '=', $trabajdosiasig[$i]->persona_id)
                ->where('measurement_date', '!=', NULL)
                ->where('ubicacion', '=', $trabajdosiasig[$i]->ubicacion)
                /* ->where('novcontdosisededepto_id', '=', $id)
                ->where('ubicacion', '=', $trabajdosiasig[$i]->ubicacion)
                ->where('mes_asignacion', '<=', $mesnumber) */
                ->latest()
                ->take(12)
                ->get();
            }
            $SumatoriaDocemesesAreasasig = array();
            for($i=0; $i<count($dosiareasig); $i++){
    
                $SumatoriaDocemesesAreasasig[] = Dosiareacontdosisede::where('areadepartamentosede_id', '=', $dosiareasig[$i]->areadepartamentosede_id)
                ->where('measurement_date', '!=', NULL)
                /*->where('mes_asignacion', '<=', $mesnumber)
                ->where('novcontdosisededepto_id', '=', $id)
                ->where('mes_asignacion', '<=', $mesnumber) */
                ->latest()
                ->take(12)
                ->get();
            }
            
            $SumatoriaFechaIngresomesestrabajadoresaisg = array();
            for($i=0; $i<count($trabajdosiasig); $i++){
    
                $SumatoriaFechaIngresomesestrabajadoresaisg[] = Trabajadordosimetro::where('persona_id', '=', $trabajdosiasig[$i]->persona_id)
                ->where('measurement_date', '!=', NULL)
                ->where('ubicacion', '=', $trabajdosiasig[$i]->ubicacion)
                /* ->where('novcontdosisededepto_id', '=', $id)
                ->where('ubicacion', '=', $trabajdosiasig[$i]->ubicacion)
                ->where('mes_asignacion', '<=', $mesnumber) */
                ->get();
            }
            $SumatoriaFechaIngresomesesAreasasig = array();
            for($i=0; $i<count($dosiareasig); $i++){
    
                $SumatoriaFechaIngresomesesAreasasig[] = Dosiareacontdosisede::where('areadepartamentosede_id', '=', $dosiareasig[$i]->areadepartamentosede_id)
                ->where('measurement_date', '!=', NULL)
                /* ->where('novcontdosisededepto_id', '=', $id)
                ->where('mes_asignacion', '<=', $mesnumber) */
                ->get();
            }
            //////CAMBIO DE ESTADO EN LA SUBESPECIALIDAD POR NOVEDAD//////
            $trabjT= count($trabajdosiasig);
            $trabj = 0; 
            for($i=0; $i<count($trabajdosiasig); $i++){
                if($trabajdosiasig[$i]->measurement_date != NULL){
                    $trabj ++;
                }
            }
            $contT= count($dosicontrolasig);
            $cont = 0;
            for($i=0; $i<count($dosicontrolasig); $i++){
                if($dosicontrolasig[$i]->measurement_date != NULL){
                    $cont ++;
                }
            }
            $areaT= count($dosiareasig);
            $area = 0;
            for($i=0; $i<count($dosiareasig); $i++){
                if($dosiareasig[$i]->measurement_date != NULL){
                    $area ++;
                }
            }
            if($trabjT == $trabj && $contT == $cont && $areaT == $area){
                $contdosisededepto->estado_nov = 'INACTIVO';
                $contdosisededepto->save();
            }
        }
     
        $pdf = PDF::loadView('dosimetria.reportePDF_dosimetria', compact('trabajdosiasig', 'dosicontrolasig', 'dosicontrolasigUnico', 'dosiareasig', 'contratoDosi', 'personaEncargada', 'personaEncargadaPerfiles', 'fechainiciodositrabaj', 'SumatoriaDocemesestrabajadoresaisg', 'SumatoriaDocemesesAreasasig','SumatoriaFechaIngresomesestrabajadoresaisg', 'SumatoriaFechaIngresomesesAreasasig', 'mesescantdosi', 'mesnumber'));
        $pdf->setPaper('8.5x14', 'landscape');
        return $pdf->stream("REPORTE_DOSIMETRIA_".$contratoDosi[0]->nombre_empresa."_".mb_substr($contratoDosi[0]->nombre_sede, 0,6,"UTF-8")."_".mb_substr($contratoDosi[0]->nombre_departamento, 0,6,"UTF-8")."_".$contratoDosi[0]->periodo_recambio."_P".$mesnumber.".pdf");
        /* for($i=0; $i<count($contratoDosi); $i++ ){
            
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
            /* return $newDate;
        } */
        /* return $personaEncargada; */

    }
    public function pdfEtiquetas($id, $mesnumber, $item){
        ///////se implemento el parametro item para diferenciar si se utiliza el modelo Contratodosimetriasededepto o Novcontdosisededepto//////
        /////// esto es decir, si esta funcion se llama desde una especialidad se utliza Contratodosimetriasededepto o si se llama desde una sub-especialidad por novedad se utiliza Novcontdosisededepto//////////
        if($item == 0){
            $contdosisededepto = Contratodosimetriasededepto::find($id);
            $dosicontrolasig = Dosicontrolcontdosisede::where('contdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get(); 
            $dosicontrolUnicoasig = Dosicontrolcontdosisede::where('mes_asignacion', '=', $mesnumber)
            ->where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->get();
            $trabajdosiasig= Trabajadordosimetro::where('contdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            $areadosiasig = Dosiareacontdosisede::where('contdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();

            $pdf = PDF::loadView('dosimetria.etiquetasPDF1_dosimetria', compact('contdosisededepto', 'trabajdosiasig', 'dosicontrolasig', 'dosicontrolUnicoasig', 'areadosiasig'));
        }else if($item == 1){
            $contdosisededepto = Novcontdosisededepto::find($id);
            $dosicontrolasig = Dosicontrolcontdosisede::where('novcontdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            $dosicontrolUnicoasig = Dosicontrolcontdosisede::where('mes_asignacion', '=', $mesnumber)
            ->where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->get(); 
            $trabajdosiasig= Trabajadordosimetro::where('novcontdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            $areadosiasig = Dosiareacontdosisede::where('novcontdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();

            $pdf = PDF::loadView('dosimetria.etiquetasPDF1_dosimetria', compact('contdosisededepto', 'trabajdosiasig', 'dosicontrolasig', 'dosicontrolUnicoasig', 'areadosiasig'));
        }
        /* $pdf->setPaper('A4', 'portrait'); */
        $pdf->setPaper( array(0, 0, 144,66.04724), 'portrait'); 
        return $pdf->stream("ETIQUETAS_".$contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa."_".mb_substr($contdosisededepto->contratodosimetriasede->sede->nombre_sede, 0,6,"UTF-8")."_".mb_substr($contdosisededepto->departamentosede->departamento->nombre_departamento, 0,6,"UTF-8")."_".$contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio."_P".$mesnumber.".pdf");
    }
    public function revisionDosimetria($id, $mesnumber, $item){
        if($item == 0){
            $contdosisededepto = Contratodosimetriasededepto::find($id);
            $dosicontrolasig = Dosicontrolcontdosisede::where('mes_asignacion', '=', $mesnumber)
            ->where('contdosisededepto_id', $id)
            ->where('novcontdosisededepto_id', NULL)
            ->get();
            $dosicontrolUnicoasig = Dosicontrolcontdosisede::where('mes_asignacion', '=', $mesnumber)
            ->where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('novcontdosisededepto_id', NULL)
            ->get();
            $trabjasignados = Trabajadordosimetro::where('contdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('novcontdosisededepto_id', NULL)
            ->get();
            $areadosiasig =Dosiareacontdosisede::where('contdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('novcontdosisededepto_id', NULL)
            ->get();
            $trabjEncargado = Persona::join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
            ->where('personasedes.sede_id', '=', $contdosisededepto->contratodosimetriasede->sede_id)
            ->where('personas.lider_dosimetria', '=', 'TRUE')
            ->get();
        }else if($item == 1){
            $contdosisededepto = Novcontdosisededepto::find($id);
            $dosicontrolasig = Dosicontrolcontdosisede::where('mes_asignacion', '=', $mesnumber)
            ->where('novcontdosisededepto_id', $id)
            ->get();
            $dosicontrolUnicoasig = Dosicontrolcontdosisede::where('mes_asignacion', '=', $mesnumber)
            ->where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('novcontdosisededepto_id', $id)
            ->get();
            $trabjasignados = Trabajadordosimetro::where('novcontdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            $areadosiasig = Dosiareacontdosisede::where('novcontdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            $trabjEncargado = Persona::join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
            ->where('personasedes.sede_id', '=', $contdosisededepto->contratodosimetriasede->sede_id)
            ->where('personas.lider_dosimetria', '=', 'TRUE')
            ->get();
        }
        return view('dosimetria.revision_asignaciones_dosimetria', compact('trabjasignados','dosicontrolasig', 'dosicontrolUnicoasig', 'contdosisededepto', 'mesnumber', 'areadosiasig', 'trabjEncargado', 'item'));
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
    public function revisionCheckAmbiental(Request $request){
        $dosiambiental = Dosiareacontdosisede::where('id_dosiareacontdosisedes', '=', $request->id_dosiareacontdosisedes )
        ->update([
            'revision_salida' => 'TRUE'
        ]);
        return response()->json($dosiambiental);
    }
    public function revisionDosimetriaGeneral(){
       
        return view('dosimetria.revision_asignaciones_dosimetria_general1');
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
        ->where('empresas.id_empresa', '=', $request->empresa)
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
        ->join('departamentos', 'departamentosedes.departamento_id', '=', 'departamentos.id_departamento')
        ->whereNull('dosicontrolcontdosisedes.revision_salida')
        ->where('empresas.id_empresa', '=', $request->empresa)
        ->select('dosicontrolcontdosisedes.id_dosicontrolcontdosisedes', 'dosicontrolcontdosisedes.mes_asignacion', 'dosimetros.codigo_dosimeter', 'dosimetriacontratos.codigo_contrato', 'sedes.nombre_sede', 'departamentos.nombre_departamento')
        ->get();
        
        return response()->json($asignacionesControlall);
    }
    public function observacionesreventrada(Request $request){
        if($request->item == 0){
            $observacionesAsig = Obsreventrada::where('contdosisededepto_id', '=', $request->id)
            ->where('mes_asignacion', '=', $request->mes)
            ->get();
        }else{
            $observacionesAsig = Obsreventrada::where('novcontdosisededepto_id', '=', $request->id)
            ->where('mes_asignacion', '=', $request->mes)
            ->get();
        }
        return response()->json($observacionesAsig);
    }
    public function asignacionesTrab(Request $request){
        if($request->item == 0){
            $asignaciones = Trabajadordosimetro::where('contdosisededepto_id', '=', $request->id)
            ->where('mes_asignacion', '=', $request->mes)
            ->get();
        }else{
            $asignaciones = Trabajadordosimetro::where('novcontdosisededepto_id', '=', $request->id)
            ->where('mes_asignacion', '=', $request->mes)
            ->get();
        }
        return response()->json($asignaciones);
    }
    public function asignacionesCont(Request $request){
        if($request->item == 0){
            $asignacionesControl = Dosicontrolcontdosisede::where('contdosisededepto_id', '=', $request->id)
            ->where('mes_asignacion', '=', $request->mes)
            ->get();
            
        }else{
            $asignacionesControl = Dosicontrolcontdosisede::where('novcontdosisededepto_id', '=', $request->id)
            ->where('mes_asignacion', '=', $request->mes)
            ->get();
        }
        return response()->json($asignacionesControl);
    }
    public function asignacionesContUnic(Request $request){
        if($request->item == 0){
            $contdosisededepto = Contratodosimetriasededepto::find($request->id);
            $asignacionesControl = Dosicontrolcontdosisede::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('mes_asignacion', '=', $request->mes)
            ->get();
            
        }else{
            $asignacionesControl = Dosicontrolcontdosisede::where('novcontdosisededepto_id', '=', $request->id)
            ->where('mes_asignacion', '=', $request->mes)
            ->get();
        }
        return response()->json($asignacionesControl);
    }
    public function asignacionesArea(Request $request){
        if($request->item == 0){
            $asignacionesArea = Dosiareacontdosisede::where('contdosisededepto_id', '=', $request->id)
            ->where('mes_asignacion', '=', $request->mes)
            ->get();
        }else{
            $asignacionesArea = Dosiareacontdosisede::where('novcontdosisededepto_id', '=', $request->id)
            ->where('mes_asignacion', '=', $request->mes)
            ->get();
        }
        return response()->json($asignacionesArea);
    }
    public function trabjencargado(Request $request){
        if($request->item == 0){
            $contdosisededepto = Contratodosimetriasededepto::find($request->id);
            $trabjEncargado = Persona::join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
            ->where('personasedes.sede_id', '=', $contdosisededepto->contratodosimetriasede->sede_id)
            ->where('personas.lider_dosimetria', '=', 'TRUE')
            ->get();
        }else{
            $contdosisededepto = Novcontdosisededepto::find($request->id);
            $trabjEncargado = Persona::join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
            ->where('personasedes.sede_id', '=', $contdosisededepto->contratodosimetriasede->sede_id)
            ->where('personas.lider_dosimetria', '=', 'TRUE')
            ->get();
        }
        return response()->json($trabjEncargado);
    }
    public function pdfReporteRevisionSalida($empresa, $deptodosi, $mesnumber, $item){
        if($item == 0){
            $contdosisededepto = Contratodosimetriasededepto::find($deptodosi);
          
            $dosicontrolasig = Dosicontrolcontdosisede::where('contdosisededepto_id', '=', $deptodosi)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('novcontdosisededepto_id', NULL)
            ->where('revision_salida', '=', 'TRUE')
            ->get();
            $dosicontrolUnicoasig = Dosicontrolcontdosisede::where('mes_asignacion', '=', $mesnumber)
            ->where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('novcontdosisededepto_id', NULL)
            ->where('revision_salida', '=', 'TRUE')
            ->get();
            $trabjasignados = Trabajadordosimetro::where('contdosisededepto_id', '=', $deptodosi)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('novcontdosisededepto_id', NULL)
            ->where('revision_salida', '=', 'TRUE')
            ->get();
            $areasignados = Dosiareacontdosisede::where('contdosisededepto_id', '=', $deptodosi)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('novcontdosisededepto_id', NULL)
            ->where('revision_salida', '=', 'TRUE')
            ->get();
            $trabjEncargado = Persona::join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
            ->where('personasedes.sede_id', '=', $contdosisededepto->contratodosimetriasede->sede_id)
            ->where('personas.lider_dosimetria', '=', 'TRUE')
            ->get();
            
            //PARA LA REVISION GENERAL///
            $temptrabajdosimrev = Temptrabajdosimrev::join('contratodosimetriasededeptos', 'temptrabajdosimrevs.contdosisededepto_id', '=', 'contratodosimetriasededeptos.id_contdosisededepto')
            ->join('departamentosedes', 'contratodosimetriasededeptos.departamentosede_id', '=', 'departamentosedes.id_departamentosede')
            ->join('sedes', 'departamentosedes.sede_id', '=', 'sedes.id_sede')
            ->join('departamentos', 'departamentosedes.departamento_id', '=', 'departamentos.id_departamento')
            ->get();
            $empresainfo= ContratosDosimetriaEmpresa::where('empresa_id', '=', $empresa)
            ->get();

            $pdf =  PDF::loadView('dosimetria.reportePDF_revisionsalida_dosimetria', compact('contdosisededepto', 'dosicontrolasig', 'dosicontrolUnicoasig', 'mesnumber', 'trabjasignados', 'temptrabajdosimrev', 'empresainfo', 'areasignados', 'trabjEncargado'));
        }else{
            $contdosisededepto = Novcontdosisededepto::find($deptodosi);
          
            $dosicontrolasig = Dosicontrolcontdosisede::where('novcontdosisededepto_id', '=', $deptodosi)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('revision_salida', '=', 'TRUE')
            ->get();
            $dosicontrolUnicoasig = Dosicontrolcontdosisede::where('mes_asignacion', '=', $mesnumber)
            ->where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('novcontdosisededepto_id', '=', $deptodosi)
            ->where('revision_salida', '=', 'TRUE')
            ->get();
            $trabjasignados = Trabajadordosimetro::where('novcontdosisededepto_id', '=', $deptodosi)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('revision_salida', '=', 'TRUE')
            ->get();
            $areasignados = Dosiareacontdosisede::where('novcontdosisededepto_id', '=', $deptodosi)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('revision_salida', '=', 'TRUE')
            ->get();
            $trabjEncargado = Persona::join('personasedes', 'personas.id_persona', '=', 'personasedes.persona_id')
            ->where('personasedes.sede_id', '=', $contdosisededepto->contratodosimetriasede->sede_id)
            ->where('personas.lider_dosimetria', '=', 'TRUE')
            ->get();
            $empresainfo= ContratosDosimetriaEmpresa::where('empresa_id', '=', $empresa)
            ->get();
            $pdf =  PDF::loadView('dosimetria.reportePDF_revisionsalida_dosimetria', compact('contdosisededepto', 'dosicontrolasig', 'dosicontrolUnicoasig', 'mesnumber', 'trabjasignados', 'empresainfo', 'areasignados', 'trabjEncargado'));
            //PARA LA REVISION GENERAL///
            /* $temptrabajdosimrev = Temptrabajdosimrev::join('contratodosimetriasededeptos', 'temptrabajdosimrevs.contdosisededepto_id', '=', 'contratodosimetriasededeptos.id_contdosisededepto')
            ->join('departamentosedes', 'contratodosimetriasededeptos.departamentosede_id', '=', 'departamentosedes.id_departamentosede')
            ->join('sedes', 'departamentosedes.sede_id', '=', 'sedes.id_sede')
            ->join('departamentos', 'departamentosedes.departamento_id', '=', 'departamentos.id_departamento')
            ->get();
            $empresainfo= ContratosDosimetriaEmpresa::where('empresa_id', '=', $empresa)
            ->get(); */
        }
        
       /*  return $temptrabajdosimrev; */
        
        $pdf->setPaper('A4', 'portrait');
        date_default_timezone_set('America/Bogota');
        return $pdf->stream("RSD_OSL_QA_".mb_substr($contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa, 0,15,"UTF-8")."_".mb_substr($contdosisededepto->contratodosimetriasede->sede->nombre_sede, 0,10,"UTF-8")."_".mb_substr($contdosisededepto->departamentosede->departamento->nombre_departamento, 0,6,"UTF-8")."_".date("Y").date("m").date("d").date("H").date("i").date("s").".pdf");
    }
    public function pdfReporteRevisionEntrada($empresa, $deptodosi, $mesnumber, $item){
        if($item == 0){
            $contdosisededepto = Contratodosimetriasededepto::find($deptodosi);
            $dosicontrolasig = Dosicontrolcontdosisede::where('contdosisededepto_id', '=', $deptodosi)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('novcontdosisededepto_id', NULL)
            ->get();
            $dosicontrolUnicoasig = Dosicontrolcontdosisede::where('mes_asignacion', '=', $mesnumber)
            ->where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('novcontdosisededepto_id', NULL)
            ->get();
            $trabjasignados = Trabajadordosimetro::where('contdosisededepto_id', '=', $deptodosi)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('novcontdosisededepto_id', NULL)
            ->get();
            $areasignados = Dosiareacontdosisede::where('contdosisededepto_id', '=', $deptodosi)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('novcontdosisededepto_id', NULL)
            ->get();
            $observacionesAsig = Obsreventrada::where('contdosisededepto_id', '=', $deptodosi)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('novcontdosisededepto_id', NULL)
            ->get();
            $observacionesAsigContUni = Obsreventrada::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('novcontdosisededepto_id', NULL)
            ->get();
    
            //PARA LA REVISION GENERAL DE ENTRADA///
            $temptrabajdosimentradarev = Temptrabajdosimentradarev::join('contratodosimetriasededeptos', 'temptrabajdosimentradarevs.contdosisededepto_id', '=', 'contratodosimetriasededeptos.id_contdosisededepto')
            ->join('departamentosedes', 'contratodosimetriasededeptos.departamentosede_id', '=', 'departamentosedes.id_departamentosede')
            ->join('sedes', 'departamentosedes.sede_id', '=', 'sedes.id_sede')
            ->join('departamentos', 'departamentosedes.departamento_id', '=', 'departamentos.id_departamento')
            ->get();
            $empresainfo= ContratosDosimetriaEmpresa::where('empresa_id', '=', $empresa)
            ->get();
            
            $pdf =  PDF::loadView('dosimetria.reportePDF_revisionentrada_dosimetria', compact('contdosisededepto', 'dosicontrolasig', 'dosicontrolUnicoasig', 'mesnumber', 'trabjasignados', 'areasignados', 'observacionesAsig', 'observacionesAsigContUni','temptrabajdosimentradarev', 'empresainfo'));
        }else{
            $contdosisededepto = Novcontdosisededepto::find($deptodosi);
            $dosicontrolasig = Dosicontrolcontdosisede::where('novcontdosisededepto_id', '=', $deptodosi)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            $dosicontrolUnicoasig = Dosicontrolcontdosisede::where('mes_asignacion', '=', $mesnumber)
            ->where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('novcontdosisededepto_id', '=', $deptodosi)
            ->get();
            $trabjasignados = Trabajadordosimetro::where('novcontdosisededepto_id', '=', $deptodosi)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            $areasignados = Dosiareacontdosisede::where('novcontdosisededepto_id', '=', $deptodosi)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            $observacionesAsig = Obsreventrada::where('novcontdosisededepto_id', '=', $deptodosi)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            $observacionesAsigContUni = Obsreventrada::where('novcontdosisededepto_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
    
            //PARA LA REVISION GENERAL DE ENTRADA///
           /*  $temptrabajdosimentradarev = Temptrabajdosimentradarev::join('contratodosimetriasededeptos', 'temptrabajdosimentradarevs.contdosisededepto_id', '=', 'contratodosimetriasededeptos.id_contdosisededepto')
            ->join('departamentosedes', 'contratodosimetriasededeptos.departamentosede_id', '=', 'departamentosedes.id_departamentosede')
            ->join('sedes', 'departamentosedes.sede_id', '=', 'sedes.id_sede')
            ->join('departamentos', 'departamentosedes.departamento_id', '=', 'departamentos.id_departamento')
            ->get(); */
            $empresainfo= ContratosDosimetriaEmpresa::where('empresa_id', '=', $empresa)
            ->get();
            
            $pdf =  PDF::loadView('dosimetria.reportePDF_revisionentrada_dosimetria', compact('contdosisededepto', 'dosicontrolasig', 'dosicontrolUnicoasig', 'mesnumber', 'trabjasignados', 'areasignados', 'observacionesAsig', 'observacionesAsigContUni', 'empresainfo'));
        }
        $pdf->setPaper('A4', 'portrait');
        date_default_timezone_set('America/Bogota');
        return $pdf->stream("RED_OSL_QA_".mb_substr($contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa, 0,15,"UTF-8")."_".mb_substr($contdosisededepto->contratodosimetriasede->sede->nombre_sede, 0,10,"UTF-8")."_".mb_substr($contdosisededepto->departamentosede->departamento->nombre_departamento, 0,6,"UTF-8")."_".date("Y").date("m").date("d").date("H").date("i").date("s").".pdf");
        
    }
    public function revisionDosimetriaEntrada($id, $mesnumber, $item){
        if($item == 0){
            $contdosisededepto = Contratodosimetriasededepto::find($id);
            $dosicontrolasig = Dosicontrolcontdosisede::where('contdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('novcontdosisededepto_id', NULL)
            ->get();
            $dosicontrolUnicoasig = Dosicontrolcontdosisede::where('mes_asignacion', '=', $mesnumber)
            ->where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('novcontdosisededepto_id', NULL)
            ->get();
            $trabjasignados = Trabajadordosimetro::where('contdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('novcontdosisededepto_id', NULL)
            ->get();
            $areasignados = Dosiareacontdosisede::where('contdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('novcontdosisededepto_id', NULL)
            ->get();
            $observaciones = Observacion::all();
            $observacionesAsig = Obsreventrada::where('contdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('novcontdosisededepto_id', NULL)
            ->get();
            $observacionesAsigContUni = Obsreventrada::where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('mes_asignacion', '=', $mesnumber)
            ->where('novcontdosisededepto_id', NULL)
            ->get();
            $observacionesDelMes = Mesescontdosisedeptos::where('contdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            /* ->select('nota_cambiodosim') */
            ->get();
           /*  return $observacionesAsigContUni; */
           
        }else if($item == 1){
            $contdosisededepto = Novcontdosisededepto::find($id);
            $dosicontrolasig = Dosicontrolcontdosisede::where('novcontdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            $dosicontrolUnicoasig = Dosicontrolcontdosisede::where('mes_asignacion', '=', $mesnumber)
            ->where('contratodosimetria_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('novcontdosisededepto_id', '=', $id)
            ->get();
            $trabjasignados = Trabajadordosimetro::where('novcontdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            $areasignados = Dosiareacontdosisede::where('novcontdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            $observaciones = Observacion::all();
            $observacionesAsig = Obsreventrada::where('novcontdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            $observacionesAsigContUni = Obsreventrada::where('novcontdosisededepto_id', $contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            $observacionesDelMes = Mesescontdosisedeptos::where('novcontdosisededepto_id', '=', $id)
            ->where('mes_asignacion', '=', $mesnumber)
            ->get();
            
        }
        return view('dosimetria.revision_entrada_asignaciones_dosimetria', compact('trabjasignados','dosicontrolasig', 'dosicontrolUnicoasig', 'contdosisededepto', 'mesnumber', 'areasignados', 'observaciones', 'observacionesAsig', 'observacionesAsigContUni', 'observacionesDelMes', 'item'));
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
    public function revisionEntradaCheckAmbiental(Request $request){
        $areadosimetro = Dosiareacontdosisede::where('id_dosiareacontdosisedes', '=', $request->id_dosiareacontdosisedes)
        ->update([
            'revision_entrada' => 'TRUE'
        ]);
        
        return response()->json($areadosimetro);
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
    public function saveObservacionesReventrada(Request $request){
        
        if(!empty($request->id_dosicontrolcontdosisedes)){
            for($i=0; $i<count($request->id_dosicontrolcontdosisedes); $i++){
                if(!empty($request->input('observacion_asig_dosicont'.$request->id_dosicontrolcontdosisedes[$i]))){
                    $longitudIdcontrol = count($request->input('observacion_asig_dosicont'.$request->id_dosicontrolcontdosisedes[$i]));
                    for($x=0; $x < $longitudIdcontrol; $x++){
                        $obsdosicont= new Obsreventrada();
                        $obsdosicont->dosicontrol_id            = $request->id_dosicontrolcontdosisedes[$i];
                        $obsdosicont->contratodosimetriasede_id = $request->contratodosimetriasede;
                        $obsdosicont->contdosisededepto_id      = $request->contdosisededepto;
                        $obsdosicont->novcontdosisededepto_id   = $request->novcontdosisededepto;
                        $obsdosicont->observacion_id            = empty($request->input('observacion_asig_dosicont'.$request->id_dosicontrolcontdosisedes[$i])[$x]) ? null : $request->input('observacion_asig_dosicont'.$request->id_dosicontrolcontdosisedes[$i])[$x];
                        $obsdosicont->nota_obs9                 = $obsdosicont->observacion_id == 9 ? mb_strtoupper($request->input('obsAddCont'.$request->id_dosicontrolcontdosisedes[$i])) : null;
                        $obsdosicont->mes_asignacion            = $request->mes_asignacion;
                        $obsdosicont->save();
                        if($request->input('observacion_asig_dosicont'.$request->id_dosicontrolcontdosisedes[$i])[$x] == 3){
                            $updatedosicontrol = Dosicontrolcontdosisede::join('dosimetros', 'dosicontrolcontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
                            ->where('dosicontrolcontdosisedes.id_dosicontrolcontdosisedes', '=', $request->id_dosicontrolcontdosisedes[$i])
                            ->update([
                                'dosicontrolcontdosisedes.nota2'            => 'TRUE',
                                'dosimetros.estado_dosimetro'               => 'PERDIDO',
                                'dosimetros.uso_dosimetro'                  => ''
                            ]);
                            
                        }else if($request->input('observacion_asig_dosicont'.$request->id_dosicontrolcontdosisedes[$i])[$x] == 4){
                            $updatedosicontrol = Dosicontrolcontdosisede::where('id_dosicontrolcontdosisedes', '=', $request->id_dosicontrolcontdosisedes[$i])
                            ->update([
                                'dosicontrolcontdosisedes.DNL'              => 'TRUE',
                                'dosimetros.estado_dosimetro'               => 'DAÑADO',
                                'dosimetros.uso_dosimetro'                  => ''
                            ]);
                        }
                    }
                }elseif(!empty($request->input('observacion_asig_dosicontTransUnic'.$request->id_dosicontrolcontdosisedes[$i]))){
                    $longitudIdcontrol = count($request->input('observacion_asig_dosicontTransUnic'.$request->id_dosicontrolcontdosisedes[$i]));
                    $obsAnteriores = Obsreventrada::where('dosicontrol_id', '=', $request->id_dosicontrolcontdosisedes[$i])
                    ->where('mes_asignacion', '=', $request->mes_asignacion)
                    ->get();

                    for($x=0; $x < $longitudIdcontrol; $x++){
                        if(count($obsAnteriores) != 0){
                            if($obsAnteriores[0]->observacion_id != $request->input('observacion_asig_dosicontTransUnic'.$request->id_dosicontrolcontdosisedes[$i])[$x]){
                                $obsdosicont= new Obsreventrada();
                                $obsdosicont->dosicontrol_id            = $request->id_dosicontrolcontdosisedes[$i];
                                $obsdosicont->contratodosimetria_id     = $request->contratodosimetria;
                                $obsdosicont->novcontdosisededepto_id   = $request->novcontdosisededepto;
                                $obsdosicont->observacion_id            = empty($request->input('observacion_asig_dosicontTransUnic'.$request->id_dosicontrolcontdosisedes[$i])[$x]) ? null : $request->input('observacion_asig_dosicontTransUnic'.$request->id_dosicontrolcontdosisedes[$i])[$x];
                                $obsdosicont->nota_obs9                 = $obsdosicont->observacion_id == 9 ? mb_strtoupper($request->input('obsAddCont'.$request->id_dosicontrolcontdosisedes[$i])) : null;
                                $obsdosicont->mes_asignacion            = $request->mes_asignacion;
                                $obsdosicont->save();
        
                                if($request->input('observacion_asig_dosicontTransUnic'.$request->id_dosicontrolcontdosisedes[$i])[$x] == 3){
                                    $updatedosicontrol = Dosicontrolcontdosisede::join('dosimetros', 'dosicontrolcontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
                                    ->where('dosicontrolcontdosisedes.id_dosicontrolcontdosisedes', '=', $request->id_dosicontrolcontdosisedes[$i])
                                    ->update([
                                        'dosicontrolcontdosisedes.nota2'            => 'TRUE',
                                        'dosimetros.estado_dosimetro'               => 'PERDIDO',
                                        'dosimetros.uso_dosimetro'                  => ''
                                    ]);
                                    
                                }else if($request->input('observacion_asig_dosicontTransUnic'.$request->id_dosicontrolcontdosisedes[$i])[$x] == 4){
                                    $updatedosicontrol = Dosicontrolcontdosisede::join('dosimetros', 'dosicontrolcontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
                                    ->where('dosicontrolcontdosisedes.id_dosicontrolcontdosisedes', '=', $request->id_dosicontrolcontdosisedes[$i])
                                    ->update([
                                        'dosicontrolcontdosisedes.DNL'              => 'TRUE',
                                        'dosimetros.estado_dosimetro'               => 'DAÑADO',
                                        'dosimetros.uso_dosimetro'                  => ''
                                    ]);
                                }
                            }
                        }else{
                            $obsdosicont= new Obsreventrada();
                            $obsdosicont->dosicontrol_id            = $request->id_dosicontrolcontdosisedes[$i];
                            $obsdosicont->contratodosimetria_id     = $request->contratodosimetria;
                            $obsdosicont->novcontdosisededepto_id   = $request->novcontdosisededepto;
                            $obsdosicont->observacion_id            = empty($request->input('observacion_asig_dosicontTransUnic'.$request->id_dosicontrolcontdosisedes[$i])[$x]) ? null : $request->input('observacion_asig_dosicontTransUnic'.$request->id_dosicontrolcontdosisedes[$i])[$x];
                            $obsdosicont->nota_obs9                 = $obsdosicont->observacion_id == 9 ? mb_strtoupper($request->input('obsAddCont'.$request->id_dosicontrolcontdosisedes[$i])) : null;
                            $obsdosicont->mes_asignacion            = $request->mes_asignacion;
                            $obsdosicont->save();
    
                            if($request->input('observacion_asig_dosicontTransUnic'.$request->id_dosicontrolcontdosisedes[$i])[$x] == 3){
                                $updatedosicontrol = Dosicontrolcontdosisede::join('dosimetros', 'dosicontrolcontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
                                ->where('dosicontrolcontdosisedes.id_dosicontrolcontdosisedes', '=', $request->id_dosicontrolcontdosisedes[$i])
                                ->update([
                                    'dosicontrolcontdosisedes.nota2'            => 'TRUE',
                                    'dosimetros.estado_dosimetro'               => 'PERDIDO',
                                    'dosimetros.uso_dosimetro'                  => ''
                                ]);
                                
                            }else if($request->input('observacion_asig_dosicontTransUnic'.$request->id_dosicontrolcontdosisedes[$i])[$x] == 4){
                                $updatedosicontrol = Dosicontrolcontdosisede::join('dosimetros', 'dosicontrolcontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
                                ->where('dosicontrolcontdosisedes.id_dosicontrolcontdosisedes', '=', $request->id_dosicontrolcontdosisedes[$i])
                                ->update([
                                    'dosicontrolcontdosisedes.DNL'              => 'TRUE',
                                    'dosimetros.estado_dosimetro'               => 'DAÑADO',
                                    'dosimetros.uso_dosimetro'                  => ''
                                ]);
                            }  
                        }
                    }
                }
            };
        }
        if(!empty($request->id_trabajadordosimetro)){
            for($i=0; $i<count($request->id_trabajadordosimetro); $i++){
                if(!empty($request->input('observacion_asig'.$request->id_trabajadordosimetro[$i]))){
                    $longitudIdtrabjdosi = count($request->input('observacion_asig'.$request->id_trabajadordosimetro[$i]));
                    for($x=0; $x < $longitudIdtrabjdosi; $x++){
                        $obsdosi= new Obsreventrada();
                        $obsdosi->trabajcontdosimetro_id    = $request->id_trabajadordosimetro[$i];
                        $obsdosi->contratodosimetriasede_id = $request->contratodosimetriasede;
                        $obsdosi->contdosisededepto_id      = $request->contdosisededepto;
                        $obsdosi->novcontdosisededepto_id   = $request->novcontdosisededepto;
                        $obsdosi->observacion_id            = empty($request->input('observacion_asig'.$request->id_trabajadordosimetro[$i])[$x]) ? null : $request->input('observacion_asig'.$request->id_trabajadordosimetro[$i])[$x];
                        $obsdosi->nota_obs9                 = $obsdosi->observacion_id == 9 ? mb_strtoupper($request->input('obsAddTrab'.$request->id_trabajadordosimetro[$i])) : null;
                        $obsdosi->mes_asignacion            = $request->mes_asignacion;
                        $obsdosi->save();
                        if($request->input('observacion_asig'.$request->id_trabajadordosimetro[$i])[$x] == 3){
                            $updatetrabajadordosim = Trabajadordosimetro::join('dosimetros', 'trabajadordosimetros.dosimetro_id', '=', 'dosimetros.id_dosimetro')
                            ->where('trabajadordosimetros.id_trabajadordosimetro', '=', $request->id_trabajadordosimetro[$i])
                            ->update([
                                'trabajadordosimetros.nota2'            => 'TRUE',
                                'dosimetros.estado_dosimetro'           => 'PERDIDO',
                                'dosimetros.uso_dosimetro'              => ''
                            ]);
                        }else if($request->input('observacion_asig'.$request->id_trabajadordosimetro[$i])[$x] == 4){
                            $updatetrabajadordosim = Trabajadordosimetro::join('dosimetros', 'trabajadordosimetros.dosimetro_id', '=', 'dosimetros.id_dosimetro')
                            ->where('trabajadordosimetros.id_trabajadordosimetro', '=', $request->id_trabajadordosimetro[$i])
                            ->update([
                                'trabajadordosimetros.DNL'              => 'TRUE',
                                'dosimetros.estado_dosimetro'           => 'DAÑADO',
                                'dosimetros.uso_dosimetro'              => ''
                            ]);
                        }
                    }
                }
            }
        }
        if(!empty($request->id_dosiareacontdosisedes)){
            for($i=0; $i<count($request->id_dosiareacontdosisedes); $i++){
                if(!empty($request->input('observacion_asig_dosiarea'.$request->id_dosiareacontdosisedes[$i]))){
                    $longitudIdAreadosi = count($request->input('observacion_asig_dosiarea'.$request->id_dosiareacontdosisedes[$i]));
                    for($x=0; $x < $longitudIdAreadosi; $x++){
                        $obsdosi= new Obsreventrada();
                        $obsdosi->dosiareacontdosimetro_id  = $request->id_dosiareacontdosisedes[$i];
                        $obsdosi->contratodosimetriasede_id = $request->contratodosimetriasede;
                        $obsdosi->contdosisededepto_id      = $request->contdosisededepto;
                        $obsdosi->novcontdosisededepto_id   = $request->novcontdosisededepto;
                        $obsdosi->observacion_id            = empty($request->input('observacion_asig_dosiarea'.$request->id_dosiareacontdosisedes[$i])[$x]) ? null : $request->input('observacion_asig_dosiarea'.$request->id_dosiareacontdosisedes[$i])[$x];
                        $obsdosi->nota_obs9                 = $obsdosi->observacion_id == 9 ? mb_strtoupper($request->input('obsAddArea'.$request->id_dosiareacontdosisedes[$i])) : null;
                        $obsdosi->mes_asignacion            = $request->mes_asignacion;
                        $obsdosi->save();
                        if($request->input('observacion_asig_dosiarea'.$request->id_dosiareacontdosisedes[$i])[$x] == 3){
                            $updateareadosi = Dosiareacontdosisede::join('dosimetros', 'dosiareacontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
                            ->where('dosiareacontdosisedes.id_dosiareacontdosisedes', '=', $request->id_dosiareacontdosisedes[$i])
                            ->update([
                                'dosiareacontdosisedes.nota2'            => 'TRUE',
                                'dosimetros.estado_dosimetro'            => 'PERDIDO',
                                'dosimetros.uso_dosimetro'               => ''
                            ]);

                        }else if($request->input('observacion_asig_dosiarea'.$request->id_dosiareacontdosisedes[$i])[$x] == 4){
                            $updateareadosi = Dosiareacontdosisede::join('dosimetros', 'dosiareacontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
                            ->where('dosiareacontdosisedes.id_dosiareacontdosisedes', '=', $request->id_dosiareacontdosisedes[$i])
                            ->update([
                                'dosiareacontdosisedes.DNL'              => 'TRUE',
                                'dosimetros.estado_dosimetro'            => 'DAÑADO',
                                'dosimetros.uso_dosimetro'               => ''
                            ]);
                        }
                    }
                }
            }
        }
        return redirect()->back()->with('crear', 'ok');
    }
    public function nuevaObservacionreventrada(Request $request){
        /* return $request; */
        $observacionNew = new Observacion;
        $observacionNew->obs = mb_strtoupper($request->obs_new);
        
        $observacionNew->save();

        return back()->with('crear', 'ok');
    }
    public function observacionesremove(Request $request){
        $removeObs = Obsreventrada::find($request->id);
        $removeObs->delete();
        return  response()->json(["mensaje"=>"borrado"]);
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
