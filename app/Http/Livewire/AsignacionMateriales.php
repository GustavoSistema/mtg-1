<?php

namespace App\Http\Livewire;

use App\Models\Material;
use App\Models\Salida;
use App\Models\SalidaDetalle;
use App\Models\Subgrupo;
use App\Models\TipoMaterial;
use App\Models\TipoServicio;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use PDF;
use Livewire\Component;


class AsignacionMateriales extends Component
{
    public $open=false;
    public $inspectores,$inspector,$stockGlp,$stockGnv,$stockChips,$ruta;
    public  $articulos=[];
    


    protected $listeners = ['agregarArticulo'];

    public function mount(){
        $this->inspectores=User::role(['inspector','supervisor'])
        //->where('id','!=',Auth::id())
        ->orderBy('name')->get();
        
    }
    public function render()    {
        
        return view('livewire.asignacion-materiales');
    }    
    
    public function agregarArticulo($articulo){
        $tipoServicio=TipoMaterial::find($articulo["tipo"]);   
        $articulo["nombreTipo"]=$tipoServicio->descripcion;
        array_push($this->articulos,$articulo);
        $this->emit('render');   
    }
    public function deleteArticulo($id){
        unset($this->articulos[$id]);
    }

    
    public function guardar(){
        $this->validate(
            [
                "inspector"=>"required|numeric|min:1",                
                "articulos"=>"required|array|min:1"
            ]  
        );
        $salida=Salida::create(
            [
                "numero"=>date('dmY').Auth::id().rand(),
                "idUsuarioSalida"=>Auth::id(),
                "idUsuarioAsignado"=>$this->inspector,
                "motivo"=>"Asignación de Materiales",
                "estado"=>1                
            ]
        );  

        foreach($this->articulos as $key=>$articulo){
                $this->asignarMaterial($articulo,$salida);
        }
        $this->ruta=route('cargoPdf', ['id' => $salida->id]);
        
        $this->reset(['articulos','inspector']);
    }
    
    public function identificaSeries($articulos){
        
    }
    
    public function asignarMaterial($art,Salida $salida){
        switch ($art["tipo"]) {
            case 1:
                $items=$this->asignarFormatos($art["cantidad"],$art["tipo"],$salida->idUsuarioAsignado);
                $this->guardaDetalles($items,$salida->id);
                break;
            case 2:
                $items=$this->asignarChips($art["cantidad"],$salida->idUsuarioAsignado);
                $this->guardaDetalles($items,$salida->id);
                break;
            case 3:
                $items=$this->asignarFormatos($art["cantidad"],$art["tipo"],$salida->idUsuarioAsignado);
                $this->guardaDetalles($items,$salida->id);
                break;           
            default:
                
                break;
        }
    }

    public function guardaDetalles($articulos,$idSalida){
        foreach($articulos as $articulo){
            $detalleSal=SalidaDetalle::create([
                "idSalida"=>$idSalida,
                "idMaterial"=>$articulo->id,
                "estado"=>1
            ]);
        }
    }

    public function asignarChips($cantidad,$idUsuario){
        $asignados=[];
        $materialTipoChip=2;
        $usuario=User::find($idUsuario);
        $chips=Material::where([
                                ["idTipoMaterial",$materialTipoChip],
                                ["estado",1]
                              ])
                        ->orderBy('id','asc')
                        ->paginate($cantidad);                                              
        foreach($chips as $chip){
            $chip->update(['idUsuario'=>null,'ubicacion'=>'En proceso de envio a '.$usuario->name,'estado'=>2]);
            array_push($asignados,$chip);
        }
        return $asignados;
    }

    public function asignarFormatos($cantidad,$tipo,$idUsuario){
        $usuario=User::find($idUsuario);
        $aux=[];        
        $formatos=Material::where([
            ["idTipoMaterial",$tipo],
            ["estado",1]
        ])
        ->orderBy('numSerie','asc')
        ->paginate($cantidad);  

        foreach($formatos as $formato){
            $formato->update(['idUsuario'=>null,'ubicacion'=>'En proceso de envio a '.$usuario->name,'estado'=>2]);
            array_push($aux,$formato);
        }
        return $aux;
    }
    
    public function cuentaMateriales($materiales){
        $end=[];
        $inicio=$materiales[0]->numSerie;
        $fin=$materiales[count($materiales)-1]->numSerie;
        $tipos=TipoMaterial::All();    
        $aux=$materiales->toArray(); 
        $mat=array_column($aux, 'idTipoMaterial');        
        $conteo=array_count_values($mat);        
        foreach($tipos as $tipo){
            if(isset($conteo[$tipo->id])){  
                    if($tipo->id==1 || $tipo->id==3){
                        $series=$this->calculaSeries($materiales,$tipo->id);
                        array_push($end,array("tipo"=>$tipo->descripcion,"cantidad"=>$conteo[$tipo->id],"inicio"=>$series["inicio"],"fin"=>$series["fin"])); 
                    }else{
                        array_push($end,array("tipo"=>$tipo->descripcion,"cantidad"=>$conteo[$tipo->id],"inicio"=>null,"fin"=>null));
                    }
                    

            }
        }        
        return $end;       
    }

    public function calculaSeries($articulos,$tipo){
        $aux=[]; 
        if($tipo ==1 || $tipo==3){
            foreach($articulos as $articulo){
                if($articulo->idTipoMaterial==$tipo){
                    array_push($aux,$articulo);
                }
            }     
            return array("tipo"=>$tipo,"inicio"=>$aux[0]->numSerie,"fin"=>$aux[count($aux)-1]->numSerie);
        } else{
            return array();
        }

    }

    public function enviar($id){
        $sal=Salida::find($id);
        $materiales=$this->cuentaMateriales($sal->materiales);        
        $inspector=$sal->usuarioAsignado;
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha=date('d').' de '.$meses[date('m')-1].' del '.date('Y').'.';               
        $data=[
        "date"=>$fecha,
        "empresa"=>"MOTORGAS COMPANY S.A.",
        "inspector"=>$inspector->name,
        "materiales"=>$materiales,
        "salida"=>$sal
        ];                 
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('cargoPDF',$data);        
        return $pdf->stream(date('d-m-Y').'_'.$inspector->name.'-cargo.pdf');
    }
}
