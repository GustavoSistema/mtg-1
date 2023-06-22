<div>
    <div class="w-full pt-4">
        <div class="-mx-12 w-full pt-12  my-8 bg-indigo-100 px-4 text-center mx-auto">
            @if (isset($services))
           
            @if($services->count())                                    
                    <h1>REPORTE DE SERVICIOS POR INSPECTOR</h1>
                    <div class="flex flex-row my-4 py-4 rounded-md bg-white px-4 justify-center">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 mx-12 w-full">
                            <div class="inline-block min-w-full py-2 sm:px-6 ">
                                <div class="overflow-hidden">
                                    <table class="min-w-full border text-center text-sm font-light dark:border-neutral-500">
                                        <thead class="border-b font-medium dark:border-neutral-500">
                                            <tr class="bg-indigo-200">
                                                <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                                                    #
                                                </th>
                                                <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                                                    Inspector
                                                </th>
                                                <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                                                    Servicios en Gasolution
                                                </th>
                                                <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                                                    Servicios en Sistema
                                                </th>                                       
                                            </tr>
                                        </thead>                                
                                        <tbody>
                                            @foreach ($services as $key=>$item) 
                                                <tr class="border-b dark:border-neutral-500">
                                                    <td class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                                                        {{ $key+1 }}
                                                    </td>
                                                    <td class="whitespace-nowrap border-r px-6 py-4 font-medium dark:border-neutral-500">
                                                        {{ $item->certificador}}
                                                    </td>
                                                    <td class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                                                        {{ $item->serviciosGasolution }}
                                                    </td>
                                                    <td class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                                                        {{ $item->serviciosMtg }}
                                                    </td>                                                    
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>                                  
            @endif
            @endif
        </div>
    </div>
</div>
