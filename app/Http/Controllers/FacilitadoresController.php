<?php

namespace App\Http\Controllers;

use App\Models\Facilitador;
use Illuminate\Http\Request;

class FacilitadoresController extends Controller
{
    /**
     * Mostrar una lista de facilitadores.
     */
    public function index()
    {
        $facilitadores = Facilitador::all();
        return view('facilitadores.index', compact('facilitadores'));
    }

    /**
     * Mostrar el formulario para crear un nuevo facilitador.
     */
    public function create()
    {
        return response()->json(['message' => 'Mostrar formulario para crear facilitador']);
    }

    /**
     * Almacenar un nuevo facilitador en la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:facilitadores,email',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'estado' => 'required|in:activo,inactivo',
            'user_id' => 'required|exists:users,id|unique:facilitadores,user_id',
            'rol_id' => 'required|exists:roles,id',
            'especialidad' => 'nullable|string|max:255',
            'biografia' => 'nullable|string',
        ]);

        $facilitador = Facilitador::create($validatedData);

        return response()->json(['message' => 'Facilitador creado exitosamente', 'facilitador' => $facilitador], 201);
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
        return response()->json(['message' => 'Mostrar formulario para editar facilitador', 'facilitador' => $facilitador]);
    }

    /**
     * Actualizar un facilitador en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $facilitador = Facilitador::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'apellido' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:facilitadores,email,' . $id,
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'estado' => 'sometimes|required|in:activo,inactivo',
            'user_id' => 'sometimes|required|exists:users,id|unique:facilitadores,user_id,' . $id,
            'rol_id' => 'sometimes|required|exists:roles,id',
            'especialidad' => 'nullable|string|max:255',
            'biografia' => 'nullable|string',
        ]);

        $facilitador->update($validatedData);

        return response()->json(['message' => 'Facilitador actualizado exitosamente', 'facilitador' => $facilitador]);
    }

    /**
     * Eliminar un facilitador de la base de datos.
     */
    public function destroy($id)
    {
        $facilitador = Facilitador::findOrFail($id);
        $facilitador->delete();

        return response()->json(['message' => 'Facilitador eliminado exitosamente']);
    }
}
