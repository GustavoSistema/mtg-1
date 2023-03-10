<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    'añoActivo',
    'created_at',
    'updated_at',        
    ];   

    public function tipo(){
        return $this->belongsTo(TipoMaterial::class,'idTipoMaterial');
    }

    public static function formatosGnvEnStock($tipo){
        $res=new Collection();
        $aux=DB::table('material')
            ->select('material.idTipoMaterial','tipomaterial.descripcion')            
            ->join('tipomaterial','material.idTipoMaterial',"=",'tipomaterial.id')
            ->where([
                ['material.idTipoMaterial',$tipo],   
                ['material.estado',1],             
            ])            
            ->get();
        $res=$aux;
        return $res->count();
    }
    
    public function scopeSearchSerieFormmato($query,$search){
        if($search){
           return $query->where([['idTipoMaterial', 1],['numSerie','like','%'.$search.'%']]);
        }
       
    }
}
