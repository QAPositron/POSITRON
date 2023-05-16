<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cotizacion;
use App\Models\Empresa;
use App\Models\Producto;
use App\Models\Sede;
use Illuminate\Http\Request;

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
        return $request;
    }
}
