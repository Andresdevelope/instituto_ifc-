<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EstudiantesController extends Controller
{
    /**
     * Mostrar una lista de estudiantes.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');

        $estudiantes = Estudiante::query();

        if ($query) {
            $estudiantes = $estudiantes->where(function ($q) use ($query) {
                $q->where('nombre', 'LIKE', "%{$query}%")
                  ->orWhere('apellido', 'LIKE', "%{$query}%")
                  ->orWhere('cedula', 'LIKE', "%{$query}%");
            });
        }

        $estudiantes = $estudiantes->get();

        return view('estudiantes.index', compact('estudiantes', 'query'));
    }

    /**
     * Mostrar el formulario para crear un nuevo estudiante.
     */
    public function create()
    {
        // Retornar la vista con el formulario para crear estudiante
        return view('estudiantes.create');
    }

    /**
     * Almacenar un nuevo estudiante en la base de datos.
     */
    public function store(Request $request)
    {
        Log::info('Datos recibidos en store:', $request->all());

        // Validar los datos recibidos
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'cedula' => 'required|string|size:8|unique:estudiantes,cedula',
            'estado' => 'required|in:matriculado,graduado,retirado',
            'genero' => 'required|in:masculino,femenino',
            'edad' => 'required|integer|min:0',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'required|string|max:15',
            'correo' => 'required|email|unique:estudiantes,correo',
            'user_id' => 'nullable|exists:users,id',
        ]);

        // Crear el estudiante con los datos validados
        $estudiante = Estudiante::create($validatedData);

        // Redirigir a la lista de estudiantes con mensaje de éxito
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante creado exitosamente');
    }

    /**
     * Mostrar un estudiante específico.
     */
    public function show($id)
    {       //que es findorfail, que hace
        // findOrFail busca un registro por su ID y lanza una excepción si no se encuentra.
        // Si se encuentra, devuelve el estudiante. Si no se encuentra, lanza una excepción.
        // Esto es útil para asegurarse de que el estudiante exista antes de intentar acceder a sus datos.
        $estudiante = Estudiante::findOrFail($id);
        return view('estudiantes.show', compact('estudiante'));
    }

    /**
     * Mostrar el formulario para editar un estudiante.
     */
    public function edit($id)
    {
        $estudiante = Estudiante::findOrFail($id);
        // Aquí normalmente se retornaría una vista con el formulario y datos del estudiante
        return view('estudiantes.edit', compact('estudiante'));
    }

    /**
     * Actualizar un estudiante en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $estudiante = Estudiante::findOrFail($id);

        // Validar los datos recibidos
        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string|max:50',
            'apellido' => 'sometimes|required|string|max:50',
            'cedula' => 'sometimes|required|string|size:8|unique:estudiantes,cedula,' . $id,
            'estado' => 'sometimes|required|in:matriculado,graduado,retirado',
            'genero' => 'sometimes|required|in:masculino,femenino',
            'edad' => 'sometimes|required|integer|min:0',
            'fecha_nacimiento' => 'sometimes|required|date',
            'telefono' => 'sometimes|required|string|max:15',
            'correo' => 'sometimes|required|email|unique:estudiantes,correo,' . $id,
            'user_id' => 'nullable|exists:users,id',
        ]);

        // Actualizar el estudiante con los datos validados
        $estudiante->update($validatedData);

        // Redirigir a la lista de estudiantes con mensaje de éxito
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante actualizado exitosamente');
    }

    /**
     * Eliminar un estudiante de la base de datos.
     */
    public function destroy($id)
    {
        $estudiante = Estudiante::findOrFail($id);
        $estudiante->delete();
        //cambiar el mensaje de exito
        // Redirigir a la lista de estudiantes con mensaje de éxito
        //use redirect para redirigir a una ruta, co with para mostrar un mensaje de éxito.
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado exitosamente');
        
    }
}
