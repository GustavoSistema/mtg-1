<?php

namespace App\Imports;

use App\Models\ServiciosImportados;
use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class ImportacionDesmontes implements ToModel,WithHeadingRow
{    
    
    public function model(array $row)
    {             
        HeadingRowFormatter::default('none');        
        return new ServiciosImportados([
            "placa" => $row['PlacaVehiculo'],
            "certificador" => $row['Certificador'],
            "taller" => $row['NombreTaller'],
            "fecha" => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['FechaDesmonte']),
            "precio"=>null,
            "tipoServicio"=>6,
            "estado"=>1,
            "pagado"=>false,
        ]);
    }

    public function headingRow(): int
    {
        return 0;
    }
}
