<?php

namespace App\Http\Livewire;

use App\Models\Certificacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListaCertificaciones extends Component
{

    public $search,$sort,$direction,$cant,$user;

    public function mount(){
        $this->user=Auth::id();
        $this->cant="10";
        $this->sort='certificacion.id';
        $this->direction="desc";
    }

    public function render()
    {
        /*
        $certificaciones=Certificacion::
            where([
            ['idInspector',Auth::id()],
            ['id','like','%'.$this->search.'%']
            ])->get();
        */        

        $certificaciones= DB::table('certificacion') 
        ->select('certificacion.*', 'vehiculo.placa','servicio.tipoServicio_idtipoServicio as tipoServicio','taller.nombre as taller','users.name as inspector')    
        ->join('users','users.id','=','certificacion.idInspector')         
        ->join('vehiculo', 'certificacion.idVehiculo', '=', 'vehiculo.id')     
        ->join('taller', 'idTaller', '=', 'taller.id')   
        ->join('servicio','certificacion.idServicio','=','servicio.id')          
        ->where([
            ['certificacion.idInspector','=',$this->user],
            ['placa','like','%'.$this->search.'%']
           ])
        
        //->orWhere($filtros2)           
        ->orderBy($this->sort,$this->direction)
        ->paginate($this->cant);
              
        return view('livewire.lista-certificaciones',compact('certificaciones'));
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


    public function generarRuta($cer){        
        $certificacion=Certificacion::find($cer);
        $ver="";
        $descargar="";
        if($certificacion){
            $tipoSer=$certificacion->Servicio->tipoServicio->id;            
            switch ($tipoSer) {
                case 1:
                    $ver= route('certificadoInicial', ['id' => $certificacion->id]);                    
                break; 
                case 2:
                    $ver= route('certificado', ['id' => $certificacion->id]);
                break;                
                default:
                    # code...
                    break;
            }
        }

        return $ver;
    }
    public function generarRutaDescarga($cer){ 
        $certificacion=Certificacion::find($cer);       
        $descargar="";
        if($certificacion){
            $tipoSer=$certificacion->Servicio->tipoServicio->id;            
            switch ($tipoSer) {
                case 1:                    
                    $descargar=route('descargarInicial', ['id' => $certificacion->id]);
                break; 
                case 2:
                    $descargar=route('descargarCertificado', ['id' => $certificacion->id]);
                break;                
                default:
                    # code...
                    break;
            }
        }

        return $descargar;
    }


    public function obtieneNumeroHoja($id){
        $certificacion=Certificacion::find($id);
        $hoja=$certificacion->Materiales->where('idTipoMaterial',1)->first();     
        if($hoja->numSerie!=null){
            return $hoja->numSerie;
        }else{
            return 0;    
        }
                

    }
}
