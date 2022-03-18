<?php

namespace App\Http\Controllers;

use App\Models\Departamentosede;
use App\Models\Empresa;
use Illuminate\Http\Request;

class DepartamentosedesController extends Controller
{
    //
    public function destroydepa(Empresa $empresa, $depa){
        $departamento = Departamentosede::find($depa);
        
        $departamento->delete();
        return redirect()->route('empresas.info', $empresa->id_empresa)->with('eliminar', 'ok');
        
    }
    
}
