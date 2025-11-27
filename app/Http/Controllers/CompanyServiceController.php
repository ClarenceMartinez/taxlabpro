<?php

namespace App\Http\Controllers;

use App\Models\CompanyService;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ejemplo: mostrar todos los servicios con su compañía
        $services = CompanyService::with('company')->get();
        return view('companyServices.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retorna una vista con un formulario para crear
        // Podrías cargar la lista de compañías si el usuario elige a cuál asociar
        $companies = Company::all();
        return view('companyServices.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida los datos
        $request->validate([
            'company_id'   => 'required|exists:companies,id',
            'service_name' => 'required|string|max:255',
            'description'  => 'nullable|string',
        ]);

        // Crea el servicio
        $companyService = CompanyService::create($request->all());

        return redirect()->route('companyServices.show', $companyService)
                         ->with('success', 'Servicio creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyService $companyService)
    {
        return view('companyServices.show', compact('companyService'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyService $companyService)
    {
        $companies = Company::all();
        return view('companyServices.edit', compact('companyService', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompanyService $companyService)
    {
        // Valida los datos
        $request->validate([
            'service_name' => 'required|string|max:255',
            'description'  => 'nullable|string',
        ]);

        // Actualiza
        $companyService->update($request->all());

        return redirect()->route('companyServices.show', $companyService)
                         ->with('success', 'Servicio actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyService $companyService)
    {
        $companyService->delete();

        return redirect()->route('companyServices.index')
                         ->with('success', 'Servicio eliminado.');
    }
}
