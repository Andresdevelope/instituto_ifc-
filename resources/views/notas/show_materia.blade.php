@extends('layouts.app_sidebar_modern')

@section('title', 'Detalle de Materia')

@section('content')
    <div class="max-w-4xl mx-auto mt-8">
        <a href="{{ route('notas.index') }}" class="text-indigo-600 hover:underline mb-4 inline-block">← Volver al listado de materias</a>
        <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
            <h1 class="text-2xl font-bold text-indigo-700 mb-2">{{ $materia->nombre }}</h1>
            <p class="text-gray-600 mb-2">{{ $materia->descripcion ?? 'Sin descripción' }}</p>
            <p class="text-sm text-gray-400 mb-2">Código: {{ $materia->codigo ?? '-' }}</p>
            <p class="text-sm text-gray-400 mb-2">Estado: {{ $materia->estado ?? '-' }}</p>
        </div>
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-indigo-700">Estudiantes inscritos</h2>
            <button onclick="document.getElementById('modalAsignar').classList.remove('hidden')" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition">Asignar estudiantes</button>
        </div>
        <table class="min-w-full divide-y divide-gray-200 mb-8">
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
                            @php
                                $nota = $notas->firstWhere('estudiante_id', $estudiante->id);
                            @endphp
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
    <!-- Modal Asignar Estudiantes -->
    <div id="modalAsignar" class="fixed inset-0 z-50 flex items-center justify-center bg-[rgba(60,60,60,0.08)] backdrop-blur-sm transition-all duration-200 hidden">
        <div class="bg-white rounded-xl shadow-2xl max-w-lg w-full p-7 relative border border-indigo-100">
            <button onclick="document.getElementById('modalAsignar').classList.add('hidden')" class="absolute top-3 right-3 text-gray-400 hover:text-red-500 text-2xl font-bold">&times;</button>
            <h2 class="text-xl font-bold mb-4 text-indigo-700">Asignar estudiantes a {{ $materia->nombre }}</h2>
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
                    <button type="button" onclick="document.getElementById('modalAsignar').classList.add('hidden')" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-700">Cancelar</button>
                    <button type="submit" class="px-4 py-2 rounded bg-indigo-600 hover:bg-indigo-700 text-white font-semibold">Asignar</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function toggleAll(source) {
            let checkboxes = document.querySelectorAll('.estudiante-checkbox');
            checkboxes.forEach(cb => cb.checked = source.checked);
        }
    </script>
@endsection
