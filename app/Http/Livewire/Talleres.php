<?php

namespace App\Http\Livewire;

use App\Models\Imagen;
use App\Models\Servicio;
use App\Models\Taller;
use Doctrine\Inflector\Rules\English\Rules;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Talleres extends Component
{
    
    public $sort,$order,$cant,$search,$direction,$editando,$taller; 
    public $serviciosTaller=[];
    

    public function mount(){
      $this->direction='desc';
      $this->sort='id';       
      $this->open=false;
    }

    protected $rules=[
      'taller.nombre'=>'required|min:5',
      'taller.direccion'=>'required|min:5',
      'taller.ruc'=>'required|min:11|max:11',
      'taller.servicios.*.estado'=> 'nullable',
      'taller.servicios.*.precio'=> 'required|numeric',
    ];

    public function render()
    {
        //$files=Imagen::where('Expediente_idExpediente','=',367)->whereIn('extension',['jpg','jpeg','png','gif','tif','tiff','bmp'])->get();
        $talleres=Taller::where('nombre','like','%'.$this->search.'%')
                        ->orWhere('ruc','like','%'.$this->search.'%')          
                        ->orderBy($this->sort,$this->direction)
                        ->paginate($this->cant);
        return view('livewire.talleres',compact('talleres'));
    }

  public function cargaServiciosTaller($id){
          $this->serviciosTaller=DB::table('servicio') 
          ->select('servicio.*', 'tiposervicio.descripcion')             
          ->join('tiposervicio', 'servicio.tipoServicio_idtipoServicio', '=', 'tiposervicio.id')
          ->where('taller_idtaller',$id)
          ->get();
  }
    

    public function edit(Taller $tal){       
          
          $this->taller=$tal;
          //$this->serviciosTaller=Servicio::where('taller_idtaller',$id)->get();
          
          $this->editando=true;          
       
    }

    public function actualizar(){
        $this->taller->save();
        foreach($this->taller->servicios as $ser){                
                $ser->save();
                if($ser->estado){

                }
        }
        $this->reset(['editando']);
        $this->emit('alert','El expediente se actualizo correctamente');

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

    protected $listeners=[];
}
