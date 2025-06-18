<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Materia;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotasController extends Controller
{
    /**
     * Mostrar una lista de notas.
     */
    public function index(Request $request)
    {
        $materias = Materia::all();
        $notas = collect();
        $estudiantes = collect();

        $materiaId = $request->input('materia_id');
        if ($materiaId) {
            $materia = Materia::find($materiaId);
            if ($materia) {
                $estudiantes = $materia->estudiantes;
                $notas = Nota::where('materia_id', $materiaId)->get();
            }
        } else {
            $notas = Nota::all();
        }

        return view('notas.index', compact('materias', 'notas', 'estudiantes'));
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

    /**
     * Mostrar modal para asignar estudiantes a una materia.
     */
    public function asignarEstudiantesForm(Request $request, $materia_id)
    {
        $materia = Materia::findOrFail($materia_id);
        // Estudiantes ya inscritos en la materia
        $inscritos = $materia->estudiantes->pluck('id')->toArray();
        // Estudiantes disponibles (no inscritos en la materia)
        $estudiantes = Estudiante::whereNotIn('id', $inscritos)->get();
        return view('notas.asignar_estudiantes', compact('materia', 'estudiantes'));
    }

    /**
     * Procesar la asignación de estudiantes a una materia.
     */
    public function asignarEstudiantesStore(Request $request, $materia_id)
    {
        $materia = Materia::findOrFail($materia_id);
        $request->validate([
            'estudiantes' => 'required|array',
            'estudiantes.*' => 'exists:estudiantes,id',
        ]);
        // Asignar estudiantes seleccionados a la materia (sin quitar los ya inscritos)
        $materia->estudiantes()->syncWithoutDetaching($request->estudiantes);
        return redirect()->route('notas.index', ['materia_id' => $materia_id])
            ->with('success', 'Estudiantes asignados correctamente.');
    }

    /**
     * Mostrar el detalle de una materia con sus estudiantes y notas.
     */
    public function showMateria($materia_id)
    {
        $materia = Materia::with('estudiantes')->findOrFail($materia_id);
        $notas = Nota::where('materia_id', $materia_id)->get();
        // Para el modal: estudiantes no inscritos
        $inscritos = $materia->estudiantes->pluck('id')->toArray();
        $estudiantesDisponibles = Estudiante::whereNotIn('id', $inscritos)->get();
        return view('notas.show_materia', compact('materia', 'notas', 'estudiantesDisponibles'));
    }
}
