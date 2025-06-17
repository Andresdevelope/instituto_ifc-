@extends('layouts.app_sidebar_modern')

@section('title', 'Detalle de Materia')

@section('content')
    <h1 class="text-2xl font-bold mb-6">{{ $materia->nombre }}</h1>
    <p class="mb-4 text-gray-600">{{ $materia->descripcion ?? 'Sin descripción' }}</p>
    <div class="mb-6">
        <a href="{{ route('materias.asignarEstudiante', $materia->id) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition">Asignar estudiante a materia</a>
    </div>
    <h2 class="text-lg font-semibold mb-2">Estudiantes inscritos</h2>
    <ul class="list-disc pl-6">
        @forelse($materia->estudiantes as $estudiante)
            <li>{{ $estudiante->nombre }} {{ $estudiante->apellido }}</li>
        @empty
            <li class="text-gray-500">No hay estudiantes inscritos en esta materia.</li>
        @endforelse
    </ul>
@endsection
