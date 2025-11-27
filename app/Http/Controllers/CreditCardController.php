<?php

namespace App\Http\Controllers;

use App\Models\CreditCard;
use App\Models\Client;
use Illuminate\Http\Request;

class CreditCardController extends Controller
{
    /**
     * Muestra las tarjetas de un cliente.
     */
    public function index($client_id)
    {
        $client = Client::with('creditCards')->findOrFail($client_id);
        return response()->json($client->creditCards);
    }

    /**
     * Agrega una nueva tarjeta de crédito.
     */
    public function store(Request $request)
    {
        $data = CreditCard::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'CreditCard record added successfully', 'data' => $data], 201);
    }

    /**
     * Muestra una tarjeta de crédito específica.
     */
    public function show($id)
    {
        $creditCard = CreditCard::findOrFail($id);
        return response()->json($creditCard);
    }

    /**
     * Actualiza una tarjeta de crédito.
     */
    public function update(Request $request, string $id)
    {
        $dataUpdate         = CreditCard::findOrFail($id);
        $name              	= $request->input('name');
        $value             	= $request->input('value');
        $dataUpdate->$name  = $value;

        $dataUpdate->update();

        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'CreditCard record updated successfully', 'data' => $dataUpdate]);
    }

    /**
     * Elimina una tarjeta de crédito.
     */
    public function destroy($id)
    {
        $creditCard = CreditCard::findOrFail($id);
        $creditCard->delete();

        return response()->json(['message' => 'Credit card deleted successfully!']);
    }
}
