<?php

namespace App\Http\Controllers;

use App\Models\TypeResidence;
use App\Models\Client;
use Illuminate\Http\Request;

class TypeResidenceController extends Controller
{
    public function index()
    {
        $residences = TypeResidence::with('client')->get();
        return view('residences.index', compact('residences'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('residences.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'status' => 'required|in:own,rent,other',
            'monthly_rent' => 'nullable|numeric',
            'other_description' => 'nullable|string|max:255',
        ]);

        TypeResidence::create($request->all());
        return redirect()->route('residences.index')->with('success', 'Residence information saved successfully.');
    }

    public function edit(TypeResidence $residence)
    {
        $clients = Client::all();
        return view('residences.edit', compact('residence', 'clients'));
    }

    public function update(Request $request, string $id)
    {
        
        $data           = TypeResidence::findOrFail($id);
        $name                       = $request->input('name');
        $value                      = $request->input('value');
        $data->$name    = $value;

        $data->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'TypeResidence record updated successfully', 'data' => $data]);
    }

    public function destroy(TypeResidence $residence)
    {
        $residence->delete();
        return redirect()->route('residences.index')->with('success', 'Residence deleted successfully.');
    }
}
