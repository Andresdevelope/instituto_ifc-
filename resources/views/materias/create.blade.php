@extends('layouts.app_sidebar_modern')

@section('title', 'Registrar Nueva Materia')

@section('content')
    @include('components.back-button')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Registrar Nueva Materia</h1>
    </div>
    <div class="max-w-lg mx-auto bg-white rounded-lg shadow-md p-8">
        <form method="POST" action="{{ route('materias.store') }}">
            @csrf
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre de la materia</label>
                <input type="text" name="nombre" id="nombre" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ old('nombre') }}" required>
                @error('nombre')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="codigo" class="block text-gray-700 font-semibold mb-2">Código</label>
                <input type="text" name="codigo" id="codigo" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ old('codigo') }}" required>
                @error('codigo')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700 font-semibold mb-2">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="facilitador_id" class="block text-gray-700 font-semibold mb-2">Facilitador</label>
                <select name="facilitador_id" id="facilitador_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">-- Selecciona un facilitador --</option>
                    @foreach($facilitadores as $facilitador)
                        <option value="{{ $facilitador->id }}" {{ old('facilitador_id') == $facilitador->id ? 'selected' : '' }}>{{ $facilitador->nombre }} {{ $facilitador->apellido }}</option>
                    @endforeach
                </select>
                @error('facilitador_id')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-md shadow transition-all">Registrar Materia</button>
            </div>
        </form>
    </div>
@endsection
