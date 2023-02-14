<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table="material";

    protected $fillable=
    ['id',
    'descripcion',
    'numSerie',
    'idUsuario',
    'stock',
    'estado',
    'ubicacion',
    'grupo',
    'idTipoMaterial',
    'created_at',
    'updated_at',        
    ];   

    public function tipo(){
        return $this->belongsTo(TipoMaterial::class,'idTipoMaterial');
    }
    
    public function scopeSearchSerieFormmato($query,$search){
        if($search){
           return $query->where([['idTipoMaterial', 1],['numSerie','like','%'.$search.'%']]);
        }
       
    }
}
