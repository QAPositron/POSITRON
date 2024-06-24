<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Personasedes;
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
    public function destroy(Personasroles $personarol, $sede){
        
        if($personarol->role_id == 3){
            $personasede = Personasedes::where('persona_id', '=', $personarol->persona_id)
            ->where('lider_dosimetria', '=', TRUE)->get();
            if(count($personasede) == 1){
                $user = User::where('persona_id', '=', $personarol->persona_id)->get();
                $usuario = User::find($user[0]->id);
                $usuario->delete();
                $personasede = Personasedes::where('persona_id', '=', $personarol->persona_id)
                ->update(['lider_dosimetria' => NULL]);
                $personarol->delete();
            }else{
                $personasede = Personasedes::where('persona_id', '=', $personarol->persona_id)
                ->where('sede_id', '=', $sede)
                ->update(['lider_dosimetria' => NULL]);
            }
        }else{
            $personarol->delete();
        }

        /* return $personarol; */
        return back()->with('eliminado', 'ok');
    }
}
