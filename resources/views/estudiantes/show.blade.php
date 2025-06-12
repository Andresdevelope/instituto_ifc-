@extends('layouts.app_sidebar_modern')

@section('title', 'Detalle del Estudiante')

@section('content')
<div class="max-w-3xl mx-auto bg-gradient-to-br from-blue-100 to-purple-100 rounded-2xl shadow-xl p-10 mt-8">
    <div class="flex flex-col sm:flex-row items-center gap-8">
        <div class="flex-1">
            <h2 class="text-3xl font-bold text-blue-800 mb-2">{{ $estudiante->nombre }} {{ $estudiante->apellido }}</h2>
            <p class="text-gray-600 mb-4">{{ $estudiante->correo }}</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div><span class="font-semibold">Cédula:</span> {{ $estudiante->cedula }}</div>
                <div><span class="font-semibold">Estado:</span> {{ $estudiante->estado }}</div>
                <div><span class="font-semibold">Género:</span> {{ $estudiante->genero }}</div>
                <div><span class="font-semibold">Edad:</span> {{ $estudiante->edad }}</div>
                <div><span class="font-semibold">Nacimiento:</span> {{ $estudiante->fecha_nacimiento }}</div>
                <div><span class="font-semibold">Teléfono:</span> {{ $estudiante->telefono }}</div>
            </div>
        </div>
        <div>
            <img src="/icons/graduado.png" alt="Avatar" class="w-32 h-32 rounded-full border-4 border-blue-300 shadow-lg">
        </div>
    </div>
    <a href="{{ route('estudiantes.index') }}" class="mt-8 inline-block px-8 py-3 bg-blue-700 text-white rounded-lg hover:bg-blue-900 transition">Volver</a>
</div>
@endsection
