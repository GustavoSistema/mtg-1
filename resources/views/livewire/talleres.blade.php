<div class="flex box-border">  
  <div class="container mx-auto py-12">
    <x-table-talleres>
            @if (count($talleres))            
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-x-auto">
                            <table class="min-w-full leading-normal rounded-md">
                                <thead>
                                    <tr>
                                        <th class=" w-24 cursor-pointer hover:font-bold hover:text-indigo-500 px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                            wire:click="order('id')">
                                            Id
                                            @if ($sort == 'id')
                                              @if ($direction == 'asc')
                                                  <i class="fas fa-sort-alpha-up-alt float-right mt-0.5"></i>
                                              @else
                                                  <i class="fas fa-sort-alpha-down-alt float-right mt-0.5"></i>
                                              @endif
                                            @else
                                                <i class="fas fa-sort float-right mt-0.5"></i>
                                            @endif
                                        </th>
                                        <th class="cursor-pointer hover:font-bold hover:text-indigo-500  px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                            wire:click="order('nombre')">
                                            Nombre    
                                            @if ($sort == 'nombre')
                                              @if ($direction == 'asc')
                                              <i class="fas fa-sort-alpha-up-alt float-right mt-0.5"></i>
                                              @else
                                                  <i class="fas fa-sort-alpha-down-alt float-right mt-0.5"></i>
                                              @endif
                                            @else
                                                <i class="fas fa-sort float-right mt-0.5"></i>
                                            @endif
                                        </th>
                                        <th class="cursor-pointer hover:font-bold hover:text-indigo-500 px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                            wire:click="order('direccion')">
                                            Dirección
                                            @if ($sort == 'direccion')
                                                @if ($direction == 'asc')
                                                    <i class="fas fa-sort-alpha-up-alt float-right mt-0.5"></i>
                                                @else
                                                    <i class="fas fa-sort-alpha-down-alt float-right mt-0.5"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort float-right mt-0.5"></i>
                                            @endif
                                        </th>
                                        <th class="cursor-pointer hover:font-bold hover:text-indigo-500 px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                            wire:click="order('ruc')">
                                            Ruc
                                            @if ($sort == 'ruc')
                                                @if ($direction == 'asc')
                                                    <i class="fas fa-sort-alpha-up-alt float-right mt-0.5"></i>
                                                @else
                                                    <i class="fas fa-sort-alpha-down-alt float-right mt-0.5"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort float-right mt-0.5"></i>
                                            @endif
                                        </th>                                           
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($talleres as $item)
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center">
                                                    <p class="text-gray-900 ">
                                                        {{ strtoupper($item->id) }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $item->nombre }}
                                                    </p>
                                                </div>
                                            </td>                                            
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">{{ $item->direccion }}</p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $item->ruc }}
                                                    </p>
                                                </div>
                                            </td>                                               

                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                {{-- @livewire('edit-usuario', ['usuario' => $usuario], key($usuario->id)) --}}
                                                <div class="flex justify-end">
                                                    <a class="py-3 px-4 text-center rounded-md bg-lime-300 font-bold text-white cursor-pointer hover:bg-lime-400" wire:click="edit({{ $item }})">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a class="py-3 px-5 text-center ml-2 rounded-md bg-indigo-300 font-bold text-white cursor-pointer hover:bg-indigo-400">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            
            @if ($talleres->hasPages())
                <div>
                    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-2 overflow-x-auto">
                        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <div class="px-5 py-5 bg-white border-t">
                                {{ $talleres->links() }}
                            </div>
                        </div>
                    </div>
                </div>                        
            @endif
            
        @else
            <div class="px-6 py-4 text-center font-bold bg-indigo-200 rounded-md">
                No se encontro ningun registro.
            </div>
        @endif   
        </x-table>        
   </div> 

   <x-jet-dialog-modal wire:model="editando" wire:loading.attr="disabled" wire:target="deleteFile">
    <x-slot name="title" class="font-bold">
      <h1 class="text-xl font-bold">Editar Taller</h1> 
    </x-slot>

    <x-slot name="content">     
        <div class="mb-4">
            <x-jet-label value="Nombre:" />
            <x-jet-input wire:model="taller.nombre" type="text" class="w-full" />
            <x-jet-input-error for="taller.nombre" />            
        </div>     
        <div class="mb-4">
          <x-jet-label value="Direccion:" />
          <x-jet-input wire:model="taller.direccion" type="text" class="w-full" />
          <x-jet-input-error for="taller.direccion" />
      </div>  
      <div class="mb-4">
        <x-jet-label value="RUC:" />
        <x-jet-input wire:model="taller.ruc" type="text" class="w-full" />
        <x-jet-input-error for="taller.ruc" />
    </div>

    <div class="grid grid-flow-row-dense grid-cols-2">

        <div>
            <x-jet-label value="Departamento:" />
            <select wire:model="departamentoSel" class="bg-gray-50 border-indigo-500 rounded-md outline-none w-full">
                <option value="null">Seleccione</option>
                @foreach ($departamentosTaller as $depart)
                    <option value="{{ $depart->id }}">{{ $depart->departamento }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="departamentoSel"/>
        </div>              
        
        <div>
            <x-jet-label value="Provincia:"/>
            <select wire:model="provinciaSel" class="bg-gray-50 border-indigo-500 rounded-md outline-none w-full">
                @if ($provinciasTaller)
                    <option value="null">Seleccione</option>
                    @foreach ($provinciasTaller as $prov)
                        <option value="{{ $prov->id }}">{{ $prov->provincia }}</option>
                    @endforeach
                @else
                    <option value="">Seleccione Depart.</option>
                @endif
                
            </select>
            <x-jet-input-error for="provinciaSel"/>
        </div>               
    </div>

    

    <div class="mb-4">
        <x-jet-label value="Distrito:" />
        <select wire:model="taller.idDistrito" class="bg-gray-50 border-indigo-500 rounded-md outline-none w-full pr-2 ">
            @if ($distritosTaller)
                <option value="null">Seleccione</option>
                @foreach ($distritosTaller as $dist)
                    <option value="{{ $dist->id }}">{{ $dist->distrito }}</option>
                @endforeach
            @else
                <option value="">Seleccione Prov.</option>
            @endif                       
        </select>
        <x-jet-input-error for="distritoSel"/>
    </div>

    <div class="mb-4">
        <x-jet-label value="Logo:" />
        <x-jet-input type="file"  class="w-full" wire:model="logo"
            accept=".jpg,.png,.jpeg,.gif,.bmp,.tif,.tiff" />
        <x-jet-input-error for="logo" />                
    </div>
    <div wire:loading wire:target="logo"
        class="my-4 w-full px-6 py-4 text-center font-bold bg-indigo-200 rounded-md">
        Espere un momento mientras se carga la imagen.
    </div>
    @if($logoTaller)            
        
            <div class="w-full p-1 md:p-2 items-center justify-center">
                <img alt="gallery"
                    class="mx-auto flex object-cover object-center w-36 h-36 rounded-lg"
                    src="{{Storage::url($logoTaller)}}">                
            </div>
        
    @endif

    <div class="mb-4">
        <x-jet-label value="Firma:" />
        <x-jet-input type="file"  class="w-full" wire:model="firma"
            accept=".jpg,.png,.jpeg,.gif,.bmp,.tif,.tiff" />
        <x-jet-input-error for="firma" />                
    </div>
    <div wire:loading wire:target="firma"
        class="my-4 w-full px-6 py-4 text-center font-bold bg-indigo-200 rounded-md">
        Espere un momento mientras se carga la imagen.
    </div>
    @if($firmaTaller)          
        <div class="w-full p-1 md:p-2 items-center justify-center">
            <img alt="gallery" class="mx-auto flex object-fit object-center w-36 h-36 rounded-lg" src="{{Storage::url($firmaTaller)}}">                
        </div>        
    @endif    

    @if($taller) 
      @if(count($taller->servicios))
      <h1 class="font-bold text-lg"> Servicios</h1>
      <hr class="my-4">
      <div class="mb-4" wire:loading.attr="disabled" wire:target="actualizar">
        @foreach ($taller->servicios as $key=>$serv)
        <div class="flex flex-row justify-between bg-indigo-100 my-2 items-center rounded-lg p-2">
            <div class="">
                <input wire:model="taller.servicios.{{$key}}.estado" class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white outline-transparent checked:bg-indigo-600 checked:border-indigo-600 outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox">
                <label class="form-check-label inline-block text-gray-800">
                    {{ $serv->tiposervicio->descripcion }}
                </label>                        
            </div>
            <div class="flex flex-row items-center">
                <x-jet-label value="precio:"/>
                <x-jet-input type="text" class="w-6px" wire:model="taller.servicios.{{$key}}.precio" /> 
                                       
            </div>  
            <x-jet-input-error for="taller.servicios.{{$key}}.estado" />
            <x-jet-input-error for="taller.servicios.{{$key}}.precio" />                   
        </div>
        @endforeach
      </div>
      @else
        <div class="w-full align-center justify-center">
          <h1>No se encontraron servicios</h1>
        </div>
      @endif 
    @endif   
             
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('editando',false)" class="mx-2">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-button wire:click="actualizar" wire:loading.attr="disabled" wire:target="update">
            Actualizar
        </x-jet-button>      

    </x-slot>  
    
  </x-jet-dialog-modal>
   
</div>
