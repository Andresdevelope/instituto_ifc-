@extends('layouts.app_sidebar_modern')

@section('title', 'Editar Estudiante')

@section('content')
    @include('components.back-button', ['backUrl' => route('estudiantes.index')])

    <h1 class="text-3xl font-bold mb-8 text-center">Editar Estudiante</h1>

    <form action="{{ route('estudiantes.update', $estudiante->id) }}" method="POST" class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg space-y-8">
        @csrf
        @method('PUT')

        <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Información Personal</h2>
                <div class="mb-4">
                    <label for="nombre" class="block font-medium mb-1">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $estudiante->nombre) }}" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('nombre')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="apellido" class="block font-medium mb-1">Apellido</label>
                    <input type="text" id="apellido" name="apellido" value="{{ old('apellido', $estudiante->apellido) }}" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('apellido')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="cedula" class="block font-medium mb-1">Cédula</label>
                    <input type="text" id="cedula" name="cedula" value="{{ old('cedula', $estudiante->cedula) }}" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('cedula')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="fecha_nacimiento" class="block font-medium mb-1">Fecha de Nacimiento</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $estudiante->fecha_nacimiento) }}" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('fecha_nacimiento')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="edad" class="block font-medium mb-1">Edad</label>
                    <input type="number" id="edad" name="edad" value="{{ old('edad', $estudiante->edad) }}" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('edad')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Información de Contacto y Estado</h2>
                <div class="mb-4">
                    <label for="telefono" class="block font-medium mb-1">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $estudiante->telefono) }}" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('telefono')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="correo" class="block font-medium mb-1">Correo Electrónico</label>
                    <input type="email" id="correo" name="correo" value="{{ old('correo', $estudiante->correo) }}" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('correo')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="estado" class="block font-medium mb-1">Estado</label>
                    <select id="estado" name="estado" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="matriculado" {{ old('estado', $estudiante->estado) == 'matriculado' ? 'selected' : '' }}>Matriculado</option>
                        <option value="graduado" {{ old('estado', $estudiante->estado) == 'graduado' ? 'selected' : '' }}>Graduado</option>
                        <option value="retirado" {{ old('estado', $estudiante->estado) == 'retirado' ? 'selected' : '' }}>Retirado</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="genero" class="block font-medium mb-1">Género</label>
                    <select id="genero" name="genero" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="masculino" {{ old('genero', $estudiante->genero) == 'masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="femenino" {{ old('genero', $estudiante->genero) == 'femenino' ? 'selected' : '' }}>Femenino</option>
                    </select>
                </div>
            </div>
        </section>

        <div class="mt-8 flex justify-center">
            <button type="submit" class="bg-blue-800 text-white px-8 py-3 rounded-lg shadow-lg hover:bg-blue-900 transition duration-300" style="cursor:pointer;">
                Guardar
            </button>
        </div>
    </form>
@endsection
