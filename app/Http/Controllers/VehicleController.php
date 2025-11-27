<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Client;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with('client')->get();
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('vehicles.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $data = Vehicle::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'Vehicle record added successfully', 'data' => $data], 201);
    }

    public function edit(Vehicle $vehicle)
    {
        $clients = Client::all();
        return view('vehicles.edit', compact('vehicle', 'clients'));
    }

    public function update(Request $request, string $id)
    {
        
        $data           = Vehicle::findOrFail($id);
        $name                       = $request->input('name');
        $value                      = $request->input('value');
        $data->$name    = $value;

        $data->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'Vehicle record updated successfully', 'data' => $data]);
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicles.index')->with('success', 'Vehicle information deleted successfully.');
    }
}
