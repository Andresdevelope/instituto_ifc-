<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Illuminate\Http\Request;

class NotasController extends Controller
{
    /**
     * Mostrar una lista de notas.
     */
    public function index()
    {
        $notas = Nota::all();
        return view('notas.index', compact('notas'));
    }

    /**
     * Mostrar el formulario para crear una nueva nota.
     */
    public function create()
    {
        return response()->json(['message' => 'Mostrar formulario para crear nota']);
    }

    /**
     * Almacenar una nueva nota en la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nota' => 'required|numeric|between:0,100',
            'fecha' => 'required|date',
            'estudiante_id' => 'required|exists:estudiantes,id',
            'materia_id' => 'required|exists:materias,id',
            'facilitador_id' => 'required|exists:facilitadores,id',
        ]);

        $nota = Nota::create($validatedData);

        return response()->json(['message' => 'Nota creada exitosamente', 'nota' => $nota], 201);
    }

    /**
     * Mostrar una nota específica.
     */
    public function show($id)
    {
        $nota = Nota::findOrFail($id);
        return response()->json($nota);
    }

    /**
     * Mostrar el formulario para editar una nota.
     */
    public function edit($id)
    {
        $nota = Nota::findOrFail($id);
        return response()->json(['message' => 'Mostrar formulario para editar nota', 'nota' => $nota]);
    }

    /**
     * Actualizar una nota en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $nota = Nota::findOrFail($id);

        $validatedData = $request->validate([
            'nota' => 'sometimes|required|numeric|between:0,100',
            'fecha' => 'sometimes|required|date',
            'estudiante_id' => 'sometimes|required|exists:estudiantes,id',
            'materia_id' => 'sometimes|required|exists:materias,id',
            'facilitador_id' => 'sometimes|required|exists:facilitadores,id',
        ]);

        $nota->update($validatedData);

        return response()->json(['message' => 'Nota actualizada exitosamente', 'nota' => $nota]);
    }

    /**
     * Eliminar una nota de la base de datos.
     */
    public function destroy($id)
    {
        $nota = Nota::findOrFail($id);
        $nota->delete();

        return response()->json(['message' => 'Nota eliminada exitosamente']);
    }
}
