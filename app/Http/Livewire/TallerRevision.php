<?php

namespace App\Http\Livewire;

use App\Models\Expediente;
use App\Models\TipoServicio;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TallerRevision extends Component
{
    use WithPagination;

    public $user,$sort,$direction,$cant,$es,$search,$open,$tipos,$servicio,$fecIni,$fecFin;
    public $revisando=false;
    public $expediente;
    public function mount(){
        $this->tipos=TipoServicio::all();
        $this->cant=10;
        $this->sort="id";
        $this->direction="desc"; 
        $this->search='';        
        $this->es="";
        $this->fecIni="";
        $this->fecFin="";
        $this->servicio="";
    }

    public function render()
    {
        
        $us=User::find(Auth::id());     

       // $expedientes=null;

        if($us->role(["Administrador taller"])){
            $expedientes=Expediente::
            idTaller($us->taller)
            ->placaOcertificado($this->search)            
            ->estado($this->es)
            ->tipoServicio($this->servicio)
            ->rangoFecha($this->fecIni,$this->fecFin)
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

    public function revisar(Expediente $expediente){
        $this->expediente=$expediente;
        $this->revisando=true;
    }

    public function download($ruta){   
        //emit an event with the path        
        $this->emit('startDownload',$ruta);
    }
}
