<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrustFund;

class TrustFundController extends Controller
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
        $trustFund = TrustFund::create([
            'client_id' => $request->client_id
        ]);

        $trustFund = TrustFund::latest('id')->first();


        return response()->json(['status'=> true, 'message' => 'TrustFund added successfully', 'data' => $trustFund], 201);
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
        
        $trustFund           = TrustFund::findOrFail($id);
        $name                       = $request->input('name');
        $value                      = $request->input('value');
        $trustFund->$name    = $value;

        $trustFund->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'TrustFund record updated successfully', 'data' => $trustFund]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
