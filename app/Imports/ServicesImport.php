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
            "placa"=>$row['Placa'],
            "certificador"=>$row['Certificador'],
            "taller"=>$row['Taller'],
        ]);
    }

    public function headingRow(): int
    {
        return 6;
    }
}
