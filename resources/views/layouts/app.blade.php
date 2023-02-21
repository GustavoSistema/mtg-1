<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/mtg.png') }}" />
    <title>MOTORGAS</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <!-- Styles -->

    {{--
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/pikaday.css') }}" rel="stylesheet">
    --}}


    @stack('styles')

    @livewireStyles


    <!-- Scripts
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.0.1/dist/chart.umd.min.js"></script>

         -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts

    @stack('js')

    <script src="https://kit.fontawesome.com/2e81971293.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
    <script>
        livewire.on('alert', function(message) {
            Swal.fire(
                'Buen trabajo!',
                message,
                'success'
            )
        });
    </script>

    <script>
        livewire.on('CustomAlert', function(params) {
            Swal.fire(
                params["titulo"],
                params["mensaje"],
                params["icono"],
            )
        });
    </script>

    
    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        });
        livewire.on('minAlert', function(params) {
            Toast.fire(
            params["titulo"],
            params["mensaje"],
            params["icono"],
            )
        });
    </script>
    <script>
        Livewire.on('updateChart', data => {
            chart.data = data;
            chart.update();
        });
    </script>
</body>

</html>
