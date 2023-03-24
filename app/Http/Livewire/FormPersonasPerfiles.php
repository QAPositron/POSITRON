<?php

namespace App\Http\Livewire;

use App\Models\Perfiles;
use Livewire\Component;

class FormPersonasPerfiles extends Component
{
    public $nombre_perfil_laboral;

    protected $rules = [
        'nombre_perfil_laboral' => 'required|unique:App\Models\Perfiles,nombre_perfil,',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    
    public function save(){

        $this->validate();

        $perfil = new Perfiles();
        $perfil->nombre_perfil_laboral =  mb_strtoupper($this->nombre_perfil_laboral);

        $perfil->save();
        return back()->with('guardar', 'ok');
    }

    public function render()
    {
        return view('livewire.form-personas-perfiles');
    }
}
