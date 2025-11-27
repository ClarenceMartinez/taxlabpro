<?php

namespace App\Http\Controllers;

use App\Models\CreditLine;
use App\Models\Client;
use Illuminate\Http\Request;

class CreditLineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Por ejemplo, mostrar todas las líneas de crédito
        // O podrías filtrar por cliente usando un request param
        $creditLines = CreditLine::with('client')->get();
        return view('creditLines.index', compact('creditLines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retorna una vista con un formulario para crear
        return view('creditLines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida los datos
        $request->validate([
            'client_id'            => 'required|exists:clients,id',
            'bank_name'            => 'nullable|string',
            'account_number'       => 'nullable|string',
            'bank_address'         => 'nullable|string',
            'city'                 => 'nullable|string',
            'state'                => 'nullable|string',
            'zip'                  => 'nullable|string',
            'property_security'    => 'nullable|string',
            'credit_limit'         => 'nullable|numeric',
            'loan_balance'         => 'nullable|numeric',
            'minimum_monthly_pmt'  => 'nullable|numeric',
            'statement_date'       => 'nullable|date',
        ]);

        // Crea la línea de crédito
        $creditLine = CreditLine::create($request->all());

        return redirect()->route('creditLines.show', $creditLine)
                         ->with('success', 'Línea de crédito creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CreditLine $creditLine)
    {
        return view('creditLines.show', compact('creditLine'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CreditLine $creditLine)
    {
        return view('creditLines.edit', compact('creditLine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataUpdate         = CreditLine::findOrFail($id);
        $name               = $request->input('name');
        $value              = $request->input('value');
        $dataUpdate->$name  = $value;

        $dataUpdate->update();

        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'CreditLine record updated successfully', 'data' => $dataUpdate]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CreditLine $creditLine)
    {
        $creditLine->delete();

        return redirect()->route('creditLines.index')
                         ->with('success', 'Línea de crédito eliminada.');
    }
}
