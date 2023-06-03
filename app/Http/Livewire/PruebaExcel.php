<?php

namespace App\Http\Livewire;

use App\Imports\ServicesImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class PruebaExcel extends Component
{
    use WithFileUploads;

    public $file;
    public $data;

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

        $this->data = Excel::toArray([], $path);

       

        //return redirect()->back()->with('success', 'Datos importados correctamente');
    }
}
