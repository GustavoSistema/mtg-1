<?php

namespace App\Http\Livewire;

use App\Imports\ServicesImport;
use App\Models\ServiciosImportados;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ImportarAnuales extends Component
{
    use WithFileUploads;

    public $file;
    public $data,$headers,$estadoAnuales=false,$cuenta,$coincidencias;
    protected $listeners=["render"];


    public function render()
    {
        return view('livewire.importar-anuales');
    }
    public function cargarAnuales(){
        $this->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);       
        $path = $this->file->getRealPath();        
        try {
            $import=Excel::import(new ServicesImport,$path);    
            redirect()->to('pruebaExcel'); 
            $this->emit("minAlert", ["titulo" => "¡EXCELENTE TRABAJO!", "mensaje" => "Se cargaron sus Archivos", "icono" => "success"]);                       
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $this->emit("minAlert", ["titulo" => "AVISO DEL SISTEMA", "mensaje" => "Ocurrio un problema: ".$e, "icono" => "warning"]);    
        }
    }
    
    public function updatedFile($value){
        if(!empty($value)){
            $this->reset(["data","estadoAnuales","cuenta","coincidencias"]);
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
            $this->coincidencias=$this->validaCoincidencias($this->data);
            $this->cuenta=count($this->data);
        }
       
    }

    public function validaCoincidencias($data){
        $cuenta=0;
        foreach($data as $row){
            $fecha=\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0]);
            $placa=$row[2];            
            $servicio=ServiciosImportados::where([['placa',$placa],['fecha',$fecha]])->first();            
            if($servicio!=null){
                $cuenta++;
            }          
        }        
        return $cuenta;
    }
}
