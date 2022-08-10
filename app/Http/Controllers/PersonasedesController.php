<?php

namespace App\Http\Controllers;

use App\Models\Personasedes;
use Illuminate\Http\Request;

class PersonasedesController extends Controller
{
    //
    public function destroy(Personasedes $personasede){
        /* return $personasede; */
        $personasede->delete();
        return back()->with('eliminar_personasede', 'ok');
    }
}
