<?php

namespace App\Http\Controllers;

use App\Models\AssetTransfer;
use Illuminate\Http\Request;

class AssetTransferController extends Controller
{
    public function index()
    {
        $transfers = AssetTransfer::all();
        return view('asset_transfers.index', compact('transfers'));
    }

    public function create()
    {
        return view('asset_transfers.create');
    }

    public function store(Request $request)
    {
        $data = AssetTransfer::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'AssetTransfer record added successfully', 'data' => $data], 201);
    }

    public function edit(AssetTransfer $assetTransfer)
    {
        return view('asset_transfers.edit', compact('assetTransfer'));
    }

    public function update(Request $request, string $id)
    {
        $data           = AssetTransfer::findOrFail($id);
        $name                       = $request->input('name');
        $value                      = $request->input('value');
        $data->$name    = $value;

        $data->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'AssetTransfer record updated successfully', 'data' => $data]);
    }

    public function destroy(AssetTransfer $assetTransfer)
    {
        $assetTransfer->delete();
        return redirect()->route('asset_transfers.index')->with('success', 'Asset transfer deleted successfully.');
    }
}
