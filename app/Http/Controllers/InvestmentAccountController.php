<?php

namespace App\Http\Controllers;

use App\Models\InvestmentAccount;
use Illuminate\Http\Request;

class InvestmentAccountController extends Controller
{
    public function index()
    {
        $accounts = InvestmentAccount::with('client')->get();
        return response()->json($accounts);
    }

    

    public function store(Request $request)
    {
        $data = InvestmentAccount::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'InvestmentAccount record added successfully', 'data' => $data], 201);
    }




    public function show($id)
    {
        $account = InvestmentAccount::findOrFail($id);
        return response()->json($account);
    }

    public function update(Request $request, string $id)
    {
        $data           = InvestmentAccount::findOrFail($id);
        $name                       = $request->input('name');
        $value                      = $request->input('value');
        $data->$name    = $value;

        $data->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'InvestmentAccount record updated successfully', 'data' => $data]);
    }

    public function destroy($id)
    {
        InvestmentAccount::findOrFail($id)->delete();
        return response()->json(['message' => 'Investment account deleted successfully']);
    }
}
