<?php

namespace App\Http\Livewire;

use App\Models\Perfiles;
use App\Models\Persona;
use App\Models\Personasedes;
use App\Models\Personasperfiles;
use App\Models\Personasroles;
use Livewire\Component;

class SearchPersonasComponent extends Component
{
    public $search;
    public function render()
    {
        $persona = Persona::where('primer_nombre_persona', 'like', '%' . $this->search . '%')
        ->orWhere('segundo_nombre_persona','like', '%' . $this->search . '%')
        ->orWhere('primer_apellido_persona', 'like', '%' . $this->search . '%')
        ->orWhere('segundo_apellido_persona', 'like', '%' . $this->search . '%')
        ->orWhere('cedula_persona', 'like', '%' . $this->search . '%')
        ->orWhere('correo_persona', 'like', '%' . $this->search . '%')
        ->orWhere('telefono_persona','like', '%' . $this->search . '%')
        ->get();
        $personasedes = Personasedes::join('sedes', 'personasedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->where('empresas.nombre_empresa', 'like', '%' . $this->search . '%')
        ->where('sedes.nombre_sede', 'like', '%' . $this->search . '%')
        ->get();
        
        $personasperfiles = Personasperfiles::join('perfiles', 'personasperfiles.perfil_id', '=', 'perfiles.id_perfil')
        ->where('perfiles.nombre_perfil', 'like', '%' . $this->search . '%')
        ->get();

        $personasroles = Personasroles::all(); 

        return view('livewire.search-personas-component', compact('persona', 'personasedes', 'personasperfiles', 'personasroles'));
       
    }
}
