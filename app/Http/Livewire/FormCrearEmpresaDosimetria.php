<?php

namespace App\Http\Livewire;

use App\Models\ContratosDosimetriaEmpresa;
use Livewire\Component;

class FormCrearEmpresaDosimetria extends Component
{
    public $empresas;
    
    public $empresa;
    public $numtotal_dosi_cuerpo_entero;
    public $numtotal_dosi_control;
    public $numtotal_dosi_ambiental;
    public $numtotal_dosi_ezclip;
    
    protected $rules = [

        'empresa' => 'required|unique:App\Models\ContratosDosimetriaEmpresa,empresa_id,',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveEmpresa(){

        $this->validate();

        $empresaDosi = new ContratosDosimetriaEmpresa();
        $empresaDosi->empresa_id                  = $this->empresa;
        $empresaDosi->numtotal_dosi_cuerpo_entero = $this->numtotal_dosi_cuerpo_entero  = 0;
        $empresaDosi->numtotal_dosi_control       = $this->numtotal_dosi_control        = 0;
        $empresaDosi->numtotal_dosi_ambiental     = $this->numtotal_dosi_ambiental      = 0;
        $empresaDosi->numtotal_dosi_ezclip        = $this->numtotal_dosi_ezclip         = 0;
        $empresaDosi->save();

        redirect()->route('empresasdosi.create');
        $this->emit('alert', 'LA EMPRESA SE GUARDÓ EN DOSIMETRÍA EXITOSAMENTE!!');

        return $this->reset(['empresa', 'numtotal_dosi_cuerpo_entero', 'numtotal_dosi_control', 'numtotal_dosi_ambiental', 'numtotal_dosi_ezclip']);
    }
    
    public function render()
    {
        return view('livewire.form-crear-empresa-dosimetria');
    }
}
