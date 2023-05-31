<?php

namespace App\Http\Livewire;

use App\Jobs\guardarArchivosEnExpediente;
use App\Models\CertifiacionExpediente;
use App\Models\Certificacion;
use App\Models\Expediente;
use App\Models\Imagen;
use App\Models\Material;
use App\Models\vehiculo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class FinalizarPreConversion extends Component
{
    use WithFileUploads;

    public $placa,$idCertificacion,$certificacion,$conChip;
    public $imagenes=[];

    protected $rules=["placa"=>"required|min:6|max:7"];
    public function mount(){
        $this->conChip=1;
        $this->certificacion=Certificacion::find($this->idCertificacion);
    }

    public function render()
    {
        return view('livewire.finalizar-pre-conversion');

    }
    public function completar(){
        $this->validate();
        $vehiculo=vehiculo::findOrFail($this->certificacion->Vehiculo->id);
        //dd($vehiculo);
        $chip=Material::where([["idUsuario",Auth::id()],["estado",3],["idTipoMaterial",2]])->first();
        if($this->conChip==1){
            if($chip!=null){
                if($vehiculo){
                    $chip->update(["estado"=>4,"ubicacion"=>"En poder del cliente","descripcion"=>"consumido"]);
                    $vehiculo->update(["placa"=>$this->placa]);
                    
                    $expe=Expediente::create([
                        "placa"=>$this->certificacion->Vehiculo->placa,
                        "certificado"=>$this->certificacion->Hoja->numSerie,
                        "estado"=>1,
                        "idTaller"=>$this->certificacion->Taller->id,
                        'usuario_idusuario'=>Auth::id(),
                        'servicio_idservicio'=>$this->certificacion->Servicio->id,
                    ]);            
                    //dd($expe);            
                    $this->guardarFotos($expe);
                    guardarArchivosEnExpediente::dispatch($expe,$this->certificacion);                       
                    $certEx=CertifiacionExpediente::create(["idCertificacion"=>$this->certificacion->id,"idExpediente"=>$expe->id]);
                }
            }else{
                $this->emit("minAlert", ["titulo" => "AVISO DEL SISTEMA", "mensaje" => "No se pudo seleccionar un chip para realizar el servicio", "icono" => "warning"]);
            }            
        }else{
            if($vehiculo){
                $chip->update(["estado"=>4,"ubicacion"=>"En poder del cliente","descripcion"=>"consumido"]);
                $vehiculo->update(["placa"=>$this->placa]);
                
                $expe=Expediente::create([
                    "placa"=>$this->certificacion->Vehiculo->placa,
                    "certificado"=>$this->certificacion->Hoja->numSerie,
                    "estado"=>1,
                    "idTaller"=>$this->certificacion->Taller->id,
                    'usuario_idusuario'=>Auth::id(),
                    'servicio_idservicio'=>$this->certificacion->Servicio->id,
                ]);     
                //dd($expe);                      
                $this->guardarFotos($expe);
                guardarArchivosEnExpediente::dispatch($expe,$this->certificacion);                       
                $certEx=CertifiacionExpediente::create(["idCertificacion"=>$this->certificacion->id,"idExpediente"=>$expe->id]);
            }
        }      
    }

    public function guardarFotos(Expediente $expe){
        $this->validate(["imagenes"=>"nullable|array","imagenes.*"=>"image"]);
        if(count($this->imagenes)){
            foreach($this->imagenes as $key => $file){          
                $nombre=$expe->placa.'-foto'.($key+1).'-'.$expe->certificado;
                $file_save=Imagen::create([                
                    'nombre'=>$nombre,
                    'ruta'=>$file->storeAs('public/expedientes',$nombre.'.'.$file->extension()),
                    'extension'=>$file->extension(),
                    'Expediente_idExpediente'=>$expe->id,
                ]);            
            }
        }
       $this->reset(["imagenes"]);      
    }
}
