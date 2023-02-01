<div>
    
    
    
    <x-table-certificaciones>
        
        @if ($certificaciones->count())
        {{--
            @foreach ($certificaciones as $certificacion)
            <div>
                <p>{{json_encode($certificacion)}}</p>
            </div>
            @endforeach
        --}}
            <table class="w-full whitespace-nowrap">
                <thead class="bg-slate-600 border-b font-bold text-white">
                    <tr>
                        <th scope="col" class="text-sm font-medium font-semibold text-white px-6 py-4 text-left">
                            #
                        </th>
                        <th scope="col" class="text-sm font-medium font-semibold text-white px-6 py-4 text-left">
                            Inspector
                        </th>
                        <th scope="col" class="text-sm font-medium font-semibold text-white px-6 py-4 text-left">
                            Servicio
                        </th>
                        <th scope="col" class="text-sm font-medium font-semibold text-white px-6 py-4 text-left">
                            Taller
                        </th>
                        <th scope="col" class="text-sm font-medium font-semibold text-white px-6 py-4 text-left">
                            Placa
                        </th>
                        <th scope="col" class="text-sm font-medium font-semibold text-white px-6 py-4 text-left">
                            N° Formato
                        </th>
                        <th scope="col" class="text-sm font-medium font-semibold text-white px-6 py-4 text-left">
                            Fecha
                        </th>
                        <th scope="col" class="text-sm font-medium font-semibold text-white px-6 py-4 text-left">
                            Acciones
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($certificaciones as $certificacion)
                        <tr tabindex="0" class="focus:outline-none h-16 border border-slate-300 rounded">
                            <td class="pl-5">
                                <div class="flex items-center">
                                    <div
                                        class="bg-indigo-200 rounded-sm w-5 h-5 flex flex-shrink-0 justify-center items-center relative text-indigo-900">
                                        {{ $certificacion->id }}
                                    </div>
                                </div>
                            </td>
                            <td class="pl-2">
                                <div class="flex items-center">
                                    <p class="text-sm font-medium leading-none text-gray-600 mr-2">
                                        {{ $certificacion->inspector }}
                                    </p>
                                </div>
                            </td>
                            <td class="pl-2">
                                <div class="flex items-center">
                                    @switch($certificacion->tipoServicio)
                                        @case(1)
                                            <p class="text-sm leading-none text-gray-600 ml-2 p-2 bg-green-200 rounded-full">
                                                Conversion a GNV
                                            </p>
                                        @break

                                        @case(2)
                                            <p class="text-sm leading-none text-gray-600 ml-2 p-2 bg-green-200 rounded-full">
                                                Revision anual GNV
                                            </p>
                                        @break

                                        @case(3)
                                            <p class="text-sm leading-none text-gray-600 ml-2 p-2 bg-orange-200 rounded-full">
                                                Conversion a GLP
                                            </p>
                                        @break

                                        @case(4)
                                            <p class="text-sm leading-none text-gray-600 ml-2 p-2 bg-orange-200 rounded-full">
                                                Revision anual GLP
                                            </p>
                                        @break

                                        @default
                                            <p class="text-sm leading-none text-gray-600 ml-2">
                                                No se encontro datos
                                            </p>
                                    @endswitch

                                </div>
                            </td>
                            <td class="pl-2">
                                <div class="flex items-center">
                                    <p class="text-sm leading-none text-gray-600 ml-2">
                                        {{ $certificacion->taller }}</p>
                                </div>
                            </td>
                            <td class="pl-2">
                                <div class="flex items-center">
                                    <p class="text-sm font-bold  text-indigo-700 ml-2">
                                        {{ $certificacion->placa }}</p>
                                </div>
                            </td>
                            <td class="">
                                <div class="flex items-center justify-center">
                                    <p class="text-sm font-semibold  text-gray-600 p-1 bg-orange-100 rounded-full">{{ $this->obtieneNumeroHoja($certificacion->id); }}</p>
                                </div>
                            </td>
                            <td class="pl-2">
                                <button
                                    class="py-3 px-3 text-sm focus:outline-none leading-none text-sky-700 bg-sky-100 rounded">{{ $certificacion->created_at }}</button>
                            </td>
                            <td class="pl-4">
                                <div class="relative flex justify-center px-5">
                                    <div x-data="{ dropdownMenu: false }" class="relative">
                                        <!-- Dropdown toggle button -->
                                        <button @click="dropdownMenu = ! dropdownMenu"
                                            class="flex items-center p-2 border border-slate-300  bg-gray-300/50  rounded-md">
                                            <span class="mr-4 text-indigo-700">Seleccione <i
                                                    class="fas fa-sort-down -mt-2"></i></span>
                                        </button>
                                        <!-- Dropdown list -->
                                        <div x-show="dropdownMenu"
                                            class="absolute py-2 mt-2 border border-indigo-300/50  bg-slate-300 rounded-md shadow-xl w-44 z-10 ">

                                            <a href="{{ $this->generarRuta($certificacion->id) }}" target="__blank"
                                                class="block px-4 py-2 text-sm text-indigo-700 hover:bg-slate-600 hover:text-white">
                                                <i class="fas fa-eye "></i> Ver Certificado
                                            </a>
                                            <a href="{{ $this->generarRutaDescarga($certificacion->id) }}"
                                                class="block px-4 py-2 text-sm text-indigo-700 hover:bg-slate-600 hover:text-white">
                                                <i class="fas fa-file-download"></i> <span>Desc. Certificado</span>
                                            </a>
                                            <a href="{{ route('fichaTecnicaGnv',[$certificacion->id])}}" target="__blank"
                                                class="block px-4 py-2 text-sm text-indigo-700 hover:bg-slate-600 hover:text-white">
                                                <i class="fas fa-eye "></i> ver Ficha Técnica
                                            </a>
                                            <a href="{{ route('descargarFichaTecnicaGnv',[$certificacion->id])}}"
                                                class="block px-4 py-2 text-sm text-indigo-700 hover:bg-slate-600 hover:text-white">
                                                <i class="fas fa-file-download"></i> Desc. Ficha Técnica
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="h-3"></tr>
                    @endforeach
                </tbody>
            </table>

            @if ($certificaciones->hasPages())
                    
                        <div class="w-full  py-2 overflow-x-auto">
                            <div class="inline-block min-w-full shadow-lg border border-slate-300 bg-slate-500/ overflow-hidden">
                                <div class="py-4 px-2 bg-white ">
                                    {{ $certificaciones->withQueryString()->links()}}
                                </div>
                            </div>
                        </div>
                    
                @endif
        
        @else
        <div class="p-4 w-full bg-indigo-300 items-center flex justify-center">
            <p class="text-indigo-900 font-bold">No se encontro ningúna certificación</p>
        </div>
        @endif


    </x-table-certificaciones>
    
</div>
