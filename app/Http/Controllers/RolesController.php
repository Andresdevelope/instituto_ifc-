<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Mostrar una lista de roles.
     */
    public function index()
    {    //me devuelve todos los roles de la base de datos

        $roles = Rol::all();
        //me los muestra en la vista roles.index
        //compact('roles') es una forma de pasar variables a la vista
        return view('roles.index', compact('roles'));
    }

    /**
     * Mostrar el formulario para crear un nuevo rol.
     */
    public function create()
    {
        return response()->json(['message' => 'Mostrar formulario para crear rol']);
    }

    /**
     * Almacenar un nuevo rol en la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255|unique:roles,nombre',
            'descripcion' => 'nullable|string',
        ]);

        $rol = Rol::create($validatedData);

        return response()->json(['message' => 'Rol creado exitosamente', 'rol' => $rol], 201);
    }

    /**
     * Mostrar un rol específico.
     */
    public function show($id)
    {
        $rol = Rol::findOrFail($id);
        return response()->json($rol);
    }

    /**
     * Mostrar el formulario para editar un rol.
     */
    public function edit($id)
    {
        $rol = Rol::findOrFail($id);
        return response()->json(['message' => 'Mostrar formulario para editar rol', 'rol' => $rol]);
    }

    /**
     * Actualizar un rol en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $rol = Rol::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string|max:255|unique:roles,nombre,' . $id,
            'descripcion' => 'nullable|string',
        ]);

        $rol->update($validatedData);

        return response()->json(['message' => 'Rol actualizado exitosamente', 'rol' => $rol]);
    }

    /**
     * Eliminar un rol de la base de datos.
     */
    public function destroy($id)
    {
        $rol = Rol::findOrFail($id);
        $rol->delete();

        return response()->json(['message' => 'Rol eliminado exitosamente']);
    }
}
