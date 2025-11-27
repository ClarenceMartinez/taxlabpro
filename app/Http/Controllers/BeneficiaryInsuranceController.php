<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BeneficiaryInsurance;


class BeneficiaryInsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $beneficiaryInsurance = BeneficiaryInsurance::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'Beneficiary Insurance record added successfully', 'data' => $beneficiaryInsurance], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $beneficiaryInsurance           = BeneficiaryInsurance::findOrFail($id);
        $name                           = $request->input('name');
        $value                          = $request->input('value');
        $beneficiaryInsurance->$name    = $value;

        $beneficiaryInsurance->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'Beneficiary Insurance Interest record updated successfully', 'data' => $beneficiaryInsurance]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
