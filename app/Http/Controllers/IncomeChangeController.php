<?php

namespace App\Http\Controllers;

use App\Models\IncomeChange;
use Illuminate\Http\Request;

class IncomeChangeController extends Controller
{
    /**
     * Listar todos los registros.
     */
    public function index()
    {
        $incomeChanges = IncomeChange::with('client')->get();
        return view('income_changes.index', compact('incomeChanges'));
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        return view('income_changes.create');
    }

    /**
     * Guardar un nuevo registro.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id'      => 'required|exists:clients,id',
            'anticipated'    => 'required|boolean',
            'explanation'    => 'nullable|string',
            'amount'         => 'nullable|numeric',
            'date_of_change' => 'nullable|date',
        ]);

        IncomeChange::create($validatedData);

        return redirect()->route('income_changes.index')
                         ->with('success', 'Registro de cambio de ingreso creado correctamente.');
    }

    /**
     * Mostrar un registro específico.
     */
    public function show(IncomeChange $incomeChange)
    {
        return view('income_changes.show', compact('incomeChange'));
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(IncomeChange $incomeChange)
    {
        return view('income_changes.edit', compact('incomeChange'));
    }

    /**
     * Actualizar un registro en la base de datos.
     */
    public function update(Request $request, string $id)
    {
        $dataUpdate         = IncomeChange::findOrFail($id);
        $name               = $request->input('name');
        $value              = $request->input('value');
        $dataUpdate->$name  = $value;

        $dataUpdate->update();

        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'IncomeChange record updated successfully', 'data' => $dataUpdate]);
    }


    public function destroy($value='')
    {
        # code...
    }
}
