<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiciosImportados extends Model
{
    use HasFactory;

    protected $table="servicios_importados";

    protected $fillable=[
                    "placa",
                    "certificador",
                    "taller", 
                    "fecha",  
                    "tipoServicio",                     
                    ];
}
