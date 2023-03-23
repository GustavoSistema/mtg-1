<?php

namespace App\Http\Livewire;

use App\Models\Imagen;
use App\Models\Material;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection ;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Arreglando extends Component
{
    use WithFileUploads;
    use WithPagination;
    
    public $idExpediente;
    public $formatos,$recortados,$rec;
  



    public $imagenes;

    protected $rules=["imagenes"=>"required"];

    protected $listernes=["addImg"=>"agregarImagen"];

    public function mount(){        
        $formatos=Material::where([
            ["idTipoMaterial",1],
            ["estado",1]
        ])
        ->orderBy('numSerie','asc')->get();
        $this->formatos= $formatos;
        
        
    }

    public function agregarImagen(){
        //$this->imagenes->push($img);
        $this->emit("minAlert",["titulo"=>"ERROR","mensaje"=>"Debe completar los datos de equipos para poder certificar","icono"=>"error"]); 
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
        $this->encuentraSeries($this->recortados);
    }

    public function encuentraSeries($arreglo){
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
        $this->rec=$nuevos;        
    }

    public function upload(){
        $this->emit("minAlert",["titulo"=>"ERROR","mensaje"=>"Debe completar los datos de equipos para poder certificar","icono"=>"error"]); 
    }

    

      
}
