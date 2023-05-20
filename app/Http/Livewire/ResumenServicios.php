<?php

namespace App\Http\Livewire;

use App\Models\CertifiacionExpediente;
use App\Models\Certificacion;
use App\Models\TipoServicio;
use Carbon\Carbon;
use Livewire\Component;

class ResumenServicios extends Component
{
    public $servicios,$total,$mensaje,$cantServicios,$fecha;

    public array $dataset = [];
    public array $labels = [];  
    public array $data = [];
    public array $colores = [];  
    public array $bordes = [];

    public function mount(){       
        //$this->fecha=$this->inicioFinSemana(Carbon::now()->format('d-m-Y'));
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
      $tipos=TipoServicio::all();
      $data=null;
      $this->fecha=$this->inicioFinSemana(Carbon::now()->format('d-m-Y'));

      foreach($tipos as $tipo){
        $this->servicios=Certificacion::
            tipoServicio($tipo->id)
            ->rangoFecha($this->fecha["fechaInicio"],$this->fecha["fechaFin"])
            ->get();

        if($this->servicios->count()>0){
            array_push($this->labels,$tipo->descripcion);
            $cantidad=$this->servicios->count();
            $monto=$this->servicios->sum('precio');
            array_push($this->data,["id"=>$tipo->descripcion.':  S/ '.$monto,"nested"=>["value"=>$cantidad]]);            
        }        
      }
    }

    public function inicioFinSemana($fecha){

        $diaInicio="Monday";
        $diaFin="Sunday";
    
        $strFecha = strtotime($fecha);
    
        $fechaInicio = date('Y-m-d',strtotime('last '.$diaInicio,$strFecha));
        $fechaFin = date('Y-m-d',strtotime('next '.$diaFin,$strFecha));
    
        if(date("l",$strFecha)==$diaInicio){
            $fechaInicio= date("Y-m-d",$strFecha);
        }
        if(date("l",$strFecha)==$diaFin){
            $fechaFin= date("Y-m-d",$strFecha);
        }
        return Array("fechaInicio"=>$fechaInicio,"fechaFin"=>$fechaFin);
    }
}
