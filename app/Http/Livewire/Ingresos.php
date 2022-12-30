<?php

namespace App\Http\Livewire;

use App\Models\Ingreso;
use Livewire\Component;

class Ingresos extends Component
{
    
    public $cant,$sort,$direction,$search,$ingreso,$details;
    public $editando=false;

    
    public function mount(){
        $this->sort="id";
        $this->direction="desc";
    }

    protected $listeners=['render','delete','deleteFile'];

    

    public function render()
    {
        $ingresos=Ingreso::where('estado',1)
        ->orderBy($this->sort,$this->direction)
        ->paginate($this->cant);
        return view('livewire.ingresos',compact("ingresos"));
    }

    public function order($sort)
    {
        if($this->sort=$sort){
            if($this->direction=='desc'){
                $this->direction='asc';
            }else{
                $this->direction='desc';
            }
        }else{
            $this->sort=$sort;
            $this->direction='asc';
        }        
    }

    public function edit(Ingreso $ing){
        $this->ingreso=$ing;
        $this->details=$this->detalle($ing);
        $this->editando=true;
    }

    public function detalle($ing){
        $aux=[];
        $var="";
        $contador=0;
        if($ing->id!=null){
            
            foreach($ing->materiales as $material){
                if($material->tipo->descripcion!=$var){
                    $var=$material->tipo->descripcion;
                }
                array_push($aux,$material->tipo->descripcion);                
            }            
            $a=array_count_values($aux);
            $o=[];
            array_push($o,array("tipo"=>$var,"cantidad"=>$a));
        }

        return $a;
    }
}
