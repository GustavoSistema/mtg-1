<div>
    
    <div class="max-w-5xl border shadow-md rounded-md bg-indigo-100 flex  justify-center pt-12 mx-auto">
        <form wire:submit.prevent="import">
            <input type="file" wire:model="file">
            @error('file') <span class="error">{{ $message }}</span> @enderror
            <br>
            <button class="p-2 bg-indigo-400 my-2 rounded-md text-white hover:bg-indigo-600" type="submit">Importar archivo</button>
        </form>
        
        @if(isset($data))
        <table>
            <thead>
                <tr>
                    <th>Columna 1</th>
                    <th>Columna 2</th>
                    <!-- Agrega más columnas según la estructura de tu archivo Excel -->
                </tr>
            </thead>
            <tbody>                
                @foreach ($data as $row)
                    <tr>
                        <td>{{ $row[0] }}</td>
                        <td>{{ $row[1] }}</td>
                        <!-- Agrega más columnas según la estructura de tu archivo Excel -->
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
   

</div>
