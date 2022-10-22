<?php

namespace App\Http\Livewire;

use App\Models\Trabajadordosimetro;
use Livewire\Component;

class InsertNewtableasig extends Component
{
    protected $listeners = ['NEWTR' => 'newtr'];

    public function newtr($id){
        $this->emit('newtr', $id);
    }

    public function render()
    {
        $trabajdosiasig = Trabajadordosimetro::join('dosimetros', 'trabajadordosimetros.dosimetro_id', '=', 'dosimetros.id_dosimetro')
        ->whereNull('trabajadordosimetros.revision')->get();
        return view('livewire.insert-newtableasig', compact('trabajdosiasig'));
    }
}
