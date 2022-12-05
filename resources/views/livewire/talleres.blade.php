<div>
    <div class="container mx-auto py-12">
        <x-table-talleres>
                @if (count($talleres))            
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
                                                    @if ($direction = 'asc')
                                                        <i class="fas fa-sort-alpha-up-alt float-right mt-0.5"></i>
                                                    @else
                                                        <i class="fa-solid fa-arrow-down-a-z float-right mt-0.5"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort float-right mt-0.5"></i>
                                                @endif
                                            </th>
                                            <th class="cursor-pointer hover:font-bold hover:text-indigo-500  px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                                wire:click="order('nombre')">
                                                Nombre    
                                                @if ($sort == 'nombre')
                                                    @if ($direction = 'asc')
                                                        <i class="fas fa-sort-alpha-up-alt float-right mt-0.5"></i>
                                                    @else
                                                        <i class="fa-solid fa-arrow-down-a-z float-right mt-0.5"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort float-right mt-0.5"></i>
                                                @endif
                                            </th>
                                            <th class="cursor-pointer hover:font-bold hover:text-indigo-500 px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                                wire:click="order('direccion')">
                                                Dirección
                                                @if ($sort == 'direccion')
                                                    @if ($direction = 'asc')
                                                        <i class="fas fa-sort-alpha-up-alt float-right mt-0.5"></i>
                                                    @else
                                                        <i class="fa-solid fa-arrow-down-a-z float-right mt-0.5"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort float-right mt-0.5"></i>
                                                @endif
                                            </th>
                                            <th class="cursor-pointer hover:font-bold hover:text-indigo-500 px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                                wire:click="order('ruc')">
                                                Ruc
                                                @if ($sort == 'ruc')
                                                    @if ($direction = 'asc')
                                                        <i class="fas fa-sort-alpha-up-alt float-right mt-0.5"></i>
                                                    @else
                                                        <i class="fa-solid fa-arrow-down-a-z float-right mt-0.5"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort float-right mt-0.5"></i>
                                                @endif
                                            </th>                                           
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($talleres as $item)
                                            <tr>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <div class="flex items-center">
                                                        <p class="text-gray-900 ">
                                                            {{ strtoupper($item->id) }}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <div class="flex items-center">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            {{ $item->nombre }}
                                                        </p>
                                                    </div>
                                                </td>                                            
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">{{ $item->direccion }}</p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <div class="flex items-center">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            {{ $item->ruc }}
                                                        </p>
                                                    </div>
                                                </td>                                               
    
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    {{-- @livewire('edit-usuario', ['usuario' => $usuario], key($usuario->id)) --}}
                                                    <div class="flex justify-end">
                                                        <a class="py-3 px-4 text-center rounded-md bg-lime-300 font-bold text-white cursor-pointer hover:bg-lime-400">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a class="py-3 px-5 text-center ml-2 rounded-md bg-indigo-300 font-bold text-white cursor-pointer hover:bg-indigo-400">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
    
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                {{--
                @if ($talleres->hasPages())
                    <div>
                        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-2 overflow-x-auto">
                            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                                <div class="px-5 py-5 bg-white border-t">
                                    {{ $expedientes->links() }}
                                </div>
                            </div>
                        </div>
                    </div>                        
                @endif
                --}}
            @else
                <div class="px-6 py-4 text-center font-bold bg-indigo-200 rounded-md">
                    No se encontro ningun registro.
                </div>
            @endif   
            </x-table>       
            
           
        </div>
</div>
