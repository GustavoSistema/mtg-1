<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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


    public function TipoServicio(){
        return $this->belongsTo(TipoServicio::class,'tipoServicio');
    }

    public function scopeRangoFecha(Builder $query, string $desde, string $hasta): void
    {   
        if($desde && $hasta){            
            $query->whereBetween('fecha', [$desde.' 00:00:00',$hasta.' 23:59:59']);
        }       
    }
    public function scopeCertificador(Builder $query, string $search): void{   
        if($search){
            $query->where('certificador', $search);
        }       
    }

    public function scopeTaller($query,$search): void{
        if($search){           
            $query->where('taller', $search);              
        }
        
    }
}
