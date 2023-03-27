<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Expediente extends Model
{
    

    use HasFactory;
    protected $fillable=
    ['placa',
    'certificado',
    'fecha',
    'estado',
    'idTaller',
    'idObservacion',
    'usuario_idusuario',
    'servicio_idservicio'
    ];

   
/*
    protected $appends=
    [
        "nombre_taller",   
        "nombre_inspector",
        "nombre_servicio",
    ];

    public function Taller():BelongsTo {
        return $this->belongsTo(Taller::class,'idTaller');       
    }
   

    public function getNombreTallerAttribute(){
        return $this->Taller->nombre;
    }

    public function Inspector():BelongsTo {
        return $this->belongsTo(User::class,'usuario_idusuario');       
    }
   

    public function getNombreInspectorAttribute(){
        return $this->Inspector->name;
    }

    public function Servicio():BelongsTo {
        return $this->belongsTo(Servicio::class,'servicio_idservicio');       
    }
   

    public function getNombreServicioAttribute(){
        return $this->Servicio->tipoServicio->descripcion;
    }
*/
    

}
