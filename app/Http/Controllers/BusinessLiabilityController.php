<?php

namespace App\Http\Controllers;

use App\Models\BusinessLiability;
use App\Models\Client;
use Illuminate\Http\Request;

class BusinessLiabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Por ejemplo, mostrar todos los pasivos
        // O podrías filtrar por cliente usando un request param
        $businessLiabilities = BusinessLiability::with('client')->get();
        return view('businessLiabilities.index', compact('businessLiabilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retorna una vista con un formulario para crear
        return view('businessLiabilities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida los datos
        $request->validate([
            'client_id'      => 'required|exists:clients,id',
            'description'    => 'nullable|string',
            'name'           => 'nullable|string',
            'street'         => 'nullable|string',
            'city'           => 'nullable|string',
            'state'          => 'nullable|string',
            'zip'            => 'nullable|string',
            'phone'          => 'nullable|string',
            'date_pledged'   => 'nullable|date',
            'balance_owed'   => 'nullable|numeric',
            'payment_amount' => 'nullable|numeric',
            'final_payment'  => 'nullable|date',
            'secured'        => 'boolean',
            'unsecured'      => 'boolean',
        ]);

        // Crea el registro
        $businessLiability = BusinessLiability::create($request->all());

        return redirect()->route('businessLiabilities.show', $businessLiability)
                         ->with('success', 'Pasivo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BusinessLiability $businessLiability)
    {
        return view('businessLiabilities.show', compact('businessLiability'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BusinessLiability $businessLiability)
    {
        return view('businessLiabilities.edit', compact('businessLiability'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataUpdate         = BusinessLiability::findOrFail($id);
        $name               = $request->input('name');
        $value              = $request->input('value');
        $dataUpdate->$name  = $value;

        $dataUpdate->update();

        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'BusinessLiability record updated successfully', 'data' => $dataUpdate]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BusinessLiability $businessLiability)
    {
        $businessLiability->delete();

        return redirect()->route('businessLiabilities.index')
                         ->with('success', 'Pasivo eliminado.');
    }
}
