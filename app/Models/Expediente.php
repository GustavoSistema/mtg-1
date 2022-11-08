<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;
    protected $fillable=
    ['placa',
    'certificado',
    'fecha',
    'estado',
    'usuario_idusuario',
    'servicio_idservicio'
    ];
}
