<div class="flex  w-full  justify-center">
    <section class="bg-white dark:bg-gray-900 mt-2">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-3xl font-semibold text-center text-gray-800  lg:text-4xl dark:text-white">Inventario de <span class="text-indigo-500">Materiales</span></h1>
    
            <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-16 md:grid-cols-2 xl:grid-cols-3">
                <div class="w-full border border-indigo-400 max-w-sm px-4 py-3 bg-white rounded-md shadow-md dark:bg-gray-800">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-ligth text-gray-800 dark:text-gray-400"><i class="fas fa-file"></i>&nbsp; FORMATOS GNV</span> 
                        <span class="px-3 py-1 text-xs text-green-800 uppercase bg-green-200 rounded-full dark:bg-blue-300 dark:text-blue-900">Disponible</span>
                    </div>
                
                    <div class="mt-4">                        
                        <div class="mx-auto w-full flex flex-row justify-between items-center">
                            <p class="mt-2 text-md text-gray-600 dark:text-gray-300">En stock:</p> <span class=" mr-2 bg-amber-200 px-1 rounded-full">{{$disponiblesGnv}}</span>                            
                        </div>  
                        <hr> 
                        <div class="mx-auto w-full flex flex-row justify-between items-center">
                            <p class="mt-2 text-md text-gray-600 dark:text-gray-300">Consumido:</p> <span class=" mr-2 bg-orange-200 px-1 rounded-full">{{$consumidosGnv}}</span>                            
                        </div>  
                        <hr> 
                        <div class="mx-auto w-full flex flex-row justify-between items-center">
                            <p class="mt-2 text-md text-gray-600 dark:text-gray-300">Anulado:</p> <span class=" mr-2 bg-indigo-200 px-1 rounded-full">{{$anuladoGnv}}</span>                            
                        </div>  
                        <hr> 
                        <div class="mx-auto w-full flex flex-row justify-between items-center">
                            <p class="mt-2 text-md text-gray-600 dark:text-gray-300">Pendiente de Cambio:</p> <span class=" mr-2 bg-indigo-200 px-1 rounded-full">...</span>                            
                        </div>  
                        <hr>        
                    </div>
                
                    
                </div>
    
                <div class="border border-indigo-400 w-full max-w-sm px-4 py-3 bg-white rounded-md shadow-md dark:bg-gray-800">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-light text-gray-800 dark:text-gray-400"> <i class="fas fa-file"></i> &nbsp;FORMATOS GLP</span>
                        <span class="px-3 py-1 text-xs text-green-800 uppercase bg-gray-200 rounded-full dark:bg-blue-300 dark:text-blue-900">próximamente</span>
                    </div>
                </div>
    
                <div class="border border-indigo-400 w-full max-w-sm px-4 py-3 bg-white rounded-md shadow-md dark:bg-gray-800">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-light text-gray-800 dark:text-gray-400"> <i class="fas fa-microchip"></i> CHIPS</span>
                        <span class="px-3 py-1 text-xs text-green-800 uppercase bg-gray-200 rounded-full dark:bg-blue-300 dark:text-blue-900">próximamente</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
</div>
