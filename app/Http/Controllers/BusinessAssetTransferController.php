<?php

namespace App\Http\Controllers;

use App\Models\BusinessAssetTransfer;
use App\Models\Client;
use Illuminate\Http\Request;

class BusinessAssetTransferController extends Controller
{
    public function index()
    {
        $transfers = BusinessAssetTransfer::with('client')->get();
        return view('business_asset_transfers.index', compact('transfers'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('business_asset_transfers.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id'                  => 'required|exists:clients,id',
            'asset'                      => 'nullable|string|max:255',
            'date_transferred'           => 'nullable|date',
            'value_at_time_of_transfer'  => 'nullable|numeric',
            'where_transferred'          => 'nullable|string|max:255',
        ]);

        BusinessAssetTransfer::create($request->all());

        return redirect()->route('business_asset_transfers.index')
                         ->with('success', 'Business Asset Transfer creado con éxito.');
    }

    public function show(BusinessAssetTransfer $business_asset_transfer)
    {
        return view('business_asset_transfers.show', compact('business_asset_transfer'));
    }

    public function edit(BusinessAssetTransfer $business_asset_transfer)
    {
        $clients = Client::all();
        return view('business_asset_transfers.edit', compact('business_asset_transfer', 'clients'));
    }

    public function update(Request $request, string $id)
    {
        $dataUpdate         = BusinessAssetTransfer::findOrFail($id);
        $name               = $request->input('name');
        $value              = $request->input('value');
        $dataUpdate->$name  = $value;

        $dataUpdate->update();

        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'BusinessAssetTransfer record updated successfully', 'data' => $dataUpdate]);
    }

    public function destroy(BusinessAssetTransfer $business_asset_transfer)
    {
        $business_asset_transfer->delete();

        return redirect()->route('business_asset_transfers.index')
                         ->with('success', 'Business Asset Transfer eliminado con éxito.');
    }
}
