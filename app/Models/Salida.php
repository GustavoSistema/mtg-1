<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Salida extends Model
{
    use HasFactory;

    protected $table="salidas";

    protected $fillable=
    ['id',
    'numero',
    'idUsuarioSalida',
    'idUsuarioAsignado',
    'motivo', 
    'estado',  
    'idSubGrupo',    
    ];


    public function getDetallesAttribute(){
        $tipos=TipoMaterial::all();       
        $res=[];
        foreach($tipos as $tipo){
            $aux=DB::table('material')
            ->select('material.idTipoMaterial','tipomaterial.descripcion')            
            ->join('tipomaterial','material.idTipoMaterial',"=",'tipomaterial.id')
            ->where([
                ['material.grupo',$this->attributes['numeroguia']],
                ['material.idTipoMaterial',$tipo->id],                
            ])            
            ->get();
            if(count($aux)>0) {
                $a=array("tipo"=>$tipo->descripcion,"cantidad"=>count($aux));
                array_push($res,$a);
            }
        }        
        return $res;
    }

    public function materiales(){
        return $this->belongsToMany(Material::class, 'detallesalida','idSalida','idMaterial');
    }

    public function getFormatosGnvAttribute(){
        return $this->materiales->where('idTipoMaterial',1);
    }

    public function getInicioSerieGnvAttribute(){
        return $this->materiales->where('idTipoMaterial',1)->min('numSerie');
    }

    public function getFinalSerieGnvAttribute(){
        return $this->materiales->where('idTipoMaterial',1)->max('numSerie');
    }
    

    public function usuarioCreador(){
        return $this->belongsTo(User::class,'idUsuarioSalida');
    }

    public function usuarioAsignado(){
        return $this->belongsTo(User::class,'idUsuarioAsignado');
    }
    public function subgrupo(){
        return $this->belongsTo(Subgrupo::class,'idSubGrupo');
    }
}
