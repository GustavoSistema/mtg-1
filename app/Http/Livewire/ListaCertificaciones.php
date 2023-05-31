<?php

namespace App\Http\Livewire;

use App\Models\Certificacion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListaCertificaciones extends Component
{
    use WithPagination;

    public $search,$sort,$direction,$cant,$user;


    protected $queryString=[
        'cant'=>['except'=>'10'],
        'sort'=>['except'=>'certificacion.id'],
        'direction'=>['except'=>'desc'],
        'search'=>['except'=>''],        
   ];

    public function mount(){
        $this->user=Auth::id();
        $this->cant="10";
        $this->sort='certificacion.id';
        $this->direction="desc";
    }

    public function render()
    {
        
        $certificaciones=Certificacion::
            
            numFormato($this->search)
            ->placaVehiculo($this->search)
            ->idInspector(Auth::id())
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

    public function finalizarPreconversion(Certificacion $certi){
        $ruta=route('finalizarPreconver',["idCertificacion"=>$certi->id]);
        return redirect()->to($ruta);
    }
}
