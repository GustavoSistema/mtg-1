<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $table="documento";

    public $fillable=[
        "tipoDocumento",
        "nombreEmpleado",
        "fechaInicio",
        "fechaExpiracion",
        "extension",
        "ruta",
        "nombre",
        "estado",
    ];

    public function TipoDocumento(){
        return $this->belongsTo(TipoDocumento::class,'tipoDocumento');
    }
}
