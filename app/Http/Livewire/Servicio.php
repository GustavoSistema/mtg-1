<?php

namespace App\Http\Livewire;

use App\Models\Servicio as ModelServicio;
use App\Models\Taller;
use App\Models\vehiculo;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Servicio extends Component
{

    //Definiendo Variables de vehiculo
    public $placa,$categoria,$marca,$modelo,$version,$anioFab,$numSerie,$numMotor,
    $cilindros,$cilindrada,$combustible,$ejes,$ruedas,$asientos,$pasajeros,
    $largo,$ancho,$altura,$color,$pesoNeto,$pesoBruto,$cargaUtil;

    //Definiendo Variables de equipos
    public $tipoEquipo,$equipoSerie,$equipoMarca,$equipoModelo,$equipoCapacidad;
    public $equipos=[];

    //Variables del servicio
    public $talleres,$servicios,$serv,$taller,$ruta,$open;

    


    protected $rules=[
                    "taller"=>"required|numeric|min:1",
                    "serv"=>"required|numeric|min:1",
                    "placa"=>"required|min:6",
                    "categoria"=>"required|min:2",
                    "marca"=>"required|min:2",
                    "modelo"=>"required|min:2",
                    "version"=>"required|min:2", 
                    "anioFab"=>"required|numeric|min:1900",                  
                    "numSerie"=>"required|min:2",
                    "numMotor"=>"required|min:2",
                    "cilindros"=>"required|numeric|min:1",
                    "cilindrada"=>"required|numeric|min:1",
                    "combustible"=>"required|min:2", 
                    "ejes"=>"required|numeric|min:1",   
                    "ruedas"=>"required|numeric|min:1",    
                    "asientos"=>"required|numeric|min:1",      
                    "pasajeros"=>"required|numeric|min:1",   
                    "largo"=>"required|numeric",   
                    "ancho"=>"required|numeric",
                    "altura"=>"required|numeric",
                    "color"=>"required|min:2",
                    "pesoNeto"=>"required|numeric",
                    "pesoBruto"=>"required|numeric",
                    "cargaUtil"=>"required|numeric",
                    ];

    public function mount(){
        //$this->servicios=ModelServicio::make();
        $this->talleres=Taller::all();
        $this->taller=Taller::make();
        $this->open=false;
    }
    public function render()
    {
        return view('livewire.servicio');
    }

    public function updatedTaller($val){
        $this->servicios=ModelServicio::where("taller_idtaller",$val)->get();
        $this->reset(["serv"]);
    }
    


    public function guardaVehiculo(){
        $this->validate();
        $vehiculo=vehiculo::create([            
                                    "placa"=>strtoupper($this->placa),
                                    "categoria"=>strtoupper($this->categoria),
                                    "marca"=>strtoupper($this->marca),
                                    "modelo"=>strtoupper($this->modelo),
                                    "version"=>strtoupper($this->version),
                                    "anioFab"=>$this->anioFab,
                                    "numSerie"=>strtoupper($this->numSerie),
                                    "numMotor"=>strtoupper($this->numMotor),
                                    "cilindros"=>$this->cilindros,
                                    "cilindrada"=>$this->cilindrada,
                                    "combustible"=>strtoupper($this->combustible),
                                    "ejes"=>$this->ejes,
                                    "ruedas"=>$this->ruedas,
                                    "asientos"=>$this->asientos,
                                    "pasajeros"=>$this->pasajeros,
                                    "largo"=>$this->largo,
                                    "ancho"=>$this->ancho,
                                    "altura"=>$this->altura,
                                    "color"=>strtoupper($this->color),
                                    "pesoNeto"=>$this->pesoNeto,
                                    "pesoBruto"=>$this->pesoBruto,  
                                    "cargaUtil"=>$this->cargaUtil,          
                                    ]);
        //$this->emit("alert","El vehículo con placa ".$vehiculo->placa." se registro correctamente.");
        $this->ruta=route('certificado', ['id' => $vehiculo->id]);
        $this->emit('alert','El vehículo con placa '.$vehiculo->placa.' se registro correctamente.');

    }

    public function enviar($id){
        $veh=vehiculo::find($id);
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha=date('d').' días del mes de '.$meses[date('m')-1].' del '.date('Y').'.';               
        $data=[
        "fecha"=>$fecha,
        "empresa"=>"MOTORGAS COMPANY S.A.",
        "carro"=>$veh,        
        ];                 
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('anualGnv',$data);        
        return $pdf->stream($id.'-'.date('d-m-Y').'-cargo.pdf');
    }


}
