<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Sistema Educativo')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-papb+X+6Q6X+6Q6X+6Q6X+6Q6X+6Q6X+6Q6X+6Q6X+6Q6X+6Q6X+6Q6X+6Q6X+6Q6X+6Q6X+6Q6X+6Q6X+6Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <nav class="bg-white shadow mb-8">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800">Sistema Educativo</a>
                </div>
                <div>
                    <a href="{{ route('estudiantes.index') }}" class="text-gray-800 hover:text-blue-600 px-3 py-2">Estudiantes</a>
                    <a href="{{ route('facilitadores.index') }}" class="text-gray-800 hover:text-blue-600 px-3 py-2">Facilitadores</a>
                    <a href="{{ route('materias.index') }}" class="text-gray-800 hover:text-blue-600 px-3 py-2">Materias</a>
                    <a href="{{ route('notas.index') }}" class="text-gray-800 hover:text-blue-600 px-3 py-2">Notas</a>
                    <a href="{{ route('roles.index') }}" class="text-gray-800 hover:text-blue-600 px-3 py-2">Roles</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4">
        @yield('content')
    </main>

</body>
</html>
