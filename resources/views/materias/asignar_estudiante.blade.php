@extends('layouts.app_sidebar_modern')

@section('title', 'Asignar estudiante a materia')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Asignar estudiante a {{ $materia->nombre }}</h1>
    <form method="POST" action="{{ route('materias.asignarEstudiante.store', $materia->id) }}" class="max-w-md mx-auto bg-white p-6 rounded shadow">
        @csrf
        <div class="mb-4">
            <label for="estudiante_id" class="block mb-2 font-semibold">Selecciona un estudiante</label>
            <select name="estudiante_id" id="estudiante_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Selecciona --</option>
                @foreach($estudiantes as $estudiante)
                    <option value="{{ $estudiante->id }}">{{ $estudiante->nombre }} {{ $estudiante->apellido }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Asignar</button>
    </form>
@endsection
