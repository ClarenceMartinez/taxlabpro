<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Asegúrate que está importado
use Illuminate\Validation\Rule;      // Importa Rule para validación única en update
use App\Models\cr;                    // No usado en el código visible
use App\Models\Client;                // Usado en query crudo y validación list()
use App\Models\Company;
use App\Models\User;
use App\Models\RepresentativeDesignation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;       // No usado en el código visible
use DataTables;                       // Asumiendo que viene de yajra/laravel-datatables
use App\Traits\ManagesUserPermissions; 

class UserController extends Controller
{

    use ManagesUserPermissions; 

    /**
     * Display a listing of the resource. (Requires Auth)
     */
    public function index()
    {
        // Auth check is implicit via middleware usually, but good practice
        if (!Auth::check()) {
            return redirect('/');
        }

        $currentUser = Auth::user();

        // Only Super Admin (1) or Admin (2) can view the user list page
        if ($currentUser->type == 1 || $currentUser->type == 2) {
            // Only Super Admin needs the full company list for filtering/assignment potentially
            $data['title'] = 'Module User | Plataform TaxlabPro';
            $data['companies'] = ($currentUser->type == 1) ? Company::get(['id', 'name']) : null;
            $data['designations'] = RepresentativeDesignation::all();


            return view('user.list', $data);
        } else {
            // Redirect non-admins away
            return redirect('welcome')->with('error', 'Access Denied');
        }
    }

    /**
     * Display the specified user profile. (Requires Auth)
     */
    public function profile($id = null)
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        if ($id === null) {
            $idx = Auth::id(); // Set to current user ID if $id is null
        } else {
            $decodedId = base64_decode($id);

            if (!is_numeric($decodedId)) {
                abort(404, 'Invalid User ID format.');
            }
            $idx = (int) $decodedId; // Cast to integer SQLi Fix 1
        }


        // Use findOrFail to get the user or 404 if not found
        $targetUser = User::findOrFail($idx);
        $currentUser = Auth::user();

        // Authorization: Super Admin can see anyone. Others can only see users in their own company.
        if ($currentUser->type != 1 && $targetUser->company_id != $currentUser->company_id) {
            return redirect('users')->with('error', 'You do not have permission to view this profile.');
        }
        // sqlite compatibility :) SQLi FIX 2
        $sqlite_query = "SELECT u.id, c.first_name || ' ' || c.last_name AS client_full_name, c.id AS client_id, c.city, a.image
        ,(SELECT COUNT(*) FROM activities an WHERE an.client_id = c.id) AS total_activities
        ,(SELECT COUNT(*) FROM files f WHERE f.client_id = c.id) AS total_files
        ,(SELECT COUNT(*) FROM notes n WHERE n.client_id = c.id) AS total_notes
        FROM users u
        INNER JOIN user_to_client uc ON uc.user_id = u.id
        INNER JOIN clients c ON c.id = uc.client_id
        INNER JOIN avatar a ON a.id = c.avatar
        WHERE u.status = 1
        AND u.id = ?";

        // Raw Query (Parameter binding already fixed) SQLi FIX 2
        $query = "SELECT u.id, CONCAT(c.`first_name`, ' ', c.`last_name`) AS client_full_name, c.`id` AS client_id, c.city, a.image
                ,(SELECT COUNT(*) FROM activities an WHERE an.client_id = c.id) AS total_activities
                ,(SELECT COUNT(*) FROM files f WHERE f.client_id = c.id) AS total_files
                ,(SELECT COUNT(*) FROM notes n WHERE n.client_id = c.id) AS total_notes
                FROM users u
                INNER JOIN user_to_client uc ON(uc.user_id = u.id)
                INNER JOIN clients c ON(c.`id` = uc.client_id)
                INNER JOIN avatar a ON (a.id = c.avatar)
                AND u.status = 1
                AND u.id = ?";

        $data['clients'] = DB::select($query, [$targetUser->id]);

        $data['info'] = User::select('users.*', 'avatar.image')
        ->leftJoin('avatar', 'avatar.id', '=', 'users.avatar') 
        ->where('users.id', $targetUser->id)
        ->first();

        // If somehow info is null even though user exists (join failed?)
        if (!$data['info']) {
             // This should technically not happen if findOrFail worked and avatar join is correct
             abort(500, 'Could not retrieve user details.');
        }

