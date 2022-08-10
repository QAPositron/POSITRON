<?php

namespace App\Http\Livewire;

use App\Models\Roles;
use Livewire\Component;

class FormPersonasRoles extends Component
{
    public $nombre_rol;

    protected $rules = [
        'nombre_rol' => 'required|unique:App\Models\Roles,nombre_rol,',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save(){

        $this->validate();

        $roles = new Roles();

        $roles->nombre_rol = strtoupper($this->nombre_rol);

        $roles->save();
        return back()->with('guardar', 'ok');
    }
    public function render()
    {
        return view('livewire.form-personas-roles');
    }
}
