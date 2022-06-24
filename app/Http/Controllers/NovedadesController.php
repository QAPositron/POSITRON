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
        $holdersDisponibles = Holder::where('estado_holder', '=', 'STOCK')
        ->get();
        return view('novedades.form_novedades', compact('empresasDosi', 'dosimetrosDisponibles', 'holdersDisponibles'));
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
            $especialidadArray[$especialidad->id_contdosisededepto] = $especialidad->departamentosede->nombre_departamento;
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
        /* return $request; */
        /*SELECT * FROM `contratodosimetriasededeptos` INNER JOIN trabajadordosimetros ON contratodosimetriasededeptos.id_contdosisededepto = trabajadordosimetros.contdosisededepto_id 
        INNER JOIN dosicontrolcontdosisedes ON contratodosimetriasededeptos.id_contdosisededepto = dosicontrolcontdosisedes.contdosisededepto_id 
        INNER JOIN dosimetros ON trabajadordosimetros.dosimetro_id = dosimetros.id_dosimetro 
        INNER JOIN holders ON trabajadordosimetros.holder_id = holders.id_holder 
        WHERE trabajadordosimetros.mes_asignacion = 3 AND contratodosimetriasededeptos.id_contdosisededepto = 1;*/
        /* $dosiasginadosmesactual = Contratodosimetriasededepto::join('trabajadordosimetros', 'contratodosimetriasededeptos.id_contdosisededepto', '=', 'trabajadordosimetros.contdosisededepto_id')
        ->join('dosicontrolcontdosisedes', 'contratodosimetriasededeptos.id_contdosisededepto', '=', 'dosicontrolcontdosisedes.contdosisededepto_id')
        ->join('dosimetros', 'trabajadordosimetros.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->join('holders', 'trabajadordosimetros.holder_id', '=', 'holders.id_holder')
        ->where('trabajadordosimetros.contdosisededepto_id', '=', $request->contdosisededepto_id)
        ->where('trabajadordosimetros.mes_asignacion', '=', $request->mes)
        ->get(); */
        $dosiasginadosmesactual = Trabajadordosimetro::join('trabajadors', 'trabajadordosimetros.trabajador_id', '=', 'trabajadors.id_trabajador')
        ->join('dosimetros', 'trabajadordosimetros.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->join('holders', 'trabajadordosimetros.holder_id', '=', 'holders.id_holder')
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
        $trabajadores = Trabajador::where('empresa_id', '=', $request->id_empresa)
        ->select('id_trabajador','primer_nombre_trabajador', 'segundo_nombre_trabajador', 'primer_apellido_trabajador', 'segundo_apellido_trabajador')
        ->get();
        return response()->json($trabajadores);
        
    } 
    /* public function dosimetrosdisponibles(Request $request){

    } */
    public function savecambiocantdosim(Request $request){
        
        /* echo $request; */
        return $request;
        
            /* foreach($request as $req){
                if($req->name['id_trabajador_asig'] != ' '){

                    $newasignacionDosimetro = new Trabajadordosimetro(); 

                    $newasignacionDosimetro->contratodosimetriasede_id = $req->id_contratodosimetriasede;
                    $newasignacionDosimetro->contdosisededepto_id      = $req->id_contdosisededepto;
                    $newasignacionDosimetro->mes_asignacion            = $req->mes;

                    if($req->name == 'id_trabajador_asig'){
                        $newasignacionDosimetro->trabajador_id         = $req->value;
                    }
                    if($req->name == 'id_ubicacion_asig'){
                        $newasignacionDosimetro->ubicacion             = $req->value;
                    }
                    if($req->name == 'id_dosimetro_asig'){
                        $newasignacionDosimetro->dosimetro_id          = $req->value;
                    }
                    if($req->name == 'id_holder_asig'){
                        $newasignacionDosimetro->holder_id             = $req->value;
                    }
                    if($req->name == 'ocupacion_asig'){
                        $newasignacionDosimetro->ocupacion             = $req->value;
                    }
                    $newasignacionDosimetro->save();
                }
                
                return $newasignacionDosimetro;
            }    */



        /* $mesantcantdosimetrosasignados = Mesescontdosisedeptos::where('contdosisededepto_id', '=', $request->contdosisededepto_id)
        ->where('mes_asignacion', '=', $request->mesacambiar)
        ->latest()->first();

        if(empty($mesantcantdosimetrosasignados)){    
            
            $request->validate([
            'mesacambiar'                 => 'required',
            'contdosisededepto_id'        => 'required',              
            ]);
            $meschangecantdosim = new Mesescontdosisedeptos();

            $meschangecantdosim->contdosisededepto_id       = $request->contdosisededepto_id;
            $meschangecantdosim->mes_asignacion             = $request->mesacambiar;
            $meschangecantdosim->dosi_control               = $request->num_dosi_control_contrato_sede;
            $meschangecantdosim->dosi_torax                 = $request->num_dosi_torax_contrato_sede;
            $meschangecantdosim->dosi_area                  = $request->num_dosi_area_contrato_sede;
            $meschangecantdosim->dosi_caso                  = $request->num_dosi_caso_contrato_sede;
            $meschangecantdosim->dosi_cristalino            = $request->num_dosi_cristalino_contrato_sede;
            $meschangecantdosim->dosi_muñeca                = $request->num_dosi_muneca_contrato_sede;
            $meschangecantdosim->dosi_dedo                  = $request->num_dosi_dedo_contrato_sede;
            $meschangecantdosim->save();
            
            return redirect()->route('novedadesdosim.create')->with('guardar', 'ok');
            
        }else{
            
            $mescantdosiasig = Mesescontdosisedeptos::find($mesantcantdosimetrosasignados->id_mescontdosisededepto);
           
            $mescantdosiasig->dosi_control    = $request->num_dosi_control_contrato_sede;
            $mescantdosiasig->dosi_torax      = $request->num_dosi_torax_contrato_sede;
            $mescantdosiasig->dosi_area       = $request->num_dosi_area_contrato_sede;
            $mescantdosiasig->dosi_caso       = $request->num_dosi_caso_contrato_sede;
            $mescantdosiasig->dosi_cristalino = $request->num_dosi_cristalino_contrato_sede;
            $mescantdosiasig->dosi_muñeca     = $request->num_dosi_muneca_contrato_sede; 
            $mescantdosiasig->dosi_dedo       = $request->num_dosi_dedo_contrato_sede;
    
            $mescantdosiasig->save();

            return redirect()->back();
        } */


       
        
    }
}
