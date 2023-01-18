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
                    <x-jet-input type="text" wire:model="numSugerido" type="number" />
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
                        tabindex="0" role="button">desing</a>
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
                        @foreach ($equipos as $e)
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
                                                <a class="bg-amber-300 p-4 rounded-xl hover:bg-amber-500 hover:cursor-pointer"><i
                                                        class="fas fa-edit"></i></a>
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
                                                <a class="bg-amber-300 p-4 rounded-xl hover:bg-amber-500 hover:cursor-pointer"><i
                                                        class="fas fa-edit"></i></a>
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
                                                <p>Capacidad: <strong>{{ $e['capacidad'] }}</strong></p>
                                            </div>
                                            <div class="bg w-1/6 flex justify-end items-center">
                                                <a class="bg-amber-300 p-4 rounded-xl hover:bg-amber-500 hover:cursor-pointer"><i
                                                        class="fas fa-edit"></i></a>
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
    @endif
    @if(isset($servicioCertificado))
    <div class="max-w-5xl m-auto bg-white rounded-lg shadow-md my-4">
        <h1>{{$servicioCertificado}}</h1>
    </div>
    @endif
    {{-- BOTONES--}}     
    <div class="m-auto py-6 w-full flex justify-center">
        <div class="inline-flex rounded-md shadow-lg shadow-indigo-500/50" role="group">
            <button type="button" wire:click="certificar"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-900 bg-transparent border border-indigo-900 rounded-l-lg hover:bg-indigo-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-indigo-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                <i class="fas fa-file-signature"></i>&nbsp;
                Certificar
            </button>
            <button type="button" wire:click="salvaEquipos"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-900 bg-transparent border-t border-r border-b border-indigo-900 hover:bg-indigo-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-indigo-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                <i class="fas fa-eye"></i>&nbsp;
                ver PDF
            </button>
            <button type="button"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-900 bg-transparent border-t border-b  border-indigo-900 hover:bg-indigo-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-indigo-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                <svg aria-hidden="true" class="w-4 h-4 mr-2 fill-current" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z"
                        clip-rule="evenodd"></path>
                </svg>
                Descargar PDF
            </button>
            <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-900 bg-transparent border border-indigo-900 rounded-r-md hover:bg-indigo-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-indigo-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                <i class="fas fa-archive"></i>&nbsp;
                Finalizar
            </button>
        </div>
    </div>


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

    @push('js')
    <script>
        Livewire.on('deshabilitar', ()=> {
            let datosV=document.getElementById("datosVehiculo");
            var selects=datosV.querySelectorAll('select')
            var textinputs = datosV.querySelectorAll('input');
            for (var i = 0; i < textinputs.length; ++i) { 
                textinputs[i].disabled= true;
            }
            for (var i = 0; i < selects.length; ++i) { 
                selects[i].disabled= true;
            }
        });
    </script>
    @endpush
</div>
