<?php

namespace App\Http\Controllers;

use App\Models\CreditAccount;
use Illuminate\Http\Request;

class CreditAccountController extends Controller
{
    public function index()
    {
        $accounts = CreditAccount::with('client')->get();
        return response()->json($accounts);
    }

    public function store(Request $request)
    {
        $data = CreditAccount::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'CreditAccount record added successfully', 'data' => $data], 201);
    }

    public function show($id)
    {
        $account = CreditAccount::findOrFail($id);
        return response()->json($account);
    }

    public function update(Request $request, string $id)
    {
        $data           = CreditAccount::findOrFail($id);
        $name                       = $request->input('name');
        $value                      = $request->input('value');
        $data->$name    = $value;

        $data->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'CreditAccount record updated successfully', 'data' => $data]);
    }

    public function destroy($id)
    {
        CreditAccount::findOrFail($id)->delete();
        return response()->json(['message' => 'Credit account deleted successfully']);
    }
}
