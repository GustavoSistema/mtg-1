<div >
    <div class="container block justify-center m-auto py-12">
        <div class="max-w-8xl border shadow-md rounded-md bg-indigo-100 flex flex-col justify-center pt-12 mx-auto">
            <div class="flex flex-row space-x-2 items-center m-auto">
                <x-jet-label value="Servicios de revisión anual:" />
                <input  class="relative m-0 block w-full min-w-0 flex-auto rounded border  shadow-sm bg-indigo-300  bg-clip-padding px-3 py-2 text-base font-normal text-white transition duration-300 ease-in-out file:-mx-3 file:-my-2 file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-indigo-500 file:px-3 file:py-2 file:text-white file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-indigo-700 focus:border-primary focus:text-white focus:shadow-te-primary focus:outline-none "
                        type="file" wire:model="file" accept=".xlsx," />
                
                @if(!$estadoAnuales)        
                <button class="p-2 w-36 bg-indigo-400 my-2 rounded-md text-white hover:bg-indigo-600 disabled:bg-gray-200 disabled:text-indigo-400"  id="5484"
                wire:loading.attr="disabled" wire:click="procesarAnuales" wire:target="file,procesarAnuales">
                    procesar archivo 
                    <span wire:loading  wire:target="procesarAnuales">
                        <i class="fas fa-spinner animate-spin text-indigo-500"> </i>
                    </span>
                    
                </button>               
               @else
                <button class="p-2 w-36 bg-indigo-400 my-2 rounded-md text-white hover:bg-indigo-600 disabled:bg-gray-200 disabled:text-indigo-400"  id="123"
                    wire:loading.attr="disabled" wire:click="cargarAnuales" wire:target="file,cargarAnuales">
                        cargar datos 
                        <span wire:loading  wire:target="cargarAnuales">
                            <i class="fas fa-spinner animate-spin text-indigo-500" > </i>
                        </span>                        
                </button>                    
               @endif

            </div>
            @error('file') 
                <span class="error text-red-600">{{ $message }}</span>
            @enderror
            
            <br>
            @if (!empty($data))        
                <p class="text-center" >
                    Se encontraron:  {{ $cuenta }} registros
                </p>            
            @endif
                
        
            {{--
            @if(isset($data))
            <div class="w-full bg-white border rounded-md py-4">
                @foreach ($data as $key=>$item)        
                    
                    @foreach ($item as $id=>$row)
                    <span class="text-indigo-500 font-bold">{{$key }}</span><p>{{var_export($row)}}</p><br>
                        <p>{{$id.'---'.$row[2].' - '.$row[4].' - '.$row[7]}}</p>
                    @endforeach
                @endforeach
            </div>           
            @endif
            --}}

            {{--
                <table class="overflow-x-auto">
                    <thead>
                        <tr>
                            @foreach ($headers as $header)
                                <th class="font-bold text-indigo-500">{{ $header }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)                        
                            <tr>
                                @foreach ($row as $key=>$value)
                                    <td>{{ $key." - ".$value }}</td>
                                @endforeach
                            </tr>                        
                        @endforeach
                    </tbody>
                </table>
                --}}
        
        </div>
    </div>
    
   

</div>
