<?php

namespace App\Http\Controllers;

use App\Models\SafeDepositBox;
use Illuminate\Http\Request;


class SafeDepositBoxController extends Controller
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
        $safeDepositBox = SafeDepositBox::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'SafeDepositBox record added successfully', 'data' => $safeDepositBox], 201);
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
        $safeDepositBox           = SafeDepositBox::findOrFail($id);
        $name              = $request->input('name');
        $value             = $request->input('value');
        $safeDepositBox->$name    = $value;

        $safeDepositBox->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'SafeDepositBox record updated successfully', 'data' => $safeDepositBox]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
