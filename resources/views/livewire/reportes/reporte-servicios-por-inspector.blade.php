<div>
    <div class="w-full pt-3">
       
        <div class="-mx-12 w-full pt-2  mt-2 bg-indigo-100 px-4 text-center mx-auto">
            <h1 class="text-2xl text-indigo-500 font-bold italic text-center py-4">REPORTE DE SERVICIOS POR INSPECTOR</h1>
            <div class="w-full  items-center md:flex md:flex-row md:justify-center space-x-2">             
                <div class="flex items-center space-x-2">
                    <div class="flex bg-white items-center p-2 w-1/2 md:w-48 rounded-md mb-4 ">
                        <span>Desde: </span>
                        <x-date-picker wire:model="fechaInicio" placeholder="Fecha de inicio"
                            class="bg-gray-50 mx-2 border-indigo-500 rounded-md outline-none ml-1 block w-full truncate" />
                    </div>
                    <div class="flex bg-white items-center p-2 w-1/2 md:w-48 rounded-md mb-4 ">
                        <span>Hasta: </span>
                        <x-date-picker wire:model="fechaFin" placeholder="Fecha de Fin"
                            class="bg-gray-50 mx-2 border-indigo-500 rounded-md outline-none ml-1 block w-full truncate" />
                    </div>
                </div>

                <button wire:click="generarReporte"
                    class="bg-indigo-600 px-6 py-4 w-full md:w-auto rounded-md text-white font-semibold tracking-wide cursor-pointer mb-4">
                    <p class="truncate"> Generar reporte </p>
                </button>
            </div>
            <div class="w-auto my-4">                
                <x-jet-input-error for="fechaInicio" />
                <x-jet-input-error for="fechaFin" />
            </div>
            @if (isset($services))           
            @if($services->count())                                    
                    
                    <div class="flex flex-row my-4 py-4 rounded-md bg-white px-4 justify-center">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 mx-12 w-full">
                            <div class="inline-block min-w-full py-2 sm:px-6 ">
                                <div class="overflow-hidden">
                                    <table class="min-w-full border text-center text-sm font-light dark:border-neutral-500">
                                        <thead class="border-b font-medium dark:border-neutral-500">
                                            <tr class="bg-indigo-200">
                                                <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                                                    #
                                                </th>
                                                <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                                                    Inspector
                                                </th>
                                                <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                                                    Servicios en Gasolution
                                                </th>
                                                <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                                                    Servicios en Sistema
                                                </th>                                       
                                            </tr>
                                        </thead>                                
                                        <tbody>
                                            @foreach ($services as $key=>$item) 
                                                @if($item->serviciosMtg < 1)
                                                <tr class="border-b dark:border-neutral-500 bg-orange-200">
                                                    <td class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                                                        {{ $key+1 }}
                                                    </td>
                                                    <td class="whitespace-nowrap border-r px-6 py-4 font-medium dark:border-neutral-500">
                                                        {{ $item->certificador}}
                                                    </td>
                                                    <td class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                                                        {{ $item->serviciosGasolution }}
                                                    </td>
                                                    <td class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                                                        {{ $item->serviciosMtg }}
                                                    </td>                                                    
                                                </tr>
                                                @else
                                                <tr class="border-b dark:border-neutral-500">
                                                    <td class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                                                        {{ $key+1 }}
                                                    </td>
                                                    <td class="whitespace-nowrap border-r px-6 py-4 font-medium dark:border-neutral-500">
                                                        {{ $item->certificador}}
                                                    </td>
                                                    <td class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                                                        {{ $item->serviciosGasolution }}
                                                    </td>
                                                    <td class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                                                        {{ $item->serviciosMtg }}
                                                    </td>                                                    
                                                </tr>                                                    
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>                                  
            @endif
            @endif
        </div>
    </div>
</div>
