<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $createdTasks = $user->tasks()->get();
        $assignedTasks = Task::where('assigned_user_id', $user->id)->get();
        return view('dashboard', compact('createdTasks', 'assignedTasks'));
    }
}
