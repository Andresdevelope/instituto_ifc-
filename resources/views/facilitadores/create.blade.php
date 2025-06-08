@extends('layouts.app_sidebar_modern')

@section('title', 'Registrar Nuevo  Facilitador')

@section('content')
    @include('components.back-button', ['backUrl' => route('facilitadores.index')])

    <h1 class="text-3xl font-bold mb-8 text-center">Registrar Nuevo Facilitador</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 max-w-4xl mx-auto">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 max-w-4xl mx-auto">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('facilitadores.store') }}" method="POST" class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg space-y-8">
        @csrf
        <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Información Personal</h2>
                <div class="mb-4">
                    <label for="nombre" class="block font-medium mb-1">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('nombre')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="apellido" class="block font-medium mb-1">Apellido</label>
                    <input type="text" name="apellido" id="apellido" value="{{ old('apellido') }}" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('apellido')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="cedula" class="block font-medium mb-1">Cédula</label>
                    <input type="text" name="cedula" id="cedula" value="{{ old('cedula') }}" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('cedula')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="materia" class="block font-medium mb-1">Asignatura</label>
                    <input type="text" name="materia" id="materia" value="{{ old('materia') }}" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ejemplo: Biblia, Teología, Música" />
                    @error('materia')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div>
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Información de Contacto y Estado</h2>
                <div class="mb-4">
                    <label for="telefono" class="block font-medium mb-1">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" value="{{ old('telefono') }}" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('telefono')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block font-medium mb-1">Correo Electrónico</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="estado" class="block font-medium mb-1">Estado</label>
                    <select name="estado" id="estado" required
                        class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Seleccione un estado</option>
                        <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </section>
        <div class="mt-8 flex justify-center">
            <button type="submit"
                class="bg-blue-800 text-white px-8 py-3 rounded-lg shadow-lg hover:bg-blue-900 transition duration-300">
                Registrar
            </button>
        </div>
    </form>
@endsection
