<?php

namespace App\Http\Controllers;

use App\Models\Console;
use Illuminate\Http\Request;

class ConsoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // echo "string";
        $data['title'] = 'Welcome | Plataform TaxlabPro';
        return view('login.login', $data);
    }

    public function login()
    {
        //
        // echo "string";
        $data['title'] = 'Welcome | Plataform TaxlabPro';
        return view('login.login', $data);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Console $Console)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Console $Console)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Console $Console)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Console $Console)
    {
        //
    }
}
