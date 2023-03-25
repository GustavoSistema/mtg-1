<div>
    <div class="sm:px-6 w-full">
        <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->
                    <div class="px-4 md:px-10 py-4 md:py-7">
                        <div class="flex items-center justify-between">
                            <p tabindex="0" class="focus:outline-none text-base sm:text-lg md:text-xl lg:text-2xl font-bold leading-normal text-gray-800">Lista de Salidas</p>
                            <div class="py-3 px-4 flex items-center text-sm font-medium leading-none text-gray-600 bg-gray-200 hover:bg-gray-300 cursor-pointer rounded">
                                <p>ordenar por:</p>
                                <select aria-label="select" class="focus:text-indigo-600 focus:outline-none bg-transparent ml-1">
                                    <option class="text-sm text-indigo-800">Latest</option>
                                    <option class="text-sm text-indigo-800">Oldest</option>
                                    <option class="text-sm text-indigo-800">Latest</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
                        <div class="sm:flex items-center justify-between">
                            <div class="flex items-center">
                                <a class="rounded-full focus:outline-none focus:ring-2  focus:bg-indigo-50 focus:ring-indigo-800" href=" javascript:void(0)">
                                    <div class="py-2 px-8 bg-indigo-100 text-indigo-700 rounded-full">
                                        <p>All</p>
                                    </div>
                                </a>
                                <a class="rounded-full focus:outline-none focus:ring-2 focus:bg-indigo-50 focus:ring-indigo-800 ml-4 sm:ml-8" href="javascript:void(0)">
                                    <div class="py-2 px-8 text-gray-600 hover:text-indigo-700 hover:bg-indigo-100 rounded-full ">
                                        <p>Done</p>
                                    </div>
                                </a>
                                <a class="rounded-full focus:outline-none focus:ring-2 focus:bg-indigo-50 focus:ring-indigo-800 ml-4 sm:ml-8" href="javascript:void(0)">
                                    <div class="py-2 px-8 text-gray-600 hover:text-indigo-700 hover:bg-indigo-100 rounded-full ">
                                        <p>Pending</p>
                                    </div>
                                </a>
                            </div>
                            <a href="{{route('asignacion')}}" class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-amber-400 hover:bg-amber-500 focus:outline-none rounded">
                                <p class="text-sm font-medium leading-none text-white">Asignar Materiales</p>
                            </a>
                        </div>
                        <div class="mt-7 overflow-x-auto">
                            <table class="w-full whitespace-nowrap">
                                <thead class="bg-slate-700 border-b font-bold text-white">
                                    <tr>
                                        <th scope="col"
                                            class="text-sm font-medium font-semibold px-6 py-4 text-left">
                                            #
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium font-semibold  px-6 py-4 text-left">
                                            CODIGO
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium font-semibold px-6 py-4 text-left">
                                            Ingresado por:
                                        </th>
                                        <th scope="col" class="text-sm font-medium font-semibold px-6 py-4 text-left">
                                            Asignado a:
                                        </th>                                        
                                        <th scope="col"
                                            class="text-sm font-medium font-semibold px-6 py-4 text-left">
                                            Estado
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium font-semibold px-6 py-4 text-left">
                                            Fecha
                                        </th>
                                        <th scope="col" class="text-sm font-medium font-semibold px-6 py-4 text-left">
                                            Cargo
                                        </th>
                                        <th scope="col" class="text-sm font-medium font-semibold px-6 py-4 text-left">
                                            Acción
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($salidas as $key=>$salida)                                    
                                    <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                                        <td class="pl-5">
                                            <div class="flex items-center">
                                                <div class="bg-gray-200 rounded-sm w-5 h-5 flex flex-shrink-0 justify-center items-center relative">
                                                    {{($key + 1) }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="pl-2">
                                            <div class="flex items-center">
                                                <p class="text-base font-medium leading-none text-gray-700 mr-2">{{$salida->numero}}</p>                                                
                                            </div>
                                        </td>
                                        <td class="pl-2">
                                            <div class="flex items-center">                                                
                                                <p class="text-sm leading-none text-gray-600 ml-2">{{$salida->usuarioCreador->name}}</p>
                                            </div>
                                        </td>
                                        <td class="pl-2">
                                            <div class="flex items-center">                                                
                                                <p class="text-sm leading-none text-gray-600 ml-2">{{$salida->usuarioAsignado->name}}</p>
                                            </div>
                                        </td>                                       
                                        <td class=" text-center mx-auto">
                                            <div class="flex items-center tex-center justify-center">                                               
                                                @switch($salida->estado)
                                                    @case(1)
                                                        <p class="text-sm rounded-md leading-none p-2 text-blue-700 bg-blue-200">En envio</p>
                                                        @break
                                                    @case(2)
                                                        <p class="text-sm rounded-md leading-none p-2 text-white bg-red-400">Rechazado</p>
                                                        @break
                                                    @case(3)
                                                        <p class="text-sm rounded-md leading-none p-2 text-green-700 bg-green-200">Recepcionado</p>
                                                        @break
                                                    @default
                                                        <p class="text-sm rounded-md leading-none text-gray-600 ml-2">Sin datos</p>
                                                @endswitch
                                            </div>
                                        </td>
                                        <td class="pl-2">
                                            <p class="py-1  text-sm  leading-none text-amber-700 bg-amber-100 rounded text-center">
                                                {{ $salida->created_at->format('d/m/Y  h:i a') }}</p>
                                        </td>
                                        <td class="pl-4">
                                            <a 
                                            class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-gray-600 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none"
                                             target="__blank" href="{{route('generaCargo', ['id' => $salida->id])}}" rel="noopener noreferrer">Ver PDF <i class="fas fa-file-pdf"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <div class="relative  pt-2 items-center" x-data="{ menu: false }">
                                                <button class="focus:ring-2 rounded-md focus:outline-none" role="button" x-on:click="menu = ! menu" id="menu-button" aria-expanded="true" aria-haspopup="true" data-te-ripple-init data-te-ripple-color="light"
                                                    aria-label="option">
                                                    <svg class="dropbtn" 
                                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 20 20" fill="none">
                                                        <path
                                                            d="M4.16667 10.8332C4.62691 10.8332 5 10.4601 5 9.99984C5 9.5396 4.62691 9.1665 4.16667 9.1665C3.70643 9.1665 3.33334 9.5396 3.33334 9.99984C3.33334 10.4601 3.70643 10.8332 4.16667 10.8332Z"
                                                            stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                        <path
                                                            d="M10 10.8332C10.4602 10.8332 10.8333 10.4601 10.8333 9.99984C10.8333 9.5396 10.4602 9.1665 10 9.1665C9.53976 9.1665 9.16666 9.5396 9.16666 9.99984C9.16666 10.4601 9.53976 10.8332 10 10.8332Z"
                                                            stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                        <path
                                                            d="M15.8333 10.8332C16.2936 10.8332 16.6667 10.4601 16.6667 9.99984C16.6667 9.5396 16.2936 9.1665 15.8333 9.1665C15.3731 9.1665 15 9.5396 15 9.99984C15 10.4601 15.3731 10.8332 15.8333 10.8332Z"
                                                            stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                    </svg>
                                                </button>
                                                <div x-show="menu" x-on:click.away="menu = false" class="dropdown-content bg-white shadow w-56 absolute z-30 right-0 mr-6">
                                                    <div tabindex="0"
                                                        class="focus:outline-none focus:text-amber-500 text-xs w-full hover:bg-slate-700 py-2 px-6 cursor-pointer hover:text-white">
                                                        <p>Eliminar Salida</p>
                                                    </div>
                                                    <div tabindex="1"
                                                        class="focus:outline-none focus:text-amber-500 text-xs w-full hover:bg-slate-700 py-2 px-6 cursor-pointer hover:text-white">
                                                        <p>Ver detalle</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>                                    
                                    <tr class="h-3"></tr>  
                                    @endforeach                                                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    
</div>
