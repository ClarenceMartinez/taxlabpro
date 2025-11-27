<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssetAbroad;

class AssetAbroadController extends Controller
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
        $assetAbroad = AssetAbroad::create([
            'client_id' => $request->client_id
        ]);

        $assetAbroad = AssetAbroad::latest('id')->first();


        return response()->json(['status'=> true, 'message' => 'AssetAbroad added successfully', 'data' => $assetAbroad], 201);
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
        $assetAbroad           = AssetAbroad::findOrFail($id);
        $name                       = $request->input('name');
        $value                      = $request->input('value');
        $assetAbroad->$name    = $value;

        $assetAbroad->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'AssetAbroad record updated successfully', 'data' => $assetAbroad]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
