<?php

namespace App\Imports;

use App\Models\ServiciosImportados;
use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class ImportacionDesmontes implements ToModel,WithHeadingRow,WithUpserts
{
    public function uniqueBy()
    {
        return 'placa';
    }  

    public function model(array $row)
    {             
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
        return 1;
    }
}
