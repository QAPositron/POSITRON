<?php

namespace App\Http\Controllers;

use App\Models\Personasperfiles;
use Illuminate\Http\Request;

class PersonasperfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function destroy(Personasperfiles $personaperfil){
        $personaperfil->delete();
        /* return $personaperfil; */
        return back()->with('eliminar', 'ok');
    }
}
