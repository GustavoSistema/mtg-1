
<div class="max-w-5xl m-auto bg-white rounded-lg shadow-md dark:bg-gray-300 pb-3">

    <div {{ $cabecera->attributes->merge(['class' => 'flex items-center justify-between py-4 px-6 rounded-t-lg']) }}>
        
        <span {{ $titulo->attributes->merge(['class' => 'text-lg font-semibold text-white dark:text-gray-400']) }}>{{$titulo}} </span>
        {{$icono}}
    </div>    
    <div class="w-full flex flex-row justify-center items-center m-auto py-6">
        <a wire:click="$set('open',true)" class="hover:cursor-pointer focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-center justify-start px-6 py-3 bg-amber-400 hover:bg-amber-500 focus:outline-none rounded">
            <p class="text-sm font-medium leading-none text-white"><i class="fas fa-plus-square fa-xl"></i>&nbsp;Agregar Equipos</p>
        </a>
    </div>
   {{$equip}}
</div>