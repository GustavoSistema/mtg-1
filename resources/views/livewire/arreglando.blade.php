<div>
    <div class="w-4/6 mx-auto my-8">
       
            
        <x-file-pond name="imagenes" id="imagenes" wire:model="imagenes" multiple acceptedFileTypes="['image/*',]"  >   
              
        </x-file-pond>          
        <x-jet-input-error for="imagenes"/>
       
    </div>
    
    @if ($fotos)
          @foreach ($fotos as $item)              
              <p>{{$item}}</p>
          @endforeach
    @endif

    <div class="w-4/6 mx-auto my-8">
        <button wire:click="guardar" class="p-2 rounded-md border border-slate-500 text-white bg-slate-400 hover:bg-slate-600">
            Guardar
        </button>
    </div>
   
</div>
