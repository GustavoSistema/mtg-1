<!DOCTYPE html>
<html>
<head> 
    <meta charset="UTF-8">
    <style>        
        @page {
            margin: 0.5cm 1.5cm;
            font-family: sans-serif;
            font-size: 8px;
        }
    </style>  

    <title>Check List Cilindro Arriba</title>    
</head>
<body style="display: block;">
    <header style="align-items: center;font-size:10px; font-weight: bold; position:fixed; height: 2cm; width: 100%;">                 
            <img  src="{{public_path('/images/logo.png')}}" width="120" height="50" align="left" />            
            <p style="text-align: center;  width: 500px; float: right;" align="right"> 
                REPORTE DE VERIFICACIÓN DE LA INSTALACIÓN DEL EQUIPO GNV A VEHÍCULOS CONVERTIDOS U
                ORIGINALMENTE DISEÑADOS A GAS NATURAL VEHICULAR – GNV 
                <br>
                RD N° 365 - 2021 - MTC / 17.03                
            </p>                    
    </header> 
    <br clear="left">

    <!--Datos Vehículo y Equipos-->
    <section>
        <table style="border: 1px solid; border-collapse: collapse; width: 500px; float: left;">
            <tr style="">
                <td colspan="7"  style="align-self: start; border: 1px solid; border-collapse: collapse;">
                    Taller: 
                    <br>
                    {{$taller->nombre}}                   
                </td>
                <td colspan="2"  style="border: 1px solid; border-collapse: collapse;">
                    Fecha de inspeccion:
                    <br>
                    {{$fecha}}
                </td>                
            </tr>
            <tr>
                <td colspan="4" style="border: 1px solid; border-collapse: collapse;">
                    Placa de rodaje/DUA:
                    <br>
                    {{$vehiculo->placa}}
                </td>
                <td colspan="2" style="border: 1px solid; border-collapse: collapse;">
                    Inspector:
                    <br>
                    {{$inspector->name}}                   
                </td>
                <td style="border: 1px solid; border-collapse: collapse;">
                    Marca Regulador:
                    <br>
                </td>
                <td colspan="2" style="border: 1px solid; border-collapse: collapse;">
                    Marca Cilindro:
                    <br>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid; border-collapse: collapse;">
                    Revision
                    <br>
                    incial
                </td>
                <td style="border: 1px solid; border-collapse: collapse;">

                </td>
                <td style="border: 1px solid; border-collapse: collapse;">
                    Revision
                    <br>
                    anual
                </td>
                <td style="border: 1px solid; border-collapse: collapse;">

                </td>
                <td colspan="2" style="border: 1px solid; border-collapse: collapse;">
                    Año del vehículo:
                    <br> 
                    {{$vehiculo->anioFab}}
                </td>
                <td rowspan="2" style="border: 1px solid; border-collapse: collapse;">
                    Modelo:
                </td>
                <td rowspan="2" colspan="2" style="border: 1px solid; border-collapse: collapse;">
                    N° serie cilindro:
                </td>
            </tr>
            <tr>
                <td colspan="4" style="border: 1px solid; border-collapse: collapse;">
                    Tipo de conversion:
                </td>
                <td colspan="2" style="border: 1px solid; border-collapse: collapse;">
                    Sistema de combustible:
                </td>
            </tr>

            <tr>
                <td style="border: 1px solid; border-collapse: collapse;">
                    dedicado a
                    <br>
                    gas
                </td>
                <td style="border: 1px solid; border-collapse: collapse;">

                </td>
                <td style="border: 1px solid; border-collapse: collapse;">
                    Bi-Combustible
                </td>
                <td style="border: 1px solid; border-collapse: collapse;">

                </td>
                <td  style="border: 1px solid; border-collapse: collapse;">
                    Carburador
                </td>
                <td  style="border: 1px solid; border-collapse: collapse;">
                    Inyección
                </td>
                <td rowspan="2" style="border: 1px solid; border-collapse: collapse;">
                    N° regulador:
                </td>
                <td rowspan="2"  style="border: 1px solid; border-collapse: collapse;">
                    Capacidad (L):
                </td>
                <td rowspan="2"  style="border: 1px solid; border-collapse: collapse;">
                    Fecha de fabricación:
                </td>
            </tr>
            <tr>
                <td colspan="6" style="border: 1px solid; border-collapse: collapse;">
                    (NTP 111.015-2004) / C- Conforme / NC- No conforme / N.A No aplica
                </td>
            </tr>
        </table>
        <img  src="{{public_path('/images/vehiculo.png')}}" width="110" height="110" style="float: right; margin-right:30px"/> 
    </section>
    

    <br clear="left">
    
    
        <table style=" width:100%;padding: 0; box-sizing:border-box; font-size: 7px; text-align: start;">
            <tr>
                <td>

                    <!--TABLA LADO IZQUIERDO-->
                    <table style="border: 1px solid; border-collapse: collapse;width: 8.7cm" align="left">

                        <tr>
                            <th style="border: 1px solid; border-collapse: collapse;">
                                ART.
                            </th>
                            <th style="border: 1px solid; border-collapse: collapse;">
                                REQUISITO
                            </th>
                            <th style="border: 1px solid; border-collapse: collapse;">
                                ESPECIFICACIONES
                            </th>
                            <th style="border: 1px solid; border-collapse: collapse;">
                                ESTADO
                            </th>
                        </tr>
                        <tr>
                            <td colspan="4" style="border: 1px solid; border-collapse: collapse;text-align:center;background-color: cadetblue;">
                                <strong >CERTIFICADOS DE CONFORMIDAD</strong>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Cilindros para almacenamiento de GNC
                            </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Certificado del fabricante de cilindros: Análisis químico cuantitativo
                                del material utilizado.<br>
                                Resultado de ensayo físico sobre probetas.<br>
                                Resultados de ensayos físicos sobre probetas Resultado ensayo aplastamiento sobre un cilindro terminado.<br>
                                Control dimensiones: peso, volumen, diámetro, longitud, espesores.<br>
                                Certificado de aprobación del Lote Importado Descripción técnica de fabricación Recomendaciones para el montaje y uso del cilindro, de los controles 
                                periódicos e información derivada de la experiencia en el uso de los mismos.<br>
                            </td>
                            <td style="border: 1px solid; border-collapse: collapse; float:center; text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Tuberías, reductor de presión, mezclador de gas, mangueras, válvulas, accesorios, instrumentos de medición y control.							
							</td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Certificado de fabricación de equipos: Recomendaciones para el montaje de equipo Controles periódicos e informáticos derivada de la 
                                experiencia en el uso de los mismos.				
				            </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Válvulas: de cierre manual. Solanoides de retención.De llenado. De cierre automático. Selector de combustible.
                                <br>
                                Regulador de Presión. Mezclador /Carburador							
					         </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Deben cumplir con los requisitos especiﬁca- dos por las normas de fabricación nacionales al existieran o internacionales aplicables.				
				            </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>
                        
                        <tr>
                            <td rowspan="2" style="border: 1px solid; border-collapse: collapse; text-align: center;">
                                5.6.3.2
                                <br>
                                5.6.4.1
                                <br>
                                5.6.3.3
                            </td>
                            <td rowspan="2" style="border: 1px solid; border-collapse: collapse;">
                                Cilindros, accesorios partes, piezas y demás equipos nuevos							
							</td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                "Habilitados por PRODUCE
                                Registrados en la base de datos del sistema de control de camara de GNV"				
				            </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>
                                
                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                "Instalados para la marca y modelo vehicular
                                recomendado por el proveedor de equipos completos- PEC"				
                            </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>                          
                        </tr>

                        <tr>
                            <td colspan="4" style="border: 1px solid; border-collapse: collapse;text-align:center;background-color: cadetblue;">
                                <strong >CONSTANCIAS</strong>
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Pre-Inspección							
					         </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Previamente el taller debió inspeccionar el estado del vehículo, para efectos de realizar el montaje sin inconvenientes.				
			
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Garantía por el trabajo de montaje de la instalación							
							</td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Previamente el taller debió inspeccionar el estado del vehículo, para efectos de realizar el montaje sin inconvenientes.				
				            </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Manual de usuario							
							</td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Manual de instrucción, operación y mantenimiento del vehículo convertido.				
				            </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td colspan="4" style="border: 1px solid; border-collapse: collapse;text-align:center;background-color: cadetblue;">
                                <strong >CILINDROS</strong>
                            </td>
                        </tr>

                        <tr>
                            <td rowspan="2" style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                2.3
                            </td>
                            <td rowspan="2" style="border: 1px solid; border-collapse: collapse;">
                                Generalidades							
							</td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Fabricados, identificados y probados de acuerdo con normas nacionales, si existieran o aquellos que reconocida aceptación 
                                internacional en lo que a GNC se refiere.				
				            </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                Construidos para operar una presión normal de 200 bar.				
                            </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Presión de operación							
							</td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Deben de operar una presión normal de trabajo de 200 bar a 21+°C				
                            </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Ubicación						
							</td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Una vez instalado, no estar modiﬁcados, ni alterados				
				            </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td rowspan="11" style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td rowspan="11" style="border: 1px solid; border-collapse: collapse;">
                                Instalación de cilindros						
							</td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                No instalados en el techo ni dentro del comportamiento del motor.				
				            </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;">
                               En forma permanente y ne posición horizontal				
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                No se permite el uso de cilindros intercambiables			
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Anclaje acuerdo que evite su desplazamiento, resbalamiento o rotación				
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                No se debe producir esfuerzos indebidos sobre el recipiente no sobre los accesorios vinculados a el				
				            </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;">
                               "El método para montar el cilindro debe de evitar el debilitamiento signiﬁcativo de la estructura del 
                               vehículo y se debe añadir un refuerzo, si es necesario"				
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Soporta una carga ocho veces el paso del recipiente lleno o en cualquier otra dirección.				
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                No debe soldarse ningún elemento al cilindro			
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;">
                               Debe evitar el contacto del cilindro con el vehículo o con cualquier elemento metálico				
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Debe utilizarse caucho como elemento de separación entre el herraje y el cilindro		
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Disponer por los menos dos cuñas o soporte de apoyo, aptas para resistir la carga estática y solicitantes dinámicas: así como dos sunchos de ﬁjación aptos para resistir la carga dinámica.				
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td colspan="4" style="border: 1px solid; border-collapse: collapse;text-align:center;background-color: cadetblue;">
                                <strong >DISPOSITIVOS DE SUJECIÓN DE CILINDROS</strong>
                            </td>
                        </tr>

                        <tr>
                            <td rowspan="3" style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td rowspan="3" style="border: 1px solid; border-collapse: collapse;">
                                Materiales			
							</td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Perﬁl de acero revestidos contra la corrosión.			
				            </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Cada pieza en contacto con el recipiente será electroquímicamente compatible con el cilindro.				
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Las  cunas,  los  suchos  y  otros  componentes metálicos, concepto de los pernos, deben ser de acero estructural de calidad comercial con una
                                resistencia mínima a la tracción de 34 Kg/002.				
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr >
                            <td style="height: 66px; border: 1px solid white"></td>
                            <td style="height: 66px; border: 1px solid white"></td>
                            <td style="height: 66px; border: 1px solid white"></td>
                            <td style="height: 66px; border: 1px solid white"></td>
                        </tr>

                    </table>

                </td>
                <td style="width: 3px;"></td>
                <td >

                    <!--TABLA LADO DERECHO-->
                    <table style="border: 1px solid; border-collapse: collapse; width: 8.7cm;" align="right">
                        <tr>
                            <th style="border: 1px solid; border-collapse: collapse;">
                                ART.
                            </th>
                            <th style="border: 1px solid; border-collapse: collapse;">
                                REQUISITO
                            </th>
                            <th style="border: 1px solid; border-collapse: collapse;">
                                ESPECIFICACIONES
                            </th>
                            <th style="border: 1px solid; border-collapse: collapse;">
                                ESTADO
                            </th>
                        </tr>

                        <tr>
                            <td rowspan="5" style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td rowspan="5" style="border: 1px solid; border-collapse: collapse;">
                                Cilindro de hasta 110 kg.		
							</td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Ancho de sunchos mínima a la tracción de 30 mm			
				            </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>                            
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Espesor de sunchos mínimo 3mm			
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>                            
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Las variables admitidas (anchos y espesor) tendrán como producto una sección equivalente a 90mm2?			
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>                            
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Deben tener mínimo cuatro pernos de acero de W 7/16 pulgadas x 14 hilos por pulgada, con sus correspondientes arandelas de presión y tuerca			
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>                            
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Se aceptan pernos con roscas diferentes, siendo el diámetro mínimo 10mm			
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td rowspan="3" style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td rowspan="3" style="border: 1px solid; border-collapse: collapse;">
                                Cilindro de más de 110 kg.		
							</td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Ancho de sunchos mínimo 45mm				
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                N.A
                            </td>
                        </tr>

                        <tr>                            
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Espesor de sunchos mínimo 5mm		
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                N.A
                            </td>
                        </tr>

                        <tr>                            
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Las variables admitidos (ancho y  espesor)  tendrán como producto una sección equivalente a 225m2.  Deben
                                de tener mínimo cuarto de pernos de acero W1. 2x12 hilos por pulgada, con sus correspondientes arandelas de presión y tuerca.Se aceptan pernos con roscas diferentes, siendo el diámetro mínimo 10mm			
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                N.A
                            </td>
                        </tr>

                        <tr>
                            <td rowspan="3" style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td rowspan="3" style="border: 1px solid; border-collapse: collapse;">
                                Plantillas de Refuerzo	
	                        </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Se aceptan pernos con roscas diferentes siendo el diámetro mínimo 12mm			
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>                            
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Diseñadas para colocarlas en el exterior de la zona dinde se apoya la cuna reforzada		
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>                            
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Deben se ser como mínimo del espesor y ancho de las cinas de formas sustancialmente cuadrada cuando tengan mas de un agujero			
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td rowspan="2" style="border: 1px solid; border-collapse: collapse;text-align: center;">
                               
                            </td>
                            <td rowspan="2" style="border: 1px solid; border-collapse: collapse;">
                                Materiales metálicos no resistentes a la corroción	
	                        </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Tratamiento superficial: pintado, zincado, cromado, etc.			
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>                            
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Color de acabado: negro
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Pernos	
							</td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                De acero forjado o =50Kg/mm2			
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Tuercas	
							</td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                De acero forjado o =24Kg/mm2			
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td rowspan="3" style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td rowspan="3" style="border: 1px solid; border-collapse: collapse;">
                                Protección anterior del cilindro
	                        </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Planchas de elastómetro adherido en forma permanente a las cunas y sunchos de sujeción.			
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>                            
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Ningún punto del cilindro en contacto con partes metálicas del dispositivo de sujeción		
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>                            
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Planchas de elastómetro con espesor mínimo de 3mm y estan min. 5mm por ollado en el ancho de los soporte metálicos			
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td colspan="4" style="border: 1px solid; border-collapse: collapse;text-align:center;background-color: cadetblue;">
                                <strong >MONTAJE DE CILINDROS</strong>
                            </td>
                        </tr>

                        <tr>
                            <td rowspan="4" style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td rowspan="4" style="border: 1px solid; border-collapse: collapse;">
                                Cilindros de hasta    110 Kg. de peso
	                        </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Fijados al vehículo con 2 sunchos como mínimo	
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>                            
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Ancho mínimo de los sunchos 30mm	
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>                            
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Espesor de los soportes que le confiaran una resistencia equivalente ala de una barra de acero común de 90mm2 de sección		
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>                            
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Diámetro de los pernos 10mm			
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td rowspan="4" style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td rowspan="4" style="border: 1px solid; border-collapse: collapse;">
                                Cilindros de mas de 110 Kg. de peso
	                        </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Fijados al vehículo con 2 sunchos como mínimo	
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>                            
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Ancho mínimo de los sunchos 45mm		
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>                            
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Espesor de los soportes que le confiara equivalente a la de una barra de acero común de 225mm2 de  sección
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>                            
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Diámetro de los pernos 12mm	
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td colspan="4" style="border: 1px solid; border-collapse: collapse;text-align:center;background-color: cadetblue;">
                                <strong >CILINDROS EN COMPARTIMIENTO DE PASAJEROS</strong>
                            </td>
                        </tr>

                        <tr>
                            <td rowspan="3" style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td rowspan="3" style="border: 1px solid; border-collapse: collapse;">
                                Generalidades
	                        </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Dentro de un compartimiento adecuadamente diseñado
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>                            
                            <td style="border: 1px solid; border-collapse: collapse;">
                                El extremo del cilindro que contiene la válvula y demás accesorios deberá encerrarse dentro de una ceja resistente con un venteo al exterior del vehículo		
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>                            
                            <td style="border: 1px solid; border-collapse: collapse;">
                                El disco de ruptura deberá ventear por un tubo de acero directamente al exterior del vehículo.
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td rowspan="4" style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td rowspan="4" style="border: 1px solid; border-collapse: collapse;">
                                Venteos
	                        </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                El disco de ruptura deberá ventear por un tubo de acero directamente al exterior del vehículo.	
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>                            
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Como alternativa puede ventearse el gas hacia el exterior del vehículo conforma se hace en los montajes de cilindros en comportamiento de pasajeros.		
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>                            
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Tubos ﬂexibles construidos con material no inﬂamable o auto extinguible.
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>                            
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Expulsan el gas hacia la parte externa inferior del automotor a través de conductos encaminados y herméticos con sección o 
                                menor a 1100mm2. No deben descargar en la zona de guardafangos.
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Cilindro instalado longitudinalmente
	                        </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Posee un medio adecuado para absorber y transmitir a la estructura del vehículo cualquier embestida.
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                C
                            </td>
                        </tr>      
                        
                        <tr>
                            <td colspan="4" style="border: 1px solid; border-collapse: collapse;text-align:center;background-color: cadetblue;">
                                <strong >CILINDROS ENTRE EJES DEL VEHÍCULO</strong>
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Distancia mínima al suelo de la distancia entre ejes < 3175
	                        </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Vehículo con la máxima carga establecida, tomada desde el cilindro o desde cualquier accesorio, al que esta más bajo mínimo 175 mm
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                N.A
                            </td>
                        </tr> 

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Distancia mínima al suelo
	                        </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Vehículo con la máxima carga establecida, tomada desde el cilindro o desde cualquier accesorio, al que esta mas bajo Mínimo 225 mm
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                N.A
                            </td>
                        </tr> 

                        <tr>
                            <td colspan="4" style="border: 1px solid; border-collapse: collapse;text-align:center;background-color: cadetblue;">
                                <strong >CILINDROS DETRAS DEL EJE TRASERO</strong>
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Debajo de la estructura, con saliente trasera de hasta 1125 mm
	                        </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Distancia mínima al suelo =200mm
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                N.A
                            </td>
                        </tr> 

                        <tr>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                6.4.2.3
                            </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Debajo de la estructura, a más de 1125 mm detrás de la línea
	                        </td>
                            <td style="border: 1px solid; border-collapse: collapse;">
                                Mínimo 0.18 veces la distancia entre la línea central del eje posterior y la línea central del fondo recipiente
			                </td>
                            <td style="border: 1px solid; border-collapse: collapse;text-align: center;">
                                N.A
                            </td>
                        </tr> 



                    </table>

                </td>
            </tr>
        </table>
        <p></p>
        <br clear="left">
        
        <table style="width:100%;padding: 0; box-sizing:border-box; font-size: 7px; text-align: start;">
            <tr>
                <!--TABLA LADO IZQUIERDO-->
                <td>
                    <table style="border: 1px solid; border-collapse: collapse;width: 8.7cm" align="left">
                        <tr>
                            <th style="border: 1px solid; border-collapse: collapse;">
                                ART.
                            </th>
                            <th style="border: 1px solid; border-collapse: collapse;">
                                REQUISITO
                            </th>
                            <th style="border: 1px solid; border-collapse: collapse;">
                                ESPECIFICACIONES
                            </th>
                            <th style="border: 1px solid; border-collapse: collapse;">
                                ESTADO
                            </th>
                        </tr>
                    </table>
                </td>

                <td style="width: 3px;"></td>
               
                <!--TABLA LADO DERECHO-->
                <td >
                    <table style="border: 1px solid; border-collapse: collapse; width: 8.7cm;" align="right">
                        <tr>
                            <th style="border: 1px solid; border-collapse: collapse;">
                                ART.
                            </th>
                            <th style="border: 1px solid; border-collapse: collapse;">
                                REQUISITO
                            </th>
                            <th style="border: 1px solid; border-collapse: collapse;">
                                ESPECIFICACIONES
                            </th>
                            <th style="border: 1px solid; border-collapse: collapse;">
                                ESTADO
                            </th>
                        </tr>
                    </table>                    
                </td>
            </tr>
        </table>
    
       
</body>
</html>