<?php

namespace App\Http\Controllers;

use App\Models\EcommerceProcessor;
use App\Models\Client;
use Illuminate\Http\Request;

class EcommerceProcessorController extends Controller
{
    /**
     * Lista todos los registros.
     */
    public function index()
    {
        // Puedes paginar, filtrar, etc.
        $processors = EcommerceProcessor::with('client')->get();
        return view('ecommerce_processors.index', compact('processors'));
    }

    /**
     * Muestra el formulario de creación.
     */
    public function create()
    {
        $clients = Client::all();
        return view('ecommerce_processors.create', compact('clients'));
    }

    /**
     * Almacena un nuevo registro.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id'       => 'required|exists:clients,id',
            'processor_name'  => 'nullable|string|max:255',
            'account_number'  => 'nullable|string|max:255',
            'street_address'  => 'nullable|string|max:255',
            'city_state_zip'  => 'nullable|string|max:255',
        ]);

        EcommerceProcessor::create($request->all());

        return redirect()->route('ecommerce_processors.index')
                         ->with('success', 'E-commerce Processor creado con éxito.');
    }

    /**
     * Muestra un registro específico.
     */
    public function show(EcommerceProcessor $ecommerceProcessor)
    {
        return view('ecommerce_processors.show', compact('ecommerceProcessor'));
    }

    /**
     * Muestra el formulario de edición.
     */
    public function edit(EcommerceProcessor $ecommerceProcessor)
    {
        $clients = Client::all();
        return view('ecommerce_processors.edit', compact('ecommerceProcessor', 'clients'));
    }

    /**
     * Actualiza un registro.
     */
    public function update(Request $request, string $id)
    {
        $data           = EcommerceProcessor::findOrFail($id);
            
        $name                       = $request->input('name');
        $value                      = $request->input('value');
        $data->$name    = $value;

        $data->update();

        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'EcommerceProcessor record updated successfully', 'data' => $data]);
    }


    /**
     * Elimina un registro.
     */
    public function destroy(EcommerceProcessor $ecommerceProcessor)
    {
        $ecommerceProcessor->delete();

        return redirect()->route('ecommerce_processors.index')
                         ->with('success', 'E-commerce Processor eliminado con éxito.');
    }
}
