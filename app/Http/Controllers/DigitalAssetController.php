<?php

namespace App\Http\Controllers;

use App\Models\DigitalAsset;
use Illuminate\Http\Request;

class DigitalAssetController extends Controller
{
    public function index()
    {
        $assets = DigitalAsset::with('client')->get();
        return response()->json($assets);
    }

    
    public function store(Request $request)
    {
        $data = DigitalAsset::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'DigitalAsset record added successfully', 'data' => $data], 201);
    }

    public function show($id)
    {
        $asset = DigitalAsset::findOrFail($id);
        return response()->json($asset);
    }

    public function update(Request $request, string $id)
    {
        $data           = DigitalAsset::findOrFail($id);
        $name                       = $request->input('name');
        $value                      = $request->input('value');
        $data->$name    = $value;

        $data->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'DigitalAsset record updated successfully', 'data' => $data]);
    }

    public function destroy($id)
    {
        DigitalAsset::findOrFail($id)->delete();
        return response()->json(['message' => 'Digital asset deleted successfully']);
    }
}
