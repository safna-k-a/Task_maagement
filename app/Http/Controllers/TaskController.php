<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $createdTasks = $user->tasks()->all();
    $assignedTasks = Task::where('assigned_user_id', $user->id)->get();

    return view('dashboard', compact('createdTasks', 'assignedTasks'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    if (!empty($request->user)) {
        $user = $request->user;
    } else {
        $user = Auth::user()->id;
    }

    $task = new Task();
    $task->name = $request->name;
    $task->user_id = $user;

    if ($task->save()) {
        return redirect()->route('dashboard')->with('success', 'Task added successfully.');
    } else {
        return redirect()->route('dashboard')->with('error', 'Failed to add task.');
    }
}

    public function edit(Task $task)
    {
        return view('edit_task', compact('task'));
    }
    public function create()
    {
        return view('create_task');
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $task = Task::findOrFail($request->id);
        if(!empty($request->user)){
            $user=$request->user;
        }
        else{
            $user=Auth::user()->id;
        }

        if ($task->update([
            'name' => $request->name,
            'user_id'=>$user
        ])) {
            return redirect()->route('dashboard')->with('success', 'Task updated successfully.');
        } else {
            return redirect()->route('dashboard')->with('error', 'Failed to update task.');
        }
    }
    public function assign_task(Request $request)
    {
        $task = Task::findOrFail($request->id);
        $task->update([
            'assigned_user_id' => $request->user_id
        ]);

        return redirect()->route('dashboard')->with('success', 'Task Assigned successfully.');
    }

    public function destroy(Task $task)
    {
        if ($task->delete()) {
            return redirect()->route('dashboard')->with('success', 'Task deleted successfully.');
        } else {
            return redirect()->route('dashboard')->with('error', 'Failed to delete task.');
        }
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $createdTasks = Task::where('name', 'like', '%' . $search . '%')->get();

        return view('dashboard', compact('createdTasks'));
    }
    public function assign_view(Task $task)
    {
        $users = User::all();
        return view('assign_task', compact('task','users'));
    }
}
