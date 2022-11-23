<div class="mt-4">
    <x-jet-label for="taller_idtaller" value="{{ __('Taller o empresa') }}" />
    <select id="taller_idtaller" name="taller_idtaller" class="bg-gray-50 mx-2 border-indigo-500 rounded-md outline-none ml-1 block w-full ">
        <option value="">Seleccione</option>
        @foreach ($talleres as $item)
        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
        @endforeach              
    </select>
    <x-jet-input-error for="taller_idtaller"/>
</div>
