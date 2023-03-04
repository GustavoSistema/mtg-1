<div>
    <button wire:click="cambiarEstado" class="p-2 bg-indigo-400 rounded-lg"> CAMBIAR ESTADO</button>
    <div class="text-center">
        @if($materiales->count())
        <ol>
           
       
            @foreach ($materiales as $material)
            <li>
                {{$material->id." - ".$material->tipo->descripcion." - ".$material->numSerie." - ".$material->estado }} <span class="mx-2 p-2 bg-green-200">{{$material->añoActivo}} </span>
            </li>
            @endforeach
        </ol>
        @endif
    </div>
</div>
