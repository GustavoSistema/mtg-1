<div>
    
    <div class="max-w-5xl border shadow-md rounded-md bg-indigo-100 flex flex-col justify-center pt-12 mx-auto">
        <form wire:submit.prevent="import">
            <input type="file" wire:model="file">
            @error('file') <span class="error">{{ $message }}</span> @enderror
            <br>
            <button class="p-2 bg-indigo-400 my-2 rounded-md text-white hover:bg-indigo-600" type="submit">Importar archivo</button>
        </form>
        
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
    </div>
   

</div>
