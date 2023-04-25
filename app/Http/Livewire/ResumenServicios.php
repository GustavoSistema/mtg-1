<?php

namespace App\Http\Livewire;

use App\Models\CertifiacionExpediente;
use App\Models\Certificacion;
use App\Models\TipoServicio;
use Livewire\Component;

class ResumenServicios extends Component
{
    public $servicios,$total,$mensaje,$cantServicios;

    public array $dataset = [];
    public array $labels = [];  
    public array $data = [];
    public array $colores = [];  
    public array $bordes = [];

    public function mount(){
        $this->cantServicios=Certificacion::all()->count();
        $this->total=Certificacion::sum("precio");   
        $this->cargaDatos();
        $this->formateaChart();     
    }



    public function render()
    {        
        return view('livewire.resumen-servicios');
    }

    public function formateaChart(){
        $this->mensaje='Servicios';
        //$this->labels = ['Por revisar','Observados','Desaprobados','Aprobados'];
        $this->colores= [            
            'rgba(210,220,255)',           
        ];
        $this->bordes= [            
            'rgb(96, 72, 250)',                  
        ];
        $this->dataset = [
            [
                'label' => $this->mensaje,               
                'data' =>$this->data,
                'backgroundColor'=>$this->colores,
                'borderColor'=>$this->bordes,
                'borderWidth'=>1 ,
            ],            
        ]; 
        
    }

    public function cargaDatos(){        
        /*
        {id: 'Sales',nested: {value: 1500}},
        {id: 'Purchases',nested: {value: 500}}
        */
      $tipos=TipoServicio::all();
      $data=null;

      foreach($tipos as $tipo){
        $servicios=Certificacion::tipoServicio($tipo->id)->get();
        if($servicios->count()>0){
            array_push($this->labels,$tipo->descripcion);
            $cantidad=$servicios->count();
            $monto=$servicios->sum('precio');
            array_push($this->data,["id"=>$tipo->descripcion.':  S/ '.$monto,"nested"=>["value"=>$cantidad]]);            
        }
        
      }
    }
}
