<?php

namespace App\Http\Controllers;

use App\Models\CompanyToolEquipment;
use Illuminate\Http\Request;

class CompanyToolEquipmentController extends Controller
{
    /**
     * Muestra todas las herramientas y equipos de un cliente.
     */
    public function index($client_id)
    {
        return response()->json(CompanyToolEquipment::where('client_id', $client_id)->get());
    }

    /**
     * Agrega una nueva herramienta o equipo.
     */
    public function store(Request $request)
    {
        $data = CompanyToolEquipment::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'CompanyToolEquipment record added successfully', 'data' => $data], 201);
    }

    /**
     * Muestra una herramienta o equipo específico.
     */
    public function show($id)
    {
        return response()->json(CompanyToolEquipment::findOrFail($id));
    }

    /**
     * Actualiza una herramienta o equipo.
     */
    public function update(Request $request, string $id)
    {
        $dataUpdate         = CompanyToolEquipment::findOrFail($id);
        $name              	= $request->input('name');
        $value             	= $request->input('value');
        $dataUpdate->$name  = $value;

        $dataUpdate->update();

        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'CompanyToolEquipment record updated successfully', 'data' => $dataUpdate]);
    }

    /**
     * Elimina una herramienta o equipo.
     */
    public function destroy($id)
    {
        CompanyToolEquipment::findOrFail($id)->delete();
        return response()->json(['message' => 'Company tool/equipment deleted successfully!']);
    }
}
