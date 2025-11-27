<?php

namespace App\Http\Controllers;

use App\Models\CompanyAccountReceivable;
use Illuminate\Http\Request;

class CompanyAccountReceivableController extends Controller
{
    /**
     * Muestra todas las cuentas por cobrar de un cliente.
     */
    public function index($client_id)
    {
        return response()->json(CompanyAccountReceivable::where('client_id', $client_id)->get());
    }

    /**
     * Agrega una nueva cuenta por cobrar.
     */
    public function store(Request $request)
    {
        $data = CompanyAccountReceivable::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'CompanyAccountReceivable record added successfully', 'data' => $data], 201);
    }

    /**
     * Muestra una cuenta por cobrar específica.
     */
    public function show($id)
    {
        return response()->json(CompanyAccountReceivable::findOrFail($id));
    }

    /**
     * Actualiza una cuenta por cobrar.
     */
    public function update(Request $request, string $id)
    {
        $dataUpdate         = CompanyAccountReceivable::findOrFail($id);
        $name              	= $request->input('name');
        $value             	= $request->input('value');
        $dataUpdate->$name  = $value;

        $dataUpdate->update();

        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'CompanyAccountReceivable record updated successfully', 'data' => $dataUpdate]);
    }

    /**
     * Elimina una cuenta por cobrar.
     */
    public function destroy($id)
    {
        CompanyAccountReceivable::findOrFail($id)->delete();
        return response()->json(['message' => 'Company account receivable deleted successfully!']);
    }
}
