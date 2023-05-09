<?php

namespace App\Http\Livewire;

use App\Models\Material;
use App\Models\TipoMaterial;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PrestamoMateriales extends Component
{
    public $open=false;
    public $inspectores,$inspector,$stockGlp,$stockGnv,$stockChips,$ruta,$estado ,$envio ,$tiposMateriales;
    public  $articulos=[];
    public $tipoM=0;
    public $stocks=[]; 

    public function mount(){
        $this->inspectores=User::role(['inspector','supervisor'])
        ->where('id','!=',Auth::id())
        ->orderBy('name')->get();
        $this->estado=1;
        $this->tiposMateriales=TipoMaterial::all()->sortBy("descripcion");
        $this->listaStock();
    }
    public function render()
    {
        return view('livewire.prestamo-materiales');
    }

    public function listaStock(){
        $materiales=TipoMaterial::all();
        foreach($materiales as $key=>$material){
            $lista=Material::where([
                                    ['estado',3],
                                    ['idTipoMaterial',$material->id],
                                    ['idUsuario',Auth::id()],
                                    ])
                            ->get();
            $this->stocks+=[$material->descripcion=>count($lista)];
        }
    }
}
