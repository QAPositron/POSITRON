<?php

namespace App\Http\Controllers;

use App\Models\Departamentosede;
use App\Models\Empresa;
use Illuminate\Http\Request;

class DepartamentosedeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function destroydepa(Empresa $empresa, $depa){
        $departamento = Departamentosede::find($depa);
        
        $departamento->delete();
        return redirect()->route('empresas.info', $empresa->id_empresa)->with('eliminar', 'ok');
        
    }
}