        $data['title'] = 'Module User | Plataform TaxlabPro';
        return view('user.profile', $data);
    }

    /**
     * Show the form for creating a new resource. (Placeholder)
     */
    public function create()
    {
        // Typically used to show the creation form view
        // Add authorization check if needed: only Admin/SuperAdmin should see this form
        if (!Auth::check() || !in_array(Auth::user()->type, [1, 2])) {
             abort(403, 'Access Denied');
        }
        // return view('user.create'); // Example
    }

    /**
     * Store a newly created resource in storage. (Placeholder)
     */
    public function store(Request $request)
    {
        // This is the standard method for *creating* resources from a full form post,
        // while `save` seems to be used for AJAX creation in the original code.
        // If this method is intended, validation and creation logic from `save`
        // should likely be moved here.
    }

    /**
     * Store a newly created user via AJAX. (Requires Auth)
     */
    public function save(Request $request)
    {
        // Authentication check (Middleware preferred)
        if (!Auth::check()) {
            return response()->json(['status' => false, 'msg' => 'Authentication required.'], 401);
        }
        $currentUser = Auth::user();

        // Authorization: Only Super Admin (1) or Admin (2) can create users
        if (!in_array($currentUser->type, [1, 2])) {
             return response()->json(['status' => false, 'msg' => 'You do not have permission to create users.'], 403);
        }

        if (!$request->ajax()) {
            return response()->json(['status' => false, 'msg' => 'Invalid request type.'], 400);
        }

        // --- Validation ---
        $rules = [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255|unique:users,email',
            'password'  => 'required|string|min:8', // Add confirmation rule if needed: 'confirmed'
            // Validate type based on creator's permissions
            'type'      => [
                'required',
                 Rule::in(($currentUser->type == 1) ? [1, 2, 3, 4] : [2, 3, 4]) // SuperAdmin can create any type, Admin cannot create SuperAdmin
                 // Consider if Admins should only create Staff(3) and Client(4)? Adjust Rule::in accordingly.
            ],
            'company_id'=> [
                 ($currentUser->type == 1) ? 'required' : 'sometimes', // Required if SuperAdmin is creating
                'integer',
                 ($currentUser->type == 1) ? 'exists:company,id' : '', // Validate only if SuperAdmin sets it
                 Rule::prohibitedIf($request->input('company_id') == 0) // Explicitly block 0 if it's used as a placeholder
            ],
            // Add validation for other fields as needed
             'timezone'           => 'nullable|string|max:100',
             'email_signature'    => 'nullable|string',
             'poa1_description'   => 'nullable|string|max:255',
             'poa1_form_number'   => 'nullable|string|max:50',
             'poa1_period'        => 'nullable|string|max:50',
             'poa2_description'   => 'nullable|string|max:255',
             'poa2_form_number'   => 'nullable|string|max:50',
             'poa2_period'        => 'nullable|string|max:50',
 
             'poa3_description'   => 'nullable|string|max:255',
             'poa3_form_number'   => 'nullable|string|max:50',
             'poa3_period'        => 'nullable|string|max:50',
 
 
             'poa_bus1_description'      => 'nullable|string|max:255',
             'poa_bus1_form_number'      => 'nullable|string|max:50',
             'poa_bus1_period'           => 'nullable|string|max:50',
             'poa_bus2_description'      => 'nullable|string|max:255',
             'poa_bus2_form_number'      => 'nullable|string|max:50',
             'poa_bus2_period'           => 'nullable|string|max:50',
             'poa_bus3_description'      => 'nullable|string|max:255',
             'poa_bus3_form_number'      => 'nullable|string|max:50',
             'poa_bus3_period'           => 'nullable|string|max:50',

            'address'                    => 'nullable|string|max:50',
            'telephone'                  => 'nullable|string|max:50',
            'poa_bus1_description'      => 'nullable|string|max:255',
            'poa_bus1_form_number'      => 'nullable|string|max:50',
            'poa_bus1_period'           => 'nullable|string|max:50',
            'poa_bus2_description'      => 'nullable|string|max:255',
            'poa_bus2_form_number'      => 'nullable|string|max:50',
            'poa_bus2_period'           => 'nullable|string|max:50',
            'poa_bus3_description'      => 'nullable|string|max:255',
            'poa_bus3_form_number'      => 'nullable|string|max:50',
            'poa_bus3_period'           => 'nullable|string|max:50',
 
        ];

        $validated = $request->validate($rules);
        // --- End Validation ---

        // Determine Company ID
        // If Super Admin, use validated ID. If Admin, use their own company ID.
        $companyIdToAssign = ($currentUser->type == 1)
                             ? $validated['company_id']
                             : $currentUser->company_id;

        // Check if Admin is trying to create a user outside their company (shouldn't happen if validation is correct, but safety check)
         if ($currentUser->type == 2 && $currentUser->company_id != $companyIdToAssign) {
              return response()->json(['status' => false, 'msg' => 'Admin cannot assign users to other companies.'], 403);
         }


        // Create User
        try {
            $user = User::create([
                'name'      => $validated['name'],
                'email'     => $validated['email'],
                'password'  => Hash::make($validated['password']),
                'type'      => $validated['type'],
                'company_id'=> $companyIdToAssign,
                'avatar'    => 1, // Consider making this configurable or dynamic
                'status'    => 1, // Default to active
                'timezone'           => $validated['timezone'] ?? null,
                'email_signature'    => $validated['email_signature'] ?? null,


                'address'              => $validated['address'] ?? null,
                'telephone'                => $validated['telephone'] ?? null,
                
                'poa1_description'   => $validated['poa1_description'] ?? null,
                'poa1_form_number'   => $validated['poa1_form_number'] ?? null,
                'poa1_period'        => $validated['poa1_period'] ?? null,
                'poa2_description'   => $validated['poa2_description'] ?? null,
                'poa2_form_number'   => $validated['poa2_form_number'] ?? null,
                'poa2_period'        => $validated['poa2_period'] ?? null,
                'poa3_description'   => $validated['poa3_description'] ?? null,
                'poa3_form_number'   => $validated['poa3_form_number'] ?? null,
                'poa3_period'        => $validated['poa3_period'] ?? null,

                'poa_bus1_description'   => $validated['poa_bus1_description'] ?? null,
                'poa_bus1_form_number'   => $validated['poa_bus1_form_number'] ?? null,
                'poa_bus1_period'        => $validated['poa_bus1_period'] ?? null,
                'poa_bus2_description'   => $validated['poa_bus2_description'] ?? null,
                'poa_bus2_form_number'   => $validated['poa_bus2_form_number'] ?? null,
                'poa_bus2_period'        => $validated['poa_bus2_period'] ?? null,
                'poa_bus3_description'   => $validated['poa_bus3_description'] ?? null,
                'poa_bus3_form_number'   => $validated['poa_bus3_form_number'] ?? null,
                'poa_bus3_period'        => $validated['poa_bus3_period'] ?? null,

                'firm_ein'              => $validated['firm_ein'] ?? null,
                'caf_no'                => $validated['caf_no'] ?? null,
                'ptin'                  => $validated['ptin'] ?? null,
                'ctec'                  => $validated['ctec'] ?? null,
                'ny_tprin'              => $validated['ny_tprin'] ?? null,
                'designation'           => $validated['designation'] ?? null,
                'licensing_jurisdiction'=> $validated['licensing_jurisdiction'] ?? null,
                'license_no'            => $validated['license_no'] ?? null,
                'a2a'                   => $validated['a2a'] ?? null,

            ]);
        } catch (\Exception $e) {
             // Log the error $e->getMessage()
            return response()->json([
                'status'    => false,
                'msg'       => 'Failed to create user. Please try again.',
                'type'      => 'error',
                'title'     =>'Error!'
            ], 500); // Internal Server Error
        }

        return response()->json([
            'status'    => true,
            'msg'       => 'Successfully registered user',
            'type'      => 'success',
            'title'     =>'Perfect!'
        ], 201); // 201 Created status code
    }

    /**
     * Display the specified resource. (Placeholder)
     */
    public function show(cr $cr) // Still has unused 'cr' model type hint
    {
        // Usually shows a single resource details (non-editable view)
        // Could be used for API endpoint or specific view.
    }

    /**
     * Get user data for editing form via AJAX. (Requires Auth)
     */
    public function edit(Request $request)
    {
        if (!Auth::check()) {
             return response()->json(['status' => false, 'msg' => 'Authentication required.'], 401);
        }

        if (!$request->ajax()) {
            return response()->json(['status' => false, 'msg' => 'Invalid request type.'], 400);
        }


        $currentUser = Auth::user();

        // Authorization: Only Super Admin (1) or Admin (2) can edit users
        if (!in_array($currentUser->type, [1, 2])) {
             return response()->json(['status' => false, 'msg' => 'You do not have permission to create users.'], 403);
        }

        // --- Validation ---
        $validated = $request->validate([
            'id' => 'required|integer|exists:users,id', // Ensure ID is provided and exists
                 ]);
        // --- End Validation ---

        // Find the user or fail (already validated existence)
        $targetUser = User::find($validated['id']);
        if (!$targetUser) { // Should not happen if validation passed, but safety first
             abort(404, 'User not found.');
        }
        // *** AUTHORIZATION CHECK ***
        if (!$this->canManageUser($targetUser)) {
             return response()->json([
                'status'    => false,
                'msg'       => 'You do not have permission to edit this user.',
                'type'      => 'error',
                'title'     => 'Forbidden'
            ], 403);
        }

        // Select specific fields to return (avoid sending password hash)
        $userInfo = User::select(
                "id", "name", "email", "type", "status", "company_id",
                'timezone', 'email_signature',
                'poa1_description', 'poa1_form_number', 'poa1_period',
                'poa2_description', 'poa2_form_number', 'poa2_period',
                'poa3_description', 'poa3_form_number', 'poa3_period',
                'poa_bus1_description', 'poa_bus1_form_number', 'poa_bus1_period',
                'poa_bus2_description', 'poa_bus2_form_number', 'poa_bus2_period',
                'poa_bus3_description', 'poa_bus3_form_number', 'poa_bus3_period',
                'firm_ein',
                'caf_no',
                'ptin',
                'ctec',
                'ny_tprin',
                'designation',
                'licensing_jurisdiction',
                'license_no',
                'a2a'
            )->where('id', $targetUser->id)
             ->first();

        if (!$userInfo) { // Should not happen
            return response()->json(['status' => false,'msg' => 'Could not retrieve user details.'], 500);
        }

        return response()->json([
            'status'    => true,
            'msg'       => 'Get Info by User',
            'type'      => 'success',
            'title'     => 'Success!',
            'data'      => $userInfo
        ]);
    }

    /**
     * Update the specified user in storage via AJAX. (Requires Auth)
     */
    public function update(Request $request)
    {
        if (!Auth::check()) {
             return response()->json(['status' => false, 'msg' => 'Authentication required.'], 401);
        }
        $currentUser = Auth::user();

        if (!$request->ajax()) {
            return response()->json(['status' => false, 'msg' => 'Invalid request type.'], 400);
        }

        // --- Validation ---
        // First, validate the ID exists so we can use it in other rules
        $preValidated = $request->validate(['_id' => 'required|integer|exists:users,id']);
        $targetUserId = $preValidated['_id'];

        $rules = [
            '_id'       => 'required|integer|exists:users,id', // Already validated, but good practice
            'name'      => 'required|string|max:255',
            'email'     => [                // Email validation needs to ignore current user
                'required',
                'email',
                'max:255',
                 Rule::unique('users', 'email')->ignore($targetUserId),
            ],
            'password'  => 'nullable|string|min:8', // Password is optional on update
             // Validate type based on creator's permissions & target user
            'type'      => [
                'required',
                 Rule::in(($currentUser->type == 1) ? [1, 2, 3, 4] : [2, 3, 4]) // Allow valid types based on who is updating
            ],
            'status'    => ['required', Rule::in([0, 1])], // Ensure status is 0 or 1
            'company_id'=> [
                 ($currentUser->type == 1) ? 'required' : 'sometimes', // Only SuperAdmin should NEED to submit this
                'integer',
                 ($currentUser->type == 1) ? 'exists:company,id' : '', // Validate company exists if SuperAdmin submits it
                 Rule::prohibitedIf($request->input('company_id') == 0)
            ],


            'address'                    => 'nullable|string|max:50',
            'telephone'                  => 'nullable|string|max:50',

            // Add validation for other fields as needed
            'timezone'           => 'nullable|string|max:100',
            'email_signature'    => 'nullable|string|max:255',
            
            'firm_ein'                  => 'nullable|string|max:50',
            'caf_no'                    => 'nullable|string|max:50',
            'ptin'                      => 'nullable|string|max:50',
            'ctec'                      => 'nullable|string|max:50',
            'ny_tprin'                  => 'nullable|string|max:50',
            'designation'               => 'nullable|string|max:50',
            'licensing_jurisdiction'    => 'nullable|string|max:50',
            'license_no'                => 'nullable|string|max:50',
            'a2a'                       => 'nullable|string|max:50',
            'poa1_description'   => 'nullable|string|max:255',
            'poa1_form_number'   => 'nullable|string|max:50',
            'poa1_period'        => 'nullable|string|max:50',
            'poa2_description'   => 'nullable|string|max:255',
            'poa2_form_number'   => 'nullable|string|max:50',
            'poa2_period'        => 'nullable|string|max:50',

            'poa3_description'   => 'nullable|string|max:255',
            'poa3_form_number'   => 'nullable|string|max:50',
            'poa3_period'        => 'nullable|string|max:50',


            'poa_bus1_description'      => 'nullable|string|max:255',
            'poa_bus1_form_number'      => 'nullable|string|max:50',
            'poa_bus1_period'           => 'nullable|string|max:50',
            'poa_bus2_description'      => 'nullable|string|max:255',
            'poa_bus2_form_number'      => 'nullable|string|max:50',
            'poa_bus2_period'           => 'nullable|string|max:50',
            'poa_bus3_description'      => 'nullable|string|max:255',
            'poa_bus3_form_number'      => 'nullable|string|max:50',
            'poa_bus3_period'           => 'nullable|string|max:50',
        ];

        $validated = $request->validate($rules);
        // --- End Validation ---

        // Find the user
        $targetUser = User::find($validated['_id']);
         if (!$targetUser) { // Should not happen if validation passed
             abort(404, 'User not found.');
        }

        // *** AUTHORIZATION CHECK ***
        if (!$this->canManageUser($targetUser)) {
             return response()->json(['status' => false, 'msg' => 'You do not have permission to update this user.'], 403);
        }

        // Prevent non-Super Admins from promoting users TO Super Admin
        if ($validated['type'] == 1 && $targetUser->type != 1 && $currentUser->type != 1) {
             return response()->json(['status' => false, 'msg' => 'You cannot assign the Super Admin role.'], 403);
        }
        // Prevent non-Super Admins from demoting Super Admins
        if ($targetUser->type == 1 && $validated['type'] != 1 && $currentUser->type != 1) {
             return response()->json(['status' => false, 'msg' => 'You cannot change the role of a Super Admin.'], 403);
        }


        // --- Update User ---
        try {
            $targetUser->name = $validated['name'];
            $targetUser->email = $validated['email'];
            $targetUser->type = $validated['type'];
            $targetUser->status = $validated['status'];
            $targetUser->address = $validated['address'];
            $targetUser->telephone = $validated['telephone'];

            // Only hash and update password if a new one was provided
            if (!empty($validated['password'])) {
                $targetUser->password = Hash::make($validated['password']);
            }

            // Company ID update logic
            if ($currentUser->type == 1) {
                // Super Admin can change company if validated
                $targetUser->company_id = $validated['company_id'];
            } else {
                // Admin cannot change the company ID of users they manage
                // No change needed: $targetUser->company_id = $targetUser->company_id;
                // OR ensure it matches current user's company if validation allows changing it
                 if (isset($validated['company_id']) && $validated['company_id'] != $currentUser->company_id) {
                      // This case should ideally be blocked by validation rules or the canManageUser check
                      return response()->json(['status' => false, 'msg' => 'Admin cannot move users between companies.'], 403);
                 }
            }

            $targetUser->timezone           = $validated['timezone'] ?? $targetUser->timezone;
            $targetUser->email_signature    = $validated['email_signature'] ?? $targetUser->email_signature;
    
            $targetUser->poa1_description   = $validated['poa1_description'] ?? $targetUser->poa1_description;
            $targetUser->poa1_form_number   = $validated['poa1_form_number'] ?? $targetUser->poa1_form_number;
            $targetUser->poa1_period        = $validated['poa1_period'] ?? $targetUser->poa1_period;
    
            $targetUser->poa2_description   = $validated['poa2_description'] ?? $targetUser->poa2_description;
            $targetUser->poa2_form_number   = $validated['poa2_form_number'] ?? $targetUser->poa2_form_number;
            $targetUser->poa2_period        = $validated['poa2_period'] ?? $targetUser->poa2_period;
    
            $targetUser->poa3_description   = $validated['poa3_description'] ?? $targetUser->poa3_description;
            $targetUser->poa3_form_number   = $validated['poa3_form_number'] ?? $targetUser->poa3_form_number;
            $targetUser->poa3_period        = $validated['poa3_period'] ?? $targetUser->poa3_period;
    
            $targetUser->poa_bus1_description = $validated['poa_bus1_description'] ?? $targetUser->poa_bus1_description;
            $targetUser->poa_bus1_form_number = $validated['poa_bus1_form_number'] ?? $targetUser->poa_bus1_form_number;
            $targetUser->poa_bus1_period      = $validated['poa_bus1_period'] ?? $targetUser->poa_bus1_period;
    
            $targetUser->poa_bus2_description = $validated['poa_bus2_description'] ?? $targetUser->poa_bus2_description;
            $targetUser->poa_bus2_form_number = $validated['poa_bus2_form_number'] ?? $targetUser->poa_bus2_form_number;
            $targetUser->poa_bus2_period      = $validated['poa_bus2_period'] ?? $targetUser->poa_bus2_period;
    
            $targetUser->poa_bus3_description = $validated['poa_bus3_description'] ?? $targetUser->poa_bus3_description;
            $targetUser->poa_bus3_form_number = $validated['poa_bus3_form_number'] ?? $targetUser->poa_bus3_form_number;
            $targetUser->poa_bus3_period      = $validated['poa_bus3_period'] ?? $targetUser->poa_bus3_period;

            $targetUser->firm_ein               = $validated['firm_ein'] ?? $targetUser->firm_ein;
            $targetUser->caf_no                 = $validated['caf_no'] ?? $targetUser->caf_no;
            $targetUser->ptin                   = $validated['ptin'] ?? $targetUser->ptin;
            $targetUser->ctec                   = $validated['ctec'] ?? $targetUser->ctec;
            $targetUser->ny_tprin               = $validated['ny_tprin'] ?? $targetUser->ny_tprin;
            $targetUser->designation            = $validated['designation'] ?? $targetUser->designation;
            $targetUser->licensing_jurisdiction = $validated['licensing_jurisdiction'] ?? $targetUser->licensing_jurisdiction;
            $targetUser->license_no             = $validated['license_no'] ?? $targetUser->license_no;
            $targetUser->a2a                    = $validated['a2a'] ?? $targetUser->a2a;         

            $targetUser->save();

        } catch (\Exception $e) {
             // Log error $e->getMessage()
             // return response()->json(['status' => false, 'msg' => 'Failed to update user. Please try again. '.$e->getMessage()], 500);
             return response()->json(['status' => false, 'msg' => 'Failed to update user. Please try again.'], 500);
        }


        return response()->json([
            'status'    => true,
            'msg'       => 'The user was successfully updated.', // Corrected message
            'type'      => 'success',
            'title'     => 'Success!'
        ]);
    }

    /**
     * Soft delete the specified user via AJAX. (Requires Auth)
     */
    public function destroy(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['status' => false, 'msg' => 'Authentication required.'], 401);
        }

        if (!$request->ajax()) {
            return response()->json(['status' => false, 'msg' => 'Invalid request type.'], 400);
        }

        // --- Validation ---
        $validated = $request->validate([
            'id' => 'required|integer|exists:users,id'
        ]);
        // --- End Validation ---

        $targetUser = User::find($validated['id']);
        if (!$targetUser) { // Should not happen
             abort(404, 'User not found.');
        }

        // *** AUTHORIZATION CHECK ***
        if (!$this->canManageUser($targetUser)) {
             return response()->json(['status' => false, 'msg' => 'You do not have permission to delete this user.'], 403);
        }

        // Prevent users from deleting themselves
        if ($targetUser->id === Auth::id()) {
             return response()->json(['status' => false, 'msg' => 'You cannot delete your own account.'], 403);
        }

        // --- Soft Delete ---
        try {
             // Check if already deleted? Optional.
            if ($targetUser->status == 0) {
                return response()->json([
                    'status'    => true, // Or false depending on if you want to indicate no change
                    'msg'       => 'User is already inactive.',
                    'type'      => 'info',
                    'title'     =>'Info'
                ]);
            }
            $targetUser->status = 0; // Assuming 0 is inactive/soft-deleted status
            $targetUser->save();
        } catch (\Exception $e) {
             // Log error $e->getMessage()
             return response()->json(['status' => false, 'msg' => 'Failed to deactivate user. Please try again.'], 500);
        }


        return response()->json([
            'status'    => true,
            'msg'       => 'The user was successfully deactivated.', // Corrected message
            'type'      => 'success',
            'title'     =>'Success!'
        ]);
    }

    /**
     * Provide user data for DataTables. (Requires Auth)
     */
    public function users_json()
    {
        if (!Auth::check()) {
             // DataTables expects a JSON response even for errors usually
             return response()->json(['error' => 'Unauthenticated.'], 401);
             // Or handle DataTables server-side error format if needed
        }
        $currentUser = Auth::user();

        // Base Query
        $query = User::select('users.id', 'users.name','users.email', 'users.type', 'users.status', 'users.created_at', 'company.name as company_name')
                     ->join('company', 'company.id', '=', 'users.company_id') // Ensure join condition uses '='
                     ->where('users.status', '<>', 0); // Exclude soft-deleted users

        // Authorization: Filter based on user type
        if ($currentUser->type == 1) {
            // Super Admin sees everyone (active)
        } elseif ($currentUser->type == 2) {
            // Admin sees active users in their company, excluding Super Admins
            $query->where('users.company_id', $currentUser->company_id)
                  ->where('users.type', '<>', 1); // Don't show Super Admins to Admins
        } else {
             // Other user types should not access this endpoint
             return response()->json(['error' => 'Forbidden.'], 403);
        }

        $lista = $query->get();

        // Use DataTables facade
        return DataTables::of($lista)
            ->addIndexColumn() // Adds DT_RowIndex
            ->editColumn('name', function ($user) {
                // Ensure the route exists and user has permission to view profile before generating link
                 if (Auth::user()->type == 1 || (Auth::user()->type == 2 && $user->type != 1 && Auth::user()->company_id == $user->company_id) ) {
                    // Note: Base64 encoding IDs is generally discouraged for security/usability.
                    $link = route('users.profile', base64_encode($user->id));
                    return '<a href="'.$link.'" class="">'.htmlspecialchars($user->name).'</a>'; // Use htmlspecialchars
                 } else {
                     return htmlspecialchars($user->name); // Non-link for users without permission
                 }
            })
            ->editColumn('type', function ($user) {
                // Consider using constants or a helper function/model accessor for types
                $types = [
                    1 => '<span class="badge rounded-pill bg-label-success">Super Admin</span>',
                    2 => '<span class="badge rounded-pill bg-label-warning">Admin</span>',
                    3 => '<span class="badge rounded-pill bg-label-secondary">User Staff</span>',
                    4 => '<span class="badge rounded-pill bg-label-info">Client</span>',
                ];
                return $types[$user->type] ?? 'Unknown';
            })
            ->editColumn('created_at', function ($user) {
                // Handle potential null dates, though created_at usually isn't null
                return $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('m-d-Y') : 'N/A';
            })
            ->editColumn('status', function ($user) {
                return $user->status == 1
                       ? '<span class="badge rounded-pill bg-label-success">Active</span>'
                       : '<span class="badge rounded-pill bg-label-danger">Suspended</span>'; // Changed warning to danger for status 0
            })
            ->addColumn('actions', function ($user) {
                 $currentUser = Auth::user();
                 $canManage = false;

                 // Determine if current user can manage this listed user
                 if ($currentUser->type == 1) { // Super Admin can manage anyone
                      $canManage = true;
                 } elseif ($currentUser->type == 2) { // Admin checks
                     if ($user->type != 1 && $user->company_id == $currentUser->company_id) { // Can manage non-superadmins in their company
                         $canManage = true;
                     }
                 }

                 // Don't allow actions on oneself
                 if ($user->id === $currentUser->id) {
                     $canManage = false;
                 }


                if ($canManage) {
                    $id = $user->id;
                    // Generate buttons only if authorized
                    $editBtn = '<a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon btn-edit" data-form="form-update-user" data-bs-target="#edit-user" data-bs-toggle="offcanvas" aria-controls="edit-user" data-id="'.$id.'" title="Edit"><i class="ri-edit-box-line"></i></a>';
                    $deleteBtn = '<a href="javascript:;" class="btn btn-sm btn-text-danger rounded-pill btn-icon item-delete delete-user" data-id="'.$id.'" title="Deactivate"><i class="ri-close-line"></i></a>'; // Use close or trash icon maybe
                    return '<div class="d-inline-block">' . $editBtn . $deleteBtn . '</div>';
                }
                 return ''; // No actions if not authorized
            })
            ->rawColumns(['name', 'type', 'status', 'actions']) // Specify all columns containing HTML
            ->make(true);
    }


    public function users_json_by_company(Request $request)
    {

        // echo "company_id: ".$company_id;

        $companyId = $request->input('company_id');

        // Validación opcional (asegúrate que sea numérico si es un ID)
        if (!is_numeric($companyId)) {
            return response()->json(['msg' => 'Invalid company_id'], 400);
        }

        if (!Auth::check()) {
             // DataTables expects a JSON response even for errors usually
             return response()->json(['error' => 'Unauthenticated.'], 401);
             // Or handle DataTables server-side error format if needed
        }
        $currentUser = Auth::user();

        // Base Query
        $query = User::select('users.id', 'users.name','users.email', 'users.type', 'users.status', 'users.created_at', 'company.name as company_name')
                     ->join('company', 'company.id', '=', 'users.company_id') // Ensure join condition uses '='
                     ->where('users.status', '<>', 0) // Exclude soft-deleted users
                     ->where('users.company_id', $companyId);

        // Authorization: Filter based on user type
        if ($currentUser->type == 1) {
            // Super Admin sees everyone (active)
        } elseif ($currentUser->type == 2) {
            // Admin sees active users in their company, excluding Super Admins
            $query->where('users.company_id', $currentUser->company_id)
                  ->where('users.type', '<>', 1); // Don't show Super Admins to Admins
        } else {
             // Other user types should not access this endpoint
             return response()->json(['error' => 'Forbidden.'], 403);
        }

        $lista = $query->get();

        // Use DataTables facade
        return DataTables::of($lista)
            ->addIndexColumn() // Adds DT_RowIndex
            ->editColumn('name', function ($user) {
                // Ensure the route exists and user has permission to view profile before generating link
                 if (Auth::user()->type == 1 || (Auth::user()->type == 2 && $user->type != 1 && Auth::user()->company_id == $user->company_id) ) {
                    // Note: Base64 encoding IDs is generally discouraged for security/usability.
                    $link = route('users.profile', base64_encode($user->id));
                    return '<a href="'.$link.'" class="">'.htmlspecialchars($user->name).'</a>'; // Use htmlspecialchars
                 } else {
                     return htmlspecialchars($user->name); // Non-link for users without permission
                 }
            })
            ->editColumn('type', function ($user) {
                // Consider using constants or a helper function/model accessor for types
                $types = [
                    1 => '<span class="badge rounded-pill bg-label-success">Super Admin</span>',
                    2 => '<span class="badge rounded-pill bg-label-warning">Admin</span>',
                    3 => '<span class="badge rounded-pill bg-label-secondary">User Staff</span>',
                    4 => '<span class="badge rounded-pill bg-label-info">Client</span>',
                ];
                return $types[$user->type] ?? 'Unknown';
            })
            ->editColumn('created_at', function ($user) {
                // Handle potential null dates, though created_at usually isn't null
                return $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('m-d-Y') : 'N/A';
            })
            ->editColumn('status', function ($user) {
                return $user->status == 1
                       ? '<span class="badge rounded-pill bg-label-success">Active</span>'
                       : '<span class="badge rounded-pill bg-label-danger">Suspended</span>'; // Changed warning to danger for status 0
            })
            ->addColumn('actions', function ($user) {
                 $currentUser = Auth::user();
                 $canManage = false;

                 // Determine if current user can manage this listed user
                 if ($currentUser->type == 1) { // Super Admin can manage anyone
                      $canManage = true;
                 } elseif ($currentUser->type == 2) { // Admin checks
                     if ($user->type != 1 && $user->company_id == $currentUser->company_id) { // Can manage non-superadmins in their company
                         $canManage = true;
                     }
                 }

                 // Don't allow actions on oneself
                 if ($user->id === $currentUser->id) {
                     $canManage = false;
                 }


                if ($canManage) {
                    $id = $user->id;
                    // Generate buttons only if authorized
                    $editBtn = '<a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon btn-edit" data-form="form-update-user" data-bs-target="#edit-user" data-bs-toggle="offcanvas" aria-controls="edit-user" data-id="'.$id.'" title="Edit"><i class="ri-edit-box-line"></i></a>';
                    $deleteBtn = '<a href="javascript:;" class="btn btn-sm btn-text-danger rounded-pill btn-icon item-delete delete-user" data-id="'.$id.'" title="Deactivate"><i class="ri-close-line"></i></a>'; // Use close or trash icon maybe
                    return '<div class="d-inline-block">' . $editBtn . $deleteBtn . '</div>';
                }
                 return ''; // No actions if not authorized
            })
            ->rawColumns(['name', 'type', 'status', 'actions']) // Specify all columns containing HTML
            ->make(true);
    }


    /**
     * List users associated with a specific client (or potential assignees). (Requires Auth)
     */
    public function list(Request $request)
    {
        if (!Auth::check()) {
             return response()->json(['status' => false, 'msg' => 'Authentication required.'], 401);
        }
        $currentUser = Auth::user();

        // --- Validation ---
        $validated = $request->validate([
            'id' => 'required|integer|exists:clients,id' // Ensure client ID exists
        ]);
        $clientId = $validated['id'];
        // --- End Validation ---

        // Authorization: Check if user can access this client's info (Example logic)
        // This might involve checking if the client belongs to the user's company,
        // or if the user is assigned to the client, etc. Add appropriate checks.
        $client = Client::find($clientId);
        if (!$client || ($currentUser->type != 1 && $client->company_id != $currentUser->company_id)) {
             // Assuming Client model has company_id, adjust logic as needed
             return response()->json(['status' => false, 'msg' => 'Access to client data denied.'], 403);
        }


        // Build Query to get users potentially relevant to this client
        $query = User::select(
                'users.id',
                'users.name',
                'users.avatar', // Consider joining avatar table if image path needed directly
                'company.name as company_name'
            )
            ->selectSub(function ($subQuery) use ($clientId) {
                $subQuery->selectRaw('1') // Select 1 if relationship exists
                       ->from('user_to_client')
                       ->whereColumn('user_to_client.user_id', 'users.id')
                       ->where('user_to_client.client_id', $clientId)
                       ->limit(1);
            }, 'is_assigned_to_client') // Alias to indicate if user is already assigned
            ->join('company', 'company.id', '=', 'users.company_id')
            ->where('users.status', '=', 1) // Typically list only active users for assignment
            ->where('users.type', '<>', 1); // Exclude Super Admins? Maybe Staff/Admins only? Adjust type filter.

        // Scope results based on current user's permissions
        if ($currentUser->type != 1) {
             $query->where('users.company_id', $currentUser->company_id); // Admin/Staff only see users in their company
        }

        // Order results (e.g., by name)
        $query->orderBy('users.name');

        try {
            $lista = $query->get();
        } catch (\Exception $e) {
             // Log error $e->getMessage()
             return response()->json(['status' => false, 'msg' => 'Failed to retrieve user list.'], 500);
        }

        return response()->json([
            'status' => true,
            'msg'    => 'User list retrieved successfully.', // More specific message
            'type'   => 'success',
            'title'  => 'Success!',
            'data'   => $lista,
        ]);
    }



    public function mentions(Request $request)
    {
        if (!Auth::check()) {
             // DataTables expects a JSON response even for errors usually
             return response()->json(['error' => 'Unauthenticated.'], 401);
             // Or handle DataTables server-side error format if needed
        }
        $currentUser = Auth::user();



        $q = $request->get('q');

        return User::where('name', 'like', "%{$q}%")
            ->select('id', 'name')
            ->limit(10)
            ->get()
            ->map(function ($user) {
                return [
                    'key' => $user->name,
                    'value' => $user->name,
                    'id' => $user->id,
                    // opcional: puedes incluir 'id' => $user->id si deseas
                ];
            });
    }
}