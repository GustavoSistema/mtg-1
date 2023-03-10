<div>
    <button wire:click="seleccionaFormatos" class="p-2 bg-indigo-400 rounded-lg"> CAMBIAR ESTADO</button>
    <div class="text-center">    
        @if($recortados)
            <div class="p-2 m-4 bg-red-300">
                @foreach ($recortados as $recortado)
                    <li>
                        {{$recortado["numSerie"]}}
                    </li>
                @endforeach

                <div>
                    <button wire:click="calculaCorrelativos" class="p-2 bg-indigo-400 rounded-lg"> otravez</button>
                </div>
                
            </div>
            
        @endif

        @if($rec)
        <ol>
            @foreach ($rec as $item)
               <li>{{$item["inicio"]." - ".$item["final"]}}</li>
            @endforeach
        </ol>
            
        @endif
        
    </div>
</div>
