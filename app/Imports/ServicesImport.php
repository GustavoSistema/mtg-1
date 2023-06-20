<?php

namespace App\Imports;

use App\Models\Certificacion;
use App\Models\ServiciosImportados;

use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;


class ServicesImport implements ToModel, WithHeadingRow, WithUpserts

{
    use Importable;
    

    public function uniqueBy()
    {
        return 'placa';
    }

    public function model(array $row)
    {
        return new ServiciosImportados([
            "placa" => $row['placa'],
            "certificador" => trim($row['certificador']),
            "taller" => trim($row['taller']),
            "fecha" => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_revision']),
            "precio"=>null,
            "tipoServicio"=>2,
        ]);
    }

    public function headingRow(): int
    {
        return 6;
    }

    


    public function customValidationAttributes()
    {
        return ['2' => 'placa'];
    }

    
    
}
