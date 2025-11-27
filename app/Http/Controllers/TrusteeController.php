<?php

namespace App\Http\Controllers;

use App\Models\Trustee;
use Illuminate\Http\Request;

class TrusteeController extends Controller
{
    public function index()
    {
        return response()->json(Trustee::all());
    }

    public function store(Request $request)
    {
        $trustee = Trustee::create([
            'client_id' => $request->client_id
        ]);

        $trustee = Trustee::latest('id')->first();


        return response()->json(['status'=> true, 'message' => 'Trustee added successfully', 'data' => $trustee], 201);
    }

    public function show(Trustee $trustee)
    {
        return response()->json($trustee);
    }

    public function update(Request $request, string $id)
    {
        $trustee           = Trustee::findOrFail($id);
        $name                       = $request->input('name');
        $value                      = $request->input('value');
        $trustee->$name    = $value;

        $trustee->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'Trustee record updated successfully', 'data' => $trustee]);
    }

    public function destroy(Trustee $trustee)
    {
        $trustee->delete();

        return response()->json(null, 204);
    }
}
