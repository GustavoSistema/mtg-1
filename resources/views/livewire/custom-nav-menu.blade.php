<!-- component -->
<!--
Change class "fixed" to "sticky" in "navbar" (l. 33) so the navbar doesn't hide any of your page content!
-->
<div>
<style>
    ul.breadcrumb li+li::before {
        content: "";
        padding-left: 8px;
        padding-right: 4px;
        color: inherit;
    }

    ul.breadcrumb li span {
        opacity: 60%;
    }

    #sidebar {
        -webkit-transition: all 300ms cubic-bezier(0, 0.77, 0.58, 1);
        transition: all 300ms cubic-bezier(0, 0.77, 0.58, 1);
    }

    #sidebar.show {
        transform: translateX(0);
    }

    #sidebar ul li a.active {
        background: #1f2937;
        background-color: #1f2937;
    }
</style>

<!-- Navbar start -->
<nav id="navbar"
    class="fixed top-0 z-40 flex w-full flex-row justify-between bg-gray-500 px-4 shadow-lg border-b border-gray-200">
    {{--
    <ul class="breadcrumb hidden flex-row items-center py-4 text-lg text-white sm:flex">
        <li class="inline">
            <a href="#">Main</a>
        </li>
        <li class="inline">
            <span>Homepage</span>
        </li>
    </ul>
    --}}
    <button id="btnSidebarToggler" type="button" class="py-4 text-2xl text-white hover:text-black">
        <svg id="navClosed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="h-8 w-8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
        <svg id="navOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="hidden h-8 w-8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <a href="{{ route('dashboard') }}" class="py-2 h-1/2">
        <img src="{{ asset('images/logo.png') }}" width="120" />
    </a>


    <div class="hidden  md:flex  md:items-center">
        <x-jet-dropdown width="48">
            <x-slot name="trigger">
                <div class="m-4 inline-flex relative w-fit">
                    @if (Auth()->user()->unreadNotifications->count())
                        <span
                            class="absolute inline-block top-0 right-0 bottom-auto left-auto translate-x-2/4 -translate-y-1/2 rotate-0 skew-x-0 skew-y-0 scale-x-100 scale-y-100 rounded-full z-10">
                            <span
                                class=" absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75 animate-ping"></span>
                            <span
                                class="relative inline-flex rounded-full px-2 text-white bg-indigo-500 items-center m-auto text-xs">
                                {{ Auth()->user()->unreadNotifications->count() }}
                            </span>
                        </span>
                    @else
                    @endif
                    <div class="flex items-center justify-center text-center">
                        <i class="fas fa-bell fa-xl text-white hover:text-black"></i>
                    </div>
                </div>
            </x-slot>

            <x-slot name="content">
                <!-- Account Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Tienes ' .Auth()->user()->unreadNotifications->count() .' notificaciones') }}
                </div>
                @foreach (Auth()->user()->unreadNotifications as $notification)
                    @if ($notification->type == 'App\Notifications\CreateSolicitud')
                        <x-jet-dropdown-link
                            href="{{ route('leerNotificacion', [$notification->id, $notification->data['idSoli']]) }}">
                            <p class="text-xs "> Nueva solicitud de Materiales de <strong
                                    class="text-indigo-500">{{ $notification->data['inspector'] }}</strong></p>
                        </x-jet-dropdown-link>
                        <div class="border-t border-gray-100"></div>
                    @endif
                @endforeach


                <!-- Authentication -->

            </x-slot>
        </x-jet-dropdown>
        <x-jet-dropdown width="48">
            <x-slot name="trigger">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <button
                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    </button>
                @else
                    <span class="inline-flex rounded-md">
                        <button type="button"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white  hover:text-black focus:outline-none transition">
                            <i class="fa-solid fa-user-gear fa-lg"></i>
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </span>
                @endif
            </x-slot>

            <x-slot name="content">
                <!-- Account Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Administrar Cuenta') }}
                </div>

                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                    {{ __('Perfil') }}
                </x-jet-dropdown-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                        {{ __('API Tokens') }}
                    </x-jet-dropdown-link>
                @endif

                <div class="border-t border-gray-100"></div>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Salir') }}
                    </x-jet-dropdown-link>
                </form>
            </x-slot>
        </x-jet-dropdown>
    </div>

