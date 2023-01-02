<div>
    <div class="container block justify-center m-auto py-12" >
        <h1 class="text-2xl text-center">Asignacion de Materiales</h1>

        
            <div class="rounded-xl m-4 bg-white p-8 mx-auto max-w-max">
                <div class="flex flex-row">
                    <div class="w-5/6">
                        <x-jet-label value="Inspector:" for="Inspector"/>
                            <select wire:model="inspector" class="bg-gray-50 mx-2 border-indigo-500 rounded-md outline-none ml-1 block w-full ">
                                <option value="0">Seleccione</option>
                                @foreach ($inspectores as $inspector)
                                    <option value="{{ $inspector->id }}">{{ $inspector->name }}</option> 
                                @endforeach                             
                            </select>
                        <x-jet-input-error for="inspector"/>   
                    </div>                                       
                        @livewire('create-asignacion')
                </div>                                          
            </div>
            <div>
                @isset($articulos)
                   <h1>{{$articulos}}</h1>
                @endisset                   
            </div>
        
    </div>
</div>
