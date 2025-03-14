<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create() {
        return view('tasks.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        Task::create($request->except('_token'));
        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    public function edit(Task $task){
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task){
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task updated succesfully');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }
}
