<div>
    <div class="container mx-auto py-12" >
        <h1 class="text-2xl text-center">Asignacion de Materiales</h1>

        <form action="">
            <div class="rounded-xl m-4 bg-white p-8">
                <div class="flex flex-row">
                    <div class="w-5/6">
                        <x-jet-label value="Inspector:" for="Inspector"/>
                            <select wire:model="inspector" class="bg-gray-50 mx-2 border-indigo-500 rounded-md outline-none ml-1 block w-full ">
                                <option value="0">Seleccione</option>
                                @foreach ($inspectores as $inspector)
                                    <option value="{{ $inspector->id }}">{{ $inspector->name }}</option> 
                                @endforeach                             
                            </select>
                        <x-jet-input-error for="inspector"/>   
                    </div>                    
                        <a class="flex w-1/6 bg-amber-500 mx-6 rounded-xl font-ibold text-amber-900 justify-center items-center hover:cursor-pointer" wire:click="$set('open',true)">agregar articulos</a>
                    </div>
                    {{$open}}                         
            </div>
        </form>
    </div>

    <x-jet-dialog-modal wire:model="open" wire:loading.attr="disabled" wire:target="deleteFile">
        <x-slot name="title" class="font-bold">
          <h1 class="text-xl font-bold">Agregar Articulo</h1> 
        </x-slot>
    
        <x-slot name="content">     
            <div class="mb-4">
                <x-jet-label value="articulo:" />
                <x-jet-input wire:model="taller.nombre" type="text" class="w-full" />
                <x-jet-input-error for="taller.nombre" />            
            </div>    
        </x-slot>
    
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)" class="mx-2">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button wire:click="agregarArticulo" wire:loading.attr="disabled" wire:target="update">
                Actualizar
            </x-jet-button>      
    
        </x-slot>  
        
      </x-jet-dialog-modal>
</div>
