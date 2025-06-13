@extends('layouts.app_sidebar_modern')

@section('title', 'Listado de Materias')

@section('content')
    @include('components.back-button')
    <h1 class="text-2xl font-bold mb-4">Listado de Materias</h1>
    <p>Aquí se mostrará la lista de materias.</p>

    <style>
        .materias-table-container {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 4px 24px 0 rgba(102,126,234,0.10);
            padding: 2rem 1rem;
            overflow-x: auto;
        }
        .materias-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: #fff;
        }
        .materias-table th, .materias-table td {
            padding: 1rem 1.2rem;
            text-align: left;
        }
        .materias-table th {
            background: #f3f4f6;
            color: #4b5563;
            font-size: 1rem;
            font-weight: 700;
            border-bottom: 2px solid #e5e7eb;
        }
        .materias-table tbody tr {
            border-bottom: 1px solid #e5e7eb;
            transition: background 0.2s;
        }
        .materias-table tbody tr:hover {
            background: #f1f5f9;
        }
        .materias-table td {
            color: #374151;
            font-size: 0.98rem;
        }
        @media (max-width: 900px) {
            .materias-table-container {
                padding: 0.5rem 0.2rem;
            }
            .materias-table th, .materias-table td {
                padding: 0.7rem 0.5rem;
                font-size: 0.95rem;
            }
        }
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
        .action-view { color: #2563eb; }
        .action-view:hover { background: #dbeafe; color: #1d4ed8; }
        .action-edit { color: #f59e42; }
        .action-edit:hover { background: #fef3c7; color: #b45309; }
        .action-delete { color: #dc2626; }
        .action-delete:hover { background: #fee2e2; color: #b91c1c; }
    </style>
    <form method="GET" action="{{ route('materias.index') }}" class="mb-6 flex flex-wrap gap-4 items-end justify-between bg-gray-50 p-4 rounded-lg shadow-sm">
        <div class="flex flex-col">
            <label for="busqueda" class="text-xs font-semibold text-gray-600 mb-1">Nombre o Código</label>
            <input type="text" name="busqueda" id="busqueda" value="{{ request('busqueda') }}" placeholder="Buscar..." class="rounded-md border-gray-300 focus:border-indigo-400 focus:ring-indigo-200 text-sm px-3 py-2">
        </div>
        <div class="flex flex-col">
            <label for="estado" class="text-xs font-semibold text-gray-600 mb-1">Estado</label>
            <select name="estado" id="estado" class="rounded-md border-gray-300 focus:border-indigo-400 focus:ring-indigo-200 text-sm px-3 py-2">
                <option value="">Todos</option>
                <option value="activa" {{ request('estado')==='activa' ? 'selected' : '' }}>Activa</option>
                <option value="inactiva" {{ request('estado')==='inactiva' ? 'selected' : '' }}>Inactiva</option>
            </select>
        </div>
        <div class="flex flex-col">
            <label for="facilitador_id" class="text-xs font-semibold text-gray-600 mb-1">Facilitador</label>
            <select name="facilitador_id" id="facilitador_id" class="rounded-md border-gray-300 focus:border-indigo-400 focus:ring-indigo-200 text-sm px-3 py-2">
                <option value="">Todos</option>
                @foreach($facilitadores as $facilitador)
                    <option value="{{ $facilitador->id }}" {{ request('facilitador_id')==$facilitador->id ? 'selected' : '' }}>{{ $facilitador->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2 rounded-md shadow">Filtrar</button>
        </div>
    </form>
    <div class="materias-table-container">
        <table class="materias-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Estado</th>
                    <th>Facilitador</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($materias as $materia)
                    <tr>
                        <td>{{ $materia->nombre }}</td>
                        <td>{{ $materia->codigo }}</td>
                        <td>
                            @if($materia->estado === 'activa')
                                <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full text-xs font-semibold">Activa</span>
                            @else
                                <span class="bg-red-200 text-red-800 px-2 py-1 rounded-full text-xs font-semibold">Inactiva</span>
                            @endif
                        </td>
                        <td>{{ $materia->facilitador->nombre ?? '-' }}</td>
                        <td>
                            <div class="flex space-x-2 items-center">
                                <button type="button" class="action-icon-btn action-view" title="Ver"
                                    data-nombre="{{ $materia->nombre }}"
                                    data-codigo="{{ $materia->codigo }}"
                                    data-estado="{{ $materia->estado }}"
                                    data-facilitador="{{ $materia->facilitador->nombre ?? '-' }}"
                                    data-descripcion="{{ $materia->descripcion ?? '-' }}"
                                    onclick="mostrarModalMateria(this)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                </button>
                                <a href="#" class="action-icon-btn action-edit" title="Editar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13h3l8-8a2.828 2.828 0 00-4-4l-8 8v3z" /></svg>
                                </a>
                                <form action="#" method="POST" style="display:inline; margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-icon-btn action-delete" title="Eliminar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        <span style="position:absolute;top:0;right:0;bottom:0;left:0;display:flex;align-items:center;justify-content:center;pointer-events:none;">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none">
                                                <path d="M6 6l8 8M6 14L14 6" stroke="#dc2626" stroke-width="2" stroke-linecap="round"/>
                                            </svg>
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500">No hay materias registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Detalles Materia -->
    <div id="modalMateria" class="fixed inset-0 z-50 flex items-center justify-center bg-[rgba(60,60,60,0.08)] backdrop-blur-sm transition-all duration-200 hidden">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-7 relative border border-indigo-100">
            <button onclick="cerrarModalMateria()" class="absolute top-3 right-3 text-gray-400 hover:text-red-500 text-2xl font-bold">&times;</button>
            <h2 class="text-xl font-bold mb-4 text-indigo-700">Detalles de la Materia</h2>
            <div class="space-y-2">
                <div><span class="font-semibold text-gray-600">Nombre:</span> <span id="modalMateriaNombre"></span></div>
                <div><span class="font-semibold text-gray-600">Código:</span> <span id="modalMateriaCodigo"></span></div>
                <div><span class="font-semibold text-gray-600">Estado:</span> <span id="modalMateriaEstado"></span></div>
                <div><span class="font-semibold text-gray-600">Facilitador:</span> <span id="modalMateriaFacilitador"></span></div>
                <div><span class="font-semibold text-gray-600">Descripción:</span> <span id="modalMateriaDescripcion"></span></div>
            </div>
        </div>
    </div>
    <script>
        function mostrarModalMateria(btn) {
            document.getElementById('modalMateriaNombre').textContent = btn.getAttribute('data-nombre');
            document.getElementById('modalMateriaCodigo').textContent = btn.getAttribute('data-codigo');
            document.getElementById('modalMateriaEstado').textContent = btn.getAttribute('data-estado');
            document.getElementById('modalMateriaFacilitador').textContent = btn.getAttribute('data-facilitador');
            document.getElementById('modalMateriaDescripcion').textContent = btn.getAttribute('data-descripcion');
            document.getElementById('modalMateria').classList.remove('hidden');
        }
        function cerrarModalMateria() {
            document.getElementById('modalMateria').classList.add('hidden');
        }
        // Cerrar modal con ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') cerrarModalMateria();
        });
    </script>
@endsection
