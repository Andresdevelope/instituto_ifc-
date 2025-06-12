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
            min-width: 4rem;
            max-width: 14rem;
            width: 4rem;
            transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar:hover, .sidebar:focus-within {
            width: 14rem;
        }
        @media (min-width: 768px) {
            .sidebar {
                width: 4rem;
            }
            .sidebar:hover, .sidebar:focus-within {
                width: 14rem;
            }
        }
        #mainContent {
            transition: none;
            margin-left: 0 !important;
        }
        @media (min-width: 768px) {
            #mainContent {
                margin-left: 0 !important;
            }
            .sidebar:hover ~ #mainContent, .sidebar:focus-within ~ #mainContent {
                margin-left: 0 !important;
            }
        }
        .header {
            background-color: #5a4d7a;
            color: white;
        }
        .logout-btn {
            background: #5a4d7a !important;
            color: #fff !important;
            border-radius: 9999px !important;
            padding: 0.75rem !important;
            box-shadow: 0 2px 8px 0 rgba(90,77,122,0.10) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            border: none !important;
            cursor: pointer !important;
            width: 48px !important;
            height: 48px !important;
            min-width: 48px !important;
            min-height: 48px !important;
            max-width: 48px !important;
            max-height: 48px !important;
            transition: background 0.2s;
            position: relative;
            margin-bottom: 1rem;
        }
        .logout-btn:hover {
            background: #3b2560 !important;
        }
        .logout-btn svg {
            stroke: #fff !important;
            width: 28px !important;
            height: 28px !important;
            display: block;
        }
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 1ms  ease;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal h-screen overflow-hidden">
    <div class="flex h-screen w-screen">
        <!-- Menú lateral clásico -->
        <aside id="sidebar" class="sidebar group flex flex-col items-center md:items-start h-full py-4 px-2 transition-all duration-300 w-16 hover:w-56 md:w-16 md:hover:w-56">
            <div class="flex flex-col items-center w-full">
                <a href="{{ route('dashboard') }}" class="mb-8 flex items-center w-full justify-center md:justify-start">
                    <img src="/icons/graduado.png" alt="Logo" class="h-8 w-8" />
                    <span class="ml-3 text-lg font-bold hidden group-hover:inline md:group-hover:inline transition-all duration-300">Instituto IFC</span>
                </a>
            </div>
            <nav class="flex flex-col space-y-2 flex-1 w-full">
                <a href="{{ route('estudiantes.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-white/20 transition-all duration-200 w-full {{ request()->routeIs('estudiantes.*') ? 'bg-white/30 font-bold' : '' }}"
                   @if(request()->routeIs('estudiantes.*')) aria-current="page" @endif>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 mx-auto md:mx-0">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>
                    <span class="ml-3 font-semibold hidden group-hover:inline md:group-hover:inline transition-all duration-300">Estudiantes</span>
                </a>
                <a href="{{ route('facilitadores.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-white/20 transition-all duration-200 w-full {{ request()->routeIs('facilitadores.*') ? 'bg-white/30 font-bold' : '' }}"
                   @if(request()->routeIs('facilitadores.*')) aria-current="page" @endif>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 mx-auto md:mx-0">
                        <rect x="3" y="4" width="18" height="12" rx="2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M8 20h8M12 16v4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7 8h6M7 12h4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="ml-3 font-semibold hidden group-hover:inline md:group-hover:inline transition-all duration-300">Facilitadores</span>
                </a>
                <a href="{{ route('materias.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-white/20 transition-all duration-200 w-full {{ request()->routeIs('materias.*') ? 'bg-white/30 font-bold' : '' }}"
                   @if(request()->routeIs('materias.*')) aria-current="page" @endif>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 mx-auto md:mx-0">
                        <rect x="4" y="4" width="16" height="16" rx="2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M8 2v4M16 2v4M4 10h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="ml-3 font-semibold hidden group-hover:inline md:group-hover:inline transition-all duration-300">Materias</span>
                </a>
                <a href="{{ route('notas.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-white/20 transition-all duration-200 w-full {{ request()->routeIs('notas.*') ? 'bg-white/30 font-bold' : '' }}"
                   @if(request()->routeIs('notas.*')) aria-current="page" @endif>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 mx-auto md:mx-0">
                        <rect x="4" y="4" width="16" height="16" rx="2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M8 12h8M8 16h8M8 8h8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="ml-3 font-semibold hidden group-hover:inline md:group-hover:inline transition-all duration-300">Notas</span>
                </a>
                <a href="{{ route('roles.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-white/20 transition-all duration-200 w-full {{ request()->routeIs('roles.*') ? 'bg-white/30 font-bold' : '' }}"
                   @if(request()->routeIs('roles.*')) aria-current="page" @endif>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 mx-auto md:mx-0">
                        <circle cx="12" cy="8" r="4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6 20v-2a4 4 0 014-4h4a4 4 0 014 4v2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="ml-3 font-semibold hidden group-hover:inline md:group-hover:inline transition-all duration-300">Roles</span>
                </a>
            </nav>
            <form method="POST" action="{{ route('logout') }}" class="mt-8 w-full flex justify-center">
                @csrf
                <button type="submit" class="logout-btn" title="Cerrar sesión" aria-label="Cerrar sesión">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H9m4 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
                    </svg>
                </button>
            </form>
        </aside>
        <div id="mainContent" class="flex-1 flex flex-col transition-all duration-300 overflow-auto min-w-0">
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
                &copy; 2025 Instituto IFC. Todos los derechos reservados.
            </footer>
        </div>
    </div>
    <!-- Notificaciones visuales -->
    @if(session('success'))
        <div id="notification-success" class="fixed top-6 right-6 z-50 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-2 animate-fade-in">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            <span>{{ session('success') }}</span>
        </div>
        <script>
            setTimeout(() => {
                const notif = document.getElementById('notification-success');
                if (notif) notif.style.display = 'none';
            }, 3500);
        </script> 
    @endif
    @if(session('error'))
        <div id="notification-error" class="fixed top-6 right-6 z-50 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-2 animate-fade-in">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            <span>{{ session('error') }}</span>
        </div>
        <script>
            setTimeout(() => {
                const notif = document.getElementById('notification-error');
                if (notif) notif.style.display = 'none';
            }, 3500);
        </script>
    @endif
</body>
</html>
