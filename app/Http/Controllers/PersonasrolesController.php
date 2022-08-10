<?php

namespace App\Http\Controllers;

use App\Models\Personasroles;
use Illuminate\Http\Request;

class PersonasrolesController extends Controller
{
    //
    public function destroy(Personasroles $personarol){
        $personarol->delete();
        /* return $personarol; */
        return back()->with('eliminado', 'ok');
    }
}
