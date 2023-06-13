<?php

namespace App\Http\Livewire\Reportes;

use App\Models\ServiciosImportados;
use Livewire\Component;
use Livewire\WithPagination;

class ReporteGeneralGnv extends Component
{
    use WithPagination;

    public $sort,$direction,$cant,$search,$permiso,$fecIni='',$fecFin='',$inspectores,$ins='',$taller,$talleres;

    public $editando=false;
    

    protected $listeners=["render"];

    public function mount(){
        $this->direction='desc';
        $this->sort='id';       
        $this->cant=10;   
        $this->inspectores=ServiciosImportados::groupBy('certificador')->pluck('certificador');
        $this->talleres=ServiciosImportados::groupBy('taller')->pluck('taller');      
        //dd($this->talleres); 
    }

    public function render()
    {
        $importados=ServiciosImportados::
        where([           
            ['certificador','like','%'.$this->search.'%']
        ])
        ->taller($this->taller)
        ->certificador($this->ins)
        ->rangoFecha($this->fecIni,$this->fecFin)
        ->orderBy($this->sort,$this->direction)
        ->paginate($this->cant); 
        return view('livewire.reportes.reporte-general-gnv',compact('importados'));
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
