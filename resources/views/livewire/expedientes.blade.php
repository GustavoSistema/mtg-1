<div wire:init="loadExpedientes">


    <div class="container mx-auto py-12">

        <!-- componente Tabla -->
        <x-table>
            @if (count($expedientes))
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-x-auto">
                            <table class="min-w-full leading-normal rounded-md">
                                <thead>
                                    <tr>
                                        <th class=" w-24 cursor-pointer hover:font-bold hover:text-indigo-500 px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                            wire:click="order('placa')">
                                            Placa
                                            @if ($sort == 'placa')
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
                                            wire:click="order('certificado')">
                                            Certificado

                                            @if ($sort == 'certificado')
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
                                            wire:click="order('created_at')">
                                            Fecha
                                            @if ($sort == 'created_at')
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
                                            wire:click="order('estado')">
                                            Estado
                                            @if ($sort == 'estado')
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
                                    @foreach ($expedientes as $item)
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center">
                                                    <p class="text-gray-900 ">
                                                        {{ strtoupper($item->placa) }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $item->certificado }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">{{ $item->created_at }}</p>
                                            </td>
                                            @switch($item->estado)
                                                @case(1)
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                        <span
                                                            class="relative inline-block px-3 py-1 font-semibold text-orange-900 leading-tight">
                                                            <span aria-hidden
                                                                class="absolute inset-0 bg-orange-200 opacity-50 rounded-full"></span>
                                                            <span class="relative">Por revisar</span>
                                                        </span>
                                                    </td>
                                                @break

                                                @case(2)
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                        <span
                                                            class="relative inline-block px-3 py-1 font-semibold text-blue-900 leading-tight">
                                                            <span aria-hidden
                                                                class="absolute inset-0 bg-blue-200 opacity-50 rounded-full"></span>
                                                            <span class="relative">Observado</span>
                                                        </span>
                                                    </td>
                                                @break

                                                @case(3)
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                        <span
                                                            class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                            <span aria-hidden
                                                                class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                            <span class="relative">Aprobado</span>
                                                        </span>
                                                    </td>
                                                @break

                                                @case(4)
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                        <span
                                                            class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                                            <span aria-hidden
                                                                class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                                            <span class="relative">Desaprobado</span>
                                                        </span>
                                                    </td>
                                                @break

                                                @default
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                        <span
                                                            class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                                            <span aria-hidden
                                                                class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                                            <span class="relative">Aprobado</span>
                                                        </span>
                                                    </td>
                                            @endswitch

                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                {{-- @livewire('edit-usuario', ['usuario' => $usuario], key($usuario->id)) --}}
                                                <div class="flex justify-end">
                                                    <a wire:click="edit({{ $item }})"
                                                        class="py-3 px-4 text-center rounded-md bg-lime-300 font-bold text-white cursor-pointer hover:bg-lime-400">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a wire:click="$emit('deleteExpediente',{{ $item->id }})"
                                                        class="py-3 px-5 text-center ml-2 rounded-md bg-indigo-300 font-bold text-white cursor-pointer hover:bg-indigo-400">
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

            @if ($expedientes->hasPages())
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
        @else
            <div class="px-6 py-4 text-center font-bold bg-indigo-200 rounded-md">
                No se encontro ningun registro.
            </div>
        @endif   
        </x-table>
    </div>

