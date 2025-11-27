<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bankruptcy;


class BankruptcyController extends Controller
{
    public function index()
    {
        return response()->json(Bankruptcy::all());
    }

    public function store(Request $request)
    {
        $bankruptcy = Bankruptcy::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'Bankruptcy record added successfully', 'data' => $bankruptcy], 201);
    }

    public function show(Bankruptcy $bankruptcy)
    {
        return response()->json($bankruptcy);
    }

   

    public function update(Request $request, $id)
    {
        
        $bankruptcy           = Bankruptcy::findOrFail($id);
        $name                       = $request->input('name');
        $value                      = $request->input('value');
        $bankruptcy->$name    = $value;

        $bankruptcy->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'Bankruptcy record updated successfully', 'data' => $bankruptcy]);
    }

    public function destroy(Bankruptcy $bankruptcy)
    {
        $bankruptcy->delete();

        return response()->json(null, 204);
    }
}
