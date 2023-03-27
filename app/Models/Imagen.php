<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Imagen extends Model
{

    use InteractsWithMedia;
    use HasFactory;

    protected $table = 'imagenes';

    protected $fillable=
    ['nombre',
    'ruta',
    'extension',
    'estado',
    'Expediente_idExpediente'    
    ];
    
}
