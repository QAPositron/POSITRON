<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function save(Request $request){

       /*  return $request; */

        $roles = new Roles();

        $roles->nombre_rol = strtoupper($request->nombre_rol);

        $roles->save();
        return back()->with('guardar', 'ok'); 
    }
}
