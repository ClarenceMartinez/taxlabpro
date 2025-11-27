<?php

namespace App\Http\Controllers;

use App\Models\Receivable;
use App\Models\Client;
use Illuminate\Http\Request;

class ReceivableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Por ejemplo, mostrar todas las receivables
        // O podrías filtrar por cliente usando un request param
        $receivables = Receivable::with('client')->get();
        return view('receivables.index', compact('receivables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retorna una vista con un formulario para crear
        return view('receivables.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida los datos
        $request->validate([
            'client_id'           => 'required|exists:clients,id',
            'type'                => 'nullable|string',
            'account_description' => 'nullable|string',
            'status'              => 'nullable|string',
            'due_date'            => 'nullable|date',
            'invoice_no'          => 'nullable|string',
            'amount_due'          => 'nullable|numeric',
            // etc.
        ]);

        // Crea el registro
        $receivable = Receivable::create($request->all());

        return redirect()->route('receivables.show', $receivable)
                         ->with('success', 'Registro creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Receivable $receivable)
    {
        return view('receivables.show', compact('receivable'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Receivable $receivable)
    {
        return view('receivables.edit', compact('receivable'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataUpdate         = Receivable::findOrFail($id);
        $name               = $request->input('name');
        $value              = $request->input('value');
        $dataUpdate->$name  = $value;

        $dataUpdate->update();

        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'Receivable record updated successfully', 'data' => $dataUpdate]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receivable $receivable)
    {
        $receivable->delete();

        return redirect()->route('receivables.index')
                         ->with('success', 'Registro eliminado.');
    }
}
