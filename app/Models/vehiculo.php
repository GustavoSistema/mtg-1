<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehiculo extends Model
{
    use HasFactory;

    protected $table="vehiculo";

    public $fillable=[
        "id",
        "placa",
        "categoria",
        "marca",
        "modelo",
        "version",
        "anioFab",
        "numSerie",
        "numMotor",
        "cilindros",
        "cilindrada",
        "combustible",
        "ejes",
        "ruedas",
        "asientos",
        "pasajeros",
        "largo",
        "ancho",
        "altura",
        "color",
        "pesoNeto",
        "pesoBruto",
        "cargaUtil",
        "created_at",
        "updated_at",
    ];

    public function Equipos(){
        return $this->belongsToMany(Equipo::class, 'equiposvehiculo','idVehiculo','idEquipo');
    }

}
