<?php

namespace App\Http\Controllers;

use App\Models\MonthlyFinancial;
use Illuminate\Http\Request;

class MonthlyFinancialController extends Controller
{
    public function index()
    {
        $records = MonthlyFinancial::with('client')->latest()->get();
        return view('monthly_financials.index', compact('records'));
    }

    public function create()
    {
        return view('monthly_financials.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'period_start' => 'required|date',
            'period_end' => 'required|date',
            // ingresos
            'gross_receipts' => 'nullable|numeric',
            'gross_rental_income' => 'nullable|numeric',
            'interest' => 'nullable|numeric',
            'dividends' => 'nullable|numeric',
            'cash_receipts' => 'nullable|numeric',
            // egresos
            'materials_purchased' => 'nullable|numeric',
            'inventory_purchased' => 'nullable|numeric',
            'wages_salaries' => 'nullable|numeric',
            'rent' => 'nullable|numeric',
            'supplies' => 'nullable|numeric',
            'utilities' => 'nullable|numeric',
            'vehicle_gas_oil' => 'nullable|numeric',
            'repairs_maintenance' => 'nullable|numeric',
            'insurance' => 'nullable|numeric',
            'current_taxes' => 'nullable|numeric',
        ]);

        // calcular totales
        $total_income = collect($data)->only([
            'gross_receipts', 'gross_rental_income', 'interest', 'dividends', 'cash_receipts'
        ])->sum();

        $total_expense = collect($data)->only([
            'materials_purchased', 'inventory_purchased', 'wages_salaries', 'rent',
            'supplies', 'utilities', 'vehicle_gas_oil', 'repairs_maintenance',
            'insurance', 'current_taxes'
        ])->sum();

        $data['total_income'] = $total_income;
        $data['total_expense'] = $total_expense;
        $data['net_balance'] = $total_income - $total_expense;

        MonthlyFinancial::create($data);

        return redirect()->route('monthly-financials.index')->with('success', 'Registro guardado.');
    }



    public function update(Request $request, $id) {
       
        $data           = MonthlyFinancial::findOrFail($id);
        $name              = $request->input('name');
        $value             = $request->input('value');
        $data->$name    = $value;

        $data->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'MonthlyFinancial record updated successfully', 'data' => $data]);


    }
}
