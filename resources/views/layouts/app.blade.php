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
    @livewireScripts    

    <!-- Scripts
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.0.1/dist/chart.umd.min.js"></script>

         -->
   
</head>

<body class="font-sans antialiased"  x-data="data()">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-100">
        {{-- 
        
           
        @livewire('custom-nav-menu')
        --}}
        @livewire('navigation-menu')

        <!-- Page Content -->
        <main class="mt-12">
            {{ $slot }}
        </main>
        


        {{--
        <div class="flex h-screen bg-white " :class="{ 'overflow-hidden': isSideMenuOpen }">

            <!-- Desktop sidebar -->
            <aside class="z-20 flex-shrink-0 hidden w-60 pl-2 overflow-y-auto bg-white md:block">
                <div>
                    <div class="text-slate-700 ">
                        <div class="flex p-2  bg-white">
                            <div class="flex py-3 px-2 items-center">
                                <p class="text-lg text-red-500 font-semibold italic">MOTORGAS</p> <p class="ml-2 font-semibold text-black italic">
                                    COMPANY</p>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <div class="">
                                <img src="{{ asset('images/mtg.png') }}" width="100" height="150"/>
                            </div>
                        </div>
                        <div>
                            <ul class="mt-6 leading-10 divide-y-2">
                               
                                <li class="relative px-2 py-1 ">
                                    <a class="flex items-center w-full text-sm font-semibold transition-colors duration-150 cursor-pointer hover:text-indigo-500" 
                                        href="{{route("dashboard")}}">
                                        <i class="fas fa-home fa-xl h-6 w-6  mt-4"></i>
                                        <span class="ml-4">Inicio</span>
                                    </a>
                                </li>
                                @hasanyrole('inspector|administrador|supervisor')
                                <li class="relative px-2 py-1" x-data="{ Open : false  }">
                                    <div class="inline-flex items-center justify-between w-full text-base font-semibold transition-colors duration-150 text-gray-500  hover:text-yellow-400 cursor-pointer"
                                        x-on:click="Open = !Open">
                                        <span
                                            class="inline-flex items-center  text-sm font-semibold hover:text-indigo-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20" />
                                            </svg>
                                            <span class="ml-4">Servicios</span>
                                        </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" x-show="!Open"
                                            class="ml-1  text-gray-400 w-4 h-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" style="display: none;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 19l-7-7 7-7" />
                                        </svg>
    
                                        <svg xmlns="http://www.w3.org/2000/svg" x-show="Open"
                                            class="ml-1  text-gray-400 w-4 h-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" style="display: none;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
    
                                    <div x-show.transition="Open" style="display:none;">
                                        <ul x-transition:enter="transition-all ease-in-out duration-300"
                                            x-transition:enter-start="opacity-25 max-h-0"
                                            x-transition:enter-end="opacity-100 max-h-xl"
                                            x-transition:leave="transition-all ease-in-out duration-300"
                                            x-transition:leave-start="opacity-100 max-h-xl"
                                            x-transition:leave-end="opacity-0 max-h-0"
                                            class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium  rounded-md shadow-inner  bg-indigo-400"
                                            aria-label="submenu">
    
                                            <li class="px-2 py-1  transition-colors duration-150">
                                                <div class="px-1 hover:text-gray-800 hover:bg-gray-100 rounded-md">
                                                    <div class="flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                                        </svg>
                                                        <a href="#"
                                                            class="w-full ml-2  text-sm font-semibold  hover:text-gray-800">Item
                                                            1</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                @endhasanyrole
                            </ul>
                        </div>
                    </div>
                </div>
            </aside>
    
            <!-- Mobile sidebar -->
            <!-- Backdrop -->
            <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
    
            <aside
                class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto  bg-gray-200 dark:bg-gray-800 md:hidden"
                x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
                x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
                @keydown.escape="closeSideMenu">
                <div>
                    <div class="text-black">
                        <div class="flex p-2  bg-white">
                            <div class="flex py-3 px-2 items-center">
                                <p class="text-2xl text-indigo-500 font-semibold">SA</p> <p class="ml-2 font-semibold italic">
                                DASHBOARD</p>
                            </div>
                        </div>
                        <div>
                            <ul class="mt-6 leading-10">
                                <li class="relative px-2 py-1 ">
                                    <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-indigo-500"
                                        href=" #">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        <span class="ml-4">DASHBOARD</span>
                                    </a>
                                </li>
                                <li class="relative px-2 py-1" x-data="{ Open : false  }">
                                    <div class="inline-flex items-center justify-between w-full text-base font-semibold transition-colors duration-150 text-gray-500  hover:text-yellow-400 cursor-pointer"
                                        x-on:click="Open = !Open">
                                        <span
                                            class="inline-flex items-center  text-sm font-semibold text-white hover:text-indigo-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20" />
                                            </svg>
                                            <span class="ml-4">ITEM</span>
                                        </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" x-show="!Open"
                                            class="ml-1  text-white w-4 h-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" style="display: none;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 19l-7-7 7-7" />
                                        </svg>
    
                                        <svg xmlns="http://www.w3.org/2000/svg" x-show="Open"
                                            class="ml-1  text-white w-4 h-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" style="display: none;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
    
                                    <div x-show.transition="Open" style="display:none;">
                                        <ul x-transition:enter="transition-all ease-in-out duration-300"
                                            x-transition:enter-start="opacity-25 max-h-0"
                                            x-transition:enter-end="opacity-100 max-h-xl"
                                            x-transition:leave="transition-all ease-in-out duration-300"
                                            x-transition:leave-start="opacity-100 max-h-xl"
                                            x-transition:leave-end="opacity-0 max-h-0"
                                            class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium  rounded-md shadow-inner  bg-indigo-400"
                                            aria-label="submenu">
    
                                            <li class="px-2 py-1 text-white transition-colors duration-150">
                                                <div class="px-1 hover:text-gray-800 hover:bg-gray-100 rounded-md">
                                                    <div class="flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                                        </svg>
                                                        <a href="#"
                                                            class="w-full ml-2  text-sm font-semibold text-white hover:text-gray-800">Item
                                                            1</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </aside>
    
            <div class="flex flex-col flex-1 w-full overflow-y-auto">
                <header class="z-40 py-4  bg-white  ">
                    <div class="flex items-center justify-between md:justify-end h-8 px-6 mx-auto">
                        <!-- Mobile hamburger -->
                        <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
                            @click="toggleSideMenu" aria-label="Menu">                        
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-black" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </button>
    
                        <!-- Search Input -->
                       
    
                        <ul class="flex items-center flex-shrink-0 space-x-6 mr-4">
    
                            <!-- Notifications menu -->
                            <li class="relative">
                                <button
                                    class="p-2 bg-white border text-indigo-400 align-middle rounded-full hover:text-white hover:bg-indigo-400 focus:outline-none "
                                    
                                    
                                    @click.="toggleNotificationsMenu" @keydown.escape="closeNotificationsMenu"
                                    aria-label="Notifications" aria-haspopup="true">
                                    <div class="flex items-cemter">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        </svg>
                                    </div>
                                    <!-- Notification badge -->
                                    <span aria-hidden="true"
                                        class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800"></span>
                                </button>
                                <template x-if="isNotificationsMenuOpen">
                                    <ul x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                        @click.="closeNotificationsMenu" @keydown.escape="closeNotificationsMenu"
                                        class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-indigo-400 border border-indigo-500 rounded-md shadow-md">
                                        <li class="flex">
                                            <a class="text-white inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800"
                                                href="#">
                                                <span>Messages</span>
                                                <span
                                                    class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600">
                                                    13
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </template>
                            </li>
    
                            <!-- Profile menu -->
                            <li class="relative">
                                <button
                                    class="p-2 bg-white border text-indigo-400 align-middle rounded-full hover:text-white hover:bg-indigo-400 focus:outline-none "
                                    x-on:click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account"
                                    aria-haspopup="true">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                </button>
                                <template x-if="isProfileMenuOpen">
                                    <ul x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                        @click.="closeProfileMenu" @keydown.escape="closeProfileMenu"
                                        class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-indigo-400 border border-indigo-500 rounded-md shadow-md"
                                        aria-label="submenu">
                                        <li class="flex">
                                            <a class=" text-white inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800"
                                                href="{{ route('profile.show') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>Perfil</span>
                                            </a>
                                        </li>
                                        <li class="flex">
                                            <a class="text-white inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800"
                                                href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                                <span>Log out</span>
                                            </a>
                                        </li>
                                    </ul>
                                </template>
                            </li>
                        </ul>
    
                    </div>
                </header>
                <main class="">
                    <div class="grid min-h-screen mb-4 pb-10 px-8 mx-4 rounded-3xl bg-gray-100 border-4 border-indigo-400">
                        {{$slot}}
                    </div>
                </main>
            </div>
        </div>      
        --}}




    </div>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @stack('modals')

    
    

    
           
       
    <script src="https://kit.fontawesome.com/2e81971293.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @fcScripts
    @stack('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        function data() {
          
            return {
               
                isSideMenuOpen: false,
                toggleSideMenu() {
                    this.isSideMenuOpen = !this.isSideMenuOpen
                },
                closeSideMenu() {
                    this.isSideMenuOpen = false
                },
                isNotificationsMenuOpen: false,
                toggleNotificationsMenu() {
                    this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
                },
                closeNotificationsMenu() {
                    this.isNotificationsMenuOpen = false
                },
                isProfileMenuOpen: false,
                toggleProfileMenu() {
                    this.isProfileMenuOpen = !this.isProfileMenuOpen
                },
                closeProfileMenu() {
                    this.isProfileMenuOpen = false
                },
                isPagesMenuOpen: false,
                togglePagesMenu() {
                    this.isPagesMenuOpen = !this.isPagesMenuOpen
                },
               
            }
        }
    </script>    
   
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
            chart1.data = data;
            chart1.update();
        });
    </script>
    
</body>

</html>