<x-jet-dialog-modal wire:model="editando" wire:loading.attr="disabled" wire:target="deleteFile">
    <x-slot name="title" class="font-bold">
        Editar Expediente
    </x-slot>

    <x-slot name="content">
        <div class="mb-4">
            <select wire:model="expediente.servicio_idservicio"
                class="bg-gray-50 mx-2 border-indigo-500 rounded-md outline-none ml-1 block w-full ">
                <option value="">Seleccione</option>
                <option value="1">Conversión a GNV</option>
                <option value="2">Revisión anual GNV</option>
                <option value="3">Conversión a GLP</option>
                <option value="4">Revisión anual GLP</option>
            </select>
            <x-jet-input-error for="expediente.servicio_idservicio" />
        </div>
        <div class="mb-4">
            <x-jet-label value="Placa:" />
            <x-jet-input type="text" class="w-full" wire:model="expediente.placa" />
            <x-jet-input-error for="expediente.placa" />
        </div>
        <div class="mb-4">
            <x-jet-label value="Certificado:" />
            <x-jet-input type="text" class="w-full" wire:model="expediente.certificado" />
            <x-jet-input-error for="expediente.certificado" />
        </div>
        <div class="mb-4">
            <x-jet-label value="Archivos:" />
            <x-jet-input wire:model="otros" type="file" accept=".jpg,.png,.jpeg,.gif,.bmp,.tif,.tiff" multiple
                id="{{ $identificador }}" class="w-full" />
            <x-jet-input-error for="otros" />
        </div>
        <div wire:loading wire:target="otros"
            class="my-4 w-full px-6 py-4 text-center font-bold bg-indigo-200 rounded-md">
            Espere un momento mientras se carga la imagen.
        </div>
        <h1 class="pt-8  font-semibold sm:text-lg text-gray-900">
            Galeria:
        </h1>
        <hr />


        {{--              
            <section class="h-full overflow-auto p-8 w-full h-full flex flex-col">
                <ul id="gallery-{{$identificador}}" class="flex flex-1 flex-wrap -m-1">
                    @foreach ($files as $fil)
                        <li id="gallery-data" class="mx-2 text-center flex flex-col items-center justify-center items-center mb-4 hover:bg-gray-300">
                            <img src="{{Storage::url($fil->ruta)}}" class="object-fill w-3/6 mb-4"/> 
                            <a>                                    
                                <i class="fas fa-trash hover:text-indigo-400"></i>
                            </a>
                        </li> 
                    @endforeach 
                  </ul>
            </section> 
            --}}
        @if (count($files) || count($otros))
            <section class="mt-4 overflow-hidden border-dotted border-2 text-gray-700 "
                id="{{ 'section-' . $identificador }}">
                <div class="container px-5 py-2 mx-auto lg:pt-12 lg:px-32">
                    <div class="flex flex-wrap -m-1 md:-m-2">
                        @foreach ($files as $fil)
                            <div class="flex flex-wrap w-1/3 ">
                                <div class="w-full p-1 md:p-2 items-center justify-center">
                                    <img alt="gallery"
                                        class="mx-auto flex object-cover object-center w-36 h-36 rounded-lg"
                                        src="{{ Storage::url($fil->ruta) }}">
                                    <a class="flex" wire:click="deleteFile({{ $fil->id }})"><i
                                            class="fas fa-trash mt-1 mx-auto hover:text-indigo-400"></i></a>
                                </div>
                            </div>
                        @endforeach
                        @if (count($otros))
                            @foreach ($otros as $key => $otro)
                                <div class="flex flex-wrap w-1/3 ">
                                    <div class="w-full p-1 md:p-2 items-center justify-center">
                                        <img alt="gallery"
                                            class="mx-auto flex object-cover object-center w-36 h-36 rounded-lg shadow-lg border-2 border-lime-500 hover:shadow-lime-500/50 "
                                            src="{{ $otro->temporaryUrl() }}">
                                        <a class="flex" wire:click="deleteFileUpload({{ $key }})"><i
                                                class="fas fa-trash mt-1 mx-auto hover:text-indigo-400"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </section>
        @else
            <section class="h-full overflow-auto p-8 w-full h-full flex flex-col">
                <ul id="gallery-{{ $identificador }}" class="flex flex-1 flex-wrap -m-1">
                    <li id="empty"
                        class="h-full w-full text-center flex flex-col items-center justify-center items-center">
                        <img class="mx-auto w-32"
                            src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png"
                            alt="no data" />
                        <span class="text-small text-gray-500">Aun no seleccionaste ningún archivo</span>
                    </li>
                </ul>
            </section>
        @endif
    </x-slot>

    <x-slot name="footer">

        <x-jet-secondary-button wire:click="$set('editando',false)" class="mx-2">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-button wire:click="actualizar()" wire:loading.attr="disabled" wire:target="update,otros">
            Actualizar
        </x-jet-button>


    </x-slot>

</x-jet-dialog-modal>


@push('js')
    <script>
        Livewire.on('deleteExpediente', expedienteId => {
            Swal.fire({
                title: '¿Seguro que quieres eliminar este registro?',
                text: "Luego de eliminar no podras recuperarlo.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar'
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emitTo('expedientes', 'delete', expedienteId);

                    Swal.fire(
                        'Listo!',
                        'Expediente eliminado corrrectamente.',
                        'success'
                    )
                }
            })
        });
    </script>
@endpush

</div>
