<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>
@stack('styles')
<link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap" rel="stylesheet">

<body class="w-5/6 m-auto py-10">
    <header class="w-full flex justify-between items-center bg-gray-200 px-4 py-6 rounded-md">
        <img src="{{ asset('images/logo.png') }}" class="w-24">
        <div class="w-full">
            <p class="font-bold text-2xl w-full text-end">
                SISTEMA MOTORGAS
            </p>
        </div>
    </header>

    <main class="py-8 px-6">
        <h3 class="w-full py-2 font-semibold text-xl">
            AVISO DEL SISTEMA:
        </h3>
        <p>
            Estimado {{ $user->name }} el presente correo es para informarte que los suguientes documentos
            se encuentran próximos a vencer:
        </p>
        <br>
        <div class="block justify-center w-full">
            <ul>
                @foreach ($documentos as $doc)
                    <li>{{ $doc->TipoDocumento->nombreTipo }}
                        <span
                            class="px-1 rounded-lg bg-red-500 text-white">{{ $doc->fechaExpiracion }}
                        </span>
                    </li>
                @endforeach

            </ul>
        </div>
    </main>

    <footer>
        <div class="text-xs text-slate-700 -mt-4 float-right">
            Powered by ECRDEV ®
        </div>
    </footer>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</body>
</html>
