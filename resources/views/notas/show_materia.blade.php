@extends('layouts.app_sidebar_modern')

@section('title', 'Detalle de Materia')

@section('content')
    <div class="max-w-6xl mx-auto mt-8">
        <div class="flex justify-start mb-4">
            <a href="{{ route('notas.index') }}" class="inline-flex items-center gap-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-semibold px-5 py-2 rounded-lg shadow transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                Volver al listado de notas
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Panel izquierdo: Card de la materia y acciones rápidas -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center border-l-8 border-indigo-500 mb-6">
                    <div class="w-16 h-16 flex items-center justify-center rounded-full bg-gradient-to-tr from-indigo-500 via-purple-500 to-pink-400 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l9 6 9-6M4 19h16a1 1 0 001-1V6a1 1 0 00-1-1H4a1 1 0 00-1 1v12a1 1 0 001 1z" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-indigo-700 mb-2">{{ $materia->nombre }}</h1>
                    <span class="inline-block bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-1 rounded-full mb-2">{{ strtoupper($materia->estado ?? 'ACTIVA') }}</span>
                    <p class="text-gray-600 mb-2">Código: <span class="font-semibold">{{ $materia->codigo ?? '-' }}</span></p>
                    <p class="text-gray-600 mb-2">Facilitador: <span class="font-semibold">{{ $materia->facilitador->nombre ?? '-' }}</span></p>
                    <p class="text-gray-500 text-center mb-4">{{ $materia->descripcion ?? 'Sin descripción' }}</p>
                    <div class="flex flex-col gap-2 w-full mt-4">
                        <button onclick="document.getElementById('modalAsignar').classList.remove('hidden')" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition w-full">Asignar estudiantes</button>
                        <button class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded font-semibold shadow hover:bg-indigo-200 transition w-full">Exportar notas</button>
                    </div>
                </div>
            </div>
            <!-- Panel derecho: Tabs y contenido -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200">
                        <li class="mr-2">
                            <a href="#tab-resumen" class="inline-block p-4 rounded-t-lg border-b-2 border-indigo-600 text-indigo-700 font-semibold" onclick="showTab('resumen')">Resumen</a>
                        </li>
                        <li class="mr-2">
                            <a href="#tab-estudiantes" class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-indigo-700 hover:border-indigo-300" onclick="showTab('estudiantes')">Estudiantes inscritos</a>
                        </li>
                        <li>
                            <a href="#tab-asignar" class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-indigo-700 hover:border-indigo-300" onclick="showTab('asignar')">Agregar estudiantes</a>
                        </li>
                    </ul>
                    <!-- Tab Resumen: KPIs y Timeline -->
                    <div id="tab-resumen" class="tab-content mt-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                            <div class="bg-indigo-50 rounded-lg p-4 flex flex-col items-center">
                                <span class="text-2xl font-bold text-indigo-700">{{ $materia->estudiantes->count() }}</span>
                                <span class="text-xs text-gray-500">Estudiantes inscritos</span>
                            </div>
                            <div class="bg-green-50 rounded-lg p-4 flex flex-col items-center">
                                <span class="text-2xl font-bold text-green-700">
                                    @php $prom = $materia->estudiantes->count() ? number_format($notas->avg('nota'), 2) : '-' @endphp
                                    {{ $prom }}
                                </span>
                                <span class="text-xs text-gray-500">Promedio de notas</span>
                            </div>
                            <div class="bg-yellow-50 rounded-lg p-4 flex flex-col items-center">
                                <span class="text-2xl font-bold text-yellow-700">
                                    @php $max = $notas->max('nota'); @endphp
                                    {{ $max ?? '-' }}
                                </span>
                                <span class="text-xs text-gray-500">Mejor nota</span>
                            </div>
                            <div class="bg-red-50 rounded-lg p-4 flex flex-col items-center">
                                <span class="text-2xl font-bold text-red-700">
                                    @php $min = $notas->min('nota'); @endphp
                                    {{ $min ?? '-' }}
                                </span>
                                <span class="text-xs text-gray-500">Peor nota</span>
                            </div>
                        </div>
                        <div class="relative pl-8 border-l-4 border-indigo-200 mb-8">
                            <div class="absolute -left-4 top-0 w-8 h-8 bg-indigo-500 rounded-full flex items-center justify-center text-white font-bold shadow">⏳</div>
                            <div class="mb-8">
                                <h2 class="text-lg font-semibold text-indigo-700 mb-2">Línea de tiempo de la materia</h2>
                                <ul class="space-y-6">
                                    <li class="relative">
                                        <div class="absolute -left-8 top-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                                        <div class="ml-4">
                                            <span class="font-semibold text-green-700">Inscripción de estudiantes</span>
                                            <span class="block text-xs text-gray-400">@php echo now()->format('d/m/Y') @endphp</span>
                                            <span class="block text-gray-600">Se inscribieron {{ $materia->estudiantes->count() }} estudiantes.</span>
                                        </div>
                                    </li>
                                    <li class="relative">
                                        <div class="absolute -left-8 top-1 w-4 h-4 bg-blue-500 rounded-full border-2 border-white"></div>
                                        <div class="ml-4">
                                            <span class="font-semibold text-blue-700">Notas registradas</span>
                                            <span class="block text-xs text-gray-400">@php echo now()->format('d/m/Y') @endphp</span>
                                            <span class="block text-gray-600">Notas cargadas para los estudiantes inscritos.</span>
                                        </div>
                                    </li>
                                    <li class="relative">
                                        <div class="absolute -left-8 top-1 w-4 h-4 bg-yellow-500 rounded-full border-2 border-white"></div>
                                        <div class="ml-4">
                                            <span class="font-semibold text-yellow-700">Última edición</span>
                                            <span class="block text-xs text-gray-400">@php echo now()->format('d/m/Y') @endphp</span>
                                            <span class="block text-gray-600">Última modificación de notas o inscripciones.</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Tab Estudiantes inscritos -->
                    <div id="tab-estudiantes" class="tab-content mt-4 hidden">
                        <div class="bg-white rounded-xl shadow p-4">
                            <table class="min-w-full divide-y divide-gray-200 mb-4">
                                <thead class="bg-indigo-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estudiante</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nota</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($materia->estudiantes as $estudiante)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $estudiante->nombre }} {{ $estudiante->apellido }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php $nota = $notas->firstWhere('estudiante_id', $estudiante->id); @endphp
                                                {{ $nota ? $nota->nota : 'Sin nota' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($nota)
                                                    <a href="{{ route('notas.edit', $nota->id) }}" class="action-icon-btn action-edit text-indigo-600 font-semibold" title="Editar">Editar</a>
                                                @else
                                                    <a href="{{ route('notas.create', ['estudiante_id' => $estudiante->id, 'materia_id' => $materia->id]) }}" class="action-icon-btn action-add text-green-600 font-semibold" title="Agregar Nota">Agregar Nota</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="py-4 text-center text-gray-500">No hay estudiantes inscritos en esta materia.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Tab Agregar estudiantes -->
                    <div id="tab-asignar" class="tab-content mt-4 hidden">
                        <div class="bg-white rounded-xl shadow p-4">
                            <form method="POST" action="{{ route('notas.asignarEstudiantes.store', $materia->id) }}">
                                @csrf
                                <div class="mb-4">
                                    <label class="block mb-2 font-semibold">Selecciona estudiantes</label>
                                    <div class="flex items-center mb-2">
                                        <input type="checkbox" id="selectAll" class="mr-2" onclick="toggleAll(this)">
                                        <label for="selectAll" class="text-sm">Seleccionar todos</label>
                                    </div>
                                    <div class="max-h-56 overflow-y-auto border rounded p-2">
                                        @forelse($estudiantesDisponibles as $estudiante)
                                            <div>
                                                <input type="checkbox" name="estudiantes[]" value="{{ $estudiante->id }}" id="estudiante_{{ $estudiante->id }}" class="mr-2 estudiante-checkbox">
                                                <label for="estudiante_{{ $estudiante->id }}">{{ $estudiante->nombre }} {{ $estudiante->apellido }}</label>
                                            </div>
                                        @empty
                                            <div class="text-gray-400">No hay estudiantes disponibles para asignar.</div>
                                        @endforelse
                                    </div>
                                </div>
                                <div class="flex justify-end gap-2">
                                    <button type="submit" class="px-4 py-2 rounded bg-indigo-600 hover:bg-indigo-700 text-white font-semibold">Asignar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Asignar Estudiantes - Diseño 3 Mejorado: lista tipo chip, profesional, moderno, sin avatar, texto alineado -->
    <div id="modalAsignar" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm transition-all duration-200 hidden">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-xl mx-4 p-0 relative flex flex-col border-2 border-indigo-100">
            <!-- Encabezado -->
            <div class="flex items-center justify-between px-8 py-5 border-b bg-gradient-to-r from-indigo-50 to-white rounded-t-3xl">
                <h2 class="text-2xl font-extrabold text-indigo-700 tracking-tight flex items-center gap-2">
                    <svg class="h-7 w-7 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9-5a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    Asignar estudiantes a <span class="text-indigo-900">{{ $materia->nombre }}</span>
                </h2>
                <button onclick="document.getElementById('modalAsignar').classList.add('hidden')" class="text-gray-400 hover:text-red-500 text-3xl font-extrabold transition">&times;</button>
            </div>
            <!-- Barra de búsqueda -->
            <div class="px-8 py-4 border-b bg-white">
                <input type="text" id="busquedaEstudiante" onkeyup="filtrarEstudiantesChip()" placeholder="Buscar estudiante por nombre o correo..." class="w-full border-2 border-indigo-100 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300 transition" />
            </div>
            <form method="POST" action="{{ route('notas.asignarEstudiantes.store', $materia->id) }}" class="flex-1 flex flex-col bg-white rounded-b-3xl">
                @csrf
                <div class="flex items-center px-8 py-3 border-b bg-indigo-50 rounded-b-xl">
                    <input type="checkbox" id="selectAllModal" class="mr-2 accent-indigo-600 h-5 w-5" onclick="toggleAllModalChip(this)">
                    <label for="selectAllModal" class="text-sm font-semibold text-indigo-700 cursor-pointer">Seleccionar todos</label>
                </div>
                <div class="flex-1 overflow-y-auto px-8 pb-6 pt-4" style="max-height: 340px;">
                    <ul id="listaEstudiantes" class="flex flex-wrap gap-3">
                        @forelse($estudiantesDisponibles as $estudiante)
                            <li class="flex items-center gap-3 bg-gradient-to-r from-indigo-100 to-white rounded-full px-5 py-3 shadow-sm hover:shadow-lg hover:from-indigo-200 transition border border-indigo-100">
                                <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3 min-w-0">
                                    <span class="font-bold text-indigo-800 whitespace-nowrap">{{ $estudiante->nombre }} {{ $estudiante->apellido }}</span>
                                    @if($estudiante->correo)
                                        <span class="bg-indigo-200 text-indigo-800 text-xs font-semibold px-2 py-1 rounded-full whitespace-nowrap">{{ $estudiante->correo }}</span>
                                    @else
                                        <span class="bg-gray-200 text-gray-500 text-xs font-semibold px-2 py-1 rounded-full whitespace-nowrap">Sin correo</span>
                                    @endif
                                </div>
                                <input type="checkbox" name="estudiantes[]" value="{{ $estudiante->id }}" id="estudiante_modal_{{ $estudiante->id }}" class="estudiante-checkbox-modal h-5 w-5 accent-indigo-600 ml-2 transition-all duration-200">
                            </li>
                        @empty
                            <li class="text-gray-400 text-center py-8 w-full">No hay estudiantes disponibles para asignar.</li>
                        @endforelse
                    </ul>
                </div>
                <div class="px-8 py-5 border-t flex justify-end bg-gradient-to-r from-white to-indigo-50 rounded-b-3xl">
                    <button type="submit" class="px-8 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold text-lg shadow-lg transition">Asignar seleccionados</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function showTab(tab) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.getElementById('tab-' + tab).classList.remove('hidden');
        }
        function toggleAll(source) {
            let checkboxes = document.querySelectorAll('.estudiante-checkbox');
            checkboxes.forEach(cb => cb.checked = source.checked);
        }
        function toggleAllModalChip(source) {
            let checkboxes = document.querySelectorAll('.estudiante-checkbox-modal');
            checkboxes.forEach(cb => cb.checked = source.checked);
        }
        function filtrarEstudiantesChip() {
            let input = document.getElementById('busquedaEstudiante');
            let filter = input.value.toLowerCase();
            let ul = document.getElementById('listaEstudiantes');
            let lis = ul.getElementsByTagName('li');
            for (let i = 0; i < lis.length; i++) {
                let nombre = lis[i].querySelector('span.font-bold')?.textContent.toLowerCase() || '';
                let correo = lis[i].querySelector('span.bg-indigo-200, span.bg-gray-200')?.textContent.toLowerCase() || '';
                if (nombre.indexOf(filter) > -1 || correo.indexOf(filter) > -1) {
                    lis[i].style.display = '';
                } else {
                    lis[i].style.display = 'none';
                }
            }
        }
    </script>
@endsection
