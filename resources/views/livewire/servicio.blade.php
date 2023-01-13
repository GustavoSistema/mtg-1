<div class="block  justify-center mt-8">
    <h1 class="text-center font-xl my-4"> REALIZAR NUEVO SERVICIO</h1>
    <div class="max-w-5xl m-auto bg-white rounded-lg shadow-md my-4">
        <div class=" bg-indigo-200 rounded-lg py-4 px-2 grid grid-cols-1 gap-8 sm:grid-cols-2">
            <div>
                <x-jet-label value="Taller:" for="serv"/>
                <select wire:model="taller" class="bg-gray-50 mx-2 border-indigo-500 rounded-md outline-none ml-1 block w-full ">
                    <option value="">Seleccione</option>
                    @foreach ($talleres as $taller)
                        <option value="{{ $taller->id }}">{{ $taller->nombre}}</option> 
                    @endforeach                             
                </select>              
                <x-jet-input-error for="taller"/>
            </div>
            <div>
                <x-jet-label value="Servicio:" for="serv"/>
                <select wire:model="serv" class="bg-gray-50 border-indigo-500 rounded-md outline-none block w-full " wire:loading.attr="disabled" wire:target="taller">
                    
                    @if(isset($servicios))
                        <option value="">Seleccione </option>
                        @foreach ($servicios as $item)
                            <option value="{{ $item->id }}">{{ $item->tipoServicio->descripcion}}</option> 
                        @endforeach  
                    @else
                        <option value="">Seleccione un taller</option>
                    @endif                           
                </select>              
                <x-jet-input-error for="serv"/>
            </div>
                                       
        </div>
    </div>
    {{--DATOS DEL VEHICULO--}}
    @if($serv)
    <div class="max-w-5xl m-auto  bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="flex items-center justify-between bg-gray-400 py-4 px-6 rounded-t-lg">
            <span class="text-lg font-semibold text-white dark:text-gray-400">Datos del vehículo</span>
            <a class="px-3 py-1 text-sm font-bold text-gray-100 transition-colors duration-300 transform bg-gray-600 rounded cursor-pointer hover:bg-gray-500" tabindex="0" role="button">Design</a>
        </div>    
        <div class="mt-2 mb-6 px-8 py-4">           
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-3">
                <div>
                    <x-jet-label value="Placa:"/>
                    <x-jet-input type="text" class="w-full" wire:model="placa" />
                    <x-jet-input-error for="placa"/>
                </div>
    
                <div>
                    <x-jet-label value="Categoria:"/>
                    <x-jet-input type="text" class="w-full" wire:model="categoria" />
                    <x-jet-input-error for="categoria"/>
                </div>
    
                <div>
                    <x-jet-label value="Marca:"/>
                    <x-jet-input type="text" class="w-full" wire:model="marca" />
                    <x-jet-input-error for="marca"/>
                </div>
    
                <div>
                    <x-jet-label value="Modelo:"/>
                    <x-jet-input type="text" class="w-full" wire:model="modelo" />
                    <x-jet-input-error for="modelo"/>
                </div>
                <div>
                    <x-jet-label value="Version:"/>
                    <x-jet-input type="text" class="w-full" wire:model="version" />
                    <x-jet-input-error for="version"/>
                </div>
                <div>
                    <x-jet-label value="año de fabricación:"/>
                    <x-jet-input type="text" class="w-full" wire:model="anioFab" />
                    <x-jet-input-error for="anioFab"/>
                </div>

                <div>
                    <x-jet-label value="VIN / N° Serie:"/>
                    <x-jet-input type="text" class="w-full" wire:model="numSerie" />
                    <x-jet-input-error for="numSerie"/>
                </div>
                <div>
                    <x-jet-label value="N° Serie Motor:"/>
                    <x-jet-input type="text" class="w-full" wire:model="numMotor" />
                    <x-jet-input-error for="numMotor"/>
                </div>
                <div class="flex flex-row justify-center">
                    <div class="w-1/2">
                        <x-jet-label value="Cilindros:"/>
                        <x-jet-input type="text" class="w-5/6" wire:model="cilindros" />
                        <x-jet-input-error for="cilindros"/>
                    </div>
                    <div class="w-1/2">
                        <x-jet-label value="Cilindrada:"/>
                        <x-jet-input type="text" class="w-5/6" wire:model="cilindrada" />
                        <x-jet-input-error for="cilindrada"/>
                    </div>
                </div>
                <div>
                    <x-jet-label value="Combustible:"/>
                    <x-jet-input type="text" class="w-full" wire:model="combustible" />
                    <x-jet-input-error for="combustible"/>
                </div>
                <div class="flex flex-row">
                    <div class="w-1/2">
                        <x-jet-label value="Ejes:"/>
                        <x-jet-input type="text" class="w-5/6" wire:model="ejes" />
                        <x-jet-input-error for="ejes"/>
                    </div>
                    <div class="w-1/2">
                        <x-jet-label value="Ruedas:"/>
                        <x-jet-input type="text" class="w-5/6" wire:model="ruedas" />
                        <x-jet-input-error for="ruedas"/>
                    </div>
                </div>  
                <div class="flex flex-row">
                    <div class="w-1/2">
                        <x-jet-label value="Asientos:"/>
                        <x-jet-input type="text" class="w-5/6" wire:model="asientos" />
                        <x-jet-input-error for="asientos"/>
                    </div>
                    <div class="w-1/2">
                        <x-jet-label value="Pasajeros:"/>
                        <x-jet-input type="text" class="w-5/6" wire:model="pasajeros" />
                        <x-jet-input-error for="pasajeros"/>
                    </div>
                </div> 
                <div class="flex flex-row w-full justify-center m-auto">
                    <div class="w-1/3">
                        <x-jet-label value="Largo:"/>
                        <x-jet-input type="text" class="w-5/6" wire:model="largo" />
                        <x-jet-input-error for="largo"/>
                    </div>
                    <div class="w-1/3">
                        <x-jet-label value="Ancho:"/>
                        <x-jet-input type="text" class="w-5/6" wire:model="ancho" />
                        <x-jet-input-error for="ancho"/>
                    </div>
                    <div class="w-1/3">
                        <x-jet-label value="Altura:"/>
                        <x-jet-input type="text" class="w-5/6" wire:model="altura" />
                        <x-jet-input-error for="altura"/>
                    </div>
                </div> 
                <div>
                    <x-jet-label value="Color:"/>
                    <x-jet-input type="text" class="w-full" wire:model="color" />
                    <x-jet-input-error for="color"/>
                </div>                
                <div class="flex flex-row w-full justify-center m-auto">
                    <div class="w-1/3">
                        <x-jet-label value="Peso Neto:"/>
                        <x-jet-input type="text" class="w-5/6" wire:model="pesoNeto" />
                        <x-jet-input-error for="pesoNeto"/>
                    </div>
                    <div class="w-1/3">
                        <x-jet-label value="Peso Bruto:"/>
                        <x-jet-input type="text" class="w-5/6" wire:model="pesoBruto" />
                        <x-jet-input-error for="pesoBruto"/>
                    </div>
                    <div class="w-1/3">
                        <x-jet-label value="Carga Util:"/>
                        <x-jet-input type="text" class="w-5/6" wire:model="cargaUtil" />
                        <x-jet-input-error for="cargaUtil"/>
                    </div>
                </div> 
                           
            </div>
            <div class="my-8 flex flex-row justify-between">
                <a wire:click="guardaVehiculo" class="hover:cursor-pointer  my-4 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-amber-400 hover:bg-amber-500 focus:outline-none rounded">
                    <p class="text-sm font-medium leading-none text-white">Guardar vehículo</p>
                </a> 
                @if (isset($ruta))
                <a href="{{$ruta}}" class="hover:cursor-pointer  my-4 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-400 hover:bg-amber-500 focus:outline-none rounded">
                    <p class="text-sm font-medium leading-none text-white">Ver PDF</p>
                </a>
                @endif
                
            </div>
            
        </div>       
    </div>
    @endif
    {{--DATOS DE LOS EQUIPOS--}}
    <div class="max-w-5xl m-auto bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="flex items-center justify-between bg-gray-400 py-4 px-6 rounded-t-lg">
            <span class="text-lg font-semibold text-white dark:text-gray-400">Datos de los equipos de GNV</span>
            <a class="px-3 py-1 text-sm font-bold text-gray-100 transition-colors duration-300 transform bg-gray-600 rounded cursor-pointer hover:bg-gray-500" tabindex="0" role="button">❌</a>
        </div>
        <div class="mt-2 mb-6 px-8 py-4">
            <h1 class="text-xl font-semibold text-indigo-500 underline">Cilindros:</h1>
            <div class=" bg-indigo-200 rounded-lg py-4 px-2 grid grid-cols-1 gap-8 mt-4 sm:grid-cols-5">
                <div>
                    <x-jet-label value="Marca:"/>
                    <x-jet-input type="text" class="w-full" wire:model="cil.marca" />
                    <x-jet-input-error for="cil.marca"/>
                </div>
                <div>
                    <x-jet-label value="N° Serie:"/>
                    <x-jet-input type="text" class="w-full" wire:model="cil.serie" />
                    <x-jet-input-error for="cil.serie"/>
                </div>
                <div>
                    <x-jet-label value="Año de Fabricación:"/>
                    <x-jet-input type="text" class="w-full" wire:model="cil.anioFab" />
                    <x-jet-input-error for="cil.anioFab"/>
                </div> 
                <div>
                    <x-jet-label value="Capacidad:"/>
                    <x-jet-input type="text" class="w-full" wire:model="cil.capacidad" />
                    <x-jet-input-error for="cil.anioFab"/>
                </div> 
                <div>
                    <x-jet-label value="Peso:"/>
                    <x-jet-input type="text" class="w-full" wire:model="cil.peso" />
                    <x-jet-input-error for="cil.anioFab"/>
                </div>                
            </div>
            <div class=" bg-indigo-200 rounded-lg py-4 px-2 grid grid-cols-1 gap-8 mt-4 sm:grid-cols-5">
                <div>
                    <x-jet-label value="Marca:"/>
                    <x-jet-input type="text" class="w-full" wire:model="cil.marca" />
                    <x-jet-input-error for="cil.marca"/>
                </div>
                <div>
                    <x-jet-label value="N° Serie:"/>
                    <x-jet-input type="text" class="w-full" wire:model="cil.serie" />
                    <x-jet-input-error for="cil.serie"/>
                </div>
                <div>
                    <x-jet-label value="Año de Fabricación:"/>
                    <x-jet-input type="text" class="w-full" wire:model="cil.anioFab" />
                    <x-jet-input-error for="cil.anioFab"/>
                </div> 
                <div>
                    <x-jet-label value="Capacidad:"/>
                    <x-jet-input type="text" class="w-full" wire:model="cil.capacidad" />
                    <x-jet-input-error for="cil.anioFab"/>
                </div> 
                <div>
                    <x-jet-label value="Peso:"/>
                    <x-jet-input type="text" class="w-full" wire:model="cil.peso" />
                    <x-jet-input-error for="cil.anioFab"/>
                </div>                
            </div>
            <h1 class="text-xl mt-4 font-semibold text-indigo-500 underline">Reductor:</h1>

            <div class=" bg-indigo-200 rounded-lg py-4 px-2 grid grid-cols-1 gap-8 mt-4 sm:grid-cols-2">
                <div>
                    <x-jet-label value="Marca:"/>
                    <x-jet-input type="text" class="w-full" wire:model="reductor.marca" />
                    <x-jet-input-error for="reductor.marca"/>
                </div>
                <div>
                    <x-jet-label value="N° Serie:"/>
                    <x-jet-input type="text" class="w-full" wire:model="reductor.serie" />
                    <x-jet-input-error for="reductor.serie"/>
                </div>                            
            </div>
            <h1 class="text-xl mt-4 font-semibold text-indigo-500 underline">Chip:</h1>
            <div class=" bg-indigo-200 rounded-lg py-4 px-2 grid grid-cols-1 gap-8 mt-4 sm:grid-cols-1">
                <div>
                    <x-jet-label value="N° Serie:"/>
                    <x-jet-input type="text" class="w-full" wire:model="chip.serie" />
                    <x-jet-input-error for="reductor.marca"/>
                </div>                            
            </div>
        </div>
        
        
    </div>
    

</div>
