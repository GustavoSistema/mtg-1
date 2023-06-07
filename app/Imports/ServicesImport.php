<?php

namespace App\Imports;

use App\Models\Certificacion;
use App\Models\ServiciosImportados;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;

class ServicesImport implements ToModel, WithHeadingRow, WithUpserts, WithValidation
{
    

    public function uniqueBy()
    {
        return 'placa';
    }

    public function rules(): array
    {
        $data=Certificacion::pluck('placa')->all();
        return [
            'placa' => Rule::in($data),

             // Above is alias for as it always validates in batches
            '*.email' => Rule::in(['patrick@maatwebsite.nl']),
        ];
    }

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

    public function customValidationMessages()
{
    return [
        'placa.in' => 'La placa :attribute ya existe.',
    ];
}
}
