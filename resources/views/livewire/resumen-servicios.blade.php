<div class="bg-gray-200 bg-opacity-25 flex flex-col items-center justify-center px-4">
    {{--
    <div class="p-6">        
        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">  
                <div class="flex flex-row justify-between">
                    <h1>Total de Expedientes: </h1>
                  
                        <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                            <span aria-hidden class="absolute inset-0 bg-gray-400 opacity-20 rounded-full"></span>
                            <span class="relative">0</span>
                        </span> 
                    
                </div>
                
                <hr class="my-1"/>
                <ul>            
                    <li class="flex flex-row justify-between">🔍 Por revisar:
                        
                            <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                <span aria-hidden class="absolute inset-0 bg-gray-400 opacity-20 rounded-full"></span>
                                <span class="relative">0</span>
                            </span> 
                        
                    </li>
                    <hr class="my-1"/>
                    <li class="flex flex-row justify-between">👁 Observados:
                       
                            <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                <span aria-hidden class="absolute inset-0 bg-gray-400 opacity-20 rounded-full"></span>
                                <span class="relative">0</span>
                            </span> 
                        
                    </li>
                    <hr class="my-1"/>
                    <li class="flex flex-row justify-between">❌ Desaprobados:
                        
                            <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                <span aria-hidden class="absolute inset-0 bg-gray-400 opacity-20 rounded-full"></span>
                                <span class="relative">0</span>
                            </span> 
                           
                    </li> 
                    <hr class="my-1"/>  
                    <li class="flex flex-row justify-between">✅ Aprobados:
                        
                            <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                <span aria-hidden class="absolute inset-0 bg-gray-400 opacity-20 rounded-full"></span>
                                <span class="relative">0</span>
                            </span> 
                              
                    </li>  
                </ul>         
            </div>
            <a href="{{ route('expedientes') }}">
                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                        <div>Revisar Expedientes</div>
    
                        <div class="ml-1 text-indigo-500">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </div>
                </div>
            </a>
        </div>
        
    </div>
    
    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l text-center">    
       
    </div>
        
    
        
    
        

        --}}

    <div class="p-2 m-4 w-full flex flex-row space-x-3 justify-center">
        <div class="px-8 py-2 bg-yellow-400 w-1/3 text-center rounded-md my-auto">
            <div class="text-center m-auto">
                
                    <i class="fas fa-stream fa-2x"></i>
                
                <p>  Servicios Realizados</p>
            </div>
            <p class="font-bold text-xl "> {{$servicios}} </p>
        </div>        
        <div class="px-8 py-2 bg-green-600/75 w-1/3 text-center rounded-md my-auto">
            <div class="text-center m-auto">
                
                    <i class="fas fa-hand-holding-usd fa-2x"></i>
                
                <p>  Monto de ingresos</p>
            </div>
            <p class="font-bold text-xl "> <span>S/</span> {{$total}} </p>
        </div>
        <div class="px-8 py-2 bg-orange-500/75 w-1/3 text-center rounded-md my-auto">
            <div class="text-center m-auto">
                
                    <i class="fas fa-tools fa-2x"></i>
                
                <p>  Otro Dato</p>
            </div>
            <p class="font-bold text-xl "> <span>S/</span> 1000 </p>
        </div>
    </div>
    <div class="p-2 m-4">       
        <div>
            <p>RESUMEN DE SERVICIOS</p>
        </div> 
        
        <div>
          <canvas id="Barras" class="w-full m-auto"></canvas>
        </div>
    </div>


    

    {{--
    @push('js')
        <script>
            const chart1 = new Chart(document.getElementById('Barras'), {
                    type: 'bar',
                    data: {
                        labels: @json($labels),
                        datasets: [{
                        label: 'Expedientes',
                        data: @json($dataset),
                        borderWidth: 1,             
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                position: 'bottom'
                            },                        
                        },
                        responsive: true,
                        
                    }
                }
            );
            console.log(chart);
            window.addEventListener("load", (event) => {
            //console.log("page is fully loaded");
            Livewire.emitTo('resumen-servicios', 'enviaDatos');        
            });
    
        </script>
        @endpush
       --}}
</div>
