<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FormLecturaDosimetroContrato extends Component

{

    public $trabjasig;

    public $mes_asignacion;
    public $id_contratodosimetriasededepto;
    public $remaining_days_available_use;
    public $verification_required_before;
    public $verification_Date;
    public $h10_cal_dose;
    public $zeroLevel_date;
    public $measurement_date;
    public $hp3_raw_dose;
    public $hp3_background_dose;
    public $hp3_calc_dose;
    public $ezclip_raw_dose;
    public $ezclip_background_dose;
    public $ezclip_calc_dose;
    public $hp10_raw_dose;
    public $hp10_background_dose;
    public $hp10_calc_dose;
    public $hp007_raw_dose;
    public $hp007_background_dose;
    public $hp007_calc_dose;
    public $nota1;
    public $nota2;
    public $nota3;
    public $nota4;
    public $nota5;

    protected $rules = [

        'nota1' =>'required',
        /* 'nota1' => 'required|unique:App\Models\ContratosDosimetriaEmpresa,empresa_id,', */
        
    ];
    protected $listeners = ['bloquearCampos($nota2)' => 'bloquear'];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveFormDosimcontrato(){
        $this->validate();
    }

    public function bloquear($nota2){
        
        if($nota2 == 'TRUE'){
            $this->emit('campos', $this->nota2 = $nota2);

        }
    
    }

    public function render()
    {
        return view('livewire.form-lectura-dosimetro-contrato');
    }
}
