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
                        @livewire('agregar-articulo-prestamo',["disponibles"=>$disponibles], key($disponibles->count()))            
                               
                    </div>
                    <x-jet-input-error for="articulos" />
                    <div class="m-4">
                        @if (count($articulos))
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
                                                                @switch($articulo["tipo"])
                                                                    @case(1)
                                                                        {{ $articulo['inicio'] . ' - ' . $articulo['final'] }}
                                                                    @break
                                                                    @case(2)
                                                                        N/A
                                                                    @break
                                                                    @case(3)
                                                                        {{ $articulo['inicio'] . ' - ' . $articulo['final'] }}
                                                                    @break
                                                                    @default                                                                        
                                                                @endswitch                                                               
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
                        wire:click="guardar" wire:loading.attribute="disabled" wire:target="guardar">
                            Aceptar
                        </button>                           
                    </div>
                </div>
            @break
            

            @default
        @endswitch
                  
                <p>TODOS: {{var_export($todo->count())}}</p>
                <br>
                <p>DISPONIBLES {{var_export($disponibles->count())}}</p>
                <br>
                <br>
                @if(isset($seleccionados))
                <p>SELECCIONADOS: {{var_export($seleccionados->count())}}</p>
                @endif
                <br>                
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

   
</div>
