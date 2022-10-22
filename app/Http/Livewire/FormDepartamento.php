<?php

namespace App\Http\Livewire;

use App\Models\Departamento;
use Livewire\Component;

class FormDepartamento extends Component
{
    public $nombre_especialidad;

    protected $rules = [
        'nombre_especialidad' => 'required|unique:App\Models\Departamento,nombre_departamento,',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    
    public function save(){

        $this->validate();

        $depto = new Departamento();
        $depto->nombre_departamento = strtoupper($this->nombre_especialidad);

        $depto->save();
        return back()->with('guardar', 'ok');
    }
    public function render()
    {
        return view('livewire.form-departamento');
    }
}
