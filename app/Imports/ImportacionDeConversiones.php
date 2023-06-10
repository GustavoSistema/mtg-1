<?php

namespace App\Imports;

use App\Models\ServiciosImportados;
use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class ImportacionDeConversiones implements ToModel,WithHeadingRow, WithUpserts
{
    /**
    * @param Collection $collection
    */
    public function uniqueBy()
    {
        return 'placa';
    }  

    public function model(array $row)
    {
        //dd($row);        
        return new ServiciosImportados([
            "placa" => $row['placa'],
            "certificador" => $row['certificador'],
            "taller" => $row['taller'],
            "fecha" => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_conversion']),
            "tipoServicio"=>1,
        ]);
    }

    public function headingRow(): int
    {
        return 7;
    }

    


    public function customValidationAttributes()
    {
        return ['2' => 'placa'];
    }

}
