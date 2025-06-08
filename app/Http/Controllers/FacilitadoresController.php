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
        $query = Facilitador::query();

        if ($request->filled('busqueda')) {
            $busqueda = $request->input('busqueda');
            $query->where('nombre', 'like', "%$busqueda%")
                  ->orWhere('materia', 'like', "%$busqueda%")
                  ->orWhere('telefono', 'like', "%$busqueda%")
                  ->orWhere('email', 'like', "%$busqueda%")
                  ->orWhere('estado', 'like', "%$busqueda%")
                  ;
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
            'materia' => 'required|string|max:100',
            'estado' => 'required|in:activo,inactivo',
        ]);

        $facilitador = Facilitador::create($validatedData);

        // Redirige a la lista de facilitadores con un mensaje de éxito en la sesión
        return redirect()->route('facilitadores.index')
            ->with('success', 'Facilitador creado exitosamente');
    }

    /**
     * Mostrar un facilitador específico.
     */
    public function show($id)
    {
        $facilitador = Facilitador::findOrFail($id);
        return response()->json($facilitador);
    }

    /**
     * Mostrar el formulario para editar un facilitador.
     */
    public function edit($id)
    {
        $facilitador = Facilitador::findOrFail($id);
        return view('facilitadores.edit', compact('facilitador'));
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
            'materia' => 'required|string|max:100',
            'estado' => 'required|in:activo,inactivo',
        ]);

        $facilitador->update($validatedData);

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
