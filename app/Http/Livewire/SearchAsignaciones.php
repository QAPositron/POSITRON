<?php

namespace App\Http\Livewire;

use App\Models\ContratosDosimetriaEmpresa;
use App\Models\Dosicontrolcontdosisede;
use App\Models\Dosimetro;
use App\Models\Empresa;
use App\Models\Temptrabajdosimrev;
use App\Models\Trabajadordosimetro;
use Livewire\Component;



class SearchAsignaciones extends Component
{
    public $search;
    public $dosimetro;
    public $empresa;
    protected $listeners = ['NOEXISTE' => 'existDosimetro',
                            'MATCH' => 'match',
                            'NOMATCH' => 'nomatch',
                            'MATCHCONTROL' =>'matchcontrol',
                            'ELIMINAR' => 'eliminarevision'
                        ];

    public function existDosimetro(){
        
            $this->emit('alert', 'NO EXISTE NINGUN DOSÍMETRO CON ESE CODIGO');
            $this->reset(['search', 'dosimetro']);
        
    }
    public function match($id){
        $updateMatch = Trabajadordosimetro::where('id_trabajadordosimetro', '=', $id)
        ->update([
            'revision_salida' => 'TRUE'
        ]);
        $trabdosiasig = Trabajadordosimetro::find($id);
        $newTemptrabajdosimrev = new Temptrabajdosimrev();

        $newTemptrabajdosimrev->trabajcontdosimetro_id    = $trabdosiasig->id_trabajadordosimetro;
        $newTemptrabajdosimrev->contratodosimetriasede_id = $trabdosiasig->contratodosimetriasede_id;
        $newTemptrabajdosimrev->persona_id                = $trabdosiasig->persona_id;
        $newTemptrabajdosimrev->dosimetro_id              = $trabdosiasig->dosimetro_id;
        $newTemptrabajdosimrev->holder_id                 = $trabdosiasig->holder_id;
        $newTemptrabajdosimrev->contdosisededepto_id      = $trabdosiasig->contdosisededepto_id;
        $newTemptrabajdosimrev->mes_asignacion            = $trabdosiasig->mes_asignacion;
        $newTemptrabajdosimrev->dosimetro_uso             = $trabdosiasig->dosimetro_uso;
        $newTemptrabajdosimrev->primer_dia_uso            = $trabdosiasig->primer_dia_uso;
        $newTemptrabajdosimrev->ultimo_dia_uso            = $trabdosiasig->ultimo_dia_uso;
        $newTemptrabajdosimrev->fecha_dosim_enviado       = $trabdosiasig->fecha_dosim_enviado;
        $newTemptrabajdosimrev->fecha_dosim_recibido      = $trabdosiasig->fecha_dosim_recibido;
        $newTemptrabajdosimrev->fecha_dosim_devuelto      = $trabdosiasig->fecha_dosim_devuelto;
        $newTemptrabajdosimrev->ocupacion                 = $trabdosiasig->ocupacion;
        $newTemptrabajdosimrev->ubicacion                 = $trabdosiasig->ubicacion;
        $newTemptrabajdosimrev->energia                   = $trabdosiasig->energia;
        $newTemptrabajdosimrev->save();
        $this->emit('alert', 'SI SE ENCUENTRA RELACIONADO ESTE DOSÍMETRO Y ADEMAS COINCIDE LA UBICACIÓN Y ESTADO');
        $this->reset(['search', 'dosimetro']);
         
    }
    public function matchcontrol($id){
        $updateMatch = Dosicontrolcontdosisede::where('id_dosicontrolcontdosisedes', '=', $id)
        ->update([
            'revision_salida' => 'TRUE'
        ]);
        $dosicontrol = Dosicontrolcontdosisede::find($id);
        $newTempdosimcontrolrev = new Temptrabajdosimrev();

        $newTempdosimcontrolrev->dosicontrolcontdosisedes_id    = $dosicontrol->id_dosicontrolcontdosisedes;
        $newTempdosimcontrolrev->contratodosimetriasede_id      = $dosicontrol->contratodosimetriasede_id;
       
        $newTempdosimcontrolrev->dosimetro_id                   = $dosicontrol->dosimetro_id;
        $newTempdosimcontrolrev->holder_id                      = $dosicontrol->holder_id;
        $newTempdosimcontrolrev->contdosisededepto_id           = $dosicontrol->contdosisededepto_id;
        $newTempdosimcontrolrev->mes_asignacion                 = $dosicontrol->mes_asignacion;
        $newTempdosimcontrolrev->dosimetro_uso                  = $dosicontrol->dosimetro_uso;
        $newTempdosimcontrolrev->primer_dia_uso                 = $dosicontrol->primer_dia_uso;
        $newTempdosimcontrolrev->ultimo_dia_uso                 = $dosicontrol->ultimo_dia_uso;
        $newTempdosimcontrolrev->fecha_dosim_enviado            = $dosicontrol->fecha_dosim_enviado;
        $newTempdosimcontrolrev->fecha_dosim_recibido           = $dosicontrol->fecha_dosim_recibido;
        $newTempdosimcontrolrev->fecha_dosim_devuelto           = $dosicontrol->fecha_dosim_devuelto;
        $newTempdosimcontrolrev->ocupacion                      = $dosicontrol->ocupacion;
        $newTempdosimcontrolrev->ubicacion                      = $dosicontrol->ubicacion;
        $newTempdosimcontrolrev->energia                        = $dosicontrol->energia;
        $newTempdosimcontrolrev->save();

        $this->emit('alert', 'SI SE ENCUENTRA RELACIONADO ESTE DOSÍMETRO DE CONTROL');
        $this->reset(['search', 'dosimetro']);
        
    }
    public function nomatch(){
        
        $this->emit('alert', 'NO SE ENCUENTRA RELACIONADO ESTE DOSÍMETRO');
        $this->reset(['search', 'dosimetro']);
        
    }
    
