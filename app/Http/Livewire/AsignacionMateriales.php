<?php

namespace App\Http\Livewire;

use App\Models\Salida;
use App\Models\TipoMaterial;
use App\Models\User;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use PDF;
use Livewire\Component;
use PhpParser\Node\Stmt\Foreach_;

class AsignacionMateriales extends Component
{
    public $open=false;
    public $inspectores,$inspector,$stockGlp,$stockGnv,$stockChips;
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
        
        

    }

    public function enviar(){
        $materiales=$this->articulos;
       $data=[
        "date"=>date('d/m/Y'),
        "title"=>"MOTORGAS COMPANY S.A.",
        "materiales"=>$this->articulos
        ];
        view()->share('cargoPDF',$data);          
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('cargoPDF',$data);


        //return $pdf->download('prueba.pdf');
        return $pdf->stream();
    }
}
