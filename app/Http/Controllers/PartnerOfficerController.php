<?php

namespace App\Http\Controllers;

use App\Models\PartnerOfficer;
use App\Models\Client;
use Illuminate\Http\Request;

class PartnerOfficerController extends Controller
{
    public function index()
    {
        // Podrías paginar, filtrar, etc.
        $partnersOfficers = PartnerOfficer::with('client')->get();
        return view('partners_officers.index', compact('partnersOfficers'));
    }

    public function create()
    {
        // Para un select de clientes, por ejemplo
        $clients = Client::all();
        return view('partners_officers.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id'                                 => 'required|exists:clients,id',
            'first_name'                                => 'nullable|string|max:255',
            'last_name'                                 => 'nullable|string|max:255',
            'title'                                     => 'nullable|string|max:255',
            'street_address'                            => 'nullable|string|max:255',
            'city'                                      => 'nullable|string|max:255',
            'state'                                     => 'nullable|string|max:255',
            'zip_code'                                  => 'nullable|string|max:255',
            'phone1'                                    => 'nullable|string|max:255',
            'phone2'                                    => 'nullable|string|max:255',
            'social_security_number'                    => 'nullable|string|max:255',
            'ownership_percentage'                      => 'nullable|string|max:255',
            'shares_interest'                           => 'nullable|string|max:255',
            'annual_salary_draw'                        => 'nullable|string|max:255',
            'responsible_for_depositing_payroll_taxes' => 'boolean',
        ]);

        PartnerOfficer::create($request->all());

        return redirect()->route('partners_officers.index')
                         ->with('success', 'Partner/Officer creado con éxito.');
    }

    public function show(PartnerOfficer $partners_officer)
    {
        return view('partners_officers.show', compact('partners_officer'));
    }

    public function edit(PartnerOfficer $partners_officer)
    {
        $clients = Client::all();
        return view('partners_officers.edit', compact('partners_officer', 'clients'));
    }

    public function update(Request $request, string $id)
    {
        $data           = PartnerOfficer::findOrFail($id);
        $name                       = $request->input('name');
        $value                      = $request->input('value');
        $data->$name    = $value;

        $data->update();


        return response()->json(['type' => 'success', 'title' => 'Perfect', 'msg' => 'PartnerOfficer record updated successfully', 'data' => $data]);
    }

    public function destroy(PartnerOfficer $partners_officer)
    {
        $partners_officer->delete();

        return redirect()->route('partners_officers.index')
                         ->with('success', 'Partner/Officer eliminado con éxito.');
    }
}
