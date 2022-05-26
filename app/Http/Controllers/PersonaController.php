<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonaController extends Controller
{
    //
    public function search(){

        return view('persona.buscar_persona');
    }


    public function create(){

    }
}
