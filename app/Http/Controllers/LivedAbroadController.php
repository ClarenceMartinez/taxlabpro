<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LivedAbroad;

class LivedAbroadController extends Controller
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
        $livedAbroad = LivedAbroad::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'LivedAbroad record added successfully', 'data' => $livedAbroad], 201);
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
        $livedAbroad           = LivedAbroad::findOrFail($id);
        $name              = $request->input('name');
        $value             = $request->input('value');
        $livedAbroad->$name    = $value;

        $livedAbroad->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'LivedAbroad record updated successfully', 'data' => $livedAbroad]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
