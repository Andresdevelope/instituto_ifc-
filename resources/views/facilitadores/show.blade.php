<div class="flex flex-col items-center text-center p-2">
    <div class="w-20 h-20 rounded-full bg-indigo-100 flex items-center justify-center mb-3">
        <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
    </div>
    <div class="text-xl font-bold text-indigo-700 mb-1">{{ $facilitador->nombre }} {{ $facilitador->apellido }}</div>
    <div class="text-sm text-gray-500 mb-2">{{ $facilitador->email }}</div>
    <div class="flex flex-col gap-1 w-full mb-2">
        <div><span class="font-semibold text-gray-600">Cédula:</span> {{ $facilitador->cedula }}</div>
        <div><span class="font-semibold text-gray-600">Teléfono:</span> {{ $facilitador->telefono }}</div>
        <div><span class="font-semibold text-gray-600">Estado:</span> <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $facilitador->estado == 'activo' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ ucfirst($facilitador->estado) }}</span></div>
        @if($facilitador->direccion)
            <div><span class="font-semibold text-gray-600">Dirección:</span> {{ $facilitador->direccion }}</div>
        @endif
    </div>
    <div class="w-full mt-2">
        <span class="font-semibold text-gray-600">Materias asignadas:</span>
        <ul class="list-disc ml-5 text-left text-sm mt-1">
            @forelse($facilitador->materias as $materia)
                <li>{{ $materia->nombre }} ({{ $materia->codigo }})</li>
            @empty
                <li>No tiene materias asignadas.</li>
            @endforelse
        </ul>
    </div>
</div>
