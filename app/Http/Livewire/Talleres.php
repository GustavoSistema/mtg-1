<?php

namespace App\Http\Livewire;

use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Imagen;
use App\Models\Provincia;
use App\Models\Servicio;
use App\Models\Taller;
use Doctrine\Inflector\Rules\English\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Talleres extends Component
{
    
    use WithFileUploads;

    public $sort,$order,$cant,$search,$direction,$editando,$taller,$open; 
    public $serviciosTaller=[];

    public $departamentosTaller,$provinciasTaller,$distritosTaller,$logoTaller,$firmaTaller;

    public $logoNuevo=null;
    public $firmaNuevo=null;

    public $departamentoSel=Null;
    public $provinciaSel=Null;
    public $distritoSel=Null;
    

    public function mount(){
      $this->direction='desc';
      $this->sort='id';       
      $this->open=false;
      $this->departamentosTaller=Departamento::all();
    }

    protected $rules=[
      'taller.nombre'=>'required|min:5',
      'taller.direccion'=>'required|min:5',
      'taller.ruc'=>'required|min:11|max:11',
      'taller.idDistrito'=>'required',
      'taller.servicios.*.estado'=> 'nullable',
      'taller.servicios.*.precio'=> 'required|numeric',
      'logoNuevo'=>'nullable|image',
      'firmaNuevo'=>'nullable|image',
    ];

    public function render()
    {
        //$files=Imagen::where('Expediente_idExpediente','=',367)->whereIn('extension',['jpg','jpeg','png','gif','tif','tiff','bmp'])->get();
        $talleres=Taller::where('nombre','like','%'.$this->search.'%')
                        ->orWhere('ruc','like','%'.$this->search.'%')          
                        ->orderBy($this->sort,$this->direction)
                        ->paginate($this->cant);
        return view('livewire.talleres',compact('talleres'));
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function cargaServiciosTaller($id){
            $this->serviciosTaller=DB::table('servicio') 
            ->select('servicio.*', 'tiposervicio.descripcion')             
            ->join('tiposervicio', 'servicio.tipoServicio_idtipoServicio', '=', 'tiposervicio.id')
            ->where('taller_idtaller',$id)
            ->get();
    }
    

    public function edit(Taller $tal){      
        if($tal->idDistrito!=null) {
          $dist=Distrito::find($tal->idDistrito);
          $prov=Provincia::find($dist->idProv);
          $depa=Departamento::find($prov->idDepa);

          
         
         
          $this->departamentoSel=$depa->id;
          $this->updatedDepartamentoSel($depa->id);
          $this->provinciaSel=$prov->id;
          $this->updatedProvinciaSel($prov->id);
        }else{
          $this->reset(["departamentoSel","provinciaSel","distritoSel"]);          
        }
        if($tal->rutaFirma){
            $this->firmaTaller=$tal->rutaFirma;
        }
        if($tal->rutaLogo){
            $this->logoTaller=$tal->rutaLogo;
        }

        

          $this->taller=$tal;
          $this->editando=true;          
       
    }

    public function updatedEditando(){
        $this->reset(["logoNuevo","firmaNuevo"]);
    }

    public function updatedDepartamentoSel($depa){        
        $this->provinciasTaller=Provincia::where("idDepa",$depa)->get();  
        $this->provinciaSel=null;  
         
    }

    public function updatedProvinciaSel($prov){        
        $this->distritosTaller=Distrito::where("idProv",$prov)->get();               
        $this->distritoSel=null;          
    }

    public function actualizar(){
        
        $this->validate();
        if($this->logoNuevo){
            //Storage::delete($this->taller->rutaLogo);  
            $rutaLogo=$this->logoNuevo->storeAs('public/Logos','logo-'.$this->taller->ruc.'.'.$this->logoNuevo->extension());  
            $this->taller->rutaLogo=$rutaLogo;
        }

        if($this->firmaNuevo){
            //Storage::delete($this->taller->rutaFirma);
            $rutaFirma=$this->firmaNuevo->storeAs('public/Firmas','firma-'.$this->taller->ruc.'.'.$this->firmaNuevo->extension()); 
            $this->taller->rutaFirma=$rutaFirma;
        }

        $this->taller->save();

        foreach($this->taller->servicios as $ser){                
                $ser->save();
                if($ser->estado){
                    
                }
        }
        $this->reset(['editando']);
        $this->emit('alert','Los datos del taller se actualizaron correctamente.');

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

    protected $listeners=['render'];
}
