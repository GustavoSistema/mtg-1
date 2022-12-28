<div class="mb-4 p-6 bg-gray-200 rounded-lg">    
    <div>
        <x-jet-label value="Tipo de Articulo:" for="tipoMat"/>
        <select class="bg-gray-50 mx-2 border-indigo-500 rounded-md outline-none ml-1 block w-full" wire:model="tipoMat">
            <option value="">Seleccione</option>
            @foreach ($tiposMaterial as $t)
                <option value="{{ $t->id }}">{{ $t->descripcion }}</option>
            @endforeach
        </select>
        <x-jet-input-error for="tipoMat" />
    </div>
    <div>
        <x-jet-label value="Cantidad:" />
        <x-jet-input type="number" class="w-full" wire:model="cantidad" />
        <x-jet-input-error for="cantidad" />
    </div>
    <div>
        <x-jet-label value="N° de inicio" />
        <x-jet-input type="number" class="w-full" wire:model="numInicio" />
        <x-jet-input-error for="numInicio" />
    </div>
    <div>
        <x-jet-label value="N° de Final" />
        <x-jet-input type="number" class="w-full" wire:model="numFinal" enable />
        <x-jet-input-error for="numFinal" />
    </div>
    <div>
        <div class="flex justify-center items-center my-4">
            <button class="p-2 bg-indigo-500 text-white font-semibold rounded-lg" wire:click="guardar">agregar</button>
        </div>
    </div>
    

</div>
