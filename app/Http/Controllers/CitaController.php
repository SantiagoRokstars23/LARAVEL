<?php

namespace App\Http\Controllers;

use App\Http\Requests\CitaRequest;
use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    /**
     * Mostrar listado de citas
     */
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
        $query = Cita::query();

        if ($buscar) {
            $query->where('nombre_dueno', 'like', "%$buscar%")
                  ->orWhere('nombre_mascota', 'like', "%$buscar%");
        }

        $citas = $query->orderBy('fecha', 'asc')->paginate(5);

        return view('cita.index', compact('citas'));
    }

    /**
     * Mostrar formulario para crear cita
     */
    public function create()
    {
        return view('cita.create');
    }

    /**
     * Guardar nueva cita
     */
    public function store(CitaRequest $request)
    {
        Cita::create($request->validated());
        return redirect()->route('cita.index')->with('success', 'Cita registrada con éxito');
    }

    /**
     * Mostrar formulario para editar cita
     */
    public function edit($id)
    {
        $cita = Cita::findOrFail($id);
        return view('cita.edit', compact('cita'));
    }

    /**
     * Actualizar cita
     */
    public function update(CitaRequest $request, $id)
    {
        $cita = Cita::findOrFail($id);
        $cita->update($request->validated());
        return redirect()->route('cita.index')->with('success', 'Cita actualizada correctamente');
    }

    /**
     * Eliminar cita
     */
    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();
        return redirect()->route('cita.index')->with('success', 'Cita eliminada');
    }
}
