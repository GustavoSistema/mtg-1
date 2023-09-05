<div>
    @if (isset($docs))
        @foreach ($docs as $doc )
            <p>{{$doc->TipoDocumento->nombreTipo.' - '.$doc->fechaExpiracion}}</p>
            <br>
        @endforeach
    @endif

    <div class=" mx-auto p-8 bg-gray-300 flex flex-row justify-center">
        <button class="bg-green-500 rounded-md border-none p-2" wire:click="cambiar">
            Cambiar estados
        </button>
    </div>
</div>
