<?php

namespace App\Http\Controllers;

use App\Models\TaxpayerLawsuitIrs;
use App\Models\Client;
use Illuminate\Http\Request;

class TaxpayerLawsuitIrsController extends Controller
{
    public function index()
    {
        // Podrías paginar, filtrar, etc.
        $lawsuits = TaxpayerLawsuitIrs::with('client')->get();
        return view('taxpayer_lawsuits_irs.index', compact('lawsuits'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('taxpayer_lawsuits_irs.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id'              => 'required|exists:clients,id',
            'types_of_tax_and_periods' => 'nullable|string',
        ]);

        TaxpayerLawsuitIrs::create($request->all());

        return redirect()->route('taxpayer_lawsuits_irs.index')
                         ->with('success', 'Taxpayer Lawsuit (IRS) creado con éxito.');
    }

    public function show(TaxpayerLawsuitIrs $taxpayer_lawsuits_ir)
    {
        return view('taxpayer_lawsuits_irs.show', compact('taxpayer_lawsuits_ir'));
    }

    public function edit(TaxpayerLawsuitIrs $taxpayer_lawsuits_ir)
    {
        $clients = Client::all();
        return view('taxpayer_lawsuits_irs.edit', compact('taxpayer_lawsuits_ir', 'clients'));
    }

    public function update(Request $request, string $id)
    {
        $dataUpdate         = TaxpayerLawsuitIrs::findOrFail($id);
        $name               = $request->input('name');
        $value              = $request->input('value');
        $dataUpdate->$name  = $value;

        $dataUpdate->update();

        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'TaxpayerLawsuitIrs record updated successfully', 'data' => $dataUpdate]);
    }

    public function destroy(TaxpayerLawsuitIrs $taxpayer_lawsuits_ir)
    {
        $taxpayer_lawsuits_ir->delete();

        return redirect()->route('taxpayer_lawsuits_irs.index')
                         ->with('success', 'Taxpayer Lawsuit (IRS) eliminado con éxito.');
    }
}
