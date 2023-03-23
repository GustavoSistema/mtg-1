<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        "idDuplicado",
        "created_at",
        "updated_at",
    ];

    protected $appends = [
        'serie_formato',
        'placa',
        'tipo_servicio',      
    ];

    

    public function Vehiculo(){
        return $this->belongsTo(vehiculo::class,'idVehiculo');
    }

    public function Taller(){
        return $this->belongsTo(Taller::class,'idTaller');
    }

    public function Duplicado(){
        return $this->belongsTo(Duplicado::class,'idDuplicado');
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

    //scopes para busquedas    

    public function scopeIdInspector(Builder $query, string $search): void
    {   
        if($search){
            $query->where('idInspector', $search);
        }
       
    }

    public function scopeNumFormato($query,$search): void{
        if($search){
            $query->whereHas('Materiales', function (Builder $query) use ($search) {
                $query->where('numSerie', 'like', '%'.$search.'%');
            });
        }
    }

    public function scopePlacaVehiculo($query,$search): void{
        if($search){
        $query->orWhereHas('Vehiculo', function (Builder $query) use ($search) {
            $query->where('placa', 'like', '%'.$search.'%');
        });
        }
    }
    

           
    




    //Atributos Especiales del Certificado


    public function getplacaAttribute(){
        return $this->Vehiculo->placa;
    }

    public function gettipoServicioAttribute(){
        return $this->Servicio->tipoServicio->id;
    }


    public function getserieFormatoAttribute(){
        //$hoja=Certificacion::find($this->attributes['id'])->Materiales->where('idTipoMaterial',1)->first();
        //return $hoja;
        $serie=null;
        
            $numero=$this->Materiales->where('idTipoMaterial',1)->first()->numSerie;
       
        
        if($numero){
            $serie=$numero;
        }
        return $serie;
        
    }

    
    public function getHojaAttribute(){
        $hoja=Certificacion::find($this->attributes['id'])->Materiales->where('idTipoMaterial',1)->first();
        return $hoja;
        //return $this->Materiales;
        
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


    public function getRutaVistaCertificadoAttribute(){
        $ruta=null;
        switch ($this->Servicio->tipoServicio->id) {
            case 1: //tipo servicio = inicial gnv
                $ruta= route('certificadoInicialGnv', ['id' => $this->attributes['id']]);                    
            break; 
            case 2://tipo servicio = anual gnv
                $ruta= route('certificadoAnualGnv', ['id' => $this->attributes['id']]);
            break;  
            
            case 8://tipo servicio = anual gnv
                $dupli=Duplicado::find($this->attributes["idDuplicado"]);    
                if($dupli){
                    $ruta= $this->generaRutaDuplicado($dupli);
                }else{
                    $ruta=null;
                }                 
            break; 

            default:
                $ruta=null;
                break;
        }

        return $ruta;
    }


    public function generaRutaDuplicado(Duplicado $duplicado){
        $ruta=null;      

        switch ($duplicado->externo) {
            case 0:
                switch ($duplicado->servicio) {

                    case 1:
                        $ruta= route('duplicadoInicialGnv',['id' => $this->attributes['id']]);                
                    break;
                    case 2:
                        $ruta= route('duplicadoAnualGnv',['id' => $this->attributes['id']]);
                    break;                   
                    
                }                
            break;
            case 1:
                switch ($duplicado->servicio) {

                    case 1:
                        $ruta= route('duplicadoExternoInicialGnv',['id' => $this->attributes['id']]);                
                    break;
                    case 2:
                        $ruta= route('duplicadoExternoAnualGnv',['id' => $this->attributes['id']]);
                    break;                   
                    
                } 
                
            break;
            
            default:
                # code...
                break;
        }

        return $ruta;
    }

    public function generaRutaDescargaDuplicado(Duplicado $duplicado){
        $ruta=null;      

        switch ($duplicado->externo) {
            case 0:
                switch ($duplicado->servicio) {

                    case 1:
                        $ruta= route('descargarDuplicadoInicialGnv',['id' => $this->attributes['id']]);                
                    break;
                    case 2:
                        $ruta= route('descargarDuplicadoAnualGnv',['id' => $this->attributes['id']]);
                    break;                   
                    
                }                
            break;
            case 1:
                switch ($duplicado->servicio) {

                    case 1:
                        $ruta= route('descargarDuplicadoExternoInicialGnv',['id' => $this->attributes['id']]);                
                    break;
                    case 2:
                        $ruta= route('descargarDuplicadoExternoAnualGnv',['id' => $this->attributes['id']]);
                    break;                   
                    
                } 
                
            break;
            
            default:
                # code...
                break;
        }

        return $ruta;
    }

    public function getRutaDescargaCertificadoAttribute(){
        $ruta=null;
        switch ($this->Servicio->tipoServicio->id) {
            case 1: //tipo servicio = inicial gnv
                $ruta= route('descargarCertificadoInicialGnv', ['id' => $this->attributes['id']]);                    
            break; 
            case 2://tipo servicio = anual gnv
                $ruta= route('descargarCertificadoAnualGnv', ['id' => $this->attributes['id']]);
            break;  
            
            case 8://tipo servicio = anual gnv
                $dupli=Duplicado::find($this->attributes["idDuplicado"]);    
                if($dupli){
                    $ruta= $this->generaRutaDescargaDuplicado($dupli);
                }else{
                    $ruta=null;
                }                 
            break;
                       
            default:
                $ruta=null;
                break;
        }

        return $ruta;
    }

    public function getRutaVistaFtAttribute(){
        $ruta=null;
        switch ($this->Servicio->tipoServicio->id) {
            case 1:
                $ruta= route('fichaTecnicaGnv', ['idCert' => $this->attributes['id']]);                    
            break; 
            case 2:
                $ruta= route('fichaTecnicaGnv', ['idCert' => $this->attributes['id']]);
            break;                
            default:
                $ruta=null;
                break;
        }

        return $ruta;
    }

    public function getRutaDescargaFtAttribute(){
        $ruta=null;
        switch ($this->Servicio->tipoServicio->id) {
            case 1:
                $ruta= route('descargarFichaTecnicaGnv', ['idCert' => $this->attributes['id']]);                    
            break; 
            case 2:
                $ruta= route('descargarFichaTecnicaGnv', ['idCert' => $this->attributes['id']]);
            break;                
            default:
                $ruta=null;
                break;
        }

        return $ruta;
    }

    public function getCalculaPesosAttribute(){
        $peso=0;
        $equipos=$this->Vehiculo->Equipos->where('idTipoEquipo',3);
        foreach($equipos as $eq){
            if($eq->peso >0){
                $peso+=$eq->peso;
            }
        }
        return $peso;
    }

    public static function certificarGnv(Taller $taller,Servicio $servicio,Material $hoja,vehiculo $vehiculo,User $inspector){
        $cert=Certificacion::create([
            "idVehiculo"=>$vehiculo->id,
            "idTaller"=>$taller->id,
            "idInspector"=>$inspector->id,
            "idServicio"=>$servicio->id,
            "estado"=>1,
            "precio"=>$servicio->precio,
            "pagado"=>0,
        ]);
        if($cert){
            //cambia el estado de la hoja a consumido
            $hoja->update(["estado"=>4,"ubicacion"=>"En poder del cliente"]);
            //crea y guarda el servicio y material usado en esta certificacion 
            $servM=ServicioMaterial::create([
                "idMaterial"=>$hoja->id,
                "idCertificacion"=>$cert->id
            ]);
            //retorna el certificado
            return $cert;
        }else{
            return null;
        }        
    }    

    public static function duplicarCertificadoExternoGnv(User $inspector,Vehiculo $vehiculo,Servicio $servicio,Taller $taller,Material $hoja,Duplicado $duplicado){
        $cert=Certificacion::create([
            "idVehiculo"=>$vehiculo->id,
            "idTaller"=>$taller->id,
            "idInspector"=>$inspector->id,
            "idServicio"=>$servicio->id,
            "estado"=>1,
            "precio"=>$servicio->precio,
            "pagado"=>0,
            "idDuplicado"=>$duplicado->id
        ]);
        if($cert){
            //cambia el estado de la hoja a consumido
            $hoja->update(["estado"=>4,"ubicacion"=>"En poder del cliente"]);
            //crea y guarda el servicio y material usado en esta certificacion 
            $servM=ServicioMaterial::create([
                "idMaterial"=>$hoja->id,                
                "idCertificacion"=>$cert->id
            ]);
            //retorna el certificado
            return $cert;
        }else{
            return null;
        } 


    }

    public static function duplicarCertificadoGnv(Duplicado $duplicado,Taller $taller,User $inspector,Servicio $servicio,Material $hoja){
        $anterior=Certificacion::find($duplicado->idAnterior);
        $cert=Certificacion::create([
            "idVehiculo"=>$anterior->Vehiculo->id,
            "idTaller"=>$taller->id,
            "idInspector"=>$inspector->id,
            "idServicio"=>$servicio->id,
            "estado"=>1,
            "precio"=>$servicio->precio,
            "pagado"=>0,  
            "idDuplicado"=>$duplicado->id         
        ]);

        if($cert){
            //cambia el estado de la hoja a consumido
            $hoja->update(["estado"=>4,"ubicacion"=>"En poder del cliente"]);
            //crea y guarda el servicio y material usado en esta certificacion 
            $servM=ServicioMaterial::create([
                "idMaterial"=>$hoja->id,                
                "idCertificacion"=>$cert->id
            ]);
            //retorna el certificado
            return $cert;
        }else{
            return null;
        } 


    }

   
    
}
