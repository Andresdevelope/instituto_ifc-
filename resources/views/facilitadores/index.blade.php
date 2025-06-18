@extends('layouts.app_sidebar_modern')

@section('title', 'Listado de Facilitadores')

@section('content')
    @include('components.back-button')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Listado de Facilitadores</h1>
    </div>
        
    <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-6 gap-4">
        <form id="searchForm" method="GET" action="{{ route('facilitadores.index') }}" class="flex space-x-2 items-end w-full md:w-auto">
            <input id="searchInput" type="text" name="busqueda" value="{{ request('busqueda') }}" placeholder="Buscar facilitador por nombre, asignatura o contacto" class="search-bar" />
            <button type="submit" class="button h-12 px-8" title="Buscar">
                <span class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4-4m0 0A7 7 0 104 4a7 7 0 0013 13z" /></svg>
                    Buscar
                </span>
            </button>
        </form>
        <a href="{{ route('facilitadores.create') }}" class="button h-12 px-8" title="Registrar Facilitador" style="min-width:180px; display:flex; align-items:center; justify-content:center;">
            Registrar Facilitador
            <div class="arrow-wrapper">
                <div class="arrow"></div>
            </div>
        </a>
    </div>

    <style>
        .button {
            --primary-color: #645bff;
            --secondary-color: #fff;
            --hover-color: #111;
            --arrow-width: 10px;
            --arrow-stroke: 2px;
            box-sizing: border-box;
            border: 0;
            border-radius: 20px;
            color: var(--secondary-color);
            padding: 1em 1.8em;
            background: var(--primary-color);
            display: flex;
            transition: 0.2s background;
            align-items: center;
            gap: 0.6em;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }
        .button .arrow-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .button .arrow {
            margin-top: 1px;
            width: var(--arrow-width);
            background: var(--primary-color);
            height: var(--arrow-stroke);
            position: relative;
            transition: 0.2s;
        }
        .button .arrow::before {
            content: "";
            box-sizing: border-box;
            position: absolute;
            border: solid var(--secondary-color);
            border-width: 0 var(--arrow-stroke) var(--arrow-stroke) 0;
            display: inline-block;
            top: -3px;
            right: 3px;
            transition: 0.2s;
            padding: 3px;
            transform: rotate(-45deg);
        }
        .button:hover {
            background-color: var(--hover-color);
        }
        .button:hover .arrow {
            background: var(--secondary-color);
        }
        .button:hover .arrow:before {
            right: 0;
        }
        .search-bar {
            border: 1px solid #d1d5db;
            border-radius: 1.5rem;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            width: 100%;
            max-width: 350px;
            outline: none;
            transition: box-shadow 0.2s;
        }
        .search-bar:focus {
            box-shadow: 0 0 0 2px #645bff33;
        }
        .facilitadores-table-container {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 4px 24px 0 rgba(102,126,234,0.10);
            padding: 2rem 1rem;
            overflow-x: auto;
        }
        .facilitadores-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: #fff;
        }
        .facilitadores-table th, .facilitadores-table td {
            padding: 1rem 1.2rem;
            text-align: left;
        }
        .facilitadores-table th {
            background: #f3f4f6;
            color: #4b5563;
            font-size: 1rem;
            font-weight: 700;
            border-bottom: 2px solid #e5e7eb;
        }
        .facilitadores-table tbody tr {
            border-bottom: 1px solid #e5e7eb;
            transition: background 0.2s;
        }
        .facilitadores-table tbody tr:hover {
            background: #f1f5f9;
        }
        .facilitadores-table td {
            color: #374151;
            font-size: 0.98rem;
        }
        @media (max-width: 900px) {
            .facilitadores-table-container {
                padding: 0.5rem 0.2rem;
            }
            .facilitadores-table th, .facilitadores-table td {
                padding: 0.7rem 0.5rem;
                font-size: 0.95rem;
            }
        }
    </style>

    <div class="facilitadores-table-container">
        <table class="facilitadores-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Asignatura</th>
                    <th>Contacto</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($facilitadores as $facilitador)
                    <tr>
                        <td>{{ $facilitador->nombre }}</td>
                        <td>
                            @if($facilitador->materias && $facilitador->materias->count())
                                @foreach($facilitador->materias as $materia)
                                    <span class="inline-block bg-indigo-100 text-indigo-800 text-xs font-semibold mr-1 mb-1 px-2.5 py-0.5 rounded">{{ $materia->nombre }}</span>
                                @endforeach
                            @else
                                <span class="text-gray-400 text-xs">Sin materias asignadas</span>
                            @endif
                        </td>
                        <td>{{ $facilitador->telefono ?? '-' }}</td>
                        <td>
                            @if($facilitador->estado === 'activo')
                                <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full text-xs font-semibold">Activo</span>
                            @else
                                <span class="bg-red-200 text-red-800 px-2 py-1 rounded-full text-xs font-semibold">Inactivo</span>
                            @endif
                        </td>
                        <td>
                            <div class="flex space-x-2 items-center">
                                <button type="button" class="action-icon-btn action-view" title="Ver" onclick="mostrarModalFacilitador({{ $facilitador->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                </button>
                                <a href="{{ route('facilitadores.edit', $facilitador->id) }}" class="action-icon-btn action-edit" title="Editar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13h3l8-8a2.828 2.828 0 00-4-4l-8 8v3z" /></svg>
                                </a>
                                <form id="deleteForm-{{ $facilitador->id }}" action="{{ route('facilitadores.destroy', $facilitador->id) }}" method="POST" style="display:inline; margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="action-icon-btn action-delete" title="Eliminar" onclick="abrirModalEliminar({{ $facilitador->id }}, '{{ $facilitador->nombre }}', '{{ $facilitador->apellido }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500">No hay facilitadores registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $facilitadores->links() }}
    </div>

    <!-- Modal para mostrar detalles del facilitador -->
    <div id="modalFacilitador" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm hidden">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-8 relative animate-fade-in">
            <button onclick="cerrarModalFacilitador()" class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-2xl font-bold">&times;</button>
            <h2 class="text-2xl font-bold mb-4 text-center">Detalle del Facilitador</h2>
            <div id="modalFacilitadorContent" class="space-y-2 text-gray-700">
                <!-- Aquí se cargan los datos -->
            </div>
        </div>
    </div>

    <!-- Modal de confirmación de eliminación -->
    <div id="modalEliminar" class="fixed inset-0 z-50 flex items-center justify-center bg-white/70 backdrop-blur-sm hidden">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-8 relative animate-fade-in">
            <button onclick="cerrarModalEliminar()" class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-2xl font-bold">&times;</button>
            <h2 class="text-2xl font-bold mb-4 text-center">Confirmar Eliminación</h2>
            <div class="mb-6 text-center">
                ¿Estás seguro que deseas eliminar al facilitador <span id="nombreFacilitadorEliminar" class="font-semibold"></span>?
            </div>
            <div class="flex justify-center gap-4">
                <button onclick="confirmarEliminar()" class="button bg-red-600 hover:bg-red-700 text-white">Sí, eliminar</button>
                <button onclick="cerrarModalEliminar()" class="button bg-gray-300 hover:bg-gray-400 text-gray-800">Cancelar</button>
            </div>
        </div>
    </div>

    <style>
        #modalFacilitador {
            /* Fondo blanco semitransparente y desenfoque */
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(2px);
        }
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fade-in 0.3s ease; }
        .action-icon-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            background: #f3f4f6;
            color: #374151;
            border: none;
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
            cursor: pointer;
            position: relative;
            box-shadow: 0 1px 2px 0 rgba(60,60,60,0.04);
        }
        .action-icon-btn svg {
            width: 1.25rem;
            height: 1.25rem;
            pointer-events: none;
        }
        .action-icon-btn:hover {
            background: #e0e7ff;
            color: #645bff;
            box-shadow: 0 2px 8px 0 rgba(100,91,255,0.10);
        }
        .action-view {
            color: #2563eb;
        }
        .action-view:hover {
            background: #dbeafe;
            color: #1d4ed8;
        }
        .action-edit {
            color: #f59e42;
        }
        .action-edit:hover {
            background: #fef3c7;
            color: #b45309;
        }
        .action-delete {
            color: #dc2626;
        }
        .action-delete:hover {
            background: #fee2e2;
            color: #b91c1c;
        }
    </style>
    <script>
        function mostrarModalFacilitador(id) {
            fetch(`/facilitadores/${id}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                let materiasHtml = '';
                if (data.materias && data.materias.length > 0) {
                    materiasHtml = data.materias.map(m => `<span class='inline-block bg-indigo-100 text-indigo-800 text-xs font-semibold mr-1 mb-1 px-2.5 py-0.5 rounded'>${m.nombre} (${m.codigo})</span>`).join(' ');
                } else {
                    materiasHtml = `<span class='text-gray-400 text-xs'>Sin materias asignadas</span>`;
                }
                let html = `
                    <div><strong>Nombre:</strong> ${data.nombre ?? '-'} </div>
                    <div><strong>Apellido:</strong> ${data.apellido ?? '-'} </div>
                    <div><strong>Materias que imparte:</strong> ${materiasHtml}</div>
                    <div><strong>Teléfono:</strong> ${data.telefono ?? '-'} </div>
                    <div><strong>Email:</strong> ${data.email ?? '-'} </div>
                    <div><strong>Estado:</strong> <span class='${data.estado === 'activo' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800'} px-2 py-1 rounded-full text-xs font-semibold'>${data.estado}</span></div>
                    <div><strong>Dirección:</strong> ${data.direccion ?? '-'} </div>
                `;
                document.getElementById('modalFacilitadorContent').innerHTML = html;
                document.getElementById('modalFacilitador').classList.remove('hidden');
            });
        }
        function cerrarModalFacilitador() {
            document.getElementById('modalFacilitador').classList.add('hidden');
        }
        let idFacilitadorEliminar = null;
        function abrirModalEliminar(id, nombre, apellido) {
            idFacilitadorEliminar = id;
            document.getElementById('nombreFacilitadorEliminar').textContent = nombre + ' ' + apellido;
            document.getElementById('modalEliminar').classList.remove('hidden');
        }
        function cerrarModalEliminar() {
            idFacilitadorEliminar = null;
            document.getElementById('modalEliminar').classList.add('hidden');
        }
        function confirmarEliminar() {
            if (idFacilitadorEliminar) {
                document.getElementById('deleteForm-' + idFacilitadorEliminar).submit();
            }
        }
    </script>
    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            if (this.value === '') {
                document.getElementById('searchForm').submit();
            }
        });
    </script>
@endsection
