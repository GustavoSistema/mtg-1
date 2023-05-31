<?php

namespace App\Http\Livewire;

use App\Jobs\guardarArchivosEnExpediente;
use App\Models\CertifiacionExpediente;
use App\Models\Certificacion;
use App\Models\CertificacionPendiente;
use App\Models\Expediente;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListaCertificacionesPendientes extends Component
{

    use WithPagination;

    public $sort,$direction,$cant,$search;

    public function mount(){
        $this->direction='desc';
        $this->sort='id';       
        $this->cant=10;
    }

    public function render()
    {
        $certis=CertificacionPendiente::
        placaVehiculo($this->search)
        ->idInspector(Auth::id())
        //->placaVehiculo($this->search)
        ->orderBy($this->sort,$this->direction)
        ->paginate($this->cant);;
        return view('livewire.lista-certificaciones-pendientes',compact("certis"));
    }

    public function certificar(CertificacionPendiente $certi){
        $precio=0;
        if($certi->pagado>0){
            $precio=$certi->precio;
        }
        $hoja=$this->obtieneFormato();
        //dd($hoja);
        if($hoja){
            //crea una certificacion
            $certif= Certificacion::certificarGnvPendiente($certi->Taller, $certi->Servicio, $hoja, $certi->Vehiculo, $certi->Inspector,$precio);
            //Encuentra el expediente y cambia su estado
            $expe=Expediente::find($certi->idExpediente);
            if($expe){
                $expe->update(["servicio_idservicio"=>$certif->idServicio,"certificado"=>$certif->Hoja->numSerie]);
                //Crea la relacion entre la nueva certificacion y el expediente previamente registrado
                $certEx=CertifiacionExpediente::create(["idCertificacion"=>$certif->id,"idExpediente"=>$expe->id]);
            }                                  
            //agrega la certificacion al registro de certificado pendiente
            $certi->update(["idCertificacion"=>$certif->id]);
            //Se cambia la fecha de certificacion por la fecha en que se registro el certificado pendiente
            $certif->update(["created_at"=>$certi->created_at]);
            //Agrega a la cola de trabajo la carga de los archivos de certificacion
            guardarArchivosEnExpediente::dispatch($expe,$certif);
            //cambia el estado de la certificacion a realizado
            $this->cambiaEstado($certi);
            $this->emit("minAlert", ["titulo" => "¡EXCELENTE TRABAJO!", "mensaje" => "Tu certificado N°: " . $certif->Hoja->numSerie . " esta listo.", "icono" => "success"]);       
        }else{
            $this->emit("minAlert", ["titulo" => "AVISO DEL SISTEMA", "mensaje" => "No fue posible encontrar un formato para realizar la certificación", "icono" => "warning"]);
        }
    }
    
    public function cambiaEstado(CertificacionPendiente $certi){
        $certi->update(["estado"=>2]);
    }

    public function obtieneFormato()
    {
        $formato = Material::where([
            ["idTipoMaterial", 1],
            ['idUsuario', Auth::id()],
            ["estado", 3],
        ])->orderBy('numSerie', 'asc')
          ->first();        
        return $formato;
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
