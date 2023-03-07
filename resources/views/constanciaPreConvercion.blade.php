<!DOCTYPE html>
<html>
<head>    
    <title>EVALUACIÓN DE PRE-CONVERSIÓN</title>
    <style>        
        @page {
            margin: 0cm 0cm;
            font-family: sans-serif;
        }

        body {
            margin:1cm 2cm 2cm;
            display: block;
        } 
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 8cm;            
            color: black;
            font-weight: bold;      
            text-align: center; 
            
        }
        
       

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;         
            color: black;
            text-align: center;
            line-height: 35px;
            
        } 

        p{
            font-size:12px;
        }

        image{
            margin-left: 2cm;
        }
        h3{
            margin-top: 3cm;
            color: black; 
            text-align: center;
        } 
        h4{
            font-size: 14px;
            text-align: center;
        }  
        h5{
            text-align: center;      
        }
        h6{
            margin-bottom: -10px;
        }
        table, th, td {
        font-size: 12px;
        border: 1px solid;
        border-collapse: collapse;
        }
        table{
            width: 100%;
        }
        ol{
            list-style-type: lower-latin;
            font-size: 10px;
        }
        ul{
            font-size: 10px;
        }
    </style>
</head>
<body>
    <header>
        <article>           
            <img style="float:left; padding-left: 3cm; margin-top: 20px" src="{{'.'.Storage::url($taller->rutaLogo)}}" width="90" height="90"/>
            <h2 style="margin-top: 40px">{{$taller->nombre}}</h2>
            <p>{{$taller->direccion}}</p>            
        </article>        
    </header>  
    <main>        
        <h3 style="background-color:goldenrod;">           
            EVALUACIÓN DE PRE CONVERSIÓN
        </h3>       
        <br/>
        <table> 
            <tr>               
                <td colspan="2" style="text-align: center; font-weight: bold;">DATOS DEL PROPIETARIO </td>
                <td colspan="2" style="text-align: center; font-weight: bold;">DATOS DEL VEHÍCULO </td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td></td>
                <td>placa</td>
                <td>{{(isset($carro->placa)? $carro->placa : 'NE')}}</td>
            </tr>
            <tr>
                <td>DNI / RUC</td>
                <td></td>
                <td>Marca</td>
                <td>{{(isset($carro->marca)? $carro->marca : 'NE')}}</td>
            </tr>
            <tr>
                <td>Dirección</td>
                <td></td>
                <td>Modelo</td>
                <td>{{(isset($carro->modelo)? $carro->modelo : 'NE')}}</td>
            </tr>
            <tr>
                <td>Telefono</td>
                <td></td>
                <td>Año de Fab.</td>
                <td>{{(isset($carro->anioFab)? $carro->anioFab : 'NE')}}</td>
            </tr>
            <tr>
                <td>Fecha</td>
                <td></td>
                <td>Cilindrada</td>
                <td>{{(isset($carro->cilindrada)? $carro->cilindrada : 'NE')}}</td>
            </tr>
            <tr>
                <td>Servicio</td>
                <td>CONVERSION A GAS NATURAL VEHICULAR</td>
                <td>Kilometraje</td>
                <td></td>
            </tr> 
            <tr>
               <td colspan="4" style="text-align: center; font-weight: bold;">REVISIONES</td>
            </tr>        
        </table>

        <h5 style="background-color:goldenrod;">DATOS DE LOS EQUIPOS DE GNV</h5>
        <!-- DATOS DE LOS EQUIPOS -->
        <p><strong>Chip de identificacion: </strong>{{$chip->numSerie}}</p>
            <table>
                <tr>
                    <th style="text-align:center;">Componente</th>
                    <th style="text-align:center;">Marca</th>
                    <th style="text-align:center;">N°Serie</th>
                    <th style="text-align:center;">Modelo</th>
                    <th style="text-align:center;">Capacidad (LT)</th>                    
                </tr>
                @foreach ($equipos as $key=>$item)
                    @switch($item->idTipoEquipo)
                        @case(2)
                            <tr>                        
                                <td style="text-align:center;">{{$item->tipo->nombre}}</td>
                                <td style="text-align:center;">{{$item->marca}}</td>
                                <td style="text-align:center;">{{$item->numSerie}}</td>
                                <td style="text-align:center;">{{$item->modelo}}</td>
                                <td style="text-align:center;">N/A</td>                    
                            </tr>
                        @break
                        @case(3)
                            <tr>                        
                                <td style="text-align:center;">{{$item->tipo->nombre}}</td>
                                <td style="text-align:center;">{{$item->marca}}</td>
                                <td style="text-align:center;">{{$item->numSerie}}</td>
                                <td style="text-align:center;">N/A</td>
                                <td style="text-align:center;">{{$item->capacidad}}</td>                    
                            </tr>
                        @break
                        @default                            
                    @endswitch               
                @endforeach                
            </table>    
            <br>
            <br>
            <br>        
            
           
            <article style="text-justify: center;"  >
                <table style=" text-align: center; width:80%; margin:auto;">
                    <tr>
                        <td style="width: 50%;">
                            <br>
                            <br>
                            <br>                        
                        </td>
                        <td style="width: 50%;">
                            <img  src="{{'.'.Storage::url($taller->rutaFirma)}}" width="180" height="90"/>                       
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">Firma del cliente</td>
                        <td style="width: 50%;">Firma del representante del taller</td>
                    </tr>
                </table>
            </article>
            
           
        </main>
    <footer>
        
    </footer>    
</body>
</html>