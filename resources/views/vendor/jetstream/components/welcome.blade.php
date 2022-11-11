<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    

    <div class="mt-8 text-2xl">
        Hola, {{ Auth::user()->name }} 👋.
        <span> </span>
    </div>

    <div class="mt-6 text-gray-500">
        
    </div>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
    <div class="p-6">
        <div class="flex items-center">
            <i class="fas fa-file-archive pl-5"></i>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="{{ route('expedientes') }}">Expedientes</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                
               aqui van los expedientes segun estado:
               <br>
               Revisados: 
               <br>
               Por revisar:
               <br>
               Observados:
               <br>
               desaprobados:
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

    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
        <div class="flex items-center">
            <i class="fas fa-tasks pl-5"></i>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="https://laracasts.com">Servicios</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                Laracasts offers thousands of video tutorials on Laravel, PHP, and JavaScript development. Check them out, see for yourself, and massively level up your development skills in the process.
            </div>

            <a href="https://laracasts.com">
                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                        <div>Start watching Laracasts</div>

                        <div class="ml-1 text-indigo-500">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </div>
                </div>
            </a>
        </div>
    </div>

    
</div>
