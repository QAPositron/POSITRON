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
       /*  return $request; */
       /*  $dosiasginadosmesactual = Trabajadordosimetro::join('trabajadors', 'trabajadordosimetros.trabajador_id', '=', 'trabajadors.id_trabajador')
        ->join('dosimetros', 'trabajadordosimetros.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->LEFTjoin('holders', 'trabajadordosimetros.holder_id', '=', 'holders.id_holder')
        ->where('contdosisededepto_id', '=', $request->contdosisededepto_id)
        ->where('mes_asignacion', '=', $request->mes)
        ->get();*/
        $dosiasginadosmesactual = Trabajadordosimetro::join('trabajadors', 'trabajadordosimetros.trabajador_id', '=', 'trabajadors.id_trabajador')
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
        $trabajadores = Trabajador::where('empresa_id', '=', $request->id_empresa)
        ->select('id_trabajador','primer_nombre_trabajador', 'segundo_nombre_trabajador', 'primer_apellido_trabajador', 'segundo_apellido_trabajador')
        ->get();
        return response()->json($trabajadores);
        
    } 
   
    public function savecambiocantdosim(Request $request){

        for($i=0; $i<count($request->id_trabajador_asig); $i++){

            $newasignacionDosimetro = new Trabajadordosimetro();
    
            $newasignacionDosimetro->contratodosimetriasede_id = $request->id_contratodosimetriasede;
            $newasignacionDosimetro->trabajador_id             = $request->id_trabajador_asig[$i];
            $newasignacionDosimetro->dosimetro_id              = $request->id_dosimetro_asig[$i];
            $newasignacionDosimetro->holder_id                 = $request->id_holder_asig[$i];
            $newasignacionDosimetro->contdosisededepto_id      = $request->id_contdosisededepto;
            $newasignacionDosimetro->mes_asignacion            = $request->mestrabj_asig;
            $newasignacionDosimetro->dosimetro_uso             = 'TRUE';
            /*$newasignacionDosimetro->primer_dia_uso
            $newasignacionDosimetro->ultimo_dia_uso 
            $newasignacionDosimetro->fecha_dosim_enviado */
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

        } 
       
        return back()->with('guardar', 'ok');
        /*return $request;*/
    }
    public function savemesiguientecambiocantdosim(Request $request){
       
        for($i=0; $i<count($request->id_trabajador_asig); $i++){
            $newasignacion = new Trabajadordosimetro();
    
            $newasignacion->contratodosimetriasede_id = $request->contratodosimetriasede;
            $newasignacion->trabajador_id             = $request->id_trabajador_asig[$i];
            $newasignacion->dosimetro_id              = $request->id_dosimetro_asig[$i];
            $newasignacion->holder_id                 = $request->id_holder_asig[$i];
            $newasignacion->contdosisededepto_id      = $request->contdosisededepto;
            $newasignacion->mes_asignacion            = $request->mes_asig_siguiente;
            $newasignacion->dosimetro_uso             = 'TRUE';
            /*$newasignacionDosimetro->primer_dia_uso
            $newasignacionDosimetro->ultimo_dia_uso 
            $newasignacionDosimetro->fecha_dosim_enviado */
            $newasignacion->ocupacion                 = $request->ocupacion_asig[$i];
            $newasignacion->ubicacion                 = $request->id_ubicacion_asig[$i];
            $newasignacion->energia                   = 'F';
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
        }
        for($i=0; $i<count($request->id_dosimetro_asigdosimControl); $i++){
            $newasignacionAntiguaControl = new Dosicontrolcontdosisede();

            $newasignacionAntiguaControl->dosimetro_id              = $request->id_dosimetro_asigdosimControl[$i];
            $newasignacionAntiguaControl->contratodosimetriasede_id = $request->contratodosimetriasede;
            $newasignacionAntiguaControl->contdosisededepto_id      = $request->contdosisededepto;
            $newasignacionAntiguaControl->mes_asignacion            = $request->mes_asig_siguiente;
            $newasignacionAntiguaControl->dosimetro_uso             = 'TRUE';
            /* $newasignacionAntiguaControl->primer_dia_uso            = $request->;
            $newasignacionAntiguaControl->ultimo_dia_uso            = $request->;
            $newasignacionAntiguaControl->fecha_dosim_enviado       = $request->; */
            $newasignacionAntiguaControl->ocupacion                 = $request->ocupacion_asigdosimControl[$i];
            $newasignacionAntiguaControl->energia                   = 'F';
            $newasignacionAntiguaControl->save();

            $updateDosimetros = Dosimetro::where('id_dosimetro', '=', $request->id_dosimetro_asigdosimControl[$i])
            ->update([
                'estado_dosimetro' => 'EN USO',
                'uso_dosimetro' => $request->id_ubicacion_asig[$i]  
            ]);
            $updateEstadoDosimControlmesig = Dosicontrolcontdosisede::join('dosimetros', 'dosimetro_id', '=', 'id_dosimetro')
                ->where('contdosisededepto_id', $request->contdosisededepto)
                ->where('mes_asignacion', ($request->mes_asig_siguiente)-1)
                ->update([
                    'estado_dosimetro' => 'EN LECTURA',
            ]); 
        }
        for($i=0; $i<count($request->id_trabj_asigdosim_null); $i++){
            $newasignacionAntiguaNull = new Trabajadordosimetro();

            $newasignacionAntiguaNull->contratodosimetriasede_id = $request->contratodosimetriasede;
            $newasignacionAntiguaNull->trabajador_id             = $request->id_trabj_asigdosim_null[$i];
            $newasignacionAntiguaNull->dosimetro_id              = $request->id_dosimetro_asigdosim_null[$i];
            $newasignacionAntiguaNull->holder_id                 = null;
            $newasignacionAntiguaNull->contdosisededepto_id      = $request->contdosisededepto;
            $newasignacionAntiguaNull->mes_asignacion            = $request->mes_asig_siguiente;
            $newasignacionAntiguaNull->dosimetro_uso             = 'TRUE';
            /*$newasignacionAntiguaNull->primer_dia_uso
            $newasignacionAntiguaNull->ultimo_dia_uso 
            $newasignacionAntiguaNull->fecha_dosim_enviado */
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
        }
        for($i=0; $i<count($request->id_trabj_asigdosim); $i++){
            $newasignacionAntigua = new Trabajadordosimetro();

            $newasignacionAntigua->contratodosimetriasede_id = $request->contratodosimetriasede;
            $newasignacionAntigua->trabajador_id             = $request->id_trabj_asigdosim[$i];
            $newasignacionAntigua->dosimetro_id              = $request->id_dosimetro_asigdosim[$i];
            $newasignacionAntigua->holder_id                 = $request->id_holder_asigdosim[$i];
            $newasignacionAntigua->contdosisededepto_id      = $request->contdosisededepto;
            $newasignacionAntigua->mes_asignacion            = $request->mes_asig_siguiente;
            $newasignacionAntigua->dosimetro_uso             = 'TRUE';
            /*$newasignacionAntiguaNull->primer_dia_uso
            $newasignacionAntiguaNull->ultimo_dia_uso 
            $newasignacionAntiguaNull->fecha_dosim_enviado */
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
        }   
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
        $dosiasginadosmesactual = Trabajadordosimetro::join('trabajadors', 'trabajadordosimetros.trabajador_id', '=', 'trabajadors.id_trabajador')
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
