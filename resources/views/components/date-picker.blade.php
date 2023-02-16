@props(['model'])

<input type="text" id="datepicker" wire:model="{{$model}}" autocomplete="off" class="block w-full disabled:bg-indigo-300 p-2 border border-indigo-600 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm sm:leading-5">

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css"> 
@endpush
@push('js')
    <script src="https://unpkg.com/moment"></script>
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    <script>
        var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        format: 'D/MM/YYYY',
        onSelect: function() {
            console.log(this.getMoment().format('D M Y'));
        }
    });
    </script> 
@endpush


