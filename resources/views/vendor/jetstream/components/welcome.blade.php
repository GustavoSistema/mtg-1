<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    

    <div class="mt-8 text-2xl">
        Hola, {{ Auth::user()->name }} 👋.
        <span> </span>
    </div>

    <div class="mt-6 text-gray-500">
        
    </div>
</div>    

    @can('expedientes')
    @livewire('resumen-expedientes')
    @endcan

    

    

