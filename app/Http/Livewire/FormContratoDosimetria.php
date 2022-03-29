<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FormContratoDosimetria extends Component
{
    public $empresa;
    public $sedes;
    public $departamentos;

    public $id_empresa;
    public $codigo;
    public $periodo_recambio;
    public $fecha_inicio;
    public $fecha_final;

    public $id_sedes;
    public $id_departamentos;
    public $dosim_cuerpo_entero;

    protected $rules = [
        'id_empresa'       => 'required',
        'codigo'           => 'required|min:5|unique:App\Models\Dosimetriacontrato,codigo_contrato,',
        'periodo_recambio' => 'required',
        'fecha_inicio'     => 'required',
        'fecha_final'      => 'required',
        'id_sedes'         => 'required'
        
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.form-contrato-dosimetria');
    }
}
