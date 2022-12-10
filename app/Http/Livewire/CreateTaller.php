<?php

namespace App\Http\Livewire;

use App\Models\Servicio;
use App\Models\Taller;
use App\Models\TipoServicio;
use Livewire\Component;

class CreateTaller extends Component
{
    public $servicios=[];
    public $tipos=[];
    public $precios=[];
    public $nombre,$direccion,$ruc,$contador;
    public $open=false; 

    
    protected $rules=[
        'nombre'=>'required|min:5|max:110',      
        'direccion'=>'required|min:5|max:110',
        'ruc'=>'required|min:11|max:11|unique:taller,ruc',
           
        //'servicios'=>'array|required',  
        //'servicios.precio'=>'numeric|required',     
        
        //'tipos'=>'array|min:1|required',
        //'tipos.*'=>'numeric|min:1',
        'precios'=>'array|min:1|required',
        //'precios.*'=>'numeric|required|min:1',         
    ]; 
    
    
    public function mount(){
        $this->cargaTipoServicios();
        $this->cargaServicios();
    }
     
    public function render()
    {
        return view('livewire.create-taller');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save(){
        //$rules=[];
        foreach($this->tipos as $key=>$item){
            if($item!=0){                             
                $this->rules+=[('precios.'.$key)=>'required|numeric|min:1',];                 
            }
        }
        /*
        if(count($rules)>0){
            $this->validate($rules); 
        }else{
            $this->validate();
        }
        */
        $this->validate(); 
        
        $taller=Taller::create([
            'nombre'=>$this->nombre,
            'direccion'=>$this->direccion,
            'ruc'=>$this->ruc,
        ]);

        $this->reset(['open','nombre','direccion','ruc']);
        $this->emitTo('talleres','render');
        $this->emit('alert','El taller se registro correctamente!');
    }

    public function cargaTipoServicios(){
        $this->servicios=TipoServicio::all();        
    }

    public function cargaServicios(){
        foreach($this->servicios as $key=>$item){
           $this->tipos[$key]=0;
           $this->precios[$key]=null;
        }
    }
    
    public function sumar(){
        foreach($this->tipos as $key=>$tipo){
            if($tipo>0){
                $this->contador++;
            }
        }
    }

    protected $messages = [
        //'precios.*.min' => 'Ingrese un precio valido', 
        'precios.*.required' => 'Ingrese un precio valido.'      
    ];


    
    /*
    public function agregaServicio(){
        $this->serv++;
        $this->emitTo('createTaller','render');
    }
    public function borraServicio(){
        $this->serv--;
        $this->emitTo('createTaller','render');
    }

    */
}
