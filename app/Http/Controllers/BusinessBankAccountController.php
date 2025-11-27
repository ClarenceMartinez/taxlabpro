<?php

namespace App\Http\Controllers;

use App\Models\BusinessBankAccount;
use Illuminate\Http\Request;

class BusinessBankAccountController extends Controller
{
    /**
     * Muestra todas las cuentas bancarias de un cliente.
     */
    public function index($client_id)
    {
        return response()->json(BusinessBankAccount::where('client_id', $client_id)->get());
    }

    /**
     * Agrega una nueva cuenta bancaria para el negocio.
     */
    public function store(Request $request)
    {
        $data = BusinessBankAccount::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'BusinessBankAccount record added successfully', 'data' => $data], 201);
    }

    /**
     * Muestra una cuenta bancaria específica.
     */
    public function show($id)
    {
        return response()->json(BusinessBankAccount::findOrFail($id));
    }

    /**
     * Actualiza una cuenta bancaria.
     */
    public function update(Request $request, string $id)
    {
        $dataUpdate         = BusinessBankAccount::findOrFail($id);
        $name              	= $request->input('name');
        $value             	= $request->input('value');
        $dataUpdate->$name  = $value;

        $dataUpdate->update();

        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'BusinessBankAccount record updated successfully', 'data' => $dataUpdate]);
    }

    /**
     * Elimina una cuenta bancaria.
     */
    public function destroy($id)
    {
        BusinessBankAccount::findOrFail($id)->delete();
        return response()->json(['message' => 'Business bank account deleted successfully!']);
    }
}
