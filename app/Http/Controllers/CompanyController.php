<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt; 
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; 
use App\Models\Company;
use App\Models\StateOfAmerica;
use App\Models\CompanyService;
use App\Models\RepresentativeDesignation;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (empty(auth()->id()))
        {
            return redirect('/');
        }


        $data['states_list'] = StateOfAmerica::all();
        $data['title'] = 'List Company';

        return view('company.list', $data);
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
        


        if (empty(auth()->id()))
        {
            return redirect('/');
        }

        if (!$request->ajax()) {
            return response()->json([
                'status'    => false,
                'msg'       => 'Intente de nuevo',
                'type'      => 'warning'
            ]);
        }


        if (Auth::user()->type != 1)
        {
            return response()->json(['status' => false, 'msg' => 'You do not have permission to create company.'], 403);
        }


        if (empty($request->input('name')))
        {
            return response()->json([
                'status'    => false,
                'msg'       => 'The name field is required',
                'type'      => 'warning'
            ]);
        }

        if (empty($request->input('state')) || $request->input('state') == 0)
        {
            return response()->json([
                'status'    => false,
                'msg'       => 'The state field is required',
                'type'      => 'warning'
            ]);
        }

        if (empty($request->input('city')))
        {
            return response()->json([
                'status'    => false,
                'msg'       => 'The city field is required',
                'type'      => 'warning'
            ]);
        }

        if (empty($request->input('address_1')))
        {
            return response()->json([
                'status'    => false,
                'msg'       => 'The address_1 field is required',
                'type'      => 'warning'
            ]);
        }

        if (empty($request->input('address_2')))
        {
            return response()->json([
                'status'    => false,
                'msg'       => 'The address_2 field is required',
                'type'      => 'warning'
            ]);
        }

        $nameClean = strip_tags($request->input('name'));

        // 1) Comprueba existencia previa
        if (Company::where('name', $nameClean)->exists()) {
            return response()->json([
                'status' => false,
                'msg'    => 'The company name already exists.',
                'type'   => 'warning'
            ], 409);
        }
       

        $data['name']           = $nameClean;
        $data['state_id']       = strip_tags($request->input('state'));
        $data['city']           = strip_tags($request->input('city'));
        $data['address_1']      = strip_tags($request->input('address_1'));
        $data['address_2']      = strip_tags($request->input('address_2'));
        $data['office_phone']   = strip_tags($request->input('office_phone'));
        $data['office_cell']    = strip_tags($request->input('office_cell'));
        $data['status']         = 1;
        $data['user_id']        = auth()->id();
        $data['slug']           = Str::slug($nameClean, '-');
        
        $company = Company::create($data);


        $services = [
            'Accounting',
            'Tax Consulting',
            'Tax Services',
            'Individual Taxes',
            'Taxes',
            'Business & Personal Taxes',
        ];

        foreach ($services as $serviceName) {
            CompanyService::create([
                'company_id'   => $company->id,
                'service_name' => $serviceName,
            ]);
        }

         

        return response()->json([
                'status'    => true,
                'msg'       => 'Successfully registered Company',
                'type'      => 'success',
                'title'     =>'Perfect!'
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        // $company ya viene cargado por slug
        $title = 'List Company';
        return view('company.account', compact('company','title'));
    }

    public function showEncrypted($hash)
    {
        try {
            // Si $hash fue manipulado, aquí Laravel lanzará DecryptException
            // 1) desencripta
            $slug = Crypt::decryptString($hash);

            // 2) busca la compañía por slug
            $company = Company::where('slug', $slug)->firstOrFail();
            $title = 'List Company';
            return view('company.account', compact('company','title'));
        } catch (DecryptException $e) {
            // Aborta con 404 para no exponer información
            abort(404);
        }
    }

    public function account($hash)
    {
        // echo "string";
        try {
            // Si $hash fue manipulado, aquí Laravel lanzará DecryptException
            // 1) desencripta
            $slug = Crypt::decryptString($hash);

            // 2) busca la compañía por slug
            $company = Company::where('slug', $slug)->firstOrFail();
            // dd($company);
            $title = 'List Company';
            return view('company.account', compact('company','title', 'hash'));
        } catch (DecryptException $e) {
            // Aborta con 404 para no exponer información
            abort(404);
        }
    }
    public function teams($hash)
    {
        // echo "string";
        try {
            // Si $hash fue manipulado, aquí Laravel lanzará DecryptException
            // 1) desencripta
            $slug = Crypt::decryptString($hash);

            // 2) busca la compañía por slug
            $company = Company::where('slug', $slug)->firstOrFail();
            // dd($company);
            $title = 'List Company';

            $currentUser            = Auth::user();
            $data['title']          = 'Team of the Company | Plataform TaxlabPro';
            $data['companies']      = ($currentUser->type == 1) ? Company::get(['id', 'name']) : null;
            $data['designations']   = RepresentativeDesignation::all();
            $data['hash']           = $hash;
            $data['company']        = $company;


            // return view('company.teams', compact('company','title', 'hash'));
            return view('company.teams', $data);
        } catch (DecryptException $e) {
            // Aborta con 404 para no exponer información
            abort(404);
        }



    }
    public function bills($hash)
    {
        // echo "string";
        try {
            // Si $hash fue manipulado, aquí Laravel lanzará DecryptException
            // 1) desencripta
            $slug = Crypt::decryptString($hash);

            // 2) busca la compañía por slug
            $company = Company::where('slug', $slug)->firstOrFail();
            // dd($company);
            $title = 'List Company';
            return view('company.bills', compact('company','title', 'hash'));
        } catch (DecryptException $e) {
            // Aborta con 404 para no exponer información
            abort(404);
        }
    }
    public function notifications($hash)
    {
        // echo "string";
        try {
            // Si $hash fue manipulado, aquí Laravel lanzará DecryptException
            // 1) desencripta
            $slug = Crypt::decryptString($hash);

            // 2) busca la compañía por slug
            $company = Company::where('slug', $slug)->firstOrFail();
            // dd($company);
            $title = 'List Company';
            return view('company.notifications', compact('company','title', 'hash'));
        } catch (DecryptException $e) {
            // Aborta con 404 para no exponer información
            abort(404);
        }
    }
    public function connections($hash)
    {
        // echo "string";
        try {
            // Si $hash fue manipulado, aquí Laravel lanzará DecryptException
            // 1) desencripta
            $slug = Crypt::decryptString($hash);

            // 2) busca la compañía por slug
            $company = Company::where('slug', $slug)->firstOrFail();
            // dd($company);
            $title = 'List Company';
            return view('company.connections', compact('company','title', 'hash'));
        } catch (DecryptException $e) {
            // Aborta con 404 para no exponer información
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json([
                'status'    => false,
                'msg'       => 'Intente de nuevo',
                'type'      => 'warning',
                'title'     =>'Warning!'
            ]);
        }

        if (Auth::user()->type != 1)
        {
            return response()->json(['status' => false, 'msg' => 'You do not have permission to create company.'], 403);
        }

        $company = Company::select("id", 'name','state_id', 'city', 'address_1', 'address_2', 'office_phone', 'office_cell', 'status')->where('id', $request->input('id'))->first();

        return response()->json([
            'status'    => true,
            'msg'       => 'Get Info by Company',
            'type'      => 'success',
            'title'     =>'Success!',
            'data'      => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //

        if (empty(auth()->id()))
        {
            return redirect('/');
        }

        if (!$request->ajax()) {
            return response()->json([
                'status'    => false,
                'msg'       => 'Intente de nuevo',
                'type'      => 'warning'
            ]);
        }

        if (Auth::user()->type != 1)
        {
            return response()->json(['status' => false, 'msg' => 'You do not have permission to create company.'], 403);
        }


        if (empty($request->input('name')))
        {
            return response()->json([
                'status'    => false,
                'msg'       => 'The name field is required',
                'type'      => 'warning'
            ]);
        }

        if (empty($request->input('state')) || $request->input('state') == 0)
        {
            return response()->json([
                'status'    => false,
                'msg'       => 'The state field is required',
                'type'      => 'warning'
            ]);
        }

        if (empty($request->input('city')))
        {
            return response()->json([
                'status'    => false,
                'msg'       => 'The city field is required',
                'type'      => 'warning'
            ]);
        }

        if (empty($request->input('address_1')))
        {
            return response()->json([
                'status'    => false,
                'msg'       => 'The address_1 field is required',
                'type'      => 'warning'
            ]);
        }

        if (empty($request->input('address_2')))
        {
            return response()->json([
                'status'    => false,
                'msg'       => 'The address_2 field is required',
                'type'      => 'warning'
            ]);
        }

        $id = (int) strip_tags($request->input('_id'));
        // Limpia el valor
        $newName = strip_tags($request->input('name'));

        // 1) Chequea duplicados ignorando el ID actual
        $exists = Company::where('name', $newName)
                         ->where('id', '!=', $id)
                         ->exists();
        if ($exists) {
            return response()->json([
                'status' => false,
                'msg'    => 'The company name is already in use.',
                'type'   => 'warning'
            ], 409);
        }


        
        $company = Company::where('id', $request->input('_id'))->first();
        $company->name           = $newName;
        $company->slug           = Str::slug($newName, '-');
        $company->state_id       = strip_tags($request->state);
        $company->city           = strip_tags($request->city);
        $company->address_1      = strip_tags($request->address_1);
        $company->address_2      = strip_tags($request->address_2);
        $company->office_phone   = strip_tags($request->office_phone);
        $company->office_cell    = strip_tags($request->office_cell);
        $company->status         = strip_tags($request->status);
        $company->user_id        = auth()->id();
        $company->save();


        return response()->json([
                'status'    => true,
                'msg'       => 'Successfully updated Company',
                'type'      => 'success',
                'title'     =>'Perfect!'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if (empty(auth()->id()))
        {
            return redirect('/');
        }

        if (!$request->ajax()) {
            return response()->json([
                'status'    => false,
                'msg'       => 'Intente de nuevo',
                'type'      => 'warning'
            ]);
        }

        if (empty($request->input('id')))
        {
            return response()->json([
                'status'    => false,
                'msg'       => 'The id field is required',
                'type'      => 'warning'
            ]);
        }

        if (Auth::user()->type != 1)
        {
            return response()->json(['status' => false, 'msg' => 'You do not have permission to create company.'], 403);
        }

        $company = Company::where('id', $request->input('id'))->first();
        $company->status         = 2;
        $company->save();


        return response()->json([
                'status'    => true,
                'msg'       => 'Successfully updated Company',
                'type'      => 'success',
                'title'     =>'Perfect!'
            ]);
    }

    public function company_json()
    {
        $lista = Company::select('company.*','states_of_america.name as state_name')
                ->join('states_of_america','states_of_america.id', 'company.state_id')
                ->get();

         return Datatables()
            ->of($lista)
            ->editColumn('created_at', function ($company) {
                return \Carbon\Carbon::parse($company->created_at)->format('m-d-Y');
            })

            ->editColumn('name', function ($company) {
                $hash = rawurlencode($company->encrypted_slug);
                $url  = route('company.account', ['hash' => $hash]);
                return '<a href="'.$url.'">'
                     . e($company->name)  // e() escapa XSS por si acaso
                     . '</a>';

            })
            ->editColumn('status', function ($company) {
                if ($company->status == 1)
                {
                    return '<span class="badge rounded-pill bg-label-success">Active</span>';
                }
                    return '<span class="badge rounded-pill bg-label-warning">Suspended</span>';

            })
            ->addColumn('actions', function ($company) {
                $id = $company->id;
                $btn = '<div class="dropdown">
                            <a href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M2 18H9V20H2V18ZM2 11H11V13H2V11ZM2 4H22V6H2V4ZM20.674 13.0251L21.8301 12.634L22.8301 14.366L21.914 15.1711C21.9704 15.4386 22 15.7158 22 16C22 16.2842 21.9704 16.5614 21.914 16.8289L22.8301 17.634L21.8301 19.366L20.674 18.9749C20.2635 19.3441 19.7763 19.6295 19.2391 19.8044L19 21H17L16.7609 19.8044C16.2237 19.6295 15.7365 19.3441 15.326 18.9749L14.1699 19.366L13.1699 17.634L14.086 16.8289C14.0296 16.5614 14 16.2842 14 16C14 15.7158 14.0296 15.4386 14.086 15.1711L13.1699 14.366L14.1699 12.634L15.326 13.0251C15.7365 12.6559 16.2237 12.3705 16.7609 12.1956L17 11H19L19.2391 12.1956C19.7763 12.3705 20.2635 12.6559 20.674 13.0251ZM18 18C19.1046 18 20 17.1046 20 16C20 14.8954 19.1046 14 18 14C16.8954 14 16 14.8954 16 16C16 17.1046 16.8954 18 18 18Z"></path></svg>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                <a class="dropdown-item btn-edit"  data-id="' . $id . '" data-form="form-edit-company" data-bs-target="#edit-company" data-bs-toggle="offcanvas" aria-controls="edit-company"  href="javascript:void(0);">
                                    <span>Edit</span>
                                </a>
                                <a class="dropdown-item btn-confirm suspend-company" data-id="' . $id . '"  href="javascript:void(0);">
                                    <span>Delete</span>
                                </a>
                                
                            </div>
                        </div>';
                return $btn;
            })
            ->rawColumns(['name', 'actions','status'])
            ->toJson();
    }
}
