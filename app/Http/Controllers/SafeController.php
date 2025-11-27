<?php

namespace App\Http\Controllers;

use App\Models\Safe;
use App\Models\Client;
use Illuminate\Http\Request;

class SafeController extends Controller
{
    /**
     * Muestra la lista de safes.
     */
    public function index()
    {
        // Ejemplo: obtener todos los safes con su cliente
        $safes = Safe::with('client')->get();
        return view('safes.index', compact('safes'));
    }

    /**
     * Muestra el formulario para crear un safe.
     */
    public function create()
    {
        // Si necesitas listar clientes para un select:
        $clients = Client::all();
        return view('safes.create', compact('clients'));
    }

    /**
     * Almacena un nuevo safe en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar la información
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'contents'  => 'nullable|string',
            'value'     => 'nullable|numeric',
        ]);

        // Crear el safe
        Safe::create($request->all());

        return redirect()->route('safes.index')->with('success', 'Safe creado correctamente.');
    }

    /**
     * Muestra un safe específico.
     */
    public function show(Safe $safe)
    {
        return view('safes.show', compact('safe'));
    }

    /**
     * Muestra el formulario para editar un safe.
     */
    public function edit(Safe $safe)
    {
        $clients = Client::all();
        return view('safes.edit', compact('safe', 'clients'));
    }

    /**
     * Actualiza la información de un safe.
     */
    public function update(Request $request, string $id)
    {
        $dataUpdate         = Safe::findOrFail($id);
        $name               = $request->input('name');
        $value              = $request->input('value');
        $dataUpdate->$name  = $value;

        $dataUpdate->update();

        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'Safe record updated successfully', 'data' => $dataUpdate]);
    }

    /**
     * Elimina un safe.
     */
    public function destroy(Safe $safe)
    {
        $safe->delete();
        return redirect()->route('safes.index')->with('success', 'Safe eliminado correctamente.');
    }
}
