<div class="bg-green-100/30 w-1/3 flex justify-center space-x-2 items-center px-3">
    <a   href="{{ Storage::url($documento->ruta)}}" target="__blank"  rel="noopener noreferrer"
        class="group flex py-2 px-2 text-center items-center rounded-md bg-blue-300 font-bold text-white cursor-pointer hover:bg-blue-400 hover:animate-pulse">
        <i class="fas fa-eye"></i>      
        
        <span
            class="group-hover:opacity-100 transition-opacity bg-gray-800 px-1 text-sm text-gray-100 rounded-md absolute left-1/2-translate-x-1/2 translate-y-full opacity-0 m-4 mx-auto z-50">
            ver 
        </span>
    </a>
    <a href="{{ route('download_doctaller',$documento->id)}}" rel="noopener noreferrer"
        class="group flex py-2 px-2 text-center items-center rounded-md bg-indigo-300 font-bold text-white cursor-pointer hover:bg-indigo-400 hover:animate-pulse">
        <i class="fas fa-download"></i>
        <span
            class="group-hover:opacity-100 transition-opacity bg-gray-800 px-1 text-sm text-gray-100 rounded-md absolute left-1/2-translate-x-1/2 translate-y-full opacity-0 m-4 mx-auto z-50">
            Descargar
        </span>
    </a>

    <button wire:click="abrirModal"
        class="group flex py-2 px-2 text-center items-center rounded-md bg-amber-300 font-bold text-white cursor-pointer hover:bg-amber-400 hover:animate-pulse">
        <i class="fas fa-pen"></i>
        <span
            class="group-hover:opacity-100 transition-opacity bg-gray-800 px-1 text-sm text-gray-100 rounded-md absolute left-1/2-translate-x-1/2 translate-y-full opacity-0 m-4 mx-auto z-50">
            Editar
        </span>
    </button>

    {{--
    <button wire:click="$emit('deleteDocumento',{{ $documento->id }})"
        class="group flex py-2 px-2 text-center items-center rounded-md bg-red-500 font-bold text-white cursor-pointer hover:bg-red-700 hover:animate-pulse">
        <i class="fas fa-times-circle"></i>
        <span
            class="group-hover:opacity-100 transition-opacity bg-gray-800 px-1 text-sm text-gray-100 rounded-md absolute  translate-y-full opacity-0 m-4 mx-auto z-50">
            Eliminar
        </span>
    </button>
    --}}

    @if($documento!=null)
    <x-jet-dialog-modal wire:model="openEdit">
        <x-slot name="title">
            <h1 class="text-xl font-bold">Editando documento de taller</h1>
        </x-slot>
        <x-slot name="content">

            <div class="mb-4">
                <x-jet-label value="tipo de documento:" />
                <x-jet-input type="text" class="w-full" disabled value="{{$documento->TipoDocumento->nombreTipo}}"/>                
            </div>
            <div class="mb-4">
                <x-jet-label value="Fecha de inicio:" />
                <x-date-picker wire:model="documento.fechaInicio" placeholder="Fecha de inicio" class="bg-gray-50 border-indigo-500 rounded-md outline-none w-full"/>    
                <x-jet-input-error for="documento.fechaInicio" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Fecha de Expiración:" />
                <x-date-picker wire:model="documento.fechaExpiracion" placeholder="Fecha de Fin" class="bg-gray-50 border-indigo-500 rounded-md outline-none w-full"/>
                <x-jet-input-error for="documento.fechaExpiracion" />
            </div>
            @if ($documento->tipoDocumento == 9)
            <div class="mb-4">
                <x-jet-label value="Empleado:" />
                <x-jet-input type="text" class="w-full" wire:model="documento.nombreEmpleado"/>
                <x-jet-input-error for="documento.nombreEmpleado" />
            </div>
            @endif

            <div class="mb-4">
                <x-jet-label value="Archivo:" class="font-bold" />
                <x-file-pond  wire:model="nuevoPdf" acceptedFileTypes="['application/pdf',]" aceptaVarios="false" />    
                <x-jet-input-error for="nuevoPdf" />
            </div>
            @if($nuevoPdf==null)
            <iframe width="100%" height="400" class="mt-6" src="{{Storage::url($documento->ruta)}}" frameborder="0"></iframe>
            @endif

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openEdit',false)" class="mx-2">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button loading:attribute="disabled" wire:click="editarDocumento" wire:target="editarDocumento">
                Actualizar
            </x-jet-button>
        </x-slot>

    </x-jet-dialog-modal>
    @endif

    @push('js')
        <script>
            Livewire.on('deleteDocumento', documentoId => {
                Swal.fire({
                    title: '¿Seguro que quieres eliminar este documento?',
                    text: "Luego de eliminar no podras recuperarlo.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('comandos-documento','eliminar', documentoId);

                        Swal.fire(
                            'Listo!',
                            'Documento eliminado correctamente.',
                            'success'
                        )
                    }
                })
            });
        </script>
    @endpush
</div>
