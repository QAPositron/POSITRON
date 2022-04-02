<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FormContratoDosimetria extends Component
{
    public $empresa;
    public $sedes;
    public $departamentos;

    /* public $id_empresa; */
    public $codigo;
    public $periodo_recambio;
    public $fecha_inicio;
    public $fecha_final;

    

    protected $rules = [
        
        'codigo'           => 'required|min:5|unique:App\Models\Dosimetriacontrato,codigo_contrato,',
        'periodo_recambio' => 'required',
        'fecha_inicio'     => 'required',
        'fecha_final'      => 'required',
        
        
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        
    }
    /* public function restablecer(){

        $this->reset(['empresa', 'sedes', 'departamentos', 'id_empresa', 'codigo', 'periodo_recambio', 'fecha_inicio','fecha_final','id_sede']);
    } */
    
   
    public function render()
    {

        return view('livewire.form-contrato-dosimetria');
    }
}
