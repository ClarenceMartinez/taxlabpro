<?php
namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Client;
use App\Models\TaskStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('client', 'steps')->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('tasks.create', compact('clients'));
    }

    public function store(Request $request)
    {
    	if (!Auth::check()) {
            // Para API, mejor un JSON response
            return response()->json(['status' => false, 'msg' => 'Unauthenticated.', 'type' => 'error'], 401);
        }

        $user = Auth::user();
        // Authorization (Only superadmin, admin and user can create clients)
        if (!in_array($user->type, [1, 2, 3])) {
            return response()->json([
                'status' => false,
                'msg'    => 'Unauthorized access to create client.',
                'type'   => 'error'
            ], 403);
        }


        try {
            if (!$request->ajax()) {
                return response()->json([
                    'status'    => false,
                    'msg'       => 'Invalid request. AJAX expected.',
                    'type'      => 'warning'
                ], 400);
            }


            


        if ($request->input('preset_id') == '')
        {
            throw new \Exception("Pleasse select a preset");
        }

        if ($request->input('description') == '')
        {
            throw new \Exception("Pleasse insert description");
        }

        $task = new Task();
        $task->client_id        = $request->input('client_id');;
        $task->user_id          = auth()->id();
        $task->preset_id        = $request->input('preset_id');
        $task->description      = $request->input('description');
        $task->due_date         = $request->input('dueDate');

        $task->save();
            return response()->json([
                'status'    => true,
                'msg'       => 'Successfully registered task.',
                'type'      => 'success',
                'title'     =>'Perfect!'
            ]);

        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => 'An error occurred while registering the task. Please try again.'.$e->getMessage(), 'type' => 'error', 'error_detail' => $e->getMessage()], 500);
        }



        log_client_activity(11, 'Created', 'Has created a task');

        return response()->json([
                'status' => true,
                'msg'    => 'Successfully created task.',
                'type'   => 'success',
                'title'  => 'Perfect!'
            ]);
        // return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }


    public function update(Request $request)
    {
    	if (!Auth::check()) {
            // Para API, mejor un JSON response
            return response()->json(['status' => false, 'msg' => 'Unauthenticated.', 'type' => 'error'], 401);
        }

        $user = Auth::user();
        // Authorization (Only superadmin, admin and user can create clients)
        if (!in_array($user->type, [1, 2, 3])) {
            return response()->json([
                'status' => false,
                'msg'    => 'Unauthorized access to create client.',
                'type'   => 'error'
            ], 403);
        }


        try {
            if (!$request->ajax()) {
                return response()->json([
                    'status'    => false,
                    'msg'       => 'Invalid request. AJAX expected.',
                    'type'      => 'warning'
                ], 400);
            }


            


        if ($request->input('preset_id') == '')
        {
            throw new \Exception("Pleasse select a preset");
        }

        if ($request->input('description') == '')
        {
            throw new \Exception("Pleasse insert description");
        }


        $id 					= $request->input('idx');
        $task 					= Task::find($id);
        $task->client_id        = $request->input('client_id');
        // $task->user_id          = auth()->id();
        $task->preset_id        = $request->input('preset_id');
        $task->description      = $request->input('description');
        $task->due_date         = $request->input('dueDate');

        $task->update();
            return response()->json([
                'status'    => true,
                'msg'       => 'Successfully registered task.',
                'type'      => 'success',
                'title'     =>'Perfect!'
            ]);

        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => 'An error occurred while registering the task. Please try again.'.$e->getMessage(), 'type' => 'error', 'error_detail' => $e->getMessage()], 500);
        }



        log_client_activity(11, 'Updated', 'Has Updated a task');

        return response()->json([
                'status' => true,
                'msg'    => 'Successfully updated task.',
                'type'   => 'success',
                'title'  => 'Perfect!'
            ]);
        // return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    

    public function show($id)
    {
        $task = Task::with('client', 'user', 'steps')->findOrFail($id);
        return view('tasks.show', compact('task'));
    }


    public function edit($id)
    {
    	$task = Task::findOrFail($id);
    	return response()->json([
                'status' => true,
                // 'msg'    => 'Successfully created task.',
                'type'   => 'success',
                'title'  => 'Perfect!',
                'data'   => $task
            ]);

    }
}
