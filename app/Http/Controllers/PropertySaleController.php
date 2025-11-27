<?php

namespace App\Http\Controllers;

use App\Models\PropertySale;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertySaleController extends Controller
{
    public function index()
    {
        $propertySales = PropertySale::with('property')->get();
        return view('property_sales.index', compact('propertySales'));
    }

    public function create()
    {
        $properties = Property::all();
        return view('property_sales.create', compact('properties'));
    }

    public function store(Request $request)
    {
        $data = PropertySale::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'PropertySale record added successfully', 'data' => $data], 201);
    }

    public function edit(PropertySale $propertySale)
    {
        $properties = Property::all();
        return view('property_sales.edit', compact('propertySale', 'properties'));
    }

    public function update(Request $request, string $id)
    {
        
        $data           = PropertySale::findOrFail($id);
        $name                       = $request->input('name');
        $value                      = $request->input('value');
        $data->$name    = $value;

        $data->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'PropertySale record updated successfully', 'data' => $data]);
    }

    public function destroy(PropertySale $propertySale)
    {
        $propertySale->delete();
        return redirect()->route('property_sales.index')->with('success', 'Property sale information deleted successfully.');
    }
}
