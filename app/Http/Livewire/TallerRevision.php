<?php

namespace App\Http\Livewire;

use App\Models\Expediente;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TallerRevision extends Component
{
    use WithPagination;

    public $user,$sort,$direction,$cant,$es,$search,$open;

    public function mount(){
        $this->sort="id";
        $this->direction="desc"; 
    }

    public function render()
    {
        
        $us=User::find(Auth::id());     

        $expedientes=null;

        if($us->role(["Administrador taller"])){
            $expedientes=Expediente::where
            ([
                ["idTaller",$us->taller],
                ["estado","like","%".$this->es."%"],
                ["placa","like","%".$this->search."%"]
            ])
            ->orderBy($this->sort,$this->direction)
            ->paginate($this->cant);
        }
        
        return view('livewire.taller-revision',compact("expedientes"));
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
}
