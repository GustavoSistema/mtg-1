<div>
    <div class="sm:px-6 w-full pt-12 pb-4">
        <x-custom-table>
            <x-slot name="titulo">
                <h2 class="text-indigo-600 font-bold text-3xl">
                    <i class="fa-solid fa-square-poll-vertical fa-xl"></i>                    
                     &nbsp;REPORTE GENERAL DE SERVICIOS GNV                       
                </h2> 
            </x-slot>

            <x-slot name="btnAgregar">                
            </x-slot>
            
            <x-slot name="contenido"> 
                <div class="md:flex md:flex-row md:space-x-2 w-full sm:justify-between items-center">
                    <div class="flex bg-gray-50 items-center p-2 rounded-md md:mb-4 ">
                        <span>Taller: </span>
                        <select wire:model="taller"
                            class="bg-gray-50 mx-2 border-indigo-500 rounded-md outline-none ml-1 block w-full truncate">
                            <option value="">SELECCIONE</option>
                            @isset($talleres)
                                @foreach ($talleres as $taller)
                                    <option class="" value="{{ $taller }}">{{ $taller }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>   
                    <div class="flex bg-white items-center p-2 rounded-md md:mb-4 ">
                        <span>Inspector: </span>
                        <select wire:model="ins" class="bg-gray-50 mx-2 border-indigo-500 rounded-md outline-none ml-1 block w-full truncate">
                            <option value="">SELECCIONE</option>
                            @isset($inspectores)
                            @foreach($inspectores as $inspector)
                                <option value="{{$inspector}}">{{$inspector}}</option>
                            @endforeach
                            @endisset
                        </select>               
                    </div>
                    <div class="flex items-center w-full space-x-2">
                        <div class="flex bg-white items-center p-2 w-1/2 md:w-48 rounded-md mb-4 ">
                            <span>Desde: </span>
                            <x-date-picker wire:model="fecIni" placeholder="Fecha de inicio" class="bg-gray-50 mx-2 border-indigo-500 rounded-md outline-none ml-1 block w-full truncate"/>             
                        </div>
        
                        <div class="flex bg-white items-center p-2 w-1/2 md:w-48 rounded-md mb-4 ">
                            <span>Hasta: </span>
                            <x-date-picker wire:model="fecFin" placeholder="Fecha de Fin" class="bg-gray-50 mx-2 border-indigo-500 rounded-md outline-none ml-1 block w-full truncate"/>             
                        </div>
                    </div> 
                </div>
                                  
            @if ($importados->count())                
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-x-auto">
                            <table class="min-w-full leading-normal rounded-md">
                                <thead>
                                    <tr>
                                        <th class=" w-24 cursor-pointer hover:font-bold hover:text-indigo-500 px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                            wire:click="order('id')">
                                            Id
                                            @if ($sort == 'id')
                                                @if ($direction == 'asc')
                                                    <i class="fas fa-sort-numeric-up-alt float-right mt-0.5"></i>
                                                @else
                                                    <i class="fas fa-sort-numeric-down-alt float-right mt-0.5"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort float-right mt-0.5"></i>
                                            @endif
                                        </th>
                                        <th class="cursor-pointer hover:font-bold hover:text-indigo-500  px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                            wire:click="order('certificador')">
                                            Inspector
                                            @if ($sort == 'certificador')
                                                @if ($direction == 'asc')
                                                    <i class="fas fa-sort-alpha-up-alt float-right mt-0.5"></i>
                                                @else
                                                    <i class="fas fa-sort-alpha-down-alt float-right mt-0.5"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort float-right mt-0.5"></i>
                                            @endif
                                        </th>  
                                        <th class="cursor-pointer hover:font-bold hover:text-indigo-500  px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                            wire:click="order('taller')">
                                            Taller
                                            @if ($sort == 'taller')
                                                @if ($direction == 'asc')
                                                    <i class="fas fa-sort-alpha-up-alt float-right mt-0.5"></i>
                                                @else
                                                    <i class="fas fa-sort-alpha-down-alt float-right mt-0.5"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort float-right mt-0.5"></i>
                                            @endif
                                        </th>  
                                        <th class="cursor-pointer hover:font-bold hover:text-indigo-500  px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                            wire:click="order('tipoServicio')">
                                            Tipo Servicio
                                            @if ($sort == 'tipoServicio')
                                                @if ($direction == 'asc')
                                                    <i class="fas fa-sort-numeric-up-alt float-right mt-0.5"></i>
                                                @else
                                                    <i class="fas fa-sort-numeric-down-alt float-right mt-0.5"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort float-right mt-0.5"></i>
                                            @endif
                                        </th> 
                                        <th class="cursor-pointer hover:font-bold hover:text-indigo-500  px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                            wire:click="order('placa')">
                                            Placa
                                            @if ($sort == 'placa')
                                                @if ($direction == 'asc')
                                                    <i class="fas fa-sort-numeric-up-alt float-right mt-0.5"></i>
                                                @else
                                                    <i class="fas fa-sort-numeric-down-alt float-right mt-0.5"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort float-right mt-0.5"></i>
                                            @endif
                                        </th>    
                                        <th class="cursor-pointer hover:font-bold hover:text-indigo-500  px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                            wire:click="order('fecha')">
                                            Fecha
                                            @if ($sort == 'fecha')
                                                @if ($direction == 'asc')
                                                    <i class="fas fa-sort-numeric-up-alt float-right mt-0.5"></i>
                                                @else
                                                    <i class="fas fa-sort-numeric-down-alt float-right mt-0.5"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort float-right mt-0.5"></i>
                                            @endif
                                        </th>        
                                        {{--                           
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                        --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($importados as $item)
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center">
                                                    <p class="text-indigo-900 p-1 bg-indigo-200 rounded-md">
                                                        {{ $item->id }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center">
                                                    <p
                                                        class="text-slate-900 font-semibold whitespace-no-wrap">
                                                        {{ $item->certificador }}
                                                    </p>
                                                </div>
                                            </td>    
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center">
                                                    <p
                                                        class="whitespace-no-wrap">
                                                        {{ $item->taller}}
                                                    </p>
                                                </div>
                                            </td>  
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center">
                                                    <p
                                                        class="whitespace-no-wrap">
                                                        {{ $item->TipoServicio->descripcion }}
                                                    </p>
                                                </div>
                                            </td>    
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center">
                                                    <p
                                                        class="whitespace-no-wrap uppercase">
                                                        {{ $item->placa}}
                                                    </p>
                                                </div>
                                            </td>      
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center">
                                                    <p
                                                        class="whitespace-no-wrap">
                                                        {{Carbon\Carbon::parse($item->fecha)->format('d-m-Y h:m a')}}
                                                    </p>
                                                </div>
                                            </td>
                                            {{--                               
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center justify-center">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        <button wire:click="editarPermiso({{$item->id}})"
                                                            class="px-2 py-2 bg-indigo-600 rounded-md flex items-center justify-center">
                                                            <i class="fas fa-pen text-white"></i>
                                                        </button>
                                                    </p>
                                                </div>
                                            </td>
                                            --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                    @if ($importados->hasPages())
                        <div>
                            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-2 overflow-x-auto">
                                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                                    <div class="px-5 py-5 bg-white border-t">
                                        {{ $importados->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
            @else
                <div class="px-6 py-4 text-center font-bold bg-indigo-200 rounded-md">
                    No se encontro ningun registro.
                </div>
            @endif
            </x-slot> 
        </x-custom-table>
    </div>
</div>
