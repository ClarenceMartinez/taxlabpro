<?php

namespace App\Http\Controllers;

use App\Models\PayrollServiceProvider;
use App\Models\Client;
use Illuminate\Http\Request;

class PayrollServiceProviderController extends Controller
{
    public function index()
    {
        // Podrías paginar, filtrar, etc.
        $providers = PayrollServiceProvider::with('client')->get();
        return view('payroll_service_providers.index', compact('providers'));
    }

    public function create()
    {
        // Para un select de clientes, si aplica
        $clients = Client::all();
        return view('payroll_service_providers.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id'      => 'required|exists:clients,id',
            'provider_name'  => 'nullable|string|max:255',
            'address'        => 'nullable|string|max:255',
            'city_state_zip' => 'nullable|string|max:255',
            'effective_date' => 'nullable|date',
        ]);

        PayrollServiceProvider::create($request->all());

        return redirect()->route('payroll_service_providers.index')
                         ->with('success', 'Payroll Service Provider creado con éxito.');
    }

    public function show(PayrollServiceProvider $payroll_service_provider)
    {
        return view('payroll_service_providers.show', compact('payroll_service_provider'));
    }

    public function edit(PayrollServiceProvider $payroll_service_provider)
    {
        $clients = Client::all();
        return view('payroll_service_providers.edit', compact('payroll_service_provider', 'clients'));
    }

    public function update(Request $request, string $id)
    {
        $dataUpdate         = PayrollServiceProvider::findOrFail($id);
        $name               = $request->input('name');
        $value              = $request->input('value');
        $dataUpdate->$name  = $value;

        $dataUpdate->update();

        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'PayrollServiceProvider record updated successfully', 'data' => $dataUpdate]);
    }

    public function destroy(PayrollServiceProvider $payroll_service_provider)
    {
        $payroll_service_provider->delete();

        return redirect()->route('payroll_service_providers.index')
                         ->with('success', 'Payroll Service Provider eliminado con éxito.');
    }
}
