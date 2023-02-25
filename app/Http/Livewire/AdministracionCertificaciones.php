<?php

namespace App\Http\Livewire;

use App\Models\Certificacion;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Livewire\Component;
use Livewire\WithPagination;

class AdministracionCertificaciones extends Component
{
    

    use WithPagination;

    public $search,$sort,$direction,$cant,$user,$fechaFin,$dateOptions;
    

    protected $listeners=['render','delete','anular'];
   
    protected $queryString=[
        'cant'=>['except'=>'10'],
        'sort'=>['except'=>'certificacion.id'],
        'direction'=>['except'=>'desc'],
        'search'=>['except'=>''],        
   ];


   
   protected $casts = [
    'fechaFin' => 'datetime:d-m-Y',
   ];

    public function mount(){
        $this->user=Auth::id();
        $this->cant="10";
        $this->sort='certificacion.id';
        $this->direction="desc";
        $this->fechaFin=date('d/m/Y');
        $this->dateOptions=json_encode("minDate: '1920-01-01',  
        locale: {
          firstDayOfWeek: 1,
          weekdays: {
            shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
            longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
          }, 
          months: {
            shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
            longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          }");
    }

    public function render()
    {
       
        $certificaciones=Certificacion::            
            numFormato($this->search)
            ->placaVehiculo($this->search)
            ->idInspector('')
            //->where('created_at',$this->fechaFin)
            //->where('nombre','hola')
            ->orderBy($this->sort,$this->direction)
            ->paginate($this->cant);    
        return view('livewire.administracion-certificaciones',compact('certificaciones'));       
        
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

    public function anular(Certificacion $certificacion){
        $certificacion->Hoja->update(['estado'=>5]); // estado anulado en MATERIAL
        $certificacion->update(['estado'=>2]); //estado anulado en CERTIFICACION
        $this->emitTo('administracion-certificaciones','render');
    }

    public function delete(Certificacion $certificacion){
           if($certificacion->Hoja->update(['estado'=>3])){
            $certificacion->delete();
            $this->emitTo('administracion-certificaciones','render');
           } else{
            $this->emit("minAlert",["titulo"=>"AVISO DEL SISTEMA","mensaje"=>"Ocurrio un error al cambiar el estado de este certificado","icono"=>"warning"]);
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


    
}


