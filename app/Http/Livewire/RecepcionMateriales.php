<?php

namespace App\Http\Livewire;

use App\Models\Salida;
use App\Models\TipoMaterial;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RecepcionMateriales extends Component
{
    public $recepcion,$materiales;
    public $open=false;
    public function render()
    {
        $recepciones=Salida::where('idUsuarioAsignado',Auth::id())
                        ->orderBy("created_at","desc")
                        ->get();
        return view('livewire.recepcion-materiales',compact("recepciones"));
    }

    public function recepcionar(Salida $salida){
        if($salida->id!=null){
         $this->recepcion=$salida;
         $this->materiales=$this->cuentaMateriales($salida->materiales);
        }
        $this->open=true;
    }

    public function cuentaMateriales($materiales){
        $end=[];
        $tipos=TipoMaterial::All();    
        $aux=$materiales->toArray();       
        $mat=array_column($aux, 'idTipoMaterial');        
        $conteo=array_count_values($mat);        
        foreach($tipos as $tipo){
            if(isset($conteo[$tipo->id])){
                array_push($end,array("tipo"=>$tipo->descripcion,"cantidad"=>$conteo[$tipo->id]));
            }
        }        
        return $end;        
    }

    public function termiar(){
        
    }
}
