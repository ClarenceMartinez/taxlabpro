<?php

namespace App\Http\Controllers;

use App\Models\IntangibleAsset;
use App\Models\Client;
use Illuminate\Http\Request;

class IntangibleAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Por ejemplo, mostrar todos los activos intangibles
        // O podrías filtrar por cliente usando un request param
        $intangibleAssets = IntangibleAsset::with('client')->get();
        return view('intangibleAssets.index', compact('intangibleAssets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retorna una vista con un formulario para crear
        return view('intangibleAssets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida los datos
        $request->validate([
            'client_id'     => 'required|exists:clients,id',
            'description'   => 'nullable|string',
            'purchase_date' => 'nullable|date',
            'current_value' => 'nullable|numeric',
        ]);

        // Crea el registro
        $intangibleAsset = IntangibleAsset::create($request->all());

        return redirect()->route('intangibleAssets.show', $intangibleAsset)
                         ->with('success', 'Activo intangible creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(IntangibleAsset $intangibleAsset)
    {
        return view('intangibleAssets.show', compact('intangibleAsset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IntangibleAsset $intangibleAsset)
    {
        return view('intangibleAssets.edit', compact('intangibleAsset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataUpdate         = IntangibleAsset::findOrFail($id);
        $name               = $request->input('name');
        $value              = $request->input('value');
        $dataUpdate->$name  = $value;

        $dataUpdate->update();

        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'IntangibleAsset record updated successfully', 'data' => $dataUpdate]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IntangibleAsset $intangibleAsset)
    {
        $intangibleAsset->delete();

        return redirect()->route('intangibleAssets.index')
                         ->with('success', 'Activo intangible eliminado.');
    }
}
