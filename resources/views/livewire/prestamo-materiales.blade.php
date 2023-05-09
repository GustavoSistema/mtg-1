<div>
    <div class="container block justify-center m-auto py-12" wire:loading.remove>
        <h1 class="text-2xl text-center">Prestamo de materiales</h1>
        @switch($estado)
            @case(1)
                <div class="rounded-xl m-4 bg-white p-8 mx-auto max-w-max shadow-lg">
                    <div class="flex flex-row">
                        <div class="w-5/6">
                            <x-jet-label value="Inspector:" for="Inspector" />
                            <select wire:model="inspector"
                                class="bg-gray-50 mx-2 border-indigo-500 rounded-md outline-none ml-1 block w-full ">
                                <option value="0">Seleccione</option>
                                @foreach ($inspectores as $inspector)
                                    <option value="{{ $inspector->id }}" class="uppercase">{{ $inspector->name }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="inspector" />
                        </div> 
                        <div class="pt-7">
                            <a wire:click="$set('open',true)" class="ml-6 bg-amber-500 px-6 py-3  mt-4 rounded-md text-white font-semibold tracking-wide hover:cursor-pointer">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>                       
                    </div>
                    <x-jet-input-error for="articulos" />
                    <div class="m-4">
                        @if ($articulos)
                            <div class="flex flex-col">
                                <div class="overflow-x-auto sm:mx-0.5">
                                    <div class="py-2 inline-block min-w-full ">
                                        <div class="overflow-hidden">
                                            <table class="min-w-full">
                                                <thead class="bg-indigo-300 border-b">
                                                    <tr>
                                                        <th scope="col"
                                                            class="text-sm font-medium font-semibold text-gray-900 px-6 py-4 text-left">
                                                            #
                                                        </th>
                                                        <th scope="col"
                                                            class="text-sm font-medium font-semibold text-gray-900 px-6 py-4 text-left">
                                                            Material
                                                        </th>
                                                        <th scope="col"
                                                            class="text-sm font-medium font-semibold text-gray-900 px-6 py-4 text-left">
                                                            Cantidad
                                                        </th>
                                                        <th scope="col"
                                                            class="text-sm font-medium font-semibold text-gray-900 px-6 py-4 text-left">
                                                            Series
                                                        </th>
                                                        <th scope="col"
                                                            class="text-sm font-medium font-semibold text-gray-900 px-6 py-4 text-left">
                                                            Motivo
                                                        </th>
                                                        <th scope="col"
                                                            class="text-sm font-medium font-semibold text-gray-900 px-6 py-4 text-left">
                                                            Acción
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($articulos as $key => $articulo)
                                                        <tr class="bg-gray-100 border-b">
                                                            <td
                                                                class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{ $key + 1 }}
                                                            </td>
                                                            <td
                                                                class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{ $articulo['nombreTipo'] }}
                                                            </td>
                                                            <td
                                                                class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{ $articulo['cantidad'] }}
                                                            </td>
                                                            <td
                                                                class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{ $articulo['inicio'] . ' - ' . $articulo['final'] }}
                                                            </td>
                                                            <td
                                                                class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{ $articulo['motivo'] }}
                                                            </td>
                                                            <td
                                                                class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                <a wire:click="deleteArticulo({{ $key }})"
                                                                    class="hover: cursor-pointer p-4"><i
                                                                        class="fas fa-times hover:text-red-500"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                    </div>
                    <div class="flex items-center justify-center">
                        <button class="p-3 bg-indigo-500 rounded-xl text-white text-sm hover:font-bold hover:bg-indigo-700"
                            wire:click="guardar">Aceptar</button>
                        @if ($ruta)
                            <a href="{{ $ruta }}" target="__blank"
                                class="p-3 bg-sky-500 rounded-xl text-white text-sm hover:font-bold hover:bg-sky-700 ml-2">ver
                                PDF</a>
                        @endif
                    </div>
                </div>
            @break
            

            @default
        @endswitch
                {{var_export($stocks)}}
    </div>
    <div class="hidden w-full h-screen flex flex-col justify-center items-center bg-gray-200 " wire:loading.remove.class="hidden">     
        <div class="flex">
            <img src="{{ asset('images/mtg.png') }}" alt="Logo Motorgas Company" width="150" height="150">
        </div>
        <div class="text-center">
            <i class="fa-solid fa-circle-notch fa-xl animate-spin text-indigo-800 "></i>
          
            <p class="text-center text-black font-bold italic">CARGANDO...</p>
        </div>
        <div class="flex">
        </div>
    </div>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title" class="font-bold">
            <h1 class="text-xl font-bold">Agregar Articulo</h1>
        </x-slot>
        <x-slot name="content">
            <div>
                
                <x-jet-label value="articulo:" />
                    <select wire:model="tipoM" class="bg-gray-50 border-indigo-500 rounded-md outline-none block w-full">
                        <option value="">Seleccione</option>
                        @foreach ($stocks as $tipo)
                            <option value="{{ $tipo }}">{{ $tipo.' - ( '.$tipo.' )'}}</option>
                        @endforeach
                    </select>             
                 <x-jet-input-error for="tipoM" />
            </div>            
              

                
            @switch($tipoM)
                @case(1)
                {{--
                    <div>
                        <x-jet-label value="Grupo:" for="guia" />
                        <select wire:model="guia" class="bg-gray-50 border-indigo-500 rounded-md outline-none block w-full " wire:loading.attr="disabled" wire:target="tipoM">
                            <option value="">Seleccione</option>   
                            @if($guias->count()>1)            
                                    @foreach ($guias as $key=>$item)
                                        <option wire:ignore value="{{ $item->grupo }}">{{$item->grupo." - ( stock: ".$item->stock.' )'}}</option>                                  
                                    @endforeach
                            @endif                       
                        </select>                      
                        <x-jet-input-error for="guia" />
                    </div>  
                --}}                   
                    <div>
                        <x-jet-label value="Cantidad:" />
                            <x-jet-input type="number" class="w-full" wire:model="cantidad" />
                        <x-jet-input-error for="cantidad" />
                    </div>                   
                    <div>
                        <x-jet-label value="N° de inicio" />
                        <x-jet-input type="number" class="w-full" wire:model="numInicio" />
                        <x-jet-input-error for="numInicio" />
                    </div>
                    <div>
                        <x-jet-label value="N° de Final" />
                        <x-jet-input type="number" class="w-full" wire:model="numFinal" enable />
                        <x-jet-input-error for="numFinal" />
                    </div>
                     <div class="mb-4">
                        <x-jet-label value="Motivo:" />
                        <select wire:model="motivo"
                            class="bg-gray-50 border-indigo-500 rounded-md outline-none  block w-full ">
                            <option value="0">Seleccione</option>
                            <option value="Solicitud de material">Solicitud de material</option>
                            <option value="Cambio">Cambio</option>  
                            <option value="Otro">Otro</option>                   
                        </select>
                        <x-jet-input-error for="motivo" />
                    </div> 
                @break
                @case(2)
                    <div>
                        <x-jet-label value="Cantidad:" />
                        <x-jet-input type="number" class="w-full" wire:model="cantidad" />
                        <x-jet-input-error for="cantidad" />
                    </div>
                @break

                @case(3)
                <div class="mb-4 -mr-2">
                    <x-jet-label value="Cantidad:" />
                    <x-jet-input type="number" class="w-full" wire:model="cantidad"/>
                    <x-jet-input-error for="cantidad" />
                </div> 
                @break
                @default
                <div class="p-4 bg-indigo-300 rounded-md my-4">
                    <h1 class="text-center font-bold text-red-600">Selecciona un tipo de articulo</h1>
                </div>
                   
            @endswitch
           
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)" class="mx-2">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button wire:click="addArticulo" wire:loading.attr="disabled" wire:target="agregar">
                Agregar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
