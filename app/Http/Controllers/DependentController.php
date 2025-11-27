<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dependent;

class DependentController extends Controller
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

    
    public function store(Request $request)
    {
        $dependent = Dependent::create([
            'client_id' => $request->client_id
        ]);

        $dependent = Dependent::latest('id')->first();


        return response()->json(['status'=> true, 'message' => 'Dependent added successfully', 'data' => $dependent], 201);
    }

    public function update(Request $request, $id)
    {
        $dependent = Dependent::findOrFail($id);


        $name = $request->input('name');
        $value = $request->input('value');
        $dependent->$name = $value;

        $dependent->update();

        return response()->json(['message' => 'Dependent updated successfully', 'data' => $dependent]);
    }

    public function destroy($id)
    {
        Dependent::destroy($id);
        return response()->json(['message' => 'Dependent deleted successfully']);
    }
}
