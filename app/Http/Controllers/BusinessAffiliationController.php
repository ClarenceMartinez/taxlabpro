<?php

namespace App\Http\Controllers;

use App\Models\BusinessAffiliation;
use App\Models\Client;
use Illuminate\Http\Request;

class BusinessAffiliationController extends Controller
{
    public function index()
    {
        // Puedes paginar, filtrar, etc.
        $affiliations = BusinessAffiliation::with('client')->get();
        return view('business_affiliations.index', compact('affiliations'));
    }

    public function create()
    {
        // Para un select de clientes, si aplica
        $clients = Client::all();
        return view('business_affiliations.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id'       => 'required|exists:clients,id',
            'business_name'   => 'nullable|string|max:255',
            'street_address'  => 'nullable|string|max:255',
            'city_state_zip'  => 'nullable|string|max:255',
            'ein'             => 'nullable|string|max:255',
        ]);

        BusinessAffiliation::create($request->all());

        return redirect()->route('business_affiliations.index')
                         ->with('success', 'Business Affiliation creada con éxito.');
    }

    public function show(BusinessAffiliation $business_affiliation)
    {
        return view('business_affiliations.show', compact('business_affiliation'));
    }

    public function edit(BusinessAffiliation $business_affiliation)
    {
        $clients = Client::all();
        return view('business_affiliations.edit', compact('business_affiliation', 'clients'));
    }

    public function update(Request $request, string $id)
    {
        $data           = BusinessAffiliation::findOrFail($id);
        $name                       = $request->input('name');
        $value                      = $request->input('value');
        $data->$name    = $value;

        $data->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'BusinessAffiliation record updated successfully', 'data' => $data]);
    }

    public function destroy(BusinessAffiliation $business_affiliation)
    {
        $business_affiliation->delete();

        return redirect()->route('business_affiliations.index')
                         ->with('success', 'Business Affiliation eliminada con éxito.');
    }
}
