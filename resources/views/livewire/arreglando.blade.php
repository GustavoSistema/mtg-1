<div>
    <div class="w-4/6 mx-auto my-8">
        <x-file-pond name="imagenes" wire:model="imagenes" multiple>
            
        </x-file-pond>           
    </div>
    
    @if ($imagenes)
        {{$imagenes}}        
    @endif
   
</div>
