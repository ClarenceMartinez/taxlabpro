<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    public function index()
    {
        $accounts = BankAccount::with('client')->get();
        return response()->json($accounts);
    }

    
    public function store(Request $request)
    {
        $bankruptcy = BankAccount::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'BankAccount record added successfully', 'data' => $bankruptcy], 201);
    }

    public function show($id)
    {
        $account = BankAccount::findOrFail($id);
        return response()->json($account);
    }

    public function update(Request $request, string $id)
    {
        $bankAccount           = BankAccount::findOrFail($id);
        $name                       = $request->input('name');
        $value                      = $request->input('value');
        $bankAccount->$name    = $value;

        $bankAccount->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'BankAccount record updated successfully', 'data' => $bankAccount]);
    }

    public function destroy($id)
    {
        BankAccount::findOrFail($id)->delete();
        return response()->json(['message' => 'Bank account deleted successfully']);
    }
}
