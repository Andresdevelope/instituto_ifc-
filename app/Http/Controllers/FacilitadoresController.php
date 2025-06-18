<?php

namespace App\Http\Controllers;

use App\Models\Facilitador;
use Illuminate\Http\Request;

class FacilitadoresController extends Controller
{
    /**
     * Mostrar una lista de facilitadores.
     */
    public function index(Request $request)
    {
        $query = Facilitador::with('materias'); // Eager loading de materias

        if ($request->filled('busqueda')) {
            $busqueda = $request->input('busqueda');
            $query->where(function($q) use ($busqueda) {
                $q->where('nombre', 'like', "%$busqueda%")
                  ->orWhere('telefono', 'like', "%$busqueda%")
                  ->orWhere('email', 'like', "%$busqueda%")
                  ->orWhere('estado', 'like', "%$busqueda%")
                  // Buscar también por nombre de materia relacionada
                  ->orWhereHas('materias', function($q2) use ($busqueda) {
                      $q2->where('nombre', 'like', "%$busqueda%")
                         ->orWhere('codigo', 'like', "%$busqueda%")
                         ;
                  });
            });
        }

        $facilitadores = $query->paginate(10);
        return view('facilitadores.index', compact('facilitadores'));
    }

    /**
     * Mostrar el formulario para crear un nuevo facilitador.
     */
    public function create()
    {
        return view('facilitadores.create');
    }

    /**
     * Almacenar un nuevo facilitador en la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'cedula' => 'required|string|max:20',
            'telefono' => 'required|string|max:11',
            'email' => 'required|email|max:255|unique:facilitadores,email',
            'estado' => 'required|in:activo,inactivo',
            // 'materia' eliminado
            'materias' => 'required|array',
            'materias.*' => 'exists:materias,id',
        ]);

        $facilitador = Facilitador::create($validatedData);

        // Asignar las materias seleccionadas a este facilitador
        foreach ($request->materias as $materiaId) {
            $materia = \App\Models\Materia::find($materiaId);
            if ($materia) {
                $materia->facilitador_id = $facilitador->id;
                $materia->save();
            }
        }

        return redirect()->route('facilitadores.index')
            ->with('success', 'Facilitador creado exitosamente y materias asignadas.');
    }

    /**
     * Mostrar un facilitador específico.
     */
    public function show($id)
    {
        $facilitador = Facilitador::with('materias')->findOrFail($id);
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json($facilitador);
        }
        return view('facilitadores.show', compact('facilitador'));
    }

    /**
     * Mostrar el formulario para editar un facilitador.
     */
    public function edit($id)
    {
        $facilitador = Facilitador::with('materias')->findOrFail($id);
        $materias = \App\Models\Materia::orderBy('nombre')->get();
        $materiasAsignadas = $facilitador->materias->pluck('id')->toArray();
        return view('facilitadores.edit', compact('facilitador', 'materias', 'materiasAsignadas'));
    }

    /**
     * Actualizar un facilitador en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $facilitador = Facilitador::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'cedula' => 'required|string|max:20',
            'telefono' => 'required|string|max:11',
            'email' => 'required|email|max:255|unique:facilitadores,email,' . $id,
            'estado' => 'required|in:activo,inactivo',
            'materias' => 'required|array',
            'materias.*' => 'exists:materias,id',
        ]);

        $facilitador->update($validatedData);

        // Desasignar todas las materias actuales de este facilitador
        \App\Models\Materia::where('facilitador_id', $facilitador->id)->update(['facilitador_id' => null]);
        // Asignar solo las materias seleccionadas
        foreach ($request->materias as $materiaId) {
            $materia = \App\Models\Materia::find($materiaId);
            if ($materia) {
                $materia->facilitador_id = $facilitador->id;
                $materia->save();
            }
        }

        return redirect()->route('facilitadores.index')
            ->with('success', 'Facilitador actualizado exitosamente');
    }

    /**
     * Eliminar un facilitador de la base de datos.
     */
    public function destroy($id)
    {
        $facilitador = Facilitador::findOrFail($id);
        $facilitador->delete();

        return redirect()->route('facilitadores.index')
            ->with('success', 'Facilitador eliminado exitosamente');
    }
}
