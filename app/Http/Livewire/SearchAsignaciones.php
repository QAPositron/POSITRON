<?php

namespace App\Http\Livewire;

use App\Models\ContratosDosimetriaEmpresa;
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
                            'NOMATCH' => 'nomatch'
                        ];

    public function existDosimetro(){
        
            $this->emit('alert', 'NO EXISTE NINGUN DOSÍMETRO CON ESE CODIGO');
            $this->reset(['search', 'dosimetro']);
        
    }
    public function match($id){
        $updateMatch = Trabajadordosimetro::where('id_trabajadordosimetro', '=', $id)
        ->update([
            'revision' => 'TRUE'
        ]);
        $trabdosiasig = Trabajadordosimetro::find($id);
        $newTemptrabajdosimrev = new Temptrabajdosimrev();

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
        $newTemptrabajdosimrev->energia                   = $trabdosiasig->energi;
        $newTemptrabajdosimrev->save();
        $this->emit('alert', 'SI SE ENCUENTRA RELACIONADO ESTE DOSÍMETRO Y ADEMAS COINCIDE LA UBICACIÓN Y ESTADO');
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
        ->whereNull('trabajadordosimetros.revision')
        ->where('empresas.nombre_empresa', '=', $this->empresa)
        ->where('codigo_dosimeter', 'like', '%' . $this->search .'%')
        ->select('trabajadordosimetros.id_trabajadordosimetro', 'trabajadordosimetros.ubicacion', 'trabajadordosimetros.mes_asignacion','personas.primer_nombre_persona', 'personas.segundo_nombre_persona', 'personas.primer_apellido_persona', 'personas.segundo_apellido_persona', 'dosimetros.codigo_dosimeter', 'trabajadordosimetros.holder_id', 'holders.codigo_holder', 'dosimetriacontratos.codigo_contrato', 'sedes.nombre_sede', 'departamentosedes.nombre_departamento')
        ->get();
        $temptrabajdosimrev = Temptrabajdosimrev::all();
        $empresa = $this->empresa;
        /* $this->emit('variable',$trabajdosiasig); */
        return view('livewire.search-asignaciones', compact('trabajdosiasig', 'temptrabajdosimrev', 'empresasDosi', 'empresa'));
    }
}
    