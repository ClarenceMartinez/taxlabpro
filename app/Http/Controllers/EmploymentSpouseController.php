<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmploymentSpouse;

class EmploymentSpouseController extends Controller
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
        $employment = EmploymentSpouse::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'Employment record added successfully', 'data' => $employment], 201);
    }

    public function update(Request $request, $id)
    {

        $employment         = EmploymentSpouse::findOrFail($id);
        $name               = $request->input('name');
        $value              = $request->input('value');
        $employment->$name = $value;

        $employment->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'Employment record updated successfully', 'data' => $employment]);
    }

    public function destroy($id)
    {
        EmploymentSpouse::destroy($id);
        return response()->json(['message' => 'Employment record deleted successfully']);
    }
}
