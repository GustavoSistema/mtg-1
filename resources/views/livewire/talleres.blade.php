<div class="flex box-border">  
 
  <div class="group relative grid grid-flow-row-dense grid-cols-3 grid-rows-3 justify-center w-full">
    @foreach($files as $file)       
            {{--         
              <img class="mx-auto flex object-cover object-center w-1/3 h-36 rounded-lg" src="{{ Storage::url($file->ruta) }}" />
              <div class="absolute top-0  w- h-0 flex flex-col justify-center items-center bg-indigo-300 opacity-0 group-hover:h-36 group-hover:opacity-100 duration-500">           
                  <a class="m-auto px-8 py-3 rounded-full bg-lime-200 hover:bg-lime-400 duration-300" wire:click="$emit('visualizar',{{ $file->Expediente_idExpediente }})"><i class="fas fa-eye"></i></a>            
              </div>
            --}}
            <a wire:click="$emit('visualizar',{{ $file->Expediente_idExpediente }})">
              <div class="relative overflow-hidden rounded-lg shadow-xl cursor-pointer m-4 dark:bg-gray-600 duration-300 ease-in-out transition-transform transform hover:-translate-y-2">
                <img class="object-contain w-full h-56"
                src="{{ Storage::url($file->ruta) }}"
                  />                              
              </div>
            </a>
             
      @endforeach    
  </div>     
 
  <div class="w-full h-full bg-gray-900 bg-opacity-100 top-0 left-0 fixed sticky-0 hidden" id="visor">
    <i class="fas fa-redo absolute top-4 right-4 mr-6 cursor-pointer text-center text-white z-50" id="rotate-der"></i>
    <i class="fas fa-undo absolute top-4 right-4 mr-12 cursor-pointer text-center text-white z-50" id="rotate-izq"></i>
    
    <i class="fas fa-times absolute top-4 right-4 cursor-pointer text-center text-white z-50" id="btnClose"></i>
    <div class="mySwiper h-full flex m-auto justify-center items-center">
      <!-- Additional required wrapper -->
      <div class="swiper-wrapper">
        <!-- Slides -->
        @foreach($files as $key=>$file)  
          <div class="swiper-slide z-10 flex m-auto justify-center items-center" >
            <img class="object-contain " id="imgContent-{{$key}}" src="{{ Storage::url($file->ruta) }}"/>
          </div>
        @endforeach
      </div>
      <!-- If we need pagination -->
      <div class="swiper-pagination"></div>      
      <!-- If we need navigation buttons -->
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>      
      <!-- If we need scrollbar -->
      <div class="swiper-scrollbar"></div>
    </div>      
  </div>
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
        clickable: true,
      },
      keyboard:true,
    });
  
    
  </script>
  <script>
      Livewire.on('visualizar', ruta => {
        var open=false;          
        let menu = document.getElementById("visor");
        let close= document.getElementById("btnClose");
        
        menu.classList.toggle("hidden"); 

        close.addEventListener('click',()=>{            
          menu.classList.add("hidden");
        });
        var angle = 0;
              
        let rotarDerecha = document.getElementById('rotate-der');
        let rotarIzquierda = document.getElementById('rotate-izq');
        let siguiente=document.querySelector(".swiper-button-next");
        let anterior=document.querySelector(".swiper-button-prev");
        var contenedores=document.querySelectorAll(".swiper-slide");
        rotarDerecha.addEventListener('click',(e)=>{
            //console.log(e.target);   
            var activo=document.querySelector(".swiper-slide-active");              
            var img=activo.querySelector("img");
            if(angle<360 ){
              angle+=90;
            }else{
              rotarDerecha.disabled = true;
              rotarDerecha.classList.remove("cursor-pointer");
              rotarDerecha.style.color="gray";
              rotarIzquierda.style.color="white";                
            }           
            img.style.transform="rotate("+angle+"deg)";
        });
        
        rotarIzquierda.addEventListener('click',(e)=>{
            //console.log(e.target);   
            var activo=document.querySelector(".swiper-slide-active");              
            var img=activo.querySelector("img");
            if(angle>0){
              angle-=90;                
            }else{
              rotarIzquierda.disabled = true;
              rotarIzquierda.classList.remove("cursor-pointer");
              rotarIzquierda.style.color="gray";
              rotarDerecha.style.color="white";                 
            }           
            img.style.transform="rotate("+angle+"deg)";
        }); 

        anterior.addEventListener("click",()=>{
         contenedores.forEach(contenedor => {
            let image=contenedor.querySelector("img");
            image.style.transform="rotate(0deg)";
          });          
          angle=0;
        });  
        siguiente.addEventListener("click",()=>{
          contenedores.forEach(contenedor => {
            let image=contenedor.querySelector("img");              
            image.style.transform="rotate(0deg)";
          });
          angle=0;
        });                
      });        
  </script>
  @endpush       
</div>
