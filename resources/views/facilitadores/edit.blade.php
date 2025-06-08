@extends('layouts.app_sidebar_modern')

@section('title', 'Editar Facilitador')

@section('content')
    @include('components.back-button', ['backUrl' => route('facilitadores.index')])

    <h1 class="text-3xl font-bold mb-8 text-center">Editar Facilitador</h1>

    <form action="{{ route('facilitadores.update', $facilitador->id) }}" method="POST" class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg space-y-8">
        @csrf
        @method('PUT')
        <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Información Personal</h2>
                <div class="mb-4">
                    <label for="nombre" class="block font-medium mb-1">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $facilitador->nombre) }}" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('nombre')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="apellido" class="block font-medium mb-1">Apellido</label>
                    <input type="text" id="apellido" name="apellido" value="{{ old('apellido', $facilitador->apellido) }}" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('apellido')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="cedula" class="block font-medium mb-1">Cédula</label>
                    <input type="text" id="cedula" name="cedula" value="{{ old('cedula', $facilitador->cedula) }}" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('cedula')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div>
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Contacto y Estado</h2>
                <div class="mb-4">
                    <label for="telefono" class="block font-medium mb-1">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $facilitador->telefono) }}" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('telefono')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block font-medium mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $facilitador->email) }}" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="materia" class="block font-medium mb-1">Materia</label>
                    <input type="text" id="materia" name="materia" value="{{ old('materia', $facilitador->materia) }}" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('materia')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="estado" class="block font-medium mb-1">Estado</label>
                    <select id="estado" name="estado" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="activo" {{ old('estado', $facilitador->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="inactivo" {{ old('estado', $facilitador->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </section>
        <div class="mt-8 flex justify-center gap-4">
            <button type="submit" class="bg-blue-800 text-white px-8 py-3 rounded-lg shadow-lg hover:bg-blue-900 transition duration-300">
                Guardar
            </button>
            <a href="{{ route('facilitadores.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-8 py-3 rounded-lg shadow-lg transition duration-300">Cancelar</a>
        </div>
    </form>
@endsection
