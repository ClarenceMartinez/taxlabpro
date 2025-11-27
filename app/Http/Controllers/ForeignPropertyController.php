<?php

namespace App\Http\Controllers;

use App\Models\ForeignProperty;
use App\Models\Client;
use Illuminate\Http\Request;

class ForeignPropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Por ejemplo, mostrar todas las propiedades extranjeras
        // O podrías filtrar por cliente usando un request param
        $foreignProperties = ForeignProperty::with('client')->get();
        return view('foreignProperties.index', compact('foreignProperties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retorna una vista con un formulario para crear
        return view('foreignProperties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida los datos
        $request->validate([
            'client_id'   => 'required|exists:clients,id',
            'description' => 'nullable|string',
            'location'    => 'nullable|string',
            'value'       => 'nullable|numeric',
        ]);

        // Crea el registro
        $foreignProperty = ForeignProperty::create($request->all());

        return redirect()->route('foreignProperties.show', $foreignProperty)
                         ->with('success', 'Propiedad/activo extranjero creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ForeignProperty $foreignProperty)
    {
        return view('foreignProperties.show', compact('foreignProperty'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ForeignProperty $foreignProperty)
    {
        return view('foreignProperties.edit', compact('foreignProperty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataUpdate         = ForeignProperty::findOrFail($id);
        $name               = $request->input('name');
        $value              = $request->input('value');
        $dataUpdate->$name  = $value;

        $dataUpdate->update();

        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'ForeignProperty record updated successfully', 'data' => $dataUpdate]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ForeignProperty $foreignProperty)
    {
        $foreignProperty->delete();

        return redirect()->route('foreignProperties.index')
                         ->with('success', 'Propiedad/activo extranjero eliminado.');
    }
}
