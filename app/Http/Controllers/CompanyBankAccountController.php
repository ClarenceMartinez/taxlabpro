<?php

namespace App\Http\Controllers;

use App\Models\CompanyBankAccount;
use Illuminate\Http\Request;

class CompanyBankAccountController extends Controller
{
    /**
     * Muestra todas las cuentas bancarias de una empresa por cliente.
     */
    public function index($client_id)
    {
        return response()->json(CompanyBankAccount::where('client_id', $client_id)->get());
    }

    /**
     * Agrega una nueva cuenta bancaria para la empresa.
     */
    public function store(Request $request)
    {
        $data = CompanyBankAccount::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'CompanyBankAccount record added successfully', 'data' => $data], 201);
    }


    /**
     * Muestra una cuenta bancaria específica.
     */
    public function show($id)
    {
        return response()->json(CompanyBankAccount::findOrFail($id));
    }

    /**
     * Actualiza una cuenta bancaria de la empresa.
     */
    public function update(Request $request, string $id)
    {
        $dataUpdate         = CompanyBankAccount::findOrFail($id);
        $name              	= $request->input('name');
        $value             	= $request->input('value');
        $dataUpdate->$name  = $value;

        $dataUpdate->update();

        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'CompanyBankAccount record updated successfully', 'data' => $dataUpdate]);
    }

    /**
     * Elimina una cuenta bancaria de la empresa.
     */
    public function destroy($id)
    {
        CompanyBankAccount::findOrFail($id)->delete();
        return response()->json(['message' => 'Company bank account deleted successfully!']);
    }
}
