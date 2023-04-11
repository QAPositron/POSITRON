<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function search(){
        $productos = Producto::all();
        return view('productos.buscar_producto', compact('productos'));
    }
    public function create(){
        
        return view('productos.crear_producto');
    }
    public function save(Request $request){
        
        $request->validate([
            'ref_producto'           => 'required',
            'concepto_producto'      => 'required',
            'v_unitario_producto'    => 'required',
            'categoria_producto'     => 'required'
        ]);
        $producto = new Producto();

        $producto->referencia       = mb_strtoupper($request->ref_producto);
        $producto->concepto         = mb_strtoupper($request->concepto_producto);
        $producto->valor_unitario   = str_replace('.', '', $request->v_unitario_producto);
        $producto->categoria        = mb_strtoupper($request->categoria_producto);
        
        $producto->save();

        
        return redirect()->route('productos.search')->with('guardar', 'ok');
    }
    public function edit(Producto $producto){
        return view('productos.editar_producto', compact('producto'));
    }
    public function update(Request $request, Producto $producto){
        $request->validate([
            'ref_producto'           => 'required',
            'concepto_producto'      => 'required',
            'v_unitario_producto'    => 'required',
            'categoria_producto'     => 'required'
            
        ]);
        $producto->referencia       = mb_strtoupper($request->ref_producto);
        $producto->concepto         = mb_strtoupper($request->concepto_producto);
        $producto->valor_unitario   = str_replace('.', '', $request->v_unitario_producto);
        $producto->categoria        = mb_strtoupper($request->categoria_producto);
        
        $producto->save();
        return redirect()->route('productos.search')->with('actualizar', 'ok');
    }
    
    public function destroy(Producto $producto){   
        /* return $producto; */
    $producto->delete();
        return redirect()->route('productos.search')->with('eliminar', 'ok');
    }
}
