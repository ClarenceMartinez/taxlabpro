<?php

namespace App\Http\Controllers;

use App\Models\CompanyIntangibleAsset;
use Illuminate\Http\Request;

class CompanyIntangibleAssetController extends Controller
{
    /**
     * Muestra todos los activos intangibles de una empresa.
     */
    public function index($client_id)
    {
        return response()->json(CompanyIntangibleAsset::where('client_id', $client_id)->get());
    }

    /**
     * Agrega un nuevo activo intangible de la empresa.
     */
    public function store(Request $request)
    {
        $data = CompanyIntangibleAsset::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'CompanyIntangibleAsset record added successfully', 'data' => $data], 201);
    }

    /**
     * Muestra un activo intangible específico.
     */
    public function show($id)
    {
        return response()->json(CompanyIntangibleAsset::findOrFail($id));
    }

    /**
     * Actualiza un activo intangible.
     */
    public function update(Request $request, string $id)
    {
        $dataUpdate         = CompanyIntangibleAsset::findOrFail($id);
        $name              	= $request->input('name');
        $value             	= $request->input('value');
        $dataUpdate->$name  = $value;

        $dataUpdate->update();

        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'CompanyIntangibleAsset record updated successfully', 'data' => $dataUpdate]);
    }

    /**
     * Elimina un activo intangible.
     */
    public function destroy($id)
    {
        CompanyIntangibleAsset::findOrFail($id)->delete();
        return response()->json(['message' => 'Company intangible asset deleted successfully!']);
    }
}
