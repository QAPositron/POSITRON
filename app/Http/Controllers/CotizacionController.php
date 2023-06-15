<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cotizacion;
use App\Models\Cotizacionobservacion;
use App\Models\Cotizacionproducto;
use App\Models\Empresa;
use App\Models\Producto;
use App\Models\Sede;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Validation\Rule;

class CotizacionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function search(){
        $cotizaciones = Cotizacion::all();
        return view('cotizaciones.buscar_cotizacion', compact('cotizaciones'));
    }
    public function create(){
        $empresas = Empresa::all();
        $productos = Producto::all();
        $codigocotiant = Cotizacion::latest()->first();
        /* return $codigocotiant; */
        return view('cotizaciones.crear_cotizacion', compact('empresas', 'productos', 'codigocotiant'));
    }
    public function selectsedes(Request $request){
        $sedes = Sede::where('empresas_id', '=', $request->empresa_id)->get();
        foreach($sedes as $sed){
            $sedesArray[$sed->id_sede] = $sed->nombre_sede;
        }
        return response()->json($sedesArray);
    }
    public function save(Request $request){
        /* return count($request->observaciones); */
        $request->validate([
            'numero_cotizacion'     => 'required|unique:cotizacions,codigo_cotizacion',
            'empresa'               => 'required',
            'sede'                  => 'required',
            'fecha_emision'         => 'required',
            'fecha_vencimiento'     => 'required',
            'periodolec_producto'   => 'required',
            'numlecturas_año'       => 'required'
        ]);
        $cotizacion = new Cotizacion();
        $cotizacion->codigo_cotizacion      = $request->numero_cotizacion;
        $cotizacion->empresa_id             = $request->empresa;
        $cotizacion->sede_id                = $request->sede;
        $cotizacion->fecha_emision          = $request->fecha_emision;
        $cotizacion->fecha_vencimiento      = $request->fecha_vencimiento;
        $cotizacion->periodoLec             = $request->periodolec_producto;
        $cotizacion->lecturas_ano           = $request->numlecturas_año;
        $cotizacion->obsq_transEnvio        = $request->obsq_servitransporteEnvio;
        $cotizacion->obsq_transRecole       = $request->obsq_servitransporteReco;
        $cotizacion->desc_cortesia          = $request->descuento_cortesia;
        $cotizacion->desc_prontopago        = $request->descuento_pronto_pago;
        $cotizacion->valorTotalSDPeriodo    = $request->totalAñoSDint_periodo;
        $cotizacion->valorTotalSDAño        = $request->totalAñoSDint_ano;
        $cotizacion->descCortesiaPeriodo    = $request->descuento_cortesiaint_periodo;
        $cotizacion->descCortesiaAño        = $request->descuento_cortesiaint_ano;
        $cotizacion->descProntopagoPeriodo  = $request->descuento_prontopagoint_periodo;
        $cotizacion->descProntoPagoAño      = $request->descuento_prontopagoint_ano;
        $cotizacion->servTransEnvioPeriodo  = $request->servtransporte_periodo;
        $cotizacion->servTransEnvioAño      = $request->servtransporteInt_ano;
        $cotizacion->servTransRecoPeriodo   = $request->servtransporteReco_periodo;
        $cotizacion->servTransRecoAño       = $request->servtransporteRecoInt_ano;
        $cotizacion->valorTotalPeriodo      = $request->totalservicioInt_periodo;
        $cotizacion->valorTotalAño          = $request->totalservicioInt_ano;
        $cotizacion->promedioDosimMes       = $request->promedioDosiMesInt;
        $cotizacion->pago_anticipado        = $request->fpago_anticipado;
        $cotizacion->pago_unmes             = $request->fpago_unmes;
        /* $cotizacion->obs                    = mb_strtoupper($request->observaciones); */

        $cotizacion->save();

        for($i=1; $i<= $request->totalProductos; $i++){

            $cotiprod = new Cotizacionproducto();
    
            $cotiprod->cotizacion_id        = $cotizacion->id_cotizacion;
            $cotiprod->producto_id          = $request->input('ref_producto'.$i);
            $cotiprod->conceptoProd         = $request->input('concepto_producto'.$i);
            $cotiprod->cantidadProd         = $request->input('cantidad_producto'.$i);
            $cotiprod->costoUndProd         = $request->input('costoUnd_producto'.$i);
            $cotiprod->ivaProd              = $request->input('iva_producto'.$i);
            $cotiprod->costoPeriodoProd     = $request->input('costoPeriodoInt_producto'.$i);
            $cotiprod->costoAñoProd         = $request->input('costoAnoInt_producto'.$i);
            $cotiprod->save();
        }
        for($i=0; $i< count($request->observaciones); $i++){
            $cotiobs = new Cotizacionobservacion();

            $cotiobs->cotizacion_id        = $cotizacion->id_cotizacion;
            $cotiobs->obs                  = mb_strtoupper($request->observaciones[$i]);

            $cotiobs->save();
        }
        return redirect()->route('cotizaciones.search')->with('guardar', 'ok');
    }
    public function pdfCotizacionDosimetria($cotizacion){
        
        $coti = Cotizacion::where('codigo_cotizacion', '=', $cotizacion)->get();
        $productos = Cotizacionproducto::where('cotizacion_id', '=', $coti[0]->id_cotizacion)->get();
        $observaciones = Cotizacionobservacion::where('cotizacion_id', '=', $coti[0]->id_cotizacion)->get();
        $pdf =  PDF::loadView('cotizaciones.cotizacionPDF_dosimetria', compact('coti','cotizacion', 'productos', 'observaciones'));
        $pdf->setPaper('A4', 'portrait');
        $n = $cotizacion;
        $codigo = str_pad($n, 5, "0", STR_PAD_LEFT);
       
        /* return $pdf->stream(); */
        return $pdf->stream("QA-COTI-DP-".$coti[0]->empresa->nombre_empresa."-".$codigo.".pdf");
    }
    public function edit($coti){
        $cotizacion  = Cotizacion::find($coti);
        $cotiproductos = Cotizacionproducto::where('cotizacion_id', '=', $cotizacion->id_cotizacion)->get();
        $cotiobservaciones = Cotizacionobservacion::where('cotizacion_id', '=', $cotizacion->id_cotizacion)->get();
        $empresas = Empresa::all();
        $productos = Producto::all();
        return view('cotizaciones.edit_cotizacion', compact('cotizacion', 'cotiproductos', 'cotiobservaciones', 'empresas', 'productos'));
    }
    public function update(Request $request, $cotizacion){
        $request->validate([
            'numero_cotizacion'     => ['required', Rule::unique('cotizacions', 'codigo_cotizacion')->ignore($cotizacion, 'id_cotizacion')],
            'empresa'               => ['required'],
            'sede'                  => ['required'],
            'fecha_emision'         => ['required'],
            'fecha_vencimiento'     => ['required']
        ]);

        $coti = Cotizacion::find($cotizacion);
        $coti->fecha_emision      = $request->fecha_emision;
        $coti->fecha_vencimiento  = $request->fecha_vencimiento;
        $coti->save();

       $cotiobs = Cotizacionobservacion::where('cotizacion_id', '=', $coti->id_cotizacion)->delete();

        for($i=0; $i< count($request->observaciones); $i++){
            $cotizacionObs = new Cotizacionobservacion();

            $cotizacionObs->cotizacion_id        = $coti->id_cotizacion;
            $cotizacionObs->obs                  = mb_strtoupper($request->observaciones[$i]);

            $cotizacionObs->save();
        }
        return redirect()->route('cotizaciones.search')->with('actualizar', 'ok');
    }
    public function destroy($cotizacion){
        $coti = Cotizacion::find($cotizacion);
        $coti->delete();
        return redirect()->route('cotizaciones.search')->with('eliminar', 'ok');
    }
}
