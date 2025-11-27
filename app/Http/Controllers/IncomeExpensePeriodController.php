<?php

namespace App\Http\Controllers;

use App\Models\IncomeExpensePeriod;
use Illuminate\Http\Request;

class IncomeExpensePeriodController extends Controller
{
    /**
     * Muestra todos los períodos de ingresos/gastos de un cliente.
     */
    public function index($client_id)
    {
        return response()->json(IncomeExpensePeriod::where('client_id', $client_id)->get());
    }

    /**
     * Agrega un nuevo período de ingresos/gastos.
     */
    public function store(Request $request)
    {
        $data = IncomeExpensePeriod::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'IncomeExpensePeriod record added successfully', 'data' => $data], 201);
    }

    /**
     * Muestra un período de ingresos/gastos específico.
     */
    public function show($id)
    {
        return response()->json(IncomeExpensePeriod::findOrFail($id));
    }

    /**
     * Actualiza un período de ingresos/gastos.
     */
    public function update(Request $request, string $id)
    {
        $dataUpdate         = IncomeExpensePeriod::findOrFail($id);
        $name              	= $request->input('name');
        $value             	= $request->input('value');
        $dataUpdate->$name  = $value;

        $dataUpdate->update();

        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'IncomeExpensePeriod record updated successfully', 'data' => $dataUpdate]);
    }

    /**
     * Elimina un período de ingresos/gastos.
     */
    public function destroy($id)
    {
        IncomeExpensePeriod::findOrFail($id)->delete();
        return response()->json(['message' => 'Income/expense period deleted successfully!']);
    }
}
