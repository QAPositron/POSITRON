<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cotizacion;
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
        
        return view('cotizaciones.crear_cotizacion');
    }
}
