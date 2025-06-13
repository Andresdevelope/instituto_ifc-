@extends('layouts.app_sidebar_modern')

@section('title', 'Listado de Estudiantes')

@section('content')
    @include('components.back-button', ['backUrl' => route('dashboard')])

    <style>
        button, .button {
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

        button .arrow-wrapper, .button .arrow-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        button .arrow, .button .arrow {
            margin-top: 1px;
            width: var(--arrow-width);
            background: var(--primary-color);
            height: var(--arrow-stroke);
            position: relative;
            transition: 0.2s;
        }

        button .arrow::before, .button .arrow::before {
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

        button:hover, .button:hover {
            background-color: var(--hover-color);
        }

        button:hover .arrow, .button:hover .arrow {
            background: var(--secondary-color);
        }

        button:hover .arrow:before, .button:hover .arrow:before {
            right: 0;
        }

        .button::after,
        .button::before {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            z-index: -99999;
            transition: all .4s;
        }



        .button:hover::before {
            transform: translate(5%, 20%);
            width: 110%;
            height: 110%;
        }

        .button:hover::after {
            border-radius: 10px;
            transform: translate(0, 0);
            width: 100%;
            height: 100%;
        }

        .button:active::after {
            transition: 0s;
            transform: translate(0, 5%);
        }

        .svg {
            width: 13px;
            position: absolute;
            right: 0;
            margin-right: 20px;
            fill: white;
            transition-duration: .3s;
        }

        /* Sidebar estilo DeepSeek (ya incluido arriba) */
        /* --- ARREGLO DE LA TABLA DE ESTUDIANTES --- */
        .estudiantes-table-container {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 4px 24px 0 rgba(102,126,234,0.10);
            padding: 2rem 1rem;
            overflow-x: auto;
        }
        .estudiantes-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: #fff;
        }
        .estudiantes-table th, .estudiantes-table td {
            padding: 1rem 1.2rem;
            text-align: left;
        }
        .estudiantes-table th {
            background: #f3f4f6;
            color: #4b5563;
            font-size: 1rem;
            font-weight: 700;
            border-bottom: 2px solid #e5e7eb;
        }
        .estudiantes-table tbody tr {
            border-bottom: 1px solid #e5e7eb;
            transition: background 0.2s;
        }
        .estudiantes-table tbody tr:hover {
            background: #f1f5f9;
        }
        .estudiantes-table td {
            color: #374151;
            font-size: 0.98rem;
        }
        @media (max-width: 900px) {
            .estudiantes-table-container {
                padding: 0.5rem 0.2rem;
            }
            .estudiantes-table th, .estudiantes-table td {
                padding: 0.7rem 0.5rem;
                font-size: 0.95rem;
            }
        }

        /* Botones de acción estilo facilitadores */
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

    <h1 class="text-2xl font-bold mb-4">Listado de Estudiantes</h1>

    <div class="flex justify-between mb-4">
        <form id="searchForm" action="{{ route('estudiantes.index') }}" method="GET" class="flex space-x-2 items-end">
            <input id="searchInput" type="text" name="search" value="{{ $query ?? '' }}" placeholder="Buscar estudiante por nombre, apellido o cédula" class="border border-gray-300 rounded px-4 py-3 h-12 w-72 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition" />
            <button type="submit" class="button h-12 px-8" style="height:48px; min-width:180px;" title="Buscar">
                <span class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4-4m0 0A7 7 0 104 4a7 7 0 0013 13z" /></svg>
                    Buscar
                </span>
            </button>
        </form>
        <div class="flex flex-col items-end">
            <div class="mb-2">
                <span class="text-gray-600 font-semibold">Total de Estudiantes registrados: {{ $estudiantes->count() }}</span>
            </div>
            <a href="{{ route('estudiantes.create') }}" class="button" title="Registrar Estudiante" style="min-width:180px; height:48px; display:flex; align-items:center; justify-content:center;">
                Registrar Estudiante
                <div class="arrow-wrapper">
                    <div class="arrow"></div>
                </div>
            </a>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            if (this.value === '') {
                // Si el campo de búsqueda está vacío, enviar el formulario para mostrar todos los registros
                document.getElementById('searchForm').submit();
            }
        });
    </script>

    <div class="estudiantes-table-container" style="margin-top: 2rem;">
        <table class="estudiantes-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Cédula</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudiantes as $estudiante)
                    <tr>
                        <td>{{ $estudiante->nombre }}</td>
                        <td>{{ $estudiante->apellido }}</td>
                        <td>{{ $estudiante->cedula }}</td>
                        <td>
                            <div class="flex space-x-2 items-center">
                                <a href="{{ route('estudiantes.show', $estudiante->id) }}" class="action-icon-btn action-view" title="Ver">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                </a>
                                <a href="{{ route('estudiantes.edit', $estudiante->id) }}" class="action-icon-btn action-edit" title="Editar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13h3l8-8a2.828 2.828 0 00-4-4l-8 8v3z" /></svg>
                                </a>
                                <form id="deleteForm-{{ $estudiante->id }}" action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST" style="display:inline; margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-icon-btn action-delete" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar este estudiante?');">
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
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
