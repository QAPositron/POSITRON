<?php

namespace App\Http\Livewire;

use App\Models\ContratosDosimetriaEmpresa;
use Livewire\Component;

class FormCrearEmpresaDosimetria extends Component
{
    public $empresas; 
    
    public $empresa;
     
    public $numtotal_dosi_torax;
    public $numtotal_dosi_cristalino;
    public $numtotal_dosi_dedo;
    public $numtotal_dosi_muñeca;
    public $numtotal_dosi_control_torax;
    public $numtotal_dosi_control_cristalino;
    public $numtotal_dosi_control_dedo;
    public $numtotal_dosi_ambiental;
    public $numtotal_dosi_caso;
    
    protected $rules = [

        'empresa' => 'required|unique:App\Models\ContratosDosimetriaEmpresa,empresa_id,',
         
    ];

    protected $messages =[
        'empresa.contactodosi' => 'PRIMERO DEBE ASIGNAR UN CONTACTO COMO LÍDER DOSIMETRÍA ANTES DE GUARDAR LA EMPRESA',
    ]; 

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
 
    public function saveEmpresa(){

        $this->validate();

        $empresaDosi = new ContratosDosimetriaEmpresa();
        $empresaDosi->empresa_id                       = $this->empresa;
        $empresaDosi->nombre_empresa                   = $empresaDosi->empresa->nombre_empresa;
        $empresaDosi->num_iden_empresa                 = $empresaDosi->empresa->num_iden_empresa;
        $empresaDosi->numtotal_dosi_torax              = $this->numtotal_dosi_torax          = 0;
        $empresaDosi->numtotal_dosi_cristalino         = $this->numtotal_dosi_cristalino     = 0;
        $empresaDosi->numtotal_dosi_dedo               = $this->numtotal_dosi_dedo           = 0;
        $empresaDosi->numtotal_dosi_muñeca             = $this->numtotal_dosi_muñeca         = 0;
        $empresaDosi->numtotal_dosi_control_torax      = $this->numtotal_dosi_control_torax  = 0;
        $empresaDosi->numtotal_dosi_control_cristalino = $this->numtotal_dosi_control_cristalino = 0;
        $empresaDosi->numtotal_dosi_control_dedo       = $this->numtotal_dosi_control_dedo   = 0;
        $empresaDosi->numtotal_dosi_ambiental          = $this->numtotal_dosi_ambiental      = 0;
        $empresaDosi->numtotal_dosi_caso               = $this->numtotal_dosi_caso           = 0;

        $empresaDosi->save();

        redirect()->route('empresasdosi.create')->with('crear', 'ok');

        return $this->reset(['empresa', 'numtotal_dosi_torax', 'numtotal_dosi_cristalino', 'numtotal_dosi_dedo', 'numtotal_dosi_muñeca', 'numtotal_dosi_control_torax', 'numtotal_dosi_control_cristalino', 'numtotal_dosi_control_dedo', 'numtotal_dosi_ambiental', 'numtotal_dosi_caso']);
    }
     
    public function render()
    {
        return view('livewire.form-crear-empresa-dosimetria');
    }
}
