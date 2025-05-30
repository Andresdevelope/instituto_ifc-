@extends('layouts.app_sidebar_modern')

@section('title', 'Detalle del Estudiante')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Detalle del Estudiante</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <div class="mb-4">
            <strong>Nombre:</strong> {{ $estudiante->nombre }}
        </div>
        <div class="mb-4">
            <strong>Apellido:</strong> {{ $estudiante->apellido }}
        </div>
        <div class="mb-4">
            <strong>Cédula:</strong> {{ $estudiante->cedula }}
        </div>
        <div class="mb-4">
            <strong>Estado:</strong> {{ $estudiante->estado }}
        </div>
        <div class="mb-4">
            <strong>Género:</strong> {{ $estudiante->genero }}
        </div>
        <div class="mb-4">
            <strong>Edad:</strong> {{ $estudiante->edad }}
        </div>
        <div class="mb-4">
            <strong>Fecha de Nacimiento:</strong> {{ $estudiante->fecha_nacimiento }}
        </div>
        <div class="mb-4">
            <strong>Teléfono:</strong> {{ $estudiante->telefono }}
        </div>
        <div class="mb-4">
            <strong>Correo:</strong> {{ $estudiante->correo }}
        </div>

        <a href="{{ route('estudiantes.index') }}" class="inline-block mt-4 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Volver al listado</a>
    </div>
@endsection
