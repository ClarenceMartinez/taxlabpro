<?php

namespace App\Http\Controllers;

use App\Models\CompanyDigitalAsset;
use Illuminate\Http\Request;

class CompanyDigitalAssetController extends Controller
{
    /**
     * Muestra todos los activos digitales de una empresa por cliente.
     */
    public function index($client_id)
    {
        return response()->json(CompanyDigitalAsset::where('client_id', $client_id)->get());
    }

    /**
     * Agrega un nuevo activo digital para la empresa.
     */
    public function store(Request $request)
    {
        $data = CompanyDigitalAsset::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'CompanyDigitalAsset record added successfully', 'data' => $data], 201);
    }

    /**
     * Muestra un activo digital específico.
     */
    public function show($id)
    {
        return response()->json(CompanyDigitalAsset::findOrFail($id));
    }

    /**
     * Actualiza un activo digital de la empresa.
     */
    public function update(Request $request, string $id)
    {
        $dataUpdate         = CompanyDigitalAsset::findOrFail($id);
        $name              	= $request->input('name');
        $value             	= $request->input('value');
        $dataUpdate->$name  = $value;

        $dataUpdate->update();

        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'CompanyDigitalAsset record updated successfully', 'data' => $dataUpdate]);
    }

    /**
     * Elimina un activo digital de la empresa.
     */
    public function destroy($id)
    {
        CompanyDigitalAsset::findOrFail($id)->delete();
        return response()->json(['message' => 'Company digital asset deleted successfully!']);
    }
}
