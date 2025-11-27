<?php

namespace App\Http\Controllers;

use App\Models\LifeInsurance;
use Illuminate\Http\Request;

class LifeInsuranceController extends Controller
{
    public function index()
    {
        $insurances = LifeInsurance::with('client')->get();
        return response()->json($insurances);
    }

    public function store(Request $request)
    {
        $data = LifeInsurance::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'LifeInsurance record added successfully', 'data' => $data], 201);
    }

    public function show($id)
    {
        $insurance = LifeInsurance::findOrFail($id);
        return response()->json($insurance);
    }

    public function update(Request $request, string $id)
    {
        $data           = LifeInsurance::findOrFail($id);
        $name                       = $request->input('name');
        $value                      = $request->input('value');
        $data->$name    = $value;

        $data->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'LifeInsurance record updated successfully', 'data' => $data]);
    }

    public function destroy($id)
    {
        LifeInsurance::findOrFail($id)->delete();
        return response()->json(['message' => 'Life insurance deleted successfully']);
    }
}
