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
            $certif= Certificacion::certificarGnv($certi->Taller, $certi->Servicio, $hoja, $certi->Vehiculo, $certi->Inspector);
            $expe=Expediente::create([
                "placa"=>$certi->Vehiculo->placa,
                "certificado"=>$hoja->numSerie,
                "estado"=>1,
                "idTaller"=>$certi->Taller->id,
                'usuario_idusuario'=>$certi->Inspector->id,
                'servicio_idservicio'=>$certi->Servicio->id,
                "precio"=>$precio,
            ]);                        
            //$this->guardarFotos($expe);
            $certEx=CertifiacionExpediente::create(["idCertificacion"=>$certif->id,"idExpediente"=>$expe->id]);
            guardarArchivosEnExpediente::dispatch($expe,$certif);
            $this->cambiaEstado($certi);
            $this->emit("minAlert", ["titulo" => "¡EXCELENTE TRABAJO!", "mensaje" => "Tu certificado N°: " . $certif->Hoja->numSerie . " esta listo.", "icono" => "success"]);       
        }else{
            $this->emit("minAlert", ["titulo" => "AVISO DEL SISTEMA", "mensaje" => "No fue posible certificar", "icono" => "warning"]);
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
}
