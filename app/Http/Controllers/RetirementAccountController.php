<?php

namespace App\Http\Controllers;

use App\Models\RetirementAccount;
use Illuminate\Http\Request;

class RetirementAccountController extends Controller
{
    public function index()
    {
        $accounts = RetirementAccount::with('client')->get();
        return response()->json($accounts);
    }

   
    public function store(Request $request)
    {
        $data = RetirementAccount::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'RetirementAccount record added successfully', 'data' => $data], 201);
    }


    public function show($id)
    {
        $account = RetirementAccount::findOrFail($id);
        return response()->json($account);
    }

    public function update(Request $request, string $id)
    {
        $data           = RetirementAccount::findOrFail($id);
        $name                       = $request->input('name');
        $value                      = $request->input('value');
        $data->$name    = $value;

        $data->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'RetirementAccount record updated successfully', 'data' => $data]);
    }

    public function destroy($id)
    {
        RetirementAccount::findOrFail($id)->delete();
        return response()->json(['message' => 'Retirement account deleted successfully']);
    }
}
