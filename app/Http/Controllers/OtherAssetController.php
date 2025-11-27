<?php

namespace App\Http\Controllers;

use App\Models\OtherAsset;
use App\Models\Client;
use Illuminate\Http\Request;

class OtherAssetController extends Controller
{
    public function index()
    {
        $assets = OtherAsset::with('client')->get();
        return view('assets.index', compact('assets'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('assets.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $data = OtherAsset::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'OtherAsset record added successfully', 'data' => $data], 201);
    }

    public function edit(OtherAsset $asset)
    {
        $clients = Client::all();
        return view('assets.edit', compact('asset', 'clients'));
    }

    public function update(Request $request, string $id)
    {
        
        $data           = OtherAsset::findOrFail($id);
        $name           = $request->input('name');
        $value          = $request->input('value');
        $data->$name    = $value;

        $data->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'OtherAsset record updated successfully', 'data' => $data]);
    }

    public function destroy(OtherAsset $asset)
    {
        $asset->delete();
        return redirect()->route('assets.index')->with('success', 'Asset information deleted successfully.');
    }
}