</nav>
<!-- Navbar end -->

<!-- Sidebar start-->
<div id="containerSidebar" class="z-40">
    <div class="navbar-menu relative z-40">
        <nav id="sidebar"
            class="fixed left-0 bottom-0 flex w-3/4 -translate-x-full flex-col overflow-y-auto bg-gray-700 pt-6 pb-8 sm:max-w-xs lg:w-80">
            <!-- one category / navigation group -->
            <div class="px-4">
                <h3 class="mb-2 text-xs font-medium uppercase text-gray-500">
                    Menu principal
                </h3>
                <ul class="mb-8 text-sm font-medium">
                    <li>
                        <a class="flex items-center rounded py-3 pl-3 pr-4  space-x-6 text-gray-50 hover:bg-gray-600"
                            href="{{ route('dashboard') }}">
                            <i class="fas fa-home -mt-1"></i>
                            <span class="select-none">Inicio</span>
                        </a>
                    </li>

                    {{--                     OPCIONES PARA SERVICIOS                    --}}
                    @hasanyrole('inspector|administrador|supervisor')
                        <li class="text-gray-50 py-3 pl-3 pr-4 hover:bg-gray-600 focus:bg-gray-600 rounded"
                            x-data="{ Open: false }">
                            <div class="inline-flex  items-center justify-between w-full transition-colors duration-150 text-gray-500  cursor-pointer"
                                x-on:click="Open = !Open">
                                <span class="inline-flex items-center space-x-6  text-sm text-white ">
                                    <i class="fa-solid fa-screwdriver-wrench font-thin"></i>
                                    <span class="select-none font-semibold">Servicios</span>
                                </span>
                                <i class="fa-solid fa-caret-down ml-1  text-white w-4 h-4" x-show="!Open"></i>

                                <i class="fa-solid fa-caret-up ml-1  text-white w-4 h-4" x-show="Open"></i>
                            </div>

                            <div x-show.transition="Open" style="display:none;">
                                <ul x-transition:enter="transition-all ease-in-out duration-300"
                                    x-transition:enter-start="opacity-25 max-h-0"
                                    x-transition:enter-end="opacity-100 max-h-xl"
                                    x-transition:leave="transition-all ease-in-out duration-300"
                                    x-transition:leave-start="opacity-100 max-h-xl"
                                    x-transition:leave-end="opacity-0 max-h-0"
                                    class="mt-2 divide-y-2 divide-gray-600 overflow-hidden text-sm font-medium bg-gray-600 text-white shadow-inner"
                                    aria-label="submenu">

                                    @can('servicio')
                                        <li class="transition-colors duration-150">

                                            <x-jet-responsive-nav-link class="text-sm" href="{{ route('servicio') }}"
                                                :active="request()->routeIs('servicio')">
                                                Nuevo Servicio
                                            </x-jet-responsive-nav-link>
                                        </li>
                                    @endcan
                                    @can('certificaciones')
                                        <li class="transition-colors duration-150">
                                            <x-jet-responsive-nav-link class="text-sm" href="{{ route('certificaciones') }}"
                                                :active="request()->routeIs('certificaciones')">
                                                Listado de Servicios
                                            </x-jet-responsive-nav-link>
                                        </li>
                                    @endcan
                                    @can('admin.certificaciones')
                                        <li class="transition-colors duration-150">
                                            <x-jet-responsive-nav-link class="bg-gray-400 text-sm"
                                                href="{{ route('admin.certificaciones') }}" :active="request()->routeIs('admin.certificaciones')">
                                                Admin. Servicios
                                            </x-jet-responsive-nav-link>
                                        </li>
                                    @endcan
                                </ul>

                            </div>
                        </li>
                    @endhasanyrole

                    {{--                     OPCIONES PARA EXPEDIENTES                  --}}
                    @hasanyrole('inspector|administrador|supervisor|Administrador taller')
                        <li class="text-gray-50 py-3 pl-3 pr-4 hover:bg-gray-600 focus:bg-gray-600 rounded"
                            x-data="{ Open: false }">
                            <div class="inline-flex  items-center justify-between w-full  transition-colors duration-150 text-gray-500  cursor-pointer"
                                x-on:click="Open = !Open">
                                <span class="inline-flex items-center space-x-6  text-sm  text-white ">
                                    <i class="fa-solid fa-file-shield"></i>
                                    <span class="select-none font-semibold">Expedientes</span>
                                </span>
                                <i class="fa-solid fa-caret-down ml-1  text-white w-4 h-4" x-show="!Open"></i>

                                <i class="fa-solid fa-caret-up ml-1  text-white w-4 h-4" x-show="Open"></i>
                            </div>
                            <div x-show.transition="Open" style="display:none;">
                                <ul x-transition:enter="transition-all ease-in-out duration-300"
                                    x-transition:enter-start="opacity-25 max-h-0"
                                    x-transition:enter-end="opacity-100 max-h-xl"
                                    x-transition:leave="transition-all ease-in-out duration-300"
                                    x-transition:leave-start="opacity-100 max-h-xl"
                                    x-transition:leave-end="opacity-0 max-h-0"
                                    class="mt-2 divide-y-2 divide-gray-600 overflow-hidden text-sm font-medium bg-gray-600 text-white shadow-inner"
                                    aria-label="submenu">
                                    @can('expedientes')
                                        <x-jet-responsive-nav-link class="text-sm" href="{{ route('expedientes') }}" :active="request()->routeIs('expedientes')">
                                            {{ __('Listado Expedientes') }}
                                        </x-jet-responsive-nav-link>
                                    @endcan

                                    @can('revisionExpedientes')
                                        <x-jet-responsive-nav-link href="{{ route('revisionExpedientes') }}"
                                            :active="request()->routeIs('revisionExpedientes')">
                                            {{ __(' Revisión Expedientes') }}
                                        </x-jet-responsive-nav-link>
                                    @endcan
                                    @can('talleres.revision')
                                        <x-jet-responsive-nav-link class="text-sm"  href="{{ route('talleres.revision') }}" :active="request()->routeIs('talleres.revision')">
                                            {{ __('Expedientes de taller') }}
                                        </x-jet-responsive-nav-link>
                                    @endcan
                                </ul>

                            </div>
                        </li>
                    @endhasanyrole

                    {{--                     OPCIONES PARA TALLERES                    --}}
                    @hasanyrole('administrador|Administrador taller')
                        <li class="text-gray-50 py-3 pl-3 pr-4 hover:bg-gray-600 focus:bg-gray-600 rounded"
                            x-data="{ Open: false }">
                            <div class="inline-flex  items-center justify-between w-full  transition-colors duration-150 text-gray-500  cursor-pointer"
                                x-on:click="Open = !Open">
                                <span class="inline-flex items-center space-x-6  text-sm  text-white ">
                                    <i class="fa-solid fa-warehouse font-thin"></i>
                                    <span class="select-none font-semibold">Talleres</span>
                                </span>
                                <i class="fa-solid fa-caret-down ml-1  text-white w-4 h-4" x-show="!Open"></i>

                                <i class="fa-solid fa-caret-up ml-1  text-white w-4 h-4" x-show="Open"></i>
                            </div>
                            <div x-show.transition="Open" style="display:none;">
                                <ul x-transition:enter="transition-all ease-in-out duration-300"
                                    x-transition:enter-start="opacity-25 max-h-0"
                                    x-transition:enter-end="opacity-100 max-h-xl"
                                    x-transition:leave="transition-all ease-in-out duration-300"
                                    x-transition:leave-start="opacity-100 max-h-xl"
                                    x-transition:leave-end="opacity-0 max-h-0"
                                    class="mt-2 divide-y-2 divide-gray-600 overflow-hidden text-sm font-medium bg-gray-600 text-white shadow-inner"
                                    aria-label="submenu">
                                    @can('talleres')
                                        <x-jet-responsive-nav-link class="text-sm" href="{{ route('talleres') }}"
                                            :active="request()->routeIs('talleres')">
                                            Listado de talleres
                                        </x-jet-responsive-nav-link>
                                    @endcan
                                    
                                    @can('editar-taller')
                                        <x-jet-responsive-nav-link class="text-sm"
                                            href="{{ route('editar-taller', Auth::user()->taller) }}" :active="request()->routeIs('edtiar-taller')">
                                            Datos de taller
                                        </x-jet-responsive-nav-link>
                                    @endcan
                                    
                                </ul>

                            </div>
                        </li>
                    @endhasanyrole

                    {{--                    OPCIONES PARA MATERIALES                    --}}
                    @hasanyrole('inspector|administrador|supervisor')
                        <li class="text-gray-50 py-3 pl-3 pr-4 hover:bg-gray-600 focus:bg-gray-600 rounded "
                            x-data="{ Open: false }">
                            <div class="inline-flex  items-center justify-between w-full transition-colors duration-150 text-gray-500  cursor-pointer"
                                x-on:click="Open = !Open">
                                <span class="inline-flex items-center space-x-6  text-sm  text-white ">
                                    <i class="fa-solid fa-cubes font-thin"></i>
                                    <span class="select-none font-semibold">Materiales</span>
                                </span>
                                <i class="fa-solid fa-caret-down ml-1  text-white w-4 h-4" x-show="!Open"></i>

                                <i class="fa-solid fa-caret-up ml-1  text-white w-4 h-4" x-show="Open"></i>
                            </div>
                            <div x-show.transition="Open" style="display:none;">
                                <ul x-transition:enter="transition-all ease-in-out duration-300"
                                    x-transition:enter-start="opacity-25 max-h-0"
                                    x-transition:enter-end="opacity-100 max-h-xl"
                                    x-transition:leave="transition-all ease-in-out duration-300"
                                    x-transition:leave-start="opacity-100 max-h-xl"
                                    x-transition:leave-end="opacity-0 max-h-0"
                                    class="mt-2 divide-y-2 divide-gray-600 overflow-hidden text-sm font-medium bg-gray-600 text-white shadow-inner"
                                    aria-label="submenu">
                                    @can('inventario')
                                        <x-jet-responsive-nav-link class="text-sm" href="{{ route('inventario') }}"
                                            :active="request()->routeIs('inventario')">
                                            {{ __('Inventario') }}
                                        </x-jet-responsive-nav-link>
                                    @endcan
                                    @can('inventario.revision')
                                        <x-jet-responsive-nav-link class="text-sm" href="{{ route('inventario.revision') }}"
                                            :active="request()->routeIs('inventario.revision')">
                                            {{ __('Revision de Inventarios') }}
                                        </x-jet-responsive-nav-link>
                                    @endcan
                                    @can('ingresos')
                                        <x-jet-responsive-nav-link class="text-sm" href="{{ route('ingresos') }}"
                                            :active="request()->routeIs('ingresos')">
                                            {{ __('Ingreso de Materiales') }}
                                        </x-jet-responsive-nav-link>
                                    @endcan
                                    @can('salidas')
                                        <x-jet-responsive-nav-link class="text-sm" href="{{ route('salidas') }}"
                                            :active="request()->routeIs('salidas')">
                                            {{ __('Salida de materiales') }}
                                        </x-jet-responsive-nav-link>
                                    @endcan

                                    @can('asignacion')
                                        <x-jet-responsive-nav-link class="text-sm" href="{{ route('asignacion') }}"
                                            :active="request()->routeIs('asignacion')">
                                            {{ __('Asignación de materiales') }}
                                        </x-jet-responsive-nav-link>
                                    @endcan
                                    @can('materiales.prestamo')
                                        <x-jet-responsive-nav-link class="text-sm" href="{{ route('materiales.prestamo') }}"
                                            :active="request()->routeIs('materiales.prestamo')">
                                            {{ __('Préstamo de materiales') }}
                                        </x-jet-responsive-nav-link>
                                    @endcan
                                    @can('solicitud')
                                        <x-jet-responsive-nav-link class="text-sm" href="{{ route('solicitud') }}"
                                            :active="request()->routeIs('solicitud')">
                                            {{ __('Solicitud de materiales') }}
                                        </x-jet-responsive-nav-link>
                                    @endcan

                                    @can('recepcion')
                                        <x-jet-responsive-nav-link class="text-sm" href="{{ route('recepcion') }}"
                                            :active="request()->routeIs('recepcion')">
                                            {{ __('Recepción de materiales') }}
                                        </x-jet-responsive-nav-link>
                                    @endcan

                                </ul>

                            </div>
                        </li>
                    @endhasanyrole

                    {{--                     OPCIONES PARA USUARIOS Y ROLES                  --}}
                    @hasanyrole('administrador')
                        <li class="text-gray-50 py-3 pl-3 pr-4 hover:bg-gray-600 focus:bg-gray-600 rounded"
                            x-data="{ Open: false }">
                            <div class="inline-flex  items-center justify-between w-full  transition-colors duration-150 text-gray-500  cursor-pointer"
                                x-on:click="Open = !Open">
                                <span class="inline-flex items-center space-x-6  text-sm  text-white ">
                                    <i class="fa-solid fa-user-shield font-thin"></i>
                                    <span class="select-none font-semibold">Usuarios y roles</span>
                                </span>
                                <i class="fa-solid fa-caret-down ml-1  text-white w-4 h-4" x-show="!Open"></i>

                                <i class="fa-solid fa-caret-up ml-1  text-white w-4 h-4" x-show="Open"></i>
                            </div>
                            <div x-show.transition="Open" style="display:none;">
                                <ul x-transition:enter="transition-all ease-in-out duration-300"
                                    x-transition:enter-start="opacity-25 max-h-0"
                                    x-transition:enter-end="opacity-100 max-h-xl"
                                    x-transition:leave="transition-all ease-in-out duration-300"
                                    x-transition:leave-start="opacity-100 max-h-xl"
                                    x-transition:leave-end="opacity-0 max-h-0"
                                    class="mt-2 divide-y-2 divide-gray-600 overflow-hidden text-sm font-medium bg-gray-600 text-white shadow-inner"
                                    aria-label="submenu">

                                    <x-jet-responsive-nav-link class="text-sm" href="{{ route('usuarios') }}"
                                        :active="request()->routeIs('usuarios')">
                                        Usuarios
                                    </x-jet-responsive-nav-link>
                                    <x-jet-responsive-nav-link class="text-sm" href="{{ route('usuarios.roles') }}"
                                        :active="request()->routeIs('usuarios.roles')">
                                        Roles
                                    </x-jet-responsive-nav-link>
                                    <x-jet-responsive-nav-link class="text-sm" href="{{ route('usuarios.permisos') }}"
                                        :active="request()->routeIs('usuarios.permisos')">
                                        Permisos
                                    </x-jet-responsive-nav-link>

                                </ul>

                            </div>
                        </li>
                    @endhasanyrole


                </ul>
            </div>

            <!-- navigation group end-->

            <!-- example copies start -->
            <div class="md:hidden block fixed bottom-0 left-0 px-4 w-full">
                <h3 class="mb-2 text-xs font-medium uppercase text-gray-500">
                    Opciones de la cuenta
                </h3>
                <ul class="mb-8 text-sm font-medium ">
                    <li>
                        <a class="flex items-center rounded py-3 pl-3 pr-4  space-x-6 text-gray-50 hover:bg-gray-600 "
                            href="{{ route('profile.show') }}">
                            <i class="fa-solid fa-user-gear -mt-1"></i>
                            <span class="select-none">Configurar Perfil</span>
                        </a>
                    </li>
                    <li>


                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <a class="flex items-center rounded py-3 pl-3 pr-4  space-x-6 text-gray-50 hover:bg-gray-600 "
                                href="{{ route('logout') }}" @click.prevent="$root.submit();">                                
                                <i class="fa-solid fa-arrow-right-from-bracket -mt-1"></i>
                                <span class="select-none">Salir</span>
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
            <!-- example copies end -->
        </nav>
    </div>

</div>
<!-- Sidebar end -->

<main>
    <!-- your content goes here -->
</main>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", () => {
        const navbar = document.getElementById("navbar");
        const sidebar = document.getElementById("sidebar");
        const btnSidebarToggler = document.getElementById("btnSidebarToggler");
        const navClosed = document.getElementById("navClosed");
        const navOpen = document.getElementById("navOpen");

        btnSidebarToggler.addEventListener("click", (e) => {
            e.preventDefault();
            sidebar.classList.toggle("show");
            navClosed.classList.toggle("hidden");
            navOpen.classList.toggle("hidden");
        });

        sidebar.style.top = parseInt(navbar.clientHeight) - 1 + "px";
    });
</script>
</div>