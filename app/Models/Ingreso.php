<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;

    protected $table="ingresos";

    protected $fillable=
    ['id',
    'idDetalleIngreso',
    'idUsuario',
    'motivo',
    'numeroGuia',
    'estado',
    'created_at',
    'updated_at',        
    ];

    public function detalleIngreso(){
        return $this->hasMany(DetalleIngreso::class,'idDetalleIngreso');
    }

    public function usuario(){
        return $this->belongsTo(User::class,'idUsuario');
    }
}
