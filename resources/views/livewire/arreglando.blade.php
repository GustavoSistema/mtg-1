<div>
    <div class="w-4/6 mx-auto my-8">
        <x-file-pond name="imagenes" id="imagenes" wire:model="imagenes" multiple acceptedFileTypes="['image/*',]"  >   
              
        </x-file-pond>           

       
    </div>
    
    @if ($imagenes)
          @foreach ($imagenes as $item)              
              <p>{{$item}}</p>
          @endforeach
    @endif
   
</div>
