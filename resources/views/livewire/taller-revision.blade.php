{{--
<div>
    @if ($expedientes)
        {{$expedientes}}
    @endif
</div>
--}}
<div wire:loading.attr="disabled" wire:target="delete,save">
    <div class="container mx-auto py-12" id="todo">
        <x-table-revision-talleres>
            <table class="w-full whitespace-nowrap">
                <thead class="bg-slate-700 border-b font-bold text-white">
                    <tr>
                        <th scope="col" class="text-sm font-medium font-semibold px-6 py-4 text-left">
                            #
                        </th>
                        <th scope="col" class="text-sm font-medium font-semibold px-6 py-4 text-left">
                            Inspector
                        </th>
                        <th scope="col" class="text-sm font-medium font-semibold px-6 py-4 text-left">
                            Servicio
                        </th>
                        <th scope="col" class="text-sm font-medium font-semibold px-6 py-4 text-left">
                            Placa
                        </th>
                        <th scope="col" class="text-sm font-medium font-semibold px-6 py-4 text-left">
                            # Certificado
                        </th>
                        <th scope="col" class="text-sm font-medium font-semibold px-6 py-4 text-left">
                            Fecha
                        </th>
                        <th scope="col" class="text-sm font-medium font-semibold px-6 py-4 text-left">
                            Estado
                        </th>
                        <th scope="col" class="text-sm font-medium font-semibold px-6 py-4 text-left">
                            Acciones
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($expedientes as $key => $item)
                        <tr tabindex="0" class="focus:outline-none h-16 border border-slate-300 rounded bg-gray-100 hover:bg-gray-300/30">
                            <td class="pl-5">
                                <div class="flex items-center">
                                    <div class="w-5 h-5 flex justify-center items-center">
                                        <p class="bg-green-200 px-1 rounded-sm ">{{ $item->id }}</p>

                                    </div>
                                </div>
                            </td>
                            <td class="pl-2">
                                <div class="flex items-center">
                                    <p class="text-base font-medium leading-none text-gray-700 mr-2">
                                        {{ $item->nombre_inspector }}</p>
                                </div>
                            </td>
                            <td class="pl-2">
                                <div class="flex items-center">
                                    <p class="text-sm leading-none text-gray-600 ml-2">
                                        {{ $item->nombre_servicio }}</p>
                                </div>
                            </td>
                            <td class="pl-2">
                                <div class="flex items-center">
                                    <p class="text-sm leading-none text-indigo-600 ml-2 font-bold">
                                        {{ $item->placa }}
                                    </p>
                                </div>
                            </td>
                            <td class="pl-2">
                                <div class="flex items-center">
                                    <p class="text-sm leading-none text-red-600 ml-2">{{ $item->certificado }}</p>
                                </div>
                            </td>

                            <td class="pl-2">
                                <p class="py-1  text-sm  leading-none text-amber-700 bg-amber-100 rounded text-center">
                                    {{ $item->created_at->format('d/m/Y  h:m') }}</p>
                            </td>
                            <td class="pl-2 text-center ">
                                @switch($item->estado)
                                    @case(1)
                                    
                                        <span
                                            class="relative inline-block px-3 py-1 font-semibold text-orange-900 leading-tight">
                                            <span aria-hidden
                                                class="absolute inset-0 bg-orange-200 opacity-50 rounded-full"></span>
                                            <span class="relative">Por revisar</span>
                                        </span>
                                    
                                @break

                                @case(2)
                                   
                                        <span class="relative inline-block px-3 py-1 font-semibold text-blue-900 leading-tight">
                                            <span aria-hidden
                                                class="absolute inset-0 bg-blue-200 opacity-50 rounded-full"></span>
                                            <span class="relative">Observado</span>
                                        </span>
                                    
                                @break

                                @case(3)
                                    
                                        <span
                                            class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                            <span aria-hidden
                                                class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                            <span class="relative">Aprobado</span>
                                        </span>
                                    
                                @break

                                @case(4)
                                   
                                        <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                            <span aria-hidden
                                                class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                            <span class="relative">Desaprobado</span>
                                        </span>
                                   

                                @default
                                   
                                        <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                            <span aria-hidden
                                                class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                            <span class="relative">Aprobado</span>
                                        </span>
                                    
                            @endswitch
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
                                            class="focus:outline-none focus:text-indigo-600 text-xs w-full hover:bg-indigo-700 py-2 px-6 cursor-pointer hover:text-white">
                                            <p>Ver Expediente</p>
                                        </div>
                                        <div tabindex="1"
                                            class="focus:outline-none focus:text-indigo-600 text-xs w-full hover:bg-indigo-700 py-2 px-6 cursor-pointer hover:text-white">
                                            <p>Delete</p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="h-3"></tr>
                    @endforeach
                </tbody>
            </table>
        </x-table-revision-talleres>
    </div>



    @push('js')
        <script>
            Livewire.on('quitaCheck', () => {
                var textinputs = document.querySelectorAll('input[type=checkbox]');
                for (var i = 0; i < textinputs.length; ++i) {
                    textinputs[i].checked = false;
                }
            });
        </script>
        <script>
            Livewire.on('activaCheck', () => {
                var check = document.querySelector('#activo');
                check.checked = true;
            });
        </script>
        <script>
            window.livewire.on('startDownload', (ruta) => {
                window.open('download/' + ruta, '_blank');
            });
        </script>
    @endpush
</div>
