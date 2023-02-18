<div>
    <x-table-administracion-certificaciones>
        
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
                            Taller
                        </th>
                        <th scope="col" class="text-sm font-medium font-semibold text-white px-6 py-4 text-left">
                            Servicio
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
                            Estado
                        </th>

                        <th scope="col" class="text-sm font-medium font-semibold text-white px-6 py-4 text-left">
                            Documentos
                        </th>
                        <th scope="col" class="text-sm font-medium font-semibold text-white px-6 py-4 text-left">
                            
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
                                        {{ $certificacion->inspector->name }}
                                    </p>
                                </div>
                            </td>
                            <td class="pl-2">
                                <div class="flex items-center">
                                    <p class="text-sm leading-none text-gray-600 ml-2">
                                        {{ $certificacion->taller->nombre }}</p>
                                </div>
                            </td>
                            <td class="pl-2">
                                <div class="flex items-center">
                                    @switch($certificacion->Servicio->tipoServicio->id)
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
                                    <p class="text-sm font-bold  text-indigo-700 ml-2">
                                        {{ $certificacion->placa }}</p>
                                </div>
                            </td>
                            <td class="">
                                <div class="flex items-center justify-center">
                                    <p class="text-sm font-bold  text-red-600  bg-red-100 ">{{ $certificacion->serieFormato }}</p>
                                </div>
                            </td>
                            
                            <td class="pl-2">
                                
                                <p class="text-gray-600 ">{{ $certificacion->created_at->format('d/m/Y  h:m:s') }}</p>
                                
                            </td>

                            <td class="">
                                <div class="flex items-center justify-center">
                                    @switch( $certificacion->estado)
                                        @case(1)
                                            
                                            <i class="far fa-check-circle fa-lg" style="color: forestgreen;"></i>
                                            @break
                                        @case(2)
                                        <i class="far fa-times-circle fa-lg" style="color: red;"></i>
                                            @break
                                        @default                                            
                                    @endswitch
                                </div>
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

                                            <a target="__blank" href="{{ route('checkListArribaGnv',[$certificacion->id])}}"
                                                class="block px-4 py-2 text-sm text-indigo-700 hover:bg-slate-600 hover:text-white">
                                                <i class="fas fa-file-download"></i> CheckList arriba
                                            </a>

                                            <a target="__blank" href="{{ route('checkListAbajoGnv',[$certificacion->id])}}"
                                                class="block px-4 py-2 text-sm text-indigo-700 hover:bg-slate-600 hover:text-white">
                                                <i class="fas fa-file-download"></i> CheckList abajo
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="pl-4">
                                <div class="relative flex justify-center px-5">
                                    {{--
                                    <div x-data="{ dropdownMenu: false }" class="relative">
                                        <!-- Dropdown toggle button -->
                                        <button @click="dropdownMenu = ! dropdownMenu"
                                            class="flex items-center p-2 border border-slate-300  bg-gray-300/50  rounded-md hover:bg-gray-300 hover: border-indigo-300">
                                            <span class="mr-4 text-indigo-700">Seleccione <i
                                                    class="fas fa-sort-down -mt-2"></i></span>
                                        </button>
                                        <!-- Dropdown list -->
                                        <div x-show="dropdownMenu"
                                            class="absolute py-2 mt-2 border border-indigo-300/50  bg-slate-300 rounded-md shadow-xl w-44 z-10 ">

                                            
                                            <a wire:click="$emit('deleteCertificacion',{{ $certificacion->id }})"
                                                class="flex px-4 py-2 text-sm text-indigo-700 hover:bg-slate-600 hover:text-white justify-between items-center">
                                                <i class="fas fa-trash"></i> 
                                                <span>Eliminar servicio</span>
                                            </a>
                                            <a wire:click="$emit('anularCertificacion',{{ $certificacion->id }})"
                                                class="flex px-4 py-2 text-sm text-indigo-700 hover:bg-slate-600 hover:text-white justify-between items-center">
                                                <i class="fas fa-eraser"></i> 
                                                <span>Anular Servicio</span>
                                            </a>
                                        </div>
                                    </div>
                                    --}}
                                    <div class="inline-block text-left" x-data="{ menu: false }">
                                        <button x-on:click="menu = ! menu" type="button" class="flex items-center text-gray-400 hover:text-gray-600 focus:outline-none" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                            <span class="sr-only"></span>
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                            </svg>
                                        </button>
                                        <div x-show="menu" x-on:click.away="menu = false" class="origin-top-right absolute right-12 mt-2 w-56 rounded-md shadow-lg bg-gray-300 ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none z-40" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                            <div class="" role="none">
                                                <a wire:click="$emit('deleteCertificacion',{{ $certificacion->id }})"
                                                    class="flex px-4 py-2 text-sm text-indigo-700 hover:bg-slate-600 hover:text-white justify-between items-center rounded-t-md hover:cursor-pointer">
                                                    <i class="fas fa-trash"></i> 
                                                    <span>Eliminar servicio</span>
                                                </a>
                                            </div>
                                            <div class="" role="none">
                                                <a wire:click="$emit('anularCertificacion',{{ $certificacion->id }})"
                                                    class="flex px-4 py-2 text-sm text-indigo-700 hover:bg-slate-600 hover:text-white justify-between items-center rounded-b-md hover:cursor-pointer">
                                                    <i class="fas fa-eraser"></i> 
                                                    <span>Anular servicio</span>
                                                </a>
                                            </div>
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


    </x-table-administracion-certificaciones>


    @push('js')
        <script>
            Livewire.on('deleteCertificacion', certificacionId => {
                Swal.fire({
                    title: '¿Estas seguro de eliminar este servicio?',
                    text: "una vez eliminado este registro, no podras recuperarlo.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('administracion-certificaciones', 'delete', certificacionId);

                        Swal.fire(
                            'Listo!',
                            'Servicio eliminado correctamente.',
                            'success'
                        )
                    }
                })
            });
        </script>

        <script>
            Livewire.on('anularCertificacion', certificacionId => {
                Swal.fire({
                    title: '¿Seguro que quieres anular este servicio?',
                    text: "Al anular este servicio el formato asociado quedará inutilizable",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('administracion-certificaciones', 'anular', certificacionId);

                        Swal.fire(
                            'Listo!',
                            'Servicio anulado correctamente.',
                            'success'
                        )
                    }
                })
            });
        </script>
    @endpush
</div>
