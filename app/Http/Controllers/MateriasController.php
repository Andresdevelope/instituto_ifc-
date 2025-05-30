<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;

class MateriasController extends Controller
{
    /**
     * Mostrar una lista de materias.
     */
    //porque la funcion index no tiene el id como parametro
    //porque no se necesita un id para mostrar todas las materias
    public function index()
    {
        $materias = Materia::all();
        return view('materias.index', compact('materias'));
    }

    /**
     * Mostrar el formulario para crear una nueva materia.
     */
    public function create()
    {
        return response()->json(['message' => 'Mostrar formulario para crear materia']);
    }

    /**
     * Almacenar una nueva materia en la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:50',
            'codigo' => 'required|string|max:10|unique:materias,codigo',
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:activa,inactiva',
            'facilitador_id' => 'required|exists:facilitadores,id',
            'user_id' => 'nullable|exists:users,id',
            'rol_id' => 'nullable|exists:roles,id',
            'estudiante_id' => 'nullable|exists:estudiantes,id',
        ]);

        $materia = Materia::create($validatedData);

        return response()->json(['message' => 'Materia creada exitosamente', 'materia' => $materia], 201);
    }

    /**
     * Mostrar una materia específica.
     */
    public function show($id)
    {
        $materia = Materia::findOrFail($id);
        return response()->json($materia);
    }

    /**
     * Mostrar el formulario para editar una materia.
     */
    public function edit($id)
    {
        $materia = Materia::findOrFail($id);
        return response()->json(['message' => 'Mostrar formulario para editar materia', 'materia' => $materia]);
    }

    /**
     * Actualizar una materia en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $materia = Materia::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string|max:50',
            'codigo' => 'sometimes|required|string|max:10|unique:materias,codigo,' . $id,
            'descripcion' => 'nullable|string',
            'estado' => 'sometimes|required|in:activa,inactiva',
            'facilitador_id' => 'sometimes|required|exists:facilitadores,id',
            'user_id' => 'nullable|exists:users,id',
            'rol_id' => 'nullable|exists:roles,id',
            'estudiante_id' => 'nullable|exists:estudiantes,id',
        ]);

        $materia->update($validatedData);

        return response()->json(['message' => 'Materia actualizada exitosamente', 'materia' => $materia]);
    }

    /**
     * Eliminar una materia de la base de datos.
     */
    public function destroy($id)
    {
        $materia = Materia::findOrFail($id);
        $materia->delete();

        return response()->json(['message' => 'Materia eliminada exitosamente']);
    }
}
