<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Client;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::with('client')->get();
        return view('properties.index', compact('properties'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('properties.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $data = Property::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'Property record added successfully', 'data' => $data], 201);
    }
    public function edit(Property $property)
    {
        $clients = Client::all();
        return view('properties.edit', compact('property', 'clients'));
    }

    public function update(Request $request, string $id)
    {
        
        $data           = Property::findOrFail($id);
        $name                       = $request->input('name');
        $value                      = $request->input('value');
        $data->$name    = $value;

        $data->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'Property record updated successfully', 'data' => $data]);
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('properties.index')->with('success', 'Property deleted successfully.');
    }
}
