<?php

namespace App\Http\Livewire;

use App\Models\Empresa; 
use App\Models\Trabajador;
use App\Models\Trabajadorsede;
use Livewire\Component;

class FormTrabajador extends Component
{
    public $nombre_empresa;
    public $id_empresa;
    public $sedes;

    public $sede;
    public $primer_nombre;
    public $segundo_nombre;
    public $primer_apellido;
    public $segundo_apellido;
    public $tipo_identificación;
    public $cédula;
    public $género;
    public $correo;
    public $teléfono;
    public $perfil_laboral;

    
    public function mount($empresa){
        
        $this->nombre_empresa = $empresa->nombre_empresa;
        $this->id_empresa     = $empresa->id_empresa;
    }

    protected $rules = [
        'id_empresa'           => 'required',
        'sede'                 => 'required',
        'primer_nombre'        => 'required|min:3',
        'primer_apellido'      => 'required|min:3',
        'segundo_apellido'     => 'required|min:3',
        'tipo_identificación'  => 'required',
        'cédula'               => 'required|min:7|unique:App\Models\Trabajador,cedula_trabajador,',
        'género'               => 'required',
        'correo'               => 'required|email|unique:App\Models\Trabajador,email_trabajador,',
        'teléfono'             => 'required|min:7',
        'perfil_laboral'       => 'required'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
     
    public function saveTrabajador(){
        
        $this->validate();

        $trabajador = new Trabajador();
        $trabajador->empresa_id                  = $this->id_empresa;
        $trabajador->primer_nombre_trabajador    = $this->primer_nombre;
        $trabajador->segundo_nombre_trabajador   = $this->segundo_nombre;
        $trabajador->primer_apellido_trabajador  = $this->primer_apellido;
        $trabajador->segundo_apellido_trabajador = $this->segundo_apellido;
        $trabajador->cedula_trabajador           = $this->cédula;
        $trabajador->tipo_iden_trabajador        = $this->tipo_identificación;
        $trabajador->genero_trabajador           = $this->género;
        $trabajador->email_trabajador            = $this->correo;
        $trabajador->telefono_trabajador         = $this->teléfono;
        $trabajador->tipo_trabajador             = $this->perfil_laboral;
        
        $trabajador->save();

        $trabajadorsede = new Trabajadorsede();
        $trabajadorsede->trabajador_id = $trabajador->id_trabajador;
        $trabajadorsede->sede_id       = $this->sede;

        $trabajadorsede->save();

        redirect()->route('empresas.info', $this->id_empresa);
        

        return $this->reset(['nombre_empresa', 'id_empresa', 'sedes', 'sede', 'primer_nombre', 
        'segundo_nombre', 'primer_apellido', 'segundo_apellido','tipo_identificación', 
        'cédula', 'género', 'correo', 'teléfono', 'perfil_laboral']);
        
    }
    public function render()
    {
        return view('livewire.form-trabajador');
    }
}
