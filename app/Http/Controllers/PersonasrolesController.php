<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Personasroles;
use App\Models\User;
use Illuminate\Http\Request;

class PersonasrolesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
     //
    public function destroy(Personasroles $personarol){
        if($personarol->role_id == 3){
            $user = User::where('persona_id', '=', $personarol->persona_id)->get();
            $usuario = User::find($user[0]->id);
            $usuario->delete();
            $personasede = Persona::where('id_persona', '=', $personarol->persona_id)
            ->update(['lider_dosimetria' => NULL ]);
        }
        $personarol->delete();

        /* return $personarol; */
        return back()->with('eliminado', 'ok');
    }
}
