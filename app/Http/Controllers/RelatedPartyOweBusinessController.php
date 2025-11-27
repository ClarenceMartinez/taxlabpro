<?php

namespace App\Http\Controllers;

use App\Models\RelatedPartyOweBusiness;
use App\Models\Client;
use Illuminate\Http\Request;

class RelatedPartyOweBusinessController extends Controller
{
    public function index()
    {
        // Podrías paginar, filtrar, etc.
        $relatedParties = RelatedPartyOweBusiness::with('client')->get();
        return view('related_parties_owe_business.index', compact('relatedParties'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('related_parties_owe_business.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id'       => 'required|exists:clients,id',
            'name'            => 'nullable|string|max:255',
            'address'         => 'nullable|string|max:255',
            'city_state_zip'  => 'nullable|string|max:255',
            'date_of_loan'    => 'nullable|date',
            'current_balance' => 'nullable|numeric',
            'as_of'           => 'nullable|date',
            'payment_date'    => 'nullable|date',
            'payment_amount'  => 'nullable|numeric',
        ]);

        RelatedPartyOweBusiness::create($request->all());

        return redirect()->route('related_parties_owe_business.index')
                         ->with('success', 'Related Party record creado con éxito.');
    }

    public function show(RelatedPartyOweBusiness $relatedPartyOweBusiness)
    {
        return view('related_parties_owe_business.show', compact('relatedPartyOweBusiness'));
    }

    public function edit(RelatedPartyOweBusiness $relatedPartyOweBusiness)
    {
        $clients = Client::all();
        return view('related_parties_owe_business.edit', compact('relatedPartyOweBusiness', 'clients'));
    }

    public function update(Request $request, string $id)
    {
        $dataUpdate         = RelatedPartyOweBusiness::findOrFail($id);
        $name               = $request->input('name');
        $value              = $request->input('value');
        $dataUpdate->$name  = $value;

        $dataUpdate->update();

        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'RelatedPartyOweBusiness record updated successfully', 'data' => $dataUpdate]);
    }

    public function destroy(RelatedPartyOweBusiness $relatedPartyOweBusiness)
    {
        $relatedPartyOweBusiness->delete();

        return redirect()->route('related_parties_owe_business.index')
                         ->with('success', 'Related Party record eliminado con éxito.');
    }
}
