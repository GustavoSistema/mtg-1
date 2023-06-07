<?php

namespace App\Http\Livewire;

use App\Imports\ServicesImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

use function PHPUnit\Framework\isEmpty;

class PruebaExcel extends Component
{
    use WithFileUploads;

    public $file;
    public $data,$headers,$estadoAnuales=false,$cuenta;

    protected $listeners=["render"];

    public function render()
    {

        return view('livewire.prueba-excel');
    }


    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);
        
        
        $path = $this->file->getRealPath();

        //$this->data = Excel::toArray([], $path);

       

        //return redirect()->back()->with('success', 'Datos importados correctamente');
    }

    public function cargarAnuales(){
        $this->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);       
        
        $path = $this->file->getRealPath();        
               
        try {
            $import=Excel::import(new ServicesImport,$path);
            dd($import);
           // $this->emit("minAlert", ["titulo" => "¡EXCELENTE TRABAJO!", "mensaje" => "Todo ok", "icono" => "success"]); 
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
             $failures = $e->failures();             
             foreach ($failures as $failure) {
                 $failure->row(); // row that went wrong
                 $failure->attribute(); // either heading key (if using heading row concern) or column index
                 $failure->errors(); // Actual error messages from Laravel validator
                 $failure->values(); // The values of the row that has failed.
             }
        }
    }

    
    public function updatedFile($value){
        if(!empty($value)){
            $this->reset(["data","estadoAnuales"]);
        }
    }

    //importa reporte anuales
    public function procesarAnuales()
    {      
        $this->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);        
        
        $path = $this->file->getRealPath();        
        $data = Excel::toArray([], $path)[0];
        if(!empty($data)){
            $this->estadoAnuales=true;
            $this->headers = isset($data[5]) ?  array_column($data[5],null): [];
            $this->data=array_slice($data,6,(count($data)-5));     
            $this->cuenta=count($this->data);
        }
    }
    

    
}
