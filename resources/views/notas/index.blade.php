@extends('layouts.app_sidebar_modern')

@section('title', 'Gestión de Notas por Materia')

@section('content')
    <h1 class="text-3xl font-bold mb-8 text-center text-indigo-700">Materias</h1>
    <div class="flex justify-center">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 w-full max-w-7xl">
            @foreach($materias as $materia)
                 <div class="bg-white rounded-xl shadow-lg flex flex-col items-center p-0 hover:shadow-2xl transition cursor-pointer border-l-8 border-indigo-500 relative overflow-hidden w-full">
                    <div class="absolute top-4 right-4">
                        <span class="inline-block bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-1 rounded-full">{{ strtoupper($materia->estado ?? 'ACTIVA') }}</span>
                    </div>
                    <div class="w-full flex flex-col items-center justify-center pt-8 pb-4">
                        <div class="w-14 h-14 flex items-center justify-center rounded-full bg-indigo-50 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 7v-6m0 0L3 9m9 5l9-5" /></svg>
                        </div>
                        <h2 class="text-lg font-bold text-indigo-800 mb-1">{{ $materia->nombre }}</h2>
                        <span class="text-xs text-gray-400">Código: {{ $materia->codigo ?? '-' }}</span>
                    </div>
                    <div class="flex-1 flex flex-col justify-between w-full px-6 py-4">
                        <p class="text-gray-500 text-center mb-4">{{ $materia->descripcion ?? 'Sin descripción' }}</p>
                        <span class="text-xs text-gray-500 mb-2 block">Facilitador: <span class="font-semibold text-indigo-700">{{ $materia->facilitador->nombre ?? '-' }}</span></span>
                        <a href="{{ route('notas.materia.show', $materia->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition font-semibold shadow w-full text-center">Ver detalles</a>
                        <span class="mt-2 text-xs text-gray-400 text-center block">Más información</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @if(request('materia_id') && isset($estudiantes))
        <div class="mt-10 bg-white rounded-xl shadow-lg p-8 max-w-4xl mx-auto">
            <h2 class="text-2xl font-bold mb-6 text-indigo-700 text-center">Estudiantes inscritos en la materia</h2>
            <div class="flex justify-end mb-4">
                <a href="{{ route('notas.asignarEstudiantes', request('materia_id')) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition">Asignar estudiante a materia</a>
            </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-indigo-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estudiante</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nota</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($estudiantes as $estudiante)
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
                                    <a href="{{ route('notas.create', ['estudiante_id' => $estudiante->id, 'materia_id' => request('materia_id')]) }}" class="action-icon-btn action-add text-green-600 font-semibold" title="Agregar Nota">Agregar Nota</a>
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
    @endif
@endsection
