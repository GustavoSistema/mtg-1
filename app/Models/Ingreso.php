<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Group;

class Ingreso extends Model
{
    use HasFactory;

    protected $table="ingresos";

    protected $fillable=
    ['id',
    'idDetalleIngreso',
    'idUsuario',
    'motivo',
    'numeroguia',
    'estado',
    'created_at',
    'updated_at',        
    ];

    /*
    public function detalleIngreso(){
        return $this->hasMany(DetalleIngreso::class,'idDetalleIngreso');
    }
    */

    public function usuario(){
        return $this->belongsTo(User::class,'idUsuario');
    }


    public function materiales(){
        return $this->belongsToMany(Material::class, 'detalleingreso','idIngreso','idMaterial');
    }

    public function getDetallesAttribute(){
        $tipos=TipoMaterial::all();        
        $index=0;
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

    public function getDetailAttribute(){
        $aux=Material::where('grupo',$this->attributes['numeroguia'])->get();    
        return count($aux);
    }
}
