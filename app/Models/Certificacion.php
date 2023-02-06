<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificacion extends Model
{
    use HasFactory;

    protected $table="certificacion";

    public $fillable=[
        "id",
        "idVehiculo",
        "idTaller",
        "idInspector",
        "idServicio",
        "idServicioMaterial",
        "estado",
        "precio",
        "pagado",
        "created_at",
        "updated_at"
    ];

    public function Vehiculo(){
        return $this->belongsTo(vehiculo::class,'idVehiculo');
    }

    public function Taller(){
        return $this->belongsTo(Taller::class,'idTaller');
    }

    public function Inspector(){
        return $this->belongsTo(User::class,'idInspector');
    }

    public function Servicio(){
        return $this->belongsTo(Servicio::class,'idServicio');
    }

    public function Materiales(){
        return $this->belongsToMany(Material::class, 'serviciomaterial','idCertificacion','idMaterial');
    }

    //Atributos Especiales del Certificado

    public function getHojaAttribute(){
        //$hoja=Certificacion::find($this->attributes['id'])->Materiales->where('idTipoMaterial',1)->first();
        //return $hoja;
        return $this->Materiales->where('idTipoMaterial',1)->first();
        
    }

    public function getChipAttribute(){
        return $this->Vehiculo->Equipos->where('idTipoEquipo',1)->first();
    }

    public function getReductorAttribute(){
        return $this->Vehiculo->Equipos->where('idTipoEquipo',2)->first();
    }

    

    public function getCilindrosAttribute(){
        return $this->Vehiculo->Equipos->where('idTipoEquipo',3);
    }
}
