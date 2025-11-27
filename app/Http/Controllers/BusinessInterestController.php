<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessInterest;
use App\Models\Client;

class BusinessInterestController extends Controller
{
    // Obtener los intereses comerciales de un cliente
    public function index($client_id)
    {
        $businessInterests = BusinessInterest::where('client_id', $client_id)->get();
        return response()->json($businessInterests);
    }

    // Guardar un nuevo interés comercial
    public function store(Request $request)
    {
        // $request->validate([
        //     'client_id' => 'required|exists:clients,id',
        //     'business_name' => 'required|string|max:255',
        //     'business_address' => 'nullable|string|max:255',
        //     'city_state_zip' => 'nullable|string|max:255',
        //     'phone' => 'nullable|string|max:20',
        //     'type' => 'nullable|string|max:255',
        //     'ownership' => 'nullable|numeric|min:0|max:100',
        //     'title' => 'nullable|string|max:255',
        //     'ein' => 'nullable|string|max:255',
        // ]);

        $businessInterest = BusinessInterest::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'Business record added successfully', 'data' => $businessInterest], 201);

        
    }

    // Actualizar un interés comercial
    public function update(Request $request, $id)
    {
        
        $businessInterest   		= BusinessInterest::findOrFail($id);
        $name               		= $request->input('name');
        $value              		= $request->input('value');
        $businessInterest->$name 	= $value;

        $businessInterest->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'Business Interest record updated successfully', 'data' => $businessInterest]);
    }

    // Eliminar un interés comercial
    public function destroy($id)
    {
        $businessInterest = BusinessInterest::findOrFail($id);
        $businessInterest->delete();

        return response()->json(['message' => 'Business interest deleted successfully!']);
    }
}
