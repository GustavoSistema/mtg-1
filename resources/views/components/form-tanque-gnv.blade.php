<div>
    <div class="mb-4">
        <x-jet-label value="Marca:" />
        <x-jet-input type="text" class="w-full" wire:model="equipoMarca" />
        <x-jet-input-error for="equipoMarca"/>
    </div> 
    <div class="mb-4">
        <x-jet-label value="N° de serie:"/>
        <x-jet-input type="text" class="w-full"  wire:model="equipoSerie"/>
        <x-jet-input-error for="equipoSerie"/>
    </div> 
    <div class="mb-4">
        <x-jet-label value="Capacidad:"/>
        <x-jet-input type="number" class="w-full" wire:model="equipoCapacidad" />
        <x-jet-input-error for="equipoCapacidad"/>
    </div>    
</div>