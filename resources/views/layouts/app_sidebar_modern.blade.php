<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Sistema Educativo')</title>
    @vite('resources/css/app.css')
    <style>
        html, body {
            margin: 0;
        }
        .sidebar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .sidebar a {
            transition: background-color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        .header {
            background-color: #5a4d7a;
            color: white;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal flex h-screen overflow-hidden">

    <!-- Menú lateral clásico -->
    <aside id="sidebar" class="sidebar w-64 h-full p-6 flex flex-col overflow-y-auto transition-all duration-300">
        <h2 class="text-2xl font-bold mb-8"><a href="{{ route('dashboard') }}" class="hover:underline">Sistema Educativo</a></h2>
        @if (!request()->routeIs('dashboard'))
            <button id="sidebarToggle" class="mb-6 flex items-center gap-2 bg-gradient-to-r from-purple-700 to-indigo-600 hover:from-indigo-700 hover:to-purple-800 text-white font-bold py-2 px-4 rounded shadow-lg transition-all duration-300 focus:outline-none" title="Mostrar/Ocultar menú">
                <img src="/icons/graduado.png" alt="Menú" class="h-6 w-6 mr-1" style="filter: drop-shadow(0 1px 2px #0003);"> Menú
            </button>
        @endif
        <nav class="flex flex-col space-y-4 flex-1">
            <a href="{{ route('estudiantes.index') }}" class="px-4 py-3 rounded font-semibold hover:bg-white hover:text-purple-700 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 21.75a11.952 11.952 0 01-6.824-3.693 12.083 12.083 0 01.665-6.479L12 14z" />
                </svg>
                <span>Estudiantes</span>
            </a>
            <a href="{{ route('facilitadores.index') }}" class="px-4 py-3 rounded font-semibold hover:bg-white hover:text-purple-700 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14v7m-4-4h8" />
                </svg>
                <span>Facilitadores</span>
            </a>
            <a href="{{ route('materias.index') }}" class="px-4 py-3 rounded font-semibold hover:bg-white hover:text-purple-700 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 12V4m0 0L7 7m5-3l5 3" />
                </svg>
                <span>Materias</span>
            </a>
            <a href="{{ route('notas.index') }}" class="px-4 py-3 rounded font-semibold hover:bg-white hover:text-purple-700 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h5l5 5v9a2 2 0 01-2 2z" />
                </svg>
                <span>Notas</span>
            </a>
            <a href="{{ route('roles.index') }}" class="px-4 py-3 rounded font-semibold hover:bg-white hover:text-purple-700 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span>Roles</span>
            </a>
        </nav>
        <form method="POST" action="{{ route('logout') }}" class="mt-8">
            @csrf
            <button type="submit" class="w-full bg-purple-700 hover:bg-purple-800 text-white font-bold py-2 rounded">Cerrar Sesión</button>
        </form>
    </aside>

    <div id="mainContent" class="flex-1 flex flex-col transition-all duration-300 overflow-auto">
        <!-- Header -->
        <header class="header shadow p-4 flex items-center justify-center">
            <h1 class="text-xl font-bold">@yield('title', 'Dashboard')</h1>
        </header>

        <!-- Contenido principal -->
        <main class="p-6 flex-1 overflow-auto" style="height:100%; max-height:100vh; min-height:0;">
            @yield('content')
        </main>
        <!--footer-->
        <footer class="bg-[#3b2560] text-white text-center py-4 mt-auto">
            &copy; 2024 Instituto IFC. Todos los derechos reservados.
        </footer>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var toggleBtn = document.getElementById('sidebarToggle');
        var sidebar = document.getElementById('sidebar');
        var mainContent = document.getElementById('mainContent');
        if (toggleBtn && sidebar && mainContent) {
            let sidebarVisible = true;
            toggleBtn.addEventListener('click', function() {
                sidebarVisible = !sidebarVisible;
                if (!sidebarVisible) {
                    sidebar.style.marginLeft = '-16rem';
                    mainContent.style.marginLeft = '0';
                } else {
                    sidebar.style.marginLeft = '';
                    mainContent.style.marginLeft = '';
                }
            });
        }
    });
    </script>
</body>
</html>
