<div class="block justify-center mt-8 max-h-max">
    <h1 class="text-center text-xl my-4 font-bold text-indigo-900"> REALIZAR NUEVO SERVICIO</h1>    
    <div class="max-w-5xl m-auto bg-white rounded-lg shadow-md my-4">
        <div class=" bg-indigo-200 rounded-lg py-4 px-2 grid grid-cols-1 gap-8 sm:grid-cols-2">
            <div>
                <x-jet-label value="Taller:" for="serv" />
                <select wire:model="taller"
                    class="bg-gray-50 mx-2 border-indigo-500 rounded-md outline-none ml-1 block w-full ">
                    <option value="">Seleccione</option>
                    @foreach ($talleres as $taller)
                        <option value="{{ $taller->id }}">{{ $taller->nombre }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="taller" />
            </div>
            <div>
                <x-jet-label value="Servicio:" for="serv" />
                <select wire:model="serv" class="bg-gray-50 border-indigo-500 rounded-md outline-none block w-full "
                    wire:loading.attr="disabled" wire:target="taller">
                    @if (isset($servicios))
                        <option value="">Seleccione </option>
                        @foreach ($servicios as $item)
                            <option value="{{ $item->id }}">{{ $item->tipoServicio->descripcion }}</option>
                        @endforeach
                    @else
                        <option value="">Seleccione un taller</option>
                    @endif
                </select>
                <x-jet-input-error for="serv" />
            </div>

        </div>
    </div>        
    {{-- DATOS DEL VEHICULO --}}    
    @if ($serv)
        @if ($numSugerido>0)
            <div class="max-w-5xl m-auto bg-white rounded-lg shadow-md my-4 py-4 px-8 flex flex-row justify-between items-center">
                <div class="w-4/6 items-center">
                    <h1 class="font-bold"><span class="p-1 bg-green-300 rounded-lg">Formato Sugerido:</span></h1>
                </div>
                <div class="w-2/6 flex justify-end">
                    <x-jet-input type="text" wire:model="numSugerido" type="text" />
                    <x-jet-input-error for="numSugerido" />
                </div>
            </div>
        @else
            <div class="max-w-5xl m-auto bg-white rounded-lg shadow-md my-4 py-4 bg-red-500/70">
                <h1 class=" w-full text-center text-white">No cuentas con formatos disponibles para realizar este servicio.</h1>
            </div>
        @endif
        
        @if(isset($vehiculoServicio))
            @if($formularioVehiculo)
                <x-form-vehiculo-actualizar/>
            @else
                <x-form-vehiculo-deshabilitado/>
            @endif
        @else
            <x-form-vehiculo-habilitado/>
        @endif   
        @if(isset($tipoServicio))
        {{-- DATOS DE LOS EQUIPOS GNV--}}
            @if($tipoServicio->id == 1 || $tipoServicio->id == 2)
            <div class="max-w-5xl m-auto bg-white rounded-lg shadow-md dark:bg-gray-300 pb-3">
                <div class="flex items-center justify-between bg-gray-400 py-4 px-6 rounded-t-lg">
                    <span class="text-lg font-semibold text-white dark:text-gray-400">Datos de los equipos de GNV</span>
                    <a class="px-3 py-1 text-sm font-bold text-gray-100 transition-colors duration-300 transform bg-gray-600 rounded cursor-pointer hover:bg-gray-500"
                        tabindex="0" role="button">...</a>
                </div>

                <div class="w-full flex flex-row justify-center items-center m-auto py-6">
                    <a wire:click="$set('open',true)"
                        class="hover:cursor-pointer focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-center justify-start px-6 py-3 bg-amber-400 hover:bg-amber-500 focus:outline-none rounded">
                        <p class="text-sm font-medium leading-none text-white"><i
                                class="fas fa-plus-square fa-xl"></i>&nbsp;Agregar
                            Equipos</p>
                    </a>
                </div>

                @if ($equipos)
                    <div>
                        @foreach ($equipos as $key=>$e)
                            @switch($e["idTipoEquipo"])
                                @case(1)
                                    <div class="block  w-5/6 bg-white border border-black p-2 rounded-lg shadow-lg m-auto mb-4">
                                        <div class="flex flex-row w-full">
                                            <div class="block  w-5/6">
                                                <span
                                                    class="bg-teal-200 text-teal-800 text-xs px-2 inline-block rounded-full  uppercase font-semibold tracking-wide">
                                                    <i class="fas fa-microchip"></i>&nbsp;{{ $e['tipo']['nombre'] }}
                                                </span>
                                                <p>Serie: <strong>{{ $e['numSerie'] }}</strong></p>
                                            </div>
                                            <div class="w-1/6 flex justify-end items-center">
                                                <a class="bg-amber-300 p-4 rounded-xl hover:bg-amber-500 hover:cursor-pointer" wire:click="eliminaEquipo({{$key}})">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @break

                                @case(2)
                                    <div class="block  w-5/6 bg-white border border-black p-2 rounded-lg shadow-lg m-auto mb-4">
                                        <div class="flex flex-row w-full">
                                            <div class="block w-5/6">
                                                <span
                                                    class="bg-sky-200 text-sky-800 text-xs px-2 inline-block rounded-full  uppercase font-semibold tracking-wide">
                                                    <i class="fas fa-tenge"></i>&nbsp;{{ $e['tipo']['nombre'] }}
                                                </span>
                                                <p>Serie: <strong>{{ $e['numSerie'] }}</strong></p>
                                                <p>Marca: <strong>{{ $e['marca'] }}</strong></p>
                                                <p>Modelo: <strong>{{ $e['modelo'] }}</strong></p>
                                            </div>
                                            <div class=" w-1/6 flex justify-end items-center">
                                                <a class="bg-amber-300 p-4 rounded-xl hover:bg-amber-500 hover:cursor-pointer" wire:click="eliminaEquipo({{$key}})">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @break

                                @case(3)
                                    <div class="block  w-5/6 bg-white border border-black p-2 rounded-lg shadow-lg m-auto mb-4">
                                        <div class="flex flex-row w-full">
                                            <div class="block bg w-5/6">
                                                <span
                                                    class="bg-orange-400 text-white text-xs px-2 inline-block rounded-full  uppercase font-semibold tracking-wide">
                                                    <i class="fas fa-battery-empty"></i>&nbsp;{{ $e['tipo']['nombre'] }}
                                                </span>
                                                <p>Serie: <strong>{{ $e['numSerie'] }}</strong></p>
                                                <p>Marca: <strong>{{ $e['marca'] }}</strong></p>
                                                <p>Capacidad (L): <strong>{{ $e['capacidad'] }}</strong></p>
                                                <p>Fecha de Fabricación: <strong>{{ date('d/m/Y', strtotime($e['fechaFab']));}}</strong></p>
                                                <p>Peso (KG): <strong>{{ $e['peso'] }}</strong></p>
                                            </div>
                                            <div class="bg w-1/6 flex justify-end items-center">
                                                <a class="bg-amber-300 p-4 rounded-xl hover:bg-amber-500 hover:cursor-pointer" wire:click="eliminaEquipo({{$key}})">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @break

                                @default
                            @endswitch
                        @endforeach
                    </div>
                @endif
            </div>               
            @endif
        @endif


        {{--BOTONES--}}

        <div class="max-w-5xl m-auto bg-white rounded-lg shadow-md my-4 py-4">
            <div class="my-2 flex flex-row justify-evenly items-center">
                @if(!isset($servicioCertificado))
                <a wire:click="certificar"
                    class="hover:cursor-pointer focus:ring-2 focus:ring-offset-2 focus:ring-amber-600 sm:mt-0 inline-flex items-center justify-center px-6 py-3 bg-indigo-400 hover:bg-indigo-500 focus:outline-none rounded">
                    <p class="text-sm font-medium leading-none text-white"><i class="fas fa-file-signature"></i> &nbsp;Generar Certificado</p>
                </a> 
                @endif
                @if(isset($servicioCertificado))
                <a href="{{$ruta}}" target="__blank"
                    class="hover:cursor-pointer focus:ring-2 focus:ring-offset-2 focus:ring-amber-600 sm:mt-0 inline-flex items-center justify-center px-6 py-3 bg-cyan-400 hover:bg-cyan-500 focus:outline-none rounded">
                    <p class="text-sm font-medium leading-none text-white"><i class="fas fa-eye"></i> &nbsp;ver Certificado</p>
                </a> 
                <a href="{{$rutaDes}}" target="__blank"
                    class="hover:cursor-pointer focus:ring-2 focus:ring-offset-2 focus:ring-amber-600 sm:mt-0 inline-flex items-center justify-center px-6 py-3 bg-cyan-600 hover:bg-cyan-700 focus:outline-none rounded">
                    <p class="text-sm font-medium leading-none text-white"><i class="fas fa-file-download"></i> &nbsp;Descargar Certificado</p>
                </a>
                <a href="{{ route('fichaTecnicaGnv',[$servicioCertificado->id])}}" target="__blank"
                    class="hover:cursor-pointer focus:ring-2 focus:ring-offset-2 focus:ring-amber-600 sm:mt-0 inline-flex items-center justify-center px-6 py-3 bg-blue-400 hover:bg-blue-500 focus:outline-none rounded">
                    <p class="text-sm font-medium leading-none text-white"><i class="fas fa-eye"></i> &nbsp;Ver Ficha T.</p>
                </a>
                <a href="{{ route('descargarFichaTecnicaGnv',[$servicioCertificado->id])}}"
                    class="hover:cursor-pointer focus:ring-2 focus:ring-offset-2 focus:ring-amber-600 sm:mt-0 inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 focus:outline-none rounded">
                    <p class="text-sm font-medium leading-none text-white"><i class="fas fa-eye"></i> &nbsp;Descargar Ficha T.</p>
                </a>
                <a href="{{route('servicio')}}" 
                    class="hover:cursor-pointer focus:ring-2 focus:ring-offset-2 focus:ring-amber-600 sm:mt-0 inline-flex items-center justify-center px-6 py-3 bg-red-400 hover:bg-red-500 focus:outline-none rounded">
                    <p class="text-sm font-medium leading-none text-white"><i class="fas fa-archive"></i> &nbsp;Finalizar</p>
                </a>
                @endif            
            </div>        
        </div>
    @endif
      
    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            AGREGAR EQUIPO
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Tipo:" for="taller" />
                <select wire:model="tipoEquipo"
                    class="bg-gray-50 mx-2 border-indigo-500 rounded-md outline-none ml-1 block w-full ">
                    <option value="">Seleccione</option>
                    @if (isset($tiposDisponibles))
                        @foreach ($tiposDisponibles as $tipoE)
                            @if ($tipoE['estado'] == 1)
                                <option value="{{ $tipoE['id'] }}">{{ $tipoE['nombre'] }}</option>
                            @else
                                <option value="{{ $tipoE['id'] }}" disabled>{{ $tipoE['nombre'] }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
                <x-jet-input-error for="tipoEquipo" />
            </div>
            @if (isset($tipoEquipo))
                @switch($tipoEquipo)
                    @case(1)
                        <x-form-chip-gnv>
                        </x-form-chip-gnv>
                    @break

                    @case(2)
                        <x-form-reductor-gnv>
                        </x-form-reductor-gnv>
                    @break

                    @case(3)
                        <x-form-tanque-gnv>
                        </x-form-tanque-gnv>
                    @break

                    @default
                        <div class="p-4 bg-indigo-300 text-center rounded-xl">
                            <p>Seleccione un tipo de equipo</p>
                        </div>
                @endswitch
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)" class="mx-2">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button wire:click="guardaEquipos" wire:loading.attr="disabled" wire:target="guardaEquipos">
                Guardar
            </x-jet-button>
        </x-slot>

    </x-jet-dialog-modal>
    


    <x-jet-dialog-modal wire:model="busqueda">
        <x-slot name="title">
            <h1 class="text-3xl font-medium">vehículos</h1>
        </x-slot>
        <x-slot name="content">          
                @if($vehiculos)
                <p class="text-indigo-900">Se encontrarón <span class="px-2 bg-indigo-400 rounded-full">{{$vehiculos->count()}}</span> vehículos</p>
                    <div class="my-5">
                    @foreach($vehiculos as $key=>$vehiculo)                                          
                            <div class="flex justify-between items-center border-b border-slate-200 py-3 px-2 border-l-4  border-l-transparent bg-gradient-to-r from-transparent to-transparent hover:border-l-4 hover:border-l-indigo-300  hover:from-slate-100 transition ease-linear duration-150">
                                <div class="inline-flex items-center space-x-2">
                                    <div>                               
                                        <i class="fas fa-car"></i>                         
                                    </div>
                                    <div>{{$vehiculo->placa}}</div>
                                    <div>{{$vehiculo->marca}}</div>
                                    <div>{{$vehiculo->modelo}}</div>
                                    <div class="px-2 text-xs text-slate-600">{{$vehiculo->created_at->format('d/m/Y  h:m:s')}}</div>
                                </div>
                                <div>
                                    <i wire:click="seleccionaVehiculo({{$key}})" class="fas fa-plus-circle fa-lg hover: cursor-pointer hover: shadow-lg" style="color:#6366f1;"></i>                             
                                </div>
                            </div>                          
                     @endforeach
                    </div>
                    <p class="text-xs text-slate-500 text-center">Selecciona uno de estos vehiculos para agregarlo a tu certificado.</p>
                @endif
                
               
            
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('busqueda',false)" class="mx-2">
                Cancelar
            </x-jet-secondary-button>            
        </x-slot>

    </x-jet-dialog-modal>
</div>
