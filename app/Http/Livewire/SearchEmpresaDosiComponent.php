<?php 

namespace App\Http\Livewire;

use App\Models\ContratosDosimetriaEmpresa;
use Livewire\Component;

class SearchEmpresaDosiComponent extends Component
{

    public $search ;
    

    public function render()
    {
        /* $empresaDosi = ContratosDosimetriaEmpresa::all(); */
        $empresaDosi = ContratosDosimetriaEmpresa::where('nombre_empresa', 'like', '%' . $this->search . '%')
        ->orWhere('num_iden_empresa', 'like', '%' . $this->search . '%')
        ->get();
        return view('livewire.search-empresa-dosi-component', compact('empresaDosi'));
    }
}