    public function limpiar(){
        $limpiartemptrabjdosimrev = Temptrabajdosimrev::all();
        foreach($limpiartemptrabjdosimrev as $limpiartemp){

            $limpiartemp->delete();
        }
    }
    public function eliminarevision($id, $control){
        if($control == 1){
            $eliminarRevisioncontrol = Dosicontrolcontdosisede::where('id_dosicontrolcontdosisedes', '=', $id)
            ->update([
                'revision_salida' =>  NULL
            ]);
            $eliminartempdosimcontrolrev = Temptrabajdosimrev::where('trabajcontdosimetro_id', '=', $id)->delete();
            $this->emit('alert', 'SE ELIMINO LA ASIGNACION REVISADA DE TIPO CONTROL');
            $this->emit('render');
        }else{
            $eliminarRevision = Trabajadordosimetro::where('id_trabajadordosimetro', '=', $id)
            ->update([
                'revision_salida' => NULL
            ]);
            $eliminartemptrabjdosimrev = Temptrabajdosimrev::where('trabajcontdosimetro_id', '=', $id)->delete();
            $this->emit('alert', 'SE ELIMINO LA ASIGNACION REVISADA');
            $this->emit('render');
        }
    }
    public function render()
    {   
        $empresasDosi = ContratosDosimetriaEmpresa::all();
        $trabajdosiasig = Trabajadordosimetro::join('personas', 'trabajadordosimetros.persona_id', '=', 'personas.id_persona')
        ->join('dosimetros', 'trabajadordosimetros.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->leftJoin('holders', 'trabajadordosimetros.holder_id', '=', 'holders.id_holder')
        ->join('contratodosimetriasedes', 'trabajadordosimetros.contratodosimetriasede_id', '=', 'contratodosimetriasedes.id_contratodosimetriasede')
        ->join('dosimetriacontratos', 'contratodosimetriasedes.contratodosimetria_id', '=', 'dosimetriacontratos.id_contratodosimetria')
        ->join('sedes', 'contratodosimetriasedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->join('contratodosimetriasededeptos', 'trabajadordosimetros.contdosisededepto_id', '=', 'contratodosimetriasededeptos.id_contdosisededepto')
        ->join('departamentosedes', 'contratodosimetriasededeptos.departamentosede_id', '=', 'departamentosedes.id_departamentosede')
        ->join('departamentos', 'departamentosedes.departamento_id', '=', 'departamentos.id_departamento')
        ->where('empresas.nombre_empresa', '=', $this->empresa)
        ->where('dosimetros.codigo_dosimeter', 'like', '%'. $this->search .'%')
        ->whereNull('trabajadordosimetros.revision_salida')
        ->select('trabajadordosimetros.id_trabajadordosimetro', 'trabajadordosimetros.dosimetro_uso', 'trabajadordosimetros.ubicacion', 'trabajadordosimetros.mes_asignacion','personas.primer_nombre_persona', 'personas.segundo_nombre_persona', 'personas.primer_apellido_persona', 'personas.segundo_apellido_persona', 'dosimetros.codigo_dosimeter', 'trabajadordosimetros.holder_id', 'holders.codigo_holder', 'dosimetriacontratos.codigo_contrato', 'sedes.nombre_sede', 'departamentos.nombre_departamento', 'dosimetriacontratos.fecha_inicio')
        ->get();
        $dosicontrol = Dosicontrolcontdosisede::join('dosimetros', 'dosicontrolcontdosisedes.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->leftJoin('holders', 'dosicontrolcontdosisedes.holder_id', '=', 'holders.id_holder')
        ->join('contratodosimetriasedes', 'dosicontrolcontdosisedes.contratodosimetriasede_id', '=', 'contratodosimetriasedes.id_contratodosimetriasede')
        ->join('dosimetriacontratos', 'contratodosimetriasedes.contratodosimetria_id', '=', 'dosimetriacontratos.id_contratodosimetria')
        ->join('sedes', 'contratodosimetriasedes.sede_id', '=', 'sedes.id_sede')
        ->join('empresas', 'sedes.empresas_id', '=', 'empresas.id_empresa')
        ->join('contratodosimetriasededeptos', 'dosicontrolcontdosisedes.contdosisededepto_id', '=', 'contratodosimetriasededeptos.id_contdosisededepto')
        ->join('departamentosedes', 'contratodosimetriasededeptos.departamentosede_id', '=', 'departamentosedes.id_departamentosede')
        ->join('departamentos', 'departamentosedes.departamento_id', '=', 'departamentos.id_departamento')
        ->whereNull('dosicontrolcontdosisedes.revision_salida')
        ->where('empresas.nombre_empresa', '=', $this->empresa)
        ->where('codigo_dosimeter', 'like', '%' . $this->search .'%')
        ->select('dosicontrolcontdosisedes.id_dosicontrolcontdosisedes', 'dosicontrolcontdosisedes.dosimetro_uso','dosicontrolcontdosisedes.mes_asignacion', 'dosicontrolcontdosisedes.ubicacion', 'dosimetros.codigo_dosimeter', 'dosimetriacontratos.codigo_contrato', 'dosicontrolcontdosisedes.holder_id', 'holders.codigo_holder', 'sedes.nombre_sede', 'departamentos.nombre_departamento', 'dosimetriacontratos.fecha_inicio')
        ->get();
        $temptrabajdosimrev = Temptrabajdosimrev::all();
        $empresa = $this->empresa;
        $this->emit('mesesTrab', $trabajdosiasig);
        $this->emit('mesesCont', $dosicontrol);
        return view('livewire.search-asignaciones', compact('trabajdosiasig', 'dosicontrol', 'temptrabajdosimrev', 'empresasDosi', 'empresa'));
    }
}
    