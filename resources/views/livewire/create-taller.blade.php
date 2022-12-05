<div class="mb-4">
           
    <button  wire:click="$set('open',true)" class="bg-indigo-600 px-6 py-4 rounded-md text-white font-semibold tracking-wide cursor-pointer">Agregar</button>


    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            <h1 class="text-xl font-bold">Crear nuevo Taller</h1>                                  
        </x-slot>        
        <x-slot name="content">     
                                
            <div class="mb-4">
                <x-jet-label value="Nombre:"/>
                <x-jet-input type="text" class="w-full" wire:model="nombre" />
                <x-jet-input-error for="nombre"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Direccion:"/>
                <x-jet-input type="text" class="w-full" wire:model="direccion"/>
                <x-jet-input-error for="direccion"/>
            </div>            
            <div class="mb-4">
                <x-jet-label value="Ruc:"/>
                <x-jet-input type="text" class="w-full" wire:model="ruc"/>
                <x-jet-input-error for="ruc" />                
            </div>  
            

            <div class="flex justify-center mb-4">
                <x-jet-secondary-button class="mx-2 bg-lime-300" wire:click="agregaServicio">
                    Agregar servicio  <i class="fas fa-plus ml-1"></i>
                </x-jet-secondary-button>                
            </div> 

            @if ($serv)
                @for ($i = 0; $i < $serv; $i++)
                <div class="mb-4 p-2 bg-gray-300 rounded-sm flex flex-row items-center">
                    <select wire:model="tiposervicio" class="bg-gray-50 mx-2 border-indigo-500 rounded-md outline-none ml-1 block w-full ">
                        <option value="">Seleccione</option>
                        @foreach ($servicios as $item)
                        <option value="{{ $item->id }}">{{ $item->descripcion }}</option>
                        @endforeach                      
                    </select>
                    <x-jet-input-error for=""/> 

                    <x-jet-label value="precio:"/>
                    <x-jet-input type="text" class="w-full" wire:model="precio"/>
                    <x-jet-input-error for="precio" />  
                    
                    <div class="mx-2 flex flex-row">
                        <x-jet-secondary-button class="bg-lime-300">
                            <i class="fas fa-check-circle py-1"></i>
                        </x-jet-secondary-button>     
                        <x-jet-secondary-button class="bg-red-500" wire:click="borraServicio">
                            <i class="fas fa-times py-1"></i>
                        </x-jet-secondary-button> 
                    </div>
                </div>  
                @endfor
            @endif
                   
            
        </x-slot>
        
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)" class="mx-2">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button wire:click="save" wire:loading.attr="disabled" wire:target="save,files,documentos">
                Guardar
            </x-jet-button>            
        </x-slot>

    </x-jet-dialog-modal>
</div>
