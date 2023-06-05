<?php

namespace App\Imports;

use App\Models\ServiciosImportados;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ServicesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {       
        return new ServiciosImportados([
            "placa"=>$row['placa'],
            "certificador"=>$row['certificador'],
            "taller"=>$row['taller'],
            "fecha"=>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_revision']),            
        ]);        
    }

    public function headingRow(): int
    {
        return 6;
    }
}
