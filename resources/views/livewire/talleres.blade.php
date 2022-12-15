<div class="flex p-10">  
    @foreach($files as $file)
    <div class="group relative flex flex-wrap w-1/3">
        <div class="flex flex-wrap p-1">
            <div class="w-full p-1 md:p-2 items-center justify-center">            
                <img class="mx-auto flex object-cover object-center w-36 h-36 rounded-lg" src="{{ Storage::url($file->ruta) }}" width="200" height="200" />
                <div class="absolute top-0  w-36 h-0 flex flex-col justify-center items-center bg-indigo-300 opacity-0 group-hover:h-full group-hover:opacity-100 duration-500">           
                    <a class="m-auto px-8 py-3 rounded-full bg-lime-200 hover:bg-lime-400 duration-300" wire:click="$emit('visualizar',{{ $file->Expediente_idExpediente }})"><i class="fas fa-eye"></i></a>            
                </div>
            </div>
        </div>        
    </div>
    @endforeach


    @push('js')
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script>
      
      var swiper = new Swiper(".mySwiper", {
        zoom: true,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        pagination: {
          el: ".swiper-pagination",
        },        
        keyboard: true,
      });
    </script>
    <script>
        Livewire.on('visualizar', ruta => {
            alert("quieres visualizar"+ruta);
        });
    </script>
    @endpush       
</div>
