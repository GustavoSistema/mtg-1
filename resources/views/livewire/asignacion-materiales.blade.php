<div>
    <div class="container block justify-center m-auto py-12" >
        <h1 class="text-2xl text-center">Asignacion de Materiales</h1>

        
            <div class="rounded-xl m-4 bg-white p-8 mx-auto max-w-max shadow-lg">
                <div class="flex flex-row">
                    <div class="w-5/6">
                        <x-jet-label value="Inspector:" for="Inspector"/>
                            <select wire:model="inspector" class="bg-gray-50 mx-2 border-indigo-500 rounded-md outline-none ml-1 block w-full ">
                                <option value="0">Seleccione</option>
                                @foreach ($inspectores as $inspector)
                                    <option value="{{ $inspector->id }}">{{ $inspector->name }}</option> 
                                @endforeach                             
                            </select>
                        <x-jet-input-error for="inspector"/>   
                    </div>                                       
                        @livewire('create-asignacion')
                </div> 
                <x-jet-input-error for="articulos"/>
                <div class="m-4">
                    @if($articulos)         
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
                                                <th scope="col" class="text-sm font-medium font-semibold text-gray-900 px-6 py-4 text-left">
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
                                                        {{$articulo['nombreTipo']}}
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        {{$articulo['cantidad']}}
                                                    </td>
                                                    <td
                                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        <a wire:click="deleteArticulo({{$key}})" class="hover: cursor-pointer p-4" ><i class="fas fa-times" ></i>
                                                        </td></a>
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
                    <button class="p-3 bg-indigo-500 rounded-xl text-white text-sm hover:font-bold hover:bg-indigo-700" wire:click="guardar">Aceptar</button>
                    @if($ruta)
                        <a href="{{ $ruta }}" target="__blank" class="p-3 bg-sky-500 rounded-xl text-white text-sm hover:font-bold hover:bg-sky-700 ml-2" >ver PDF</a>
                    @endif
                </div>                                        
            </div>           
    </div>
</div>
