<?php

namespace App\Http\Livewire;

use App\Models\Material;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class Arreglando extends Component
{
    use WithPagination;
    
    public $formatos,$recortados,$rec;

    protected $listernes=["seleccionaFormatos"];

    public function mount(){        
        $formatos=Material::where([
            ["idTipoMaterial",1],
            ["estado",1]
        ])
        ->orderBy('numSerie','asc')->get();
        $this->formatos= $formatos;
    }

    public function render()
    {
        
        return view('livewire.arreglando');
    }


    
    public function seleccionaFormatos(){                      
        $nuevos=Material::where([
            ["idTipoMaterial",1],
            ["estado",1]
        ])
        ->orderBy('numSerie','asc')
        ->Paginate(50); 

        $this->recortados=$nuevos->all(); 

        $this->emitTo("arreglando","render");        

    }

    public function calculaCorrelativos(){
        $this->encuentraCorte($this->recortados);
    }

    public function encuentraCorte($arreglo){
        $inicio=$arreglo[0]["numSerie"];
        $final=$arreglo[0]["numSerie"];
        $nuevos=[];
        foreach($this->recortados as $key=>$rec){
            if($key+1 < count($this->recortados) ){
                if($this->recortados[$key+1]["numSerie"] - $rec["numSerie"]==1){
                    $final=$this->recortados[$key+1]["numSerie"];
                }else{
                    array_push($nuevos,["inicio"=>$inicio,"final"=>$final]);
                    $inicio=$this->recortados[$key+1]["numSerie"];
                    $final=$this->recortados[$key+1]["numSerie"];
                    
                }
            }else{
                $final=$this->recortados[$key]["numSerie"];
                array_push($nuevos,["inicio"=>$inicio,"final"=>$final]);
            }
        }

        $this->emit("minAlert",["titulo"=>"Buen Trabajo!","mensaje"=>json_encode($nuevos),"icono"=>"success",]);
        
    }

        
}
