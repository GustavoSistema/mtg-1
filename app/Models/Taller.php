<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    use HasFactory;

    protected $table = 'taller';
    protected $fillable=
    ['nombre',
    'direccion',
    'ruc',
    ];

    public function servicios(){
        return $this->hasMany(Servicio::class,'taller_idtaller');
    }    
   
}
