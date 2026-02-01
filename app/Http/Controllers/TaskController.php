<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('index', compact('tasks'));
    }
    public function store(Request $request)
    {
       $request->validate([
           'title' => 'required|string|max:255',
       ]);
       Task::create([
        'title' => $request->title,
       ]);
       return redirect()->route('tasks.index');
    }
    public function destroy($id)
    {
        Task::destroy($id);
        return redirect()->route('tasks.index');
    }
}
