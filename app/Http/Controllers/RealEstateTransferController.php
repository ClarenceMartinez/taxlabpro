<?php

namespace App\Http\Controllers;

use App\Models\RealEstateTransfer;
use App\Models\Client;
use Illuminate\Http\Request;

class RealEstateTransferController extends Controller
{
    public function index()
    {
        $transfers = RealEstateTransfer::with('client')->get();
        return view('real_estate_transfers.index', compact('transfers'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('real_estate_transfers.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $data = RealEstateTransfer::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'RealEstateTransfer record added successfully', 'data' => $data], 201);
    }

    public function edit(RealEstateTransfer $realEstateTransfer)
    {
        $clients = Client::all();
        return view('real_estate_transfers.edit', compact('realEstateTransfer', 'clients'));
    }

    public function update(Request $request, string $id)
    {
        $data           = RealEstateTransfer::findOrFail($id);
        $name                       = $request->input('name');
        $value                      = $request->input('value');
        $data->$name    = $value;

        $data->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'RealEstateTransfer record updated successfully', 'data' => $data]);
    }

    public function destroy(RealEstateTransfer $realEstateTransfer)
    {
        $realEstateTransfer->delete();
        return redirect()->route('real_estate_transfers.index')->with('success', 'Transfer deleted successfully.');
    }
}
