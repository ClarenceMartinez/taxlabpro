<?php

namespace App\Http\Controllers;

use App\Models\ClientService;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientServiceController extends Controller
{
    public function index($id)
    {
        // $services = ClientService::with('client')->get();
        $services = DB::table('company_services as cs')
            ->select('cs.id', 'cs.service_name')
            ->selectRaw(
                "CASE WHEN EXISTS (
                    SELECT 1 
                    FROM client_services 
                    WHERE client_services.service_id = cs.id 
                      AND client_services.client_id = ?
                    LIMIT 1
                ) THEN 1 ELSE 0 END AS activo", 
                [$id]
            )
            ->where('cs.company_id', Auth::user()->company_id)
            ->orderBy('cs.id', 'asc')
            ->get();

        return response()->json([
                'status'    => true,
                'msg'       => 'information List correctly',
                'type'      => 'success',
                'title'     =>'Perfect!',
                'data'      => $services
            ]);

    }

    public function create()
    {
        // Para crear un servicio, puedes pasar la lista de clientes
        $clients = Client::all();
        return view('clientServices.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id'    => 'required|exists:clients,id',
            'service_name' => 'required|string|max:255',
            'description'  => 'nullable|string',
            'price'        => 'nullable|numeric',
        ]);

        ClientService::create($request->all());

        return redirect()->route('clientServices.index')
                         ->with('success', 'Servicio creado exitosamente.');
    }

    public function show(ClientService $clientService)
    {
        return view('clientServices.show', compact('clientService'));
    }

    public function edit(ClientService $clientService)
    {
        $clients = Client::all();
        return view('clientServices.edit', compact('clientService', 'clients'));
    }

    public function update(Request $request, ClientService $clientService)
    {

        $clientId   = $request->input('client_service_id'); 
        $serviceIds = $request->input('service_id'); 

        ClientService::where('client_id', $clientId)->delete();

        foreach ($serviceIds as $serviceId)
        {
            ClientService::create([
                'client_id'  => $clientId,
                'service_id' => $serviceId,
            ]);
        }

        return response()->json([
                'status'    => true,
                'msg'       => 'information updated correctly',
                'type'      => 'success',
                'title'     =>'Perfect!'
            ]);
    }

    public function destroy(ClientService $clientService)
    {
        $clientService->delete();

        return redirect()->route('clientServices.index')
                         ->with('success', 'Servicio eliminado.');
    }
}
