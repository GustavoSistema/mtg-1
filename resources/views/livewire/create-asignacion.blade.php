<div>
    <div>
        <button  wire:click="$set('open',true)" class="bg-indigo-600 px-6 py-4 rounded-md text-white font-semibold tracking-wide cursor-pointer">Agregar</button>
    </div>
    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            <h1 class="text-xl font-bold">Asignación de Materiales</h1>                                  
        </x-slot> 

        <x-slot name="content">
            <div class="mb-4 -ml-2 p-1">
                <x-jet-label value="Inspector:" for="Inspector"/>
                <select wire:model="inspector" class="bg-gray-50 mx-2 border-indigo-500 rounded-md outline-none ml-1 block w-full ">
                    <option value="0">Seleccione</option>
                    @foreach ($inspectores as $inspector)
                        <option value="{{ $inspector->id }}">{{ $inspector->name }}</option> 
                    @endforeach                             
                </select>
                <x-jet-input-error for="inspector"/>
            </div> 
            <div class="mb-4">
                <x-jet-label value="N° de guia:"/>
                <x-jet-input type="text" class="w-full" wire:model="numguia" />
                <x-jet-input-error for="numguia"/>
            </div>  
        </x-slot>
        
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)" class="mx-2">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button wire:click="save" wire:loading.attr="disabled" wire:target="save">
                Guardar
            </x-jet-button>            
        </x-slot>
    </x-jet-dialog-modal>
</div>
