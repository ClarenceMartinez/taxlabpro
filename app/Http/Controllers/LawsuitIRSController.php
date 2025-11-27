<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LawsuitIRS;

class LawsuitIRSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $lawsuits = LawsuitIRS::all();
        return response()->json($lawsuits);
    }

    public function store(Request $request) {
        
        $lawsuit = LawsuitIRS::create([
            'client_id' => $request->client_id
        ]);

        return response()->json(['status'=> true, 'msg' => 'Lawsuit record added successfully', 'data' => $lawsuit], 201);
    }

    public function show($id) {
        $lawsuit = LawsuitIRS::findOrFail($id);
        return response()->json($lawsuit);
    }

    public function update(Request $request, $id) {
       
        $lawsuit           = LawsuitIRS::findOrFail($id);
        $name              = $request->input('name');
        $value             = $request->input('value');
        $lawsuit->$name    = $value;

        $lawsuit->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'Lawsuit record updated successfully', 'data' => $lawsuit]);


    }

    public function destroy($id) {
        $lawsuit = LawsuitIRS::findOrFail($id);
        $lawsuit->delete();
        return response()->json(['message' => 'Lawsuit deleted successfully']);
    }
}
