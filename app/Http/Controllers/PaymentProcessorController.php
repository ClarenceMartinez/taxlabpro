<?php

namespace App\Http\Controllers;

use App\Models\PaymentProcessor;
use App\Models\Client;
use Illuminate\Http\Request;

class PaymentProcessorController extends Controller
{
    /**
     * Muestra la lista de procesadores de pago de un cliente.
     */
    public function index($client_id)
    {
        $client = Client::with('paymentProcessors')->findOrFail($client_id);
        return response()->json($client->paymentProcessors);
    }

    /**
     * Almacena un nuevo procesador de pago.
     */
    public function store(Request $request)
    {
        $data = PaymentProcessor::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'PaymentProcessor record added successfully', 'data' => $data], 201);
    }

    /**
     * Muestra un procesador de pago específico.
     */
    public function show($id)
    {
        $processor = PaymentProcessor::findOrFail($id);
        return response()->json($processor);
    }

    /**
     * Actualiza un procesador de pago.
     */
    public function update(Request $request, string $id)
    {
        $dataUpdate         = PaymentProcessor::findOrFail($id);
        $name              	= $request->input('name');
        $value             	= $request->input('value');
        $dataUpdate->$name  = $value;

        $dataUpdate->update();

        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'PaymentProcessor record updated successfully', 'data' => $dataUpdate]);
    }

    /**
     * Elimina un procesador de pago.
     */
    public function destroy($id)
    {
        $processor = PaymentProcessor::findOrFail($id);
        $processor->delete();

        return response()->json(['message' => 'Payment processor deleted successfully!']);
    }
}
