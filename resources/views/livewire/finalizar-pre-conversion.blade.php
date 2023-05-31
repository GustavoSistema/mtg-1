<div>
   
    <div class="container block justify-center m-auto pt-12" wire:loading.remove wire:target="finalizar">        
       
        <h1 class="text-3xl text-center font-bold text-indigo-600 uppercase">
            <i class="fas fa-check "></i>
            Finalizar Pre-Conversión
        </h1>

        <div class="rounded-xl m-4 bg-white p-8 mx-auto max-w-max-xl shadow-lg block space-y-2 md:space-y-0 md:flex md:space-x-2">
            
            <div class="w-full md:w-2/6  ">
                <div class="border bg-gray-100 rounded-md p-2 w-full">
                    <h3 class="font-bold text-indigo-400 text-center italic uppercase">Datos del servicio:</h3>                
                    <p class="text-gray-600"><i class="fa-solid fa-file-contract"></i> N° Formato: <span class="font-bold">{{$certificacion->Hoja->numSerie}}</span></p>
                    <p class="text-gray-600"><i class="fa-solid fa-car-side"></i> VIN/serie del Vehículo: <span class="font-bold">{{$certificacion->Vehiculo->numSerie}}</span></p>
                    <p class="text-gray-600"><i class="fa-solid fa-warehouse"></i> Taller: <span class="font-bold">{{$certificacion->Taller->nombre}}</span></p>
                    <p class="text-gray-600"><i class="fa-solid fa-user"></i> Inspector: <span class="font-bold">{{$certificacion->Inspector->name}}</span></p>                    
                </div>                
            </div>
            <div class="w-full md:w-4/6 border bg-indigo-100 rounded-md h-auto p-4">
                <div class="flex flex-row w-full justify-space-between">
                    <div class="w-full md:w-3/6 flex items-center">
                        <x-jet-label value="Placa:" />
                        <x-jet-input type="text" class="w-full" wire:model="placa" maxlength="7" />
                        
                    </div>
                    
                    <div class="w-full flex justify-center items-center">
                        <input wire:model="conChip" id="checkbox1" type="checkbox" value="1" class="w-4 h-4 text-indigo-600 bg-white border-gray-300 rounded outline-none hover:cursor-pointer focus:ring-indigo-600  focus:ring-1 dark:bg-gray-600 dark:border-gray-500">
                        <label for="checkbox1" class="py-2 ml-2 text-sm font-medium text-gray-900 select-none hover:cursor-pointer ">
                            Incluye Chip
                        </label>
                    </div>
                    
                </div>
                <x-jet-input-error for="placa" />
                <div class="max-w-5xl m-auto  bg-white rounded-lg shadow-md dark:bg-gray-300  mt-4 p-2">
                    <x-jet-label value="Fotos reglamentarias:" class="font-bold text-lg" />
                    <x-file-pond name="imagenes" id="imagenes" wire:model="imagenes" acceptedFileTypes="['image/*',]"
                        aceptaVarios="true">

                    </x-file-pond>
                    <x-jet-input-error for="imagenes" />
                </div>
            </div>
        </div>
        <div class="max-w-8xl m-auto bg-white rounded-lg shadow-md my-4 py-4">
            <div class="my-2 flex flex-row justify-evenly items-center">
                <button wire:click="completar" wire:loading.attr="disabled" wire.target="completar"
                    class="hover:cursor-pointer border border-indigo-500 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 sm:mt-0 inline-flex items-center justify-center px-6 py-3 bg-indigo-400 hover:bg-indigo-500 focus:outline-none rounded">
                    <p class="text-sm font-medium leading-none text-white">
                        <span wire:loading wire:target="completar">
                            <i class="fas fa-spinner animate-spin"></i>
                            &nbsp;
                        </span>
                        &nbsp;Completar
                    </p>
                </button>
            </div>
        </div>

    </div>
    
    <div class="hidden w-full h-screen flex flex-col justify-center items-center bg-gray-200 " wire:loading.remove.class="hidden" wire:target="finalizar">     
        <div class="flex">
            <img src="{{ asset('images/mtg.png') }}" alt="Logo Motorgas Company" width="150" height="150">
        </div>
        <div class="text-center">
            <i class="fa-solid fa-circle-notch fa-xl animate-spin text-indigo-800 "></i>
          
            <p class="text-center text-black font-bold italic">CARGANDO...</p>
        </div>
        <div class="flex">
        </div>
    </div>
</div>
