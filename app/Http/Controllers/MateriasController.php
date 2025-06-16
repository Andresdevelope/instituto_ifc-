<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Facilitador;
use Illuminate\Http\Request;

class MateriasController extends Controller
{
    /**
     * Mostrar una lista de materias.
     */
    //porque la funcion index no tiene el id como parametro
    //porque no se necesita un id para mostrar todas las materias
    public function index(Request $request)
    {
        // Obtener lista de facilitadores para el filtro
        $facilitadores = Facilitador::orderBy('nombre')->get();

        // Filtros
        //porque para hacer un filtro se necesita una consulta a la base de datos y poner un query?
        // Crear una consulta base para las materias
        //porque se usa Materia::query() en lugar de Materia::all()?
        // porque Materia::query() permite construir una consulta más compleja y flexible, mientras que Materia::all() obtiene todos los registros sin filtros.
        $query = Materia::query();

        // Búsqueda por nombre o código
        if ($request->filled('busqueda')) {
            $busqueda = $request->input('busqueda');
            $query->where(function($q) use ($busqueda) {
                // que significa el uso de "use" en la función anónima y _$q?
                // El uso de "use" permite que la función anónima acceda a la variable $busqueda definida fuera de su ámbito.
                // _$q es una instancia de la consulta que se está construyendo, y se usa para agregar condiciones a esa consulta.
                // porque se usa y que es el "like" en la consulta?
                // El "like" se usa para buscar coincidencias parciales en los campos 'nombre' y 'codigo'.
                $q->where('nombre', 'like', "%$busqueda%")
                  ->orWhere('codigo', 'like', "%$busqueda%" );
            });
        }
        // Filtro por estado
        // porque se usa $request->filled('estado')?
        // porque $request->filled('estado') verifica si el campo 'estado' está presente y no está vacío en la solicitud.
        if ($request->filled('estado')) {
            $query->where('estado', $request->input('estado'));
        }
        // Filtro por facilitador
        if ($request->filled('facilitador_id')) {
            $query->where('facilitador_id', $request->input('facilitador_id'));
        }
        // Cargar relación facilitador para la vista
        $materias = $query->with('facilitador')->get();

        return view('materias.index', compact('materias', 'facilitadores'));
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

        // Redirigir con notificación flash en vez de JSON
        return redirect()->route('materias.index')->with('success', 'Materia eliminada exitosamente');
    }
}
